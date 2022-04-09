<?php

namespace Rostami\Ticket\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config("rostami-ticket.tables.departments", "ticket_departments"), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('color');
        });
        Schema::create(config("rostami-ticket.tables.statuses", "ticket_statuses"), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('color');
        });
        Schema::create(config("rostami-ticket.tables.priorities", "ticket_priorities"), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('color');
        });

        Schema::create(config("rostami-ticket.tables.department_agents", "ticket_department_agents"), function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')
                ->constrained(config("rostami-ticket.tables.departments", "ticket_departments"))
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->morphs('agent');
            $table->timestamps();
        });


        Schema::create(config("rostami-ticket.tables.tickets", "tickets"), function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->longText('content');
            $table->longText('html')->nullable();
            $table->morphs('creator');
            $table->nullableMorphs("agent");
            $table->foreignId('priority_id')
                ->constrained(config("rostami-ticket.tables.priorities", "ticket_priorities"))
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('status_id')
                ->constrained(config("rostami-ticket.tables.statuses", "ticket_statuses"))
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('department_id')
                ->constrained(config("rostami-ticket.tables.departments", "ticket_departments"))
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->timestamp("completed_at")->nullable();
            $table->timestamps();


            $table->index('subject');
            $table->index('status_id');
            $table->index('priority_id');
            $table->index('department_id');
            $table->index('completed_at');
        });

        Schema::create(config("rostami-ticket.tables.comments", "ticket_comments"), function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')
                ->constrained(config("rostami-ticket.tables.tickets", "tickets"))
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->nullableMorphs("agent");
            $table->longText('content');
            $table->longText('html')->nullable();
            $table->timestamps();

            $table->index('ticket_id');
        });

        Schema::create(config("rostami-ticket.tables.audits", "ticket_audits"), function (Blueprint $table) {
            $table->id();
            $table->text('operation');
            $table->morphs('agent');
            $table->foreignId('ticket_id')
                ->constrained(config("rostami-ticket.tables.tickets", "tickets"))
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create(config("rostami-ticket.tables.settings", "ticket_settings"), function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang')->unique()->nullable();
            $table->string('slug')->unique();
            $table->mediumText('value');
            $table->mediumText('default');
            $table->timestamps();

            $table->index('lang');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config("rostami-ticket.tables.departments", "ticket_departments"));
        Schema::dropIfExists(config("rostami-ticket.tables.department_agents", "ticket_department_agents"));
        Schema::dropIfExists(config("rostami-ticket.tables.statuses", "ticket_statuses"));
        Schema::dropIfExists(config("rostami-ticket.tables.priorities", "ticket_priorities"));
        Schema::dropIfExists(config("rostami-ticket.tables.tickets", "tickets"));
        Schema::dropIfExists(config("rostami-ticket.tables.comments", "ticket_comments"));
        Schema::dropIfExists(config("rostami-ticket.tables.audits", "ticket_audits"));
        Schema::dropIfExists(config("rostami-ticket.tables.settings", "ticket_settings"));


    }
}

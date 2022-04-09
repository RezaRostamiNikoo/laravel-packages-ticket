<?php

namespace Rostami\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TicketDepartment extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getTable()
    {
        return config("rostami-ticket.tables.departments", "ticket_departments");
    }

    protected $fillable = ['title', 'slug', 'color'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, "department_id", "id");
    }

//    public function agents(): MorphToMany
//    {
//        return $this->morphedByMany(TicketDepartmentAgent::class,"agent",);
//    }

}

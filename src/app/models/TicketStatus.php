<?php

namespace Rostami\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketStatus extends Model
{
    use HasFactory;


    public $timestamps = false;

    public function getTable()
    {
        return config("rostami-ticket.tables.statuses", "ticket_statuses");
    }

    protected $fillable = ['title', 'slug', 'color'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, "status_id", "id");
    }
}

<?php

namespace Rostami\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketPriority extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getTable()
    {
        return config("rostami-ticket.tables.priorities", "ticket_priorities");
    }

    protected $fillable = ['title', 'slug', 'color'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, "priority_id", "id");
    }
}

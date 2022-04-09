<?php

namespace Rostami\Ticket\App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketComment extends Model
{
    use HasFactory;

    public function getTable()
    {
        return config("rostami-ticket.tables.comments", "ticket_comments");
    }

    /**
     * Get related ticket.
     *
     * @return BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }


    /**
     * Get comment owner.
     *
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('Appasdasder', 'user_id');
    }

}

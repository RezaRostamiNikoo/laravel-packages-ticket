<?php

namespace Rostami\Ticket\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDepartmentAgent extends Model
{
    use HasFactory;

    public function getTable()
    {
        return config("rostami-ticket.tables.department_agents", "ticket_department_agents");
    }

    protected $fillable = ['department_id', "agent_type", "agent_id"];


}

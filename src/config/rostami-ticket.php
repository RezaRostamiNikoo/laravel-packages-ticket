<?php

return [

    "tables" => [
        "departments" => "ticket_departments",
        "statuses" => "ticket_statuses",
        "priorities" => "ticket_priorities",
        "audits" => "ticket_audits",
        "department_agents" => "ticket_department_agents",
        "tickets" => "tickets",
        "comments" => "ticket_comments",
        "settings" => "ticket_settings",
    ],

    "statuses" => [
        'new' => 'جدید',
        'pending' => 'در حال بررسی',
        'closed' => 'بسته شده',
    ],
    "priorities" => [
        'low' => 'کم',
        'medium' => 'متوسط',
        'high' => 'زیاد',
        'emergency' => 'اورژانسی'
    ],


];

<?php

namespace App\Models\CalendarModel;

use CodeIgniter\Model;

class CalendarEventModel extends Model
{
    protected $table = 'calendar_events';
    protected $allowedFields = ['title', 'start', 'end', 'all_day'];
}

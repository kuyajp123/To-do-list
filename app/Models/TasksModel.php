<?php

namespace App\Models;

use CodeIgniter\Model;

class TasksModel extends Model
{
    protected $table      = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'title', 'description', 'status', 'created_at', 'deleted_at'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}

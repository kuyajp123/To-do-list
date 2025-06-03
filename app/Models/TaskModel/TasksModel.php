<?php

namespace App\Models\TaskModel;

use CodeIgniter\Model;

class TasksModel extends Model
{
    protected $table      = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'title', 'description', 'created_at'];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
}

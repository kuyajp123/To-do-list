<?php

namespace App\Models\TaskModel;

use CodeIgniter\Model;

class TodoTaskModel extends Model
{
    protected $table = 'todo_tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tasks_id', 'task_name', 'is_done'];
    protected $useTimestamps = false;
}

<?php

namespace App\Models\TaskModel;

use CodeIgniter\Model;

class GetTodoTaskModel extends Model
{
    protected $table = 'todo_tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tasks_id', 'task_name', 'is_done'];

    public function getUserTodoTasks($taskId)
    {
        return $this->where('tasks_id', $taskId)
            ->findAll();
    }
}

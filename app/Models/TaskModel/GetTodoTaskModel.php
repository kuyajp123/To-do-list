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
        return $this->db->table('todo_tasks')
            ->select('todo_tasks.id, todo_tasks.tasks_id, todo_tasks.task_name, todo_tasks.is_done')
            ->join('tasks', 'tasks.id = todo_tasks.tasks_id')
            ->where('tasks.user_id', session()->get('user_id'))
            ->where('todo_tasks.tasks_id', $taskId)
            ->get()
            ->getResult();
    }
}

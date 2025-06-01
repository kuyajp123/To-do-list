<?php

namespace App\Controllers;

use App\Models\TaskModel\TasksModel;
use App\Models\TaskModel\TodoTaskModel;
use App\Models\TaskModel\GetTaskModel;
use App\Models\TaskModel\GetTodoTaskModel;

class Home extends BaseController
{
    // View Routes
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        return view('/user/dashboard');
    }


    // API Routes
    public function saveTask()
    {
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $tasks = $this->request->getPost('tasks'); // This will be an array

        $taskModel = new TasksModel();
        $todoTaskModel = new TodoTaskModel();

        if (!empty($title)) {
            $taskModel->save([
                'user_id' => session()->get('user_id'),
                'title' => $title,
                'description' => $description,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $taskId = $taskModel->insertID();

            foreach ($tasks as $task) {
                $todoTaskModel->save([
                    'tasks_id' => $taskId,
                    'task_name' => $task,
                    'is_done' => 0,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tasks saved!');
    }

    public function getAllTasks()
    {
        $getTaskModel = new GetTaskModel();
        $tasks = $getTaskModel->getAllTask();

        return view('pages/tasks', ['tasks' => $tasks]);
    }

    public function getTodoTask($taskId)
    {
        $getTodotask = new GetTodoTaskModel();
        $task = $getTodotask->getUserTodoTasks($taskId);

        if ($task) {
            return $this->response->setJSON(['task' => $task]);
        } else {
            return $this->response->setJSON(['error' => 'Task not found'], 404);
        }
    }
}

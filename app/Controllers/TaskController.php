<?php

namespace App\Controllers;

use App\Models\TaskModel\TasksModel;
use App\Models\TaskModel\TodoTaskModel;
use App\Models\TaskModel\GetTaskModel;
use App\Models\TaskModel\GetTodoTaskModel;
use App\Models\TaskModel\SearchTaskModel;

class TaskController extends BaseController
{
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
        $search = $this->request->getGet('query');
        $taskModel = new GetTaskModel();
        $searchModel = new SearchTaskModel();

        if ($search) {
            $tasks = $searchModel->searchTasks($search);
        } else {
            $tasks = $taskModel->getAllTask();
        }

        return view('pages/tasks', [
            'tasks' => $tasks,
            'search' => $search
        ]);

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

    public function updateTodoTask()
    {
        $taskId = $this->request->getPost('task_id');
        $checkedTasks = $this->request->getPost('tasks') ?? [];

        $model = new TodoTaskModel();

        $model->where('tasks_id', $taskId)->set(['is_done' => 0])->update();

        if (!empty($checkedTasks)) {
            $model->whereIn('id', $checkedTasks)->set(['is_done' => 1])->update();
        }

        return $this->response->setJSON(['success' => true]);
    }

    public function edit()
    {
        $taskId = $this->request->getPost('task_id');

        $taskModel = new \App\Models\TaskModel\TasksModel();
        $todoModel = new \App\Models\TaskModel\TodoTaskModel();

        // 1. Update the task title/description
        $taskModel->update($taskId, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ]);

        // 2. Handle todo_tasks (edit/add/delete)
        $postData = $this->request->getPost();
        $existingTodoIds = []; // to track existing IDs

        foreach ($postData as $key => $value) {
            if (strpos($key, 'to-do-') === 0) {
                $todoId = str_replace('to-do-', '', $key);

                // if todoId is numeric, it's existing task, update it
                if (is_numeric($todoId)) {
                    $todoModel->update($todoId, [
                        'task_name' => $value
                    ]);
                    $existingTodoIds[] = $todoId;
                }
            }
        }

        // 3. Handle new tasks (if user added new fields)
        if (isset($postData['new_tasks']) && is_array($postData['new_tasks'])) {
            foreach ($postData['new_tasks'] as $newTask) {
                if (!empty(trim($newTask))) {
                    $todoModel->save([
                        'tasks_id' => $taskId,
                        'task_name' => $newTask,
                        'is_done' => 0
                    ]);
                }
            }
        }

        // 4. Handle removed tasks
        if (isset($postData['removed_tasks'])) {
            $removedIds = explode(',', $postData['removed_tasks']);
            foreach ($removedIds as $id) {
                if (is_numeric($id)) {
                    $todoModel->delete($id);
                }
            }
        }

        return redirect()->back()->with('message', 'Task updated successfully!');
    }

    public function deleteTask($taskId)
    {
        $taskModel = new TasksModel();
        $todoTaskModel = new TodoTaskModel();

        $taskModel->delete($taskId);
        $todoTaskModel->where('tasks_id', $taskId)->delete();

        return $this->response->setJSON(['success' => true]);
    }
}

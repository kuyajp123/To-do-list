<?php

namespace App\Controllers;

use App\Models\TaskModel\TasksModel;
use App\Models\TaskModel\TodoTaskModel;
use App\Models\TaskModel\GetTaskModel;
use App\Models\TaskModel\GetTodoTaskModel;
use App\Models\TaskModel\SearchTaskModel;

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

    public function schedule()
    {
        return view('/pages/schedule');
    }
}

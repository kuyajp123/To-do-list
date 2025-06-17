<?php

namespace App\Controllers;

use App\Models\TableModel\ActivityModel;

class Home extends BaseController
{
    // View Routes
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        $userId = session()->get('user_id');
        $activities = (new ActivityModel())->getUserActivities($userId);

        return view('/pages/dashboard', ['activities' => $activities]);
    }

    public function schedule()
    {
        return view('/pages/schedule');
    }
}

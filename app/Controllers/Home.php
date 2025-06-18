<?php

namespace App\Controllers;

use App\Models\TableModel\ActivityModel;
use App\Models\CalendarModel\CalendarEventModel;

class Home extends BaseController
{
    // View Routes
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        $search = $this->request->getGet('query');
        $activityModel = new ActivityModel();
        if ($search) {
            $activities = $activityModel->searchActivities($search);
            return view('/pages/dashboard', ['activities' => $activities, 'search' => $search]);
        }
        $userId = session()->get('user_id');
        $activities = (new ActivityModel())->getUserActivities($userId);

        return view('/pages/dashboard', ['activities' => $activities, 'search' => $search]);
    }

    public function schedule()
    {
        return view('/pages/schedule');
    }
}

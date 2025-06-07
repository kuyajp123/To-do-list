<?php

namespace App\Controllers;

use App\Models\CalendarModel\CalendarEventModel;

class CalendarController extends BaseController
{
    public function saveEvent()
    {
        $data = $this->request->getJSON();

        $model = new CalendarEventModel();
        $model->insert([
            'title'   => $data->title,
            'start'   => $data->start,
            'end'     => $data->end,
            'all_day' => $data->allDay ? 1 : 0
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }
}

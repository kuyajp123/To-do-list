<?php

namespace App\Controllers;

use App\Models\CalendarModel\CalendarEventModel;

class CalendarController extends BaseController
{
    public function saveEvent()
    {
        $data = $this->request->getJSON();
        $userId = session()->get('user_id');

        $model = new CalendarEventModel();
        $id = $model->insert([
            'user_id' => $userId,
            'title'   => $data->title,
            'start'   => $data->start,
            'end'     => $data->end,
            'all_day' => $data->allDay ? 1 : 0
        ]);

        return $this->response->setJSON(['status' => 'success', 'id' => $id]);
    }

    public function getEvents()
    {
        $userId = session()->get('user_id');
        $model = new CalendarEventModel();

        $events = $model->where('user_id', $userId)->findAll();

        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id'    => $event['id'],
                'title' => $event['title'],
                'start' => $event['start'],
                'end'   => $event['end'],
                'allDay' => (bool) $event['all_day']
            ];
        }

        return $this->response->setJSON($formattedEvents);
    }

    public function updateEvent()
    {
        $data = $this->request->getJSON();

        $model = new CalendarEventModel();
        $model->update($data->id, [
            'start' => $data->start,
            'end'   => $data->end,
            'all_day' => $data->allDay ? 1 : 0 // <-- add this
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function deleteEvent($id)
    {
        $model = new CalendarEventModel();

        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }
}

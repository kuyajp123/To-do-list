<?php

namespace App\Models\TaskModel;

use CodeIgniter\Model;

class GetTaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'description', 'created_at'];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    public function getAllTask()
    {
        return $this->select('*')
            ->where('user_id', session()->get('user_id'))
            ->findAll();
    }
}

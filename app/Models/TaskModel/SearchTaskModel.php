<?php

namespace App\Models\TaskModel;

use CodeIgniter\Model;

class SearchTaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'description', 'created_at'];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    public function searchTasks($search)
    {
        return $this->select('*')
            ->where('user_id', session()->get('user_id'))
            ->groupStart()
            ->like('title', $search)
            ->orLike('description', $search)
            ->groupEnd()
            ->findAll();
    }
}

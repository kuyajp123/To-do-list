<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'username', 'password', 'email', 'image'];
    protected $useTimestamps = false;

    public function getUserInfo($email)
    {
        return $this->select('name, username, email, image')
            ->where('email', $email)
            ->first();
    }
}

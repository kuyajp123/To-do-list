<?php

namespace App\Models\Email;

use CodeIgniter\Model;

class Verification extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'code', 'expires_at', 'created_at'];
    protected $useTimestamps = false;

    public function deleteExpired()
    {
        $this->where('expires_at <', date('Y-m-d H:i:s'))->delete();
    }

    public function createVerification($email, $code)
    {
        return $this->insert([
            'email' => $email,
            'code'   => $code,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function verifyCode($email, $code)
    {
        $this->deleteExpired(); // Clean up expired codes
        return $this->where('email', $email)
                    ->where('code', $code)
                    ->first();
    }

    public function deleteCode($email)
    {
        return $this->where('email', $email)->delete();
    }
}

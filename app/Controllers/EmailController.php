<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Email\Verification;
use App\Models\UserModel;
use Config\Services;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $recipient = $this->request->getPost('email');

        // Validate email
        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('password-reset')->with('errors', ['email' => 'Invalid email address']);
        }

        $verificationModel = new Verification();
        $userModel = new UserModel();
        $user = $userModel->getUserInfo($recipient);
        if (!$user) {
            return redirect()->to('password-reset')->with('error', 'Email not found');
        }

        // Generate 6-digit code
        $code = random_int(100000, 999999);

        // Store code in database
        $verificationModel->deleteExpired(); // Clean up expired codes
        $verificationModel->insert([
            'email' => $recipient,
            'code' => $code,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+30 minutes')), // Code expires in 30 minutes
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Send email
        $email = Services::email();
        $email->setFrom('johnpaulnaag10@gmail.com', 'John Paul Naag');
        $email->setTo($recipient);
        $email->setSubject('Password Reset Code');
        $email->setMessage("<h1>Password Reset</h1><p>Your verification code is: <b>$code</b></p><p>This code expires in 30 minutes.</p>");

        if ($email->send()) {
            return redirect()->to('email-sent')
                ->with('user', $user);
        } else {
            return redirect()->to('password-reset')->with('errors', ['email' => $email->printDebugger(['headers'])]);
        }
    }
}

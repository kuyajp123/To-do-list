<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    // View Routes
    public function register()
    {
        return view('auth/register', ['title' => 'Register']);
    }

    public function login()
    {
        return view('auth/login', ['title' => 'Login']);
    }



    // Handles Auth processes
    public function loginUser()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect('login')->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $this->request->getPost('username'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect('login')->withInput()->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('dashboard');
    }

    public function saveRegister()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'     => 'required',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'image'    => 'permit_empty|is_image[image]|max_size[image,2048]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $image = $this->request->getFile('profile_image');
        $newName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('uploads/profile_images', $newName);
        }

        $userModel->insert([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'email'    => $this->request->getPost('email'),
            'image'    => $newName,
        ]);

        $user = $userModel->where('username', $this->request->getPost('username'))->first();
        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/')->with('success', 'You have been logged out.');
    }

    // Password Reset
    public function enterEmail()
    {
        return view('auth/password/emailForm', ['title' => 'Reset Password']);
    }

    public function emailSent()
    {
        $user = session('user');

        if (!$user) {
            return redirect()->to('password-reset')->with('error', 'Please enter your email first.');
        }

        return view('auth/password/codeForm', ['title' => 'Email Sent', 'email' => $user['email']]);
    }

    public function verifyCode()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'code' => 'required|exact_length[6]|numeric'
        ];

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $email = $this->request->getPost('email');
        $code = $this->request->getPost('code');

        $verificationModel = new \App\Models\Email\Verification();
        $user = new UserModel();
        $username = $user->select('username')->where('email', $email)->first();
        $verification = $verificationModel->verifyCode($email, $code);

        if (!$verification || strtotime($verification['expires_at']) < time()) {
            return redirect()->back()->withInput()->with('error', 'Invalid or expired code.');
        }

        return view('auth/password/passwordForm', ['title' => 'Set New Password', 'email' => $email, 'username' => $username['username']]);
    }

    public function saveNewPassword()
    {
        $email = $this->request->getPost('email');

        if (!$email) {
            return redirect()->to('password-reset')->with('error', 'Please enter your email first.');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Save the new password
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $userModel->update($user['id'], [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
            ]);
        }

        session()->remove(['user', 'email']);
        $verificationModel = new \App\Models\Email\Verification();
        $verificationModel->deleteCode($email);

        return redirect()->to('login')->with('success', 'Password has been reset successfully.');
    }
}

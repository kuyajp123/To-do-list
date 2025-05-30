<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login', ['title' => 'Login']);
    }

    public function loginUser()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $this->request->getPost('username'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('profile')->with('success', 'Login successful.');
    }

    public function profile()
    {
        return view('/user/profile');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/')->with('success', 'You have been logged out.');
    }

    public function register()
    {
        return view('auth/register', ['title' => 'Register']);
    }

    public function saveRegister()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'     => 'required',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]'
        ];

        if (!$validation->setRules($rules)->run($this->request->getPost())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();

        $userModel->insert([
            'name'     => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        $user = $userModel->where('username', $this->request->getPost('username'))->first();
        $session = session();
        $session->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('/profile')->with('success', 'Account created successfully.');
    }
}

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

    public function dashboard()
    {
        return view('/user/dashboard');
    }

    public function tasks()
    {
        return view('/pages/tasks');
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
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'email'    => $this->request->getPost('email'),
            'image'    => $newName, // this can be null if no image uploaded
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
}

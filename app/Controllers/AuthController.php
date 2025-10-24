<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UsersModel;


class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UsersModel();
    }
    // load the home page
  public function index(){
    $data = [
        'title' => 'Login',
        'description' => 'Login to your account',
        'keywords' => 'login, authentication, user access',
        'auther' => 'Ministry of Internal Affairs - Liberia',
    ];

    // Check if the request is a POST
    if ($this->request->getMethod() === 'post') {
        // Validation rules and custom messages
        $validationRules = [
            'userEmail' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email address is required.',
                    'valid_email' => 'Please enter a valid email address.',
                ],
            ],
            'userPassword' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 6 characters long.',
                ],
            ],
        ];

        // Run validation
        if (!$this->validate($validationRules)) {
            $data['validation'] = $this->validator;
        } else {

            // Fetch form data
            $email = $this->request->getPost('userEmail');
            $password = $this->request->getPost('userPassword');

            // Search for user by email
            $user = $this->userModel->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch')
                                    ->where('userEmail', $email)->first();

            if ($user) {
                // Verify password
                if (password_verify($password, $user['userPassword'])) {
                    // Check account status (optional)
                    if ($user['userAccountActiveStatus'] != 1) {
                        return redirect()->back()
                            ->with('error', 'Please contact the head office in Monrovia for more information about your account.')
                            ->withInput();
                            exit();
                    }

                    // check if user branch is active
                    if ($user['isActive'] != 1) {
                        return redirect()->back()
                            ->with('error', 'Your branch is currently inactive. Please contact the head office for assistance.')
                            ->withInput();
                            exit();
                    }

                    // Set user session
                   session()->set('isLoggedIn', true);
                    session()->set('userData', $user);

                    return redirect()->to('/dashboard');
                } else {
                    return redirect()->back()
                        ->with('error', 'Invalid password.')
                        ->withInput();
                }
            } else {
                return redirect()->back()
                    ->with('error', 'User with this email was not found.')
                    ->withInput();
            }
        }
    }

    return view('public/auth', $data);
    }



      public function logout(){

        if(session()->has("isLoggedIn")){
            session()->remove('isLoggedIn');
            session()->remove('userData');
            return redirect()->to("/")->withInput()->with('success', "You're  logged out");
        }

    }
}

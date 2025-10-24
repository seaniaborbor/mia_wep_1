<?php

namespace App\Controllers;



class PublicController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
    }
    // load the home page
    public function index()
    {
        $data = [
            'title' => 'Home',
            'description' => 'Welcome to our marriage platform. Find your perfect match today!'
        ];

        return view('auth', $data);
    }

}

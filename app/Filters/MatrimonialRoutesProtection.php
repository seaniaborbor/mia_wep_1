<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MatrimonialRoutesProtection implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Filter logic before the controller runs
        if(!session()->has("isLoggedIn") || session()->get("userData")['userDepartment'] != "Matrimonial"){
            return redirect()->to('/auth')->with('error', ['You must login to continue']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Filter logic after the controller runs
    }
}

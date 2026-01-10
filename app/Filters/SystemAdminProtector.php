<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SystemAdminProtector implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Filter logic before the controller runs
        if(!session()->has("isLoggedIn") || session()->get("userData")['userDepartment'] != "System-Admin"){
            return redirect()->to('/auth')->with('error', ['Please login to access the System Admin Dashboard']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Filter logic after the controller runs
    }
}

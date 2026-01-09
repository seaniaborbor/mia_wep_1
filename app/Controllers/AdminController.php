<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\TraditionalCertificateModel;
use App\Models\UsersModel;
use App\Models\NotificationModel;

class AdminController extends BaseController
{
    protected $branchModel;
    protected $marriageModel;
    protected $divorceModel;
    protected $traditionalModel;
    protected $userModel;
    protected $notificationModel;

    public function __construct()
    {
        helper(['form', 'url', 'number', 'custom']);
        $this->branchModel = new BranchModel();
        $this->marriageModel = new MarriageCertificateModel();
        $this->divorceModel = new DivorceCertificateModel();
        $this->traditionalModel = new TraditionalCertificateModel();
        $this->userModel = new UsersModel();
        $this->notificationModel = new NotificationModel();

       
    }


    public function index()
    {
         $data['passLink'] = 'dashboard';

        return view('dashboard/admin_dashboard', $data);
    }

    // Display list of users for admin
    public function usersList()
    {
        $data['passLink'] = 'users';

        $branchId = session()->get('userData')['userBreanch'];
        $data['branch_name'] = "Head Office";

         if($this->request->getGet('branch') && !empty($this->request->getGet('branch'))){
            $branchId = $this->request->getGet('branch');

            $data['users_active'] = $this->userModel
                ->select('login_users.*, branchs_table.branchName')
                ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
                ->where('branchs_table.branchId',  $branchId)
                ->where('login_users.userAccountActiveStatus', 1)
                ->findAll();

            $data['users_inactive'] = $this->userModel
                ->select('login_users.*, branchs_table.branchName')
                ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
                ->where('branchs_table.branchId',  $branchId)
                ->where('login_users.userAccountActiveStatus', 0)
                ->findAll();

            $data['branch_name'] = $this->branchModel->find($branchId)['branchName'];

        }else{

            // get all the active users in the system
            $data['users_active'] = $this->userModel
                ->select('login_users.*, branchs_table.branchName')
                ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
                ->where('login_users.userAccountActiveStatus', 1)
                ->findAll();
            // get all the inactive users in the system
            $data['users_inactive'] = $this->userModel
                ->select('login_users.*, branchs_table.branchName')
                ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
                ->where('login_users.userAccountActiveStatus', 0)
                ->findAll();
        }
            
        $data['allBranches'] = $this->branchModel->findAll();

        $data['total_active_users'] = count($data['users_active']);
        $data['total_inactive_users'] = count($data['users_inactive']);
        $data['total_users'] = $data['total_active_users'] + $data['total_inactive_users'];

        return view('dashboard/user_list_for_admin', $data);
    }


    // view branches for admin
    public function branchList()
    {
        $data['passLink'] = 'branches';

        // active branches
        $data['branches_active'] = $this->branchModel
            ->where('isActive', 1)
            ->findAll();
        
        // inactive branches
        $data['branches_inactive'] = $this->branchModel
            ->where('isActive', 0)
            ->findAll();
        
        // total branches
        $data['total_active_branches'] = count($data['branches_active']);
        $data['total_inactive_branches'] = count($data['branches_inactive']);
        $data['total_branches'] = $data['total_active_branches'] + $data['total_inactive_branches'];

        // print_r($data);
        // die();

        return view('dashboard/admin_branch_list_for', $data);
    }

}
<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\UsersModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\FileModel;
use App\Models\TraditionalCertificateModel;

class SystemAdminController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
        $this->branchModel = new BranchModel();
        $this->userModel = new UsersModel();
        $this->weddingCertModel = new MarriageCertificateModel();
        $this->divorceCertificateModel = new DivorceCertificateModel();
        $this->fileModel = new FileModel();
        $this->traditionalCertModel = new TraditionalCertificateModel();
    }

    public function index()
    {
       $data = [];

        $data['title'] = 'System Admin';
        $data['passLink'] = 'Admin';

        $data['totalBranchesActive'] = $this->branchModel->where('isActive', 1)->countAllResults() ?? 0;
        $data['totalBranchesInactive'] = $this->branchModel->where('isActive', 0)->countAllResults() ?? 0;
        $data['totalUserActive'] = $this->userModel->where('userAccountActiveStatus', 1)->countAllResults() ?? 0;
        $data['totalUserInactive'] = $this->userModel->where('userAccountActiveStatus', 0)->countAllResults() ?? 0;

        // marriage certificate stats
        $data['totalMarriageCertificateLogged'] = $this->weddingCertModel->countAllResults() ?? 0;
        $data['totalMarriageCertificateUncompleted'] = $this->weddingCertModel
                                                    ->groupStart()
                                                        ->where('SIGNA', null)
                                                        ->orWhere('SIGNB', null)
                                                        ->orWhere('SIGNC', null)
                                                    ->groupEnd()
                                                    ->countAllResults();
        $data['totalMarriageCertificateCompletedButNotIssued'] = $this->weddingCertModel
                                                    ->where('SIGNA !=', null)
                                                    ->where('SIGNB !=', null)
                                                    ->where('SIGNC !=', null)
                                                    ->where('isWedCertIssued', null)
                                                    ->countAllResults();
        $data['totalMarriageCertificateIssued'] = $this->weddingCertModel->where('isWedCertIssued', 1)->countAllResults() ?? 0;

        // divorce certificate stats
        $data['totalDivorceCertificateLogged'] = $this->divorceCertificateModel->countAllResults() ?? 0;
        $data['totalDivorceCertificatePending'] = $this->divorceCertificateModel
                                                    ->groupStart()
                                                        ->where('divorceSIGN_A', null)
                                                        ->orWhere('divorceSIGN_B', null)
                                                        ->orWhere('divorceSIGN_C', null)
                                                    ->groupEnd()
                                                    ->countAllResults();
                                                    
        $data['totalDivorceCertificateCompletedButNotIssued'] = $this->divorceCertificateModel
                                                    ->where('divorceSIGN_A !=', null)
                                                    ->where('divorceSIGN_B !=', null)
                                                    ->where('divorceSIGN_C !=', null)
                                                    ->where('divorcedateOfDivorce', null)
                                                    ->countAllResults() ?? 0;
        $data['totalDivorceCertificateIssued'] = $this->divorceCertificateModel->where('divorceissuanceDate !=', null)->countAllResults() ?? 0;

        // traditional certificate stats
        $data['totalTraditionalCertificateIssued'] = $this->traditionalCertModel->where('tradCertDateIssued !=', null)->countAllResults() ?? 0;
        $data['totalTraditionalCertificateLogged'] = $this->traditionalCertModel->countAllResults() ?? 0;
        $data['totalTraditionalCertificatePending'] = $this->traditionalCertModel
                                                    ->groupStart()
                                                        ->where('tradCertSignatoryA', null)
                                                        ->orWhere('tradCertSignatoryB', null)
                                                        ->orWhere('tradCertSignatoryC', null)
                                                    ->groupEnd()
                                                    ->countAllResults() ?? 0;

        $data['totalTraditionalCertificateCompletedButNotIssued'] = $this->traditionalCertModel
                                                    ->where('tradCertSignatoryA !=', null)
                                                    ->where('tradCertSignatoryB !=', null)
                                                    ->where('tradCertSignatoryC !=', null)
                                                    ->where('tradCertDateIssued', null)
                                                    ->countAllResults() ?? 0;

        // recent logs
        $data['recentMarriageCertificates'] = $this->weddingCertModel->orderBy('marriage_cert_id', 'DESC')->limit(50)->findAll();
        $data['recentDivorceCertificates'] = $this->divorceCertificateModel->orderBy('divorceCertID', 'DESC')->limit(50)->findAll();
        $data['recentTraditionalCertificates'] = $this->traditionalCertModel->orderBy('tradCertID', 'DESC')->limit(50)->findAll();

        return view('dashboard/system_admin_dashboard', $data);
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
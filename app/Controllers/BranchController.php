<?php

namespace App\Controllers;

use App\Models\BranchModel;
use CodeIgniter\Controller;
use App\Models\MarriageCertificateModel;
use App\Models\UsersModel;
use App\Models\DivorceCertificateModel;



class BranchController extends Controller
{
    public function __construct()
    {
        helper(['form', 'url', 'security']);
        $this->branchModel = new BranchModel();
        $this->weddingCertModel = new MarriageCertificateModel();
        $this->userModel = new UsersModel();
        $this->divorceCertModel = new DivorceCertificateModel();
    }

    public function index()
    {
       

        $data['title'] = 'Branches';
        $data['passLink'] = 'branches';
        
        $data['branches'] = $this->branchModel
            ->select('branchs_table.*, COUNT(login_users.userId) as total_users')
            ->join('login_users', 'login_users.userBreanch = branchs_table.branchId', 'left')
            ->groupBy('branchs_table.branchId')
            ->orderBy('branchs_table.branchId', 'DESC')
            ->findAll();
        
        $data['total_branches'] = $this->branchModel->countAllResults();
        $data['total_active_branches'] = $this->branchModel->where('isActive', 1)->countAllResults();
        $data['total_inactive_branches'] = $this->branchModel->where('isActive', 0)->countAllResults();

        // print_r($data['branches']);
        // exit();

       

        return view('dashboard/branches_list', $data);
    }

    public function view($branch_id)
    {
        // Validate branch_id to prevent SQL injection
        if (!is_numeric($branch_id)) {
            return redirect()->to('/dashboard/branches')->with('error', 'Invalid branch identifier');
        }

        $data['title'] = 'View Branch';
        $data['passLink'] = 'branches';

        $branch = $this->branchModel->where('branchId', $branch_id)
                  ->join('login_users', 'login_users.userId = branchs_table.branchCreatedBy')->first();
        
        if (!$branch) {
            return redirect()->to('/dashboard/branches')->with('error', 'Branch not found or may have been deleted');
        }
        
        // Allow access only if user is from this branch or from head office (branch 1)
        if (
            session()->get('userData')['userBreanch'] != $branch_id &&
            session()->get('userData')['userBreanch'] != 1
        ) {
            return redirect()->to('/dashboard/branches')->with('error', 'Unauthorized access to branch details');
        }

        $data['total_inactive_user'] = $this->branchModel->db->table('login_users')
            ->where('userBreanch', $branch_id)
            ->where('userAccountActiveStatus', 0)
            ->countAllResults();

        $data['total_active_user'] = $this->branchModel->db->table('login_users')
            ->where('userBreanch', $branch_id)
            ->where('userAccountActiveStatus', 1)
            ->countAllResults();
        
        $data['branch_marriage_certificates'] = $this->weddingCertModel
            ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')
            ->where('marriage_certificates.cert_branch', $branch_id)
            ->orderBy('marriage_certificates.marriage_cert_id', 'DESC')
            ->findAll();

        $data['branch_divorce_certificates'] = $this->divorceCertModel
            ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
            ->where('divorce_certificates.divorcebreanch_id', $branch_id)
            ->orderBy('divorce_certificates.divorcecreated_at', 'DESC')
            ->findAll();
            
       

        $data['branch_info'] = $branch;

        
        $data['users_active'] = $this->userModel
            ->select('login_users.*, branchs_table.branchName')
            ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
            ->where('branchs_table.branchId', $branch_id)
            ->where('login_users.userAccountActiveStatus', 1)
            ->findAll();

        $data['users_inactive'] = $this->userModel
            ->select('login_users.*, branchs_table.branchName')
            ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
            ->where('branchs_table.branchId', $branch_id)
            ->where('login_users.userAccountActiveStatus', 0)
            ->findAll();

        

        return view('dashboard/view_a_branch', $data);
    }

    public function create()
    {
        // Strict access control
        if (session()->get('userData')['userBreanch'] != 1 || 
            session()->get('userData')['userAccountType'] != "SIGNC") {
            return redirect()->back()->with("error", "You don't have permission to create branches. Only the head office can.");
        }

        $data['title'] = 'Create Branch';
        $data['passLink'] = 'branches';

        // Enhanced validation rules with XSS filtering
        $validationRules = [
            'branchName' => [
                'label' => 'Branch Name',
                'rules' => 'required|min_length[3]|max_length[255]|is_unique[branchs_table.branchName]',
                'errors' => [
                    'required' => 'Branch name is required.',
                    'min_length' => 'Branch name must be at least 3 characters.',
                    'max_length' => 'Branch name cannot exceed 255 characters.',
                    'is_unique' => 'Branch name is already taken or assigned to another location'
                ]
            ],
            'branchCounty' => [
                'label' => 'County',
                'rules' => 'required|in_list[Bomi,Bong,Gbarpolu,Grand Bassa,Grand Cape Mount,Grand Gedeh,Grand Kru,Lofa,Margibi,Maryland,Montserrado,Nimba,River Cess,River Gee,Sinoe]',
                'errors' => [
                    'required' => 'County is required.',
                    'in_list' => 'Please select a valid county from the list.'
                ]
            ],
            'branchCityOrTown' => [
                'label' => 'City or Town',
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'City or town is required.',
                    'min_length' => 'City or town name must be at least 2 characters.',
                    'max_length' => 'City or town name cannot exceed 255 characters.'
                ]
            ],
            'branchContact' => [
                'label' => 'Contact Number',
                'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\)\s]+$/]',
                'errors' => [
                    'required' => 'Contact number is required.',
                    'min_length' => 'Contact number must be at least 8 digits.',
                    'max_length' => 'Contact number cannot exceed 20 digits.',
                    'regex_match' => 'Please enter a valid phone number format.'
                ]
            ],
            'branchEmail' => [
                'label' => 'Email Address',
                'rules' => 'required|valid_email|max_length[255]|is_unique[branchs_table.branchEmail]',
                'errors' => [
                    'required' => 'Email address is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email address cannot exceed 255 characters.',
                    'is_unique' => 'This email is already registered to another branch.'
                ]
            ],
            'isActive' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'Status is required.',
                    'in_list' => 'Please select a valid status.'
                ]
            ]
        ];

        if ($this->request->getMethod() === 'post') {
            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            // Prepare data with security measures
            $postData = $this->request->getPost();
            $saveData = [
                'branchName' => esc($postData['branchName']),
                'branchCounty' => esc($postData['branchCounty']),
                'branchCityOrTown' => esc($postData['branchCityOrTown']),
                'branchContact' => esc($postData['branchContact']),
                'branchEmail' => esc($postData['branchEmail']),
                'isActive' => (int)$postData['isActive'],
                'branchCreatedBy' => session()->get('userData')['userId'],
                'branchCreatedAt' => date('Y-m-d H:i:s')
            ];

            if ($this->branchModel->save($saveData)) {
                return redirect()->to('/dashboard/branches')->with('success', 'Branch created successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to create branch. Please try again.');
            }           
        }

        return view('dashboard/create_branch', $data);
    }

    public function edit($branch_id)
    {
        // Validate branch_id
        if (!is_numeric($branch_id)) {
            return redirect()->to('/dashboard/branches')->with('error', 'Invalid branch identifier');
        }

        // Strict access control
        if (session()->get('userData')['userBreanch'] != 1 || 
            session()->get('userData')['userAccountType'] != "SIGNC") {
            return redirect()->back()->with("error", "You do not have permission to edit branches. Only the Assistant Minister at the Head Office can.");
        }

        $branch = $this->branchModel->where('branchId', $branch_id)->first();
        if (!$branch) {
            return redirect()->to('/dashboard/branches')->with('error', 'Branch not found or may have been deleted');
        }

        $data['title'] = 'Edit Branch';
        $data['passLink'] = 'branches';
        $data['branch'] = $branch;

        // Enhanced validation rules for update
        $validationRules = [
            'branchName' => [
                'label' => 'Branch Name',
                'rules' => "required|min_length[3]|max_length[255]|is_unique[branchs_table.branchName,branchId,{$branch_id}]",
                'errors' => [
                    'required' => 'Branch name is required.',
                    'min_length' => 'Branch name must be at least 3 characters.',
                    'max_length' => 'Branch name cannot exceed 255 characters.',
                    'is_unique' => 'Branch name is already taken or assigned to another location'
                ]
            ],
            'branchCounty' => [
                'label' => 'County',
                'rules' => 'required|in_list[Bomi,Bong,Gbarpolu,Grand Bassa,Grand Cape Mount,Grand Gedeh,Grand Kru,Lofa,Margibi,Maryland,Montserrado,Nimba,River Cess,River Gee,Sinoe]',
                'errors' => [
                    'required' => 'County is required.',
                    'in_list' => 'Please select a valid county from the list.'
                ]
            ],
            'branchCityOrTown' => [
                'label' => 'City or Town',
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'City or town is required.',
                    'min_length' => 'City or town name must be at least 2 characters.',
                    'max_length' => 'City or town name cannot exceed 255 characters.'
                ]
            ],
            'branchContact' => [
                'label' => 'Contact Number',
                'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\)\s]+$/]',
                'errors' => [
                    'required' => 'Contact number is required.',
                    'min_length' => 'Contact number must be at least 8 digits.',
                    'max_length' => 'Contact number cannot exceed 20 digits.',
                    'regex_match' => 'Please enter a valid phone number format.'
                ]
            ],
            'branchEmail' => [
                'label' => 'Email Address',
                'rules' => "required|valid_email|max_length[255]|is_unique[branchs_table.branchEmail,branchId,{$branch_id}]",
                'errors' => [
                    'required' => 'Email address is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email address cannot exceed 255 characters.',
                    'is_unique' => 'This email is already registered to another branch.'
                ]
            ],
            'isActive' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'Status is required.',
                    'in_list' => 'Please select a valid status.'
                ]
            ]
        ];

        if ($this->request->getMethod() === 'post') {
            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            // Prepare data with security measures
            $postData = $this->request->getPost();
            $updateData = [
                'branchId' => $branch_id,
                'branchName' => esc($postData['branchName']),
                'branchCounty' => esc($postData['branchCounty']),
                'branchCityOrTown' => esc($postData['branchCityOrTown']),
                'branchContact' => esc($postData['branchContact']),
                'branchEmail' => esc($postData['branchEmail']),
                'isActive' => (int)$postData['isActive'],
                'branchUpdatedBy' => session()->get('userData')['userId'],
                'branchUpdatedAt' => date('Y-m-d H:i:s')
            ];

            if ($this->branchModel->save($updateData)) {
                return redirect()->to('/dashboard/branches')->with('success', 'Branch updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update branch. Please try again.');
            }
        }

        return view('dashboard/edit_branch', $data);
    }

    public function deactivate($branch_id)
    {
        // Validate branch_id
        if (!is_numeric($branch_id)) {
            return redirect()->to('/dashboard/branches')->with('error', 'Invalid branch identifier');
        }

        // Strict access control
        if (session()->get('userData')['userBreanch'] != 1 || 
            session()->get('userData')['userAccountType'] != "SIGNC") {
            return redirect()->back()->with("error", "You do not have permission to deactivate branches. Only the Assistant Minister at the Head Office can.");
        }

        $branch = $this->branchModel->where('branchId', $branch_id)->first();
        if (!$branch) {
            return redirect()->to('/dashboard/branches')->with('error', 'Branch not found or may have been deleted');
        }

        if( $branch['isActive'] == 0 ) {
            $branch['isActive'] = 1;
        }else {
            $branch['isActive'] = 0;
        }

        $branch['branchUpdatedBy'] = session()->get('userData')['userId'];
        $branch['branchUpdatedAt'] = date('Y-m-d H:i:s');

        if ($this->branchModel->update($branch_id, $branch)) {
            return redirect()->back()->with('success', 'Branch deactivated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to deactivate branch. Please try again.');
        }
    }
}
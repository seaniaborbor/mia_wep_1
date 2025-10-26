<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\UsersModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;


class UserController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
        $this->branchModel = new BranchModel();
        $this->userModel = new UsersModel();
        $this->weddingCertModel = new MarriageCertificateModel();
        $this->divorceCertModel = new DivorceCertificateModel();
    }

    public function index()
    {
        $data['title'] = 'Users List';
        $data['passLink'] = 'users';

        $data['users_active'] = $this->userModel
            ->select('login_users.*, branchs_table.branchName')
            ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
            ->where('branchs_table.branchId', session()->get('userData')['userBreanch'])
            ->where('login_users.userAccountActiveStatus', 1)
            ->findAll();

        $data['users_inactive'] = $this->userModel
            ->select('login_users.*, branchs_table.branchName')
            ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch', 'left')
            ->where('branchs_table.branchId', session()->get('userData')['userBreanch'])
            ->where('login_users.userAccountActiveStatus', 0)
            ->findAll();



        return view('dashboard/users_list', $data);
    }

    public function view($user_id)
    {
        $data['title'] = 'View User';
        $data['passLink'] = 'users';

        // Fetch user with branch info
        $data['user'] = $this->userModel
            ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch')
            ->where('login_users.userId', $user_id)
            ->first();

        $user = $data['user'];

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Initialize marriage_certificates
        $data['marriage_certificates'] = [];

        // Use correct column names and comparisons
        switch ($user['userAccountType']) {
            case "ENTRY":
                $data['marriage_certificates'] = $this->weddingCertModel
                    ->where('ENTRY', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')
                    ->findAll();
                break;

            case "SIGNA":
                $data['marriage_certificates'] = $this->weddingCertModel
                    ->where('SIGNA_id', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')
                    ->findAll();
                break;

            case "SIGNB":
                $data['marriage_certificates'] = $this->weddingCertModel
                    ->where('SIGNB_id', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')
                    ->findAll();
                break;

            case "SIGNC":
                $data['marriage_certificates'] = $this->weddingCertModel
                    ->where('SIGNC_id', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')
                    ->findAll();
                break;
        }

        // divorce certificate log base on user account type
        $data['divorce_certificates'] = [];
        switch ($user['userAccountType']) {
            case "ENTRY":
                $data['divorce_certificates'] = $this->divorceCertModel
                    ->where('divorcecreated_by', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                    ->findAll();
                break;

            case "SIGNA":
                $data['divorce_certificates'] = $this->divorceCertModel
                    ->where('divorceSIGN_A_ID', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                    ->findAll();
                break;

            case "SIGNB":
                $data['divorce_certificates'] = $this->divorceCertModel
                    ->where('divorceSIGN_B_ID', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                    ->findAll();
                break;

            case "SIGNC":
                $data['divorce_certificates'] = $this->divorceCertModel
                    ->where('divorceSIGN_C_ID', $user['userId'])
                    ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                    ->findAll();
                break;
        }


        // only the user whose profile is this can access
        // Otherwise, only any user from branch 1 can access
        if (session()->get('userData')['userBreanch'] == 1 || session()->get('userData')['userBreanch'] ==  $user['userBreanch']) {
            return view('dashboard/view_user', $data);
        } else {
            return redirect()->back()->with('error', 'The request you made violates the policy of using this plartform. Please stop');
            exit();
        }
    }

    public function create()
    {
        $data['title'] = 'Create User';
        $data['passLink'] = 'users';
        $data['branches'] = $this->branchModel->findAll();

        $userData = session()->get('userData');

        if ($userData['userBreanch'] != 1) {
            return redirect()->back()->with('error', 'Access denied: Only users from the head office can create users.');
            exit();
        }

        if (!session()->has('userData') || session()->get('userData')['userAccountType'] !== 'SIGNC') {
            return redirect()->back()->with('error', 'Only the assistant minister for legal affair can create user accounts.');
            exit();
        }

        $validationRules = [
            'userFullName' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Full name is required.',
                    'min_length' => 'Full name must be at least 3 characters.',
                    'max_length' => 'Full name cannot exceed 100 characters.'
                ]
            ],
            'userEmail' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[login_users.userEmail]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Enter a valid email address.',
                    'is_unique' => 'This email is already in use.'
                ]
            ],
            'userPhone' => [
                'label' => 'Phone Number',
                'rules' => 'required|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'Phone number is required.',
                    'min_length' => 'Phone number must be at least 10 digits.',
                    'max_length' => 'Phone number cannot exceed 15 digits.'
                ]
            ],
            'userPosition' => [
                'label' => 'Position',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Position is required.',
                    'min_length' => 'Position must be at least 3 characters.',
                    'max_length' => 'Position cannot exceed 100 characters.'
                ]
            ],
            'userPassword' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 6 characters.'
                ]
            ],
            'userBreanch' => [
                'label' => 'Branch',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Branch selection is required.'
                ]
            ],
            'userAccountType' => [
                'label' => 'Account Type',
                'rules' => 'required|in_list[SIGNA,SIGNB,SIGNC,ENTRY,tradCertSignatoryA,tradCertSignatoryB,tradCertSignatoryC,tradCertEntryClerk]',
                'errors' => [
                    'required' => 'Account type is required.',
                    'in_list' => 'Choose a valid account type.'
                ]
            ],
            'userPicture' => [
                'label' => 'Profile Picture',
                'rules' => 'uploaded[userPicture]|is_image[userPicture]|max_size[userPicture,2048]',
                'errors' => [
                    'uploaded' => 'Profile picture is required.',
                    'is_image' => 'Profile picture must be an image.',
                    'max_size' => 'Profile picture cannot exceed 2MB.'
                ]
            ],
            'userSignature' => [
                'label' => 'Signature',
                'rules' => 'uploaded[userSignature]|is_image[userSignature]|max_size[userSignature,2048]',
                'errors' => [
                    'uploaded' => 'Signature image is required.',
                    'is_image' => 'Signature must be an image.',
                    'max_size' => 'Signature cannot exceed 2MB.'
                ]
            ],
            'userApplicationFile' => [
                'label' => 'Application File',
                'rules' => 'uploaded[userApplicationFile]|ext_in[userApplicationFile,pdf]|max_size[userApplicationFile,4096]',
                'errors' => [
                    'uploaded' => 'Application file is required.',
                    'ext_in' => 'Application must be a PDF file.',
                    'max_size' => 'Application file cannot exceed 4MB.'
                ]
            ],
            'userAccountActiveStatus' => [
                'label' => 'Account Status',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => 'Account status is required.',
                    'in_list' => 'Choose either Active or Inactive.'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post') {
            if (!$this->validate($validationRules)) {
                $data['validation'] = $this->validator;
            } else {
                // Handle file uploads
                $picture = $this->request->getFile('userPicture');
                $signature = $this->request->getFile('userSignature');
                $application = $this->request->getFile('userApplicationFile');

                $pictureName = $picture->getRandomName();
                $signatureName = $signature->getRandomName();
                $applicationName = $application->getRandomName();

                $picture->move('uploads/users/pictures/', $pictureName);
                $signature->move('uploads/users/signatures/', $signatureName);
                $application->move('uploads/users/applications/', $applicationName);

                // Check if an active user with the same branch and account type exists
                $existingUser = $this->userModel
                    ->where('userBreanch', $this->request->getPost('userBreanch'))
                    ->where('userAccountType', $this->request->getPost('userAccountType'))
                    ->where('userAccountActiveStatus', 1)
                    ->first();

                if ($existingUser) {
                    return redirect()->back()->with('error', 'An active user with this account type already exists in the selected branch.');
                }

                $userData = session()->get('userData');
                $postBranch = $this->request->getPost('userBreanch');

                if (
                    !(
                        ($userData['userBreanch'] == 1 && $userData['userAccountType'] == "SIGNC")
                    )
                ) {
                    return redirect()->back()->with('error', 'You dont have the permission to create an account');
                    exit();
                }

                // Save user
                if ($this->userModel->save([
                    'userFullName' => $this->request->getPost('userFullName'),
                    'userEmail' => $this->request->getPost('userEmail'),
                    'userPhone' => $this->request->getPost('userPhone'),
                    'userPosition' => $this->request->getPost('userPosition'),
                    'userPassword' => password_hash($this->request->getPost('userPassword'), PASSWORD_DEFAULT),
                    'userBreanch' => $this->request->getPost('userBreanch'),
                    'userAccountType' => $this->request->getPost('userAccountType'),
                    'userPicture' => $pictureName,
                    'userSignature' => $signatureName,
                    'userApplicationFile' => $applicationName,
                    'userAccountActiveStatus' => $this->request->getPost('userAccountActiveStatus'),
                    'userCreatedBy' => session()->get('userData')['userId'] ?? 'System',
                    'userDateCreated' => date('Y-m-d H:i:s')
                ])) {
                    return redirect()->back()->with('success', 'User account created successfully.');
                } else {
                    return redirect()->back()->with('error', 'User failed to create');
                }
            }
        }

        return view('dashboard/create_user', $data);
    }

    public function edit($user_id)
    {
        $data['title'] = 'Edit User';
        $data['passLink'] = 'users';
        $data['branches'] = $this->branchModel->findAll();
        $data['user'] = $this->userModel->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch')->find($user_id);

        if (!$data['user']) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $allow_edit = false;
        $userData = session()->get('userData');

        // Only the user whose profile is this or only user from branch 1 with account type SIGNC can access
        if ($userData['userBreanch'] == $data['user']['userBreanch']) {
            if (
                $userData['userId'] == $user_id ||
                ($userData['userAccountType'] == 'SIGNC' && $userData['userBreanch'] == 1)
            ) {
                $allow_edit = true;
            } else {
                return redirect()->back()->with('error', 'You do not have permission to edit this user.');
            }
        }

        if (!$allow_edit) {
            return redirect()->back()->with('error', 'You do not have permission to edit this user.');
        }

        $validationRules = [
            'userFullName' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Full name is required.',
                    'min_length' => 'Full name must be at least 3 characters.',
                    'max_length' => 'Full name cannot exceed 100 characters.'
                ]
            ],
            'userPhone' => [
                'label' => 'Phone Number',
                'rules' => 'required|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'Phone number is required.',
                    'min_length' => 'Phone number must be at least 10 digits.',
                    'max_length' => 'Phone number cannot exceed 15 digits.'
                ]
            ],
            'userPosition' => [
                'label' => 'Position',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Position is required.',
                    'min_length' => 'Position must be at least 3 characters.',
                    'max_length' => 'Position cannot exceed 100 characters.'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post') {
            // Only validate password if provided
            if ($this->request->getPost('userPassword')) {
                $validationRules['userPassword'] = [
                    'label' => 'Password',
                    'rules' => 'min_length[6]',
                    'errors' => [
                        'min_length' => 'Password must be at least 6 characters.'
                    ]
                ];
            }

            // Optional file uploads
            if ($this->request->getFile('userPicture')->isValid()) {
                $validationRules['userPicture'] = [
                    'label' => 'Profile Picture',
                    'rules' => 'is_image[userPicture]|max_size[userPicture,2048]',
                    'errors' => [
                        'is_image' => 'Profile picture must be an image.',
                        'max_size' => 'Profile picture cannot exceed 2MB.'
                    ]
                ];
            }
            if ($this->request->getFile('userSignature')->isValid()) {
                $validationRules['userSignature'] = [
                    'label' => 'Signature',
                    'rules' => 'is_image[userSignature]|max_size[userSignature,2048]',
                    'errors' => [
                        'is_image' => 'Signature must be an image.',
                        'max_size' => 'Signature cannot exceed 2MB.'
                    ]
                ];
            }
            if ($this->request->getFile('userApplicationFile')->isValid()) {
                $validationRules['userApplicationFile'] = [
                    'label' => 'Application File',
                    'rules' => 'ext_in[userApplicationFile,pdf]|max_size[userApplicationFile,4096]',
                    'errors' => [
                        'ext_in' => 'Application must be a PDF file.',
                        'max_size' => 'Application file cannot exceed 4MB.'
                    ]
                ];
            }

            if (!$this->validate($validationRules)) {
                $data['validation'] = $this->validator;
            } else {
                $updateData = [
                    'userFullName' => $this->request->getPost('userFullName'),
                    'userPhone' => $this->request->getPost('userPhone'),
                    'userPosition' => $this->request->getPost('userPosition'),
                    'userAccountLastModifiedBy' => session()->get('userData')['userId'] ?? 'System',
                ];

                if ($this->request->getPost('userPassword')) {
                    $updateData['userPassword'] = password_hash($this->request->getPost('userPassword'), PASSWORD_DEFAULT);
                }

                // Handle file uploads if new files are uploaded
                $picture = $this->request->getFile('userPicture');
                if ($picture && $picture->isValid()) {
                    $pictureName = $picture->getRandomName();
                    $picture->move('uploads/users/pictures/', $pictureName);
                    $updateData['userPicture'] = $pictureName;
                }

                $signature = $this->request->getFile('userSignature');
                if ($signature && $signature->isValid()) {
                    $signatureName = $signature->getRandomName();
                    $signature->move('uploads/users/signatures/', $signatureName);
                    $updateData['userSignature'] = $signatureName;
                }

                $application = $this->request->getFile('userApplicationFile');
                if ($application && $application->isValid()) {
                    $applicationName = $application->getRandomName();
                    $application->move('uploads/users/applications/', $applicationName);
                    $updateData['userApplicationFile'] = $applicationName;
                }

                // Check if an active user with the same branch and account type exists
                $existingUser = $this->userModel
                    ->where('userAccountActiveStatus', 1)
                    ->where('login_users.userId', $user_id)
                    ->first();

                if (!$existingUser) {
                    return redirect()->back()->with('error', 'An account once blocked cannot be activated or modified');
                }

                if ($this->userModel->update($user_id, $updateData)) {
                    return redirect()->back()->with('success', 'User updated successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to update user.');
                }
            }
        }

        return view('dashboard/edit_user', $data);
    }

    public function activate($user_id)
    {
        $user = $this->userModel->find($user_id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // if the user branch is not 1 and the user account type is not SIGNC, deny access
        if (session()->get('userData')['userBreanch'] != 1 || session()->get('userData')['userAccountType'] != 'SIGNC') {
            return redirect()->back()->with('error', 'You do not have permission to activate or deactivate user accounts.');
            exit();
        }

        // if user account is inactive, check if there is an active user with the same branch and account type
        if (!$user['userAccountActiveStatus']) {
            $existingUser = $this->userModel
                ->where('userBreanch', $user['userBreanch'])
                ->where('userAccountType', $user['userAccountType'])
                ->where('userAccountActiveStatus', 1)
                ->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'An active user with this account type already exists in the selected branch.');
            }
        }

        // Toggle the active status
        $newStatus = !$user['userAccountActiveStatus'];

        if ($this->userModel->update($user_id, [
            'userAccountActiveStatus' => $newStatus,
            'userAccountLastModifiedBy' => session()->get('userData')['userId'] ?? 'System',
            'userAccountLastModifiedDate' => date('Y-m-d H:i:s')
        ])) {
            return redirect()->back()->with('success', 'User account status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user account status.');
        }
    }
}

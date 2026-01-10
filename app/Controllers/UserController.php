<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\UsersModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use Config\Services;

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

        $branchId = session()->get('userData')['userBreanch'];

         if($this->request->getGet('branch') && !empty($this->request->getGet('branch'))){
            $branchId = $this->request->getGet('branch');
        }

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

         $data['breanchDetail'] = $this->branchModel->find($branchId);
         $data['allBranches'] = $this->branchModel->findAll();

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
            return redirect()->back()->with('error', 'The request you made violates the policy of using this platform. Please stop');
            exit();
        }
    }

    public function create()
    {
        $data['title'] = 'Create User';
        $data['passLink'] = 'users';
        $data['branches'] = $this->branchModel->findAll();

        $userData = session()->get('userData');

        // Define signatory roles that require signature
        $signatoryRoles = ['SIGNA', 'SIGNB', 'SIGNC', 'tradCertSignatoryA', 'tradCertSignatoryB', 'tradCertSignatoryC'];

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
                'rules' => 'required|min_length[10]|max_length[15]|is_unique[login_users.userPhone]',
                'errors' => [
                    'required' => 'Phone number is required.',
                    'min_length' => 'Phone number must be at least 10 digits.',
                    'max_length' => 'Phone number cannot exceed 15 digits.',
                    'is_unique' => 'Phone number already used by another staff.'
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
            'userDepartment' => [
                'label' => 'Department',
                'rules' => 'required|in_list[Registrar,Matrimonial,Cultural,System-Admin]',
                'errors' => [
                    'required' => 'Department selection is required.',
                    'in_list' => 'Please select a valid department.'
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
                'rules' => 'required|in_list[SIGNA,SIGNB,SIGNC,ENTRY,ADMIN,Registrar,tradCertSignatoryA,tradCertSignatoryB,tradCertSignatoryC,tradCertEntryClerk]',
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
            'userApplicationFile' => [
                'label' => 'Application File',
                'rules' => 'uploaded[userApplicationFile]|ext_in[userApplicationFile,pdf]|max_size[userApplicationFile,7096]',
                'errors' => [
                    'uploaded' => 'Application file is required.',
                    'ext_in' => 'Application must be a PDF file.',
                    'max_size' => 'Application file cannot exceed 7MB.'
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

        // Conditionally add signature validation for signatory roles
        $userAccountType = $this->request->getPost('userAccountType');
        if (in_array($userAccountType, $signatoryRoles)) {
            $validationRules['userSignature'] = [
                'label' => 'Signature',
                'rules' => 'uploaded[userSignature]|is_image[userSignature]|max_size[userSignature,2048]',
                'errors' => [
                    'uploaded' => 'Signature is required for signatory roles.',
                    'is_image' => 'Signature must be an image.',
                    'max_size' => 'Signature cannot exceed 2MB.'
                ]
            ];
        }

        if ($this->request->getMethod() === 'post') {
            if (!$this->validate($validationRules)) {
                $data['validation'] = $this->validator;
            } else {
                $newUser = [
                    'userFullName' => $this->request->getPost('userFullName'),
                    'userEmail' => $this->request->getPost('userEmail'),
                    'userPhone' => $this->request->getPost('userPhone'),
                    'userPosition' => $this->request->getPost('userPosition'),
                    'userDepartment' => $this->request->getPost('userDepartment'),
                    'userPassword' => password_hash($this->request->getPost('userPassword'), PASSWORD_DEFAULT),
                    'userBreanch' => $this->request->getPost('userBreanch'),
                    'userAccountType' => $this->request->getPost('userAccountType'),
                    'userAccountActiveStatus' => $this->request->getPost('userAccountActiveStatus'),
                    'userDateCreated' => date('Y-m-d H:i:s'),
                    'userCreatedBy' => session()->get('userData')['userId'] ?? 'System',
                    'userAccountVerified' => 0,
                ];

                // Handle profile picture
                $picture = $this->request->getFile('userPicture');
                if ($picture->isValid()) {
                    $pictureName = $picture->getRandomName();
                    $picture->move('uploads/users/pictures/', $pictureName);
                    $newUser['userPicture'] = $pictureName;
                }

                // Handle signature if uploaded
                $signature = $this->request->getFile('userSignature');
                if ($signature->isValid()) {
                    $signatureName = $signature->getRandomName();
                    $signature->move('uploads/users/signatures/', $signatureName);
                    $newUser['userSignature'] = $signatureName;
                }

                // Handle application file
                $application = $this->request->getFile('userApplicationFile');
                if ($application->isValid()) {
                    $applicationName = $application->getRandomName();
                    $application->move('uploads/users/applications/', $applicationName);
                    $newUser['userApplicationFile'] = $applicationName;
                }

                // Check if an active user with the same branch and account type exists
                $existingUser = $this->userModel
                    ->where('userAccountActiveStatus', 1)
                    ->where('userBreanch', $newUser['userBreanch'])
                    ->where('userAccountType', $newUser['userAccountType'])
                    ->first();

                if ($existingUser) {
                    return redirect()->back()->with('error', 'An active user with this account type already exists in the selected branch.');
                }

                $userId = $this->userModel->insert($newUser);

                if ($userId) {
                    // Generate verification code and send email
                    $verificationCode = $this->userModel->generateVerificationCode();
                    $this->userModel->update($userId, ['userAccountVerificationCode' => $verificationCode]);
                    $user = $this->userModel->find($userId);
                    $emailSent = $this->sendVerificationEmail($user);

                    if ($emailSent) {
                        return redirect()->back()->with('success', 'User created successfully. Verification email sent.');
                    } else {
                        return redirect()->back()->with('warning', 'User created, but verification email failed to send.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Failed to create user.');
                }
            }
        }

        return view('dashboard/create_user', $data);
    }

    // Resend Verification Email
    public function resendVerification()
    {
        $email = $this->request->getPost('email');
        $user  = $this->userModel->where('userEmail', $email)->first();

        if ($user && !$user['userAccountVerified']) {
            // Generate new verification code
            $newVerificationCode = $this->userModel->generateVerificationCode();

            // Update user with new verification code
            $this->userModel->update($user['userId'], [
                'userAccountVerificationCode' => $newVerificationCode
            ]);

            // Send verification email
            $emailSent = $this->sendVerificationEmail([
                'userEmail' => $user['userEmail'],
                'userFullName' => $user['userFullName'],
                'userAccountVerificationCode' => $newVerificationCode
            ]);

            if ($emailSent) {
                return redirect()->back()->with('success', 'Verification email has been resent successfully.');
            } else {
                return redirect()->back()->with('warning', 'Verification email failed to send. Please try again or contact support.');
            }
        }

        return redirect()->back()->with('error', 'User not found or already verified.');
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

        // Define signatory roles that require signature
        $signatoryRoles = ['SIGNA', 'SIGNB', 'SIGNC', 'tradCertSignatoryA', 'tradCertSignatoryB', 'tradCertSignatoryC'];

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
            'userDepartment' => [
                'label' => 'Department',
                'rules' => 'required|in_list[Registrar,Matrimonial,Cultural,System-Admin]',
                'errors' => [
                    'required' => 'Department selection is required.',
                    'in_list' => 'Please select a valid department.'
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
                'rules' => 'required|in_list[SIGNA,SIGNB,SIGNC,ENTRY,ADMIN,Registrar,tradCertSignatoryA,tradCertSignatoryB,tradCertSignatoryC,tradCertEntryClerk]',
                'errors' => [
                    'required' => 'Account type is required.',
                    'in_list' => 'Choose a valid account type.'
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

            // Handle signature validation based on account type
            $userAccountType = $this->request->getPost('userAccountType');
            if ($this->request->getFile('userSignature')->isValid()) {
                if (in_array($userAccountType, $signatoryRoles)) {
                    $validationRules['userSignature'] = [
                        'label' => 'Signature',
                        'rules' => 'is_image[userSignature]|max_size[userSignature,2048]',
                        'errors' => [
                            'is_image' => 'Signature must be an image.',
                            'max_size' => 'Signature cannot exceed 2MB.'
                        ]
                    ];
                } else {
                    $validationRules['userSignature'] = [
                        'label' => 'Signature',
                        'rules' => 'is_image[userSignature]|max_size[userSignature,2048]',
                        'errors' => [
                            'is_image' => 'Signature must be an image.',
                            'max_size' => 'Signature cannot exceed 2MB.'
                        ]
                    ];
                }
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
                    'userDepartment' => $this->request->getPost('userDepartment'),
                    'userBreanch' => $this->request->getPost('userBreanch'),
                    'userAccountType' => $this->request->getPost('userAccountType'),
                    'userAccountLastModifiedBy' => session()->get('userData')['userId'] ?? 'System',
                    'userAccountLastModifiedDate' => date('Y-m-d H:i:s'),
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

                // Check if an active user with the same branch and account type exists (excluding current user)
                $existingUser = $this->userModel
                    ->where('userAccountActiveStatus', 1)
                    ->where('userBreanch', $this->request->getPost('userBreanch'))
                    ->where('userAccountType', $this->request->getPost('userAccountType'))
                    ->where('login_users.userId !=', $user_id)
                    ->first();

                if ($existingUser) {
                    return redirect()->back()->with('error', 'An active user with this account type already exists in the selected branch.');
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

    // ===================== PRIVATE METHODS =====================

    private function sendVerificationEmail($user)
    {
        $email = Services::email();
        $link  = base_url("verify/{$user['userAccountVerificationCode']}");

        $email->setTo($user['userEmail']);
        $email->setSubject('Verify Your Account - Ministry of Internal Affairs');
        $email->setMessage("
            Dear {$user['userFullName']},<br><br>
            Please verify your email by clicking the link below:<br><br>
            <a href='{$link}'>{$link}</a><br><br>
            This link expires in 24 hours.<br><br>
            Best regards,<br>Ministry of Internal Affairs - Liberia
        ");

        return $email->send();
    }
}
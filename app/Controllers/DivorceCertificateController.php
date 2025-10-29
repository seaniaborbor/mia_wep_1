<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\UsersModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\FileModel;

class DivorceCertificateController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url']);
        $this->branchModel = new BranchModel();
        $this->userModel = new UsersModel();
        $this->weddingCertModel = new MarriageCertificateModel();
        $this->divorceCertificateModel = new DivorceCertificateModel();
        $this->fileModel = new FileModel();
    }

    public function index()
        {

            // check if the user account is allowed to view marriage certificate activities
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
            exit();
        }

            $data['title'] = 'Users List';
            $data['passLink'] = 'certificates';

            // Fetch completed divorce certificates (all three signatures present)

            // Completed certificates (all signatures must be present)
            $data['branch_complete_certificate'] = $this->divorceCertificateModel
                ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                ->where('divorce_certificates.divorcebreanch_id', session()->get('userData')['userBreanch'])
                ->where('divorce_certificates.divorceSIGN_A !=', null)
                ->where('divorce_certificates.divorceSIGN_B !=', null)
                ->where('divorce_certificates.divorceSIGN_C !=', null)
                ->orderBy('divorce_certificates.divorceCertId', 'DESC')
                ->findAll();

            // Uncompleted certificates (any one signature missing)
            $data['branch_uncomplete_certificate'] = $this->divorceCertificateModel
                ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                ->where('divorce_certificates.divorcebreanch_id', session()->get('userData')['userBreanch'])
                ->groupStart()
                    ->where('divorce_certificates.divorceSIGN_A', null)
                    ->orWhere('divorce_certificates.divorceSIGN_B', null)
                    ->orWhere('divorce_certificates.divorceSIGN_C', null)
                ->groupEnd()
                ->orderBy('divorce_certificates.divorceCertId', 'DESC')
                ->findAll();

            // i want the total of each query above 
            $data['total_complete_certificate'] = count($data['branch_complete_certificate']);
            $data['total_uncomplete_certificate'] = count($data['branch_uncomplete_certificate']);
     

            return view('dashboard/divorce_certificate_log', $data);
}

public function create()
{
     // check if the user account is allowed to view marriage certificate
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
            exit();
        }

    $data['title'] = 'Log Divorce Certificate';
    $data['passLink'] = 'certificates';

    // if the user account type is not ENTRY, back 
    if (session()->get('userData')['userAccountType'] != 'ENTRY') {
        return redirect()->back()->with('error', 'Only Data Entry Clerk can enter or log divorce record. You are not authorized to create a divorce certificate');
    }
    
    // Handle POST request (form submission)
    if ($this->request->getMethod() === 'post') {
        // Set validation rules
        $rules = [
            'divorceplaintiff' => 'required|min_length[2]|max_length[255]',
            'divorcedefendant' => 'required|min_length[2]|max_length[255]',
            'divorceplaintiffPic' => 'uploaded[divorceplaintiffPic]|max_size[divorceplaintiffPic,2048]|is_image[divorceplaintiffPic]',
            'divorcedefendantPic' => 'uploaded[divorcedefendantPic]|max_size[divorcedefendantPic,2048]|is_image[divorcedefendantPic]',
            'divorceRevNo' => 'permit_empty|max_length[20]',
            'divorcemarriageDate' => 'required|valid_date',
            'divorcedateOfDivorce' => 'required|valid_date',
            'divorceissuanceDate' => 'required|valid_date'
        ];
        
        // Custom error messages
        $errors = [
            'divorceplaintiff' => [
                'required' => 'Plaintiff name is required',
                'min_length' => 'Plaintiff name must be at least 2 characters',
                'max_length' => 'Plaintiff name cannot exceed 255 characters'
            ],
            'divorcedefendant' => [
                'required' => 'Defendant name is required',
                'min_length' => 'Defendant name must be at least 2 characters',
                'max_length' => 'Defendant name cannot exceed 255 characters'
            ],
            'divorceplaintiffPic' => [
                'uploaded' => 'Please upload plaintiff picture',
                'max_size' => 'Plaintiff picture size should not exceed 2MB',
                'is_image' => 'Plaintiff picture must be a valid image file'
            ],
            'divorcedefendantPic' => [
                'uploaded' => 'Please upload defendant picture',
                'max_size' => 'Defendant picture size should not exceed 2MB',
                'is_image' => 'Defendant picture must be a valid image file'
            ],
            'divorceRevNo' => [
                'max_length' => 'Revision number cannot exceed 20 characters'
            ],
            'divorcemarriageDate' => [
                'required' => 'Marriage date is required',
                'valid_date' => 'Please enter a valid marriage date'
            ],
            'divorcedateOfDivorce' => [
                'required' => 'Divorce date is required',
                'valid_date' => 'Please enter a valid divorce date'
            ],
            'divorceissuanceDate' => [
                'required' => 'Issuance date is required',
                'valid_date' => 'Please enter a valid issuance date'
            ]
        ];
        
        // Validate the input
        if (!$this->validate($rules, $errors)) {
            // Validation failed - return to form with errors
            $data['validation'] = $this->validator;
        } else {
            // Validation passed - prepare data
            $formData = [
                'divorceplaintiff' => $this->request->getPost('divorceplaintiff'),
                'divorcedefendant' => $this->request->getPost('divorcedefendant'),
                'divorceRevNo' => $this->request->getPost('divorceRevNo'),
                'divorcemarriageDate' => $this->request->getPost('divorcemarriageDate'),
                'divorcedateOfDivorce' => $this->request->getPost('divorcedateOfDivorce'),
                'divorceissuanceDate' => $this->request->getPost('divorceissuanceDate'),
                'divorcebreanch_id' => session()->get('userData')['userBreanch'],
                'divorcecreated_by' => session()->get('userData')['userId']
            ];
            
            // Handle file uploads
            $plaintiffPic = $this->request->getFile('divorceplaintiffPic');
            $defendantPic = $this->request->getFile('divorcedefendantPic');
            
            // Process plaintiff picture
            if ($plaintiffPic->isValid() && !$plaintiffPic->hasMoved()) {
                $newName = $plaintiffPic->getRandomName();
                $plaintiffPic->move('uploads/divorce', $newName);
                $formData['divorceplaintiffPic'] = $newName;
            }
            
            // Process defendant picture
            if ($defendantPic->isValid() && !$defendantPic->hasMoved()) {
                $newName = $defendantPic->getRandomName();
                $defendantPic->move('uploads/divorce', $newName);
                $formData['divorcedefendantPic'] = $newName;
            }
            
            // Save to database
            try {
                $saved = $this->divorceCertificateModel->insert($formData);
                
                if ($saved) {
                    // Success - redirect with success message
                    return redirect()->to('/dashboard/divorce_cert/create')
                        ->with('success', 'Divorce certificate created successfully!');
                } else {
                    // Database error
                    return redirect()->back()
                        ->with('error', 'Failed to save divorce certificate')
                        ->withInput();
                }
            } catch (\Exception $e) {
                // Exception occurred
                return redirect()->back()
                    ->with('error', 'Error: ' . $e->getMessage())
                    ->withInput();
            }
        }
    }
    
    // Handle GET request (load form)
    return view('dashboard/create_divorce_certificate', $data);
}


public function view($certificate_id)
        {
            // check if the user account is allowed to view marriage certificate activities
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
            exit();
        }

            $data['title'] = 'Users List';
            $data['passLink'] = 'certificates';


              //divorce certificate log  
           $data['certificate'] = $this->divorceCertificateModel
            ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
            ->where('divorce_certificates.divorceCertId', $certificate_id)            
            ->orderBy('divorce_certificates.divorceCertId', 'DESC')
            ->findAll();

           $data['attachedFiles'] = $this->fileModel->select('login_users.userFullName, login_users.userId, attached_file_table.*')
                                    ->join('login_users', 'login_users.userId = attached_file_table.fileCreatedBy')
                                    ->where('fileCertificateId', $certificate_id)
                                    ->where('certificateFile_category', 'divorce')->findAll();


            if (empty($data['certificate'])) {
                return redirect()->back()->with('error', 'Certificate not found');
            }


            // Fetch signer profiles (A, B, and C)
            $signerProfiles = [];

            $signerProfiles['SIGNA_profile'] = isset($data['certificate'][0]['divorceSIGN_A_ID'])
                ? $this->userModel->find($data['certificate'][0]['divorceSIGN_A_ID'])
                : null;

            $signerProfiles['SIGNB_profile'] = isset($data['certificate'][0]['divorceSIGN_B_ID'])
                ? $this->userModel->find($data['certificate'][0]['divorceSIGN_B_ID'])
                : null;

            $signerProfiles['SIGNC_profile'] = isset($data['certificate'][0]['divorceSIGN_C_ID'])
                ? $this->userModel->find($data['certificate'][0]['divorceSIGN_C_ID'])
                : null;

            $data['signerProfiles'] = $signerProfiles;
            



            return view('dashboard/view_a_divorce_cert', $data);
        }
        


public function edite()
        {
            $data['title'] = 'Users List';
            $data['passLink'] = 'certificates';
            

            return view('dashboard/divorce_certificate_log', $data);
}

public function sign($certificate_id)
    {
    
     // check if the user account is allowed to view marriage certificate
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
            exit();
        }

    $data['title'] = 'Sign Divorce Certificate';
    $data['passLink'] = 'certificates';

    // Fetch the certificate details
    $data['certificate'] = $this->divorceCertificateModel
        ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
        ->where('divorce_certificates.divorceCertId', $certificate_id)
        ->first();

    if (!$data['certificate']) {
        return redirect()->back()->with('error', 'Certificate not found');
    }

    // Check if the user is authorized to sign
    if (session()->get('userData')['userBreanch'] != $data['certificate']['divorcebreanch_id']) {
        return redirect()->back()->with('error', 'You are not authorized to sign this certificate');
    }

    $loginUserId = session()->get('userData')['userId'];
    $loginUserAccountType = session()->get('userData')['userAccountType'];
    $loginUserBranch = session()->get('userData')['userBreanch'];
    $userSignature = session()->get('userData')['userSignature'];

    // Check if the login user account type is SIGNA, SIGNB or SIGNC
    if ($loginUserAccountType == 'SIGNA' || $loginUserAccountType == 'SIGNB' || $loginUserAccountType == 'SIGNC') {

        // Prepare the update data based on the user type
        $updateData = [];

        if ($loginUserAccountType == 'SIGNA' && empty($data['certificate']['divorceSIGN_A'])) {

            $updateData['divorceSIGN_A'] = $userSignature;
            $updateData['divorceSIGN_A_DATE_SIGNED'] = date('Y-m-d H:i:s');
            $updateData['divorceSIGN_A_ID'] = $loginUserId;
            $updateData['divorceSIGN_A_branch'] = $loginUserBranch;

        } elseif ($loginUserAccountType == 'SIGNB' && empty($data['certificate']['divorceSIGN_B'])) {
            $updateData['divorceSIGN_B'] = $userSignature;
            $updateData['divorceSIGN_B_DATE_SIGNED'] = date('Y-m-d H:i:s');
            $updateData['divorceSIGN_B_ID'] = $loginUserId;
            $updateData['divorceSIGN_B_branch'] = $loginUserBranch;

        } elseif ($loginUserAccountType == 'SIGNC' && empty($data['certificate']['divorceSIGN_C'])) {
            $updateData['divorceSIGN_C'] = $userSignature;
            $updateData['divorceSIGN_C_DATE_SIGNED'] = date('Y-m-d H:i:s');
            $updateData['divorceSIGN_C_ID'] = $loginUserId;
            $updateData['divorceSIGN_C_branch'] = $loginUserBranch;
        }

        // Ensure there's data to update
        if (empty($updateData)) {
            return redirect()->back()->with('error', 'You may have already signed this certificate or you are not authorized to sign it.');
        }

        // Attempt to update the certificate
        if ($this->divorceCertificateModel->update($certificate_id, $updateData)) {
            return redirect()->to('/dashboard/divorce_cert/view/' . $certificate_id)
                ->with('success', 'Certificate signed successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to sign the certificate');
        }
    } else {
        return redirect()->back()->with('error', 'You are not authorized to sign this certificate');
    }
}


public function edit_certificate($certificate_id)
{
     // check if the user account is allowed to view marriage certificate
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
            exit();
        }


    $data['title'] = 'Edit Divorce Certificate';
    $data['passLink'] = 'certificates';

    

    // Fetch the certificate details
    $data['divorceCert'] = $this->divorceCertificateModel
        ->where('divorceCertId', $certificate_id)
        ->first();

    if (!$data['divorceCert']) {
        return redirect()->back()->with('error', 'Certificate not found');
    }

    // Handle form submission
    if ($this->request->getMethod() === 'post') {
        $rules = [
            'divorceplaintiff' => 'required|min_length[2]|max_length[255]',
            'divorcedefendant' => 'required|min_length[2]|max_length[255]',
            'divorceplaintiffPic' => 'if_exist|max_size[divorceplaintiffPic,2048]|is_image[divorceplaintiffPic]',
            'divorcedefendantPic' => 'if_exist|max_size[divorcedefendantPic,2048]|is_image[divorcedefendantPic]',
            'divorceRevNo' => 'permit_empty|max_length[20]',
            'divorcemarriageDate' => 'required|valid_date',
            'divorcedateOfDivorce' => 'required|valid_date',
            'divorceissuanceDate' => 'required|valid_date'
        ];

        $errors = [
            'divorceplaintiff' => [
                'required' => 'Plaintiff name is required',
                'min_length' => 'Plaintiff name must be at least 2 characters',
                'max_length' => 'Plaintiff name cannot exceed 255 characters'
            ],
            'divorcedefendant' => [
                'required' => 'Defendant name is required',
                'min_length' => 'Defendant name must be at least 2 characters',
                'max_length' => 'Defendant name cannot exceed 255 characters'
            ],
            'divorceplaintiffPic' => [
                'max_size' => 'Plaintiff picture size should not exceed 2MB',
                'is_image' => 'Plaintiff picture must be a valid image file'
            ],
            'divorcedefendantPic' => [
                'max_size' => 'Defendant picture size should not exceed 2MB',
                'is_image' => 'Defendant picture must be a valid image file'
            ],
            'divorceRevNo' => [
                'max_length' => 'Revision number cannot exceed 20 characters'
            ],
            'divorcemarriageDate' => [
                'required' => 'Marriage date is required',
                'valid_date' => 'Please enter a valid marriage date'
            ],
            'divorcedateOfDivorce' => [
                'required' => 'Divorce date is required',
                'valid_date' => 'Please enter a valid divorce date'
            ],
            'divorceissuanceDate' => [
                'required' => 'Issuance date is required',
                'valid_date' => 'Please enter a valid issuance date'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            $data['validation'] = $this->validator;
        }

        $updateData = [
            'divorceplaintiff' => $this->request->getPost('divorceplaintiff'),
            'divorcedefendant' => $this->request->getPost('divorcedefendant'),
            'divorceRevNo' => $this->request->getPost('divorceRevNo'),
            'divorcemarriageDate' => $this->request->getPost('divorcemarriageDate'),
            'divorcedateOfDivorce' => $this->request->getPost('divorcedateOfDivorce'),
            'divorceissuanceDate' => $this->request->getPost('divorceissuanceDate')
        ];

        // Handle plaintiff picture upload if a new file is provided
        $plaintiffPic = $this->request->getFile('divorceplaintiffPic');
        if ($plaintiffPic && $plaintiffPic->isValid() && !$plaintiffPic->hasMoved()) {
            $newName = $plaintiffPic->getRandomName();
            $plaintiffPic->move('uploads/divorce', $newName);
            $updateData['divorceplaintiffPic'] = $newName;
        }

        // Handle defendant picture upload if a new file is provided
        $defendantPic = $this->request->getFile('divorcedefendantPic');
        if ($defendantPic && $defendantPic->isValid() && !$defendantPic->hasMoved()) {
            $newName = $defendantPic->getRandomName();
            $defendantPic->move('uploads/divorce', $newName);
            $updateData['divorcedefendantPic'] = $newName;
        }

        try {
            $this->divorceCertificateModel->update($certificate_id, $updateData);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
        // Validate and update the certificate data here
        // ...

        return redirect()->to('/dashboard/divorce_cert/view/' . $certificate_id)
            ->with('success', 'Certificate updated successfully');
    }

    return view('dashboard/edit_divorce_certificate', $data);
}



public function generate_certificate($certificate_id)
{
     // check if the user account is allowed to view marriage certificate
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
            exit();
        }

    $data['title'] = 'Generate Divorce Certificate';
    $data['passLink'] = 'certificates';
    // Fetch the certificate details
    $data['certificate'] = $this->divorceCertificateModel
        ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
        ->where('divorce_certificates.divorceCertId', $certificate_id)
        ->first();
    if (!$data['certificate']) {
        return redirect()->back()->with('error', 'Certificate not found');
    }

    // print_r($data['certificate']);
    // exit();

    $frame = $this->request->getGet('frame');

    if ($frame) {
            $data['frame'] = "/uploads/marriage/template/divorce_blank.jpeg";
        }else{
            $data['frame'] = '/uploads/marriage/template/divorce_cert.jpeg';
        }

    return view('dashboard/generate_divorce_cert', $data);
}


public function allow_edit($certificate_id)
{
    
    // Check if the user is authorized to allow edit
    if (session()->get('userData')['userAccountType'] != 'SIGNC') {
        return redirect()->back()->with('error', 'You are not authorized to allow edit for this certificate.');
    }

    // Fetch the certificate details
    $certificate = $this->divorceCertificateModel->find($certificate_id);
    if (!$certificate) {
        return redirect()->back()->with('error', 'Certificate not found.');
    }

    // check if the the person person allow edit is at the same branch
    if ($certificate['divorcebreanch_id'] != session()->get('userData')['userBreanch']) {
        return redirect()->back()->with('error', 'You are not authorized to allow edit for this certificate. It is not at your branch.');
    }

    // Allow edit by updating the status of signator C
    $certificate['divorceSIGN_C'] = null; 
    $certificate['divorceSIGN_C_ID'] = null; 
    $certificate['divorceSIGN_C_DATE_SIGNED'] = null; 

    // Allow edit by updating the status of signator A 
    $certificate['divorceSIGN_A'] = null; 
    $certificate['divorceSIGN_A_ID'] = null; 
    $certificate['divorceSIGN_A_DATE_SIGNED'] = null; 

    // Allow edit by the clearing the status signatory B 
    $certificate['divorceSIGN_B'] = null; 
    $certificate['divorceSIGN_B_ID'] = null; 
    $certificate['divorceSIGN_B_DATE_SIGNED'] = null; 


    if($this->divorceCertificateModel->update($certificate_id, $certificate)){
        return redirect()->back()->with('success', 'Edit permission granted for the certificate.');
    } else {
        return redirect()->back()->with('error', 'Failed to grant edit permission for the certificate.');
    };

}


    
}
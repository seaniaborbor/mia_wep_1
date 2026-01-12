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

             $branchId = session()->get('userData')['branchId'];

                if($this->request->getGet('branch') && !empty($this->request->getGet('branch'))){
                    $branchId = $this->request->getGet('branch');
                }

            // Completed certificates (all signatures must be present)
            $data['branch_complete_certificate'] = $this->divorceCertificateModel
                ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                ->where('divorce_certificates.divorcebreanch_id', $branchId)
                ->where('divorce_certificates.divorceSIGN_A !=', null)
                ->where('divorce_certificates.divorceSIGN_B !=', null)
                ->where('divorce_certificates.divorceSIGN_C !=', null)
                ->orderBy('divorce_certificates.divorceCertId', 'DESC')
                ->findAll();

            // Uncompleted certificates (any one signature missing)
            $data['branch_uncomplete_certificate'] = $this->divorceCertificateModel
                ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
                ->where('divorce_certificates.divorcebreanch_id', $branchId)
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
     

        $data['breanchDetail'] = $this->branchModel->find($branchId);
        $data['allBranches'] = $this->branchModel->findAll();

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

            // Generate divorce code and reference number
            $branchData = $this->branchModel->find(session()->get('userData')['userBreanch']);
            $codes = $this->generateDivorceCode($branchData); 
            $formData['divorceCode'] = $codes['divorceCode'];
            $formData['divorceRefNo'] = $codes['divorceRefNo'];
            // print_r($formData);
            // exit();
            
            // Save to database
            try {
                $saved = $this->divorceCertificateModel->insert($formData);
                
                if ($saved) {
                    // geltw
                    // Success - redirect with success message
                    return redirect()->back()
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
    
    // Handle GET request (load form)ltwltw
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
            $data['isIssued'] = $this->isIssued($data['certificate'][0]);

            $data['createdBy'] = $this->userModel->find($data['certificate'][0]['divorcecreated_by']);
            $data['divorceupdated_by'] =$this->userModel->find($data['certificate'][0]['divorceupdated_by']);;
            $data['divorceupdated_at'] = $data['certificate'][0]['divorceupdated_at'];



            // print_r($data);
            // exit();

           
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
    // Allowed roles
    $allowedRoles = ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'];

    if (!in_array(session()->get('userData')['userAccountType'], $allowedRoles)) {
        return redirect()->back()->with('error', 'You do not have permission to view this certificate.');
    }

    $data['title'] = 'Sign Divorce Certificate';
    $data['passLink'] = 'certificates';

    // Fetch certificate
    $certificate = $this->divorceCertificateModel
        ->join('branchs_table', 'branchs_table.branchId = divorce_certificates.divorcebreanch_id')
        ->where('divorce_certificates.divorceCertId', $certificate_id)
        ->first();

    if (!$certificate) {
        return redirect()->back()->with('error', 'Certificate not found.');
    }

    // Branch authorization
    if ((int) session()->get('userData')['userBreanch'] !== (int) $certificate['divorcebreanch_id']) {
        return redirect()->back()->with('error', 'You are not authorized to sign this certificate.');
    }

    $user = session()->get('userData');
    $role = $user['userAccountType'];

    // Only signers allowed beyond this point
    if (!in_array($role, ['SIGNA', 'SIGNB', 'SIGNC'])) {
        return redirect()->back()->with('error', 'You are not authorized to sign this certificate.');
    }

    $updateData = [];
    $recipients = [];
    $message = '';
    $now = date('Y-m-d H:i:s');

    switch ($role) {
        case 'SIGNA':
            if (!empty($certificate['divorceSIGN_A'])) {
                return redirect()->back()->with('error', 'You have already signed this certificate.');
            }

            $updateData = [
                'divorceSIGN_A' => $user['userSignature'],
                'divorceSIGN_A_DATE_SIGNED' => $now,
                'divorceSIGN_A_ID' => $user['userId'],
                'divorceSIGN_A_branch' => $user['userBreanch'],
            ];

            $recipients = $this->userModel
                ->where('userBreanch', $user['userBreanch'])
                ->whereIn('userAccountType', ['SIGNB', 'SIGNC'])
                ->findAll();

            $message = "Divorce Certificate with Reference No: {$certificate['divorceRefNo']} has been signed by Signatory A ({$user['userFullName']}).";
            break;

        case 'SIGNB':
            if (!empty($certificate['divorceSIGN_B'])) {
                return redirect()->back()->with('error', 'You have already signed this certificate.');
            }

            $updateData = [
                'divorceSIGN_B' => $user['userSignature'],
                'divorceSIGN_B_DATE_SIGNED' => $now,
                'divorceSIGN_B_ID' => $user['userId'],
                'divorceSIGN_B_branch' => $user['userBreanch'],
            ];

            $recipients = $this->userModel
                ->where('userBreanch', $user['userBreanch'])
                ->whereIn('userAccountType', ['SIGNA', 'SIGNC'])
                ->findAll();

            $message = "Divorce Certificate with Reference No: {$certificate['divorceRefNo']} has been signed by Signatory B ({$user['userFullName']}).";
            break;

        case 'SIGNC':
            if (!empty($certificate['divorceSIGN_C'])) {
                return redirect()->back()->with('error', 'You have already signed this certificate.');
            }

            $updateData = [
                'divorceSIGN_C' => $user['userSignature'],
                'divorceSIGN_C_DATE_SIGNED' => $now,
                'divorceSIGN_C_ID' => $user['userId'],
                'divorceSIGN_C_branch' => $user['userBreanch'],
            ];

            $recipients = $this->userModel
                ->where('userBreanch', $user['userBreanch'])
                ->whereIn('userAccountType', ['SIGNA', 'SIGNB'])
                ->findAll();

            $message = "Divorce Certificate with Reference No: {$certificate['divorceRefNo']} has been signed by Signatory C ({$user['userFullName']}).";
            break;
    }

    $updateData['divorceupdated_by'] = $user['userId'];

    if (!$this->divorceCertificateModel->update($certificate_id, $updateData)) {
        return redirect()->back()->with('error', 'Failed to sign the certificate.');
    }

    // Send notifications (non-blocking)
    $email = \Config\Services::email();

    foreach ($recipients as $recipient) {
        try {
            $email->clear();
            $email->setTo($recipient['userEmail']);
            $email->setSubject('Divorce Certificate Signed');
            $email->setMessage(
                "Dear {$recipient['userFullName']},<br><br>{$message}<br><br>Regards,<br>Matrimonial System"
            );
            $email->send();
        } catch (\Throwable $e) {
            log_message('error', 'Email failed: ' . $e->getMessage());
        }
    }

    return redirect()
        ->to('/matrimonial_dashboard/divorce_cert/view/' . $certificate_id)
        ->with('success', 'Certificate signed successfully.');
}



public function edit_certificate($certificate_id)
    {

    $data['title'] = 'Edit Divorce Certificate';
    $data['passLink'] = 'certificates';

    // Fetch the certificate details
    $data['divorceCert'] = $this->divorceCertificateModel
        ->where('divorceCertId', $certificate_id)
        ->first();
    
    // only ENTRY user at the same branch can edit the certificate
    if (session()->get('userData')['userAccountType'] != 'ENTRY' ||
        session()->get('userData')['userBreanch'] != $data['divorceCert']['divorcebreanch_id']) {
        return redirect()->back()->with('error', 'You are not authorized to edit this certificate.');
    }

    if (!$data['divorceCert']) {
        return redirect()->back()->with('error', 'Certificate not found - try again later.');
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

        // choose active users at this branch who are SIGNA, SIGNB, SIGNC to notify about the edit
        $signatories = $this->userModel
            ->whereIn('userAccountType', ['SIGNA', 'SIGNB', 'SIGNC'])
            ->where('userBreanch', $data['divorceCert']['divorcebreanch_id'])
            ->findAll();
        $email = \Config\Services::email();
        foreach ($signatories as $signatory) {
            try {
                $email->clear();
                $email->setTo($signatory['userEmail']);
                $email->setSubject('Divorce Certificate Edited');
                $email->setMessage(
                    "Dear {$signatory['userFullName']},<br><br>"
                    . "Divorce Certificate with Reference No: {$data['divorceCert']['divorceRefNo']} has been edited by "
                    . session()->get('userData')['userFullName'] . ".<br><br>"
                    . "Please review the changes made to the certificate and Sign<br><br>"
                    . "Regards,<br>Matrimonial System"
                );
                $email->send();
            } catch (\Throwable $e) {
                log_message('error', 'Email notification failed: ' . $e->getMessage());
            }
        }

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
        // Fetch all signatories and send notifications
        $signatories = $this->userModel
            ->whereIn('userAccountType', ['SIGNA', 'SIGNB', 'SIGNC'])
            ->where('userBreanch', $certificate['divorcebreanch_id'])
            ->findAll();

        $email = \Config\Services::email();
        foreach ($signatories as $signatory) {
            try {
                $email->clear();
                $email->setTo($signatory['userEmail']);
                $email->setSubject('Divorce Certificate - Reopened for Review and Signing');
                $email->setMessage(
                    "Dear {$signatory['userFullName']},<br><br>"
                    . "Divorce Certificate with Reference No: {$certificate['divorceRefNo']} has been reopened for review and signing by Signatory C.<br><br>"
                    . "Please review and sign the certificate accordingly.<br><br>"
                    . "Regards,<br>Matrimonial System"
                );
                $email->send();
            } catch (\Throwable $e) {
                log_message('error', 'Email notification failed: ' . $e->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Edit permission granted for the certificate.');
    } else {
        return redirect()->back()->with('error', 'Failed to grant edit permission for the certificate.');
    };

}


 /**
     * Get issued certificates (API endpoint)
     */
    private function isIssued($certificate): bool
    {
        return !empty($certificate['divorceissuanceDate']);
    }


     private  function generateDivorceCode($branch_data)
    {
        helper('text'); // For random_string()

        $cert_identifyers = [];

        $countyName = $branch_data['branchCounty'];
        $abbr = strtoupper(substr($countyName, 0, 3)); // First three letters of county name
        $yearSuffix = date('y'); // last two digits of the year
        $monthDigit = date('m'); // Month as two digits
        $randomPart = strtoupper(random_string('alnum', 6)); // Random alphanumeric string of length 6
        $reference_no = "{$yearSuffix}{$monthDigit}{$randomPart}";
        $cert_code = "{$abbr}-{$yearSuffix}{$monthDigit}{$randomPart}";

        $cert_identifyers['divorceRefNo'] = $reference_no;
        $cert_identifyers['divorceCode'] = $cert_code;

        return $cert_identifyers;

    }

    
    public function markAsIssued($certificate_id)
    {
        

        // Fetch the certificate details
        $certificate = $this->divorceCertificateModel->find($certificate_id);
        if (!$certificate) {
            return redirect()->back()->with('error', 'Certificate not found.');
        }

         // only ENTRY user at the same branch can mark as issued
        if (session()->get('userData')['userAccountType'] != 'ENTRY' ||
            session()->get('userData')['userBreanch'] != $certificate['divorcebreanch_id']) {
            return redirect()->back()->with('error', 'You are not authorized to mark this certificate as issued.');
        }

        // check if already issued
        if ($this->isIssued($certificate)) {
            return redirect()->back()->with('error', 'Certificate is already marked as issued.');
        }
       

        // Update the issuance date to mark as issued
        $certificate['divorceissuanceDate'] = date('Y-m-d H:i:s');
        $certificate['divorceupdated_by'] = session()->get('userData')['userId'];
        $certificate['divorceIsIssued'] = 1;

        if ($this->divorceCertificateModel->update($certificate_id, $certificate)) {
            // Fetch all active users at this branch
            $users = $this->userModel
                ->where('userBreanch', $certificate['divorcebreanch_id'])
                ->where('userAccountActiveStatus', 1)
                ->findAll();

            // Send email notifications
            $email = \Config\Services::email();
            foreach ($users as $user) {
                try {
                    $email->clear();
                    $email->setTo($user['userEmail']);
                    $email->setSubject($certificate['divorceRefNo'] . ' - Divorce Certificate Hand Delivered');
                    $email->setMessage(
                        "Dear {$user['userFullName']},<br><br>"
                        . "The Data Entry Clerk has hand delivered Divorce Certificate with Reference No: {$certificate['divorceRefNo']}.<br><br>"
                        . "Regards,<br>Matrimonial System"
                    );
                    $email->send();
                } catch (\Throwable $e) {
                    log_message('error', 'Email notification failed: ' . $e->getMessage());
                }
            }
            return redirect()->back()->with('success', 'Certificate marked as issued.');
        } else {
            return redirect()->back()->with('error', 'Failed to mark certificate as issued.');
        }
    }


    // delete divorce certificate
    public function delete($certificate_id)
    {
        // only ENTRY user at the same branch can delete the certificate
        if (session()->get('userData')['userAccountType'] != 'ENTRY') {
            return redirect()->back()->with('error', 'You are not authorized to delete this certificate.');
        }

        $certificate = $this->divorceCertificateModel->find($certificate_id);
        if (!$certificate) {
            return redirect()->back()->with('error', 'Certificate not found.');
        }

        if (session()->get('userData')['userBreanch'] != $certificate['divorcebreanch_id']) {
            return redirect()->back()->with('error', 'You are not authorized to delete this certificate. It is not at your branch.');
        }

        // check if the certificate is signed, if signed cannot delete
        if (!empty($certificate['divorceSIGN_A']) || !empty($certificate['divorceSIGN_B']) || !empty($certificate['divorceSIGN_C'])) {
            return redirect()->back()->with('error', 'Cannot delete a signed certificate.');
        }

        // get receipients lists to notify about the deletion
        $recipients = $this->userModel
            ->where('userBreanch', $certificate['divorcebreanch_id'])
            ->whereIn('userAccountType', ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])
            ->findAll();

        if ($this->divorceCertificateModel->delete($certificate_id)) {
            // send notification emails
            $email = \Config\Services::email();
            foreach ($recipients as $recipient) {
                try {
                    $email->clear();
                    $email->setTo($recipient['userEmail']);
                    $email->setSubject('Divorce Certificate Deleted');
                    $email->setMessage(
                        "Dear {$recipient['userFullName']},<br><br>"
                        . "Divorce Certificate with Reference No: {$certificate['divorceRefNo']} has been deleted by "
                        . session()->get('userData')['userFullName'] . ".<br><br>"
                        . "Regards,<br>Matrimonial System"
                    );
                    $email->send();
                } catch (\Throwable $e) {
                    log_message('error', 'Email notification failed: ' . $e->getMessage());
                }
            }
            return redirect()->to('/matrimonial_dashboard/divorce_cert')->with('success', 'Certificate deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete certificate.');
        }
    }


    
}
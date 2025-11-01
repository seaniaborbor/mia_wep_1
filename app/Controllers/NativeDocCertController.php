<?php

namespace App\Controllers;

use App\Models\TraditionalCertificateModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\BranchModel;
use App\Models\UsersModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\FileModel;



class NativeDocCertController extends BaseController
{
    use ResponseTrait;

    protected $certificateModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->certificateModel = new TraditionalCertificateModel();
        $this->branchModel = new BranchModel();
        $this->userModel = new UsersModel();
        $this->weddingCertModel = new MarriageCertificateModel();
        $this->divorceCertificateModel = new DivorceCertificateModel();
        $this->fileModel = new FileModel();

    }

    public function index(): string
    {

              // check if the user account is allowed to view native doctor activities
        if(!in_array(session()->get('userData')['userAccountType'], ['tradCertSignatoryA','tradCertSignatoryB','tradCertSignatoryC','tradCertEntryClerk', 'SIGNC'])){
            // redirect to /dashboard/nativecert
            return redirect()->to('/dashboard/nativecert');
            exit();
        }

        // Get current user's branch ID
        $branchId = session()->get('userData')['branchId'];

        if($this->request->getGet('branch')){

            $branchId = $this->request->getGet('branch');
        }

        // Get certificates only for the user's branch
        $certificates = $this->certificateModel
            ->where('tradCertBranch', $branchId)
            ->orderBy('tradCertCertCreatedAt', 'DESC')
            ->join('login_users', 'login_users.userId = traditionalcertificates.tradCertInsertedBy')
            ->findAll();

        $breanch = $this->branchModel->find($branchId);
        if(empty($breanch)){
            return redirect()->back()->with("redirec", "The Breanch you are looking for doesnot exist");
        }

        // Calculate dashboard statistics
        $totalCertificates = count($certificates);
        $completedCertificates = 0;
        $pendingCertificates = 0;

        // Categorize certificates by county
        $countyStats = [];

        foreach ($certificates as $cert) {
            // Check if certificate is completed (all signatories present)
            if (
                !empty($cert['tradCertSignatoryA']) &&
                !empty($cert['tradCertSignatoryB']) &&
                !empty($cert['tradCertSignatoryC'])
            ) {
                $completedCertificates++;
            } else {
                $pendingCertificates++;
            }

            // Count by county
            $county = $cert['tradCertHoldercounty'] ?? 'Unknown';
            if (!isset($countyStats[$county])) {
                $countyStats[$county] = 0;
            }
            $countyStats[$county]++;
        }

        // Recent activity (last 10 certificates)
        $recentCertificates = array_slice($certificates, 0, 10);

        // Certificates needing attention (missing signatories)
        $incompleteCertificates = array_filter($certificates, function ($cert) {
            return empty($cert['tradCertSignatoryA']) ||
                empty($cert['tradCertSignatoryB']) ||
                empty($cert['tradCertSignatoryC']);
        });

        $data = [
            'title' => 'Traditional Certificates Dashboard',
            'certificates' => $certificates,
            'recentCertificates' => $recentCertificates,
            'incompleteCertificates' => $incompleteCertificates,
            'dashboardStats' => [
                'total' => $totalCertificates,
                'completed' => $completedCertificates,
                'pending' => $pendingCertificates,
                'completionRate' => $totalCertificates > 0
                    ? round(($completedCertificates / $totalCertificates) * 100, 2)
                    : 0
            ],
            'countyStats' => $countyStats,
            'branchName' => $breanch['branchName'],
            'passLink' => 'nativecert'
        ];

        return view('dashboard/herbal_certificate_dashboard', $data);
    }

    /**
     * Show form for creating new certificate
     */
    public function new()
    {
        // validate that only data entry clerk can create a certificate
        if(session()->get('userData')['userAccountType'] !== 'tradCertEntryClerk')
        {
            return redirect()->back()->with("error", "Sorry. Access to create a traditional certificate is not allowed for this account");
            exit();
        }


        $data = [
            'title' => 'Create Traditional Certificate',
            'passLink' => 'nativecert',
            'validation' => \Config\Services::validation()
        ];

        return view('dashboard/create_herbal_certificate', $data);
    }

    /**
     * Create a new certificate
     */
    public function create()
    {
        // validate that only data entry clerk can create a certificate
        if(session()->get('userData')['userAccountType'] !== 'tradCertEntryClerk')
        {
            return redirect()->back()->with("error", "Sorry. Access to create a traditional certificate is not allowed for this account");
            exit();
        }

        // Validation rules with custom error messages including picture upload
        $validationRules = [
            'tradCertHolderName' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'label' => 'Certificate Bearer Name',
                'errors' => [
                    'required' => 'Certificate holder name is required',
                    'min_length' => 'Holder name must be at least 2 characters long',
                    'max_length' => 'Holder name cannot exceed 255 characters'
                ]
            ],
            'tradCertHolderPic' => [
                'rules' => 'uploaded[tradCertHolderPic]|max_size[tradCertHolderPic,2048]|is_image[tradCertHolderPic]|mime_in[tradCertHolderPic,image/jpg,image/jpeg,image/png,image/gif]',
                'label' => 'Holder Picture',
                'errors' => [
                    'uploaded' => 'Please select a picture file',
                    'max_size' => 'Picture file size must be less than 2MB',
                    'is_image' => 'Please upload a valid image file',
                    'mime_in' => 'Please upload a valid image (JPG, JPEG, PNG, GIF)'
                ]
            ],
            'tradCertHolderTownorCity' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'label' => 'City or Town',
                'errors' => [
                    'required' => 'Town or city is required',
                    'min_length' => 'Town or city must be at least 2 characters long',
                    'max_length' => 'Town or city cannot exceed 100 characters'
                ]
            ],
            'tradCertHolderDistrict' => [
                'rules' => 'permit_empty|min_length[2]|max_length[100]',
                'label' => 'District',
                'errors' => [
                    'min_length' => 'District must be at least 2 characters long',
                    'max_length' => 'District cannot exceed 100 characters'
                ]
            ],
            'tradCertHoldercounty' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'label' => 'County of operation',
                'errors' => [
                    'required' => 'County is required',
                    'min_length' => 'County must be at least 2 characters long',
                    'max_length' => 'County cannot exceed 100 characters'
                ]
            ],
            'tradCertHolderOperationType' => [
                'rules' => 'required|min_length[2]|max_length[200]',
                'label' => 'Certificate Type',
                'errors' => [
                    'required' => 'Traditional position is required',
                    'min_length' => 'Traditional position must be at least 2 characters long',
                    'max_length' => 'Traditional position cannot exceed 200 characters'
                ]
            ],
           
            'tradCertDuration' => [
                'rules' => 'required|integer|greater_than[0]',
                'label' => 'Certificate Duration',
                'errors' => [
                    'required' => 'Certificate duration is required',
                    'integer' => 'Duration must be a number',
                    'greater_than' => 'Duration must be greater than 0'
                ]
            ],
            'tradRevenueNo' => [
                'rules' => 'min_length[2]|max_length[100]|integer|is_unique[traditionalcertificates.tradRevenueNo]',
                'label' => 'Revenue Number',
                'errors' => [
                    'min_length' => 'Revenue number must be at least 2 characters long',
                    'max_length' => 'Revenue number cannot exceed 100 characters',
                    'integer' => 'Only an integer is allowed to as an revenue number',
                    'max_length' => 'Revenue number is already used',
                ]
            ],
            'tradCertAmtPaid' => [
                'rules' => 'required|integer|greater_than[0]',
                'errors' => [
                    'required' => 'Certificate duration is required',
                    'integer' => 'Duration must be a number',
                    'greater_than' => 'Duration must be greater than 0'
                ]
            ],
           
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get validated data
        $data = $this->request->getPost();

        // check if the revenue number is used wedding certificate table
        $revenueNoInWedCert  = $this->weddingCertModel->where('revenue_no', $data['tradRevenueNo'])->first();
        if(!empty($revenueNoInWedCert)){
            return redirect()->redirect()->back()->back('error', 'Revenue Number has already been used in marriage certificate issuance');
            exit();
        }

        // check if the revenue number is used divorce certificate table
        $revenueNoInDivCert  = $this->divorceCertificateModel->where('divorceRevNo', $data['tradRevenueNo'])->first();
        if(!empty($revenueNoInDivCert)){
            return redirect()->redirect()->back()->back('error', 'Revenue Number has already been used in for divorce certificate issuance');
            exit();
        }


        // Handle file upload
        $pictureFile = $this->request->getFile('tradCertHolderPic');
        if ($pictureFile->isValid() && !$pictureFile->hasMoved()) {
            $newFileName = $pictureFile->getRandomName();
            $pictureFile->move('uploads/certificate_holders', $newFileName);
            $data['tradCertHolderPic'] = $newFileName;
        }

        // Set inserted by user (from session) and also track the branch
        $data['tradCertInsertedBy'] = session()->get('userData')['userId'];
        $data['tradCertLastUpdatedBy'] = session()->get('userData')['userId'];
        $data['tradCertBranch'] = session()->get('userData')['branchId'];
        $data['tradCertAppliedType'] = "Clerk Entry";


        try {
            if ($this->certificateModel->save($data)) {
                $certificateId = $this->certificateModel->getInsertID();
                $certificate = $this->certificateModel->find($certificateId);
                
                session()->setFlashdata('success', 
                    "Certificate created successfully! Serial Number: {$certificate['tradCertSn']}");
                
                return redirect()->to('/dashboard/nativecert');
            } else {
                throw new \Exception('Failed to save certificate');
            }
        } catch (\Exception $e) {
            log_message('error', 'Certificate creation failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create certificate. Please try again.');
        }


    }

    /**
     * View a single certificate
     */
   public function view($id)
    {
        $certificate = $this->certificateModel
            ->select('traditionalcertificates.*, 
                    creator.userFullName AS createdByName, 
                    creator.userId AS createdById,
                    updater.userFullName AS updatedByName, 
                    updater.userId AS updatedById')
            ->join('login_users AS creator', 'creator.userId = traditionalcertificates.tradCertInsertedBy', 'left')
            ->join('login_users AS updater', 'updater.userId = traditionalcertificates.tradCertLastUpdatedBy', 'left')
            ->where('tradCertId', $id)
            ->first();

        if (!$certificate) {
            return redirect()->to('/dashboard/nativecert')->with('error', 'Certificate not found.');
        }

        $data = [
            'title' => 'View Certificate - ' . $certificate['tradCertSn'],
            'certificate' => $certificate,
            'isCompleted' => $this->isCertificateCompleted($certificate),
            'isIssued' => $this->isIssued($certificate),
            'passLink' => 'nativecert'
        ];
        

        // Fetch signer profiles (A, B, and C)
        $signerProfiles = [];

        $signerProfiles['tradCertSignatoryA'] = isset($data['certificate']['tradCertSignatoryAID'])
                ? $this->userModel->find($data['certificate']['tradCertSignatoryAID'])
                : null;

        $signerProfiles['tradCertSignatoryB'] = isset($data['certificate']['tradCertSignatoryBID'])
                ? $this->userModel->find($data['certificate']['tradCertSignatoryBID'])
                : null;

        $signerProfiles['tradCertSignatoryC'] = isset($data['certificate']['tradCertSignatoryCID'])
                ? $this->userModel->find($data['certificate']['tradCertSignatoryCID'])
                : null;

        $data['signerProfiles'] = $signerProfiles;
        $data['lastEditedByProfile'] = $this->userModel->find($certificate['tradCertLastUpdatedBy']);


        $data['attachedFiles'] = $this->fileModel->select('login_users.userFullName, login_users.userId, attached_file_table.*')
                                    ->join('login_users', 'login_users.userId = attached_file_table.fileCreatedBy')
                                    ->where('fileCertificateId', $id)
                                    ->where('certificateFile_category', 'traditional')->findAll();
        // print_r($data['signerProfiles']);
        // exit();

        return view('dashboard/view_herbal_cert', $data);
    }


    /**
     * Edit certificate form
     */
    public function edit($id)
    {
        $certificate = $this->certificateModel->find($id);

        
        
        if (!$certificate) {
            return redirect()->to('/dashboard/nativecert')->with('error', 'Certificate not found.');
        }

        // check if the user is from this branch
        $branchId = session()->get('userData')['branchId'];
        if($branchId != $certificate['tradCertBranch'] || $branchId != 1){
            return redirect()->to('/dashboard/nativecert')->with('error', 'You are not allowed to edit this certificate');
            exit();
        }

        // check if the certificate is already issued - then disallow edit
        if($this->isIssued($certificate)){
            return redirect()->to('/dashboard/nativecert')->with('error', 'Issued certificates cannot be edited');
            exit();
        }

        // check if the editor is data entry clerk
        if(session()->get('userData')['userAccountType'] !== 'tradCertEntryClerk')
        {
            return redirect()->back()->with("error", "Sorry. Access to edit a traditional certificate is not allowed for this account");
            exit();
        }

        $data = [
            'title' => 'Edit Certificate - ' . $certificate['tradCertSn'],
            'certificate' => $certificate,
            'validation' => \Config\Services::validation(),
            'passLink' => 'nativecert'
        ];

        return view('dashboard/edit_herbal_certificate', $data);
    }

    /**
     * Update certificate
     */
    public function update($id)
    {
        $certificate = $this->certificateModel->find($id);
        
        if (!$certificate) {
            return redirect()->to('/dashboard/nativecert')->with('error', 'Certificate not found.');
        }

        // Validation rules (including optional picture update)
        $validationRules = [
            'tradCertHolderName' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Certificate holder name is required',
                    'min_length' => 'Holder name must be at least 2 characters long',
                    'max_length' => 'Holder name cannot exceed 255 characters'
                ]
            ],
            'tradCertHolderPic' => [
                'rules' => 'if_exist|max_size[tradCertHolderPic,2048]|is_image[tradCertHolderPic]|mime_in[tradCertHolderPic,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'max_size' => 'Picture file size must be less than 2MB',
                    'is_image' => 'Please upload a valid image file',
                    'mime_in' => 'Please upload a valid image (JPG, JPEG, PNG, GIF)'
                ]
            ],
            'tradCertHolderTownorCity' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Town or city is required',
                    'min_length' => 'Town or city must be at least 2 characters long',
                    'max_length' => 'Town or city cannot exceed 100 characters'
                ]
            ],
            'tradCertHoldercounty' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'County is required',
                    'min_length' => 'County must be at least 2 characters long',
                    'max_length' => 'County cannot exceed 100 characters'
                ]
            ],
            'tradCertHolderOperationType' => [
                'rules' => 'required|min_length[2]|max_length[200]',
                'errors' => [
                    'required' => 'Traditional position is required',
                    'min_length' => 'Traditional position must be at least 2 characters long',
                    'max_length' => 'Traditional position cannot exceed 200 characters'
                ]
            ],
           
            'tradCertDuration' => [
                'rules' => 'required|integer|greater_than[0]',
                'errors' => [
                    'required' => 'Certificate duration is required',
                    'integer' => 'Duration must be a number',
                    'greater_than' => 'Duration must be greater than 0'
                ]
            ],
            'tradCertAmtPaid' => [
                'rules' => 'required|integer|greater_than[0]',
                'errors' => [
                    'required' => 'Certificate duration is required',
                    'integer' => 'Duration must be a number',
                    'greater_than' => 'Duration must be greater than 0'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $data['tradCertLastUpdatedBy'] = session()->get('user_id');

        // Handle file upload if new picture is provided
        $pictureFile = $this->request->getFile('tradCertHolderPic');
        if ($pictureFile && $pictureFile->isValid() && !$pictureFile->hasMoved()) {
            // Delete old picture if exists and not default
            if (!empty($certificate['tradCertHolderPic']) && $certificate['tradCertHolderPic'] !== 'default-avatar.jpg') {
                $oldFilePath = WRITEPATH . 'uploads/certificate_holders/' . $certificate['tradCertHolderPic'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            
            $newFileName = $pictureFile->getRandomName();
            $pictureFile->move(WRITEPATH . 'uploads/certificate_holders', $newFileName);
            $data['tradCertHolderPic'] = $newFileName;
        }

        try {
            if ($this->certificateModel->update($id, $data)) {
                session()->setFlashdata('success', 'Certificate updated successfully!');
                return redirect()->to('/dashboard/nativecert/view/' . $id);
            } else {
                throw new \Exception('Failed to update certificate');
            }
        } catch (\Exception $e) {
            log_message('error', 'Certificate update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update certificate. Please try again.');
        }
    }

    /**
     * Add signatories to complete certificate
     */
    public function addSignatories($id)
    {

        $certificate = $this->certificateModel->find($id);
        $branchId = session()->get('userData')['branchId'];
        $userId = session()->get('userData')['userId'];
        $signature = ""; // we will use this to store the signatory actual signature
        $data = [];

        

        if (empty($certificate)) {
            return redirect()->to('/dashboard/nativecert')->with('error', 'Certificate not found.');
        }

        // check if the user is from this branch 
        if($branchId != $certificate['tradCertBranch'] || $branchId != 1){
            return redirect()->to('/dashboard/nativecert')->with('error', 'You are not allowed to affix signature to this doc');
            exit();
        }

        // check who wants to sign
        if(!(session()->get('userData')['userAccountType'] == "tradCertSignatoryA" || session()->get('userData')['userAccountType'] == "tradCertSignatoryB" || session()->get('userData')['userAccountType'] == "tradCertSignatoryC"))
        {
            return redirect()->to('/dashboard/nativecert')->with('error', 'You are not allowed to sign a traditional certificate');
            exit();
        }

        //  check if the certificate is signed - and if not set the signatory signature stored in the session (SIGNATORY A)
        if(session()->get('userData')['userAccountType'] == 'tradCertSignatoryA' && $certificate['tradCertSignatoryA'] == ''){
            $signature = session()->get('userData')['userSignature'];
            $data['tradCertSignatoryADate'] = date('Y-m-d'); 
            $data['tradCertSignatoryAID'] = session()->get('userData')['userId'];
        }

         //  check if the certificate is signed - and if not set the signatory signature stored in the session (SIGNATORY B)
        if(session()->get('userData')['userAccountType'] == 'tradCertSignatoryB' && $certificate['tradCertSignatoryB'] == ''){
            $signature = session()->get('userData')['userSignature'];
            $data['tradCertSignatoryBDate'] = date('Y-m-d'); 
            $data['tradCertSignatoryBID'] = session()->get('userData')['userId'];
        }

          //  check if the certificate is signed - and if not set the signatory signature stored in the session (SIGNATORY C)
        if(session()->get('userData')['userAccountType'] == 'tradCertSignatoryC' && $certificate['tradCertSignatoryC'] == ''){
            $signature = session()->get('userData')['userSignature'];
            $data['tradCertSignatoryCDate'] = date('Y-m-d'); 
            $data['tradCertSignatoryCID'] = session()->get('userData')['userId']; 
        }

        // check if a signature is set 
        if(empty($signature)){
            return redirect()->to('/dashboard/nativecert')->with('error', 'You must have signed this certificate or it was signed by the previous occupant of your position');
            exit();
        }

        $data[session()->get('userData')['userAccountType']] = $signature;
        $data['tradCertLastUpdatedBy'] = session()->get('userData')['userId'];

        // print_r($data);
        // exit();



         if ($this->certificateModel->update($id, $data)){
            return redirect()->to('/dashboard/nativecert')->with('success', 'You finally affixed your signature on a traditional certificate');
            exit();
         }else{
            return redirect()->to('/dashboard/nativecert')->with('error', 'Unknow error occured while affixing your signature');
            exit();
         }


    }

    /**
     * Check if certificate is completed (all signatories present)
     */
private function isCertificateCompleted($certificate): bool
    {
        return !empty($certificate['tradCertSignatoryA']) && 
               !empty($certificate['tradCertSignatoryB']) && 
               !empty($certificate['tradCertSignatoryC']);
    }

    /**
     * Get incomplete certificates (API endpoint)
     */
public function incomplete()
    {
        $certificates = $this->certificateModel->findAll();
        $incomplete = array_filter($certificates, function($cert) {
            return !$this->isCertificateCompleted($cert);
        });

        return $this->respond($incomplete);
    }


    /**
     * Get dashboard stats (API endpoint)
     */
public function stats()
    {
        $certificates = $this->certificateModel->findAll();
        
        $stats = [
            'total' => count($certificates),
            'completed' => count(array_filter($certificates, [$this, 'isCertificateCompleted'])),
            'pending' => count($certificates) - count(array_filter($certificates, [$this, 'isCertificateCompleted']))
        ];

        return $this->respond($stats);
    }


    /**
     * Get issued certificates (API endpoint)
     */
     private function isIssued($certificate): bool
    {
        return !empty($certificate['tradCertDateIssued']);
    }

    /**
     * Generate the certificate on a canvas
     */
    public function print($id)
    {
        $certificate = $this->certificateModel->find($id);
        if (!$certificate) {
            return redirect()->back()->with("error", "Certificate not found");
        }

        $data = [
            'certificate' => $certificate,
            'title' => 'Print Certificate - ' . $certificate['tradCertSn'],
            'passLink' => 'nativecert'
        ];

        //  print_r($data);
        // exit();

        return view('dashboard/generate_trad_certificate', $data);
    }


    /**
     * mark certificate as siiued
     */
    public function issue($id)
    {
        $data = $this->certificateModel->find($id);
         $branchId = session()->get('userData')['branchId'];
        $userId = session()->get('userData')['userId'];

        if (!$data) {
            return redirect()->back()->with("error", "Certificate not found");
        }

         // check if the user is from this branch 
        if($branchId != $data['tradCertBranch'] || $branchId != 1){
            return redirect()->to('/dashboard/nativecert')->with('error', 'Your breanch is not allow to mark this certificate as issued');
            exit();
        }

        // check if the the certificate is completed
        if(!$this->isCertificateCompleted($data)){
            return redirect()->to('/dashboard/nativecert')->with('error', 'Only completed certificates can be marked as issued');
            exit();
        }

        $data['tradCertDateIssued'] = date('Y-m-d H:i:s');
        $data['tradCertLastUpdatedBy'] = $userId;

        if ($this->certificateModel->update($id, $data)){
            return redirect()->to('/dashboard/nativecert')->with('success', 'Certificate marked as issued successfully');
            exit();
         }else{
            return redirect()->to('/dashboard/nativecert')->with('error', 'Unknow error occured while marking certificate as issued');
            exit();
         }

        
    }
    

    /**
     * Delete certificate
     */
    public function delete($id)
    {
        $certificate = $this->certificateModel->find($id);
        
        if (!$certificate) {
            return redirect()->to('/dashboard/nativecert')->with('error', 'Certificate not found.');
        }

            // check if the user is from this branch
        $branchId = session()->get('userData')['branchId'];
        if($branchId != $certificate['tradCertBranch'] || $branchId != 1){
            return redirect()->to('/dashboard/nativecert')->with('error', 'You are not allowed to delete this certificate');
            exit();
        }

         // check if the certificate is already issued - then disallow delete
        if($this->isIssued($certificate)){
            return redirect()->to('/dashboard/nativecert')->with('error', 'Issued certificates cannot be deleted');
            exit();
        }
        
        try {
            // Delete associated picture file if exists
            if (!empty($certificate['tradCertHolderPic']) && $certificate['tradCertHolderPic'] !== 'default-avatar.jpg') {
                $filePath = WRITEPATH . 'uploads/certificate_holders/' . $certificate['tradCertHolderPic'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            if ($this->certificateModel->delete($id)) {
                session()->setFlashdata('success', 'Certificate deleted successfully!');
            } else {
                throw new \Exception('Failed to delete certificate');
            }
        } catch (\Exception $e) {
            log_message('error', 'Certificate deletion failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'Failed to delete certificate. Please try again.');
        }

        return redirect()->to('/dashboard/nativecert');
    }



    /**
 * General dashboard - shows overall statistics across all branches
 */
public function generalDashboard()
{
    // Check if user has permission to view general dashboard
    // Only allow specific admin roles or higher-level users
    // $allowedRoles = ['super_admin', 'admin', 'SIGNC']; // Add appropriate roles
    // if (!in_array(session()->get('userData')['userAccountType'], $allowedRoles)) {
    //     return redirect()->to('/dashboard/nativecert')->with('error', 'Access denied to general dashboard');
    // }

    // Get certificates from ALL branches
    $certificates = $this->certificateModel
        ->orderBy('tradCertCertCreatedAt', 'DESC')
        ->join('login_users', 'login_users.userId = traditionalcertificates.tradCertInsertedBy')
        ->join('branchs_table', 'branchs_table.branchId = traditionalcertificates.tradCertBranch') // Corrected table name
        ->findAll();

    // Get branch statistics
    $branchStats = [];
    $allBranches = $this->branchModel->findAll();
    
    foreach ($allBranches as $branch) {
        $branchCertificates = $this->certificateModel
            ->where('tradCertBranch', $branch['branchId']) // Corrected column name
            ->findAll();
        
        $total = count($branchCertificates);
        $completed = 0;
        $pending = 0;
        
        foreach ($branchCertificates as $cert) {
            if (!empty($cert['tradCertSignatoryA']) && 
                !empty($cert['tradCertSignatoryB']) && 
                !empty($cert['tradCertSignatoryC'])) {
                $completed++;
            } else {
                $pending++;
            }
        }
        
        $branchStats[$branch['branchName']] = [ // Corrected column name
            'total' => $total,
            'completed' => $completed,
            'pending' => $pending,
            'completionRate' => $total > 0 ? round(($completed / $total) * 100, 2) : 0,
            'branch_id' => $branch['branchId'] // Corrected column name
        ];
    }

    // Calculate overall dashboard statistics
    $totalCertificates = count($certificates);
    $completedCertificates = 0;
    $pendingCertificates = 0;

    // Categorize certificates by county (across all branches)
    $countyStats = [];
    $branchWiseStats = [];

    foreach ($certificates as $cert) {
        // Check if certificate is completed
        if (!empty($cert['tradCertSignatoryA']) &&
            !empty($cert['tradCertSignatoryB']) &&
            !empty($cert['tradCertSignatoryC'])) {
            $completedCertificates++;
        } else {
            $pendingCertificates++;
        }

        // Count by county
        $county = $cert['tradCertHoldercounty'] ?? 'Unknown';
        if (!isset($countyStats[$county])) {
            $countyStats[$county] = 0;
        }
        $countyStats[$county]++;

        // Count by branch - use the correct column name from branchs_table
        $branchName = $cert['branchName'] ?? 'Unknown Branch'; // Corrected column name
        if (!isset($branchWiseStats[$branchName])) {
            $branchWiseStats[$branchName] = 0;
        }
        $branchWiseStats[$branchName]++;
    }

    // Recent activity (last 15 certificates across all branches)
    $recentCertificates = array_slice($certificates, 0, 15);

    // Certificates needing attention (missing signatories) across all branches
    $incompleteCertificates = array_filter($certificates, function ($cert) {
        return empty($cert['tradCertSignatoryA']) ||
            empty($cert['tradCertSignatoryB']) ||
            empty($cert['tradCertSignatoryC']);
    });

    // Monthly statistics for charts
    $monthlyStats = $this->getMonthlyStatistics();

    $data = [
        'title' => 'General Traditional Certificates Dashboard - All Branches',
        'certificates' => $certificates,
        'recentCertificates' => $recentCertificates,
        'incompleteCertificates' => $incompleteCertificates,
        'dashboardStats' => [
            'total' => $totalCertificates,
            'completed' => $completedCertificates,
            'pending' => $pendingCertificates,
            'completionRate' => $totalCertificates > 0
                ? round(($completedCertificates / $totalCertificates) * 100, 2)
                : 0,
            'totalBranches' => count($allBranches)
        ],
        'countyStats' => $countyStats,
        'branchStats' => $branchStats,
        'branchWiseStats' => $branchWiseStats,
        'monthlyStats' => $monthlyStats,
        'passLink' => 'nativecert_general'
    ];

    return view('dashboard/general_herbal_dashboard', $data);
}


/**
 * Get monthly statistics for charts
 */
private function getMonthlyStatistics()
{
    $currentYear = date('Y');
    $monthlyData = [];
    
    for ($month = 1; $month <= 12; $month++) {
        $startDate = date("{$currentYear}-{$month}-01");
        $endDate = date("{$currentYear}-{$month}-t", strtotime($startDate));
        
        $monthCertificates = $this->certificateModel
            ->where('tradCertCertCreatedAt >=', $startDate)
            ->where('tradCertCertCreatedAt <=', $endDate)
            ->findAll();
        
        $completed = 0;
        foreach ($monthCertificates as $cert) {
            if (!empty($cert['tradCertSignatoryA']) && 
                !empty($cert['tradCertSignatoryB']) && 
                !empty($cert['tradCertSignatoryC'])) {
                $completed++;
            }
        }
        
        $monthlyData[] = [
            'month' => date('M', strtotime($startDate)),
            'total' => count($monthCertificates),
            'completed' => $completed,
            'pending' => count($monthCertificates) - $completed
        ];
    }
    
    return $monthlyData;
}
}
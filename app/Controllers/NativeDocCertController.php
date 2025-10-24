<?php

namespace App\Controllers;

use App\Models\TraditionalCertificateModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class NativeDocCertController extends BaseController
{
    use ResponseTrait;

    protected $certificateModel;

    public function __construct()
    {
        $this->certificateModel = new TraditionalCertificateModel();
        helper(['form', 'url', 'session']);
    }

    /**
     * Dashboard - Display summary and certificate logs
     */
    public function index(): string
    {
          

        // Get all certificates for the log
        $certificates = $this->certificateModel
            ->orderBy('tradCertCertCreatedAt', 'DESC')
            ->findAll();

        // Calculate dashboard statistics
        $totalCertificates = count($certificates);
        $completedCertificates = 0;
        $pendingCertificates = 0;
        $onlineApplications = 0;
        $branchApplications = 0;

        // Categorize certificates by county
        $countyStats = [];
        
        foreach ($certificates as $cert) {
            // Check if certificate is completed (all signatories present)
            if (!empty($cert['tradCertSignatoryA']) && 
                !empty($cert['tradCertSignatoryB']) && 
                !empty($cert['tradCertSignatoryC'])) {
                $completedCertificates++;
            } else {
                $pendingCertificates++;
            }

            // Count application types
            if ($cert['tradCertAppliedType'] === 'online') {
                $onlineApplications++;
            } else {
                $branchApplications++;
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
        $incompleteCertificates = array_filter($certificates, function($cert) {
            return empty($cert['tradCertSignatoryA']) || 
                   empty($cert['tradCertSignatoryB']) || 
                   empty($cert['tradCertSignatoryC']);
        });

        $data = [
            'title' => 'Certificates Dashboard',
            'certificates' => $certificates,
            'recentCertificates' => $recentCertificates,
            'incompleteCertificates' => $incompleteCertificates,
            'dashboardStats' => [
                'total' => $totalCertificates,
                'completed' => $completedCertificates,
                'pending' => $pendingCertificates,
                'online' => $onlineApplications,
                'branch' => $branchApplications,
                'completionRate' => $totalCertificates > 0 ? round(($completedCertificates / $totalCertificates) * 100, 2) : 0
            ],
            'countyStats' => $countyStats
        ];

        $data['title'] = 'Log Divorce Certificate';
        $data['passLink'] = 'certificates';

    return view('dashboard/herbal_certificate_dashboard', $data);

    }

    /**
     * Show form for creating new certificate
     */
    public function new(): string
    {

         $data['title'] = 'Log Divorce Certificate';
        $data['passLink'] = 'certificates';

        return view('dashboard/create_herbal_certificate', $data);
    }

    /**
     * Create a new certificate
     */
    public function create()
    {
        // Validation rules with custom error messages
        $validationRules = [
            'tradCertHolderName' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Certificate holder name is required',
                    'min_length' => 'Holder name must be at least 2 characters long',
                    'max_length' => 'Holder name cannot exceed 255 characters'
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
            'tradCertHolderDistrict' => [
                'rules' => 'permit_empty|min_length[2]|max_length[100]',
                'errors' => [
                    'min_length' => 'District must be at least 2 characters long',
                    'max_length' => 'District cannot exceed 100 characters'
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
                    'required' => 'Operation type is required',
                    'min_length' => 'Operation type must be at least 2 characters long',
                    'max_length' => 'Operation type cannot exceed 200 characters'
                ]
            ],
            'tradCertDateIssued' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Issue date is required',
                    'valid_date' => 'Please enter a valid date'
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
            'tradCertSignatoryA' => [
                'rules' => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length' => 'Signatory A name must be at least 2 characters long',
                    'max_length' => 'Signatory A name cannot exceed 255 characters'
                ]
            ],
            'tradCertSignatoryB' => [
                'rules' => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length' => 'Signatory B name must be at least 2 characters long',
                    'max_length' => 'Signatory B name cannot exceed 255 characters'
                ]
            ],
            'tradCertSignatoryC' => [
                'rules' => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length' => 'Signatory C name must be at least 2 characters long',
                    'max_length' => 'Signatory C name cannot exceed 255 characters'
                ]
            ],
            'tradCertAppliedType' => [
                'rules' => 'required|in_list[online,branch]',
                'errors' => [
                    'required' => 'Application type is required',
                    'in_list' => 'Please select either online or branch application'
                ]
            ],
            'tradCertBranch' => [
                'rules' => 'permit_empty|min_length[2]|max_length[150]',
                'errors' => [
                    'min_length' => 'Branch name must be at least 2 characters long',
                    'max_length' => 'Branch name cannot exceed 150 characters'
                ]
            ],
            'tradRevenueNo' => [
                'rules' => 'permit_empty|min_length[2]|max_length[100]',
                'errors' => [
                    'min_length' => 'Revenue number must be at least 2 characters long',
                    'max_length' => 'Revenue number cannot exceed 100 characters'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get validated data
        $data = $this->request->getPost();

        // Set inserted by user (from session)
        $data['tradCertInsertedBy'] = session()->get('user_id') ?? 'system';

        try {
            if ($this->certificateModel->save($data)) {
                $certificateId = $this->certificateModel->getInsertID();
                $certificate = $this->certificateModel->find($certificateId);
                
                session()->setFlashdata('success', 
                    "Certificate created successfully! Serial Number: {$certificate['tradCertSn']}");
                
                return redirect()->to('/certificates');
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
        $certificate = $this->certificateModel->find($id);
        
        if (!$certificate) {
            return redirect()->to('/certificates')->with('error', 'Certificate not found.');
        }

        $data = [
            'title' => 'View Certificate - ' . $certificate['tradCertSn'],
            'certificate' => $certificate,
            'isCompleted' => $this->isCertificateCompleted($certificate)
        ];

        return view('certificates/view', $data);
    }

    /**
     * Edit certificate form
     */
    public function edit($id)
    {
        $certificate = $this->certificateModel->find($id);
        
        if (!$certificate) {
            return redirect()->to('/certificates')->with('error', 'Certificate not found.');
        }

        $data = [
            'title' => 'Edit Certificate - ' . $certificate['tradCertSn'],
            'certificate' => $certificate,
            'validation' => \Config\Services::validation()
        ];

        return view('certificates/edit', $data);
    }

    /**
     * Update certificate
     */
    public function update($id)
    {
        $certificate = $this->certificateModel->find($id);
        
        if (!$certificate) {
            return redirect()->to('/certificates')->with('error', 'Certificate not found.');
        }

        // Validation rules (same as create)
        $validationRules = [
            'tradCertHolderName' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Certificate holder name is required',
                    'min_length' => 'Holder name must be at least 2 characters long',
                    'max_length' => 'Holder name cannot exceed 255 characters'
                ]
            ],
            // Include other validation rules from create method...
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();
        $data['tradCertLastUpdatedBy'] = session()->get('user_id') ?? 'system';

        try {
            if ($this->certificateModel->update($id, $data)) {
                session()->setFlashdata('success', 'Certificate updated successfully!');
                return redirect()->to('/certificates/view/' . $id);
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
        
        if (!$certificate) {
            return redirect()->to('/certificates')->with('error', 'Certificate not found.');
        }

        $validationRules = [
            'tradCertSignatoryA' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Signatory A is required to complete certificate',
                    'min_length' => 'Signatory A name must be at least 2 characters long'
                ]
            ],
            'tradCertSignatoryB' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Signatory B is required to complete certificate',
                    'min_length' => 'Signatory B name must be at least 2 characters long'
                ]
            ],
            'tradCertSignatoryC' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Signatory C is required to complete certificate',
                    'min_length' => 'Signatory C name must be at least 2 characters long'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tradCertSignatoryA' => $this->request->getPost('tradCertSignatoryA'),
            'tradCertSignatoryB' => $this->request->getPost('tradCertSignatoryB'),
            'tradCertSignatoryC' => $this->request->getPost('tradCertSignatoryC'),
            'tradCertLastUpdatedBy' => session()->get('user_id') ?? 'system'
        ];

        try {
            if ($this->certificateModel->update($id, $data)) {
                session()->setFlashdata('success', 'Certificate completed with all signatories!');
                return redirect()->to('/certificates/view/' . $id);
            } else {
                throw new \Exception('Failed to add signatories');
            }
        } catch (\Exception $e) {
            log_message('error', 'Adding signatories failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to add signatories. Please try again.');
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
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\TraditionalCertificateModel;
use App\Models\UsersModel;
use App\Models\NotificationModel;

class WeddingNDivorceDashboard extends BaseController
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
        // Check if user has access to matrimonial dashboard
        if(session()->get('userData')['userDepartment'] != "Matrimonial"){
            return redirect()->to('/logout')->with('error', 'You do not have access to the Wedding & Divorce Dashboard.');
        }

        $data['passLink'] = 'dashboard';
        $data['pageTitle'] = 'Matrimonial Management Dashboard';
        
        // Get current branch ID
        $branchId = session()->get('userData')['branchId'];
        
        // Check if switching branches
        if($this->request->getGet('branch') && !empty($this->request->getGet('branch'))){
            $branchId = $this->request->getGet('branch');
        }
        
        // Get branch details
        $data['branchDetail'] = $this->branchModel->find($branchId);
        $data['allBranches'] = $this->branchModel->findAll();
        
        // Calculate ALL statistics including pending breakdown
        $data['statistics'] = $this->getBranchStatistics($branchId);
        
        // Get signature breakdowns
        $data['signatureBreakdown'] = $this->getSignatureBreakdown($branchId);
        
        // Get recent activities with photos - simplified query
        $data['recentMarriages'] = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->orderBy('created_at', 'DESC')
            ->findAll(10);
        
        $data['recentDivorces'] = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->orderBy('divorcecreated_at', 'DESC')
            ->findAll(10);
        
        // Get monthly trends data
        $data['monthlyData'] = $this->getMonthlyTrends($branchId);

        // print_r($data['monthlyData']); exit;
        
        return view('dashboard/matrimonial_index', $data);
    }
    
    /**
     * Calculate branch statistics
     */
    private function getBranchStatistics($branchId)
    {
        // Marriage statistics
        $marriageTotal = $this->marriageModel->where('cert_branch', $branchId)->countAllResults();
        
        // Completed = All 3 signatures present
        $marriageCompleted = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->where('SIGNA IS NOT NULL')
            ->where('SIGNB IS NOT NULL')
            ->where('SIGNC IS NOT NULL')
            ->countAllResults();
        
        // Pending = Any or all signatures missing
        $marriagePending = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->groupStart()
                ->where('SIGNA IS NULL')
                ->orWhere('SIGNB IS NULL')
                ->orWhere('SIGNC IS NULL')
            ->groupEnd()
            ->countAllResults();
        
        // Issued = isWedCertIssued = 1
        $issuedMarriages = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->where('isWedCertIssued', 1)
            ->countAllResults();
        
        // Divorce statistics
        $divorceTotal = $this->divorceModel->where('divorcebreanch_id', $branchId)->countAllResults();
        
        // Completed = All 3 signatures present
        $divorceCompleted = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->where('divorceSIGN_A IS NOT NULL')
            ->where('divorceSIGN_B IS NOT NULL')
            ->where('divorceSIGN_C IS NOT NULL')
            ->countAllResults();
        
        // Pending = Any or all signatures missing
        $divorcePending = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->groupStart()
                ->where('divorceSIGN_A IS NULL')
                ->orWhere('divorceSIGN_B IS NULL')
                ->orWhere('divorceSIGN_C IS NULL')
            ->groupEnd()
            ->countAllResults();
        
        // Issued = divorceIsIssued = 1
        $issuedDivorces = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->where('divorceIsIssued', 1)
            ->countAllResults();
        
        // User statistics
        $branchUsers = $this->userModel->where('userBreanch', $branchId)->countAllResults();
        
        // Calculate rates
        $totalCerts = $marriageTotal + $divorceTotal;
        $completedCerts = $marriageCompleted + $divorceCompleted;
        $pendingCerts = $marriagePending + $divorcePending;
        $issuedCerts = $issuedMarriages + $issuedDivorces;
        
        $completionRate = $totalCerts > 0 ? round(($completedCerts / $totalCerts) * 100) : 0;
        $issueRate = $totalCerts > 0 ? round(($issuedCerts / $totalCerts) * 100) : 0;
        $pendingRate = $totalCerts > 0 ? round(($pendingCerts / $totalCerts) * 100) : 0;
        
        return [
            'marriages' => [
                'total' => $marriageTotal,
                'completed' => $marriageCompleted,
                'pending' => $marriagePending,
                'issued' => $issuedMarriages,
                'completion_rate' => $marriageTotal > 0 ? round(($marriageCompleted / $marriageTotal) * 100) : 0,
                'issue_rate' => $marriageTotal > 0 ? round(($issuedMarriages / $marriageTotal) * 100) : 0,
                'pending_rate' => $marriageTotal > 0 ? round(($marriagePending / $marriageTotal) * 100) : 0
            ],
            'divorces' => [
                'total' => $divorceTotal,
                'completed' => $divorceCompleted,
                'pending' => $divorcePending,
                'issued' => $issuedDivorces,
                'completion_rate' => $divorceTotal > 0 ? round(($divorceCompleted / $divorceTotal) * 100) : 0,
                'issue_rate' => $divorceTotal > 0 ? round(($issuedDivorces / $divorceTotal) * 100) : 0,
                'pending_rate' => $divorceTotal > 0 ? round(($divorcePending / $divorceTotal) * 100) : 0
            ],
            'users' => $branchUsers,
            'total_certificates' => $totalCerts,
            'completed_certificates' => $completedCerts,
            'pending_certificates' => $pendingCerts,
            'issued_certificates' => $issuedCerts,
            'overall_completion_rate' => $completionRate,
            'overall_issue_rate' => $issueRate,
            'overall_pending_rate' => $pendingRate
        ];
    }
    
    /**
     * Get signature breakdown details
     */
    private function getSignatureBreakdown($branchId)
    {
        // Marriage signature breakdowns
        $marriageMissingOne = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->groupStart()
                ->where('SIGNA IS NOT NULL')
                ->where('SIGNB IS NOT NULL')
                ->where('SIGNC IS NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('SIGNA IS NOT NULL')
                ->where('SIGNB IS NULL')
                ->where('SIGNC IS NOT NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('SIGNA IS NULL')
                ->where('SIGNB IS NOT NULL')
                ->where('SIGNC IS NOT NULL')
            ->groupEnd()
            ->countAllResults();
        
        $marriageMissingTwo = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->groupStart()
                ->where('SIGNA IS NOT NULL')
                ->where('SIGNB IS NULL')
                ->where('SIGNC IS NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('SIGNA IS NULL')
                ->where('SIGNB IS NOT NULL')
                ->where('SIGNC IS NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('SIGNA IS NULL')
                ->where('SIGNB IS NULL')
                ->where('SIGNC IS NOT NULL')
            ->groupEnd()
            ->countAllResults();
        
        $marriageMissingAll = $this->marriageModel
            ->where('cert_branch', $branchId)
            ->where('SIGNA IS NULL')
            ->where('SIGNB IS NULL')
            ->where('SIGNC IS NULL')
            ->countAllResults();
        
        // Divorce signature breakdowns
        $divorceMissingOne = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->groupStart()
                ->where('divorceSIGN_A IS NOT NULL')
                ->where('divorceSIGN_B IS NOT NULL')
                ->where('divorceSIGN_C IS NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('divorceSIGN_A IS NOT NULL')
                ->where('divorceSIGN_B IS NULL')
                ->where('divorceSIGN_C IS NOT NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('divorceSIGN_A IS NULL')
                ->where('divorceSIGN_B IS NOT NULL')
                ->where('divorceSIGN_C IS NOT NULL')
            ->groupEnd()
            ->countAllResults();
        
        $divorceMissingTwo = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->groupStart()
                ->where('divorceSIGN_A IS NOT NULL')
                ->where('divorceSIGN_B IS NULL')
                ->where('divorceSIGN_C IS NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('divorceSIGN_A IS NULL')
                ->where('divorceSIGN_B IS NOT NULL')
                ->where('divorceSIGN_C IS NULL')
            ->groupEnd()
            ->orGroupStart()
                ->where('divorceSIGN_A IS NULL')
                ->where('divorceSIGN_B IS NULL')
                ->where('divorceSIGN_C IS NOT NULL')
            ->groupEnd()
            ->countAllResults();
        
        $divorceMissingAll = $this->divorceModel
            ->where('divorcebreanch_id', $branchId)
            ->where('divorceSIGN_A IS NULL')
            ->where('divorceSIGN_B IS NULL')
            ->where('divorceSIGN_C IS NULL')
            ->countAllResults();
        
        $totalMissingOne = $marriageMissingOne + $divorceMissingOne;
        $totalMissingTwo = $marriageMissingTwo + $divorceMissingTwo;
        $totalMissingAll = $marriageMissingAll + $divorceMissingAll;
        $totalPending = $totalMissingOne + $totalMissingTwo + $totalMissingAll;
        
        return [
            'marriages' => [
                'missing_one' => $marriageMissingOne,
                'missing_two' => $marriageMissingTwo,
                'missing_all' => $marriageMissingAll,
                'total_pending' => $marriageMissingOne + $marriageMissingTwo + $marriageMissingAll
            ],
            'divorces' => [
                'missing_one' => $divorceMissingOne,
                'missing_two' => $divorceMissingTwo,
                'missing_all' => $divorceMissingAll,
                'total_pending' => $divorceMissingOne + $divorceMissingTwo + $divorceMissingAll
            ],
            'total_missing_one' => $totalMissingOne,
            'total_missing_two' => $totalMissingTwo,
            'total_missing_all' => $totalMissingAll,
            'total_pending_documents' => $totalPending
        ];
    }
    
    /**
     * Get monthly trends data for charts
     */
    private function getMonthlyTrends($branchId)
    {
        $currentYear = date('Y');
        
        // Get monthly marriage data
        $monthlyMarriages = $this->marriageModel
            ->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
            ->where('cert_branch', $branchId)
            ->where("YEAR(created_at)", $currentYear)
            ->groupBy("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderBy("month", "ASC")
            ->findAll();
        
        // Get monthly divorce data
        $monthlyDivorces = $this->divorceModel
            ->select("DATE_FORMAT(divorcecreated_at, '%Y-%m') as month, COUNT(*) as count")
            ->where('divorcebreanch_id', $branchId)
            ->where("YEAR(divorcecreated_at)", $currentYear)
            ->groupBy("DATE_FORMAT(divorcecreated_at, '%Y-%m')")
            ->orderBy("month", "ASC")
            ->findAll();
        
        // Create array of all months in the year
        $allMonths = [];
        for ($i = 1; $i <= 12; $i++) {
            $allMonths[] = sprintf('%04d-%02d', $currentYear, $i);
        }
        
        // Map data to all months
        $marriageData = $this->mapMonthlyData($allMonths, $monthlyMarriages);
        $divorceData = $this->mapMonthlyData($allMonths, $monthlyDivorces);
        
        return [
            'labels' => array_map(function($m) { 
                return date('M', strtotime($m)); 
            }, $allMonths),
            'marriages' => $marriageData,
            'divorces' => $divorceData,
            'year' => $currentYear
        ];
    }
    
    /**
     * Helper function to map monthly data
     */
    private function mapMonthlyData($allMonths, $dbData)
    {
        $dataMap = [];
        foreach ($dbData as $item) {
            $dataMap[$item['month']] = (int)$item['count'];
        }
        
        $result = [];
        foreach ($allMonths as $month) {
            $result[] = $dataMap[$month] ?? 0;
        }
        
        return $result;
    }

    public function general_dashboard()
    {
        $data['passLink'] = 'dashboard';

        // System-wide data
        $data['allMarriages'] = $this->marriageModel
                            ->select('marriage_certificates.*, branchs_table.branchName')
                            ->join('branchs_table', 'marriage_certificates.cert_branch = branchs_table.branchId')
                            ->orderBy('created_at', 'DESC')
                            ->findAll();

        $data['allDivorces'] = $this->divorceModel
                            ->select('divorce_certificates.*, branchs_table.branchName')
                            ->join('branchs_table', 'divorce_certificates.divorcebreanch_id = branchs_table.branchId')
                            ->orderBy('divorcecreated_at', 'DESC')
                            ->findAll();

        // Traditional certificates data
        $data['allTraditionalCerts'] = $this->traditionalModel
                                  ->select('traditionalcertificates.*, branchs_table.branchName')
                                  ->join('branchs_table', 'traditionalcertificates.tradCertBranch = branchs_table.branchId')
                                  ->orderBy('tradCertCertCreatedAt', 'DESC')
                                  ->findAll();

        // Counts for cards
        $data['totalMarriages'] = $this->marriageModel->countAll();
        $data['totalUncompletedMarriages'] = $this->marriageModel
                                            ->where('SIGNA', NULL)
                                            ->orWhere('SIGNB', NULL)
                                            ->orWhere('SIGNC', NULL)
                                            ->countAllResults();
        
        $data['totalDivorces'] = $this->divorceModel->countAll();
        $data['totalUncompletedDivorces'] = $this->divorceModel
                                            ->where('divorceSIGN_A', NULL)
                                            ->orWhere('divorceSIGN_B', NULL)
                                            ->orWhere('divorceSIGN_C', NULL)
                                           ->countAllResults();

        // Traditional certificates counts
        $data['totalTraditionalCerts'] = $this->traditionalModel->countAll();
        $data['totalUncompletedTraditionalCerts'] = $this->traditionalModel
                                                   ->where('tradCertSignatoryA', NULL)
                                                   ->orWhere('tradCertSignatoryB', NULL)
                                                   ->orWhere('tradCertSignatoryC', NULL)
                                                   ->countAllResults();

        // Branch data with counts for charts
        $data['marriagesPerBranch'] = $this->marriageModel
                                ->select('branchs_table.branchId, branchs_table.branchName, COUNT(marriage_certificates.marriage_cert_id) as count')
                                ->join('branchs_table', 'marriage_certificates.cert_branch = branchs_table.branchId')
                                ->groupBy('branchs_table.branchId, branchs_table.branchName')
                                ->orderBy('branchs_table.branchName')
                                ->findAll();
                                
        $data['divorcesPerBranch'] = $this->divorceModel
                                ->select('branchs_table.branchId, branchs_table.branchName, COUNT(divorce_certificates.divorceCertId) as count')
                                ->join('branchs_table', 'divorce_certificates.divorcebreanch_id = branchs_table.branchId')
                                ->groupBy('branchs_table.branchId, branchs_table.branchName')
                                ->orderBy('branchs_table.branchName')
                                ->findAll();

        // Traditional certificates per branch
        $data['traditionalCertsPerBranch'] = $this->traditionalModel
                                        ->select('branchs_table.branchId, branchs_table.branchName, COUNT(traditionalcertificates.tradCertId) as count')
                                        ->join('branchs_table', 'traditionalcertificates.tradCertBranch = branchs_table.branchId')
                                        ->groupBy('branchs_table.branchId, branchs_table.branchName')
                                        ->orderBy('branchs_table.branchName')
                                        ->findAll();

        // Get all branches for consistent chart display
        $data['allBranches'] = $this->branchModel
                            ->select('branchId, branchName, branchCode')
                            ->orderBy('branchName')
                            ->findAll();

        // Additional counts
        $data['totalBranches'] = $this->branchModel->countAll();
        $data['totalUsers'] = $this->userModel->countAll();

        // Prepare data for charts
        $data['chartData'] = [
            'branchCode' => array_column($data['allBranches'], 'branchCode'),
            'marriageCounts' => $this->mapCountsToBranches($data['allBranches'], $data['marriagesPerBranch']),
            'divorceCounts' => $this->mapCountsToBranches($data['allBranches'], $data['divorcesPerBranch']),
            'traditionalCounts' => $this->mapCountsToBranches($data['allBranches'], $data['traditionalCertsPerBranch']),
            'totalCertificates' => [
                'marriages' => $data['totalMarriages'],
                'divorces' => $data['totalDivorces'],
                'traditional' => $data['totalTraditionalCerts'],
                'completedMarriages' => $data['totalMarriages'] - $data['totalUncompletedMarriages'],
                'pendingMarriages' => $data['totalUncompletedMarriages'],
                'completedDivorces' => $data['totalDivorces'] - $data['totalUncompletedDivorces'],
                'pendingDivorces' => $data['totalUncompletedDivorces'],
                'completedTraditional' => $data['totalTraditionalCerts'] - $data['totalUncompletedTraditionalCerts'],
                'pendingTraditional' => $data['totalUncompletedTraditionalCerts']
            ]
        ];

        return view('dashboard/general_dashboard', $data);
    }

    // Helper function to map counts to all branches (including zero counts)
    private function mapCountsToBranches($allBranches, $countedBranches)
    {
        $countMap = [];
        foreach ($countedBranches as $branch) {
            $countMap[$branch['branchId']] = $branch['count'];
        }

        $result = [];
        foreach ($allBranches as $branch) {
            $result[] = $countMap[$branch['branchId']] ?? 0;
        }

        return $result;
    }
}
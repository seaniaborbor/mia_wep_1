<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\TraditionalCertificateModel;
use App\Models\UsersModel;
use App\Models\NotificationModel;

class DashboardController extends BaseController
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
      // check if the user account is allowed to view marriage certificate activities
        if(!in_array(session()->get('userData')['userAccountType'], ['SIGNA', 'SIGNB', 'SIGNC', 'VIEWER', 'ENTRY'])){
            // redirect to /dashboard/nativecert
            return redirect()->to('/dashboard/nativecert');
            exit();
        }

    $data['passLink'] = 'dashboard';
    $branchId = session()->get('userData')['branchId'];
    
    // Branch-specific data
    $data['branchMarriages'] = $this->marriageModel->where('cert_branch', $branchId)
                                                  ->orderBy('created_at', 'DESC')
                                                  ->findAll(1000);
    $data['branchDivorces'] = $this->divorceModel->where('divorcebreanch_id', $branchId)
                                                ->orderBy('divorcecreated_at', 'DESC')
                                                ->findAll(1000);
    $data['branchUsers'] = $this->userModel->where('userBreanch', $branchId)
                                          ->orderBy('userDateCreated', 'DESC')
                                          ->findAll(1000);
    
    // Counts for cards
    $data['totalBranchMarriages'] = $this->marriageModel->where('cert_branch', $branchId)->countAllResults();
    $data['totalBranchDivorces'] = $this->divorceModel->where('divorcebreanch_id', $branchId)->countAllResults();
    $data['totalBranchUsers'] = $this->userModel->where('userBreanch', $branchId)->countAllResults();

    // Data for charts
    $data['marriageStatusData'] = [
        'completed' => $this->marriageModel
                          ->where('cert_branch', $branchId)
                          ->where('SIGNA IS NOT NULL')
                          ->where('SIGNB IS NOT NULL')
                          ->where('SIGNC IS NOT NULL')
                          ->countAllResults(),
        'pending' => $this->marriageModel
                        ->where('cert_branch', $branchId)
                        ->groupStart()
                          ->where('SIGNA IS NULL')
                          ->orWhere('SIGNB IS NULL')
                          ->orWhere('SIGNC IS NULL')
                        ->groupEnd()
                        ->countAllResults()
    ];

    $data['divorceStatusData'] = [
        'completed' => $this->divorceModel
                          ->where('divorcebreanch_id', $branchId)
                          ->where('divorceSIGN_A IS NOT NULL')
                          ->where('divorceSIGN_B IS NOT NULL')
                          ->where('divorceSIGN_C IS NOT NULL')
                          ->countAllResults(),
        'pending' => $this->divorceModel
                        ->where('divorcebreanch_id', $branchId)
                        ->groupStart()
                          ->where('divorceSIGN_A IS NULL')
                          ->orWhere('divorceSIGN_B IS NULL')
                          ->orWhere('divorceSIGN_C IS NULL')
                        ->groupEnd()
                        ->countAllResults()
    ];

    // Monthly data for line chart
    $currentYear = date('Y');
    $monthlyMarriages = $this->marriageModel
        ->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
        ->where('cert_branch', $branchId)
        ->where("YEAR(created_at)", $currentYear)
        ->groupBy("DATE_FORMAT(created_at, '%Y-%m')")
        ->orderBy("month", "ASC")
        ->findAll();

    $monthlyDivorces = $this->divorceModel
        ->select("DATE_FORMAT(divorcecreated_at, '%Y-%m') as month, COUNT(*) as count")
        ->where('divorcebreanch_id', $branchId)
        ->where("YEAR(divorcecreated_at)", $currentYear)
        ->groupBy("DATE_FORMAT(divorcecreated_at, '%Y-%m')")
        ->orderBy("month", "ASC")
        ->findAll();

    // Prepare monthly data for all months
    $allMonths = [];
    for ($i = 1; $i <= 12; $i++) {
        $allMonths[] = sprintf('%04d-%02d', $currentYear, $i);
    }

    $data['monthlyData'] = [
        'labels' => array_map(function($m) { return date('M', strtotime($m)); }, $allMonths),
        'marriages' => $this->mapMonthlyData($allMonths, $monthlyMarriages),
        'divorces' => $this->mapMonthlyData($allMonths, $monthlyDivorces)
    ];

    return view('dashboard/index', $data);
}

private function mapMonthlyData($allMonths, $dbData)
{
    $dataMap = [];
    foreach ($dbData as $item) {
        $dataMap[$item['month']] = $item['count'];
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
                                  ->select('TraditionalCertificates.*, branchs_table.branchName')
                                  ->join('branchs_table', 'TraditionalCertificates.tradCertBranch = branchs_table.branchId')
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
                                        ->select('branchs_table.branchId, branchs_table.branchName, COUNT(TraditionalCertificates.tradCertId) as count')
                                        ->join('branchs_table', 'TraditionalCertificates.tradCertBranch = branchs_table.branchId')
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
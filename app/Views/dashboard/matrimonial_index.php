<?php $this->extend('dashboard/partials/layout') ?>
<?=$this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Marriage & Divorce Dashboard</h1>
            <div class="mb-4">
                <span class="h5 text-gray-900">
                    <?php if(isset($breanchDetail) && !empty($breanchDetail)): ?>
                        <?= esc($breanchDetail['branchName']) ?>
                    <?php else: ?>
                        <?= esc(session()->get('userData')['branchName']) ?>
                    <?php endif; ?>
                </span>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="branchDropdown" data-toggle="dropdown">
                <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                <?php
                    $currentBranch = 'Switch Branch';
                    if (isset($branchDetail['branchId']) && !empty($allBranches)) {
                        foreach ($allBranches as $b) {
                            if ($b['branchId'] == $branchDetail['branchId']) {
                                $currentBranch = esc($b['branchName']);
                                break;
                            }
                        }
                    }
                    echo $currentBranch;
                ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="branchDropdown">
                <?php foreach ($allBranches as $branch): ?>
                    <a class="dropdown-item <?= ($branch['branchId'] == ($branchDetail['branchId'] ?? '')) ? 'active' : '' ?>"
                       href="/matrimonial_dashboard?branch=<?= esc($branch['branchId']) ?>">
                        <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= esc($branch['branchName']) ?>
                    </a>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/matrimonial_dashboard">
                    <i class="fas fa-flag fa-sm fa-fw mr-2 text-gray-400"></i>
                    Nation's Dashboard
                </a>
            </div>
        </div>
    </div>
    

    <!-- Content Row - Stats Cards -->
    <div class="row">

        <!-- Marriage Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Marriage Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchMarriages ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ring fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Divorce Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchDivorces ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heart-broken fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branch Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Branch Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchUsers ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overall Completion -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Overall Completion
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalBranchMarriages + $totalBranchDivorces > 0
                                    ? round((($marriageStatusData['completed'] + $divorceStatusData['completed']) / ($totalBranchMarriages + $totalBranchDivorces)) * 100)
                                    : 0 ?>%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Status Progress Cards -->
    <div class="row">

        <!-- Marriage Status -->
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Marriage Certificates Status</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-success font-weight-bold">Completed</span>
                            <span><?= $marriageStatusData['completed'] ?></span>
                        </div>
                        <div class="progress mt-2" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: <?= $totalBranchMarriages > 0 ? ($marriageStatusData['completed'] / $totalBranchMarriages) * 100 : 0 ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <span class="text-warning font-weight-bold">Pending</span>
                            <span><?= $marriageStatusData['pending'] ?></span>
                        </div>
                        <div class="progress mt-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: <?= $totalBranchMarriages > 0 ? ($marriageStatusData['pending'] / $totalBranchMarriages) * 100 : 0 ?>%"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Total: <strong class="text-primary"><?= $totalBranchMarriages ?></strong></span>
                        <span class="font-weight-bold text-success">
                            <?= $totalBranchMarriages > 0 ? round(($marriageStatusData['completed'] / $totalBranchMarriages) * 100) : 0 ?>% Completed
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Status -->
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-danger">Divorce Certificates Status</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-success font-weight-bold">Completed</span>
                            <span><?= $divorceStatusData['completed'] ?></span>
                        </div>
                        <div class="progress mt-2" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: <?= $totalBranchDivorces > 0 ? ($divorceStatusData['completed'] / $totalBranchDivorces) * 100 : 0 ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <span class="text-warning font-weight-bold">Pending</span>
                            <span><?= $divorceStatusData['pending'] ?></span>
                        </div>
                        <div class="progress mt-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: <?= $totalBranchDivorces > 0 ? ($divorceStatusData['pending'] / $totalBranchDivorces) * 100 : 0 ?>%"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Total: <strong class="text-danger"><?= $totalBranchDivorces ?></strong></span>
                        <span class="font-weight-bold text-success">
                            <?= $totalBranchDivorces > 0 ? round(($divorceStatusData['completed'] / $totalBranchDivorces) * 100) : 0 ?>% Completed
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Monthly Trend Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Monthly Trends - <?= date('Y') ?></h6>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <canvas id="monthlyTrendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Certificate Logs Table Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Certificate Logs</h6>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="certificateTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="marriage-tab" data-toggle="tab" href="#marriage" role="tab">
                        <i class="fas fa-ring mr-2"></i>Marriage Certificates
                        <span class="badge badge-primary badge-counter ml-2"><?= count($branchMarriages) ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="divorce-tab" data-toggle="tab" href="#divorce" role="tab">
                        <i class="fas fa-heart-broken mr-2"></i>Divorce Certificates
                        <span class="badge badge-danger badge-counter ml-2"><?= count($branchDivorces) ?></span>
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                <div class="tab-pane fade show active" id="marriage" role="tabpanel">
                    <?php include('partials/tables/marriage_certificates_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="divorce" role="tabpanel">
                    <?php include('partials/tables/divorce_certificates_table.php'); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('monthlyTrendChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($monthlyData['labels']) ?>,
            datasets: [{
                label: 'Marriages',
                data: <?= json_encode($monthlyData['marriages']) ?>,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                tension: 0.3,
                fill: true
            }, {
                label: 'Divorces',
                data: <?= json_encode($monthlyData['divorces']) ?>,
                borderColor: '#e74a3b',
                backgroundColor: 'rgba(231, 74, 59, 0.05)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: { padding: 10 },
            legend: { display: true, position: 'top' },
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }]
            }
        }
    });
});
</script>

<?=$this->endSection() ?>
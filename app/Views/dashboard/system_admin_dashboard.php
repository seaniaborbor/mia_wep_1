<?php $this->extend('dashboard/partials/layout') ?>
<?=$this->section('main') ?>

<div class="container-fluid mt-4">

    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?? 'System Admin Dashboard' ?></h1>
        <div class="d-none d-sm-inline-block">
            <span class="badge badge-info p-2">Last Updated: <?= date('F d, Y h:i A') ?></span>
        </div>
    </div>

    <!-- System Overview Row -->
    <div class="row">
        
        <!-- Branches Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Branches</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalBranchesActive + $totalBranchesInactive ?>
                            </div>
                            <div class="mt-2 mb-1">
                                <small class="text-success font-weight-bold">
                                    <i class="fas fa-check-circle fa-sm"></i> Active: <?= $totalBranchesActive ?>
                                </small>
                            </div>
                            <div>
                                <small class="text-secondary">
                                    <i class="fas fa-pause-circle fa-sm"></i> Inactive: <?= $totalBranchesInactive ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-code-branch fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                System Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalUserActive + $totalUserInactive ?>
                            </div>
                            <div class="mt-2 mb-1">
                                <small class="text-success font-weight-bold">
                                    <i class="fas fa-user-check fa-sm"></i> Active: <?= $totalUserActive ?>
                                </small>
                            </div>
                            <div>
                                <small class="text-secondary">
                                    <i class="fas fa-user-times fa-sm"></i> Inactive: <?= $totalUserInactive ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Certificates Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalMarriageCertificateLogged + $totalDivorceCertificateLogged + $totalTraditionalCertificateLogged ?>
                            </div>
                            <div class="mt-2">
                                <small class="text-info">Marriage: <?= $totalMarriageCertificateLogged ?></small><br>
                                <small class="text-warning">Divorce: <?= $totalDivorceCertificateLogged ?></small><br>
                                <small class="text-danger">Traditional: <?= $totalTraditionalCertificateLogged ?></small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-certificate fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Issued Certificates Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Issued Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalMarriageCertificateIssued + $totalDivorceCertificateIssued + $totalTraditionalCertificateIssued ?>
                            </div>
                            <div class="mt-2">
                                <small class="text-info">Marriage: <?= $totalMarriageCertificateIssued ?></small><br>
                                <small class="text-warning">Divorce: <?= $totalDivorceCertificateIssued ?></small><br>
                                <small class="text-danger">Traditional: <?= $totalTraditionalCertificateIssued ?></small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-stamp fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate Status Row -->
    <div class="row">
        
        <!-- Marriage Certificate Status -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info text-white">
                    <h6 class="m-0 font-weight-bold">Marriage Certificates</h6>
                    <span class="badge badge-light"><?= $totalMarriageCertificateLogged ?> Total</span>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="marriageChart"></canvas>
                    </div>
                    <div class="mt-4 text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Issued</div>
                                <div class="h5 mb-0"><?= $totalMarriageCertificateIssued ?></div>
                            </div>
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                                <div class="h5 mb-0"><?= $totalMarriageCertificateUncompleted ?></div>
                            </div>
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ready</div>
                                <div class="h5 mb-0"><?= $totalMarriageCertificateCompletedButNotIssued ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Certificate Status -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">Divorce Certificates</h6>
                    <span class="badge badge-light"><?= $totalDivorceCertificateLogged ?> Total</span>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="divorceChart"></canvas>
                    </div>
                    <div class="mt-4 text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Issued</div>
                                <div class="h5 mb-0"><?= $totalDivorceCertificateIssued ?></div>
                            </div>
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pending</div>
                                <div class="h5 mb-0"><?= $totalDivorceCertificatePending ?></div>
                            </div>
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ready</div>
                                <div class="h5 mb-0"><?= $totalDivorceCertificateCompletedButNotIssued ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traditional Certificate Status -->
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger text-white">
                    <h6 class="m-0 font-weight-bold">Traditional Certificates</h6>
                    <span class="badge badge-light"><?= $totalTraditionalCertificateLogged ?> Total</span>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="traditionalChart"></canvas>
                    </div>
                    <div class="mt-4 text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Issued</div>
                                <div class="h5 mb-0"><?= $totalTraditionalCertificateIssued ?></div>
                            </div>
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                                <div class="h5 mb-0"><?= $totalTraditionalCertificatePending ?></div>
                            </div>
                            <div class="col-4">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ready</div>
                                <div class="h5 mb-0"><?= $totalTraditionalCertificateCompletedButNotIssued ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row">
        
        <!-- Recent Marriage Certificates -->
        <div class="col-xl-4 col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-info text-white">
                    <h6 class="m-0 font-weight-bold">Recent Marriage Certificates</h6>
                    <span class="badge badge-light"><?= count($recentMarriageCertificates) ?> Recent</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php if (!empty($recentMarriageCertificates)): ?>
                            <?php foreach (array_slice($recentMarriageCertificates, 0, 5) as $cert): ?>
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">MC-<?= $cert['marriage_cert_id'] ?? 'N/A' ?></h6>
                                    <small>
                                        <?php 
                                            $signA = $cert['SIGNA'] ?? null;
                                            $signB = $cert['SIGNB'] ?? null;
                                            $signC = $cert['SIGNC'] ?? null;
                                            $issued = $cert['isWedCertIssued'] ?? null;
                                            
                                            if ($issued == 1) {
                                                echo '<span class="badge badge-success">Issued</span>';
                                            } elseif ($signA && $signB && $signC) {
                                                echo '<span class="badge badge-info">Ready</span>';
                                            } else {
                                                echo '<span class="badge badge-warning">Pending</span>';
                                            }
                                        ?>
                                    </small>
                                </div>
                                <small class="text-muted">
                                    <?= !empty($cert['created_at']) ? date('M d, Y', strtotime($cert['created_at'])) : 'Date N/A' ?>
                                </small>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-group-item text-center text-muted py-4">
                                No recent marriage certificates
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($recentMarriageCertificates) && count($recentMarriageCertificates) > 5): ?>
                    <div class="card-footer text-center">
                        <small class="text-info">+<?= count($recentMarriageCertificates) - 5 ?> more certificates</small>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Divorce Certificates -->
        <div class="col-xl-4 col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">Recent Divorce Certificates</h6>
                    <span class="badge badge-light"><?= count($recentDivorceCertificates) ?> Recent</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php if (!empty($recentDivorceCertificates)): ?>
                            <?php foreach (array_slice($recentDivorceCertificates, 0, 5) as $cert): ?>
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">DC-<?= $cert['divorceCertID'] ?? 'N/A' ?></h6>
                                    <small>
                                        <?php 
                                            $signA = $cert['divorceSIGN_A'] ?? null;
                                            $signB = $cert['divorceSIGN_B'] ?? null;
                                            $signC = $cert['divorceSIGN_C'] ?? null;
                                            $issued = $cert['divorceissuanceDate'] ?? null;
                                            
                                            if ($issued) {
                                                echo '<span class="badge badge-success">Issued</span>';
                                            } elseif ($signA && $signB && $signC) {
                                                echo '<span class="badge badge-info">Ready</span>';
                                            } else {
                                                echo '<span class="badge badge-warning">Pending</span>';
                                            }
                                        ?>
                                    </small>
                                </div>
                                <small class="text-muted">
                                    <?= !empty($cert['created_at']) ? date('M d, Y', strtotime($cert['created_at'])) : 'Date N/A' ?>
                                </small>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-group-item text-center text-muted py-4">
                                No recent divorce certificates
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($recentDivorceCertificates) && count($recentDivorceCertificates) > 5): ?>
                    <div class="card-footer text-center">
                        <small class="text-warning">+<?= count($recentDivorceCertificates) - 5 ?> more certificates</small>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Traditional Certificates -->
        <div class="col-xl-4 col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger text-white">
                    <h6 class="m-0 font-weight-bold">Recent Traditional Certificates</h6>
                    <span class="badge badge-light"><?= count($recentTraditionalCertificates) ?> Recent</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php if (!empty($recentTraditionalCertificates)): ?>
                            <?php foreach (array_slice($recentTraditionalCertificates, 0, 5) as $cert): ?>
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">TC-<?= $cert['tradCertID'] ?? 'N/A' ?></h6>
                                    <small>
                                        <?php 
                                            $signA = $cert['tradCertSignatoryA'] ?? null;
                                            $signB = $cert['tradCertSignatoryB'] ?? null;
                                            $signC = $cert['tradCertSignatoryC'] ?? null;
                                            $issued = $cert['tradCertDateIssued'] ?? null;
                                            
                                            if ($issued) {
                                                echo '<span class="badge badge-success">Issued</span>';
                                            } elseif ($signA && $signB && $signC) {
                                                echo '<span class="badge badge-info">Ready</span>';
                                            } else {
                                                echo '<span class="badge badge-warning">Pending</span>';
                                            }
                                        ?>
                                    </small>
                                </div>
                                <small class="text-muted">
                                    <?= !empty($cert['created_at']) ? date('M d, Y', strtotime($cert['created_at'])) : 'Date N/A' ?>
                                </small>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="list-group-item text-center text-muted py-4">
                                No recent traditional certificates
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($recentTraditionalCertificates) && count($recentTraditionalCertificates) > 5): ?>
                    <div class="card-footer text-center">
                        <small class="text-danger">+<?= count($recentTraditionalCertificates) - 5 ?> more certificates</small>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-primary text-white">
                    <h6 class="m-0 font-weight-bold">Certificate Processing Summary</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Certificate Type</th>
                                    <th class="text-center">Total Logged</th>
                                    <th class="text-center">Pending Signatures</th>
                                    <th class="text-center">Ready for Issuance</th>
                                    <th class="text-center">Already Issued</th>
                                    <th class="text-center">Completion Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold text-info">Marriage</td>
                                    <td class="text-center"><?= $totalMarriageCertificateLogged ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-warning"><?= $totalMarriageCertificateUncompleted ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success"><?= $totalMarriageCertificateCompletedButNotIssued ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary"><?= $totalMarriageCertificateIssued ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $completed = $totalMarriageCertificateCompletedButNotIssued + $totalMarriageCertificateIssued;
                                            $rate = $totalMarriageCertificateLogged > 0 ? round(($completed / $totalMarriageCertificateLogged) * 100) : 0;
                                        ?>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-info" role="progressbar" 
                                                 style="width: <?= $rate ?>%;" 
                                                 aria-valuenow="<?= $rate ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <?= $rate ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-warning">Divorce</td>
                                    <td class="text-center"><?= $totalDivorceCertificateLogged ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-warning"><?= $totalDivorceCertificatePending ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success"><?= $totalDivorceCertificateCompletedButNotIssued ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary"><?= $totalDivorceCertificateIssued ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $completed = $totalDivorceCertificateCompletedButNotIssued + $totalDivorceCertificateIssued;
                                            $rate = $totalDivorceCertificateLogged > 0 ? round(($completed / $totalDivorceCertificateLogged) * 100) : 0;
                                        ?>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-warning" role="progressbar" 
                                                 style="width: <?= $rate ?>%;" 
                                                 aria-valuenow="<?= $rate ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <?= $rate ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold text-danger">Traditional</td>
                                    <td class="text-center"><?= $totalTraditionalCertificateLogged ?></td>
                                    <td class="text-center">
                                        <span class="badge badge-warning"><?= $totalTraditionalCertificatePending ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success"><?= $totalTraditionalCertificateCompletedButNotIssued ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary"><?= $totalTraditionalCertificateIssued ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $completed = $totalTraditionalCertificateCompletedButNotIssued + $totalTraditionalCertificateIssued;
                                            $rate = $totalTraditionalCertificateLogged > 0 ? round(($completed / $totalTraditionalCertificateLogged) * 100) : 0;
                                        ?>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-danger" role="progressbar" 
                                                 style="width: <?= $rate ?>%;" 
                                                 aria-valuenow="<?= $rate ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <?= $rate ?>%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Custom CSS for better responsiveness -->
<style>
    .card {
        border-radius: 0.5rem;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .badge {
        font-size: 0.75em;
        font-weight: 500;
    }
    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 0.75rem 1rem;
    }
    .list-group-item:first-child {
        border-top: none;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
    .progress {
        border-radius: 10px;
    }
    .chart-pie {
        height: 150px;
    }
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        .h5 {
            font-size: 1.1rem;
        }
        .table-responsive {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Chart.js for pie charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Marriage Certificate Chart
    var marriageCtx = document.getElementById('marriageChart').getContext('2d');
    var marriageChart = new Chart(marriageCtx, {
        type: 'doughnut',
        data: {
            labels: ['Issued', 'Pending', 'Ready'],
            datasets: [{
                data: [
                    <?= $totalMarriageCertificateIssued ?>,
                    <?= $totalMarriageCertificateUncompleted ?>,
                    <?= $totalMarriageCertificateCompletedButNotIssued ?>
                ],
                backgroundColor: ['#36b9cc', '#f6c23e', '#1cc88a'],
                hoverBackgroundColor: ['#2c9faf', '#dda20a', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 70,
        },
    });

    // Divorce Certificate Chart
    var divorceCtx = document.getElementById('divorceChart').getContext('2d');
    var divorceChart = new Chart(divorceCtx, {
        type: 'doughnut',
        data: {
            labels: ['Issued', 'Pending', 'Ready'],
            datasets: [{
                data: [
                    <?= $totalDivorceCertificateIssued ?>,
                    <?= $totalDivorceCertificatePending ?>,
                    <?= $totalDivorceCertificateCompletedButNotIssued ?>
                ],
                backgroundColor: ['#f6c23e', '#e74a3b', '#1cc88a'],
                hoverBackgroundColor: ['#dda20a', '#be2617', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 70,
        },
    });

    // Traditional Certificate Chart
    var traditionalCtx = document.getElementById('traditionalChart').getContext('2d');
    var traditionalChart = new Chart(traditionalCtx, {
        type: 'doughnut',
        data: {
            labels: ['Issued', 'Pending', 'Ready'],
            datasets: [{
                data: [
                    <?= $totalTraditionalCertificateIssued ?>,
                    <?= $totalTraditionalCertificatePending ?>,
                    <?= $totalTraditionalCertificateCompletedButNotIssued ?>
                ],
                backgroundColor: ['#e74a3b', '#f6c23e', '#1cc88a'],
                hoverBackgroundColor: ['#be2617', '#dda20a', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 70,
        },
    });
</script>

<?=$this->endSection() ?>
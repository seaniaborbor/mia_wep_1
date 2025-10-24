<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>


<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Republic of Liberia: National Branch Certification Statistics</h1>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <!-- Marriage Certificates Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Marriage Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalMarriages ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ring fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Uncompleted Marriages Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Marriages</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalUncompletedMarriages ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Certificates Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Divorce Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalDivorces ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-contract fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Uncompleted Divorces Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Divorces</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalUncompletedDivorces ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Certificate Status Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Certificate Status Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="certificatePieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Marriages (<?= $totalMarriages ?>)
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Divorces (<?= $totalDivorces ?>)
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branch Statistics -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Branch Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="branchBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="certificateTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="marriage-tab" data-toggle="tab" href="#marriage" role="tab" aria-controls="marriage" aria-selected="true">
                <i class="fas fa-ring mr-2"></i> Marriage Certificates
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="divorce-tab" data-toggle="tab" href="#divorce" role="tab" aria-controls="divorce" aria-selected="false">
                <i class="fas fa-file-contract mr-2"></i> Divorce Certificates
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="certificateTabsContent">
        <div class="tab-pane fade show active" id="marriage" role="tabpanel" aria-labelledby="marriage-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Marriage Certificates</h6>
                    <div>
                        <span class="badge badge-primary">Total: <?= $totalMarriages ?></span>
                        <span class="badge badge-warning ml-2">Pending: <?= $totalUncompletedMarriages ?></span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm datatable table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Groom</th>
                                    <th>Bride</th>
                                    <th>Reference No</th>
                                    <th>Branch</th>
                                    <th>Marriage Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allMarriages as $marriage): ?>
                                <tr>
                                    <td><?= $marriage['groom_name'] ?></td>
                                    <td><?= $marriage['bride_name'] ?></td>
                                    <td><?= $marriage['reference_no'] ?></td>
                                    <td><?= $marriage['branchName'] ?></td>
                                    <td><?= date('M d, Y', strtotime($marriage['date_of_marriage'])) ?></td>
                                    <td>
                                        <?php if(empty($marriage['SIGNA']) || empty($marriage['SIGNB']) || empty($marriage['SIGNC'])): ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/wedcert/view/<?= $marriage['marriage_cert_id'] ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="divorce" role="tabpanel" aria-labelledby="divorce-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Divorce Certificates</h6>
                    <div>
                        <span class="badge badge-danger">Total: <?= $totalDivorces ?></span>
                        <span class="badge badge-warning ml-2">Pending: <?= $totalUncompletedDivorces ?></span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm table-striped datatable2" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Plaintiff</th>
                                    <th>Defendant</th>
                                    <th>Divorce Date</th>
                                    <th>Reference No</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allDivorces as $divorce): ?>
                                <tr>
                                    <td><?= $divorce['divorceplaintiff'] ?></td>
                                    <td><?= $divorce['divorcedefendant'] ?></td>
                                    <td><?= date('M d, Y', strtotime($divorce['divorcedateOfDivorce'])) ?></td>
                                    <td><?= $divorce['divorceRefNo'] ?></td>
                                    <td><?= $divorce['branchName'] ?></td>
                                    <td>
                                        <?php if(empty($divorce['divorceSIGN_A']) || empty($divorce['divorceSIGN_B']) || empty($divorce['divorceSIGN_C'])): ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/divorce_cert/view/<?= $divorce['divorceCertId'] ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branch Summary Tables -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Marriage Certificates by Branch</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Certificates</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($marriagesPerBranch as $branch): ?>
                                <tr>
                                    <td><?= $branch['branchName'] ?></td>
                                    <td><?= $branch['count'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Divorce Certificates by Branch</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Certificates</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($divorcesPerBranch as $branch): ?>
                                <tr>
                                    <td><?= $branch['branchName'] ?></td>
                                    <td><?= $branch['count'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Pie Chart - Certificate Status Overview
        var pieCtx = document.getElementById('certificatePieChart');
        if (pieCtx) {
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Marriage Certificates', 'Divorce Certificates'],
                    datasets: [{
                        data: [<?= $totalMarriages ?>, <?= $totalDivorces ?>],
                        backgroundColor: ['#4e73df', '#e74a3b'],
                        hoverBackgroundColor: ['#2e59d9', '#be2617'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        }
                    },
                    cutout: '80%',
                },
            });
        }

        // Bar Chart - Branch Statistics
        var barCtx = document.getElementById('branchBarChart');
        if (barCtx) {
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($chartData['branchNames']) ?>,
                    datasets: [
                        {
                            label: "Marriage Certificates",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: <?= json_encode($chartData['marriageCounts']) ?>,
                        },
                        {
                            label: "Divorce Certificates",
                            backgroundColor: "#e74a3b",
                            hoverBackgroundColor: "#be2617",
                            borderColor: "#e74a3b",
                            data: <?= json_encode($chartData['divorceCounts']) ?>,
                        }
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: false,
                            grid: {
                                display: false
                            },
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        },
                        legend: {
                            position: 'top',
                        }
                    },
                    responsive: true
                }
            });
        }
    });
</script>

<?=$this->endSection()?>
<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="container-fluid">

    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-header bg-white border-bottom-primary py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="col-md-10">
                    <h1 class="h3 mb-0 text-primary font-weight-bold">
                        <i class="fas fa-tachometer-alt mr-2"></i><?= session()->get('userData')['branchName']?> Dashboard
                    </h1>
                </div>
                <div class="col-md-2">
                    <a href="/dashboard/general" class="btn btn-primary btn-icon-split w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-globe"></i>
                        </span>
                        <span class="text">Nation's Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Marriage Certificates Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary text-white">
                                <i class="fas fa-ring"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Marriage Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchMarriages ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Certificates Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-success text-white">
                                <i class="fas fa-file-contract"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Divorce Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchDivorces ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branch Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-info text-white">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Branch Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchUsers ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Certificate Status Summary -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning text-white">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Completion Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalBranchMarriages + $totalBranchDivorces > 0 ? 
                                    round((($marriageStatusData['completed'] + $divorceStatusData['completed']) / ($totalBranchMarriages + $totalBranchDivorces)) * 100) : 0 ?>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Cards Row -->
    <div class="row mb-4">
        <!-- Marriage Status Cards -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-ring mr-2"></i>Marriage Certificates Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-left-success shadow-none h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle-sm bg-success text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Completed
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $marriageStatusData['completed'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-left-warning shadow-none h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle-sm bg-warning text-white">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $marriageStatusData['pending'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $totalBranchMarriages > 0 ? ($marriageStatusData['completed'] / $totalBranchMarriages) * 100 : 0 ?>%" 
                             aria-valuenow="<?= $marriageStatusData['completed'] ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="<?= $totalBranchMarriages ?>">
                        </div>
                    </div>
                    <div class="small text-muted text-center">
                        Completion Progress: <?= $totalBranchMarriages > 0 ? round(($marriageStatusData['completed'] / $totalBranchMarriages) * 100) : 0 ?>%
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Status Cards -->
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-file-contract mr-2"></i>Divorce Certificates Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-left-success shadow-none h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle-sm bg-success text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Completed
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $divorceStatusData['completed'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-left-warning shadow-none h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle-sm bg-warning text-white">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $divorceStatusData['pending'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $totalBranchDivorces > 0 ? ($divorceStatusData['completed'] / $totalBranchDivorces) * 100 : 0 ?>%" 
                             aria-valuenow="<?= $divorceStatusData['completed'] ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="<?= $totalBranchDivorces ?>">
                        </div>
                    </div>
                    <div class="small text-muted text-center">
                        Completion Progress: <?= $totalBranchDivorces > 0 ? round(($divorceStatusData['completed'] / $totalBranchDivorces) * 100) : 0 ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Trend Line Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-line mr-2"></i>Monthly Certificates Trend (<?= date('Y') ?>)
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="monthlyTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate Logs Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom-primary py-3">
            <!-- Tabs Navigation -->
            <ul class="nav nav-pills" id="certificateTabs" role="tablist">
                <li class="nav-item mr-2">
                    <a class="nav-link active py-2 px-3" id="marriage-tab" data-toggle="tab" href="#marriage" role="tab" aria-controls="marriage" aria-selected="true">
                        <i class="fas fa-ring mr-2"></i> Marriage Certificates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 px-3" id="divorce-tab" data-toggle="tab" href="#divorce" role="tab" aria-controls="divorce" aria-selected="false">
                        <i class="fas fa-file-contract mr-2"></i> Divorce Certificates
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Tab Content -->
            <div class="tab-content" id="certificateTabsContent">
                <!-- Marriage Certificates Tab -->
                <div class="tab-pane fade show active" id="marriage" role="tabpanel" aria-labelledby="marriage-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm datatable" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Groom</th>
                                    <th>Bride</th>
                                    <th>Reference No</th>
                                    <th>Status</th>
                                    <th>Marriage Date</th>
                                    <th>Date Logged</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($branchMarriages as $marriage): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-item-center">
                                            <div style="width:40px; height:40px; border-radius:50%;
                                                background-image: url(/uploads/marriage/<?=$marriage['groom_passport_photo']?>); background-position:top;
                                                background-size:cover" class="bg-dark"></div>
                                            <p class="px-3"><?= $marriage['groom_name'] ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-item-center">
                                            <div style="width:40px; height:40px; border-radius:50%;
                                                background-image: url(/uploads/marriage/<?=$marriage['bride_passport_photo']?>); background-position:top;
                                                background-size:cover" class="bg-dark"></div>
                                            <p class="px-3"><?= $marriage['bride_name'] ?></p>
                                        </div>
                                    </td>
                                    <td><?= $marriage['reference_no'] ?></td>
                                    <td>
                                        <?php if(empty($marriage['SIGNA']) || empty($marriage['SIGNB']) || empty($marriage['SIGNC'])) : ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($marriage['date_of_marriage'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($marriage['created_at'])) ?></td>
                                    <td>
                                        <a href="/dashboard/wedcert/view/<?= $marriage['marriage_cert_id'] ?>" class="btn btn-info btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            <span class="text">Detail</span>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Divorce Certificates Tab -->
                <div class="tab-pane fade" id="divorce" role="tabpanel" aria-labelledby="divorce-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm table-light datatable2" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Plaintiff</th>
                                    <th>Defendant</th>
                                    <th>Reference No</th>
                                    <th>Status</th>
                                    <th>Divorce Date</th>
                                    <th>Created At</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($branchDivorces as $divorce): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-item-center">
                                            <div style="width:40px; height:40px; border-radius:50%;
                                                background-image: url(/uploads/divorce/<?=$divorce['divorceplaintiffPic']?>); background-position:top;
                                                background-size:cover" class="bg-dark"></div>
                                            <p class="px-3"><?= $divorce['divorceplaintiff'] ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-item-center">
                                            <div style="width:40px; height:40px; border-radius:50%;
                                                background-image: url(/uploads/divorce/<?=$divorce['divorcedefendantPic']?>); background-position:top;
                                                background-size:cover" class="bg-dark"></div>
                                            <p class="px-3"><?= $divorce['divorcedefendant'] ?></p>
                                        </div>
                                    </td>
                                    <td><?= $divorce['divorceRefNo'] ?></td>
                                    <td>
                                        <?php if(empty($divorce['divorceSIGN_A']) || empty($divorce['divorceSIGN_B']) || empty($divorce['divorceSIGN_C'])) : ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($divorce['divorcedateOfDivorce'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($divorce['divorcecreated_at'])) ?></td>
                                    <td>
                                        <a href="/dashboard/divorce_cert/view/<?= $divorce['divorceCertId'] ?>" class="btn btn-info btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                            <span class="text">Detail</span>
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

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Monthly Trend Line Chart
var monthlyCtx = document.getElementById('monthlyTrendChart');
var monthlyChart = new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: <?= json_encode($monthlyData['labels']) ?>,
        datasets: [
            {
                label: "Marriages",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: <?= json_encode($monthlyData['marriages']) ?>,
            },
            {
                label: "Divorces",
                lineTension: 0.3,
                backgroundColor: "rgba(220, 53, 69, 0.05)",
                borderColor: "rgba(220, 53, 69, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(220, 53, 69, 1)",
                pointBorderColor: "rgba(220, 53, 69, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(220, 53, 69, 1)",
                pointHoverBorderColor: "rgba(220, 53, 69, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: <?= json_encode($monthlyData['divorces']) ?>,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 12
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 10,
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: true,
            position: 'top'
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
        }
    }
});
</script>

<style>
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.icon-circle-sm {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    font-size: 0.9rem;
}

.btn-icon-split .icon {
    padding: 0.375rem 0.75rem;
    display: inline-block;
}

.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}

.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}

.nav-pills .nav-link.active {
    background-color: #4e73df;
    color: white;
}

.nav-pills .nav-link {
    color: #4e73df;
    border: 1px solid #4e73df;
}

.chart-area {
    position: relative;
    height: 300px;
    width: 100%;
}
</style>

<?=$this->endSection()?>
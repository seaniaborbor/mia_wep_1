<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="container-fluid">


    <!-- Summary Cards -->
   <div class="card mb-4">
    <div class="card-header">
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="col-md-10">
                <h1 class="h3 mb-0 text-gray-800"><?= session()->get('userData')['branchName']?> Dashboard</h1>
            </div>
            <div class="col-md-2">
                <a href="/dashboard/general" class="btn  rounded-pill w-100 btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="text">Nation's Dashboard</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
         <div class="row">
        <!-- Marriage Certificates Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Marriage Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchMarriages ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ring fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Certificates Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Divorce Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchDivorces ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-contract fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branch Users Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Branch Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalBranchUsers ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Charts Section -->
<div class="row mb-4">
    <!-- Marriage Status Pie Chart -->
    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Marriage Certificates Status</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="marriageStatusChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Completed
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Pending
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Divorce Status Pie Chart -->
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Divorce Certificates Status</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="divorceStatusChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Completed
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-warning"></i> Pending
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Trend Line Chart -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Monthly Certificates Trend (<?= date('Y') ?>)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
    </div>
    <div class="card-footer">
        <!-- Tabs Navigation -->
    <ul class="nav nav-pills" id="certificateTabs" role="tablist">
        <li class="nav-item mr-2">
            <a class="nav-link active py-2 px-3" id="uncompleted-tab" data-toggle="tab" href="#uncompleted" role="tab" aria-controls="uncompleted" aria-selected="true">
            <i class="fas fa-ring mr-2"></i> Marriage Certificates
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-2 px-3" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">
            <i class="fas fa-file-contract mr-2"></i> Divorce Certificates
            </a>
        </li>
    </ul>
    </div>
   </div>

   

  

    <!-- Tab Content -->
    <div class="tab-content" id="certificateTabsContent">
        <div class="tab-pane fade show active" id="uncompleted" role="tabpanel" aria-labelledby="uncompleted-tab">
   <!-- Recent Marriage Certificates -->
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Marriage Certificate Log</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm datatable" width="100%" cellspacing="0">
                    <thead>
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
                            <td >
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
                                    <i class="fas fa-times text-danger mr-1"></i>
                                    <?php else: ?>
                                    <i class="fas fa-check text-success mr-1"></i>
                                <?php endif; ?>
                            </td>
                            <td><?= date('M d, Y', strtotime($marriage['date_of_marriage'])) ?></td>
                            <td><?= date('M d, Y', strtotime($marriage['created_at'])) ?></td>
                            <td>
                                 <a href="/dashboard/wedcert/view/<?= $marriage['marriage_cert_id'] ?>" class="btn btn-sm btn-info btn-icon-split">
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
        
        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">

    <!-- Recent Divorce Certificates -->
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Divorce Certificate Log</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm table-light datatable2" width="100%" cellspacing="0">
                    <thead>
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
                                    <i class="fas fa-times text-danger mr-1"></i>
                                    <?php else: ?>
                                    <i class="fas fa-check text-success mr-1"></i>
                                <?php endif; ?>

                            </td>
                            <td><?= date('M d, Y', strtotime($divorce['divorcedateOfDivorce'])) ?></td>
                            <td><?= date('M d, Y', strtotime($divorce['divorcecreated_at'])) ?></td>
                            <td>
                                <a href="/dashboard/divorce_cert/view/<?= $divorce['divorceCertId'] ?>" class="btn btn-sm btn-info btn-icon-split">
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
// Marriage Status Pie Chart
var marriageCtx = document.getElementById('marriageStatusChart');
var marriageChart = new Chart(marriageCtx, {
    type: 'doughnut',
    data: {
        labels: ['Completed', 'Pending'],
        datasets: [{
            data: [<?= $marriageStatusData['completed'] ?>, <?= $marriageStatusData['pending'] ?>],
            backgroundColor: ['#1cc88a', '#f6c23e'],
            hoverBackgroundColor: ['#17a673', '#dda20a'],
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
        cutoutPercentage: 80,
    },
});

// Divorce Status Pie Chart
var divorceCtx = document.getElementById('divorceStatusChart');
var divorceChart = new Chart(divorceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Completed', 'Pending'],
        datasets: [{
            data: [<?= $divorceStatusData['completed'] ?>, <?= $divorceStatusData['pending'] ?>],
            backgroundColor: ['#1cc88a', '#f6c23e'],
            hoverBackgroundColor: ['#17a673', '#dda20a'],
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
        cutoutPercentage: 80,
    },
});

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
<?=$this->endSection()?>
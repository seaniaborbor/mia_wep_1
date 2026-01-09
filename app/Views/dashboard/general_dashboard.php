<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="container-fluid">

    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-header bg-white border-bottom-primary py-3">
            <h1 class="h3 mb-0 text-primary fw-bold">
                <i class="fas fa-globe-americas me-2"></i>Republic of Liberia: National Branch Certification Statistics
            </h1>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Total Marriage Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-primary shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-primary rounded-circle p-3 text-white">
                                <i class="fas fa-ring"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Marriage Certificates
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800"><?= $totalMarriages ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Marriages -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-warning shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-warning rounded-circle p-3 text-white">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Pending Marriages
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800"><?= $totalUncompletedMarriages ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Divorce Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-danger shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-danger rounded-circle p-3 text-white">
                                <i class="fas fa-file-contract"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                                Total Divorce Certificates
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800"><?= $totalDivorces ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Divorces -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-warning shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-warning rounded-circle p-3 text-white">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Pending Divorces
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800"><?= $totalUncompletedDivorces ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Traditional Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-info shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-info rounded-circle p-3 text-white">
                                <i class="fas fa-feather"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Total Traditional Certificates
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800"><?= $totalTraditionalCerts ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Traditional Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-warning shadow-sm h-100">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-warning rounded-circle p-3 text-white">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                        <div>
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Pending Traditional
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800"><?= $totalUncompletedTraditionalCerts ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview Cards -->
    <div class="row mb-4">
        <!-- Marriage Status Overview -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-ring me-2"></i>Marriage Certificates Overview
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-start-success h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success rounded-circle p-2 text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                                Completed
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">
                                                <?= $totalMarriages - $totalUncompletedMarriages ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-start-warning h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-warning rounded-circle p-2 text-white">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                                Pending
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">
                                                <?= $totalUncompletedMarriages ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $totalMarriages > 0 ? (($totalMarriages - $totalUncompletedMarriages) / $totalMarriages) * 100 : 0 ?>%" 
                             aria-valuenow="<?= $totalMarriages - $totalUncompletedMarriages ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="<?= $totalMarriages ?>">
                        </div>
                    </div>
                    <div class="small text-muted text-center">
                        Completion Rate: <?= $totalMarriages > 0 ? round((($totalMarriages - $totalUncompletedMarriages) / $totalMarriages) * 100) : 0 ?>%
                    </div>
                </div>
            </div>
        </div>

        <!-- Divorce Status Overview -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-file-contract me-2"></i>Divorce Certificates Overview
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-start-success h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success rounded-circle p-2 text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                                Completed
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">
                                                <?= $totalDivorces - $totalUncompletedDivorces ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-start-warning h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-warning rounded-circle p-2 text-white">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                                Pending
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">
                                                <?= $totalUncompletedDivorces ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $totalDivorces > 0 ? (($totalDivorces - $totalUncompletedDivorces) / $totalDivorces) * 100 : 0 ?>%" 
                             aria-valuenow="<?= $totalDivorces - $totalUncompletedDivorces ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="<?= $totalDivorces ?>">
                        </div>
                    </div>
                    <div class="small text-muted text-center">
                        Completion Rate: <?= $totalDivorces > 0 ? round((($totalDivorces - $totalUncompletedDivorces) / $totalDivorces) * 100) : 0 ?>%
                    </div>
                </div>
            </div>
        </div>

        <!-- Traditional Certificate Status Overview -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-feather me-2"></i>Traditional Certificates Overview
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-start-success h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-success rounded-circle p-2 text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                                Completed
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">
                                                <?= $totalTraditionalCerts - $totalUncompletedTraditionalCerts ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-start-warning h-100">
                                <div class="card-body py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="bg-warning rounded-circle p-2 text-white">
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                                Pending
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">
                                                <?= $totalUncompletedTraditionalCerts ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $totalTraditionalCerts > 0 ? (($totalTraditionalCerts - $totalUncompletedTraditionalCerts) / $totalTraditionalCerts) * 100 : 0 ?>%" 
                             aria-valuenow="<?= $totalTraditionalCerts - $totalUncompletedTraditionalCerts ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="<?= $totalTraditionalCerts ?>">
                        </div>
                    </div>
                    <div class="small text-muted text-center">
                        Completion Rate: <?= $totalTraditionalCerts > 0 ? round((($totalTraditionalCerts - $totalUncompletedTraditionalCerts) / $totalTraditionalCerts) * 100) : 0 ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branch Statistics Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i>Branch Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="branchBarChart"></canvas>
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
                <li class="nav-item me-2">
                    <a class="nav-link active py-2 px-3" id="marriage-tab" data-bs-toggle="tab" href="#marriage" role="tab">
                        <i class="fas fa-ring me-2"></i> Marriage Certificates
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link py-2 px-3" id="divorce-tab" data-bs-toggle="tab" href="#divorce" role="tab">
                        <i class="fas fa-file-contract me-2"></i> Divorce Certificates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 px-3" id="traditional-tab" data-bs-toggle="tab" href="#traditional" role="tab">
                        <i class="fas fa-feather me-2"></i> Traditional Certificates
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Tab Content -->
            <div class="tab-content" id="certificateTabsContent">
                <!-- Marriage Certificates Tab -->
                <div class="tab-pane fade show active" id="marriage" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-primary mb-0">Recent Marriage Certificates</h6>
                        <div>
                            <span class="badge bg-primary">Total: <?= $totalMarriages ?></span>
                            <span class="badge bg-warning ms-2">Pending: <?= $totalUncompletedMarriages ?></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped table-hover" width="100%">
                            <thead class="table-light">
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
                                            <span class="badge bg-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/wedcert/view/<?= $marriage['marriage_cert_id'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Divorce Certificates Tab -->
                <div class="tab-pane fade" id="divorce" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-primary mb-0">Recent Divorce Certificates</h6>
                        <div>
                            <span class="badge bg-danger">Total: <?= $totalDivorces ?></span>
                            <span class="badge bg-warning ms-2">Pending: <?= $totalUncompletedDivorces ?></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm table-striped" width="100%">
                            <thead class="table-light">
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
                                            <span class="badge bg-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/divorce_cert/view/<?= $divorce['divorceCertId'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Traditional Certificates Tab -->
                <div class="tab-pane fade" id="traditional" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-primary mb-0">Recent Traditional Certificates</h6>
                        <div>
                            <span class="badge bg-info">Total: <?= $totalTraditionalCerts ?></span>
                            <span class="badge bg-warning ms-2">Pending: <?= $totalUncompletedTraditionalCerts ?></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm table-striped" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Holder Name</th>
                                    <th>Operation Type</th>
                                    <th>Serial No</th>
                                    <th>CEV No</th>
                                    <th>Branch</th>
                                    <th>Date Issued</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allTraditionalCerts as $traditional): ?>
                                <tr>
                                    <td><?= $traditional['tradCertHolderName'] ?></td>
                                    <td><?= $traditional['tradCertHolderOperationType'] ?></td>
                                    <td><?= $traditional['tradCertSn'] ?></td>
                                    <td><?= $traditional['tradCertCevNo'] ?></td>
                                    <td><?= $traditional['branchName'] ?></td>
                                    <td><?= date('M d, Y', strtotime($traditional['tradCertDateIssued'])) ?></td>
                                    <td>
                                        <?php if(empty($traditional['tradCertSignatoryA']) || empty($traditional['tradCertSignatoryB']) || empty($traditional['tradCertSignatoryC'])): ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/traditional_cert/view/<?= $traditional['tradCertId'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye me-1"></i>View
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
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-ring me-2"></i>Marriage Certificates by Branch
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Certificates</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($marriagesPerBranch as $branch): ?>
                                <tr>
                                    <td><?= $branch['branchName'] ?></td>
                                    <td><span class="badge bg-primary"><?= $branch['count'] ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-file-contract me-2"></i>Divorce Certificates by Branch
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Certificates</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($divorcesPerBranch as $branch): ?>
                                <tr>
                                    <td><?= $branch['branchName'] ?></td>
                                    <td><span class="badge bg-danger"><?= $branch['count'] ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traditional Certificates by Branch -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-feather me-2"></i>Traditional Certificates by Branch
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Certificates</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($traditionalCertsPerBranch as $branch): ?>
                                <tr>
                                    <td><?= $branch['branchName'] ?></td>
                                    <td><span class="badge bg-info"><?= $branch['count'] ?></span></td>
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
    document.addEventListener('DOMContentLoaded', function() {
        var barCtx = document.getElementById('branchBarChart');
        if (barCtx) {
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($chartData['branchCode']) ?>,
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
                        },
                        {
                            label: "Traditional Certificates",
                            backgroundColor: "#36b9cc",
                            hoverBackgroundColor: "#2c9faf",
                            borderColor: "#36b9cc",
                            data: <?= json_encode($chartData['traditionalCounts']) ?>,
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
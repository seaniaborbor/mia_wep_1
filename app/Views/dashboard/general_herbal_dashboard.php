<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom-primary py-3">
                    <h4 class="text-primary mb-0 fw-bold">
                        <i class="fas fa-chart-bar text-primary me-2"></i>General Herbal Certificate Dashboard - All Branches
                    </h4>
                    <p class="mb-0 text-muted">Overview of all traditional certificates across all branches</p>
                </div>

                <div class="card-body">
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Certificates</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $dashboardStats['total'] ?? 0 ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-certificate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Completed</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $dashboardStats['completed'] ?? 0 ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Signatures</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $dashboardStats['pending'] ?? 0 ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Branches</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $dashboardStats['totalBranches'] ?? 0 ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-code-branch fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Branch Performance -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-building me-2"></i>Branch Performance
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="branchTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Branch Name</th>
                                                    <th>Total Certificates</th>
                                                    <th>Completed</th>
                                                    <th>Pending</th>
                                                    <th>Completion Rate</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($branchStats)): ?>
                                                    <?php foreach($branchStats as $branchName => $stats): ?>
                                                    <tr>
                                                        <td class="font-weight-bold"><?= $branchName ?></td>
                                                        <td><?= $stats['total'] ?></td>
                                                        <td>
                                                            <span class="badge badge-success"><?= $stats['completed'] ?></span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-warning"><?= $stats['pending'] ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar <?= $stats['completionRate'] >= 80 ? 'bg-success' : ($stats['completionRate'] >= 50 ? 'bg-warning' : 'bg-danger') ?>" 
                                                                     role="progressbar" 
                                                                     style="width: <?= $stats['completionRate'] ?>%;"
                                                                     aria-valuenow="<?= $stats['completionRate'] ?>" 
                                                                     aria-valuemin="0" 
                                                                     aria-valuemax="100">
                                                                    <?= $stats['completionRate'] ?>%
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="/cultural_dashboard/nativecert?branch=<?= $stats['branch_id'] ?>" 
                                                               class="btn btn-sm btn-outline-primary btn-circle">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center py-4 text-muted">
                                                            <i class="fas fa-info-circle fa-2x mb-2"></i>
                                                            <p>No branch data available</p>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Navigation -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab">
                                                <i class="fas fa-hourglass-half me-2"></i> Pending Certificates
                                                <span class="badge badge-warning ml-2"><?= count($incompleteCertificates ?? []) ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab">
                                                <i class="fas fa-check me-2"></i> Completed
                                                <span class="badge badge-success ml-2"><?= $dashboardStats['completed'] ?? 0 ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="county-tab" data-toggle="tab" href="#county" role="tab">
                                                <i class="fas fa-map-marker-alt me-2"></i> County Distribution
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <!-- Pending Certificates -->
                                        <div class="tab-pane fade show active" id="pending" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Holder Name</th>
                                                            <th>Branch</th>
                                                            <th>Operation Type</th>
                                                            <th>Date Logged</th>
                                                            <th>Missing Signatures</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(!empty($incompleteCertificates)): ?>
                                                            <?php foreach($incompleteCertificates as $cert): ?>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold text-primary"><?= $cert['tradCertSn'] ?? 'N/A' ?></span>
                                                                </td>
                                                                <td><?= $cert['tradCertHolderName'] ?? 'N/A' ?></td>
                                                                <td>
                                                                    <span class="badge badge-secondary"><?= $cert['branchName'] ?? 'Unknown' ?></span>
                                                                </td>
                                                                <td><?= $cert['tradCertHolderOperationType'] ?? 'N/A' ?></td>
                                                                <td><?= !empty($cert['tradCertLastUpdatedAt']) ? date('M d, Y', strtotime($cert['tradCertLastUpdatedAt'])) : 'N/A' ?></td>
                                                                <td>
                                                                    <?php
                                                                    $missing = [];
                                                                    if(empty($cert['tradCertSignatoryA'])) $missing[] = 'A';
                                                                    if(empty($cert['tradCertSignatoryB'])) $missing[] = 'B';
                                                                    if(empty($cert['tradCertSignatoryC'])) $missing[] = 'C';
                                                                    ?>
                                                                    <span class="badge badge-danger"><?= implode(', ', $missing) ?></span>
                                                                </td>                        
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="6" class="text-center py-4">
                                                                    <div class="text-muted">
                                                                        <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                                                                        <p class="mb-0">No pending certificates!</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <!-- Completed Certificates -->
                                        <div class="tab-pane fade" id="completed" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Holder Name</th>
                                                            <th>Branch</th>
                                                            <th>County</th>
                                                            <th>Operation Type</th>
                                                            <th>Date Issued</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(!empty($certificates)): ?>
                                                            <?php $completedCount = 0; ?>
                                                            <?php foreach($certificates as $cert): ?>
                                                                <?php if(!empty($cert['tradCertSignatoryA']) && !empty($cert['tradCertSignatoryB']) && !empty($cert['tradCertSignatoryC'])): ?>
                                                                <?php $completedCount++; ?>
                                                                <tr>
                                                                    <td>
                                                                        <span class="font-weight-bold text-success"><?= $cert['tradCertSn'] ?? 'N/A' ?></span>
                                                                    </td>
                                                                    <td><?= $cert['tradCertHolderName'] ?? 'N/A' ?></td>
                                                                    <td>
                                                                        <span class="badge badge-light text-dark"><?= $cert['branchName'] ?? 'Unknown' ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-info"><?= $cert['tradCertHoldercounty'] ?? 'N/A' ?></span>
                                                                    </td>
                                                                    <td><?= $cert['tradCertHolderOperationType'] ?? 'N/A' ?></td>
                                                                    <td><?= !empty($cert['tradCertDateIssued']) ? date('M d, Y', strtotime($cert['tradCertDateIssued'])) : 'Not Issued' ?></td>
                                                                    <td>
                                                                        <a href="/cultural_dashboard/nativecert/view/<?= $cert['tradCertId'] ?>" class="btn btn-info btn-circle btn-sm">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            <?php if($completedCount == 0): ?>
                                                                <tr>
                                                                    <td colspan="7" class="text-center py-4">
                                                                        <div class="text-muted">
                                                                            <i class="fas fa-certificate fa-2x mb-2 text-warning"></i>
                                                                            <p class="mb-0">No completed certificates found.</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="7" class="text-center py-4">
                                                                    <div class="text-muted">
                                                                        <i class="fas fa-certificate fa-2x mb-2 text-warning"></i>
                                                                        <p class="mb-0">No certificates found.</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- County Distribution -->
                                        <div class="tab-pane fade" id="county" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card shadow-sm mb-4">
                                                        <div class="card-header py-3">
                                                            <h6 class="m-0 font-weight-bold text-primary">Certificates by County</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>County</th>
                                                                            <th>Number</th>
                                                                            <th>Percentage</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if(!empty($countyStats)): ?>
                                                                            <?php $total = $dashboardStats['total']; ?>
                                                                            <?php foreach($countyStats as $county => $count): ?>
                                                                            <tr>
                                                                                <td class="font-weight-bold"><?= $county ?></td>
                                                                                <td><?= $count ?></td>
                                                                                <td>
                                                                                    <?= $total > 0 ? round(($count / $total) * 100, 2) : 0 ?>%
                                                                                </td>
                                                                            </tr>
                                                                            <?php endforeach; ?>
                                                                        <?php else: ?>
                                                                            <tr>
                                                                                <td colspan="3" class="text-center py-4 text-muted">
                                                                                    No county data available
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card shadow-sm mb-4">
                                                        <div class="card-header py-3">
                                                            <h6 class="m-0 font-weight-bold text-primary">Certificates by Branch</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Branch</th>
                                                                            <th>Number</th>
                                                                            <th>Percentage</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php if(!empty($branchWiseStats)): ?>
                                                                            <?php $total = $dashboardStats['total']; ?>
                                                                            <?php foreach($branchWiseStats as $branch => $count): ?>
                                                                            <tr>
                                                                                <td class="font-weight-bold"><?= $branch ?></td>
                                                                                <td><?= $count ?></td>
                                                                                <td>
                                                                                    <?= $total > 0 ? round(($count / $total) * 100, 2) : 0 ?>%
                                                                                </td>
                                                                            </tr>
                                                                            <?php endforeach; ?>
                                                                        <?php else: ?>
                                                                            <tr>
                                                                                <td colspan="3" class="text-center py-4 text-muted">
                                                                                    No branch data available
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>
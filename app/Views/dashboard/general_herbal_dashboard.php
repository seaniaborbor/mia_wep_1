<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-primary py-3">
                <h4 class="text-primary mb-0 font-weight-bold">
                    <i class="fas fa-chart-bar text-primary mr-2"></i>General Herbal Certificate Dashboard - All Branches
                </h4>
                <p class="mb-0 text-muted">Overview of all traditional certificates across all branches</p>
            </div>

            <div class="card-body p-4">
                <!-- Overall Stats Summary -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="card border-left-primary shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary text-white">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Certificates
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                           <?= $dashboardStats['total'] ?? 0 ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success text-white">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Completed Certificates
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $dashboardStats['completed'] ?? 0 ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="card border-left-warning shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning text-white">
                                            <i class="fas fa-hourglass-half"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Signatures
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $dashboardStats['pending'] ?? 0 ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-left-info shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-info text-white">
                                            <i class="fas fa-code-branch"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Branches
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $dashboardStats['totalBranches'] ?? 0 ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branch Performance -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 font-weight-bold">
                                    <i class="fas fa-building mr-2"></i>Branch Performance
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
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
                                                        <div class="progress" style="height: 20px;">
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
                                                        <a href="/dashboard/nativecert?branch=<?= $stats['branch_id'] ?>" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye mr-1"></i> View Branch
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center py-4 text-muted">
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

                <!-- Tabs Navigation -->
                <ul class="nav nav-pills mb-4" id="certificateTabs" role="tablist">
                    <li class="nav-item mr-2">
                        <a class="nav-link active py-2 px-3" id="uncompleted-tab" data-toggle="tab" href="#uncompleted" role="tab" aria-controls="uncompleted" aria-selected="true">
                            <i class="fas fa-hourglass-half mr-2"></i> Pending Certificates (All Branches)
                            <span class="badge badge-warning ml-2"><?= count($incompleteCertificates ?? []) ?></span>
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link py-2 px-3" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">
                            <i class="fas fa-check mr-2"></i> Completed Certificates
                            <span class="badge badge-success ml-2"><?= $dashboardStats['completed'] ?? 0 ?></span>
                        </a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link py-2 px-3" id="county-tab" data-toggle="tab" href="#county" role="tab" aria-controls="county" aria-selected="false">
                            <i class="fas fa-map-marker-alt mr-2"></i> County Distribution
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="certificateTabsContent">
                    <!-- Pending Certificates Tab -->
                    <div class="tab-pane fade show active" id="uncompleted" role="tabpanel" aria-labelledby="uncompleted-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable2 table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Holder Name</th>
                                        <th>Branch</th>
                                        <th>Operation Type</th>
                                        <th>Date Logged</th>
                                        <th>Missing Signatures</th>
                                        <th>Actions</th>
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
                                            <td>
                                                <a href="/dashboard/nativecert/view/<?= $cert['tradCertId'] ?>" class="btn btn-info btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                    <span class="text">View</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                                                    <p class="mb-0">No pending certificates across all branches!</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Completed Certificates Tab -->
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="table-responsive">
                            <table class="table datatable table-bordered table-hover">
                                <thead class="bg-light">
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
                                        <?php foreach($certificates as $cert): ?>
                                            <?php if(!empty($cert['tradCertSignatoryA']) && !empty($cert['tradCertSignatoryB']) && !empty($cert['tradCertSignatoryC'])): ?>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold text-success"><?= $cert['tradCertSn'] ?? 'N/A' ?></span>
                                                </td>
                                                <td><?= $cert['tradCertHolderName'] ?? 'N/A' ?></td>
                                                <td>
                                                    <span class="badge badge-light"><?= $cert['branchName'] ?? 'Unknown' ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info"><?= $cert['tradCertHoldercounty'] ?? 'N/A' ?></span>
                                                </td>
                                                <td><?= $cert['tradCertHolderOperationType'] ?? 'N/A' ?></td>
                                                <td><?= !empty($cert['tradCertDateIssued']) ? date('M d, Y', strtotime($cert['tradCertDateIssued'])) : 'Not Issued' ?></td>
                                                <td>
                                                    <a href="/dashboard/nativecert/view/<?= $cert['tradCertId'] ?>" class="btn btn-info btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                        <span class="text">View</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-certificate fa-2x mb-2 text-warning"></i>
                                                    <p class="mb-0">No certificates found across all branches.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- County Distribution Tab -->
                    <div class="tab-pane fade" id="county" role="tabpanel" aria-labelledby="county-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 font-weight-bold">Certificates by County</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>County</th>
                                                        <th>Number of Certificates</th>
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
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0 font-weight-bold">Certificates by Branch</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Branch</th>
                                                        <th>Number of Certificates</th>
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
                                                                No branch distribution data available
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


<style>
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.btn-icon-split .icon {
    padding: 0.375rem 0.75rem;
    display: inline-block;
}

.badge-pill {
    padding-right: 0.6em;
    padding-left: 0.6em;
    border-radius: 10rem;
}

.progress {
    border-radius: 10px;
}
</style>

<?=$this->endSection()?>

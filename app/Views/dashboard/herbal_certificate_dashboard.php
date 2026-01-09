<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading + Actions -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Culture Certificates Log</h1>
            <p class="mb-0 mt-2 text-gray-600">
                <?php if(isset($breanchDetail) && !empty($breanchDetail)): ?>
                    <?= esc($breanchDetail['branchName']) ?>
                <?php else: ?>
                    <?= esc(session()->get('userData')['branchName']) ?>
                <?php endif; ?>
            </p>
        </div>

        <div class="d-flex gap-2">
            <!-- Create New Button -->
            <a href="/dashboard/nativecert/create" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Create New</span>
            </a>

            <!-- Branch Switcher Dropdown -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="branchDropdown" data-toggle="dropdown">
                    <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?php
                        $currentBranch = 'Select Branch';
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
                           href="/dashboard/nativecert?branch=<?= esc($branch['branchId']) ?>">
                            <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?= esc($branch['branchName']) ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/dashboard/general">
                        <i class="fas fa-flag fa-sm fa-fw mr-2 text-gray-400"></i>
                        Nation's Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Certificates</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dashboardStats['total'] ?? 0 ?></div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dashboardStats['completed'] ?? 0 ?></div>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Signatures</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dashboardStats['pending'] ?? 0 ?></div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Completion Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dashboardStats['completionRate'] ?? 0 ?>%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate Records Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-shield-alt mr-2"></i>Culture Certificate Records
            </h6>
        </div>
        <div class="card-body">

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="cultureTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab">
                        <i class="fas fa-hourglass-half mr-2"></i>Pending Certificates
                        <span class="badge badge-warning badge-counter ml-2"><?= count($incompleteCertificates ?? []) ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab">
                        <i class="fas fa-check-circle mr-2"></i>Completed
                        <span class="badge badge-success badge-counter ml-2"><?= $dashboardStats['completed'] ?? 0 ?></span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <!-- Pending Certificates -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                    <?php if (!empty($incompleteCertificates)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Holder Name</th>
                                        <th>Application Type</th>
                                        <th>Operation Type</th>
                                        <th>Date Logged</th>
                                        <th>Missing Signatures</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($incompleteCertificates as $cert): ?>
                                        <?php
                                            $missing = [];
                                            if (empty($cert['tradCertSignatoryA'])) $missing[] = 'A';
                                            if (empty($cert['tradCertSignatoryB'])) $missing[] = 'B';
                                            if (empty($cert['tradCertSignatoryC'])) $missing[] = 'C';
                                        ?>
                                        <tr>
                                            <td><strong class="text-primary">#<?= esc($cert['tradCertSn'] ?? 'N/A') ?></strong></td>
                                            <td><?= esc($cert['tradCertHolderName'] ?? 'N/A') ?></td>
                                            <td>
                                                <span class="badge badge-<?= ($cert['tradCertAppliedType'] ?? '') === 'online' ? 'success' : 'info' ?>">
                                                    <?= ucfirst($cert['tradCertAppliedType'] ?? 'N/A') ?>
                                                </span>
                                            </td>
                                            <td><?= esc($cert['tradCertHolderOperationType'] ?? 'N/A') ?></td>
                                            <td>
                                                <i class="fas fa-calendar-alt fa-fw text-gray-400 mr-1"></i>
                                                <?= !empty($cert['tradCertLastUpdatedAt']) ? date('M d, Y', strtotime($cert['tradCertLastUpdatedAt'])) : 'N/A' ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger font-weight-bold">
                                                    <?= !empty($missing) ? implode(', ', $missing) : 'None' ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="/dashboard/nativecert/view/<?= esc($cert['tradCertId']) ?>"
                                                   class="btn btn-warning btn-sm btn-icon-split">
                                                    <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                                    <span class="text">View</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5 text-success">
                            <i class="fas fa-check-circle fa-3x mb-3 text-gray-300"></i>
                            <p class="h5 mb-0">All certificates are fully signed and completed!</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Completed Certificates -->
                <div class="tab-pane fade" id="completed" role="tabpanel">
                    <?php if (!empty($certificates)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Holder Name</th>
                                        <th>County</th>
                                        <th>Operation Type</th>
                                        <th>Date Issued</th>
                                        <th>Application Type</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($certificates as $cert): ?>
                                        <?php if (!empty($cert['tradCertSignatoryA']) && !empty($cert['tradCertSignatoryB']) && !empty($cert['tradCertSignatoryC'])): ?>
                                            <tr>
                                                <td><strong class="text-success">#<?= esc($cert['tradCertSn'] ?? 'N/A') ?></strong></td>
                                                <td><?= esc($cert['tradCertHolderName'] ?? 'N/A') ?></td>
                                                <td>
                                                    <span class="badge badge-light text-dark">
                                                        <?= esc($cert['tradCertHoldercounty'] ?? 'N/A') ?>
                                                    </span>
                                                </td>
                                                <td><?= esc($cert['tradCertHolderOperationType'] ?? 'N/A') ?></td>
                                                <td>
                                                    <i class="fas fa-calendar-check fa-fw text-gray-400 mr-1"></i>
                                                    <?= !empty($cert['tradCertDateIssued']) ? date('M d, Y', strtotime($cert['tradCertDateIssued'])) : '<em class="text-muted">Pending</em>' ?>
                                                </td>
                                                <td>
                                                    <span class="badge badge-<?= ($cert['tradCertAppliedType'] ?? '') === 'online' ? 'success' : 'info' ?>">
                                                        <?= ucfirst($cert['tradCertAppliedType'] ?? 'N/A') ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="/dashboard/nativecert/view/<?= esc($cert['tradCertId']) ?>"
                                                       class="btn btn-success btn-sm btn-icon-split">
                                                        <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                                        <span class="text">View</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-certificate fa-3x mb-3 text-gray-300"></i>
                            <p class="h5 mb-0">No completed certificates yet.</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
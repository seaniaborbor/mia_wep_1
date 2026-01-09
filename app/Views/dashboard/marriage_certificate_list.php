<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading + Actions -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Marriage Certificate Log</h1>
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
            <a href="/matrimonial_dashboard/wedcert/create" class="btn btn-danger btn-icon-split">
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
                           href="/matrimonial_dashboard/wedcert?branch=<?= esc($branch['branchId']) ?>">
                            <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                            <?= esc($branch['branchName']) ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/matrimonial_dashboard/general">
                        <i class="fas fa-flag fa-sm fa-fw mr-2 text-gray-400"></i>
                        Nation's Dashboard
                    </a>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">

        <!-- Total Certificates -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-<?php echo (count($branch_complete_certificate) + count($branch_uncomplete_certificate)) > 0 ? 'left-primary' : 'left-secondary'; ?> shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($branch_complete_certificate) + count($branch_uncomplete_certificate) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-certificate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($branch_complete_certificate) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($branch_uncomplete_certificate) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Completion Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= (count($branch_complete_certificate) + count($branch_uncomplete_certificate)) > 0
                                    ? round((count($branch_complete_certificate) / (count($branch_complete_certificate) + count($branch_uncomplete_certificate))) * 100)
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

    <!-- Certificate Records with Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Certificate Records</h6>
        </div>
        <div class="card-body">

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="certificateTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab">
                        <i class="fas fa-hourglass-half mr-2"></i>Pending
                        <span class="badge badge-warning badge-counter ml-2"><?= count($branch_uncomplete_certificate) ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab">
                        <i class="fas fa-check-circle mr-2"></i>Completed
                        <span class="badge badge-success badge-counter ml-2"><?= count($branch_complete_certificate) ?></span>
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pending" role="tabpanel">
                    <?php include('partials/tables/uncompleted_wed_certificate_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="completed" role="tabpanel">
                    <?php include('partials/tables/completed_wed_certificate_table.php'); ?>
                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>
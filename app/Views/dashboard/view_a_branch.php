<?= $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= esc($branch_info['branchName']) ?></h1>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="branchDropdown" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-code-branch fa-sm"></i> Switch Branch
            </button>
            <div class="dropdown-menu" aria-labelledby="branchDropdown">
                <?php if (!empty($allBranches)): ?>
                    <?php foreach ($allBranches as $branch): ?>
                        <a class="dropdown-item <?= ($branch['branchId'] == $branch_info['branchId']) ? 'active' : '' ?>" 
                           href="<?= base_url('system_admin/branches/view/' . $branch['branchId']) ?>">
                            <i class="fas fa-building fa-fw mr-2"></i>
                            <?= esc($branch['branchName']) ?>
                            <br><small class="text-muted"><?= esc($branch['branchCityOrTown']) ?>, <?= esc($branch['branchCounty']) ?></small>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="dropdown-item text-muted">No branches available</span>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/system_admin/general">
                    <i class="fas fa-flag fa-fw mr-2"></i>Nation's Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Location Info -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Branch Location
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= esc($branch_info['branchCityOrTown']) ?>, <?= esc($branch_info['branchCounty']) ?> County
                            </div>
                            <div class="mt-2">
                                <span class="badge badge-<?= $branch_info['isActive'] ? 'success' : 'secondary' ?>">
                                    <?= $branch_info['isActive'] ? 'Active' : 'Inactive' ?>
                                </span>
                                <span class="text-muted ml-2">System ID: <?= esc($branch_info['branchCode']) ?></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Wedding Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($branch_marriage_certificates) ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ring fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Divorce Certificates
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($branch_divorce_certificates) ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-heart-broken fa-2x text-gray-300"></i>
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
                                Active Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_active_user ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Inactive Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_inactive_user ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-tabs" id="branchTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" 
                       aria-controls="info" aria-selected="true">
                        <i class="fas fa-info-circle mr-1"></i> Branch Information
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="active-users-tab" data-toggle="tab" href="#active-users" role="tab" 
                       aria-controls="active-users" aria-selected="false">
                        <i class="fas fa-user-check mr-1"></i> Active Users
                        <span class="badge badge-success ml-1"><?= $total_active_user ?? 0 ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inactive-users-tab" data-toggle="tab" href="#inactive-users" role="tab" 
                       aria-controls="inactive-users" aria-selected="false">
                        <i class="fas fa-user-times mr-1"></i> Inactive Users
                        <span class="badge badge-secondary ml-1"><?= $total_inactive_user ?? 0 ?></span>
                    </a>
                </li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content" id="branchTabContent">
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <?php include('partials/tables/branch_summary_table.php'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="active-users" role="tabpanel" aria-labelledby="active-users-tab">
                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <?php include('partials/tables/active_users_profiles_table.php'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="inactive-users" role="tabpanel" aria-labelledby="inactive-users-tab">
                    <div class="card shadow mt-3">
                        <div class="card-body">
                            <?php include('partials/tables/inactive_users_profiles_table.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        <i class="far fa-clock mr-1"></i> Last updated: <?= date('M j, Y \a\t g:i A') ?>
                    </div>
                    <div>
                        <a href="<?= base_url('system_admin/branches/edit/' . $branch_info['branchId']) ?>"
                           class="btn btn-primary btn-icon-split mr-2">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Edit Branch</span>
                        </a>
                        <a href="<?= base_url('system_admin/branches/deactivate/' . $branch_info['branchId']) ?>"
                           class="btn btn-<?= $branch_info['isActive'] ? 'danger' : 'success' ?> btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-toggle-<?= $branch_info['isActive'] ? 'off' : 'on' ?>"></i>
                            </span>
                            <span class="text"><?= $branch_info['isActive'] ? 'Deactivate' : 'Activate' ?> Branch</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
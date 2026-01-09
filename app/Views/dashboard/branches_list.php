<?= $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">National Branches Registry</h1>
            <p class="mb-0 text-gray-600">Complete Administrative Branch Oversight</p>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Branches
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_branches ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
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
                                Active Branches
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $active_branches ?? 0 ?></div>
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
                                Inactive Branches
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $inactive_branches ?? 0 ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
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
                                Operational Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= ($total_branches ?? 0) > 0 
                                    ? round((($active_branches ?? 0) / ($total_branches ?? 1)) * 100, 1) 
                                    : 0 ?>%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tachometer-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branches Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Registered Branches</h6>
            <span class="badge badge-primary">Nationwide administrative network</span>
        </div>
        <div class="card-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="branchesTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab">
                        <i class="fas fa-check-circle mr-2"></i>
                        Active Branches
                        <span class="badge badge-success ml-2"><?= $active_branches ?? 0 ?></span>
                    </a>
                </li>
                <?php if(($inactive_branches ?? 0) > 0): ?>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive" role="tab">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Inactive Branches
                        <span class="badge badge-warning ml-2"><?= $inactive_branches ?? 0 ?></span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="branchesTabContent">
                <div class="tab-pane fade show active" id="active" role="tabpanel">
                    <?php include('partials/tables/branches_list_table.php'); ?>
                </div>
                
                <?php if(($inactive_branches ?? 0) > 0): ?>
                <div class="tab-pane fade" id="inactive" role="tabpanel">
                    <div class="text-center py-5">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h5 class="text-gray-600">Inactive Branches List</h5>
                        <p class="text-muted">This section will display inactive branches when available.</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Patriotic Theme Enhancements -->
<style>
/* Enhanced patriotic colors while maintaining SB Admin 2 structure */
.card-header.bg-primary { background: linear-gradient(135deg, #002868 0%, #001F5B 100%) !important; }
.border-left-primary { border-left: 0.25rem solid #002868 !important; }
.border-left-danger { border-left: 0.25rem solid #BF0A30 !important; }

/* Enhanced table styling */
.table thead th { 
    border-bottom: 2px solid #BF0A30;
    color: #002868;
}

/* Hover effects */
.card:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease-in-out;
}

/* Tab enhancements */
.nav-tabs .nav-link.active {
    border-bottom: 3px solid #BF0A30;
    font-weight: 600;
}

.nav-tabs .nav-link {
    color: #4b5563;
    font-weight: 500;
}

.nav-tabs .nav-link:hover {
    color: #002868;
}
</style>

<?= $this->endSection() ?>
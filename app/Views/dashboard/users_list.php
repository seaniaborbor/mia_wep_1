<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users-cog mr-2"></i>Users Management
            </h1>
            <h6 class="m-0 font-weight-bold ">
                <i class="fas fa-building mr-2"></i>
                <?php if(isset($breanchDetail) && !empty($breanchDetail)): ?>
                    <?= esc($breanchDetail['branchName']) ?>
                <?php else: ?>
                    <?= esc(session()->get('userData')['branchName']) ?>
                <?php endif; ?>
            </h6>
        </div>

        <div>
            <?php if(session()->get('userData')['userBreanch'] == 1): ?>
            <a href="/dashboard/users/create" class="btn btn-secondary btn-sm">
                <i class="fas fa-user-plus mr-2"></i>Create New User
            </a>
        <?php endif; ?>
        <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="branchDropdown">
                <?php foreach ($allBranches as $branch): ?>
                    <a class="dropdown-item <?= ($branch['branchId'] == ($branchDetail['branchId'] ?? '')) ? 'active' : '' ?>"
                       href="/dashboard?branch=<?= esc($branch['branchId']) ?>">
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

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($users_active) + count($users_inactive) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Active Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($users_active) ?>
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
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Inactive Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($users_inactive) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-slash fa-2x text-gray-300"></i>
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
                                Active Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= (count($users_active) + count($users_inactive)) > 0 
                                    ? round((count($users_active) / (count($users_active) + count($users_inactive)) * 100)) 
                                    : 0 ?>%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- include the branch switcher here -->


    <!-- Users Table with Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list-ul mr-2"></i>Registered Users
            </h6>
        </div>
        <div class="card-body">

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-3" id="usersTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active">
                        <i class="fas fa-user-check mr-1"></i> Active Users
                        <span class="badge badge-success ml-2"><?= count($users_active) ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive">
                        <i class="fas fa-user-slash mr-1"></i> Inactive Users
                        <span class="badge badge-danger ml-2"><?= count($users_inactive) ?></span>
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="active">
                    <?php include('partials/tables/active_users_profiles_table.php'); ?>
                </div>
                <div class="tab-pane fade" id="inactive">
                    <?php include('partials/tables/inactive_users_profiles_table.php'); ?>
                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>
<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users-cog mr-2 text-primary"></i>Cultural Users Management
            </h1>
            <h6 class="m-0 font-weight-bold text-gray-600 mt-2">
                <i class="fas fa-building mr-2 text-info"></i>
                <?php if(isset($breanchDetail) && !empty($breanchDetail)): ?>
                    <span class="badge badge-info p-2"><?= esc($breanchDetail['branchName']) ?></span>
                <?php else: ?>
                    <span class="badge badge-secondary p-2"><?= esc(session()->get('userData')['branchName']) ?></span>
                <?php endif; ?>
            </h6>
        </div>
    </div>

    <!-- Stats Cards with Enhanced Icons -->
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
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-user-friends fa-sm mr-1"></i>
                                    All registered users
                                </small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-3x text-primary opacity-25"></i>
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
                            <div class="mt-2">
                                <small class="text-success">
                                    <i class="fas fa-circle fa-sm mr-1"></i>
                                    Currently active
                                </small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-3x text-success opacity-25"></i>
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
                                Inactive Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= count($users_inactive) ?>
                            </div>
                            <div class="mt-2">
                                <small class="text-warning">
                                    <i class="fas fa-circle fa-sm mr-1"></i>
                                    Currently inactive
                                </small>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-slash fa-3x text-warning opacity-25"></i>
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
                                <?php 
                                    $totalUsers = count($users_active) + count($users_inactive);
                                    $activeRate = $totalUsers > 0 ? round((count($users_active) / $totalUsers) * 100) : 0;
                                ?>
                                <?= $activeRate ?>%
                            </div>
                            <div class="mt-2">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-info" role="progressbar" 
                                         style="width: <?= $activeRate ?>%" 
                                         aria-valuenow="<?= $activeRate ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-3x text-info opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Legend -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body p-3">
                    <div class="d-flex flex-wrap align-items-center">
                        <span class="text-muted mr-3 mb-1">Status Legend:</span>
                        <span class="status-badge active mr-3 mb-1">
                            <i class="fas fa-circle mr-1"></i> Active User
                        </span>
                        <span class="status-badge inactive mr-3 mb-1">
                            <i class="fas fa-circle mr-1"></i> Inactive User
                        </span>
                        <span class="status-badge admin mr-3 mb-1">
                            <i class="fas fa-shield-alt mr-1"></i> Admin User
                        </span>
                        <span class="status-badge regular mr-3 mb-1">
                            <i class="fas fa-user mr-1"></i> Regular User
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table with Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-list-ul mr-2"></i>Registered Users
                <small class="ml-2">Manage system users and their permissions</small>
            </h6>
        </div>
        <div class="card-body p-0">

            <!-- Enhanced Nav Tabs -->
            <div class="border-bottom">
                <ul class="nav nav-tabs" id="usersTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator active mr-2"></div>
                                <span>Active Users</span>
                                <span class="badge badge-success ml-2 rounded-pill"><?= count($users_active) ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive">
                            <div class="d-flex align-items-center">
                                <div class="status-indicator inactive mr-2"></div>
                                <span>Inactive Users</span>
                                <span class="badge badge-warning ml-2 rounded-pill"><?= count($users_inactive) ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="pt-2 pr-3">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" class="form-control form-control-sm" placeholder="Search users...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content p-3">
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

<!-- Custom CSS for User Status -->
<style>
    /* Status Indicators */
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    
    .status-indicator.active {
        background-color: #1cc88a;
        box-shadow: 0 0 0 2px rgba(28, 200, 138, 0.2);
    }
    
    .status-indicator.inactive {
        background-color: #f6c23e;
        box-shadow: 0 0 0 2px rgba(246, 194, 62, 0.2);
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .status-badge.active {
        background-color: rgba(28, 200, 138, 0.1);
        color: #1a7a5a;
        border: 1px solid rgba(28, 200, 138, 0.3);
    }
    
    .status-badge.inactive {
        background-color: rgba(246, 194, 62, 0.1);
        color: #a37c0e;
        border: 1px solid rgba(246, 194, 62, 0.3);
    }
    
    .status-badge.admin {
        background-color: rgba(78, 115, 223, 0.1);
        color: #4e73df;
        border: 1px solid rgba(78, 115, 223, 0.3);
    }
    
    .status-badge.regular {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.3);
    }
    
    /* Card Hover Effects */
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    /* Table Styling */
    .table td, .table th {
        vertical-align: middle;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f8f9fc;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #4e73df;
        border: 2px solid #e3e6f0;
    }
    
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        padding: 1rem 1.5rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link:hover {
        border-bottom-color: #dee2e6;
        color: #4e73df;
    }
    
    .nav-tabs .nav-link.active {
        color: #4e73df;
        border-bottom-color: #4e73df;
        background-color: transparent;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem !important;
        }
        
        .nav-tabs .nav-link {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
        
        .status-badge {
            font-size: 0.8rem;
            padding: 3px 8px;
        }
    }
    
    /* User Row Styling */
    .user-row {
        transition: all 0.2s ease;
    }
    
    .user-row:hover {
        background-color: #f8f9fc;
        transform: translateX(5px);
    }
</style>

<?= $this->endSection() ?>
<?= $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<?php
function labelUser($userBranch, $userAccountType)
{
    if ($userBranch == 1) {
        $labels = [
            'SIGNA' => 'Signatory A',
            'SIGNB' => 'Signatory B',
            'SIGNC' => 'Signatory C',
            'ENTRY' => 'Data Entry Clerk',
        ];
    } else {
        $labels = [
            'SIGNA' => 'Superintendent',
            'SIGNB' => 'Commissioner',
            'SIGNC' => 'Governor',
            'ENTRY' => 'Data Entry Clerk',
        ];
    }

    return $labels[$userAccountType] ?? $userAccountType;
}
?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-primary d-flex justify-content-between">
                <h4 class="text-primary mb-0 font-weight-bold">
                    <i class="fas fa-id-badge mr-2"></i>User Accounts & Profiles
                </h4>
                <a href="/dashboard/users/create" class="btn btn-sm btn-primary btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Add User</span>
                </a>
            </div>

            <div class="card-body p-4">
                <!-- User Stats Summary -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-left-primary shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary text-white">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Users
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= count($users_active) + count($users_inactive) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success text-white">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Active Users
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= count($users_active) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-left-danger shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger text-white">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Inactive Users
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= count($users_inactive) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-pills mb-4" id="userTabs" role="tablist">
                    <li class="nav-item mr-2">
                        <a class="nav-link active py-2 px-3" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                            <i class="fas fa-user-check mr-2"></i> Active Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3" id="inactive-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">
                            <i class="fas fa-user-slash mr-2"></i> Inactive Users
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="userTabsContent">
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                        <?php include('partials/tables/active_users_profiles_table.php'); ?>
                    </div>
                    
                    <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                        <?php include('partials/tables/inactive_users_profiles_table.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<style>
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
</style>
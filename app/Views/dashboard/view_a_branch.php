<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border ">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom-primary py-3 d-flex flex-column flex-md-row justify-content-between align-items-center border-bottom">
                <h5 class="mb-0  text-primary font-weight-bold">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i><?= esc(strtoupper($branch_info['branchName'])) ?>
                </h5>
                <button class="btn btn-outline-secondary btn-sm mt-2 mt-md-0">
                    <i class="fas fa-print mr-2"></i>Generate Report
                </button>
            </div>

            <div class="card-body">
                <!-- Branch Stats Summary -->
<div class="row px-2">
    <!-- Wedding Certificates Card -->
    <div class="col-md-3 mb-3 mb-md-0">
        <div class="card border-left-primary shadow-sm h-100">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary text-white">
                            <i class="fas fa-ring"></i> <!-- Wedding ring icon -->
                        </div>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Wedding Certificates 
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= count($branch_marriage_certificates) ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divorce Certificates Card -->
    <div class="col-md-3 mb-3 mb-md-0">
        <div class="card border-left-danger shadow-sm h-100"> <!-- Changed to danger color -->
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-danger text-white"> <!-- Changed to danger color -->
                            <i class="fas fa-heart-broken"></i> <!-- Broken heart icon -->
                        </div>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"> <!-- Changed to danger color -->
                            Total Divorce Certificates
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= count($branch_divorce_certificates) ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Users Card -->
    <div class="col-md-3">
        <div class="card border-left-success shadow-sm h-100">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-success text-white">
                            <i class="fas fa-user-check"></i> <!-- Active user icon -->
                        </div>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Active Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $total_active_user ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inactive Users Card -->
    <div class="col-md-3">
        <div class="card border-left-secondary shadow-sm h-100"> <!-- Changed to secondary color -->
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-secondary text-white"> <!-- Changed to secondary color -->
                            <i class="fas fa-user-times"></i> <!-- Inactive user icon -->
                        </div>
                    </div>
                    <div>
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"> <!-- Changed to secondary color -->
                            Total Inactive Users
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= $total_inactive_user ?? 0 ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Navigation Tabs -->
                <ul class="nav nav-pills border-bottom-0 px-3 pt-3" id="branchTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active py-2 px-3 border-top-0" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">
                            <i class="fas fa-info-circle mr-2 text-white"></i>Branch Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 border-top-0" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">
                            <i class="fas fa-check-circle mr-2 text-white"></i>Marriage Certificates Log
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 border-top-0" id="uncompleted-tab" data-toggle="tab" href="#uncompleted" role="tab" aria-controls="uncompleted" aria-selected="false">
                            <i class="fas fa-hourglass-half mr-2 text-white"></i>Divorce Certificate Log
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 border-top-0" id="active-users-tab" data-toggle="tab" href="#active-users" role="tab" aria-controls="active-users" aria-selected="false">
                            <i class="fas fa-user-check mr-2 text-white"></i>Active Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 border-top-0" id="inactive-users-tab" data-toggle="tab" href="#inactive-users" role="tab" aria-controls="inactive-users" aria-selected="false">
                            <i class="fas fa-user-times mr-2 text-white"></i>Inactive Users
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content px-0 pb-3">
                    <!-- Branch Info Tab -->
                    <div class="tab-pane pt-3 fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <?php include('partials/tables/branch_summary_table.php'); ?>
                    </div>

                    <!-- Completed Certificates Tab -->
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="card border-0 mt-3">
                            <div class="card-body p-0">
                                <?php include('partials/tables/branch_wedding_cert_log.php'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Uncompleted Certificates Tab -->
                    <div class="tab-pane fade" id="uncompleted" role="tabpanel" aria-labelledby="uncompleted-tab">
                        <div class="card border-0 mt-3">
                            <div class="card-body p-0">
                                <?php include('partials/tables/branch_divorce_cert_log.php'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Users Tab -->
                    <div class="tab-pane fade" id="active-users" role="tabpanel" aria-labelledby="active-users-tab">
                        <div class="card border-0 mt-3">
                            <div class="card-body p-0">
                                <?php include('partials/tables/active_users_profiles_table.php'); ?>                              
                            </div>
                        </div>
                    </div>
                    
                    <!-- Inactive Users Tab -->
                    <div class="tab-pane fade" id="inactive-users" role="tabpanel" aria-labelledby="inactive-users-tab">
                        <div class="card border-0 mt-3">
                            <div class="card-body p-0">
                                <?php include('partials/tables/inactive_users_profiles_table.php'); ?>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-light d-flex justify-content-between small text-muted py-2">
                System ID: <?= esc($branch_info['branchCode']) ?> | Last updated: <?= date('m/d/Y g:i A') ?>
                <div>
                    <a href="<?= base_url('dashboard/branches/edit/' . $branch_info['branchId']) ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit mr-1"></i>Edit Branch
                    </a>
                    <a href="<?= base_url('dashboard/branches/deactivate/' . $branch_info['branchId']) ?>" class="btn btn-sm btn-secondary">
                        <i class="fas fa-toggle-on mr-1"></i><?= $branch_info['isActive'] ? 'Deactivate' : 'Activate' ?> Branch
                    </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
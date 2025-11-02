<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border">
            <!-- Card Header -->
            <div class="card-header bg-white border-bottom-primary py-3 d-flex flex-column flex-md-row justify-content-between align-items-center border-bottom">
                <h5 class="mb-0 text-primary font-weight-bold">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i><?= esc(strtoupper($branch_info['branchName'])) ?>
                </h5>

                <!-- Branch Dropdown -->
                <div class="btn-group mt-2 mt-md-0">
                    <button type="button" class="btn btn-primary btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-code-branch"></i>
                        </span>
                        <span class="text">
                            <?php
                                $currentBranch = 'Select Branch';
                                if (isset($branch_info['branchId']) && !empty($allBranches)) {
                                    foreach ($allBranches as $b) {
                                        if ($b['branchId'] == $branch_info['branchId']) {
                                            $currentBranch = htmlspecialchars($b['branchName']);
                                            break;
                                        }
                                    }
                                }
                                echo $currentBranch;
                            ?>
                        </span>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Switch Branch</span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php if(isset($allBranches) && !empty($allBranches)): ?>
                            <?php foreach($allBranches as $branch): ?>
                                <li>
                                    <a class="dropdown-item <?php echo ($branch['branchId'] == ($branch_info['branchId'] ?? '')) ? 'active' : ''; ?>" 
                                       href="<?= base_url('dashboard/branches/view/' . $branch['branchId']) ?>">
                                        <i class="fas fa-building mr-2"></i>
                                        <?= esc($branch['branchName']) ?>
                                        <small class="text-muted d-block" style="font-size: 11px;">
                                            <?= esc($branch['branchCityOrTown']) ?> — <?= esc($branch['branchCounty']) ?>
                                        </small>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><span class="dropdown-item text-muted">No branches found</span></li>
                        <?php endif; ?>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="/dashboard/general">
                                <i class="fas fa-flag mr-2"></i>
                                Nation's Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
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
                                            <i class="fas fa-ring"></i>
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
                        <div class="card border-left-danger shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger text-white">
                                            <i class="fas fa-heart-broken"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
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
                                            <i class="fas fa-user-check"></i>
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
                        <div class="card border-left-secondary shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-secondary text-white">
                                            <i class="fas fa-user-times"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
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
</div>

<!-- Add the same diagnostic JavaScript from marriage_certificate_list.php -->
<script>
    $(document).ready(function() {
        // Verify jQuery and Bootstrap are loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded.');
        } else {
            console.log('jQuery loaded:', jQuery.fn.jquery);
        }
        if (typeof Popper === 'undefined') {
            console.error('Popper.js is not loaded.');
        }
        if (typeof $.fn.dropdown === 'undefined') {
            console.error('Bootstrap dropdown plugin is not loaded.');
        } else {
            console.log('Bootstrap dropdown plugin is available.');
        }

        // Initialize dropdown manually if needed
        $('.dropdown-toggle').dropdown();

        // Log dropdown click for debugging
        $('.dropdown-toggle').on('click', function() {
            console.log('Dropdown toggle clicked.');
        });
    });
</script>

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
</style>

<?= $this->endSection() ?>
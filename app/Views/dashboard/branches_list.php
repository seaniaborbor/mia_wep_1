<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-primary py-3">
                <h4 class="text-primary mb-0 font-weight-bold">
                    <i class="fas fa-code-branch mr-2"></i>Branches Summary Log
                </h4>
            </div>

            <div class="card-body p-4">
                <!-- Branch Stats Summary -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-left-primary shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary text-white">
                                            <i class="fas fa-building"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Branches 
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $total_branches ?? 0 ?>
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
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Active Branches
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $active_branches ?? 0 ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-left-warning shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning text-white">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Inactive Branches
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $inactive_branches ?? 0 ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <ul class="nav nav-pills mb-4" id="branchTabs" role="tablist">
                    <li class="nav-item mr-2">
                        <a class="nav-link active py-2 px-3" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">
                            <i class="fas fa-check-circle text-success mr-2"></i> Active Branches
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="branchTabsContent">
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                        <?php include('partials/tables/branches_list_table.php'); ?>
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
<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                Branches Management
            </h1>
            <h6 class="m-0 font-weight-bold text-primary mt-2">
                All Registered Service Centers & Branches
            </h6>
        </div>

        <div>
            <!-- Only HQ (branchId 1) can create branches -->
            <?php if (session()->get('userData')['userBreanch'] == 1): ?>
                <a href="/dashboard/branches/create" class="btn btn-success btn-sm">
                    Add New Branch
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Branches</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_branches ?></div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Branches</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_active_branches ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Inactive Branches</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_inactive_branches ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Operational Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_branches > 0 ? round(($total_active_branches / $total_branches) * 100) : 0 ?>%
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

    <!-- Branches Table with Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Branch Directory
            </h6>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs mb-4" id="branchTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-branches-tab" data-toggle="tab" href="#active-branches">
                        Active Branches <span class="badge badge-success ml-2"><?= $total_active_branches ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inactive-branches-tab" data-toggle="tab" href="#inactive-branches">
                        Inactive Branches <span class="badge badge-danger ml-2"><?= $total_inactive_branches ?></span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Active Branches -->
                <div class="tab-pane fade show active" id="active-branches">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="activeBranchesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Branch Code</th>
                                    <th>Branch Name</th>
                                    <th>County</th>
                                    <th>City/Town</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($branches_active)): ?>
                                    <?php foreach ($branches_active as $branch): ?>
                                        <tr>
                                            <td class="align-middle font-weight-bold text-monospace">
                                                <?= esc($branch['branchCode']) ?>
                                            </td>
                                            <td class="align-middle">
                                                <strong><?= esc($branch['branchName']) ?></strong>
                                                <?php if ($branch['branchId'] == 1): ?>
                                                    <span class="badge badge-primary ml-2">HQ</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle"><?= esc($branch['branchCounty']) ?></td>
                                            <td class="align-middle"><?= esc($branch['branchCityOrTown']) ?></td>
                                            <td class="align-middle">
                                                <i class="fas fa-phone text-gray-400 mr-1"></i>
                                                <?= esc($branch['branchContact']) ?>
                                            </td>
                                            <td class="align-middle">
                                                <i class="fas fa-envelope text-gray-400 mr-1"></i>
                                                <?= esc($branch['branchEmail']) ?>
                                            </td>
                                            <ad class="text-center align-middle">
                                                <span class="badge badge-success">Active</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="/dashboard/branches/view/<?= $branch['branchId'] ?>" 
                                                   class="btn btn-sm btn-primary" title="View Branch">
                                                    View
                                                </a>
                                                <?php if (session()->get('userData')['userBreanch'] == 1): ?>
                                                    <a href="/dashboard/branches/edit/<?= $branch['branchId'] ?>" 
                                                       class="btn btn-sm btn-warning" title="Edit Branch">
                                                        Edit
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-gray-600">
                                            <i class="fas fa-building fa-3x text-gray-300 mb-3"></i>
                                            <p>No active branches found</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Inactive Branches -->
                <div class="tab-pane fade" id="inactive-branches">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="inactiveBranchesTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Branch Code</th>
                                    <th>Branch Name</th>
                                    <th>County</th>
                                    <th>City/Town</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($branches_inactive)): ?>
                                    <?php foreach ($branches_inactive as $branch): ?>
                                        <tr>
                                            <td class="align-middle font-weight-bold text-monospace text-muted">
                                                <?= esc($branch['branchCode']) ?>
                                            </td>
                                            <td class="align-middle text-muted">
                                                <?= esc($branch['branchName']) ?>
                                            </td>
                                            <td class="align-middle text-muted"><?= esc($branch['branchCounty']) ?></td>
                                            <td class="align-middle text-muted"><?= esc($branch['branchCityOrTown']) ?></td>
                                            <td class="align-middle text-muted"><?= esc($branch['branchContact']) ?></td>
                                            <td class="align-middle text-muted"><?= esc($branch['branchEmail']) ?></td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-danger">Inactive</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="/dashboard/branches/view/<?= $branch['branchId'] ?>" 
                                                   class="btn btn-sm btn-primary" title="View Branch">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-gray-600">
                                            <i class="fas fa-ban fa-3x text-gray-300 mb-3"></i>
                                            <p>No inactive branches</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    $('#activeBranchesTable, #inactiveBranchesTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[1, 'asc']],
        columnDefs: [
            { orderable: false, targets: [7] },
            { searchable: false, targets: [7] }
        ]
    });
});
</script>

<?= $this->endSection() ?>
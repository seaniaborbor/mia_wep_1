<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                Users Management
            </h1>
            <h6 class="m-0 font-weight-bold text-primary mt-2">
                Current Branch: <?= $branch_name ?? 'Head Office Branch' ?>
            </h6>
        </div>

        <div class="d-flex align-items-center gap-3">

            <!-- Create New User Button (Only HQ) -->
                <a href="/system_admin/users/create" class="btn btn-success btn-sm">
                    Create New User
                </a>

            <!-- Branch Switcher Dropdown (Only for HQ users) -->
            <?php if (session()->get('userData')['userBreanch'] == 1): ?>
            <div class="dropdown">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="branchDropdown" data-toggle="dropdown">
                    Switch Branch
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="branchDropdown">
                    <?php foreach ($allBranches as $branch): ?>
                        <a class="dropdown-item  ?>"
                           href="/system_admin/users?branch=<?= $branch['branchId'] ?>">
                            <?= esc($branch['branchName']) ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-info" href="/system_admin/users">
                        View All Branches Users
                    </a>
                </div>
            </div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_users ?></div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_active_users ?></div>
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
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Inactive Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_inactive_users ?></div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Rate</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_users > 0 ? round(($total_active_users / $total_users) * 100) : 0 ?>%
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

    <!-- Tabs: Active & Inactive Users -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                System Users
            </h6>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active-users">
                        Active Users <span class="badge badge-success ml-2"><?= $total_active_users ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive-users">
                        Inactive Users <span class="badge badge-danger ml-2"><?= $total_inactive_users ?></span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Active Users Tab -->
                <div class="tab-pane fade show active" id="active-users">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="activeUsersTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="80" class="text-center">Photo</th>
                                    <th>Full Name</th>
                                    <th>Position</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users_active)): ?>
                                    <?php foreach ($users_active as $user): ?>
                                        <tr>
                                            <td class="text-center">
                                                <img src="<?= base_url('uploads/users/pictures/' . ($user['userPicture'] ?? 'default-avatar.png')) ?>"
                                                     class="img-profile rounded-circle" width="45" height="45"
                                                     alt="<?= esc($user['userFullName']) ?>">
                                            </td>
                                            <td class="align-middle"><strong><?= esc($user['userFullName']) ?></strong></td>
                                            <td class="align-middle"><?= esc($user['userPosition'] ?? '—') ?></td>
                                            <td class="align-middle"><?= esc($user['userAccountType']) ?></td>
                                            <td class="align-middle"><?= esc($user['userDepartment'] ?? '—') ?></td>
                                            <td class="align-middle">
                                                <i class="fas fa-envelope text-gray-400 mr-1"></i><?= esc($user['userEmail']) ?>
                                            </td>
                                            <td class="align-middle">
                                                <?= !empty($user['userPhone']) ? esc($user['userPhone']) : '<span class="text-muted">—</span>' ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-success">Active</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="/dashboard/users/view/<?= $user['userId'] ?>" class="btn btn-sm btn-primary">
                                                </a>
                                                <a href="/dashboard/users/edit/<?= $user['userId'] ?>" class="btn btn-sm btn-warning">
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-gray-600">
                                            <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                                            <p>No active users found</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Inactive Users Tab -->
                <div class="tab-pane fade" id="inactive-users">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="inactiveUsersTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="80" class="text-center">Photo</th>
                                    <th>Full Name</th>
                                    <th>Position</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users_inactive)): ?>
                                    <?php foreach ($users_inactive as $user): ?>
                                        <tr>
                                            <td class="text-center">
                                                <img src="<?= base_url('uploads/users/pictures/' . ($user['userPicture'] ?? 'default-avatar.png')) ?>"
                                                     class="img-profile rounded-circle" width="45" height="45"
                                                     alt="<?= esc($user['userFullName']) ?>">
                                            </td>
                                            <td class="align-middle"><strong><?= esc($user['userFullName']) ?></strong></td>
                                            <td class="align-middle"><?= esc($user['userPosition'] ?? '—') ?></td>
                                            <td class="align-middle"><?= esc($user['userAccountType']) ?></td>
                                            <td class="align-middle"><?= esc($user['userDepartment'] ?? '—') ?></td>
                                            <td class="align-middle">
                                                <i class="fas fa-envelope text-gray-400 mr-1"></i><?= esc($user['userEmail']) ?>
                                            </td>
                                            <td class="align-middle">
                                                <?= !empty($user['userPhone']) ? esc($user['userPhone']) : '<span class="text-muted">—</span>' ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-danger">Inactive</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="/dashboard/users/view/<?= $user['userId'] ?>" class="btn btn-sm btn-primary">
                                                </a>
                                                <a href="/dashboard/users/edit/<?= $user['userId'] ?>" class="btn btn-sm btn-warning">
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-gray-600">
                                            <i class="fas fa-user-slash fa-3x text-gray-300 mb-3"></i>
                                            <p>No inactive users</p>
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
    $('#activeUsersTable, #inactiveUsersTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[1, 'asc']],
        columnDefs: [
            { orderable: false, targets: [0, 8] },
            { searchable: false, targets: [0, 8] }
        ]
    });
});
</script>

<?= $this->endSection() ?>
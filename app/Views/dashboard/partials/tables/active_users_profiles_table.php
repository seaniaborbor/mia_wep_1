<?php

function labelUser($branch, $type)
{
    // Customize based on your logic
    $labels = [
        'SIGNA' => 'Account A',
        'SIGNB' => 'Account B',
        'SIGNC' => 'Account C',
        'ADMIN' => 'Administrator',
        'USER'  => 'Standard User'
    ];

    return $labels[$type] ?? 'Unknown';
}
?>

<!-- partials/tables/active_users_profiles_table.php -->
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="text-center" width="80">Profile</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Account Type</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="text-center">Status</th>
                <th class="text-center" width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users_active) && is_array($users_active)): ?>
                <?php foreach ($users_active as $user): ?>
                    <tr>
                        <!-- Profile Picture + Status Dot -->
                        <td class="text-center">
                            <div class="position-relative d-inline-block">
                                <img src="<?= base_url('uploads/users/pictures/' . ($user['userPicture'] ?? 'default-avatar.png')) ?>"
                                     alt="<?= esc($user['userFullName']) ?>"
                                     class="img-profile rounded-circle"
                                     width="45" height="45">
                                <span class="position-absolute bottom-0 end-0 translate-middle-ping rounded-circle p-1 bg-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?> border border-light">
                                    <span class="visually-hidden">Status</span>
                                </span>
                            </div>
                        </td>

                        <!-- Full Name -->
                        <td class="align-middle">
                            <strong><?= esc($user['userFullName']) ?></strong>
                        </td>

                        <!-- Position -->
                        <td class="align-middle">
                            <?= !empty($user['userPosition']) ? esc($user['userPosition']) : '<span class="text-muted">—</span>' ?>
                        </td>

                        <!-- Account Type (with proper label) -->
                        <td class="align-middle">
                            <span class="badge badge-<?= 
                                in_array($user['userAccountType'], ['SIGNA','SIGNB','SIGNC']) ? 'primary' : 'secondary'
                            ?>">
                                <?= labelUser($user['userBreanch'], $user['userAccountType']) ?>
                            </span>
                        </td>

                        <!-- Branch -->
                        <td class="align-middle">
                            <?= esc($user['branchName']) ?>
                        </td>

                        <!-- Email -->
                        <td class="align-middle">
                            <i class="fas fa-envelope text-gray-400 mr-1"></i>
                            <?= esc($user['userEmail']) ?>
                        </td>

                        <!-- Phone -->
                        <td class="align-middle">
                            <?php if (!empty($user['userPhone'])): ?>
                                <i class="fas fa-phone text-gray-400 mr-1"></i>
                                <?= esc($user['userPhone']) ?>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>

                        <!-- Status Badge -->
                        <td class="text-center align-middle">
                            <span class="badge badge-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?>">
                                <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-center align-middle">
                            <a href="/dashboard/users/view/<?= $user['userId'] ?>"
                               class="btn btn-sm btn-primary"
                               title="View Profile">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/dashboard/users/edit/<?= $user['userId'] ?>"
                               class="btn btn-sm btn-warning"
                               title="Edit User">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                        <p class="text-gray-600 mb-0">No Active Users Found</p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[1, 'asc']],
        columnDefs: [
            { orderable: false, targets: [0, 8] },
            { searchable: false, targets: [0, 8] }
        ],
        language: {
            emptyTable: "No active users found",
            zeroRecords: "No matching users found"
        }
    });
});
</script>
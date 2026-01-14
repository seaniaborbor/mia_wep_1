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
                    <?php
                    $isActive = $user['userAccountActiveStatus'];
                    $statusClass = $isActive ? 'success' : 'danger';
                    $statusColor = $isActive ? '#28a745' : '#dc3545';
                    ?>
                    <tr>
                        <!-- Profile Picture + Status Dot -->
                        <td class="text-center">
                            <div class="position-relative d-inline-block" style="width: 45px; height: 45px;">
                                <img src="<?= base_url('uploads/users/pictures/' . ($user['userPicture'] ?? 'default-avatar.png')) ?>"
                                     alt="<?= esc($user['userFullName']) ?>"
                                     class="img-profile rounded-circle"
                                     width="45" height="45"
                                     style="object-fit: cover;">
                                
                                <!-- Enhanced Status Indicator -->
                                <span class="position-absolute bottom-0 end-0 translate-middle">
                                    <span class="d-block">
                                        <!-- Outer ring (optional) -->
                                        <span class="position-absolute top-50 start-50 translate-middle rounded-circle" 
                                              style="width: 16px; height: 16px; background-color: white; border: 2px solid white; z-index: 1;">
                                        </span>
                                        
                                        <!-- Inner status dot -->
                                        <span class="position-absolute top-50 start-50 translate-middle rounded-circle border border-white shadow-sm" 
                                              style="width: 12px; height: 12px; background-color: <?= $statusColor ?>; z-index: 2;"
                                              title="<?= $isActive ? 'User is active' : 'User is inactive' ?>">
                                        </span>
                                        
                                        <!-- Optional ping animation for active users -->
                                        <?php if ($isActive): ?>
                                        <span class="position-absolute top-50 start-50 translate-middle rounded-circle" 
                                              style="width: 16px; height: 16px; background-color: <?= $statusColor ?>; opacity: 0.4; z-index: 0; animation: statusPing 2s cubic-bezier(0, 0, 0.2, 1) infinite;">
                                        </span>
                                        <?php endif; ?>
                                    </span>
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
                            <span class="badge badge-<?= $statusClass ?> px-3 py-1">
                                <?= $isActive ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-center align-middle">
                            <a href="
                            <?php if(session()->get('userData')['userDepartment'] == 'Cultural') : ?>
                                /cultural_dashboard/users/view/<?= $user['userId'] ?>
                            <?php elseif(session()->get('userData')['userDepartment'] == 'Matrimonial') : ?>
                                /matrimonial_dashboard/users/view/<?= $user['userId'] ?>
                            <?php else: ?>
                                /dashboard/users/view/<?= $user['userId'] ?>
                            <?php endif; ?>
                            "
                               class="btn btn-sm btn-primary"
                               title="View Profile">
                                <i class="fas fa-eye"></i>
                            </a>
                            <?php if(session()->get('userData')['userId'] == $user['userId'] || session()->get('userData')['userAccountType'] == "ADMIN"): ?>
                            <a href="
                            <?php if(session()->get('userData')['userDepartment'] == 'Cultural') : ?>
                                /cultural_dashboard/users/edit/<?= $user['userId'] ?>
                                <?php elseif(session()->get('userData')['userDepartment'] == 'Matrimonial') : ?>
                                /matrimonial_dashboard/users/edit/<?= $user['userId'] ?>
                                <?php else: ?>
                                /dashboard/users/edit/<?= $user['userId'] ?>
                                <?php endif; ?>
                            "
                               class="btn btn-sm btn-warning"
                               title="Edit User">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php endif; ?>
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

<style>
/* Ping animation for active status */
@keyframes statusPing {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0.6;
    }
    70%, 100% {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
}

/* Ensure proper positioning */
.position-relative {
    position: relative;
}
.position-absolute {
    position: absolute;
}
.translate-middle {
    transform: translate(-50%, -50%);
}
.rounded-circle {
    border-radius: 50%;
}
.d-inline-block {
    display: inline-block;
}
.d-block {
    display: block;
}
.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
.border {
    border-width: 1px;
    border-style: solid;
}
.border-white {
    border-color: white;
}
</style>

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
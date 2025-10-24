<!-- User Table -->
<div class="table-responsive">
    <table class="table table-bordered datatable table-hover" id="usersTable">
        <thead class="thead-light">
            <tr>
                <th>Profile</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Account Type</th>
                <th>Branch</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users_inactive) && is_array($users_inactive)): ?>
                <?php foreach ($users_inactive as $user): ?>
                    <tr>
                        <td class="text-center">
                            <img src="<?= base_url('uploads/users/pictures/' . $user['userPicture']) ?>" 
                                class="rounded-circle" 
                                style="width: 40px; height: 40px; object-fit: cover;" 
                                alt="Profile Picture">
                        </td>
                        <td><?= esc($user['userFullName']) ?></td>
                        <td><?= !empty($user['userPosition']) ? esc($user['userPosition']) : 'N/A' ?></td>
                        <td><?= $user['userAccountType'] ?></td>
                        <td><?= esc($user['branchName']) ?></td>
                        <td><?= esc($user['userEmail']) ?></td>
                        <td><?= !empty($user['userPhone']) ? esc($user['userPhone']) : 'N/A' ?></td>
                        <td>
                            <span class="badge badge-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?>">
                                <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="/dashboard/users/view/<?= $user['userId'] ?>" 
                                class="btn btn-sm btn-primary" 
                                title="View Profile"
                                data-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/dashboard/users/edit/<?= $user['userId'] ?>" 
                                class="btn btn-sm btn-info" 
                                title="Edit"
                                data-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i> No inactive user accounts found.
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
    #usersTable th {
        white-space: nowrap;
    }
    #usersTable td {
        vertical-align: middle;
    }
</style>

<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Initialize DataTable if you want sorting/searching
        $('#usersTable').DataTable({
            responsive: true,
            columnDefs: [
                { orderable: false, targets: [0, 8] } // Disable sorting for profile pic and actions columns
            ]
        });
    });
</script>
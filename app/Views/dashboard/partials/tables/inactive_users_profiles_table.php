<?php if (!empty($users_inactive) && is_array($users_inactive)): ?>
    <?php foreach ($users_inactive as $user): ?>
        <!-- same exact row structure -->
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="9" class="text-center py-5">
            <i class="fas fa-user-slash fa-3x text-gray-300 mb-3"></i>
            <p class="text-gray-600 mb-0">No Inactive Users Found</p>
        </td>
    </tr>
<?php endif; ?>
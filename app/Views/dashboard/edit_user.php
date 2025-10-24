<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card border-bottom-primary shadow-sm">
            <div class="card-header text-primary">
                <h4 class="mb-0">
                    <i class="fas fa-pen"></i> Edit User Account 
                </h4>
            </div>
            <div class="card-body">
                <?php include('partials/forms/edit_user_account.php') ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-bottom-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user-shield"></i> User Profile
                </h5>
            </div>
            <div class="card-body text-center">
                <!-- Profile Image -->
                <img src="<?= base_url('uploads/users/pictures/' . $user['userPicture']) ?>"
                     class="rounded-circle mb-3 shadow"
                     style="width: 120px; height: 120px; object-fit: cover;"
                     alt="Profile Picture">

                <!-- User Info -->
                <h4 class="mb-0"><?= esc($user['userFullName']) ?></h4>
                <p class="text-muted small">
                    <i class="fas fa-envelope text-secondary"></i> <?= esc($user['userEmail']) ?>
                </p>

                <div class="row justify-content-center w-100 mt-3">
                    <div class="col-12 text-left">
                        <p><i class="fas fa-user-shield text-primary"></i> <strong>Account Type:</strong> <?= esc(ucfirst($user['userAccountType'])) ?></p>
                        <p><i class="fas fa-code-branch text-success"></i> <strong>Branch:</strong> <?= esc($user['branchName']) ?></p>
                        <p><i class="fas fa-toggle-<?= $user['userAccountActiveStatus'] ? 'on' : 'off' ?> text-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?>"></i>
                            <strong>Status:</strong> <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?>
                        </p>
                        <p><i class="fas fa-calendar-plus text-info"></i> <strong>Created:</strong> <?= esc($user['userDateCreated']) ?></p>
                        <p><i class="fas fa-history text-secondary"></i> <strong>Last Modified:</strong> <?= esc($user['userAccountLastModifiedDate'] ?? 'N/A') ?></p>
                    </div>
                </div>

                <!-- Document Buttons with Modal Triggers -->
                <div class="mt-4">
                   <!-- link to activate or deactivate user account -->
                    <a href="<?= base_url('dashboard/users/activate/' . $user['userId']) ?>" class="btn btn-<?= $user['userAccountActiveStatus'] ? 'danger' : 'success' ?> btn-block">
                        <i class="fas fa-<?= $user['userAccountActiveStatus'] ? 'times' : 'check' ?>"></i>
                        <?= $user['userAccountActiveStatus'] ? 'Deactivate Account' : 'Activate Account' ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

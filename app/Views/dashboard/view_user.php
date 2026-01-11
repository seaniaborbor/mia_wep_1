<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<?php
$accountTypeLabels = [
    'SIGNA' => 'Superintendent/Tribal Affairs',
    'SIGNB' => 'Assistant Minister/Legal Affairs',
    'SIGNC' => 'Deputy Minister/Legal Affairs',
    'ENTRY' => 'Entry',
];
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-shield mr-2"></i>User Profile
        </h1>
        <?php if(session()->get('userData')['userId'] == $user['userId'] || session()->get('userData')['userAccountType'] == "ADMIN"): ?>
            <a href="/matrimonial_dashboard/users/edit/<?= $user['userId'] ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-edit mr-1"></i> Edit Profile
            </a>
        <?php endif; ?>
    </div>

    <div class="row">

        <!-- Left Column: Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <!-- Profile Picture with Status -->
                    <div class="mt-3 mb-4 position-relative d-inline-block">
                        <img src="<?= base_url('uploads/users/pictures/' . ($user['userPicture'] ?? 'default-avatar.png')) ?>"
                             alt="<?= esc($user['userFullName']) ?>"
                             class="img-profile rounded-circle"
                             width="130" height="130"
                             onerror="this.src='<?= base_url('assets/img/undraw_profile.svg') ?>'">
                        <span class="position-absolute bottom-0 end-0 translate-middle-ping rounded-circle p-2 bg-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?> border border-light">
                            <span class="visually-hidden">Status</span>
                        </span>
                    </div>

                    <!-- User Info -->
                    <h4 class="mb-1"><?= esc($user['userFullName']) ?></h4>
                    <p class="text-muted mb-2">
                        <i class="fas fa-envelope mr-1"></i><?= esc($user['userEmail']) ?>
                    </p>
                    <?php if(!empty($user['userPhone'])): ?>
                        <p class="text-muted mb-3">
                            <i class="fas fa-phone mr-1"></i><?= esc($user['userPhone']) ?>
                        </p>
                    <?php endif; ?>

                    <hr class="my-4">

                    <!-- Basic Information -->
                    <div class="text-left">
                        <div class="row">
                            <div class="col-sm-5"><strong>Position:</strong></div>
                            <div class="col-sm-7"><?= esc($user['userPosition'] ?? '—') ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-5"><strong>Branch:</strong></div>
                            <div class="col-sm-7"><?= esc($branchName ?? $user['branchName'] ?? '—') ?></div>
                        </div>
                        <?php if(!empty($user['userDepartment'])): ?>
                        <div class="row mt-2">
                            <div class="col-sm-5"><strong>Department:</strong></div>
                            <div class="col-sm-7"><?= esc($user['userDepartment']) ?></div>
                        </div>
                        <?php endif; ?>
                        <div class="row mt-2">
                            <div class="col-sm-5"><strong>Account Type:</strong></div>
                            <div class="col-sm-7">
                                <span class="badge badge-primary">
                                    <?= $accountTypeLabels[$user['userAccountType']] ?? esc($user['userAccountType']) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Account Status -->
                    <h6 class="text-uppercase text-muted font-weight-bold small">Account Status</h6>
                    <div class="text-left mt-3">
                        <div class="row">
                            <div class="col-sm-5"><strong>Status:</strong></div>
                            <div class="col-sm-7">
                                <span class="badge badge-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?>">
                                    <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-5"><strong>Verified:</strong></div>
                            <div class="col-sm-7">
                                <span class="badge badge-<?= $user['userAccountVerified'] ? 'success' : 'warning' ?>">
                                    <?= $user['userAccountVerified'] ? 'Verified' : 'Pending' ?>
                                </span>
                            </div>
                        </div>
                        <?php if($user['userAccountLockedUntil'] && strtotime($user['userAccountLockedUntil']) > time()): ?>
                        <div class="row mt-2 text-danger">
                            <div class="col-12">
                                <i class="fas fa-lock mr-1"></i>
                                Locked Until <?= date('M j, Y g:i A', strtotime($user['userAccountLockedUntil'])) ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row mt-2">
                            <div class="col-sm-5"><strong>Failed Logins:</strong></div>
                            <div class="col-sm-7 <?= $user['userFailedLoginAttempts'] >= 4 ? 'text-danger font-weight-bold' : '' ?>">
                                <?= $user['userFailedLoginAttempts'] ?> / 5
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Quick Actions -->
                    <div class="d-grid gap-2 d-md-block">
                        <button type="button" class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#applicationModal">
                            <i class="fas fa-file-pdf mr-1"></i> View CV
                        </button>
                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#signatureModal">
                            <i class="fas fa-pen-nib mr-1"></i> Signature
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Certificates Tabs -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-file-alt mr-2"></i>
                        Associated Certificates
                    </h6>
                </div>
                <div class="card-body">

                   

                    
                     <?php if($user['userAccountType'] != 'ADMIN'): ?>
                         <!-- Nav Tabs -->
                    <ul class="nav nav-tabs mb-4" id="certTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="marriage-tab" data-toggle="tab" href="#marriage">
                                <i class="fas fa-ring mr-1"></i> Marriage Certificates
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="divorce-tab" data-toggle="tab" href="#divorce">
                                <i class="fas fa-heart-broken mr-1"></i> Divorce Certificates
                            </a>
                        </li>
                    </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="marriage">
                                <?php include("partials/tables/user_wedding_cert_log.php"); ?>
                            </div>
                            <div class="tab-pane fade" id="divorce">
                                <?php include("partials/tables/user_divorce_cert_log.php"); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-body text-center text-muted">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                                <p class="mb-0">The user is an System Admin, He/She is not associated with any certificate. </p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- CV Modal -->
<div class="modal fade" id="applicationModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-pdf mr-2"></i>Application CV
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light p-0">
                <iframe src="<?= base_url('uploads/users/applications/' . ($user['userApplicationFile'] ?? '')) ?>"
                        width="100%" height="700" style="border:none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Signature Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-pen-nib mr-2"></i>Official Signature
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center bg-light p-5">
                <?php if(!empty($user['userSignature'])): ?>
                    <img src="<?= base_url('uploads/users/signatures/' . $user['userSignature']) ?>"
                         class="img-fluid rounded shadow" style="max-height: 250px;">
                <?php else: ?>
                    <p class="text-muted">No signature uploaded</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
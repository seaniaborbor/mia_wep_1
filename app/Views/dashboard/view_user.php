<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<?php
$accountTypeLabels = [
    'SIGNA' => 'Superintendent/Tribal Affairs',
    'SIGNB' => 'Assistant Minister/Legal Affairs',
    'SIGNC' => 'Deputy Minister/Legal Affairs',
    'ENTRY' => 'Entry',
    'ADMIN' => 'System Administrator',
];
?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-shield mr-2"></i>User Profile
        </h1>
        <?php if(session()->get('userData')['userId'] == $user['userId'] || session()->get('userData')['userAccountType'] == "ADMIN"): ?>
            <a href="/matrimonial_dashboard/users/edit/<?= $user['userId'] ?>" 
               class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit Profile
            </a>
        <?php endif; ?>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white py-2 px-3 shadow-sm">
            <li class="breadcrumb-item"><a href="/matrimonial_dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/matrimonial_dashboard/users">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($user['userFullName']) ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Left Column: Profile Information -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-user mr-1"></i> Profile Information
                    </h6>
                </div>
                <div class="card-body text-center">
                    <!-- Profile Picture -->
                    <div class="mb-4 position-relative">
                        <img src="<?= base_url('uploads/users/pictures/' . ($user['userPicture'] ?? 'default-avatar.png')) ?>"
                             alt="<?= esc($user['userFullName']) ?>"
                             class="img-profile rounded-circle border border-4 border-white shadow"
                             width="120" height="120"
                             onerror="this.src='<?= base_url('assets/img/undraw_profile.svg') ?>'">
                        <span class="position-absolute bottom-0 end-0 translate-middle badge badge-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?> border border-white rounded-circle p-2">
                            <i class="fas fa-circle fa-xs"></i>
                        </span>
                    </div>

                    <!-- User Details -->
                    <h4 class="mb-1 font-weight-bold text-gray-800"><?= esc($user['userFullName']) ?></h4>
                    <p class="mb-2 text-muted">
                        <i class="fas fa-envelope fa-fw mr-1"></i><?= esc($user['userEmail']) ?>
                    </p>
                    
                    <?php if(!empty($user['userPhone'])): ?>
                        <p class="mb-3 text-muted">
                            <i class="fas fa-phone fa-fw mr-1"></i><?= esc($user['userPhone']) ?>
                        </p>
                    <?php endif; ?>

                    <!-- Account Type Badge -->
                    <div class="mb-4">
                        <span class="badge badge-<?= $user['userAccountType'] == 'ADMIN' ? 'danger' : 'primary' ?> px-3 py-2">
                            <?= $accountTypeLabels[$user['userAccountType']] ?? esc($user['userAccountType']) ?>
                        </span>
                    </div>

                    <!-- Quick Stats -->
                    <?php if($user['userDepartment'] == 'Matrimonial'): ?>
                        <div class="row text-center mb-4">
                        <div class="col-6">
                            <div class="h5 font-weight-bold text-gray-800 mb-0">
                                <?= count($marriage_certificates) ?? 0 ?>
                            </div>
                            <small class="text-muted">Marriage Certs</small>
                        </div>
                        <div class="col-6">
                            <div class="h5 font-weight-bold text-gray-800 mb-0">
                                <?= count($divorce_certificates) ?? 0 ?>
                            </div>
                            <small class="text-muted">Divorce Certs</small>
                        </div>
                    </div>
                    <?php elseif($user['userDepartment'] == 'Cultural'): ?>
                        <div class="row text-center mb-4">
                            <div class="col-12">
                                <div class="h5 font-weight-bold text-gray-800 mb-0">
                                    <?= $culturalCertCount ?? 0 ?>
                                </div>
                                <small class="text-muted">Cultural Certs</small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Quick Actions -->
                    <div class="d-grid gap-2">
                        <?php if(!empty($user['userApplicationFile'])): ?>
                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#applicationModal">
                            <i class="fas fa-file-pdf mr-2"></i> View CV/Application
                        </button>
                        <?php endif; ?>
                        
                        <?php if(!empty($user['userSignature'])): ?>
                        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#signatureModal">
                            <i class="fas fa-pen-nib mr-2"></i> View Signature
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Account Status Card -->
            <div class="card shadow">
                <div class="card-header py-3 bg-secondary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-shield-alt mr-1"></i> Account Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0 border-0">
                            <div>
                                <i class="fas fa-user-check fa-fw mr-2 text-gray-400"></i>
                                <span>Account Status</span>
                            </div>
                            <span class="badge badge-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?>">
                                <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <i class="fas fa-check-circle fa-fw mr-2 text-gray-400"></i>
                                <span>Verification</span>
                            </div>
                            <span class="badge badge-<?= $user['userAccountVerified'] ? 'success' : 'warning' ?>">
                                <?= $user['userAccountVerified'] ? 'Verified' : 'Pending' ?>
                            </span>
                        </div>
                        
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <i class="fas fa-lock fa-fw mr-2 text-gray-400"></i>
                                <span>Failed Logins</span>
                            </div>
                            <span class="font-weight-bold <?= $user['userFailedLoginAttempts'] >= 4 ? 'text-danger' : 'text-gray-600' ?>">
                                <?= $user['userFailedLoginAttempts'] ?>/5
                            </span>
                        </div>
                        
                        <?php if($user['userAccountLockedUntil'] && strtotime($user['userAccountLockedUntil']) > time()): ?>
                        <div class="list-group-item px-0 text-danger">
                            <div>
                                <i class="fas fa-exclamation-triangle fa-fw mr-2"></i>
                                <small>Locked until <?= date('M j, Y g:i A', strtotime($user['userAccountLockedUntil'])) ?></small>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Details & Certificates -->
        <div class="col-xl-8 col-lg-7">
            <!-- Details Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-gradient-info">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-id-card mr-1"></i> User Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted mb-1">Position</label>
                            <div class="font-weight-bold text-gray-800">
                                <?= esc($user['userPosition'] ?? '—') ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted mb-1">Branch</label>
                            <div class="font-weight-bold text-gray-800">
                                <?= esc($branchName ?? $user['branchName'] ?? '—') ?>
                            </div>
                        </div>
                        <?php if(!empty($user['userDepartment'])): ?>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted mb-1">Department</label>
                            <div class="font-weight-bold text-gray-800">
                                <?= esc($user['userDepartment']) ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted mb-1">User ID</label>
                            <div class="font-weight-bold text-gray-800">
                                <?= esc($user['userId']) ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted mb-1">Date Registered</label>
                            <div class="font-weight-bold text-gray-800">
                                <?= date('M j, Y', strtotime($user['userDateCreated'])) ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted mb-1">Last Login</label>
                            <div class="font-weight-bold text-gray-800">
                                <?= !empty($user['userLastLogin']) ? date('M j, Y g:i A', strtotime($user['userLastLogin'])) : 'Never' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certificates Card -->
            <div class="card shadow">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-file-alt mr-1"></i> Associated Certificates
                    </h6>
                </div>
                <div class="card-body">
                    <?php if($user['userDepartment'] == 'Matrimonial'): ?>
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs" id="certTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="marriage-tab" data-toggle="tab" href="#marriage" role="tab">
                                    <i class="fas fa-ring mr-2"></i> Marriage Certificates
                                    <span class="badge badge-primary ml-2"><?= $marriageCertCount ?? 0 ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="divorce-tab" data-toggle="tab" href="#divorce" role="tab">
                                    <i class="fas fa-heart-broken mr-2"></i> Divorce Certificates
                                    <span class="badge badge-danger ml-2"><?= $divorceCertCount ?? 0 ?></span>
                                </a>
                            </li>
                        </ul>
                        
                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="certTabContent">
                            <div class="tab-pane fade show active" id="marriage" role="tabpanel">
                                <?php include("partials/tables/user_wedding_cert_log.php"); ?>
                            </div>
                            <div class="tab-pane fade" id="divorce" role="tabpanel">
                                <?php include("partials/tables/user_divorce_cert_log.php"); ?>
                            </div>
                        </div>
                    <?php elseif($user['userDepartment'] == 'Cultural'): ?>
                        <div class="table-responsive">
                            <?php include("partials/tables/user_cultural_cert_log.php"); ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-user-crown fa-3x text-gray-300"></i>
                            </div>
                            <h5 class="text-gray-500">System Administrator</h5>
                            <p class="text-muted mb-0">This user is a system administrator and is not associated with any certificates.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- CV/Application Modal -->
<div class="modal fade" id="applicationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-pdf mr-2"></i>Application CV
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <?php if(!empty($user['userApplicationFile'])): ?>
                    <iframe src="/uploads/users/applications/<?= $user['userApplicationFile'] ?>"
                            width="100%" height="600" style="border:none;"></iframe>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-file-excel fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">No application file uploaded</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Signature Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title">
                    <i class="fas fa-pen-nib mr-2"></i>Official Signature
                </h5>
                <button type="button class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-5">
                <?php if(!empty($user['userSignature'])): ?>
                    <div class="mb-3">
                        <img src="<?= base_url('uploads/users/signatures/' . $user['userSignature']) ?>"
                             class="img-fluid rounded shadow" 
                             style="max-height: 200px; border: 1px solid #ddd;">
                    </div>
                    <p class="text-muted small">Official digital signature</p>
                <?php else: ?>
                    <div class="mb-3">
                        <i class="fas fa-signature fa-3x text-gray-300"></i>
                    </div>
                    <p class="text-muted">No signature uploaded</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
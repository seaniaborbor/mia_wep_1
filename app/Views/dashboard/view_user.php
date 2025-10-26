<?= $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<?php

$accountTypeLabels = [
    'SIGNA' => 'Superintendent/Tribal Affairs',
    'SIGNB' => 'Assistant Minister/Legal Affairs',
    'SIGNC' => 'Deputy Minister/Legal Affairs',
    'ENTRY' => 'Entry',
];
?>


<div class="row">
    <!-- Profile Section -->
    <div class="col-md-4">
        <div class="card shadow border-bottom-primary">
            <div class="card-body text-center">

                <!-- Profile Image -->
                <img src="<?= base_url('uploads/users/pictures/' . $user['userPicture']) ?>"
                     class="rounded-circle mb-3 shadow"
                     style="width: 120px; height: 120px; object-fit: cover;"
                     alt="Profile Picture">

                <!-- User Info -->
                <h4 class="mb-0"><?= esc($user['userFullName']) ?></h4>
                <p class="text-muted small"><i class="fas fa-envelope text-secondary"></i> <?= esc($user['userEmail']) ?></p>

                <div class="row justify-content-center w-100 mt-3">
                    <div class="col-12 text-left">
                        <p><i class="fas fa-user-shield text-primary"></i> <strong>POS:</strong> <?=$user['userPosition']?></p>
                        <p><i class="fas fa-code-branch text-success"></i> <strong>Branch:</strong> <?= isset($branchName) ? esc($branchName) : esc($user['branchName']) ?></p>
                        <p><i class="fas fa-toggle-<?= $user['userAccountActiveStatus'] ? 'on' : 'off' ?> text-<?= $user['userAccountActiveStatus'] ? 'success' : 'danger' ?>"></i>
                            <strong>Status:</strong> <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?></p>
                        <p><i class="fas fa-calendar-plus text-info"></i> <strong>Created:</strong> <?= esc($user['userDateCreated']) ?></p>
                        <p class="mb-0">
                            <div class="profile-popover-container mb-0 d-flex justify-content-start align-items-center">
                                <p><i class="fas fw-bold me-2 fa-pen text-primary"></i> <strong>Created By:</strong></p>
                               <p> <badge class=" rounded-pill mx-2 bg-success view-profile-btn" data-user-id="<?=$user['userCreatedBy']?>" data-toggle="popover">
                                    <i class="fa mx-3 text-white fa-eye"></i>
                                </badge>
                                </p>
                            </div>
                        </p>
                        <p><i class="fas fa-history text-secondary"></i> <strong>Last Modified:</strong> <?= esc($user['userAccountLastModifiedDate'] ?? 'N/A') ?></p>
                
                            <div class="profile-popover-container d-flex justify-content-start align-items-center">
                                <p><i class="fas fw-bold me-2 fa-pen text-primary"></i> <strong>Modified By:</strong></p>
                                <p>
                                <badge class=" mx-2 px-2 bg-info rounded-pill view-profile-btn" data-user-id="<?=$user['userAccountLastModifiedBy']?>" data-toggle="popover">
                               <i class="fa mx-3 text-white fa-eye"></i>
                                </badge>
                                </p>
                            </div>    
                    </div>
                </div>

                <!-- Document Buttons with Modal Triggers -->
                <div class="mt-4 btn-group btn-group-justified border-top">
                    <!-- Application File Button -->
                    <button type="button" class="btn btn-sm btn-info btn-icon-split " data-toggle="modal" data-target="#applicationModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-pdf"></i>
                        </span>
                        <span class="text">CV</span>
                    </button>

                    <!-- Signature File Button -->
                    <button type="button" class="btn btn-dark btn-sm btn-icon-split" data-toggle="modal" data-target="#signatureModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-pen-nib"></i>
                        </span>
                        <span class="text">Signature</span>
                    </button>
                     <?php if(session()->get('userData')['userId'] == $user['userId'] || session()->get('userData')['userAccountType'] == "SIGNC"): ?>
                     <a href="/dashboard/users/edit/<?=$user['userId']?>" class="btn btn-warning btn-icon-split btn-sm text-white ">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Edit</span>
                    </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Collapsible Tabs Section -->
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Collapsible -->
            <a href="#collapseCardTabs" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardTabs">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-file-alt"></i> Certificates Associated With This User
                </h6>
            </a>

            <!-- Collapsible Content -->
            <div class="collapse show" id="collapseCardTabs">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs mb-3" id="tabContentArea" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-one-tab" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one" aria-selected="true">
                                <i class="fas fa-heart text-danger"></i> Marriage Certificate
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-two-tab" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two" aria-selected="false">
                                <i class="fas fa-heart-broken text-danger"></i> Divorce Certificate
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one-tab">
                           <?php include("partials/tables/user_wedding_cert_log.php"); ?>
                        </div>
                        <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two-tab">
                                <?php include("partials/tables/user_divorce_cert_log.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Application Modal -->
<div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="applicationModalLabel"><i class="fas fa-file-pdf"></i> Application File</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="<?= base_url('uploads/users/applications/' . $user['userApplicationFile']) ?>" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Signature Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="signatureModalLabel"><i class="fas fa-pen-nib"></i> Signature</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="<?= base_url('uploads/users/signatures/' . $user['userSignature']) ?>" 
                     alt="User Signature" 
                     class="img-fluid rounded shadow"
                     style="max-height: 400px;">
            </div>
        </div>
    </div>

</div>
<?php include("partials/popovers/view_who_created_this_script.php"); ?>

<style>
    .user-profile-popover {
    max-width: 400px !important;
    width: 400px;
    padding: 15px;
}

.user-profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
    border: 3px solid #4e73df;
}

.user-profile-info {
    font-size: 14px;
}

.user-profile-info strong {
    display: inline-block;
    width: 120px;
}

.user-profile-info .divider {
    border-top: 1px solid #eee;
    margin: 10px 0;
}

.profile-popover-container {
    position: relative;
    display: inline-block;
}

.profile-popover {
    position: absolute;
    z-index: 9999;
    width: 400px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    padding: 15px;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    display: none;
}

.profile-popover.active {
    display: block;
}

.loading-spinner {
    display: inline-block;
    width: 1em;
    height: 1em;
    border: 2px solid rgba(0,0,0,0.1);
    border-radius: 50%;
    border-top-color: #4e73df;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
<?= $this->endSection() ?>

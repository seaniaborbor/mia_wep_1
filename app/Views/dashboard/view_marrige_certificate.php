<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-heart text-danger mr-2"></i>Marriage Certificate Details
        </h1>

        <div class="d-flex flex-wrap gap-2">
            <!-- Print Button -->
            <a href="/matrimonial_dashboard/wedcert/print/<?= esc($certificate['marriage_cert_id']) ?>"
               class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-print"></i></span>
                <span class="text">Print</span>
            </a>

            <?php
                $signA = !empty($certificate['SIGNA']);
                $signB = !empty($certificate['SIGNB'] ?? null);
                $signC = !empty($certificate['SIGNC']);
                $isCompleted = $signA && $signB && $signC;
                $userAccountType = session()->get('userData')['userAccountType'] ?? '';
                $userBranch = session()->get('userData')['userBreanch'] ?? '';
                $certBranch = $certificate['cert_branch'] ?? '';
                $sameBranch = ($userBranch == $certBranch);
                $allMissing = !$signA && !$signB && !$signC;
            ?>

            <!-- Sign Button -->
            <?php if ($sameBranch && $userAccountType !== 'ENTRY' && !$isCompleted): ?>
                <a href="/matrimonial_dashboard/wedcert/sign/<?= esc($certificate['marriage_cert_id']) ?>"
                   class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-signature"></i></span>
                    <span class="text">Sign</span>
                </a>
            <?php endif; ?>

            <!-- Edit Button (ENTRY only, no signatures) -->
            <?php if ($sameBranch && $userAccountType === 'ENTRY' && $allMissing): ?>
                <a href="/matrimonial_dashboard/wedcert/edit/<?= esc($certificate['marriage_cert_id']) ?>"
                   class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                    <span class="text">Edit</span>
                </a>
            <?php endif; ?>

            <!-- Allow Edit (SIGNC only, when complete) -->
            <?php if ($sameBranch && $userAccountType === 'SIGNC' && $isCompleted): ?>
                <a href="/matrimonial_dashboard/wedcert/allow_edit/<?= esc($certificate['marriage_cert_id']) ?>"
                   class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-unlock"></i></span>
                    <span class="text">Allow Edit</span>
                </a>
            <?php endif; ?>

            <!-- Back Button -->
            <a href="/matrimonial_dashboard/wedcert" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                <span class="text">Back</span>
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="row">

        <!-- Main Content -->
        <div class="col-lg-8">

            <!-- Certificate Summary -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="font-weight-bold text-primary">Traditional Marriage Certificate</h5>
                            <h4 class="mb-0"><?= esc($certificate['marriage_code']) ?></h4>
                        </div>
                        <div class="col-md-4 text-md-right">
                            <div class="h5 mb-0 text-gray-800"><?= esc($certificate['reference_no']) ?></div>
                            <small class="text-muted">Reference No</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Groom Card -->
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-primary shadow h-100">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-male mr-2"></i>Groom's Particulars
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <?php
                                    $groomPhoto = $certificate['groom_passport_photo'] ? base_url('uploads/marriage/' . $certificate['groom_passport_photo']) : null;
                                    $groomPhotoExists = $groomPhoto && file_exists(FCPATH . 'uploads/marriage/' . $certificate['groom_passport_photo']);
                                ?>
                                <?php if ($groomPhotoExists): ?>
                                    <img src="<?= $groomPhoto ?>" alt="Groom" class="img-profile rounded-circle" width="100" height="100">
                                <?php else: ?>
                                    <div class="img-profile rounded-circle bg-light d-flex align-items-center justify-content-center text-primary" style="width:100px;height:100px;">
                                        <i class="fas fa-male fa-3x"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <p><strong>Full Name:</strong> <?= esc($certificate['groom_name']) ?></p>
                            <p><strong>Date of Birth:</strong> <?= esc($certificate['groom_dob']) ?> (<?= esc($certificate['groom_age']) ?> yrs)</p>
                            <p><strong>Origin:</strong> <?= esc($certificate['groom_county_of_origin']) ?></p>
                            <p><strong>Birth Place:</strong> <?= esc($certificate['groom_birth_city']) ?>, <?= esc($certificate['groom_birth_county']) ?></p>
                            <p><strong>Nationality:</strong> <?= esc($certificate['groom_nationality']) ?></p>
                            <p><strong>Contact:</strong> <?= esc($certificate['groom_cell']) ?></p>
                            <p><strong>Address:</strong><br><?= esc($certificate['groom_address']) ?></p>
                            <p><strong>Parents:</strong><br>
                                Father: <?= esc($certificate['groom_father_name']) ?><br>
                                Mother: <?= esc($certificate['groom_mother_name']) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bride Card -->
                <div class="col-md-6 mb-4">
                    <div class="card border-bottom-danger shadow h-100">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">
                                <i class="fas fa-female mr-2"></i>Bride's Particulars
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <?php
                                    $bridePhoto = $certificate['bride_passport_photo'] ? base_url('uploads/marriage/' . $certificate['bride_passport_photo']) : null;
                                    $bridePhotoExists = $bridePhoto && file_exists(FCPATH . 'uploads/marriage/' . $certificate['bride_passport_photo']);
                                ?>
                                <?php if ($bridePhotoExists): ?>
                                    <img src="<?= $bridePhoto ?>" alt="Bride" class="img-profile rounded-circle" width="100" height="100">
                                <?php else: ?>
                                    <div class="img-profile rounded-circle bg-light d-flex align-items-center justify-content-center text-danger" style="width:100px;height:100px;">
                                        <i class="fas fa-female fa-3x"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <p><strong>Full Name:</strong> <?= esc($certificate['bride_name']) ?></p>
                            <p><strong>Date of Birth:</strong> <?= esc($certificate['bride_dob']) ?> (<?= esc($certificate['bride_age']) ?> yrs)</p>
                            <p><strong>Origin:</strong> <?= esc($certificate['bride_county_of_origin']) ?></p>
                            <p><strong>Birth Place:</strong> <?= esc($certificate['bride_birth_city']) ?>, <?= esc($certificate['bride_birth_county']) ?></p>
                            <p><strong>Nationality:</strong> <?= esc($certificate['bride_nationality']) ?></p>
                            <p><strong>Contact:</strong> <?= esc($certificate['bride_cell']) ?></p>
                            <p><strong>Address:</strong><br><?= esc($certificate['bride_address']) ?></p>
                            <p><strong>Parents:</strong><br>
                                Father: <?= esc($certificate['bride_father_name']) ?><br>
                                Mother: <?= esc($certificate['bride_mother_name']) ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Marriage Details -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-ring mr-2"></i>Marriage Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Place of Marriage</small>
                            <p class="mb-0 font-weight-bold"><?= esc($certificate['place_of_marriage']) ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Date of Marriage</small>
                            <p class="mb-0 font-weight-bold text-danger"><?= esc($certificate['date_of_marriage']) ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Bride's Proposed Name</small>
                            <p class="mb-0"><?= esc($certificate['bride_proposed_name']) ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Certificate Cost</small>
                            <p class="mb-0"><?= esc($certificate['certificate_cost']) ?> (<?= esc($certificate['certificate_cost_words']) ?>)</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Witness</small>
                            <p class="mb-0"><?= esc($certificate['witness_name']) ?> - <?= esc($certificate['witness_contact']) ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Officiator</small>
                            <p class="mb-0"><?= esc($certificate['officiator_name']) ?> - <?= esc($certificate['officiator_contact']) ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Declarant</small>
                            <p class="mb-0"><?= esc($certificate['declarant_name']) ?> - <?= esc($certificate['declaration_date']) ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <small class="text-muted">Revenue No</small>
                            <p class="mb-0"><?= esc($certificate['revenue_no']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attached Files -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-paperclip mr-2"></i>Attached Files
                    </h6>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadFileModal">
                        <i class="fas fa-upload mr-1"></i>Upload File
                    </button>
                </div>
                <div class="card-body">
                    <?php if (!empty($attachedFiles)): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>File Title</th>
                                        <th>Upload Date</th>
                                        <th>Uploaded By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attachedFiles as $file): ?>
                                        <?php
                                            $fileUrl = base_url('uploads/certificates/' . $file['certificateFile']);
                                            $fileExt = strtolower(pathinfo($file['certificateFile'], PATHINFO_EXTENSION));
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-primary file-preview-link"
                                                   data-toggle="modal" data-target="#filePreviewModal"
                                                   data-title="<?= esc($file['fileTitle']) ?>"
                                                   data-url="<?= $fileUrl ?>"
                                                   data-type="<?= $fileExt ?>">
                                                    <?= esc($file['fileTitle']) ?>
                                                </a>
                                            </td>
                                            <td><?= date('M j, Y', strtotime($file['fileCreatedAt'])) ?></td>
                                            <td><?= esc($file['userFullName']) ?></td>
                                            <td>
                                                <a href="/matrimonial_dashboard/certificate_files/delete/<?= $file['fileId'] ?>/<?= $certificate['marriage_cert_id'] ?>"
                                                   class="btn btn-sm btn-outline-danger"
                                                   onclick="return confirm('Delete this file?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center mb-0">No files attached yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Signatories -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-signature mr-2"></i>Signatories
                    </h6>
                    <?php if (!$isCompleted): ?>
                        <span class="badge badge-danger">Incomplete</span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <?php foreach (['A', 'B', 'C'] as $sig): ?>
                            <?php
                                $sigKey = "SIGN{$sig}";
                                $sigDateKey = "SIGN{$sig}_signedDate";
                                $sigName = $certificate[$sigKey] ?? '';
                                $sigDate = $certificate[$sigDateKey] ?? '';
                                $sigUrl = $sigName ? base_url("uploads/users/signatures/{$sigName}") : '';
                                $hasSig = $sigName && file_exists(FCPATH . "uploads/users/signatures/{$sigName}");
                            ?>
                            <div class="col-md-4 mb-4">
                                <div class="border rounded p-3 <?= $hasSig ? 'border-success' : 'border-light' ?>">
                                    <?php if ($hasSig): ?>
                                        <img src="<?= $sigUrl ?>" alt="Signature <?= $sig ?>" class="img-fluid mb-2" style="max-height:60px;">
                                        <p class="mb-0 text-success font-weight-bold">Signed</p>
                                        <?php if ($sigDate): ?>
                                            <small class="text-success"><?= date('M j, Y', strtotime($sigDate)) ?></small>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="mb-0 text-muted">Not Signed</p>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                    <hr class="my-2">
                                    <small class="text-muted">Signatory <?= $sig ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Issue Certificate Alert -->
            <?php if($isCompleted && $certificate['isWedCertIssued'] == 0): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i>
                    The certificate is fully signed. 
                    <a href="/matrimonial_dashboard/wedcert/issue/<?= esc($certificate['marriage_cert_id']) ?>">Click here to mark as Issued</a>.
                </div>
            <?php endif; ?>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">

            <!-- Status Card -->
            <?php if ($isCompleted): ?>
                <div class="card bg-success text-white shadow mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <h5>Certificate Complete</h5>
                        <p class="mb-0">All signatures applied. Document is finalized.</p>
                    </div>
                </div>
            <?php elseif ($allMissing): ?>
                <div class="card bg-info text-white shadow mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-pen fa-3x mb-3"></i>
                        <h5>Ready for Signing</h5>
                        <p class="mb-0">No signatures yet. You can start the signing process.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Metadata -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Certificate Metadata</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($createdBy)): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                <?php if (!empty($createdBy['userPicture']) && file_exists(FCPATH . 'uploads/users/pictures/' . $createdBy['userPicture'])): ?>
                                    <img src="<?= base_url('uploads/users/pictures/' . $createdBy['userPicture']) ?>" class="rounded-circle" width="50">
                                <?php else: ?>
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <strong><?= esc($createdBy['userFullName']) ?></strong><br>
                                <small class="text-muted">Created on <?= date('M j, Y, g:i A', strtotime($certificate['created_at'])) ?></small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($lastEditedByProfile)): ?>
                        <?php $editor = is_array($lastEditedByProfile[0] ?? null) ? $lastEditedByProfile[0] : $lastEditedByProfile; ?>
                        <hr>
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <?php if (!empty($editor['userPicture']) && file_exists(FCPATH . 'uploads/users/pictures/' . $editor['userPicture'])): ?>
                                    <img src="<?= base_url('uploads/users/pictures/' . $editor['userPicture']) ?>" class="rounded-circle" width="50">
                                <?php else: ?>
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                        <i class="fas fa-user text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <strong><?= esc($editor['userFullName']) ?></strong><br>
                                <small class="text-muted">Last edited on <?= date('M j, Y, g:i A', strtotime($last_edited_at)) ?></small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($signerProfiles) && is_array($signerProfiles)): ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Certificate Signatories</h6>
        </div>

        <div class="card-body">
            <div class="row">

                <?php foreach ($signerProfiles as $role => $signer): ?>
                    <?php if (!empty($signer)): ?>
                        <div class="col-md-12  mb-3">
                            <div class="border rounded p-3 h-100 d-flex align-items-center">

                                <!-- Profile Picture -->
                                <div class="mr-3">
                                    <?php if (!empty($signer['userPicture']) && file_exists(FCPATH . 'uploads/users/pictures/' . $signer['userPicture'])): ?>
                                        <img src="<?= base_url('uploads/users/pictures/' . $signer['userPicture']) ?>"
                                             class="rounded-circle"
                                             width="60"
                                             height="60">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                             style="width:60px;height:60px;">
                                            <i class="fas fa-user text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Info -->
                                <div>
                                    <strong><?= esc($signer['userFullName']) ?></strong><br>
                                    <small class="text-muted">
                                        <?= esc($signer['userPosition'] ?? 'Signer') ?>
                                    </small><br>

                                    <span class="badge badge-info mt-1">
                                        <?= esc(str_replace('_profile', '', $role)) ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php endif; ?>


        </div>
    </div>
</div>

<!-- File Preview Modal -->
<div class="modal fade" id="filePreviewModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewTitle">File Preview</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <div id="filePreviewContainer" style="height:70vh;"></div>
            </div>
            <div class="modal-footer">
                <a href="#" id="fileDownloadLink" class="btn btn-primary btn-sm" download>Download</a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Upload File Modal -->
<div class="modal fade" id="uploadFileModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/matrimonial_dashboard/certificate_files/upload_file/<?= esc($certificate['marriage_cert_id']) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Supporting File</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>File Title</label>
                        <input type="text" class="form-control" name="fileTitle" required>
                    </div>
                    <div class="form-group">
                        <label>Select File</label>
                        <input type="file" class="form-control" name="certificateFile" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="form-text text-muted">Max 5MB • PDF, Word, Images</small>
                    </div>
                    <input type="hidden" name="certificateFile_category" value="marriage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function() {
    // File preview
    $('.file-preview-link').on('click', function(e) {
        e.preventDefault();
        const title = $(this).data('title');
        const url = $(this).data('url');
        const type = $(this).data('type');

        $('#filePreviewTitle').text(title);
        $('#fileDownloadLink').attr('href', url);

        const container = $('#filePreviewContainer').empty();

        if (['jpg','jpeg','png','gif'].includes(type)) {
            container.html(`<img src="${url}" class="img-fluid">`);
        } else if (type === 'pdf') {
            container.html(`<iframe src="${url}" class="w-100 h-100" style="border:none;"></iframe>`);
        } else {
            container.html(`
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-file-alt fa-4x mb-3"></i>
                    <p>Preview not available</p>
                    <a href="${url}" class="btn btn-primary btn-sm" download>Download File</a>
                </div>
            `);
        }

        $('#filePreviewModal').modal('show');
    });
});
</script>

<?= $this->endSection() ?>
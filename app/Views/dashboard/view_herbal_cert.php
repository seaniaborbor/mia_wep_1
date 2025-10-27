<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-dark mb-0 font-weight-bold">
                        <i class="fas fa-certificate mr-2 liberia-red"></i>Certificate Details
                    </h4>
                    <span class="badge badge-pill px-3 py-2 liberia-status-badge">
                        <i class="fas fa-<?= $isCompleted ? 'check-circle' : 'clock' ?> mr-1"></i>
                        <?= $isCompleted ? 'Completed' : 'Pending' ?>
                    </span>
                </div>
            </div>

            <div class="card-body p-4">
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 liberia-alert" role="alert">
                        <i class="fas fa-check-circle mr-2"></i><?= session('success') ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <!-- Holder Summary -->
                        <div class="card border-0 bg-light mb-4 liberia-card-accent">
                            <div class="card-body py-3">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3 class="mb-1 liberia-red"><?= esc($certificate['tradCertHolderName']) ?></h3>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-hashtag liberia-blue mr-1"></i>
                                            <strong><?= esc($certificate['tradCertSn']) ?></strong>
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <div class="h5 mb-0 liberia-blue font-weight-bold">
                                            <?= esc($certificate['tradCertCevNo']) ?>
                                        </div>
                                        <small class="text-muted">CEV Number</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Holder Photo & Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-red">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-red">
                                            <i class="fas fa-user-circle liberia-blue mr-2"></i>Holder
                                        </h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <?php 
                                            $photoName = $certificate['tradCertHolderPic'] ?? '';
                                            $photoPath = FCPATH . 'uploads/certificate_holders/' . $photoName;
                                            $photoUrl  = base_url('uploads/certificate_holders/' . $photoName);
                                            $hasPhoto  = !empty($photoName) && file_exists($photoPath);
                                        ?>
                                        <div class="mb-3">
                                            <?php if ($hasPhoto): ?>
                                                <img src="<?= $photoUrl ?>" 
                                                     alt="Holder Photo" 
                                                     class="img-fluid rounded-circle liberia-photo-border" 
                                                     style="width: 120px; height: 120px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center liberia-photo-border"
                                                     style="width: 120px; height: 120px;">
                                                    <i class="fas fa-user fa-3x liberia-red"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h6 class="mb-1 liberia-red"><?= esc($certificate['tradCertHolderName']) ?></h6>
                                        <span class="badge liberia-badge-blue"><?= ucfirst($certificate['tradCertHolderOperationType']) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-blue">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-blue">
                                            <i class="fas fa-map-marker-alt liberia-red mr-2"></i>Location
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-1"><strong><?= esc($certificate['tradCertHolderTownorCity']) ?></strong></p>
                                        <p class="text-muted mb-0">
                                            <?= esc($certificate['tradCertHolderDistrict']) ? esc($certificate['tradCertHolderDistrict']) . ', ' : '' ?>
                                            <?= esc($certificate['tradCertHoldercounty']) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Details -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-red">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-red">
                                    <i class="fas fa-certificate liberia-blue mr-2"></i>Certificate Details
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <small class="text-muted">Date Issued</small>
                                        <p class="mb-1 font-weight-bold liberia-blue">
                                            <?= $certificate['tradCertDateIssued'] 
                                            ? date('F j, Y', strtotime($certificate['tradCertDateIssued'])) 
                                            : 'N/A'; ?>

                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Expires</small>
                                        <p class="mb-1 font-weight-bold liberia-red">
                                            <?= date('F j, Y', strtotime($certificate['tradCertDateIssued'] . ' + ' . $certificate['tradCertDuration'] . ' days')) ?>
                                        </p>
                                    </div>
                                    <?php if ($certificate['tradRevenueNo']): ?>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Revenue No</small>
                                        <p class="mb-1"><?= esc($certificate['tradRevenueNo']) ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Application</small>
                                        <p class="mb-1">
                                            <span class="badge liberia-badge-blue">
                                                <?= ucfirst($certificate['tradCertAppliedType']) ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Attached Files Section -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 liberia-blue">
                                    <i class="fas fa-paperclip liberia-red mr-2"></i>Attached Files
                                </h6>
                                <button type="button" class="btn btn-sm liberia-btn-blue" data-toggle="modal" data-target="#uploadFileModal">
                                    <i class="fas fa-upload mr-1"></i> Upload File
                                </button>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($attachedFiles)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>File Title</th>
                                                    <th>Upload Date</th>
                                                    <th>Uploaded By</th>
                                                    <th width="80">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($attachedFiles as $file): ?>
                                                    <tr>
                                                        <td>
                                                            <i class="fas fa-file <?= $file['file_type'] == 'pdf' ? 'text-danger' : 'text-primary' ?> mr-2"></i>
                                                            <a href="<?= base_url('uploads/herbal_cert_docs/' . $file['file_name']) ?>" target="_blank" class="text-decoration-none">
                                                                <?= esc($file['file_title']) ?>
                                                            </a>
                                                        </td>
                                                        <td><?= date('M j, Y', strtotime($file['upload_date'])) ?></td>
                                                        <td><?= esc($file['uploaded_by_name']) ?></td>
                                                        <td>
                                                            <a href="/dashboard/nativecert/delete_file/<?= $file['id'] ?>/<?= $certificate['tradCertId'] ?>" 
                                                               class="btn btn-sm btn-outline-danger" 
                                                               onclick="return confirm('Are you sure you want to delete this file? This action cannot be undone.');"
                                                               title="Delete File">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                        <p class="text-muted mb-0">No files attached to this certificate yet.</p>
                                        <small class="text-muted">Click the upload button to add files.</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Signatories -->
                        <div class="card border-0 shadow-sm liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 <?= $isCompleted ? 'liberia-blue' : 'liberia-red' ?>">
                                    <i class="fas fa-signature liberia-red mr-2"></i>Signatories
                                </h6>
                                <?php if (!$isCompleted): ?>
                                    <span class="badge liberia-badge-red">Incomplete</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <?php foreach (['A', 'B', 'C'] as $sig): ?>
                                        <?php 
                                            $sigKey = "tradCertSignatory{$sig}";
                                            $sigName = $certificate[$sigKey] ?? '';
                                            $sigPath = FCPATH . "uploads/users/signatures/{$sigName}";
                                            $sigUrl  = base_url("uploads/users/signatures/{$sigName}");
                                            $hasSig  = !empty($sigName) && file_exists($sigPath);
                                        ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="p-3 border rounded <?= $hasSig ? 'border-success liberia-signed' : 'border-light' ?>">
                                                <?php if ($hasSig): ?>
                                                    <img src="<?= $sigUrl ?>" alt="Signature <?= $sig ?>" class="img-fluid mb-2" style="max-height: 50px;">
                                                    <p class="mb-0 small liberia-blue"><i class="fas fa-check-circle"></i> Signed</p>
                                                <?php else: ?>
                                                    <i class="fas fa-signature fa-2x liberia-red mb-2"></i>
                                                    <p class="mb-0 small text-muted">Not Signed</p>
                                                <?php endif; ?>
                                                <small class="d-block text-muted">Signatory <?= $sig ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if (!$isIssued): ?>
                                    <div class="alert alert-light mt-3 liberia-alert-warning">
                                        <i class="fas fa-exclamation-triangle liberia-red mr-2"></i>
                                        This certificate requires all three signatures. 
                                        <a href="/dashboard/nativecert/issue-certificate/<?= $certificate['tradCertId'] ?>" class="alert-link liberia-blue">Mark as Issued</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Actions -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">
                                    <i class="fas fa-cogs liberia-red mr-2"></i>Actions
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="/dashboard/nativecert/edit/<?= $certificate['tradCertId'] ?>" class="btn btn-sm liberia-btn-red">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>

                                    <?php if (!$isCompleted): ?>
                                        <a href="/nativecert/add-signatories/<?= $certificate['tradCertId'] ?>" class="btn btn-sm liberia-btn-blue">
                                            <i class="fas fa-signature mr-1"></i> Add Signatures
                                        </a>
                                    <?php endif; ?>

                                    <a href="/dashboard/nativecert/print/<?= $certificate['tradCertId'] ?>" class="btn btn-sm liberia-btn-blue" >
                                        <i class="fas fa-print mr-1"></i> Print
                                    </a>

                                    <a href="/nativecert" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Back
                                    </a>
                                    <a href="/dashboard/nativecert/delete/<?= $certificate['tradCertId'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this certificate? This action cannot be undone.');">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Guidelines Card -->
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-warning text-white py-3">
                                <h5 class="mb-0"><i class="fas fa-lightbulb mr-2"></i>Editing Guidelines</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">
                                    Please review all information carefully before saving changes to a certificate record.
                                </p>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Ensure the holder's name is correct.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Verify town, district, and county accuracy.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Replace photo only if outdated.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Check operation type and revenue number.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Confirm issue date and duration are valid.</li>
                                </ul>

                                <hr>
                                <h6 class="text-secondary font-weight-bold">Important Note:</h6>
                                <p class="text-muted mb-0">
                                    Updating a certificate will <strong>replace the existing record</strong>. 
                                    Double-check details before saving. Once updated, data appears on the verification portal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload File Modal -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header liberia-card-blue">
                <h5 class="modal-title liberia-blue" id="uploadFileModalLabel">
                    <i class="fas fa-upload mr-2"></i>Upload File
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/dashboard/nativecert/upload_file/<?= $certificate['tradCertId'] ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileTitle" class="font-weight-bold">File Title</label>
                        <input type="text" class="form-control" id="fileTitle" name="file_title" required placeholder="Enter a descriptive title for this file">
                    </div>
                    <div class="form-group">
                        <label for="fileUpload" class="font-weight-bold">Select File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileUpload" name="file_upload" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <label class="custom-file-label" for="fileUpload">Choose file (PDF, Word, Images)</label>
                        </div>
                        <small class="form-text text-muted">Maximum file size: 5MB. Supported formats: PDF, DOC, DOCX, JPG, PNG</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn liberia-btn-blue">
                        <i class="fas fa-upload mr-1"></i> Upload File
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Update custom file input label with selected file name
document.getElementById('fileUpload').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>

<?= $this->endSection() ?>
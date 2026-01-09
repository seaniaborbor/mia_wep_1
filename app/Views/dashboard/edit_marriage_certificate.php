<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-warning mr-2"></i>Edit Marriage Certificate
        </h1>
    </div>

    <div class="row">

        <!-- Edit Form Column -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-warning">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-ring mr-2"></i>
                        Edit Marriage Certificate – #<?= esc($certificate['marriage_code'] ?? '') ?>
                    </h6>
                </div>
                <div class="card-body">
                    <?php include('partials/forms/edit_marriage_certificate.php') ?>
                </div>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-warning">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>
                        Editing Guidelines & Procedures
                    </h6>
                </div>
                <div class="card-body">

                    <div class="list-group list-group-flush">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-primary"><i class="fas fa-clipboard-check mr-2"></i>Check Existing Data</h6>
                            </div>
                            <p class="mb-0 small text-muted">Carefully review all current information before making changes.</p>
                        </a>

                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-success"><i class="fas fa-edit mr-2"></i>Edit Only What’s Necessary</h6>
                            </div>
                            <p class="mb-0 small text-muted">Avoid modifying verified or unchanged details.</p>
                        </a>

                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-info"><i class="fas fa-check-circle mr-2"></i>Re-validate Information</h6>
                            </div>
                            <p class="mb-0 small text-muted">Ensure names, dates, and photos still match original documents.</p>
                        </a>

                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-warning"><i class="fas fa-save mr-2"></i>Save Carefully</h6>
                            </div>
                            <p class="mb-0 small text-muted">Submit only after full review of all updates.</p>
                        </a>
                    </div>

                    <hr class="my-4">

                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-gavel mr-2"></i>Policies & Procedures
                    </h6>

                    <div class="list-group list-group-flush">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-danger"><i class="fas fa-user-shield mr-2"></i>Data Integrity First</h6>
                            </div>
                            <p class="mb-0 small text-muted">Preserve accuracy and protect original certificate values.</p>
                        </a>

                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-dark"><i class="fas fa-search mr-2"></i>Final Review Required</h6>
                            </div>
                            <p class="mb-0 small text-muted">Double-check all changes and uploaded files before saving.</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Error Modal (Pure SB Admin 2 + jQuery Modal) -->
<?php if (isset($data['errors']) && !empty($data['errors'])): ?>
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Form Submission Errors
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Please correct the following issues before saving:</p>
                <ul class="mb-0">
                    <?php foreach ($data['errors'] as $error): ?>
                        <li class="text-danger"><i class="fas fa-times-circle mr-2"></i><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#errorModal').modal('show');
});
</script>
<?php endif; ?>

<?= $this->endSection() ?>
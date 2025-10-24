<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>
<div class="row">
    <!-- Edit Form Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4 class="text-warning"><i class="fas fa-edit"></i> Edit Wedding Certificate</h4></div>
            <div class="card-body">
                <?php include('partials/forms/edit_marriage_certificate.php') ?>
            </div>
        </div>
    </div>

    <!-- Guidelines Column -->
    <div class="col-md-4">
        <div class="card shadow-sm border-bottom-warning mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Edit Clerk – Guidelines & Procedures</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="fas fa-clipboard-check text-primary mr-2"></i>
                        <strong>Check Existing Data:</strong> Carefully review the certificate's existing data before making changes.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-edit text-success mr-2"></i>
                        <strong>Edit Only What’s Necessary:</strong> Avoid altering unchanged or verified details.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-check-circle text-info mr-2"></i>
                        <strong>Re-validate:</strong> Ensure that photos, dates, and names still match with original documents.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-save text-warning mr-2"></i>
                        <strong>Save Carefully:</strong> Submit only when all updates are accurate and reviewed.
                    </li>
                    <li class="list-group-item bg-light text-primary font-weight-bold">
                        <i class="fas fa-gavel mr-2"></i> Policies & Procedures
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-user-shield text-danger mr-2"></i>
                        <strong>Data Integrity:</strong> Maintain accuracy and protect original certificate values.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-search text-dark mr-2"></i>
                        <strong>Final Review:</strong> Confirm all changes and uploaded files before saving.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php if (isset($data['errors']) && !empty($data['errors'])): ?>
<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel"><i class="fas fa-exclamation-triangle"></i> Form Errors</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="mb-0 pl-3">
                    <?php foreach ($data['errors'] as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var errorModal = document.getElementById('errorModal');
        if (errorModal) {
            var modal = new bootstrap.Modal(errorModal);
            modal.show();
        }
    });
</script>
<?php endif; ?>

<?= $this->endSection() ?>

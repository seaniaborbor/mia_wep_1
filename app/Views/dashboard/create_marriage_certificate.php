<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4 class="text-primary">Create a Wedding Certificate</h4></div>
            <div class="card-body">
                <?php include('partials/forms/create_marriage_certificate.php')?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-bottom-danger mb-4">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Data Entry Clerk – Guidelines & Procedures</h5>
    </div>
    <div class="card-body p-0">
       <ul class="list-group list-group-flush">
    <!-- Step-by-step process -->
    <li class="list-group-item">
        <i class="fas fa-file-alt text-primary mr-2"></i>
        <strong>Verify Source Documents:</strong> Ensure all physical forms are signed and complete before beginning data entry.
    </li>
    <li class="list-group-item">
        <i class="fas fa-folder-open text-success mr-2"></i>
        <strong>Organize Files:</strong> Arrange all scanned passport photos and certificates in clearly named folders (e.g. <code>Groom_Photo1.jpg</code>, <code>Bride_Photo2.jpg</code>).
    </li>
    <li class="list-group-item">
        <i class="fas fa-list-ol text-info mr-2"></i>
        <strong>Start Entry by Section:</strong> Follow the form step-by-step: Groom Info → Bride Info → Photos → Marriage Details → Certification.
    </li>
    <li class="list-group-item">
        <i class="fas fa-check-double text-warning mr-2"></i>
        <strong>Match Documents:</strong> Carefully match passport photos to the correct individuals before uploading.
    </li>
    <li class="list-group-item">
        <i class="fas fa-font text-secondary mr-2"></i>
        <strong>Use Official Format:</strong> Capitalize names properly and use YYYY-MM-DD date format.

    </li>

    <!-- Policy & procedures -->
    <li class="list-group-item bg-light text-primary font-weight-bold">
        <i class="fas fa-gavel mr-2"></i> Policies & Procedures
    </li>
    <li class="list-group-item">
        <i class="fas fa-user-secret text-danger mr-2"></i>
        <strong>Confidentiality:</strong> Do not share or expose certificate data, photos, or identifying info to unauthorized persons.
    </li>
    <li class="list-group-item">
        <i class="fas fa-search text-dark mr-2"></i>
        <strong>Final Review:</strong> Double-check spelling, numbers, and uploaded files before final submission.
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
    document.addEventListener('DOMContentLoaded', function() {
        var errorModal = document.getElementById('errorModal');
        if (errorModal) {
            var modal = new bootstrap.Modal(errorModal);
            modal.show();
        }
    });
</script>
<?php endif; ?>

<?=$this->endSection()?>
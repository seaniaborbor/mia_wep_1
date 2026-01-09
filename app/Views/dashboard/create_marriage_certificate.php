<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Create Marriage Certificate</h1>
            <p class="mb-0 text-gray-600">Register a new traditional marriage certificate</p>
        </div>
    </div>

    <div class="row">

        <!-- Main Form -->
        <div class="col-lg-8 mb-4">
            <div class="card-body ">
                <?php include('partials/forms/create_marriage_certificate.php') ?>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>
                        Data Entry Guidelines
                    </h6>
                </div>
                <div class="card-body">

                    <!-- Guideline Items -->
                    <div class="mb-4">

                        <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                            <div class="mr-3 text-primary">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Verify Source Documents</strong>
                                <p class="mb-0 small text-muted">Ensure all physical forms are signed and complete before entry.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                            <div class="mr-3 text-success">
                                <i class="fas fa-folder-open fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Organize Files</strong>
                                <p class="mb-0 small text-muted">Name photos: <code>Groom_Name.jpg</code>, <code>Bride_Name.jpg</code></p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                            <div class="mr-3 text-info">
                                <i class="fas fa-list-ol fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Enter Data Step-by-Step</strong>
                                <p class="mb-0 small text-muted">Groom → Bride → Photos → Details → Witnesses → Certification</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                            <div class="mr-3 text-warning">
                                <i class="fas fa-portrait fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Match Passport Photos Correctly</strong>
                                <p class="mb-0 small text-muted">Double-check names before uploading groom/bride photos.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                            <div class="mr-3 text-secondary">
                                <i class="fas fa-calendar-alt fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Use Correct Format</strong>
                                <p class="mb-0 small text-muted">Names: Title Case | Dates: YYYY-MM-DD | Currency: USD only</p>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <!-- Policies Section -->
                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-gavel mr-2"></i>Policies & Procedures
                    </h6>

                    <div class="d-flex align-items-start mb-3 p-3 bg-light rounded">
                        <div class="mr-3 text-danger">
                            <i class="fas fa-user-secret fa-lg"></i>
                        </div>
                        <div>
                            <strong class="text-gray-800">Confidentiality is Mandatory</strong>
                            <p class="mb-0 small text-muted">Never share personal data, photos, or certificates with unauthorized persons.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start p-3 bg-light rounded">
                        <div class="mr-3 text-dark">
                            <i class="fas fa-search-plus fa-lg"></i>
                        </div>
                        <div>
                            <strong class="text-gray-800">Final Review Before Submit</strong>
                            <p class="mb-0 small text-muted">Check spelling, dates, photos, and cost fields twice.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Error Modal (if validation fails) -->
<?php if (isset($data['errors']) && !empty($data['errors'])): ?>
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Form Submission Errors
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please correct the following issues:</p>
                <ul class="mb-0">
                    <?php foreach ($data['errors'] as $error): ?>
                        <li class="text-danger"><i class="fas fa-times-circle mr-1"></i> <?= esc($error) ?></li>
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
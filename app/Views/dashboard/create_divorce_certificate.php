<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Log a Divorce Certificate</h1>
            <p class="mb-0 text-gray-600">Record divorce certificate information securely</p>
        </div>
    </div>

    <!-- Display Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Main Form Card -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow ">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #002868 0%, #001F5B 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-file-contract mr-2"></i>
                        Divorce Certificate Form
                    </h6>
                </div>
                <div class="card-body">
                    <?php include 'partials/forms/create_divorce_certificate.php'; ?>
                </div>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #BF0A30 0%, #9B0B28 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>
                        Logging Guidelines
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-gray-700 mb-4">
                        Before logging a divorce certificate, please observe the following guidelines to ensure accuracy and compliance.
                    </p>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3 p-3 border-left-success border-left-4">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Name Verification</strong>
                                <p class="text-muted mb-0 small">Ensure all names are correctly spelled as per official documents.</p>
                            </div>
                        </div>


                        <div class="d-flex align-items-start mb-3 p-3 border-left-warning border-left-4">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-search text-warning"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Date Verification</strong>
                                <p class="text-muted mb-0 small">Double-check marriage and divorce dates to avoid errors.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 border-left-info border-left-4">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-clock text-info"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Issuance Date</strong>
                                <p class="text-muted mb-0 small">The issuance date is the day this certificate becomes official.</p>
                            </div>
                        </div>

                    </div>

                    <div class="bg-light p-3 rounded border-start border-warning border-4">
                        <div class="text-center">
                            <i class="fas fa-exclamation-triangle text-warning mb-2"></i>
                            <p class="mb-0 small font-weight-bold text-gray-700">
                                Verify all information before submission as changes may require administrative approval.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Patriotic Theme Enhancements -->
<style>
/* Enhanced patriotic colors while maintaining SB Admin 2 structure */
.card-header h6 { letter-spacing: 0.5px; }

/* Enhanced borders for patriotic theme */
.border-left-primary { border-left-color: #002868 !important; }
.border-left-danger { border-left-color: #BF0A30 !important; }
.border-left-warning { border-left-color: #f59e0b !important; }
.border-left-info { border-left-color: #3b82f6 !important; }
.border-left-success { border-left-color: #10b981 !important; }
.border-left-4 { border-left-width: 4px !important; }

/* Hover effects */
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-2px);
}

/* Policy items hover effect */
.d-flex.align-items-start {
    transition: all 0.3s ease;
    border-radius: 0.35rem;
}
.d-flex.align-items-start:hover {
    background-color: #f8f9fa;
    transform: translateX(4px);
}

/* Form enhancements */
.form-control:focus {
    border-color: #002868;
    box-shadow: 0 0 0 0.2rem rgba(0, 40, 104, 0.25);
}

/* File upload card enhancements */
.card.border-left-primary .card-body,
.card.border-left-danger .card-body {
    transition: all 0.3s ease;
}
.card.border-left-primary:hover .card-body,
.card.border-left-danger:hover .card-body {
    background-color: #f8f9fa;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File feedback
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const cardBody = this.closest('.card-body');
            const label = cardBody.querySelector('label');
            if (this.files[0]) {
                const fileName = document.createElement('small');
                fileName.className = 'text-success font-weight-bold d-block mt-1';
                fileName.textContent = 'Selected: ' + this.files[0].name;
                
                // Remove existing file name if present
                const existingFileName = cardBody.querySelector('.text-success');
                if (existingFileName) {
                    existingFileName.remove();
                }
                
                cardBody.appendChild(fileName);
            }
        });
    });

    // Submit loading
    document.getElementById('divorceForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.querySelector('.btn-text').style.display = 'none';
        btn.querySelector('.btn-loading').style.display = 'inline';
    });
});
</script>

<?= $this->endSection() ?>
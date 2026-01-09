<?= $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Create New Branch Account</h1>
            <p class="mb-0 text-gray-600">Establish an official administrative branch</p>
        </div>
    </div>

    <div class="row">
        <!-- Main Form Card -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #002868 0%, #001F5B 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Branch Registration Form
                    </h6>
                </div>
                <div class="card-body">
                    <?php include('partials/forms/create_branch_account.php') ?>
                </div>
            </div>
        </div>

        <!-- Policy & Guidelines Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #BF0A30 0%, #9B0B28 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-scroll mr-2"></i>
                        National Policy & Guidelines
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-gray-700 mb-4">
                        Before creating a new branch account, please observe the following official regulations to ensure data integrity and national compliance.
                    </p>

                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3 p-3 border-left-success border-left-4">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-globe-africa text-success fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Multiple Branches per County</strong>
                                <p class="text-muted mb-0 small">A single county may establish multiple branch offices as required.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 border-left-danger border-left-4">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-ban text-danger fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">No Duplicate Accounts</strong>
                                <p class="text-muted mb-0 small">Each branch must have a unique identity. Duplicates are strictly prohibited.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start p-3 border-left-warning border-left-4">
                            <div class="mr-3 mt-1">
                                <i class="fas fa-file-signature text-warning fa-lg"></i>
                            </div>
                            <div>
                                <strong class="text-gray-800">Irreversible Records</strong>
                                <p class="text-muted mb-0 small">Branches linked to certificates cannot be deleted — only deactivated.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded border-start border-primary border-4">
                        <div class="text-center">
                            <i class="fas fa-shield-alt text-primary mb-2"></i>
                            <p class="mb-0 small font-weight-bold text-primary">
                                All actions are logged and monitored by the National Registry Office
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

/* Hover effects for cards */
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

/* Enhanced borders for patriotic theme */
.border-left-success { border-left-color: #10b981 !important; }
.border-left-danger { border-left-color: #BF0A30 !important; }
.border-left-warning { border-left-color: #f59e0b !important; }
.border-left-4 { border-left-width: 4px !important; }
</style>

<?= $this->endSection() ?>
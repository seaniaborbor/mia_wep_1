<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>
<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between border-bottom-primary py-3">
                <div>
                    <h1 class="h3 mb-0 text-primary font-weight-bold">
                        <i class="fas fa-heart text-danger mr-2"></i>
                        Marriage Certificate Log
                        <p style="font-size:13px; margin-left: 50px;" class="text-danger mb-0">
                            <?php if(isset($breanchDetail) && !empty($breanchDetail)): ?>
                                <?= htmlspecialchars($breanchDetail['branchName']) ?>
                            <?php else: ?> 
                                <?= htmlspecialchars(session()->get('userData')['branchName']) ?>
                            <?php endif; ?>
                        </p>
                    </h1>
                </div>
                <div class="d-flex align-items-center">
                    <!-- Create New Button -->
                    <a href="/dashboard/wedcert/create" class="btn btn-sm btn-success btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Create New</span>
                    </a>
                    <!-- Branch Dropdown (Split Button) -->
                    <div class="btn-group mr-2">
                        <a href="#" class="btn btn-sm btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-code-branch"></i>
                            </span>
                            <span class="text">
                                <?php
                                    $currentBranch = 'Select Branch';
                                    if (isset($branchDetail['branchId']) && !empty($allBranches)) {
                                        foreach ($allBranches as $b) {
                                            if ($b['branchId'] == $branchDetail['branchId']) {
                                                $currentBranch = htmlspecialchars($b['branchName']);
                                                break;
                                            }
                                        }
                                    }
                                    echo $currentBranch;
                                ?>
                            </span>
                        </a>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php foreach ($allBranches as $branch): ?>
                                <a class="dropdown-item <?php echo ($branch['branchId'] == ($branchDetail['branchId'] ?? '')) ? 'active' : ''; ?>" 
                                   href="/dashboard/wedcert?branch=<?= htmlspecialchars($branch['branchId']) ?>">
                                    <i class="fas fa-building mr-2"></i>
                                    <?= htmlspecialchars($branch['branchName']) ?>
                                </a>
                            <?php endforeach; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/dashboard/general">
                                <i class="fas fa-flag mr-2"></i>
                                Nation's Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Certificate Stats Summary -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-left-primary shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary text-white">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Certificates
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= count($branch_complete_certificate) + count($branch_uncomplete_certificate) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card border-left-success shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success text-white">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Completed Certificates
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= count($branch_complete_certificate) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-left-danger shadow-sm h-100">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger text-white">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Uncompleted Certificates
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= count($branch_uncomplete_certificate) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabs Navigation -->
                <ul class="nav nav-pills mb-4" id="certificateTabs" role="tablist">
                    <li class="nav-item mr-2">
                        <a class="nav-link active py-2 px-3" id="uncompleted-tab" data-toggle="tab" href="#uncompleted" role="tab" aria-controls="uncompleted" aria-selected="true">
                            <i class="fas fa-hourglass-half mr-2"></i> Uncompleted Certificates
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">
                            <i class="fas fa-check mr-2"></i> Completed Certificates
                        </a>
                    </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content" id="certificateTabsContent">
                    <div class="tab-pane fade show active" id="uncompleted" role="tabpanel" aria-labelledby="uncompleted-tab">
                        <?php include('partials/tables/uncompleted_wed_certificate_table.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <?php include('partials/tables/completed_wed_certificate_table.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dependencies (only include if not in layout) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Diagnostic JavaScript for Dropdown -->
<script>
    $(document).ready(function() {
        // Verify jQuery and Bootstrap are loaded
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded.');
        } else {
            console.log('jQuery loaded:', jQuery.fn.jquery);
        }
        if (typeof Popper === 'undefined') {
            console.error('Popper.js is not loaded.');
        }
        if (typeof $.fn.dropdown === 'undefined') {
            console.error('Bootstrap dropdown plugin is not loaded.');
        } else {
            console.log('Bootstrap dropdown plugin is available.');
        }

        // Initialize dropdown manually if needed
        $('.dropdown-toggle').dropdown();

        // Log dropdown click for debugging
        $('.dropdown-toggle').on('click', function() {
            console.log('Dropdown toggle clicked.');
        });
    });
</script>

<style>
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

/* Ensure proper split button styling */
.btn-group .btn-icon-split {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.btn-group .dropdown-toggle-split {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}
</style>

<?= $this->endSection() ?>
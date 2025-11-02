<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between bg-white border-bottom-primary py-3">
                <div>
                    <h1 class="h3 mb-0 text-primary font-weight-bold">
                        <i class="fas fa-heart-broken text-danger mr-2"></i>
                        Divorce Certificate Log
                        <p style="font-size:13px; margin-left: 50px;" class="text-danger">
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
                    <a href="/dashboard/divorce_cert/create" class="btn btn-sm btn-success btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        <span class="text">Create New</span>
                    </a>
                    <!-- Branch Dropdown (Split Button) -->
                    <div class="btn-group w-auto">
                        <button type="button" class="btn btn-sm btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-globe"></i>
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
                        </button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Switch Branch</span>
                        </button>
                        <ul class="dropdown-menu">
                            <?php foreach ($allBranches as $branch): ?>
                                <li>
                                    <a class="dropdown-item <?php echo ($branch['branchId'] == ($branchDetail['branchId'] ?? '')) ? 'active' : ''; ?>" 
                                       href="/dashboard/divorce_cert?branch=<?= htmlspecialchars($branch['branchId']) ?>">
                                        <?= htmlspecialchars($branch['branchName']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="/dashboard/general">
                                    Nation's Dashboard
                                </a>
                            </li>
                        </ul>
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
                                           <?= (int)$total_uncomplete_certificate+ (int)$total_complete_certificate ?>
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
                                            <?= $total_complete_certificate ?>
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
                                            <?= $total_uncomplete_certificate ?>
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
                        <!-- Uncompleted Certificates Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered datatable2 table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Plaintiff</th>
                                        <th>Defendant</th>
                                        <th>Marriage Date</th>
                                        <th>Divorce Date</th>
                                        <th>Issuance Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($branch_uncomplete_certificate as $cert): ?>
                                    <tr>
                                        <td><?= $cert['divorceCertId'] ?></td>
                                        <td><?= $cert['divorceplaintiff'] ?></td>
                                        <td><?= $cert['divorcedefendant'] ?></td>
                                        <td><?= date('M d, Y', strtotime($cert['divorcemarriageDate'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($cert['divorcedateOfDivorce'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($cert['divorceissuanceDate'])) ?></td>
                                        <td>
                                            <a href="/dashboard/divorce_cert/view/<?= $cert['divorceCertId'] ?>" class="btn btn-info btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <span class="text">View</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <!-- Completed Certificates Table -->
                        <div class="table-responsive">
                            <table class="table datatable table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Plaintiff</th>
                                        <th>Defendant</th>
                                        <th>Marriage Date</th>
                                        <th>Divorce Date</th>
                                        <th>Issuance Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($branch_complete_certificate as $cert): ?>
                                    <tr>
                                        <td><?= $cert['divorceCertId'] ?></td>
                                        <td><?= $cert['divorceplaintiff'] ?></td>
                                        <td><?= $cert['divorcedefendant'] ?></td>
                                        <td><?= date('M d, Y', strtotime($cert['divorcemarriageDate'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($cert['divorcedateOfDivorce'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($cert['divorceissuanceDate'])) ?></td>
                                        <td>
                                            <a href="/dashboard/divorce_cert/view/<?= $cert['divorceCertId'] ?>" class="btn btn-success btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                                <span class="text">View</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<style>
.icon-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.btn-icon-split .icon {
    padding: 0.375rem 0.75rem;
    display: inline-block;
}
</style>
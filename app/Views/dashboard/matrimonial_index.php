<?php $this->extend('dashboard/partials/layout') ?>
<?=$this->section('main') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Matrimonial Management Dashboard</h1>
            <p class="mb-0 text-gray-600">
                <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                Branch: <span class="font-weight-bold"><?= esc($branchDetail['branchName'] ?? session()->get('userData')['branchName']) ?></span>
            </p>
        </div>
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="branchDropdown" data-toggle="dropdown">
                <i class="fas fa-exchange-alt fa-sm fa-fw mr-1"></i>
                Switch Branch
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                <?php foreach ($allBranches as $branch): ?>
                    <a class="dropdown-item <?= ($branch['branchId'] == ($branchDetail['branchId'] ?? '')) ? 'active' : '' ?>" 
                       href="/matrimonial_dashboard?branch=<?= esc($branch['branchId']) ?>">
                        <i class="fas fa-building fa-sm fa-fw mr-2 text-primary"></i>
                        <?= esc($branch['branchName']) ?>
                    </a>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-primary" href="/general_dashboard">
                    <i class="fas fa-chart-bar fa-sm fa-fw mr-2"></i>
                    System Overview Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Animated Statistics Grid -->
    <div class="row mb-4">
        <!-- Total Certificates -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="stat-card animated-card" data-animation="pulse">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number"><?= $statistics['total_certificates'] ?></h3>
                    <p class="stat-label">Total Certificates</p>
                    <div class="stat-detail">
                        <span class="badge bg-primary"><?= $statistics['marriages']['total'] ?> Marriages</span>
                        <span class="badge bg-danger"><?= $statistics['divorces']['total'] ?> Divorces</span>
                    </div>
                </div>
                <div class="stat-glow"></div>
            </div>
        </div>
        
        <!-- Completed Certificates -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="stat-card animated-card" data-animation="glow" data-color="success">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number"><?= $statistics['completed_certificates'] ?></h3>
                    <p class="stat-label">Completed</p>
                    <div class="stat-detail">
                        <div class="progress stat-progress">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: <?= $statistics['overall_completion_rate'] ?>%">
                                <?= $statistics['overall_completion_rate'] ?>%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stat-glow"></div>
            </div>
        </div>
        
        <!-- Pending Certificates -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="stat-card animated-card" data-animation="pulse" data-color="warning">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number"><?= $statistics['pending_certificates'] ?></h3>
                    <p class="stat-label">Pending</p>
                    <div class="stat-detail">
                        <small class="text-warning">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <?= $signatureBreakdown['total_pending_documents'] ?> awaiting signatures
                        </small>
                    </div>
                </div>
                <div class="stat-glow"></div>
            </div>
        </div>
        
        <!-- Issued Certificates -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="stat-card animated-card" data-animation="glow" data-color="info">
                <div class="stat-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number"><?= $statistics['issued_certificates'] ?></h3>
                    <p class="stat-label">Issued</p>
                    <div class="stat-detail">
                        <div class="progress stat-progress">
                            <div class="progress-bar bg-info" role="progressbar" 
                                 style="width: <?= $statistics['overall_issue_rate'] ?>%">
                                <?= $statistics['overall_issue_rate'] ?>%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stat-glow"></div>
            </div>
        </div>
        
        <!-- Completion Rate -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="stat-card animated-card" data-animation="breath">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number"><?= $statistics['overall_completion_rate'] ?>%</h3>
                    <p class="stat-label">Completion Rate</p>
                    <div class="stat-detail">
                        <small class="text-muted">
                            <?= $statistics['completed_certificates'] ?> of <?= $statistics['total_certificates'] ?>
                        </small>
                    </div>
                </div>
                <div class="stat-glow"></div>
            </div>
        </div>
        
        <!-- Branch Users -->
        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
            <div class="stat-card animated-card" data-animation="pulse">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number"><?= $statistics['users'] ?></h3>
                    <p class="stat-label">Branch Users</p>
                    <div class="stat-detail">
                        <small class="text-muted">Active personnel</small>
                    </div>
                </div>
                <div class="stat-glow"></div>
            </div>
        </div>
    </div>

    <!-- Certificate Status Cards -->
    <div class="row mb-4">
        <!-- Marriage Certificate Status -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card shadow border-left-primary h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="border-left: 4px solid #002868 !important;">
                    <h6 class="m-0 font-weight-bold" style="color: #002868;">
                        <i class="fas fa-ring mr-2"></i>Marriage Certificates
                    </h6>
                    <div>
                        <span class="badge" style="background-color: #002868; color: white;"><?= $statistics['marriages']['total'] ?> total</span>
                        <span class="badge badge-warning"><?= $statistics['marriages']['pending'] ?> pending</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="text-center">
                                <div class="h4 font-weight-bold text-gray-800"><?= $statistics['marriages']['completed'] ?></div>
                                <div class="text-xs font-weight-bold text-success text-uppercase">Completed</div>
                                <small class="text-muted">All signatures</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <div class="h4 font-weight-bold text-gray-800"><?= $statistics['marriages']['issued'] ?></div>
                                <div class="text-xs font-weight-bold text-info text-uppercase">Issued</div>
                                <small class="text-muted">Delivered</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <div class="h4 font-weight-bold text-gray-800"><?= $statistics['marriages']['pending'] ?></div>
                                <div class="text-xs font-weight-bold text-danger text-uppercase">Pending</div>
                                <small class="text-muted">Missing signatures</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="progress mb-3" style="height: 20px; border-radius: 10px;">
                        <div class="progress-bar bg-primary" role="progressbar" 
                             style="width: <?= $statistics['marriages']['completion_rate'] ?>%"
                             title="Completed: <?= $statistics['marriages']['completed'] ?>">
                            <span class="progress-text">Completed <?= $statistics['marriages']['completion_rate'] ?>%</span>
                        </div>
                        <div class="progress-bar bg-light" role="progressbar" 
                             style="width: <?= $statistics['marriages']['issue_rate'] ?>%"
                             title="Issued: <?= $statistics['marriages']['issued'] ?>">
                            <span class="progress-text">Issued <?= $statistics['marriages']['issue_rate'] ?>%</span>
                        </div>
                        <div class="progress-bar bg-danger" role="progressbar" 
                             style="width: <?= $statistics['marriages']['pending_rate'] ?>%"
                             title="Pending: <?= $statistics['marriages']['pending'] ?>">
                            <span class="progress-text">Pending <?= $statistics['marriages']['pending_rate'] ?>%</span>
                        </div>
                    </div>
                    
                    <!-- Status Legend -->
                    <div class="d-flex justify-content-around small text-gray-600">
                        <div>
                            <span class="text-success">●</span> Completed (All 3 signatures)
                        </div>
                        <div>
                            <span class="text-info">●</span> Issued (Delivered)
                        </div>
                        <div>
                            <span class="text-danger">●</span> Pending (Missing signatures)
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Divorce Certificate Status -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card shadow border-left-danger h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="border-left: 4px solid #e74a3b !important;">
                    <h6 class="m-0 font-weight-bold" style="color: #e74a3b;">
                        <i class="fas fa-heart-broken mr-2"></i>Divorce Certificates
                    </h6>
                    <div>
                        <span class="badge badge-danger"><?= $statistics['divorces']['total'] ?> total</span>
                        <span class="badge badge-warning"><?= $statistics['divorces']['pending'] ?> pending</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="text-center">
                                <div class="h4 font-weight-bold text-gray-800"><?= $statistics['divorces']['completed'] ?></div>
                                <div class="text-xs font-weight-bold text-success text-uppercase">Completed</div>
                                <small class="text-muted">All signatures</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <div class="h4 font-weight-bold text-gray-800"><?= $statistics['divorces']['issued'] ?></div>
                                <div class="text-xs font-weight-bold text-info text-uppercase">Issued</div>
                                <small class="text-muted">Delivered</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <div class="h4 font-weight-bold text-gray-800"><?= $statistics['divorces']['pending'] ?></div>
                                <div class="text-xs font-weight-bold text-danger text-uppercase">Pending</div>
                                <small class="text-muted">Missing signatures</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="progress mb-3" style="height: 20px; border-radius: 10px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= $statistics['divorces']['completion_rate'] ?>%"
                             title="Completed: <?= $statistics['divorces']['completed'] ?>">
                            <span class="progress-text">Completed <?= $statistics['divorces']['completion_rate'] ?>%</span>
                        </div>
                        <div class="progress-bar bg-info" role="progressbar" 
                             style="width: <?= $statistics['divorces']['issue_rate'] ?>%"
                             title="Issued: <?= $statistics['divorces']['issued'] ?>">
                            <span class="progress-text">Issued <?= $statistics['divorces']['issue_rate'] ?>%</span>
                        </div>
                        <div class="progress-bar bg-danger" role="progressbar" 
                             style="width: <?= $statistics['divorces']['pending_rate'] ?>%"
                             title="Pending: <?= $statistics['divorces']['pending'] ?>">
                            <span class="progress-text">Pending <?= $statistics['divorces']['pending_rate'] ?>%</span>
                        </div>
                    </div>
                    
                    <!-- Status Legend -->
                    <div class="d-flex justify-content-around small text-gray-600">
                        <div>
                            <span class="text-success">●</span> Completed (All 3 signatures)
                        </div>
                        <div>
                            <span class="text-info">●</span> Issued (Delivered)
                        </div>
                        <div>
                            <span class="text-danger">●</span> Pending (Missing signatures)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Documents Summary -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-left-warning">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">
                        <i class="fas fa-exclamation-circle mr-2"></i>Pending Documents Summary
                    </h6>
                    <div class="badge badge-warning">
                        <?= $statistics['pending_certificates'] ?> Total Pending
                    </div>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="h4 font-weight-bold text-gray-800"><?= $signatureBreakdown['total_missing_one'] ?></div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase">Missing 1 Signature</div>
                            <small class="text-muted">Almost complete</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="h4 font-weight-bold text-gray-800"><?= $signatureBreakdown['total_missing_two'] ?></div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase">Missing 2 Signatures</div>
                            <small class="text-muted">Partially signed</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="h4 font-weight-bold text-gray-800"><?= $signatureBreakdown['total_missing_all'] ?></div>
                            <div class="text-xs font-weight-bold text-danger text-uppercase">Missing All Signatures</div>
                            <small class="text-muted">Not started</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row">
        <!-- Recent Marriages -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: #002868;">
                        <i class="fas fa-clock mr-2"></i>Recent Marriage Certificates
                    </h6>
                    <a href="/matrimonial_dashboard/wedcert" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-list mr-1"></i>View All
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 60px;"></th>
                                    <th>Couple</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($recentMarriages)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            No recent marriage certificates
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($recentMarriages as $cert): ?>
                                        <?php 
                                            $groomName = esc($cert['groom_name'] ?? 'N/A');
                                            $brideName = esc($cert['bride_name'] ?? 'N/A');
                                            $names = strlen($groomName . ' & ' . $brideName) > 25 
                                                ? substr($groomName . ' & ' . $brideName, 0, 25) . '...' 
                                                : $groomName . ' & ' . $brideName;
                                            
                                            // Determine status
                                            $isSigned = (!empty($cert['SIGNA']) && !empty($cert['SIGNB']) && !empty($cert['SIGNC']));
                                            $isIssued = ($cert['isWedCertIssued'] ?? 0) == 1;
                                            $date = !empty($cert['created_at']) ? date('M d, Y', strtotime($cert['created_at'])) : 'N/A';
                                            $reference = esc($cert['reference_no'] ?? 'N/A');
                                            
                                            // Get photos
                                            $groomPhoto = '/uploads/marriage/'.$cert['groom_passport_photo'];
                                            $bridePhoto = '/uploads/marriage/'.$cert['bride_passport_photo'];
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="position-relative" style="width: 40px; height: 40px;">
                                                        <img src="<?= $groomPhoto ?>" 
                                                             alt="Groom" 
                                                             class="rounded-circle border border-white"
                                                             style="width: 30px; height: 30px; object-fit: cover; position: absolute; left: 0; z-index: 2;">
                                                        <img src="<?= $bridePhoto ?>" 
                                                             alt="Bride" 
                                                             class="rounded-circle border border-white"
                                                             style="width: 30px; height: 30px; object-fit: cover; position: absolute; right: 0; z-index: 1;">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-gray-800"><?= $names ?></div>
                                                <small class="text-muted">Ref: <?= $reference ?></small>
                                            </td>
                                            <td>
                                                <div class="small text-gray-600"><?= $date ?></div>
                                            </td>
                                            <td>
                                                <?php if($isIssued): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check mr-1"></i>Issued
                                                    </span>
                                                <?php elseif($isSigned): ?>
                                                    <span class="badge badge-info">
                                                        <i class="fas fa-signature mr-1"></i>Signed
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">
                                                        <i class="fas fa-clock mr-1"></i>Pending
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="/matrimonial_dashboard/wedcert/view/<?= $cert['marriage_cert_id'] ?>" 
                                                   class="btn btn-sm btn-outline-primary" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Divorces -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-danger">
                        <i class="fas fa-clock mr-2"></i>Recent Divorce Certificates
                    </h6>
                    <a href="/matrimonial_dashboard/divorce_cert" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-list mr-1"></i>View All
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 60px;"></th>
                                    <th>Parties</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($recentDivorces)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            No recent divorce certificates
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($recentDivorces as $cert): ?>
                                        <?php 
                                            $plaintiff = esc($cert['divorceplaintiff'] ?? 'N/A');
                                            $defendant = esc($cert['divorcedefendant'] ?? 'N/A');
                                            $names = strlen($plaintiff . ' & ' . $defendant) > 25 
                                                ? substr($plaintiff . ' & ' . $defendant, 0, 25) . '...' 
                                                : $plaintiff . ' & ' . $defendant;
                                            
                                            // Determine status
                                            $isSigned = (!empty($cert['divorceSIGN_A']) && !empty($cert['divorceSIGN_B']) && !empty($cert['divorceSIGN_C']));
                                            $isIssued = ($cert['divorceIsIssued'] ?? 0) == 1;
                                            $date = !empty($cert['divorcecreated_at']) ? date('M d, Y', strtotime($cert['divorcecreated_at'])) : 'N/A';
                                            $reference = esc($cert['divorceRefNo'] ?? 'N/A');
                                            
                                            // Get photos
                                            $plaintiffPhoto = '/uploads/divorce/'.$cert['divorceplaintiffPic'];
                                            $defendantPhoto = '/uploads/divorce/'.$cert['divorcedefendantPic'];
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="position-relative" style="width: 40px; height: 40px;">
                                                        <img src="<?= $plaintiffPhoto ?>" 
                                                             alt="Plaintiff" 
                                                             class="rounded-circle border border-white"
                                                             style="width: 30px; height: 30px; object-fit: cover; position: absolute; left: 0; z-index: 2;">
                                                        <img src="<?= $defendantPhoto ?>" 
                                                             alt="Defendant" 
                                                             class="rounded-circle border border-white"
                                                             style="width: 30px; height: 30px; object-fit: cover; position: absolute; right: 0; z-index: 1;">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-gray-800"><?= $names ?></div>
                                                <small class="text-muted">Ref: <?= $reference ?></small>
                                            </td>
                                            <td>
                                                <div class="small text-gray-600"><?= $date ?></div>
                                            </td>
                                            <td>
                                                <?php if($isIssued): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check mr-1"></i>Issued
                                                    </span>
                                                <?php elseif($isSigned): ?>
                                                    <span class="badge badge-info">
                                                        <i class="fas fa-signature mr-1"></i>Signed
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">
                                                        <i class="fas fa-clock mr-1"></i>Pending
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="/matrimonial_dashboard/divorce_cert/view/<?= $cert['divorceCertId'] ?>" 
                                                   class="btn btn-sm btn-outline-danger" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Trends Chart -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold" style="color: #002868;">
                        <i class="fas fa-chart-line mr-2"></i>Monthly Trends - <?= $monthlyData['year'] ?? date('Y') ?>
                    </h6>
                    <div class="small">
                        <span class="mr-3"><span style="color: #002868;">●</span> Marriages</span>
                        <span><span style="color: #e74a3b;">●</span> Divorces</span>
                    </div>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="monthlyTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* Animated Statistics Cards */
.stat-card {
    position: relative;
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e3e6f0;
    transition: all 0.3s ease;
    height: 100%;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    border-color: #002868;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    font-size: 24px;
    color: white;
    position: relative;
    z-index: 1;
}

.stat-card[data-color="success"] .stat-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.stat-card[data-color="warning"] .stat-icon {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
}

.stat-card[data-color="info"] .stat-icon {
    background: linear-gradient(135deg, #17a2b8, #0dcaf0);
}

.stat-card:not([data-color]) .stat-icon {
    background: linear-gradient(135deg, #002868, #4a6fa5);
}

.stat-content {
    position: relative;
    z-index: 1;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #2e3a59;
}

.stat-label {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 10px;
    font-weight: 500;
}

.stat-detail {
    font-size: 12px;
}

.stat-progress {
    height: 6px;
    border-radius: 3px;
    margin-top: 8px;
}

/* Glow Effects */
.stat-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 12px;
    opacity: 0;
    z-index: 0;
    pointer-events: none;
}

/* Animation Classes */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes glow {
    0%, 100% { box-shadow: 0 0 5px rgba(0, 40, 104, 0.3); }
    50% { box-shadow: 0 0 20px rgba(0, 40, 104, 0.6); }
}

@keyframes breath {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

/* Apply animations based on data attributes */
.stat-card[data-animation="pulse"] .stat-icon {
    animation: pulse 2s infinite;
}

.stat-card[data-animation="glow"] {
    animation: glow 3s infinite;
}

.stat-card[data-animation="breath"] {
    animation: breath 4s infinite;
}

/* Hover animations */
.stat-card:hover .stat-glow {
    animation: glow 1.5s infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .stat-card {
        padding: 15px;
    }
    
    .stat-number {
        font-size: 24px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .stat-card {
        margin-bottom: 15px;
    }
}

/* Existing styles kept for compatibility */
.progress-text {
    font-size: 0.7rem;
    font-weight: 600;
    text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Liberia theme colors */
.text-liberia-blue { color: #002868 !important; }
.text-liberia-red { color: #e74a3b !important; }
.bg-liberia-blue { background-color: #002868 !important; }
.bg-liberia-red { background-color: #e74a3b !important; }
.border-liberia-blue { border-color: #002868 !important; }
.border-liberia-red { border-color: #e74a3b !important; }

/* Couple photos styling */
.couple-photos {
    position: relative;
    width: 50px;
    height: 50px;
}

.photo-overlap {
    position: absolute;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 2px solid white;
    object-fit: cover;
}

.photo-overlap:first-child {
    left: 0;
    z-index: 2;
}

.photo-overlap:last-child {
    right: 0;
    z-index: 1;
}
</style>

<!-- Only load Chart.js, no jQuery or Owl Carousel needed -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Monthly Trends Chart
    var monthlyChartCanvas = document.getElementById('monthlyTrendChart');
    if (monthlyChartCanvas && typeof Chart !== 'undefined') {
        var monthlyData = <?php echo json_encode($monthlyData ?? []); ?>;
        
        if (monthlyData && monthlyData.labels) {
            // Destroy previous chart instance if exists
            if (window.monthlyTrendChartInstance) {
                window.monthlyTrendChartInstance.destroy();
            }
            
            // Create new chart
            window.monthlyTrendChartInstance = new Chart(monthlyChartCanvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: monthlyData.labels,
                    datasets: [
                        {
                            label: 'Marriage Certificates',
                            data: monthlyData.marriages || [],
                            borderColor: '#002868',
                            backgroundColor: 'rgba(0, 40, 104, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            pointBackgroundColor: '#002868',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Divorce Certificates',
                            data: monthlyData.divorces || [],
                            borderColor: '#e74a3b',
                            backgroundColor: 'rgba(231, 74, 59, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            pointBackgroundColor: '#e74a3b',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#002868',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                precision: 0
                            },
                            title: {
                                display: true,
                                text: 'Number of Certificates',
                                color: '#6c757d'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            title: {
                                display: true,
                                text: 'Months',
                                color: '#6c757d'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
            
            // Add resize event listener
            window.addEventListener('resize', function() {
                if (window.monthlyTrendChartInstance) {
                    window.monthlyTrendChartInstance.resize();
                }
            });
        }
    }
    
    // Add hover effects to stat cards
    var statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            var glow = this.querySelector('.stat-glow');
            if (glow) {
                var color = this.getAttribute('data-color') || 'primary';
                var colors = {
                    'success': 'rgba(40, 167, 69, 0.3)',
                    'warning': 'rgba(255, 193, 7, 0.3)',
                    'info': 'rgba(23, 162, 184, 0.3)',
                    'primary': 'rgba(0, 40, 104, 0.3)'
                };
                glow.style.boxShadow = '0 0 30px ' + (colors[color] || colors['primary']);
                glow.style.opacity = '1';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            var glow = this.querySelector('.stat-glow');
            if (glow) {
                glow.style.opacity = '0';
            }
        });
    });
});
</script>

<?=$this->endSection() ?>
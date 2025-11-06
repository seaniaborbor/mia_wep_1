<?= $this->extend('public/partials/layout') ?>
<?= $this->section('main') ?>
<?php if (!empty($branch)): ?>
<div class="container mt-4">
    <div class="row">
        <!-- Branch Details Card - Left Side (Larger) -->
        <div class="col-md-8">
            <div class="card shadow-lg border-liberia-blue mb-4 branch-card">
                <div class="card-header bg-liberia-blue-gradient text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-building me-2 shine"></i>Branch Details</h3>
                        <div class="status-badge">
                            <i class="fas fa-circle"></i>
                            <?= $branch['isActive'] ? 'ACTIVE' : 'INACTIVE' ?>
                        </div>
                    </div>
                </div>
               
                <div class="card-body">
                    <!-- Animated Ribbon -->
                    <div class="ribbon ribbon-top-right"><span>OFFICIAL</span></div>
                   
                    <!-- Branch Header -->
                    <div class="branch-header text-center mb-4">
                        <div class="branch-icon mb-3">
                            <div class="icon-container bounce-in">
                                <i class="fas fa-landmark fa-3x"></i>
                                <div class="pulse-ring"></div>
                            </div>
                        </div>
                        <h4 class="text-liberia-blue"><?= esc($branch['branchName'] ?? 'N/A') ?></h4>
                        <p class="text-muted"><?= esc($branch['branchCityOrTown'] ?? 'N/A') ?>, <?= esc($branch['branchCounty'] ?? 'N/A') ?> County</p>
                    </div>
                    <!-- Branch Information Grid -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-section">
                                <h6 class="text-liberia-blue mb-3"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                                <div class="info-item slide-in">
                                    <i class="fas fa-code text-liberia-blue"></i>
                                    <div>
                                        <strong>Branch Code</strong>
                                        <p class="highlight-text"><?= esc($branch['branchCode'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                               
                                <div class="info-item slide-in" style="animation-delay: 0.1s;">
                                    <i class="fas fa-map-marker-alt text-liberia-red"></i>
                                    <div>
                                        <strong>Location</strong>
                                        <p><?= esc($branch['branchCityOrTown'] ?? 'N/A') ?>, <?= esc($branch['branchCounty'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                               
                               
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="info-section">
                                <h6 class="text-liberia-blue mb-3"><i class="fas fa-address-card me-2"></i>Contact Information</h6>
                                <div class="info-item slide-in" style="animation-delay: 0.3s;">
                                    <i class="fas fa-phone text-liberia-red"></i>
                                    <div>
                                        <strong>Contact Number</strong>
                                        <p><?= esc($branch['branchContact'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                               
                                <div class="info-item slide-in" style="animation-delay: 0.4s;">
                                    <i class="fas fa-envelope text-liberia-blue"></i>
                                    <div>
                                        <strong>Email Address</strong>
                                        <p><?= esc($branch['branchEmail'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                               
                    
                            </div>
                        </div>
                    </div>
                    <!-- Additional Information -->
                    <div class="additional-info mt-4 pt-4 border-top">
                        <h6 class="text-liberia-blue mb-3"><i class="fas fa-star me-2"></i>Branch Features</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="features-list">
                                    <li class="bounce-in"><i class="fas fa-check-circle text-success me-2"></i>Digital Certificate Processing</li>
                                    <li class="bounce-in" style="animation-delay: 0.1s;"><i class="fas fa-check-circle text-success me-2"></i>Multiple Signatory Workflow</li>
                                    <li class="bounce-in" style="animation-delay: 0.2s;"><i class="fas fa-check-circle text-success me-2"></i>Secure Document Storage</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="features-list">
                                    <li class="bounce-in" style="animation-delay: 0.3s;"><i class="fas fa-check-circle text-success me-2"></i>Real-time Status Tracking</li>
                                    <li class="bounce-in" style="animation-delay: 0.4s;"><i class="fas fa-check-circle text-success me-2"></i>Automated Notifications</li>
                                    <li class="bounce-in" style="animation-delay: 0.5s;"><i class="fas fa-check-circle text-success me-2"></i>24/7 System Access</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Operators Section or Notice - Right Side -->
        <div class="col-md-4">
            <?php if (!empty($operators)): ?>
                <div class="operators-section">
                    <div class="operators-header mb-4">
                        <h4 class="text-liberia-blue"><i class="fas fa-user-shield me-2"></i>Branch Operators</h4>
                        <p class="text-muted"><?= count($operators) ?> authorized personnel</p>
                    </div>
                    <div class="operators-list">
                        <?php foreach ($operators as $index => $operator): ?>
                            <div class="operator-card-wrapper mb-3">
                                <div class="card operator-card shadow-sm" data-aos="fade-left" data-aos-delay="<?= $index * 100 ?>">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <!-- Profile Picture Column -->
                                            <div class="col-4 text-center">
                                                <div class="profile-picture-container">
                                                    <?php if (!empty($operator['userPicture'])): ?>
                                                        <img src="/uploads/users/pictures/<?= esc($operator['userPicture']) ?>"
                                                             alt="<?= esc($operator['userFullName'] ?? 'Operator') ?>"
                                                             class="profile-picture"
                                                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iNDAiIGN5PSI0MCIgcj0iNDAiIGZpbGw9IiMwMDI4NjgiLz4KPHBhdGggZD0iTTQwIDQ0QzQ2LjYyODQgNDQgNTIgMzguNjI4NCA1MiAzMkM1MiAyNS4zNzE2IDQ2LjYyODQgMjAgNDAgMjBDMzMuMzcxNiAyMCAyOCAyNS4zNzE2IDI4IDMyQzI4IDM4LjYyODQgMzMuMzcxNiA0NCA0MCA0NFoiIGZpbGw9IiNCRjBBMzAiLz4KPHBhdGggZD0iTTQwIDQ0QzQ3LjczMTUgNDQgNTQgMzcuNzMxNSA1NCAzMEM1NCAyMi4yNjg1IDQ3LjczMTUgMTYgNDAgMTZDMzIuMjY4NSAxNiAyNiAyMi4yNjg1IDI2IDMwQzI2IDM3LjczMTUgMzIuMjY4NSA0NCA0MCA0NFoiIGZpbGw9IiNGRkZGRkYiLz4KPC9zdmc+'">
                                                    <?php else: ?>
                                                        <div class="profile-picture-placeholder">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- Operator Details Column -->
                                            <div class="col-8">
                                                <div class="operator-info">
                                                    <h6 class="operator-name text-liberia-blue mb-1"><?= esc($operator['userFullName'] ?? 'Unknown User') ?></h6>
                                                    <div class="operator-badge mb-2
                                                        <?= $operator['userAccountActiveStatus'] ? 'badge-active' : 'badge-inactive' ?>">
                                                        <?= $operator['userAccountActiveStatus'] ? 'ACTIVE' : 'INACTIVE' ?>
                                                    </div>
                                                    <div class="operator-details">
                                                        <div class="detail-item">
                                                            <i class="fas fa-id-card text-liberia-red me-1"></i>
                                                            <small><?= esc($operator['userPosition'] ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="detail-item">
                                                            <i class="fas fa-envelope text-liberia-blue me-1"></i>
                                                            <small class="text-truncate d-block"><?= esc($operator['userEmail'] ?? 'N/A') ?></small>
                                                        </div>
                                                        <div class="detail-item">
                                                            <i class="fas fa-phone text-liberia-red me-1"></i>
                                                            <small><?= esc($operator['userPhone'] ?? 'N/A') ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning shake text-center" role="alert">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4 class="alert-heading">Branch Configuration in Progress</h4>
                    <p>This branch is still being set up. No operators are currently assigned.</p>
                    <hr>
                    <p class="mb-0">Please check back soon for updates!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="container mt-4">
        <div class="alert alert-liberia-red shake">
            <i class="fas fa-exclamation-triangle me-2"></i>
            No branch data available.
        </div>
    </div>
<?php endif; ?>
<style>
/* Liberia National Colors */
:root {
    --liberia-red: #BF0A30;
    --liberia-blue: #002868;
    --liberia-white: #FFFFFF;
    --liberia-light-blue: rgba(0, 40, 104, 0.1);
    --liberia-light-red: rgba(191, 10, 48, 0.1);
}
/* Enhanced Background Gradients */
.bg-liberia-blue-gradient {
    background: linear-gradient(135deg, var(--liberia-blue) 0%, #001a4d 100%) !important;
}
.bg-liberia-red-gradient {
    background: linear-gradient(135deg, var(--liberia-red) 0%, #a00928 100%) !important;
}
/* Text colors */
.text-liberia-red { color: var(--liberia-red) !important; }
.text-liberia-blue { color: var(--liberia-blue) !important; }
/* Background colors */
.bg-liberia-red { background-color: var(--liberia-red) !important; }
.bg-liberia-blue { background-color: var(--liberia-blue) !important; }
/* Main Container */
.container {
    animation: fadeIn 0.8s ease-out;
}
/* Branch Card Styles */
.branch-card {
    animation: slideUp 0.6s ease-out;
    position: relative;
    overflow: hidden;
}
.branch-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}
/* Ribbon Style */
.ribbon {
    position: absolute;
    right: -5px;
    top: -5px;
    z-index: 1;
    overflow: hidden;
    width: 75px;
    height: 75px;
    text-align: right;
}
.ribbon span {
    font-size: 10px;
    font-weight: bold;
    color: #FFF;
    text-transform: uppercase;
    text-align: center;
    line-height: 20px;
    transform: rotate(45deg);
    width: 100px;
    display: block;
    background: var(--liberia-red);
    position: absolute;
    top: 19px;
    right: -21px;
}
.ribbon span::before {
    content: "";
    position: absolute;
    left: 0px;
    top: 100%;
    z-index: -1;
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    border-bottom: 3px solid transparent;
    border-top: 3px solid #8c0010;
}
.ribbon span::after {
    content: "";
    position: absolute;
    right: 0px;
    top: 100%;
    z-index: -1;
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    border-bottom: 3px solid transparent;
    border-top: 3px solid #8c0010;
}
/* Status Badge */
.status-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: bold;
    backdrop-filter: blur(10px);
}
/* Branch Header */
.branch-header {
    background: linear-gradient(135deg, var(--liberia-light-blue) 0%, transparent 100%);
    padding: 20px;
    border-radius: 10px;
    margin: -10px -10px 20px -10px;
}
.branch-icon {
    position: relative;
}
.icon-container {
    position: relative;
    display: inline-block;
}
.icon-container i {
    font-size: 3rem;
    color: var(--liberia-blue);
    z-index: 2;
    position: relative;
}
.pulse-ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    border: 2px solid var(--liberia-blue);
    border-radius: 50%;
    animation: pulse 3s infinite;
    opacity: 0;
}
/* Profile Picture Styles */
.profile-picture-container {
    display: flex;
    justify-content: center;
    align-items: center;
}
.profile-picture {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--liberia-blue);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}
.profile-picture:hover {
    transform: scale(1.05);
    border-color: var(--liberia-red);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}
.profile-picture-placeholder {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    border: 3px solid var(--liberia-blue);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.profile-picture-placeholder i {
    font-size: 1.5rem;
}
/* Info Sections */
.info-section {
    margin-bottom: 20px;
}
.info-item {
    display: flex;
    align-items: center;
    padding: 12px;
    margin-bottom: 8px;
    border-radius: 8px;
    background: var(--liberia-light-blue);
    transition: all 0.3s ease;
}
.info-item:hover {
    background: rgba(0, 40, 104, 0.15);
    transform: translateX(5px);
}
.info-item i {
    font-size: 1.2rem;
    margin-right: 15px;
    width: 20px;
    text-align: center;
}
.info-item strong {
    display: block;
    font-size: 0.85rem;
    color: var(--liberia-blue);
    margin-bottom: 2px;
}
.info-item p {
    margin: 0;
    font-weight: 500;
    color: #2d3748;
}
/* Operator Cards - Enhanced Side-by-side Design */
.operator-card {
    animation: slideUp 0.6s ease-out;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    border-radius: 10px;
    height: 100%;
}
.operator-card:hover {
    transform: translateY(-3px);
    border-color: var(--liberia-light-blue);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}
.operator-info {
    padding-left: 10px;
}
.operator-name {
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 0.95rem;
    line-height: 1.2;
}
.operator-badge {
    padding: 3px 8px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: bold;
    display: inline-block;
}
.badge-active {
    background: var(--liberia-blue);
    color: white;
}
.badge-inactive {
    background: #6c757d;
    color: white;
}
/* Operator Details */
.operator-details {
    margin: 8px 0 0 0;
}
.detail-item {
    display: flex;
    align-items: center;
    padding: 2px 0;
    font-size: 0.75rem;
    line-height: 1.2;
}
.detail-item i {
    margin-right: 6px;
    width: 12px;
    text-align: center;
    flex-shrink: 0;
    font-size: 0.7rem;
}
.detail-item small {
    word-break: break-word;
    font-size: 0.75rem;
}
/* Operators List - No Scroll */
.operators-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
/* Alert Styling for Notice */
.alert-warning {
    background: linear-gradient(135deg, #fff3cd, #ffeeba);
    border: 2px solid #ffca2c;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.alert-heading {
    color: #856404;
    font-weight: bold;
}
.alert i {
    color: #856404;
}
/* Animations */
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes pulse {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0;
    }
}
@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}
@keyframes shine {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}
/* Animation Classes */
.bounce-in {
    animation: bounceIn 0.6s ease-out;
}
.slide-in {
    animation: slideUp 0.8s ease-out;
}
.fade-in {
    animation: fadeIn 1s ease-out;
}
.shake {
    animation: shake 0.5s ease-in-out;
}
.pulse {
    animation: pulse 2s infinite;
}
.shine {
    animation: shine 2s infinite;
}
/* Responsive Design */
@media (max-max-width: 768px) {
    .branch-header {
        padding: 15px;
    }
   
    .operator-card {
        margin-bottom: 15px;
    }
   
    .info-item {
        padding: 10px;
    }
   
    .profile-picture,
    .profile-picture-placeholder {
        width: 60px;
        height: 60px;
    }
   
    .profile-picture-placeholder i {
        font-size: 1.2rem;
    }
   
    .operator-info {
        padding-left: 15px;
    }
}
</style>
<!-- AOS Library for Scroll Animations -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>
<?= $this->endSection() ?>
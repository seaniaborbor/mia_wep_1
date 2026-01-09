<?= $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid px-4">
    <!-- Patriotic Header with Branch Name & Switcher -->
    <div class="modern-card mb-4">
        <div class="modern-card-header" style="background: linear-gradient(135deg, #002868 0%, #001F5B 100%);">
            <div class="header-content">
                <div class="header-title">
                    <div class="title-icon" style="background: #BF0A30; box-shadow: 0 0 30px rgba(191,10,48,0.6);">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="title-text">
                        <h1 class="page-title text-white mb-0"><?= esc(strtoupper($branch_info['branchName'])) ?></h1>
                        <p class="page-subtitle text-white opacity-90 mb-0">
                            <?= esc($branch_info['branchCityOrTown']) ?>, <?= esc($branch_info['branchCounty']) ?> County
                        </p>
                    </div>
                </div>

                <!-- Branch Switcher Dropdown -->
                <div class="dropdown-wrapper" style="z-index: 100000 !important;">
                    <button class="btn-patriotic btn-blue">
                        <i class="fas fa-code-branch"></i>
                        <?= esc($branch_info['branchName']) ?>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </button>
                    <div class="dropdown-menu">
                        <?php if (!empty($allBranches)): ?>
                            <?php foreach ($allBranches as $branch): ?>
                                <a class="dropdown-item <?= ($branch['branchId'] == $branch_info['branchId']) ? 'active' : '' ?>"
                                   href="<?= base_url('dashboard/branches/view/' . $branch['branchId']) ?>">
                                    <i class="fas fa-building me-2"></i>
                                    <?= esc($branch['branchName']) ?>
                                    <small class="text-muted d-block">
                                        <?= esc($branch['branchCityOrTown']) ?> — <?= esc($branch['branchCounty']) ?>
                                    </small>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="dropdown-item text-muted">No branches available</span>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/dashboard/general">
                            <i class="fas fa-flag me-2"></i>Nation's Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid mb-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #002868, #001F5B);">
                <i class="fas fa-ring"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Wedding Certificates</div>
                <div class="stat-value"><?= count($branch_marriage_certificates) ?? 0 ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                <i class="fas fa-heart-broken"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Divorce Certificates</div>
                <div class="stat-value"><?= count($branch_divorce_certificates) ?? 0 ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Active Users</div>
                <div class="stat-value"><?= $total_active_user ?? 0 ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                <i class="fas fa-user-times"></i>
            </div>
            <div class="stat-content">
                <div class="stat-label">Inactive Users</div>
                <div class="stat-value"><?= $total_inactive_user ?? 0 ?></div>
            </div>
        </div>
    </div>

    <!-- Main Content Card with Tabs -->
    <div class="modern-card">
        <div class="modern-card-header" style="background: linear-gradient(135deg, #BF0A30 0%, #9B0B28 100%);">
            <div class="header-content">
                <div class="header-title">
                    <div class="title-icon" style="background: white; color: #002868;">
                        <i class="fas fa-landmark"></i>
                    </div>
                    <div class="title-text">
                        <h1 class="page-title text-white mb-0">Branch Operations Center</h1>
                        <p class="page-subtitle text-white opacity-90 mb-0">Detailed information & personnel registry</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modern-card-body p-4">
            <div class="modern-tabs">
                <div class="tab-nav">
                    <button class="tab-btn active" data-tab="info">
                        <span class="tab-icon"><i class="fas fa-info-circle"></i></span>
                        <span class="tab-text">Branch Information</span>
                    </button>
                    <button class="tab-btn" data-tab="active-users">
                        <span class="tab-icon"><i class="fas fa-user-check"></i></span>
                        <span class="tab-text">Active Users</span>
                        <span class="tab-badge bg-success"><?= $total_active_user ?? 0 ?></span>
                    </button>
                    <button class="tab-btn" data-tab="inactive-users">
                        <span class="tab-icon"><i class="fas fa-user-times"></i></span>
                        <span class="tab-text">Inactive Users</span>
                        <span class="tab-badge bg-secondary"><?= $total_inactive_user ?? 0 ?></span>
                    </button>
                </div>

                <div class="tab-content mt-4">
                    <div class="tab-pane active" id="info-tab">
                        <?php include('partials/tables/branch_summary_table.php'); ?>
                    </div>
                    <div class="tab-pane" id="active-users-tab">
                        <?php include('partials/tables/active_users_profiles_table.php'); ?>
                    </div>
                    <div class="tab-pane" id="inactive-users-tab">
                        <?php include('partials/tables/inactive_users_profiles_table.php'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patriotic Footer with Actions -->
        <div class="modern-card-footer d-flex justify-content-between align-items-center py-4 px-5">
            <div class="text-muted small">
                <strong>System ID:</strong> <?= esc($branch_info['branchCode']) ?> 
                • Last updated: <?= date('M j, Y \a\t g:i A') ?>
            </div>
            <div class="action-buttons">
                <a href="<?= base_url('dashboard/branches/edit/' . $branch_info['branchId']) ?>"
                   class="btn-patriotic btn-blue me-3">
                    <i class="fas fa-edit"></i> Edit Branch
                </a>
                <a href="<?= base_url('dashboard/branches/deactivate/' . $branch_info['branchId']) ?>"
                   class="btn-patriotic <?= $branch_info['isActive'] ? 'btn-red' : 'btn-success' ?>">
                    <i class="fas fa-toggle-<?= $branch_info['isActive'] ? 'off' : 'on' ?>"></i>
                    <?= $branch_info['isActive'] ? 'Deactivate' : 'Activate' ?> Branch
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const tab = this.dataset.tab;
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            document.getElementById(tab + '-tab').classList.add('active');
        });
    });
});
</script>

<!-- OFFICIAL RED-WHITE-BLUE PATRIOTIC THEME - FULL FORCE -->
<style>
.modern-card {
    background: white !important;
    border-radius: 18px !important;
    box-shadow: 0 6px 28px rgba(0,40,104,0.14) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden;
    margin-bottom: 1.8rem;
}
.modern-card-header {
    padding: 2rem !important;
    position: relative;
}
.modern-card-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.1);
    background-image: linear-gradient(45deg, rgba(255,255,255,0.08) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.08) 75%, transparent 75%, transparent);
    background-size: 30px 30px;
}
.header-content { 
    position: relative; 
    z-index: 2; 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    flex-wrap: wrap; 
    gap: 1.5rem; 
}
.header-title { 
    display: flex; 
    align-items: center; 
    gap: 1.3rem; 
}
.title-icon { 
    width: 68px; 
    height: 68px; 
    border-radius: 18px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 2rem; 
}
.page-title { 
    font-size: 2.1rem; 
    font-weight: 900; 
    margin: 0; 
    letter-spacing: 0.8px;
}
.page-subtitle { 
    font-size: 1.1rem; 
    opacity: 0.95; 
    margin: 0.5rem 0 0; 
}

.btn-patriotic {
    padding: 0.9rem 1.8rem !important;
    border-radius: 14px !important;
    font-weight: 700 !important;
    font-size: 0.98rem;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    border: none !important;
    transition: all 0.35s ease;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}
.btn-blue { background: #002868 !important; }
.btn-blue:hover { background: #001F5B !important; transform: translateY(-4px) !important; }
.btn-red { background: #BF0A30 !important; }
.btn-red:hover { background: #9B0B28 !important; transform: translateY(-4px) !important; }

.dropdown-wrapper { position: relative; }
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 0.6rem;
    background: white;
    min-width: 320px;
    border-radius: 14px;
    box-shadow: 0 12px 40px rgba(0,40,104,0.2);
    border: 1px solid #e2e8f0;
    z-index: 1050;
    padding: 0.8rem;
}
.dropdown-wrapper:hover .dropdown-menu { display: block; }
.dropdown-item {
    padding: 1rem;
    border-radius: 10px;
    color: #1e40af;
    font-weight: 600;
    transition: 0.25s;
}
.dropdown-item:hover, .dropdown-item.active { 
    background: #BF0A30; 
    color: white; 
}
.dropdown-item small { 
    font-size: 0.8rem; 
    opacity: 0.9; 
}
.dropdown-divider { 
    height: 1px; 
    background: #e2e8f0; 
    margin: 0.6rem 0; 
}

.stats-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
    gap: 1.6rem; 
}
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.8rem;
    display: flex;
    align-items: center;
    gap: 1.4rem;
    border: 1px solid #e2e8f0;
    transition: all 0.35s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
}
.stat-card:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 16px 40px rgba(0,40,104,0.22); 
}
.stat-icon { 
    width: 72px; 
    height: 72px; 
    border-radius: 18px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 1.9rem; 
    color: white; 
}
.stat-label { 
    font-size: 0.95rem; 
    font-weight: 700; 
    color: #4b5563; 
    text-transform: uppercase; 
    letter-spacing: 1px; 
}
.stat-value { 
    font-size: 2.5rem; 
    font-weight: 800; 
    color: #1f2937; 
}

.modern-tabs { 
    border-radius: 16px; 
    overflow: hidden; 
    border: 1px solid #e2e8f0; 
}
.tab-nav {
    display: flex;
    background: linear-gradient(to right, #002868, #BF0A30);
    padding: 1rem;
    gap: 0.6rem;
}
.tab-btn {
    flex: 1;
    padding: 1.2rem 1.6rem;
    border-radius: 12px;
    background: rgba(255,255,255,0.15);
    color: white;
    font-weight: 700;
    font-size: 0.98rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    transition: all 0.35s ease;
    border: none;
    cursor: pointer;
}
.tab-btn:hover { background: rgba(255,255,255,0.25); }
.tab-btn.active {
    background: white;
    color: #002868;
    box-shadow: 0 8px 28px rgba(0,0,0,0.3);
    transform: translateY(-4px);
}
.tab-badge { 
    padding: 0.4rem 0.9rem; 
    border-radius: 50px; 
    font-size: 0.82rem; 
    font-weight: 800; 
}

.tab-pane { 
    display: none; 
    padding: 2rem 0; 
}
.tab-pane.active { 
    display: block; 
    animation: fadeInUp 0.6s ease; 
}
@keyframes fadeInUp { 
    from { opacity: 0; transform: translateY(20px); } 
    to { opacity: 1; transform: none; } 
}

.modern-card-footer {
    background: linear-gradient(to right, #f8fafc, #f1f5f9);
    border-top: 2px solid #BF0A30;
}
.action-buttons .btn-patriotic { 
    min-width: 180px; 
    justify-content: center; 
}

/* Responsive */
@media (max-width: 992px) {
    .header-content { flex-direction: column; text-align: center; gap: 1.5rem; }
    .stats-grid { grid-template-columns: 1fr 1fr; }
    .tab-nav { flex-direction: column; }
}
@media (max-width: 576px) {
    .stats-grid { grid-template-columns: 1fr; }
    .action-buttons { flex-direction: column; gap: 1rem; width: 100%; }
    .action-buttons .btn-patriotic { width: 100%; }
}
</style>

<?= $this->endSection() ?>
<?php if (!empty($wedCert) && is_array($wedCert)): ?>
<div class="certificate-result-card w-100">
    <div class="certificate-header-success">
        <i class="fas fa-ring me-2"></i>
        Verified Marriage Certificate
        <span class="certificate-badge">Valid</span>
    </div>
    
    <div class="certificate-body">
        <div class="certificate-reference">
            <h3 class="reference-title">
                Reference No: <span class="reference-code"><?= esc($wedCert['marriage_code'] ?? 'N/A') ?></span>
            </h3>
        </div>

        <div class="certificate-summary">
            <div class="summary-item">
                <i class="fas fa-map-marker-alt text-primary"></i>
                <div>
                    <strong>Place of Marriage</strong>
                    <p><?= esc($wedCert['place_of_marriage'] ?? 'N/A') ?></p>
                </div>
            </div>
            
            <div class="summary-item">
                <i class="fas fa-calendar-alt text-primary"></i>
                <div>
                    <strong>Date of Marriage</strong>
                    <p><?= !empty($wedCert['date_of_marriage']) ? date('F j, Y', strtotime($wedCert['date_of_marriage'])) : 'N/A' ?></p>
                </div>
            </div>
            
            <div class="summary-item">
                <i class="fas fa-money-bill-wave text-primary"></i>
                <div>
                    <strong>Certificate Fee</strong>
                    <p>$<?= esc($wedCert['certificate_cost'] ?? '0.00') ?> 
                    (<?= esc(ucfirst($wedCert['certificate_cost_words'] ?? 'zero dollars')) ?>)</p>
                </div>
            </div>
        </div>

        <div class="certificate-parties">
            <div class="row">
                <!-- Groom Information -->
                <div class="col-md-6">
                    <div class="party-card groom-card">
                        <div class="party-header">
                            <i class="fas fa-male me-2"></i>
                            Groom Information
                        </div>
                        <div class="party-body">
                            <div class="info-row">
                                <span class="info-label">Full Name:</span>
                                <span class="info-value"><?= esc($wedCert['groom_name'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Date of Birth:</span>
                                <span class="info-value">
                                    <?= !empty($wedCert['groom_dob']) ? date('F j, Y', strtotime($wedCert['groom_dob'])) : 'N/A' ?>
                                    (Age: <?= esc($wedCert['groom_age'] ?? 'N/A') ?>)
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Birthplace:</span>
                                <span class="info-value"><?= esc(($wedCert['groom_birth_city'] ?? '') . ', ' . ($wedCert['groom_birth_county'] ?? '')) ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Nationality:</span>
                                <span class="info-value"><?= esc($wedCert['groom_nationality'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Address:</span>
                                <span class="info-value"><?= esc($wedCert['groom_address'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Father:</span>
                                <span class="info-value"><?= esc($wedCert['groom_father_name'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Mother:</span>
                                <span class="info-value"><?= esc($wedCert['groom_mother_name'] ?? 'N/A') ?></span>
                            </div>
                            
                            <?php if (!empty($wedCert['groom_passport_photo'])): ?>
                            <div class="photo-section">
                                <img src="<?= base_url('uploads/marriage/' . esc($wedCert['groom_passport_photo'])) ?>" 
                                     class="party-photo" alt="Groom Photo">
                                <small class="photo-caption">Groom's Photo</small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Bride Information -->
                <div class="col-md-6">
                    <div class="party-card bride-card">
                        <div class="party-header">
                            <i class="fas fa-female me-2"></i>
                            Bride Information
                        </div>
                        <div class="party-body">
                            <div class="info-row">
                                <span class="info-label">Full Name:</span>
                                <span class="info-value"><?= esc($wedCert['bride_name'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Date of Birth:</span>
                                <span class="info-value">
                                    <?= !empty($wedCert['bride_dob']) ? date('F j, Y', strtotime($wedCert['bride_dob'])) : 'N/A' ?>
                                    (Age: <?= esc($wedCert['bride_age'] ?? 'N/A') ?>)
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Birthplace:</span>
                                <span class="info-value"><?= esc(($wedCert['bride_birth_city'] ?? '') . ', ' . ($wedCert['bride_birth_county'] ?? '')) ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Nationality:</span>
                                <span class="info-value"><?= esc($wedCert['bride_nationality'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Address:</span>
                                <span class="info-value"><?= esc($wedCert['bride_address'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Father:</span>
                                <span class="info-value"><?= esc($wedCert['bride_father_name'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Mother:</span>
                                <span class="info-value"><?= esc($wedCert['bride_mother_name'] ?? 'N/A') ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Proposed Name:</span>
                                <span class="info-value"><?= esc($wedCert['bride_proposed_name'] ?? 'N/A') ?></span>
                            </div>
                            
                            <?php if (!empty($wedCert['bride_passport_photo'])): ?>
                            <div class="photo-section">
                                <img src="<?= base_url('uploads/marriage/' . esc($wedCert['bride_passport_photo'])) ?>" 
                                     class="party-photo" alt="Bride Photo">
                                <small class="photo-caption">Bride's Photo</small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="certificate-officials">
            <div class="officials-header">
                <i class="fas fa-users me-2"></i>
                Certificate Officials & Witness
            </div>
            <div class="officials-grid">
                <div class="official-item">
                    <i class="fas fa-user-check text-success"></i>
                    <div>
                        <strong>Witness</strong>
                        <p><?= esc($wedCert['witness_name'] ?? 'N/A') ?></p>
                        <small><?= esc($wedCert['witness_contact'] ?? '') ?></small>
                    </div>
                </div>
                
                <div class="official-item">
                    <i class="fas fa-user-tie text-primary"></i>
                    <div>
                        <strong>Officiated By</strong>
                        <p><?= esc($wedCert['officiator_name'] ?? 'N/A') ?></p>
                        <small><?= esc($wedCert['officiator_contact'] ?? '') ?></small>
                    </div>
                </div>
                
                <div class="official-item">
                    <i class="fas fa-gavel text-warning"></i>
                    <div>
                        <strong>Declared By</strong>
                        <p><?= esc($wedCert['declarant_name'] ?? 'N/A') ?></p>
                        <small>on <?= !empty($wedCert['declaration_date']) ? date('F j, Y', strtotime($wedCert['declaration_date'])) : 'N/A' ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: ?>
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle me-2"></i>
    No wedding certificate data available.
</div>
<?php endif; ?>
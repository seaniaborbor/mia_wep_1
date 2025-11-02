<?php if (!empty($wedCert) && is_array($wedCert)): ?>
    <?php 
    // Check if all three signatures are present
    $hasAllSignatures = !empty($wedCert['SIGNA']) && !empty($wedCert['SIGNB']) && !empty($wedCert['SIGNC']);
    ?>
    
    <?php if ($hasAllSignatures): ?>
        <!-- Display full certificate information when all signatures are present -->
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

                <!-- Signature Status Section -->
                <div class="signature-status mt-4">
                    <div class="status-header">
                        <i class="fas fa-signature me-2"></i>
                        Signature Status
                    </div>
                    <div class="status-grid">
                        <div class="status-item status-complete">
                            <i class="fas fa-check-circle text-success"></i>
                            <div>
                                <strong>Signature A</strong>
                                <p>Completed on <?= !empty($wedCert['SIGNA_signedDate']) ? date('F j, Y', strtotime($wedCert['SIGNA_signedDate'])) : 'N/A' ?></p>
                            </div>
                        </div>
                        <div class="status-item status-complete">
                            <i class="fas fa-check-circle text-success"></i>
                            <div>
                                <strong>Signature B</strong>
                                <p>Completed on <?= !empty($wedCert['SIGNB_signedDate']) ? date('F j, Y', strtotime($wedCert['SIGNB_signedDate'])) : 'N/A' ?></p>
                            </div>
                        </div>
                        <div class="status-item status-complete">
                            <i class="fas fa-check-circle text-success"></i>
                            <div>
                                <strong>Signature C</strong>
                                <p>Completed on <?= !empty($wedCert['SIGNC_signedDate']) ? date('F j, Y', strtotime($wedCert['SIGNC_signedDate'])) : 'N/A' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Display processing card when signatures are missing -->
        <div class="certificate-processing-card w-100">
            <div class="processing-header">
                <i class="fas fa-clock me-2"></i>
                Certificate Processing
                <span class="processing-badge">In Progress</span>
            </div>
            
            <div class="processing-body">
                <div class="processing-icon">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                
                <h3 class="processing-title">Certificate is Being Processed</h3>
                
                <p class="processing-text">
                    Your marriage certificate is currently undergoing the final approval process. 
                    We are waiting for the required signatures to complete the certification.
                </p>

                <div class="reference-info">
                    <strong>Reference Number:</strong> 
                    <span class="reference-code"><?= esc($wedCert['marriage_code'] ?? 'N/A') ?></span>
                </div>

                <!-- Signature Progress -->
                <div class="signature-progress mt-4">
                    <h5>Signature Progress</h5>
                    <div class="progress-list">
                        <div class="progress-item <?= !empty($wedCert['SIGNA']) ? 'completed' : 'pending' ?>">
                            <i class="fas <?= !empty($wedCert['SIGNA']) ? 'fa-check-circle text-success' : 'fa-clock text-warning' ?>"></i>
                            <span>Signature A <?= !empty($wedCert['SIGNA']) ? '✓' : '⏳' ?></span>
                        </div>
                        <div class="progress-item <?= !empty($wedCert['SIGNB']) ? 'completed' : 'pending' ?>">
                            <i class="fas <?= !empty($wedCert['SIGNB']) ? 'fa-check-circle text-success' : 'fa-clock text-warning' ?>"></i>
                            <span>Signature B <?= !empty($wedCert['SIGNB']) ? '✓' : '⏳' ?></span>
                        </div>
                        <div class="progress-item <?= !empty($wedCert['SIGNC']) ? 'completed' : 'pending' ?>">
                            <i class="fas <?= !empty($wedCert['SIGNC']) ? 'fa-check-circle text-success' : 'fa-clock text-warning' ?>"></i>
                            <span>Signature C <?= !empty($wedCert['SIGNC']) ? '✓' : '⏳' ?></span>
                        </div>
                    </div>
                </div>

                <div class="processing-note mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        You will be notified once all signatures are completed and your certificate is ready.
                    </small>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <!-- No data available -->
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i>
        No wedding certificate data available.
    </div>
<?php endif; ?>

<style>
    
    /* Certificate Page Styling */
.certificate-result-card, .certificate-processing-card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px auto;
    max-width: 900px;
    animation: fadeIn 0.8s ease-in-out;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.certificate-result-card:hover, .certificate-processing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.certificate-header-success, .processing-header {
    background: linear-gradient(135deg, #e8f0fe 0%, #f7fafc 100%);
    padding: 15px;
    border-radius: 8px 8px 0 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.certificate-badge, .processing-badge {
    background: #48bb78;
    color: #fff;
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 0.9rem;
    animation: pulse 2s infinite;
}

.certificate-body, .processing-body {
    padding: 20px;
    animation: slideIn 0.6s ease-in-out;
}

.summary-item, .official-item, .status-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    transition: background 0.3s ease;
    padding: 10px;
    border-radius: 6px;
}

.summary-item:hover, .official-item:hover, .status-item:hover {
    background: #f7fafc;
}

.summary-item i, .official-item i, .status-item i {
    margin-right: 10px;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.summary-item:hover i, .official-item:hover i, .status-item:hover i {
    transform: scale(1.2);
}

.party-card {
    background: #f9fafb;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.party-card:hover {
    transform: translateY(-3px);
}

.party-header {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 10px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 5px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.info-label {
    color: #4a5568;
    font-weight: 500;
    width: 40%;
}

.info-value {
    color: #2d3748;
    width: 60%;
}

.party-photo {
    max-width: 100px;
    border-radius: 8px;
    margin-top: 10px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.party-photo:hover {
    transform: scale(1.05);
    opacity: 0.9;
}

.photo-caption {
    color: #718096;
    font-size: 0.85rem;
    text-align: center;
    margin-top: 5px;
}

.officials-header, .status-header {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2d3748;
    margin: 20px 0 10px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 5px;
}

.officials-grid, .status-grid {
    display grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.progress-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.progress-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 6px;
    transition: background 0.3s ease;
}

.progress-item.completed {
    background: #e6fffa;
}

.progress-item.pending {
    background: #fffaf0;
}

.progress-item i {
    margin-right: 10px;
}

.processing-icon {
    text-align: center;
    margin-bottom: 15px;
}

.processing-icon i {
    font-size: 2.5rem;
    color: #4a5568;
}

.processing-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2d3748;
    text-align: center;
}

.processing-text {
    color: #718096;
    font-size: 0.95rem;
    text-align: center;
    margin-bottom: 15px;
}

.reference-info {
    text-align: center;
    font-size: 1rem;
    color: #2d3748;
}

.reference-code {
    font-weight: 600;
    color: #2b6cb0;
}

.alert-warning {
    background: #fffaf0;
    border: 1px solid #f6e05e;
    color: #744210;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    animation: fadeIn 0.8s ease-in-out;
}

/* Keyframe Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}


</style>
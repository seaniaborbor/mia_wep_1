<?php if (!empty($wedCert) && is_array($wedCert)): ?>
    <?php 
    // Check if all three signatures are present
    $hasAllSignatures = !empty($wedCert['SIGNA']) && !empty($wedCert['SIGNB']) && !empty($wedCert['SIGNC']);
    ?>
    
    <?php if ($hasAllSignatures): ?>
        <!-- Display full certificate information when all signatures are present -->
        <div class="certificate-container">
            <div class="card shadow-lg border-liberia-blue mb-3 certificate-card">
                <div class="card-header bg-liberia-blue-gradient text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-ring me-2 shine"></i>Verified Marriage Certificate</h3>
                        <div class="verified-badge">
                            <i class="fas fa-shield-check"></i>
                            VALID
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Animated Ribbon -->
                    <div class="ribbon ribbon-top-right"><span>OFFICIAL</span></div>
                    
                    <!-- Reference Number -->
                    <div class="certificate-reference text-center mb-4">
                        <h4 class="text-liberia-blue certificate-title">
                            Reference No: <span class="reference-code highlight-text"><?= esc($wedCert['marriage_code'] ?? 'N/A') ?></span>
                        </h4>
                    </div>

                    <!-- Summary Section -->
                    <div class="summary-section mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="summary-card bounce-in">
                                    <i class="fas fa-map-marker-alt text-liberia-red"></i>
                                    <div>
                                        <strong>Place of Marriage</strong>
                                        <p><?= esc($wedCert['place_of_marriage'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="summary-card bounce-in" style="animation-delay: 0.2s;">
                                    <i class="fas fa-calendar-alt text-liberia-blue"></i>
                                    <div>
                                        <strong>Date of Marriage</strong>
                                        <p><?= !empty($wedCert['date_of_marriage']) ? date('F j, Y', strtotime($wedCert['date_of_marriage'])) : 'N/A' ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="summary-card bounce-in" style="animation-delay: 0.4s;">
                                    <i class="fas fa-money-bill-wave text-liberia-red"></i>
                                    <div>
                                        <strong>Certificate Fee</strong>
                                        <p>$<?= esc($wedCert['certificate_cost'] ?? '0.00') ?></p>
                                        <small>(<?= esc(ucfirst($wedCert['certificate_cost_words'] ?? 'zero dollars')) ?>)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Couple Information - Simplified -->
                    <div class="certificate-parties mb-4">
                        <div class="row">
                            <!-- Groom Information -->
                            <div class="col-md-6">
                                <div class="party-card groom-card slide-in">
                                    <div class="party-header bg-liberia-blue-gradient text-white">
                                        <i class="fas fa-male me-2"></i>
                                        Groom Information
                                    </div>
                                    <div class="party-body">
                                        <div class="couple-info-grid">
                                            <div class="info-item">
                                                <i class="fas fa-user text-liberia-blue"></i>
                                                <div>
                                                    <strong>Full Name</strong>
                                                    <p><?= esc($wedCert['groom_name'] ?? 'N/A') ?></p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-birthday-cake text-liberia-red"></i>
                                                <div>
                                                    <strong>Date of Birth</strong>
                                                    <p><?= !empty($wedCert['groom_dob']) ? date('F j, Y', strtotime($wedCert['groom_dob'])) : 'N/A' ?></p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-flag text-liberia-blue"></i>
                                                <div>
                                                    <strong>Nationality</strong>
                                                    <p><?= esc($wedCert['groom_nationality'] ?? 'N/A') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($wedCert['groom_passport_photo'])): ?>
                                        <div class="photo-section mt-3 text-center">
                                            <img src="<?= base_url('uploads/marriage/' . esc($wedCert['groom_passport_photo'])) ?>" 
                                                 class="party-photo floating" alt="Groom Photo">
                                            <small class="photo-caption">Groom's Photo</small>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Bride Information -->
                            <div class="col-md-6">
                                <div class="party-card bride-card slide-in" style="animation-delay: 0.3s;">
                                    <div class="party-header bg-liberia-red-gradient text-white">
                                        <i class="fas fa-female me-2"></i>
                                        Bride Information
                                    </div>
                                    <div class="party-body">
                                        <div class="couple-info-grid">
                                            <div class="info-item">
                                                <i class="fas fa-user text-liberia-red"></i>
                                                <div>
                                                    <strong>Full Name</strong>
                                                    <p><?= esc($wedCert['bride_name'] ?? 'N/A') ?></p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-birthday-cake text-liberia-blue"></i>
                                                <div>
                                                    <strong>Date of Birth</strong>
                                                    <p><?= !empty($wedCert['bride_dob']) ? date('F j, Y', strtotime($wedCert['bride_dob'])) : 'N/A' ?></p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-flag text-liberia-red"></i>
                                                <div>
                                                    <strong>Nationality</strong>
                                                    <p><?= esc($wedCert['bride_nationality'] ?? 'N/A') ?></p>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-signature text-liberia-blue"></i>
                                                <div>
                                                    <strong>Proposed Name</strong>
                                                    <p><?= esc($wedCert['bride_proposed_name'] ?? 'N/A') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($wedCert['bride_passport_photo'])): ?>
                                        <div class="photo-section mt-3 text-center">
                                            <img src="<?= base_url('uploads/marriage/' . esc($wedCert['bride_passport_photo'])) ?>" 
                                                 class="party-photo floating" alt="Bride Photo">
                                            <small class="photo-caption">Bride's Photo</small>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Officials Section -->
                    <div class="officials-section mt-4 pt-4 border-top">
                        <h6 class="text-liberia-blue mb-3 signature-title"><i class="fas fa-users me-2"></i>Certificate Officials & Witness</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="official-card bounce-in">
                                    <i class="fas fa-user-check text-success"></i>
                                    <div>
                                        <strong>Witness</strong>
                                        <p><?= esc($wedCert['witness_name'] ?? 'N/A') ?></p>
                                        <small><?= esc($wedCert['witness_contact'] ?? '') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="official-card bounce-in" style="animation-delay: 0.2s;">
                                    <i class="fas fa-user-tie text-liberia-blue"></i>
                                    <div>
                                        <strong>Officiated By</strong>
                                        <p><?= esc($wedCert['officiator_name'] ?? 'N/A') ?></p>
                                        <small><?= esc($wedCert['officiator_contact'] ?? '') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="official-card bounce-in" style="animation-delay: 0.4s;">
                                    <i class="fas fa-gavel text-liberia-red"></i>
                                    <div>
                                        <strong>Declared By</strong>
                                        <p><?= esc($wedCert['declarant_name'] ?? 'N/A') ?></p>
                                        <small>on <?= !empty($wedCert['declaration_date']) ? date('F j, Y', strtotime($wedCert['declaration_date'])) : 'N/A' ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signatures Section -->
                    <div class="signatures-section mt-4 pt-4 border-top">
                        <h6 class="text-liberia-blue mb-3 signature-title"><i class="fas fa-signature me-2"></i>Authorized Signatures</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="signature-card bounce-in">
                                    <div class="signature-img-container">
                                        <img src="<?= base_url('uploads/signatures/' . esc($wedCert['SIGNA'])) ?>" alt="Signature A" class="signature-img">
                                    </div>
                                    <div class="signature-date">Signed: <?= !empty($wedCert['SIGNA_signedDate']) ? date('F j, Y', strtotime($wedCert['SIGNA_signedDate'])) : 'N/A' ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="signature-card bounce-in" style="animation-delay: 0.2s;">
                                    <div class="signature-img-container">
                                        <img src="<?= base_url('uploads/signatures/' . esc($wedCert['SIGNB'])) ?>" alt="Signature B" class="signature-img">
                                    </div>
                                    <div class="signature-date">Signed: <?= !empty($wedCert['SIGNB_signedDate']) ? date('F j, Y', strtotime($wedCert['SIGNB_signedDate'])) : 'N/A' ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="signature-card bounce-in" style="animation-delay: 0.4s;">
                                    <div class="signature-img-container">
                                        <img src="<?= base_url('uploads/signatures/' . esc($wedCert['SIGNC'])) ?>" alt="Signature C" class="signature-img">
                                    </div>
                                    <div class="signature-date">Signed: <?= !empty($wedCert['SIGNC_signedDate']) ? date('F j, Y', strtotime($wedCert['SIGNC_signedDate'])) : 'N/A' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Display processing card when signatures are missing -->
        <div class="processing-container">
            <div class="card shadow-lg border-liberia-red mb-3 processing-card">
                <div class="card-header bg-liberia-red-gradient text-white">
                    <h3><i class="fas fa-clock me-2 pulse"></i>Certificate Processing</h3>
                </div>
                <div class="card-body text-center">
                    <div class="processing-animation">
                        <div class="document-icon">
                            <i class="fas fa-ring"></i>
                            <div class="pulse-ring"></div>
                            <div class="pulse-ring delay-1"></div>
                            <div class="pulse-ring delay-2"></div>
                        </div>
                    </div>
                    <h4 class="text-liberia-blue mb-3 slide-in">Marriage Certificate Under Review</h4>
                    <p class="text-muted mb-4 fade-in">
                        Your marriage certificate is currently undergoing the final approval process. 
                        We are waiting for the required signatures to complete the certification.
                    </p>

                    <div class="alert alert-liberia-light border-liberia-blue status-alert">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Reference Number:</strong> 
                                <span class="text-liberia-blue"><?= esc($wedCert['marriage_code'] ?? 'N/A') ?></span>
                            </div>
                            <div>
                                <strong>Status:</strong> 
                                <span class="badge bg-liberia-red pulse-badge">Awaiting Signatures</span>
                            </div>
                        </div>
                    </div>

                    <!-- Signature Progress -->
                    <div class="signature-progress mt-4">
                        <h6 class="text-liberia-blue mb-3">Signature Progress</h6>
                        <div class="progress-list">
                            <div class="progress-item <?= !empty($wedCert['SIGNA']) ? 'completed' : 'pending' ?> bounce-in">
                                <i class="fas <?= !empty($wedCert['SIGNA']) ? 'fa-check-circle text-success' : 'fa-clock text-warning' ?>"></i>
                                <span>Signature A <?= !empty($wedCert['SIGNA']) ? '✓ Completed' : '⏳ Pending' ?></span>
                                <?php if (!empty($wedCert['SIGNA_signedDate'])): ?>
                                <small class="text-muted">on <?= date('M j, Y', strtotime($wedCert['SIGNA_signedDate'])) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="progress-item <?= !empty($wedCert['SIGNB']) ? 'completed' : 'pending' ?> bounce-in" style="animation-delay: 0.2s;">
                                <i class="fas <?= !empty($wedCert['SIGNB']) ? 'fa-check-circle text-success' : 'fa-clock text-warning' ?>"></i>
                                <span>Signature B <?= !empty($wedCert['SIGNB']) ? '✓ Completed' : '⏳ Pending' ?></span>
                                <?php if (!empty($wedCert['SIGNB_signedDate'])): ?>
                                <small class="text-muted">on <?= date('M j, Y', strtotime($wedCert['SIGNB_signedDate'])) ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="progress-item <?= !empty($wedCert['SIGNC']) ? 'completed' : 'pending' ?> bounce-in" style="animation-delay: 0.4s;">
                                <i class="fas <?= !empty($wedCert['SIGNC']) ? 'fa-check-circle text-success' : 'fa-clock text-warning' ?>"></i>
                                <span>Signature C <?= !empty($wedCert['SIGNC']) ? '✓ Completed' : '⏳ Pending' ?></span>
                                <?php if (!empty($wedCert['SIGNC_signedDate'])): ?>
                                <small class="text-muted">on <?= date('M j, Y', strtotime($wedCert['SIGNC_signedDate'])) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="progress-container mt-4">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                                 style="width: <?= (($wedCert['SIGNA'] ? 1 : 0) + ($wedCert['SIGNB'] ? 1 : 0) + ($wedCert['SIGNC'] ? 1 : 0)) / 3 * 100 ?>%">
                            </div>
                        </div>
                        <small class="text-muted mt-2">
                            <i class="fas fa-sync-alt fa-spin me-1"></i>
                            Finalizing document verification
                        </small>
                    </div>

                    <div class="processing-note mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            You will be notified once all signatures are completed and your certificate is ready.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php else: ?>
    <!-- No data available -->
    <div class="alert alert-liberia-red shake">
        <i class="fas fa-exclamation-triangle me-2"></i>
        No wedding certificate data available.
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

/* Card Animations */
.certificate-card {
    animation: slideUp 0.6s ease-out;
    position: relative;
    overflow: hidden;
}

.processing-card {
    animation: fadeIn 0.8s ease-out;
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

/* Verified Badge */
.verified-badge {
    background: rgba(255, 255, 255, 0.2);
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    backdrop-filter: blur(10px);
}

/* Summary Cards */
.summary-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border: 2px solid var(--liberia-light-blue);
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.summary-card:hover {
    transform: translateY(-5px);
    border-color: var(--liberia-blue);
    box-shadow: 0 5px 15px rgba(0, 40, 104, 0.2);
}

.summary-card i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
}

/* Party Cards - Simplified */
.party-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.party-card:hover {
    transform: translateY(-5px);
}

.party-header {
    padding: 15px;
    font-weight: 600;
}

.party-body {
    padding: 20px;
}

/* Couple Info Grid - Simplified */
.couple-info-grid {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 8px;
    background: var(--liberia-light-blue);
    transition: all 0.3s ease;
}

.info-item:hover {
    background: rgba(0, 40, 104, 0.15);
    transform: translateX(5px);
}

.info-item i {
    font-size: 1.5rem;
    margin-right: 15px;
    width: 30px;
    text-align: center;
}

.info-item div {
    flex: 1;
}

.info-item strong {
    display: block;
    font-size: 0.9rem;
    color: var(--liberia-blue);
    margin-bottom: 2px;
}

.info-item p {
    margin: 0;
    font-weight: 500;
    color: #2d3748;
}

.party-photo {
    max-width: 120px;
    border-radius: 8px;
    border: 3px solid var(--liberia-blue);
    transition: all 0.3s ease;
}

.party-photo:hover {
    border-color: var(--liberia-red);
    transform: scale(1.05);
}

.photo-caption {
    color: #718096;
    font-size: 0.85rem;
    text-align: center;
    margin-top: 5px;
}

/* Official Cards */
.official-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    border: 2px solid var(--liberia-light-blue);
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.official-card:hover {
    transform: translateY(-3px);
    border-color: var(--liberia-blue);
}

.official-card i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
}

/* Signature Cards */
.signature-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border: 2px solid var(--liberia-light-blue);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.signature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 40, 104, 0.1), transparent);
    transition: left 0.5s;
}

.signature-card:hover::before {
    left: 100%;
}

.signature-card:hover {
    border-color: var(--liberia-blue);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 40, 104, 0.2);
}

.signature-img-container {
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
}

.signature-img {
    max-height: 100%;
    filter: brightness(0.9);
    transition: transform 0.3s ease;
}

.signature-card:hover .signature-img {
    transform: scale(1.1);
}

.signature-date {
    font-size: 0.85rem;
    color: #718096;
}

/* Processing Animation */
.processing-animation {
    position: relative;
    margin: 30px 0;
}

.document-icon {
    position: relative;
    font-size: 4rem;
    color: var(--liberia-blue);
    z-index: 2;
}

.pulse-ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border: 2px solid var(--liberia-blue);
    border-radius: 50%;
    animation: pulse 2s infinite;
    opacity: 0;
}

.pulse-ring.delay-1 {
    animation-delay: 0.7s;
}

.pulse-ring.delay-2 {
    animation-delay: 1.4s;
}

/* Progress Items */
.progress-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.progress-item {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.progress-item.completed {
    background: var(--liberia-light-blue);
    border-left-color: var(--liberia-blue);
}

.progress-item.pending {
    background: var(--liberia-light-red);
    border-left-color: var(--liberia-red);
}

.progress-item i {
    margin-right: 15px;
    font-size: 1.2rem;
}

/* Progress Bar */
.progress-container {
    max-width: 400px;
    margin: 0 auto;
}

.progress-bar {
    background: linear-gradient(90deg, var(--liberia-blue), var(--liberia-red));
}

/* Alert Variations */
.alert-liberia-red {
    background-color: var(--liberia-light-red);
    border-color: var(--liberia-red);
    color: var(--liberia-red);
}

.alert-liberia-light {
    background-color: var(--liberia-light-blue);
    border-color: var(--liberia-blue);
}

.status-alert {
    border-radius: 10px;
    border-width: 2px;
}

/* Titles */
.certificate-title {
    border-bottom: 2px solid var(--liberia-light-blue);
    padding-bottom: 10px;
}

.signature-title {
    position: relative;
    display: inline-block;
}

.signature-title::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, var(--liberia-blue), var(--liberia-red));
    border-radius: 2px;
}

/* Highlight Text */
.highlight-text {
    background: linear-gradient(120deg, transparent 0%, var(--liberia-light-blue) 50%, transparent 100%);
    padding: 2px 8px;
    border-radius: 4px;
    font-weight: 600;
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
        transform: translate(-50%, -50%) scale(2);
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

@keyframes floating {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
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

.floating {
    animation: floating 3s ease-in-out infinite;
}

.pulse-badge {
    animation: pulse 1.5s infinite;
}
</style>
<?php if (!empty($divoCert)): ?>
    <?php
    // Check if all signatories are present
    $hasAllSignatories = !empty($divoCert['divorceSIGN_A']) && 
                        !empty($divoCert['divorceSIGN_B']) && 
                        !empty($divoCert['divorceSIGN_C']);
    ?>
    
    <?php if ($hasAllSignatories): ?>
        <!-- Display the full certificate when all signatories are present -->
        <div class="certificate-container">
            <div class="card shadow-lg border-liberia-blue mb-3 certificate-card">
                <div class="card-header bg-liberia-blue-gradient text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-check-circle me-2 shine"></i>Divorce Certificate Verified</h3>
                        <div class="verified-badge">
                            <i class="fas fa-shield-check"></i>
                            VERIFIED
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Animated Ribbon -->
                    <div classribbon ribbon-top-right"><span>OFFICIAL</span></div>
                    
                    <h5 class="card-title text-liberia-blue certificate-title">Reference No: <?= esc($divoCert['divorceRefNo']) ?></h5>
                    <p class="card-text">
                        <strong>Certificate Code:</strong> <span class="highlight-text"><?= esc($divoCert['divorceCode']) ?></span><br>
                        <strong>Rev. Number:</strong> <span class="highlight-text"><?= esc($divoCert['divorceRevNo']) ?></span><br><br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="party-card">
                                    <strong>Plaintiff:</strong> <?= esc($divoCert['divorceplaintiff']) ?><br>
                                    <img src="<?= base_url('uploads/divorce/' . esc($divoCert['divorceplaintiffPic'])) ?>" alt="Plaintiff Photo" class="img-thumbnail party-photo floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="party-card">
                                    <strong>Defendant:</strong> <?= esc($divoCert['divorcedefendant']) ?><br>
                                    <img src="<?= base_url('uploads/divorce/' . esc($divoCert['divorcedefendantPic'])) ?>" alt="Defendant Photo" class="img-thumbnail party-photo floating">
                                </div>
                            </div>
                        </div>

                        <div class="dates-section mt-4">
                            <div class="date-item">
                                <i class="fas fa-ring text-liberia-blue"></i>
                                <strong>Marriage Date:</strong> <?= date('F d, Y', strtotime($divoCert['divorcemarriageDate'])) ?>
                            </div>
                            <div class="date-item">
                                <i class="fas fa-gavel text-liberia-red"></i>
                                <strong>Date of Divorce:</strong> <?= date('F d, Y', strtotime($divoCert['divorcedateOfDivorce'])) ?>
                            </div>
                            <div class="date-item">
                                <i class="fas fa-calendar-check text-liberia-blue"></i>
                                <strong>Date of Issuance:</strong> <?= date('F d, Y', strtotime($divoCert['divorceissuanceDate'])) ?>
                            </div>
                        </div>
                    </p>
                    
                    <!-- Signatories Section -->
                    <div class="signatures-section mt-4 pt-4 border-top">
                        <h6 class="text-liberia-blue mb-3 signature-title"><i class="fas fa-signature me-2"></i>Authorized Signatories</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="signature-card bounce-in">
                                    <div class="signature-img-container">
                                        <img src="<?= base_url('uploads/signatures/' . esc($divoCert['divorceSIGN_A'])) ?>" alt="Signature A" class="signature-img">
                                    </div>
                                    <div class="signature-date">Signed: <?= date('M d, Y', strtotime($divoCert['divorceSIGN_A_DATE_SIGNED'])) ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="signature-card bounce-in" style="animation-delay: 0.2s;">
                                    <div class="signature-img-container">
                                        <img src="<?= base_url('uploads/signatures/' . esc($divoCert['divorceSIGN_B'])) ?>" alt="Signature B" class="signature-img">
                                    </div>
                                    <div class="signature-date">Signed: <?= date('M d, Y', strtotime($divoCert['divorceSIGN_B_DATE_SIGNED'])) ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="signature-card bounce-in" style="animation-delay: 0.4s;">
                                    <div class="signature-img-container">
                                        <img src="<?= base_url('uploads/signatures/' . esc($divoCert['divorceSIGN_C'])) ?>" alt="Signature C" class="signature-img">
                                    </div>
                                    <div class="signature-date">Signed: <?= date('M d, Y', strtotime($divoCert['divorceSIGN_C_DATE_SIGNED'])) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Display processing card when signatories are missing -->
        <div class="processing-container">
            <div class="card shadow-lg border-liberia-red mb-3 processing-card">
                <div class="card-header bg-liberia-red-gradient text-white">
                    <h3><i class="fas fa-clock me-2 pulse"></i>Certificate Processing</h3>
                </div>
                <div class="card-body text-center">
                    <div class="processing-animation">
                        <div class="document-icon">
                            <i class="fas fa-file-contract"></i>
                            <div class="pulse-ring"></div>
                            <div class="pulse-ring delay-1"></div>
                            <div class="pulse-ring delay-2"></div>
                        </div>
                    </div>
                    <h4 class="text-liberia-blue mb-3 slide-in">Certificate Under Review</h4>
                    <p class="text-muted mb-4 fade-in">
                        This divorce certificate is currently undergoing the final approval process. 
                        The document requires authorized signatures before it can be fully validated.
                    </p>
                    <div class="alert alert-liberia-light border-liberia-blue status-alert">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Reference No:</strong> <span class="text-liberia-blue"><?= esc($divoCert['divorceRefNo']) ?></span>
                            </div>
                            <div>
                                <strong>Status:</strong> <span class="badge bg-liberia-red pulse-badge">Awaiting Signatures</span>
                            </div>
                        </div>
                    </div>
                    <div class="progress-container mt-4">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%"></div>
                        </div>
                        <small class="text-muted mt-2">
                            <i class="fas fa-sync-alt fa-spin me-1"></i>
                            Finalizing document verification
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="alert alert-liberia-red shake">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Divorce certificate not found or invalid reference number.
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

/* Border colors */
.border-liberia-red { border-color: var(--liberia-red) !important; }
.border-liberia-blue { border-color: var(--liberia-blue) !important; }

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

/* Party Cards */
.party-card {
    padding: 15px;
    border-radius: 10px;
    background: var(--liberia-light-blue);
    transition: transform 0.3s ease;
}

.party-card:hover {
    transform: translateY(-5px);
}

.party-photo {
    border: 3px solid var(--liberia-blue);
    transition: all 0.3s ease;
}

.party-photo:hover {
    border-color: var(--liberia-red);
    transform: scale(1.05);
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

/* Progress Bar */
.progress-container {
    max-width: 400px;
    margin: 0 auto;
}

.progress-bar {
    background: linear-gradient(90deg, var(--liberia-blue), var(--liberia-red));
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

/* Highlight Text */
.highlight-text {
    background: linear-gradient(120deg, transparent 0%, var(--liberia-light-blue) 50%, transparent 100%);
    padding: 2px 8px;
    border-radius: 4px;
}

/* Dates Section */
.dates-section {
    background: var(--liberia-light-blue);
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid var(--liberia-blue);
}

.date-item {
    padding: 8px 0;
    border-bottom: 1px solid rgba(0, 40, 104, 0.1);
}

.date-item:last-child {
    border-bottom: none;
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
</style>
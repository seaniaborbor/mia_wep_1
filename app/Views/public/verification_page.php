<?= $this->extend('public/partials/layout') ?>

<?= $this->section('main') ?>

<style>
    /* Verification Page Specific Styles */
    .verification-container {
        min-height: 80vh;
        padding: 60px 0;
        background: linear-gradient(135deg, rgba(0, 35, 102, 0.03) 0%, rgba(191, 10, 48, 0.03) 100%);
    }
    
    .verification-card {
        background: var(--liberia-white);
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 35, 102, 0.1);
        padding: 40px;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .verification-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .verification-header {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .verification-title {
        color: var(--liberia-blue);
        font-weight: 700;
        margin-bottom: 10px;
        font-family: 'Merriweather', serif;
        font-size: 2.2rem;
    }
    
    .verification-subtitle {
        color: #666;
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--liberia-blue);
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    
    .futuristic-input {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px 20px;
        font-size: 1.1rem;
        transition: all 0.3s;
        height: 60px;
    }
    
    .futuristic-input:focus {
        border-color: var(--liberia-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 35, 102, 0.15);
    }
    
    .btn-accent {
        background: var(--liberia-blue);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 15px 40px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s;
    }
    
    .btn-accent:hover {
        background: var(--liberia-red);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .result-card {
        background: var(--liberia-white);
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 35, 102, 0.1);
        padding: 40px;
        transition: all 0.3s ease;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .result-placeholder {
        text-align: center;
        color: #999;
    }
    
    .result-placeholder i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: var(--liberia-light-blue);
    }
    
    .result-placeholder h3 {
        color: var(--liberia-blue);
        margin-bottom: 10px;
        font-family: 'Merriweather', serif;
    }
    
    /* Certificate Result Styles */
    .certificate-result {
        width: 100%;
    }
    
    .certificate-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--liberia-light-blue);
    }
    
    .certificate-title {
        color: var(--liberia-blue);
        font-weight: 700;
        margin-bottom: 10px;
        font-family: 'Merriweather', serif;
        font-size: 1.8rem;
    }
    
    .certificate-id {
        color: var(--liberia-red);
        font-weight: 600;
        font-size: 1.1rem;
        background: rgba(191, 10, 48, 0.1);
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
    }
    
    .certificate-details {
        margin-bottom: 30px;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .detail-label {
        font-weight: 600;
        color: var(--liberia-blue);
        flex: 1;
    }
    
    .detail-value {
        flex: 2;
        color: #333;
    }
    
    .certificate-status {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }
    
    .status-valid {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }
    
    .status-invalid {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.2);
    }
    
    .status-pending {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.2);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .verification-container {
            padding: 40px 0;
        }
        
        .verification-card, .result-card {
            padding: 30px 20px;
        }
        
        .verification-title {
            font-size: 1.8rem;
        }
        
        .futuristic-input {
            height: 55px;
            font-size: 1rem;
        }
        
        .detail-row {
            flex-direction: column;
        }
        
        .detail-value {
            margin-top: 5px;
        }
    }

    
</style>

<div class="verification-container">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <!-- Left: Form Column -->
            <div class="col-md-4 <?=$hide_form?>">
                <div class="verification-card">
                    <div class="verification-header">
                        <h3 class="verification-title">🔐 Authenticate Certificate</h3>
                    </div>
                    
                    <form id="certificateForm">
                        <div class="mb-4">
                            <label for="certificateId" class="form-label">Certificate ID</label>
                            <input type="text" class="form-control futuristic-input" id="cc" name="cc" minlength="5" required placeholder="e.g. ABC123XYZ">
                        </div>

                        <div class="mb-4">
                            <label for="certificateType" class="form-label">Certificate Type</label>
                            <select class="form-select futuristic-input" id="certificateType" name="toc" required>
                                <option value="" disabled selected>Select certificate type</option>
                                <option value="w">Marriage Certificate</option>
                                <option value="d">Divorce Certificate</option>
                                <option value="b">Bachelor Certificate</option>
                                <option value="s">Spinster Certificate</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn-accent btn-lg px-5">
                                <i class="fas fa-search me-2"></i> Verify Certificate
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Dynamic cards will be injected here -->
            <div class="col-md-8 mt-5 mt-md-0">
                <?php if(isset($file_to_include) && !empty($file_to_include)): ?>
                    <?php include($file_to_include); ?>
                <?php else: ?>
                    <div class="result-card">
                        <div class="result-placeholder">
                            <i class="fas fa-certificate"></i>
                            <h3>Certificate Verification</h3>
                            <p>Enter certificate details to verify authenticity</p>
                            <p class="small text-muted mt-3">Results will appear here after verification</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
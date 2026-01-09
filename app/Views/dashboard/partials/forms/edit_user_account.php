<form action="/dashboard/users/edit/<?= esc($user['userId']) ?>" method="post" enctype="multipart/form-data" class="modern-form">
    <?= csrf_field() ?>

    <div class="form-grid">
        <!-- Full Name -->
        <div class="form-group">
            <label for="userFullName" class="form-label">
                <i class="fas fa-user form-icon"></i>
                Full Name
            </label>
            <input type="text" name="userFullName" id="userFullName"
                   class="form-input <?= validation_show_error('userFullName') ? 'error' : '' ?>"
                   value="<?= old('userFullName', $user['userFullName'] ?? '') ?>"
                   placeholder="Enter full name">
            <?php if (validation_show_error('userFullName')): ?>
                <div class="form-error"><?= validation_show_error('userFullName') ?></div>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="userEmail" class="form-label">
                <i class="fas fa-envelope form-icon"></i>
                Email
            </label>
            <input type="email" name="userEmail" id="userEmail" disabled
                   class="form-input disabled <?= validation_show_error('userEmail') ? 'error' : '' ?>"
                   value="<?= old('userEmail', $user['userEmail'] ?? '') ?>"
                   placeholder="Email cannot be changed">
            <?php if (validation_show_error('userEmail')): ?>
                <div class="form-error"><?= validation_show_error('userEmail') ?></div>
            <?php endif; ?>
            <small class="form-hint">Email address cannot be modified</small>
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="userPhone" class="form-label">
                <i class="fas fa-phone form-icon"></i>
                Phone Number
            </label>
            <input type="tel" name="userPhone" id="userPhone"
                   class="form-input <?= validation_show_error('userPhone') ? 'error' : '' ?>"
                   value="<?= old('userPhone', $user['userPhone'] ?? '') ?>"
                   placeholder="Enter phone number">
            <?php if (validation_show_error('userPhone')): ?>
                <div class="form-error"><?= validation_show_error('userPhone') ?></div>
            <?php endif; ?>
        </div>

        <!-- Position -->
        <div class="form-group">
            <label for="userPosition" class="form-label">
                <i class="fas fa-briefcase form-icon"></i>
                Position
            </label>
            <input type="text" name="userPosition" id="userPosition"
                   class="form-input <?= validation_show_error('userPosition') ? 'error' : '' ?>"
                   value="<?= old('userPosition', $user['userPosition'] ?? '') ?>"
                   placeholder="Enter position">
            <?php if (validation_show_error('userPosition')): ?>
                <div class="form-error"><?= validation_show_error('userPosition') ?></div>
            <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="userPassword" class="form-label">
                <i class="fas fa-lock form-icon"></i>
                Password
            </label>
            <input type="password" name="userPassword" id="userPassword"
                   class="form-input <?= validation_show_error('userPassword') ? 'error' : '' ?>"
                   placeholder="Leave blank to keep current password">
            <?php if (validation_show_error('userPassword')): ?>
                <div class="form-error"><?= validation_show_error('userPassword') ?></div>
            <?php endif; ?>
            <small class="form-hint">Leave empty to maintain current password</small>
        </div>

        <!-- Account Status -->
        <?php if(session()->get('userData')['userAccountType'] == "SIGNC" || session()->get('userData')['userAccountType'] == "SIGNA"): ?>
        <div class="form-group">
            <label for="userAccountActiveStatus" class="form-label">
                <i class="fas fa-toggle-on form-icon"></i>
                Account Status
            </label>
            <select name="userAccountActiveStatus" id="userAccountActiveStatus"
                    class="form-select <?= validation_show_error('userAccountActiveStatus') ? 'error' : '' ?>">
                <option value="1" <?= old('userAccountActiveStatus', $user['userAccountActiveStatus'] ?? '') == '1' ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= old('userAccountActiveStatus', $user['userAccountActiveStatus'] ?? '') == '0' ? 'selected' : '' ?>>Inactive</option>
            </select>
            <?php if (validation_show_error('userAccountActiveStatus')): ?>
                <div class="form-error"><?= validation_show_error('userAccountActiveStatus') ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- File Uploads Section -->
    <div class="file-uploads-section">
        <h4 class="section-title">
            <i class="fas fa-paperclip"></i>
            File Updates
        </h4>

        <!-- Profile Picture -->
        <div class="file-upload-group">
            <div class="current-file-preview">
                <?php if (!empty($user['userPicture'])): ?>
                    <div class="current-file">
                        <img src="<?= base_url('uploads/users/pictures/' . esc($user['userPicture'])) ?>" 
                             alt="Current Profile Picture" 
                             class="current-file-image">
                        <span class="current-file-label">Current Profile Picture</span>
                    </div>
                <?php endif; ?>
            </div>
            <label for="userPicture" class="file-upload-label">
                <div class="file-upload-icon">
                    <i class="fas fa-image"></i>
                </div>
                <div class="file-upload-content">
                    <span class="file-title">Update Profile Picture</span>
                    <span class="file-subtitle"><?= !empty($user['userPicture']) ? 'Replace current image' : 'Upload profile picture' ?></span>
                </div>
            </label>
            <input type="file" name="userPicture" id="userPicture"
                   class="file-upload-input <?= validation_show_error('userPicture') ? 'error' : '' ?>"
                   accept="image/*">
            <?php if (validation_show_error('userPicture')): ?>
                <div class="form-error"><?= validation_show_error('userPicture') ?></div>
            <?php endif; ?>
        </div>

        <!-- Signature -->
        <div class="file-upload-group">
            <div class="current-file-preview">
                <?php if (!empty($user['userSignature'])): ?>
                    <div class="current-file">
                        <img src="<?= base_url('uploads/users/signatures/' . esc($user['userSignature'])) ?>" 
                             alt="Current Signature" 
                             class="current-file-image signature-preview">
                        <span class="current-file-label">Current Signature</span>
                    </div>
                <?php endif; ?>
            </div>
            <label for="userSignature" class="file-upload-label">
                <div class="file-upload-icon">
                    <i class="fas fa-pen-fancy"></i>
                </div>
                <div class="file-upload-content">
                    <span class="file-title">Update Signature</span>
                    <span class="file-subtitle"><?= !empty($user['userSignature']) ? 'Replace current signature' : 'Upload signature image' ?></span>
                </div>
            </label>
            <input type="file" name="userSignature" id="userSignature"
                   class="file-upload-input <?= validation_show_error('userSignature') ? 'error' : '' ?>"
                   accept="image/png">
            <?php if (validation_show_error('userSignature')): ?>
                <div class="form-error"><?= validation_show_error('userSignature') ?></div>
            <?php endif; ?>
        </div>

        <!-- Application File -->
        <div class="file-upload-group">
            <div class="current-file-preview">
                <?php if (!empty($user['userApplicationFile'])): ?>
                    <div class="current-file">
                        <div class="current-file-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="current-file-info">
                            <span class="current-file-label">Current Application File</span>
                            <a href="<?= base_url('uploads/users/applications/' . esc($user['userApplicationFile'])) ?>" 
                               target="_blank" 
                               class="current-file-link">
                                View Current File
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <label for="userApplicationFile" class="file-upload-label">
                <div class="file-upload-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="file-upload-content">
                    <span class="file-title">Update Application File</span>
                    <span class="file-subtitle"><?= !empty($user['userApplicationFile']) ? 'Replace current PDF' : 'Upload application PDF' ?></span>
                </div>
            </label>
            <input type="file" name="userApplicationFile" id="userApplicationFile"
                   class="file-upload-input <?= validation_show_error('userApplicationFile') ? 'error' : '' ?>"
                   accept=".pdf">
            <?php if (validation_show_error('userApplicationFile')): ?>
                <div class="form-error"><?= validation_show_error('userApplicationFile') ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
        <a href="/dashboard/users/view/<?= esc($user['userId']) ?>" class="cancel-btn">
            <span class="btn-icon">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="btn-text">Cancel</span>
        </a>
        <button type="submit" class="submit-btn">
            <span class="btn-icon">
                <i class="fas fa-save"></i>
            </span>
            <span class="btn-text">Update User Account</span>
        </button>
    </div>
</form>

<style>
/* Modern Form Styles (Same as create form) */
.modern-form {
    background: #fff;
    border-radius: 16px;
    padding: 0;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-icon {
    color: #667eea;
    font-size: 0.9rem;
    width: 16px;
}

.form-input,
.form-select {
    padding: 0.75rem 1rem;
    border: 2px solid #f1f5f9;
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: #fff;
    color: #374151;
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.form-input.disabled {
    background: #f8fafc;
    border-color: #e5e7eb;
    color: #6b7280;
    cursor: not-allowed;
}

.form-input::placeholder {
    color: #9ca3af;
}

.form-input.error,
.form-select.error {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.form-error {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.25rem;
    font-weight: 500;
}

.form-hint {
    color: #6b7280;
    font-size: 0.75rem;
    margin-top: 0.25rem;
    font-style: italic;
}

/* File Uploads Section */
.file-uploads-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #f1f5f9;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 1rem;
}

.section-title i {
    color: #667eea;
}

.file-upload-group {
    margin-bottom: 1.5rem;
}

.file-upload-group:last-child {
    margin-bottom: 0;
}

.current-file-preview {
    margin-bottom: 1rem;
}

.current-file {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    margin-bottom: 0.5rem;
}

.current-file-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #f1f5f9;
}

.signature-preview {
    background: #f8fafc;
    padding: 0.5rem;
}

.current-file-icon {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.current-file-info {
    flex: 1;
}

.current-file-label {
    display: block;
    font-weight: 600;
    color: #374151;
    font-size: 0.85rem;
    margin-bottom: 0.25rem;
}

.current-file-link {
    color: #3b82f6;
    font-size: 0.8rem;
    text-decoration: none;
    font-weight: 500;
}

.current-file-link:hover {
    text-decoration: underline;
}

.file-upload-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #fff;
    border: 2px dashed #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 0.5rem;
}

.file-upload-label:hover {
    border-color: #667eea;
    background: #fafbff;
    transform: translateY(-1px);
}

.file-upload-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.file-upload-content {
    flex: 1;
}

.file-title {
    display: block;
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.file-subtitle {
    display: block;
    color: #6b7280;
    font-size: 0.8rem;
}

.file-upload-input {
    display: none;
}

.file-upload-input.error + .file-upload-label {
    border-color: #ef4444;
    background: #fef2f2;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.cancel-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.cancel-btn:hover {
    background: #f1f5f9;
    color: #374151;
    text-decoration: none;
    transform: translateY(-1px);
}

.btn-icon {
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .file-uploads-section {
        padding: 1rem;
    }
    
    .file-upload-label {
        padding: 0.75rem;
    }
    
    .file-upload-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .submit-btn, .cancel-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .modern-form {
        border-radius: 12px;
    }
    
    .form-input,
    .form-select {
        padding: 0.65rem 0.85rem;
        font-size: 0.85rem;
    }
    
    .current-file {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .file-upload-label {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .file-upload-content {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File input feedback
    const fileInputs = document.querySelectorAll('.file-upload-input');
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            const label = e.target.previousElementSibling;
            const subtitle = label.querySelector('.file-subtitle');
            
            if (e.target.files[0]) {
                subtitle.textContent = `Selected: ${fileName}`;
                subtitle.style.color = '#10b981';
                subtitle.style.fontWeight = '600';
            } else {
                // Reset to original text based on context
                const currentFile = label.closest('.file-upload-group').querySelector('.current-file');
                const actionText = currentFile ? 'Replace current file' : 'Upload file';
                subtitle.textContent = actionText;
                subtitle.style.color = '#6b7280';
                subtitle.style.fontWeight = 'normal';
            }
        });
    });
});
</script>
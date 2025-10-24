<?php $this->extend('public/partials/layout')?>

<?=$this->section('main')?>

<style>
    /* Login Page Specific Styles */
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(0, 35, 102, 0.03) 0%, rgba(191, 10, 48, 0.03) 100%);
        padding: 40px 0;
    }
    
    .login-card {
        background: var(--liberia-white);
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 35, 102, 0.1);
        padding: 40px 30px;
        transition: all 0.3s ease;
    }
    
    .login-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-logo {
        height: 80px;
        margin-bottom: 15px;
    }
    
    .login-title {
        color: var(--liberia-blue);
        font-weight: 700;
        margin-bottom: 5px;
        font-family: 'Merriweather', serif;
    }
    
    .login-subtitle {
        color: var(--liberia-red);
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .form-group {
        position: relative;
        margin-bottom: 25px;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--liberia-blue);
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 15px 12px 45px;
        font-size: 1rem;
        transition: all 0.3s;
        height: 50px;
    }
    
    .form-control:focus {
        border-color: var(--liberia-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 35, 102, 0.15);
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--liberia-blue);
        font-size: 1.2rem;
    }
    
    .form-check {
        margin-bottom: 25px;
    }
    
    .form-check-input {
        margin-right: 10px;
    }
    
    .form-check-label {
        color: #555;
        font-weight: 500;
    }
    
    .btn-auth {
        background: var(--liberia-blue);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px 20px;
        font-weight: 600;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s;
        margin-bottom: 20px;
    }
    
    .btn-auth:hover {
        background: var(--liberia-red);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    .auth-footer a {
        color: var(--liberia-blue);
        text-decoration: none;
        font-weight: 600;
    }
    
    .auth-footer a:hover {
        color: var(--liberia-red);
        text-decoration: underline;
    }
    
    .alert {
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
    }
    
    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
        color: #721c24;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .login-card {
            padding: 30px 20px;
        }
        
        .login-logo {
            height: 60px;
        }
    }
</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card">
                    <div class="login-header">
                        <img src="/uploads/imgs/logo.png" alt="Liberia Coat of Arms" class="login-logo">
                        <h2 class="login-title">Secure Portal Access</h2>
                        <p class="login-subtitle">Ministry of Internal Affairs</p>
                    </div>
                    
                    <form action="/auth" method="post" novalidate>
                        <?= csrf_field() ?>

                        <?php if (null !== session()->getFlashdata('error')): ?>
                            <?php $errors = session()->getFlashdata('error'); ?>
                            <div class="alert alert-danger">
                                <?= is_array($errors) ? implode('<br>', $errors) : $errors ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="userEmail" class="form-label">Official ID (Email)</label>
                            <input 
                                type="email" 
                                id="userEmail" 
                                name="userEmail" 
                                value="<?= old('userEmail') ?>" 
                                class="form-control <?= isset($validation) && $validation->hasError('userEmail') ? 'is-invalid' : '' ?>" 
                                placeholder="Enter your official ID (Email)">
                            <i class="fas fa-user input-icon"></i>
                        </div>

                        <div class="form-group">
                            <label for="userPassword" class="form-label">Security Passcode</label>
                            <input 
                                type="password" 
                                id="userPassword" 
                                name="userPassword" 
                                class="form-control <?= isset($validation) && $validation->hasError('userPassword') ? 'is-invalid' : '' ?>" 
                                placeholder="Enter your passcode">
                            <i class="fas fa-lock input-icon"></i>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember this device</label>
                        </div>

                        <button type="submit" class="btn-auth btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i> ACCESS SECURE PORTAL
                        </button>

                        <div class="auth-footer">
                            <p>Need help? <a href="#">Contact System Administrator</a></p>
                            <p class="mt-2">© <?= date('Y') ?> Ministry of Internal Affairs, Liberia</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>
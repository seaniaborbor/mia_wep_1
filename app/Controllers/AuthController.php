<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use Config\Services;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['form', 'url', 'email']);
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Login',
            'description' => 'Login to your account',
            'keywords'    => 'login, authentication, user access',
            'author'      => 'Ministry of Internal Affairs - Liberia',
        ];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'userEmail' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required'    => 'Email address is required.',
                        'valid_email' => 'Please enter a valid email address.',
                    ],
                ],
                'userPassword' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required'   => 'Password is required.',
                        'min_length' => 'Password must be at least 6 characters long.',
                    ],
                ],
            ];

            if (!$this->validate($validationRules)) {
                $data['validation'] = $this->validator;
            } else {
                $email    = $this->request->getPost('userEmail');
                $password = $this->request->getPost('userPassword');

                $user = $this->userModel->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch')
                                        ->where('userEmail', $email)
                                        ->first();

                if (!$user) {
                    return redirect()->back()->with('error', 'Invalid credentials.')->withInput();
                }

                // 1. Check if account is locked (due to failed attempts)
                if ($this->userModel->isAccountLocked($user)) {
                    return redirect()->back()
                        ->with('error', 'Your account is locked. An unlock code was sent to your email.')
                        ->withInput();
                }

                // 2. Check if email is verified
                if (!$user['userAccountVerified']) {
                    return redirect()->back()
                        ->with('error', 'Please verify your email address before logging in.')
                        ->withInput();
                }

                // 3. Check if account is active
                if ($user['userAccountActiveStatus'] != 1) {
                    return redirect()->back()
                        ->with('error', 'Your account is inactive. Contact Head Office in Monrovia.')
                        ->withInput();
                }

                // 4. Check branch status
                if ($user['isActive'] != 1) {
                    return redirect()->back()
                        ->with('error', 'Your branch is currently inactive. Contact Head Office.')
                        ->withInput();
                }

                // 5. Verify password
                if (password_verify($password, $user['userPassword'])) {
                    // Success → Reset failed attempts
                    $this->userModel->resetFailedAttempts($user['userId']);

                    session()->set('isLoggedIn', true);
                    session()->set('userData', $user);

                    if ($user['userDepartment'] == "Matrimonial") {
                        return redirect()->to('/matrimonial_dashboard')->with('success', 'Welcome to the Matrimonial Dashboard!');
                    } 

                    if ($user['userDepartment'] == "Matrimonial") {
                        return redirect()->to('/cultural_dashboard/nativecert')->with('success', 'Welcome to the Cultural Certificate Dashboard!');
                    } 

                    if ($user['userDepartment'] == "Cultural") {
                        return redirect()->to('/cultural_dashboard/nativecert')->with('success', 'Welcome to the Cultural Certificate Dashboard!');
                    }

                     if ($user['userDepartment'] == "System-Admin") {
                        return redirect()->to('/system_admin_dashboard')->with('success', 'Welcome to the System Admin Dashboard!');
                    }

                    // print_r($user);
                    // die();

                    if (session()->has('isLoggedIn')) {
                        session()->remove(['isLoggedIn', 'userData']);
                        return redirect()->to('/')->with('success', 'Welcome back! You have been logged out due to unauthorized account type.');
                    }
                    return redirect()->to('/');
                    
                        //;
                   // 
                } else {
                    // Wrong password → Increment failed attempts
                    $currentAttempts = $this->userModel->getFailedAttempts($user['userId']);
                    $this->userModel->incrementFailedAttempts($user['userId']);
                    $newAttempts = $currentAttempts + 1;

                    if ($newAttempts >= 3) {
                        // LOCK ACCOUNT + SEND UNLOCK EMAIL
                        $activationCode = bin2hex(random_bytes(16));

                        $locked = $this->userModel->update($user['userId'], [
                            'userAccountActiveStatus'   => 0,  // This locks the account
                            'userFailedLoginAttempts'   => 3,
                            'userAccountActivationCode' => $activationCode
                        ]);

                        if (!$locked) {
                            return redirect()->back()
                                ->with('error', 'System error. Contact administrator.')
                                ->withInput();
                        }

                        try {
                            $emailSent = $this->sendAccountUnlockEmail($user, $activationCode);

                            $masked = substr($user['userEmail'], 0, 3) . '***@' .
                                      substr($user['userEmail'], strpos($user['userEmail'], '@') + 1);

                            $msg = $emailSent
                                ? "Account locked. Unlock code sent to <strong>{$masked}</strong>"
                                : "Account locked. Failed to send email. Contact Head Office.";

                            return redirect()->back()->with('error', $msg)->withInput();
                        } catch (\Exception $e) {
                            log_message('error', 'Unlock email error: ' . $e->getMessage());
                            return redirect()->back()
                                ->with('error', 'Account locked. Email system error. Contact support.')
                                ->withInput();
                        }
                    }

                    $remaining = 3 - $newAttempts;
                    return redirect()->back()
                        ->with('error', "Invalid credentials. {$remaining} attempt(s) remaining.")
                        ->withInput();
                }
            }
        }

        return view('public/auth', $data);
    }

    // Logout
    public function logout()
    {
        if (session()->has('isLoggedIn')) {
            session()->remove(['isLoggedIn', 'userData']);
            return redirect()->to('/')->with('success', 'You have been logged out.');
        }
        return redirect()->to('/');
    }

    // Verify Email
    public function verify($verificationCode)
    {
        $user = $this->userModel->where('userAccountVerificationCode', $verificationCode)->first();

        if ($user) {
            $this->userModel->verifyAccount($user['userId']);
            return redirect()->to('/auth')->with('success', 'Email verified successfully. You can now log in.');
        }

        return redirect()->to('/')->with('error', 'Invalid or expired verification code.');
    }

    // Resend Verification Email
    public function resendVerification()
    {
        $email = $this->request->getPost('email');
        $user  = $this->userModel->where('userEmail', $email)->first();

        if ($user && !$user['userAccountVerified']) {
            $this->sendVerificationEmail($user);
            return redirect()->back()->with('success', 'Verification email sent. Check your inbox.');
        }

        return redirect()->back()->with('error', 'User not found or already verified.');
    }

    // Unlock Account via Code (from email link)
    public function unlock($code = null)
    {
        if (!$code) {
            return redirect()->to('/')->with('error', 'Invalid unlock link.');
        }

        $user = $this->userModel->where('userAccountActivationCode', $code)->first();

        if (!$user) {
            return redirect()->to('/')->with('error', 'Invalid or expired unlock code.');
        }

        // Unlock account
        $this->userModel->resetFailedAttempts($user['userId']);

        return redirect()->to('/')->with('success', 'Account unlocked successfully! You can now log in.');
    }

    // ===================== PRIVATE METHODS =====================

    private function sendVerificationEmail($user)
    {
        $email = Services::email();
        $link  = base_url("verify/{$user['userAccountVerificationCode']}");

        $email->setTo($user['userEmail']);
        $email->setSubject('Verify Your Account - Ministry of Internal Affairs');
        $email->setMessage("
            Dear {$user['userFullName']},<br><br>
            Please verify your email by clicking the link below:<br><br>
            <a href='{$link}'>{$link}</a><br><br>
            This link expires in 24 hours.<br><br>
            Best regards,<br>Ministry of Internal Affairs - Liberia
        ");

        $email->send();
    }

    private function sendAccountUnlockEmail($user, $activationCode)
    {
        $emailService = \Config\Services::email();
        $unlockLink   = base_url("auth/unlock/{$activationCode}");
        $fullName     = esc($user['userFullName']);

        $message = <<<EMAIL
            <h2 style="color:#b30000;">Account Locked – Action Required</h2>
            <p>Dear {$fullName},</p>
            <p>Your account has been temporarily locked due to multiple failed login attempts.</p>

            <p><strong>Your secure unlock code:</strong></p>
            <div style="font-size:24px; background:#f0f0f0; padding:15px; text-align:center; 
                        letter-spacing:3px; font-family:monospace; border:2px dashed #ccc; border-radius:8px;">
                {$activationCode}
            </div>

            <p style="margin:25px 0;">Or unlock instantly by clicking below:</p>
            <p style="text-align:center;">
                <a href="{$unlockLink}" style="background:#0066cc; color:white; padding:14px 28px; 
                      text-decoration:none; border-radius:6px; font-weight:bold; display:inline-block;">
                    Unlock My Account Now
                </a>
            </p>

            <p><strong>This code expires in 24 hours.</strong></p>
            <p>If you did not attempt to log in, contact the Head Office immediately.</p>

            <hr style="border:none; border-top:1px solid #eee; margin:30px 0;">
            <small style="color:#777;">
                Ministry of Internal Affairs – Republic of Liberia<br>
                This is an automated message. Do not reply.
            </small>
        EMAIL;

        $emailService->setTo($user['userEmail']);
        $emailService->setFrom('no-reply@mia.gov.lr', 'MIA Liberia - Security');
        $emailService->setSubject('Account Locked – Unlock Code Required');
        $emailService->setMessage($message);

        if ($emailService->send(false)) {
            return true;
        } else {
            log_message('error', 'Unlock email failed: ' . $emailService->printDebugger(['headers']));
            return false;
        }
    }
}
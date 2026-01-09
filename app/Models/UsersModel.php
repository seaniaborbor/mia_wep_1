<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'login_users';
    protected $primaryKey = 'userId';

    protected $allowedFields = [
        'userFullName',
        'userEmail',
        'userPhone',
        'userPosition',
        'userPassword',
        'userPicture',
        'userBreanch',
        'userAccountType',
        'userSignature',
        'userApplicationFile',
        'userAccountActiveStatus',           // ← We'll use this as lock flag
        'userAccountActivationCode',         // ← For unlock code
        'userAccountVerificationCode',
        'userAccountVerified',
        'userFailedLoginAttempts',           // ← Already exists
        'userLastFailedLogin',
        'userDepartment',
        'userCreatedBy',
        'userDateCreated',
        'userAccountLastModifiedDate',
        'userAccountLastModifiedBy'
    ];

    protected $returnType = 'array';

    public function generateVerificationCode()
    {
        return bin2hex(random_bytes(16));
    }

    public function incrementFailedAttempts($userId)
    {
        $current = $this->getFailedAttempts($userId);
        return $this->update($userId, [
            'userFailedLoginAttempts' => $current + 1,
            'userLastFailedLogin' => date('Y-m-d H:i:s')
        ]);
    }

    public function getFailedAttempts($userId)
    {
        $user = $this->find($userId);
        return $user ? (int)$user['userFailedLoginAttempts'] : 0;
    }

    public function resetFailedAttempts($userId)
    {
        return $this->update($userId, [
            'userFailedLoginAttempts' => 0,
            'userLastFailedLogin' => null,
            'userAccountActiveStatus' => 1,                    // Unlock = Active
            'userAccountActivationCode' => null               // Clear code after use
        ]);
    }

    /**
     * Check if account is locked due to failed attempts
     * We use userAccountActiveStatus = 0 as "locked"
     */
    public function isAccountLocked($user)
    {
        // If account was deactivated due to failed logins
        if (isset($user['userAccountActiveStatus']) && $user['userAccountActiveStatus'] == 0) {
            return true;
        }

        // Optional: Auto-reactivate after X time? (you can add later)
        // For now: stays locked until user uses unlock link

        return false;
    }

    public function verifyAccount($userId)
    {
        return $this->update($userId, [
            'userAccountVerified' => 1,
            'userAccountVerificationCode' => null
        ]);
    }
}
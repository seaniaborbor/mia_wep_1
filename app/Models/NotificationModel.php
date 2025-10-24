<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'notification_table';
    protected $primaryKey = 'notificationId';

    // Enable auto increment
    protected $useAutoIncrement = true;

    // Allowed fields for insert/update
    protected $allowedFields = [
        'notification_userId',
        'commentId',
        'ENTRY_VIEW',
        'SIGNA_VIEW',
        'SIGNB_VIEW',
        'SIGNC_VIEW',
        'notification_branch_id',
        'date_notified'
    ];

}

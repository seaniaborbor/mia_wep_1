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
        'userAccountActiveStatus',
        'userCreatedBy',
        'userDateCreated',
        'userAccountLastModifiedDate',
        'userAccountLastModifiedBy'
    ];

    protected $returnType = 'array';
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class TraditionalCertificateModel extends Model
{
    protected $table            = 'traditionalcertificates';
    protected $primaryKey       = 'tradCertId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'tradCertCertCreatedAt';
    protected $updatedField     = 'tradCertLastUpdatedAt';
    
    protected $allowedFields    = [
        'tradCertSn',
        'tradCertCevNo',
        'tradRevenueNo',
        'tradCertHolderName',
        'tradCertHolderPic',
        'tradCertHolderTownorCity',
        'tradCertHolderDistrict',
        'tradCertHoldercounty',
        'tradCertHolderOperationType',
        'tradCertDateIssued',
        'tradCertDuration',
        'tradCertSignatoryA',
        'tradCertSignatoryB',
        'tradCertSignatoryC',
        'tradCertInsertedBy',
        'tradCertAppliedType',
        'tradCertBranch',
        'tradCertLastUpdatedBy',
        // Newly added missing columns
        'tradCertSignatoryAID',
        'tradCertSignatoryADate',
        'tradCertSignatoryBID',
        'tradCertSignatoryBDate',
        'tradCertSignatoryCID',
        'tradCertSignatoryCDate',
        'tradCertAmtPaid'
    ];

    
}
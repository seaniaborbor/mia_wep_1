<?php

namespace App\Models;

use CodeIgniter\Model;

class DivorceCertificateModel extends Model
{
    protected $table = 'divorce_certificates';
    protected $primaryKey = 'divorceCertId';
    
    protected $allowedFields = [
        'divorceplaintiff',
        'divorcedefendant',
        'divorcedefendantPic',
        'divorceplaintiffPic',
        'divorcemarriageDate',
        'divorcedateOfDivorce',
        'divorceissuanceDate',
        'divorceSIGN_A',
        'divorceSIGN_A_ID',
        'divorceSIGN_A_DATE_SIGNED',
        'divorceSIGN_B',
        'divorceSIGN_B_ID',
        'divorceSIGN_B_DATE_SIGNED',
        'divorceSIGN_C',
        'divorceSIGN_C_ID',
        'divorceSIGN_C_DATE_SIGNED',
        'divorcebreanch_id',
        'divorcecreated_by',
        'divorceRefNo',
        'divorceCode',
        'divorceRevNo',
        'divorceupdated_by',
        'divorceIsIssued',
        
        
        'divorcecreated_at',
        'divorceupdated_at'
    ];
    
   
}
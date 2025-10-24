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
        'divorcecreated_by',
        
        
        'divorcecreated_at',
        'divorceupdated_at'
    ];

    protected function generateDivorceCode()
    {
        $year = date('y');
        $random = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
        return "MIA-11-{$year}-{$random}";
    }

    protected function generateDivorceRefNo($divorceCode)
    {
        $lastFour = substr($divorceCode, -4);
        return "MT-11-{$lastFour}";
    }

    protected function beforeInsert(array $data)
    {
        if (empty($data['data']['divorceCode'])) {
            $divorceCode = $this->generateDivorceCode();
            $data['data']['divorceCode'] = $divorceCode;
            $data['data']['divorceRefNo'] = $this->generateDivorceRefNo($divorceCode);
        }
        return $data;
    }

    protected $beforeInsert = ['beforeInsert'];
    
   
}
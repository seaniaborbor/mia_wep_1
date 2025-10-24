<?php

namespace App\Models;

use CodeIgniter\Model;

class TraditionalCertificateModel extends Model
{
    protected $table            = 'TraditionalCertificates';
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
        'tradCertLastUpdatedBy'
    ];

    /**
     * County codes for certificate serial number generation
     */
    private $countyCodes = [
        'Bomi'               => 'LR-BM',
        'Bong'               => 'LR-BG',
        'Gbarpolu'           => 'LR-GP',
        'Grand Bassa'        => 'LR-GB',
        'Grand Cape Mount'   => 'LR-CM',
        'Grand Gedeh'        => 'LR-GG',
        'Grand Kru'          => 'LR-GK',
        'Lofa'               => 'LR-LO',
        'Margibi'            => 'LR-MG',
        'Maryland'           => 'LR-MY',
        'Montserrado'        => 'LR-MO',
        'Nimba'              => 'LR-NI',
        'River Cess'         => 'LR-RI',
        'River Gee'          => 'LR-RG',
        'Sinoe'              => 'LR-SI'
    ];

    /**
     * Operation type codes for certificate number
     */
    private $operationTypeCodes = [
        'manufacturing'      => 'MFG',
        'retail'             => 'RET',
        'wholesale'          => 'WHO',
        'service'            => 'SRV',
        'agriculture'        => 'AGR',
        'mining'             => 'MIN',
        'construction'       => 'CON',
        'transportation'     => 'TRN',
        'hospitality'        => 'HOS'
        // Add more operation types as needed
    ];

    protected $beforeInsert = ['generateCertificateNumbers', 'setInsertedBy'];
    protected $beforeUpdate = ['setUpdatedBy'];

    /**
     * Generates unique certificate serial number and CEV number
     */
    protected function generateCertificateNumbers(array $data)
    {
        $county = $data['data']['tradCertHoldercounty'] ?? '';
        $operationType = $data['data']['tradCertHolderOperationType'] ?? '';
        
        // Generate Certificate Serial Number
        $countyCode = $this->countyCodes[$county] ?? 'LR-XX';
        $year = date('Y');
        $random = strtoupper(bin2hex(random_bytes(3))); // 6 random chars
        $serialNumber = $countyCode . '-' . $year . '-' . substr($random, 0, 5);
        
        // Ensure uniqueness
        $serialNumber = $this->ensureUniqueSerialNumber($serialNumber);
        
        // Generate CEV Number
        $operationCode = $this->operationTypeCodes[strtolower($operationType)] ?? 'GEN';
        $cevNumber = 'CEV-' . $operationCode . '-' . $year . '-' . substr($random, 2, 4);
        $cevNumber = $this->ensureUniqueCevNumber($cevNumber);
        
        $data['data']['tradCertSn'] = $serialNumber;
        $data['data']['tradCertCevNo'] = $cevNumber;
        
        return $data;
    }

    /**
     * Ensures the serial number is unique
     */
    private function ensureUniqueSerialNumber($serialNumber, $attempt = 1)
    {
        $existing = $this->where('tradCertSn', $serialNumber)->first();
        
        if (!$existing) {
            return $serialNumber;
        }
        
        // If exists, generate new one with suffix
        if ($attempt > 5) {
            // After 5 attempts, use timestamp for uniqueness
            $timestamp = time();
            return $serialNumber . '-' . substr($timestamp, -4);
        }
        
        $newSerial = $serialNumber . '-' . strtoupper(bin2hex(random_bytes(1)));
        return $this->ensureUniqueSerialNumber($newSerial, $attempt + 1);
    }

    /**
     * Ensures the CEV number is unique
     */
    private function ensureUniqueCevNumber($cevNumber, $attempt = 1)
    {
        $existing = $this->where('tradCertCevNo', $cevNumber)->first();
        
        if (!$existing) {
            return $cevNumber;
        }
        
        // If exists, generate new one with suffix
        if ($attempt > 5) {
            // After 5 attempts, use timestamp for uniqueness
            $timestamp = time();
            return $cevNumber . '-' . substr($timestamp, -3);
        }
        
        $newCev = $cevNumber . '-' . strtoupper(bin2hex(random_bytes(1)));
        return $this->ensureUniqueCevNumber($newCev, $attempt + 1);
    }

    /**
     * Sets the inserted by user
     */
    protected function setInsertedBy(array $data)
    {
        // You can set this from session or authentication
        if (!isset($data['data']['tradCertInsertedBy'])) {
            $data['data']['tradCertInsertedBy'] = session()->get('user_id') ?? 0;
        }
        return $data;
    }

    /**
     * Sets the updated by user
     */
    protected function setUpdatedBy(array $data)
    {
        // You can set this from session or authentication
        if (!isset($data['data']['tradCertLastUpdatedBy'])) {
            $data['data']['tradCertLastUpdatedBy'] = session()->get('user_id');
        }
        return $data;
    }

    /**
     * Get certificate by serial number
     */
    public function getBySerialNumber($serialNumber)
    {
        return $this->where('tradCertSn', $serialNumber)->first();
    }

    /**
     * Get certificates by county
     */
    public function getByCounty($county)
    {
        return $this->where('tradCertHoldercounty', $county)->findAll();
    }

    /**
     * Get certificates by application type
     */
    public function getByApplicationType($appType)
    {
        return $this->where('tradCertAppliedType', $appType)->findAll();
    }

    /**
     * Search certificates by holder name
     */
    public function searchByHolderName($name)
    {
        return $this->like('tradCertHolderName', $name)->findAll();
    }
}
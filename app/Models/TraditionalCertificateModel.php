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
     * Traditional Liberian practitioner types and their codes
     */
    private $operationTypeCodes = [
        'ratualist'          => 'RAT',
        'herbalist'          => 'HER',
        'native_doctor'      => 'NDC',
        'zoe'                => 'ZOE',
        'bodio'              => 'BOD',
        'sowei'              => 'SOW',
        'zoebah'             => 'ZOB',
        'country_doctor'     => 'CDR',
        'medicine_man'       => 'MED',
        'medicine_woman'     => 'MEW',
        'spiritual_healer'   => 'SPH',
        'diviner'            => 'DIV',
        'traditional_midwife' => 'MID',
        'bone_setter'        => 'BON',
        'circumciser'        => 'CIR',
        'rain_maker'         => 'RAN',
        'juju_man'           => 'JUJ',
        'juju_woman'         => 'JUW',
        'poro_elder'         => 'POR',
        'sande_elder'        => 'SAN',
        'tribal_chief'       => 'CHF',
        'town_crier'         => 'CRI',
        'cultural_elder'     => 'CEL',
        'dance_master'       => 'DAN',
        'drum_master'        => 'DRU',
        'story_teller'       => 'STO',
        'blacksmith'         => 'BLS',
        'potter'             => 'POT',
        'weaver'             => 'WEA',
        'fisherman'          => 'FIS',
        'hunter'             => 'HUN',
        'farmer'             => 'FAR'
    ];

    /**
     * Display names for traditional positions
     */
    private $operationTypeDisplayNames = [
        'ratualist'          => 'Ratualist (Traditional Spiritual Healer)',
        'herbalist'          => 'Herbalist (Traditional Medicine Practitioner)',
        'native_doctor'      => 'Native Doctor (Traditional Doctor)',
        'zoe'                => 'Zoe (Sande Society Leader)',
        'bodio'              => 'Bodio (Traditional Priest/Diviner)',
        'sowei'              => 'Sowei (Sande Society Instructor)',
        'zoebah'             => 'Zoebah (Poro Society Leader)',
        'country_doctor'     => 'Country Doctor (Rural Traditional Healer)',
        'medicine_man'       => 'Medicine Man',
        'medicine_woman'     => 'Medicine Woman',
        'spiritual_healer'   => 'Spiritual Healer',
        'diviner'            => 'Diviner (Fortune Teller)',
        'traditional_midwife' => 'Traditional Midwife',
        'bone_setter'        => 'Bone Setter (Fracture Specialist)',
        'circumciser'        => 'Traditional Circumciser',
        'rain_maker'         => 'Rain Maker',
        'juju_man'           => 'Juju Man (Charm Maker)',
        'juju_woman'         => 'Juju Woman (Charm Maker)',
        'poro_elder'         => 'Poro Society Elder',
        'sande_elder'        => 'Sande Society Elder',
        'tribal_chief'       => 'Tribal Chief',
        'town_crier'         => 'Town Crier',
        'cultural_elder'     => 'Cultural Elder',
        'dance_master'       => 'Dance Master',
        'drum_master'        => 'Drum Master',
        'story_teller'       => 'Story Teller',
        'blacksmith'         => 'Blacksmith',
        'potter'             => 'Potter',
        'weaver'             => 'Weaver',
        'fisherman'          => 'Traditional Fisherman',
        'hunter'             => 'Traditional Hunter',
        'farmer'             => 'Traditional Farmer'
    ];

    protected $beforeInsert = ['generateCertificateNumbers'];

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
        
        if ($attempt > 5) {
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
        
        if ($attempt > 5) {
            $timestamp = time();
            return $cevNumber . '-' . substr($timestamp, -3);
        }
        
        $newCev = $cevNumber . '-' . strtoupper(bin2hex(random_bytes(1)));
        return $this->ensureUniqueCevNumber($newCev, $attempt + 1);
    }
}
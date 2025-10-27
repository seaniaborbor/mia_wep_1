<?php

namespace App\Models;

use CodeIgniter\Model;

class TraditionalCertificateModel extends Model
{
    protected $table            = 'traditionalCertificates';
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
     * Traditional Liberian practitioner types and their codes
     */
    private $operationTypeCodes = [
        'ratualist'          => 'RAT',    // Traditional spiritual healer
        'herbalist'          => 'HER',    // Traditional medicine practitioner
        'native_doctor'      => 'NDC',    // Traditional doctor
        'zoe'                => 'ZOE',    // Sande society leader
        'bodio'              => 'BOD',    // Traditional priest/diviner
        'sowei'              => 'SOW',    // Sande society instructor
        'zoebah'             => 'ZOB',    // Poro society leader
        'country_doctor'     => 'CDR',    // Rural traditional healer
        'medicine_man'       => 'MED',    // Traditional medicine specialist
        'medicine_woman'     => 'MEW',    // Traditional medicine specialist
        'spiritual_healer'   => 'SPH',    // Spiritual healing practitioner
        'diviner'            => 'DIV',    // Fortune teller/divination specialist
        'traditional_midwife' => 'MID',   // Traditional birth attendant
        'bone_setter'        => 'BON',    // Traditional fracture specialist
        'circumciser'        => 'CIR',    // Traditional circumcision specialist
        'rain_maker'         => 'RAN',    // Traditional weather influencer
        'juju_man'           => 'JUJ',    // Traditional charm maker
        'juju_woman'         => 'JUW',    // Traditional charm maker
        'poro_elder'         => 'POR',    // Poro society elder
        'sande_elder'        => 'SAN',    // Sande society elder
        'tribal_chief'       => 'CHF',    // Traditional community leader
        'town_crier'         => 'CRI',    // Community announcer
        'cultural_elder'     => 'CEL',    // Keeper of traditions
        'dance_master'       => 'DAN',    // Traditional dance instructor
        'drum_master'        => 'DRU',    // Traditional drumming specialist
        'story_teller'       => 'STO',    // Oral history keeper
        'blacksmith'         => 'BLS',    // Traditional metal worker
        'potter'             => 'POT',    // Traditional clay worker
        'weaver'             => 'WEA',    // Traditional cloth weaver
        'fisherman'          => 'FIS',    // Traditional fishing specialist
        'hunter'             => 'HUN',    // Traditional hunting specialist
        'farmer'             => 'FAR'     // Traditional farming specialist
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
     * Sanitize file name
     */
    private function sanitizeFileName($fileName)
    {
        $fileName = basename($fileName);
        $fileName = str_replace(' ', '_', $fileName);
        $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
        return $fileName;
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
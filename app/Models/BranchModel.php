<?php

namespace App\Models;

use CodeIgniter\Model;

class BranchModel extends Model
{
    protected $table            = 'branchs_table';      // Table name
    protected $primaryKey       = 'branchId';           // Primary key
    protected $useAutoIncrement = true;                 // Auto-increment primary key
    protected $returnType       = 'array';              // Return results as arrays
    protected $useSoftDeletes   = false;                // No soft deletes
    protected $useTimestamps    = false;                // No automatic timestamps
    protected $allowedFields    = [                     // Fields that can be mass-assigned
        'branchName',
        'branchCounty',
        'branchCityOrTown',
        'branchCode',           // Added branch code field
        'branchCreatedBy',
        'branchEmail',
        'isActive',
        'branchContact',
        'branchCreatedAt'
    ];

    /**
     * Generates a branch code before insert
     * Format: [County Initials][Current Year][5 random alphanumeric chars]
     * Example: MO2023A7B9C
     */
    protected $beforeInsert = ['generateBranchCode'];

    /**
     * Generates the branch code
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

   protected function generateBranchCode(array $data)
{
    $county = $data['data']['branchCounty'] ?? '';
    $initials = $this->countyCodes[$county] ?? 'XX'; // Fallback in case of typo or mismatch
    $year = substr(date('Y'),2,3);
    $random = strtoupper(bin2hex(random_bytes(3))); // 6 chars

    // Format: e.g., MS2025A1B2C
    $data['data']['branchCode'] = $initials . $year . substr($random, 0, 5);

    return $data;
}

}
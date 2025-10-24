<?php

namespace App\Models;

use CodeIgniter\Model;

class MarriageCertificateModel extends Model
{
    protected $table            = 'marriage_certificates';
    protected $primaryKey       = 'marriage_cert_id';

    protected $useAutoIncrement = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'last_edited_at';

    protected $returnType       = 'array';

    protected $allowedFields = [
        // Groom Info
        'groom_name', 'groom_cell', 'groom_county_of_origin', 'groom_nationality',
        'groom_dob', 'groom_birth_city', 'groom_birth_county', 'groom_age',
        'groom_address', 'groom_married_before', 'groom_previous_marriage_date',
        'groom_previous_spouse_name', 'groom_father_name', 'groom_mother_name',

        // Bride Info
        'bride_name', 'bride_cell', 'bride_county_of_origin', 'bride_nationality',
        'bride_dob', 'bride_birth_city', 'bride_birth_county', 'bride_age',
        'bride_address', 'bride_married_before', 'bride_previous_marriage_date',
        'bride_previous_spouse_name', 'bride_father_name', 'bride_mother_name',

        // Photos
        'groom_passport_photo', 'bride_passport_photo',

        // Marriage Details
        'place_of_marriage', 'date_of_marriage', 'bride_proposed_name',

        // Witness and Officiator
        'witness_name', 'witness_contact', 'officiator_name', 'officiator_contact',

        // Certificate Cost
        'certificate_cost', 'certificate_cost_words',

        // Declaration
        'declarant_name', 'declaration_date',

        // Reference Info
        'reference_no', 'marriage_code', 'revenue_no',
        'certification_day', 'certification_month', 'certification_year',
        'cert_branch',
        'SIGNA_id',
        'SIGNA_signedDate',
        'SIGNB_id',
        'SIGNB_signedDate',
        'SIGNC_id',
        'SIGNC_signedDate',


        // Official Use
        'SIGNA', 'SIGNB', 'SIGNC', 'ENTRY', 'last_edited_by'
    ];

    protected $beforeInsert = ['generateMarriageIdentifiers'];


    protected function generateMarriageIdentifiers(array $data)
{
    helper('text'); // For random_string()

    $counties = [
        'Bomi' => ['BM', '01'],
        'Bong' => ['BG', '02'],
        'Gbarpolu' => ['GP', '03'],
        'Grand Bassa' => ['GB', '04'],
        'Grand Cape Mount' => ['GCM', '05'],
        'Grand Gedeh' => ['GG', '06'],
        'Grand Kru' => ['GK', '07'],
        'Lofa' => ['LF', '08'],
        'Margibi' => ['MG', '09'],
        'Maryland' => ['MY', '10'],
        'Montserrado' => ['MT', '11'],
        'Nimba' => ['NM', '12'],
        'River Cess' => ['RC', '13'],
        'River Gee' => ['RG', '14'],
        'Sinoe' => ['SN', '15'],
    ];

    $countyName = $data['data']['groom_birth_county'] ?? null;

    if ($countyName && isset($counties[$countyName])) {
        list($abbr, $code) = $counties[$countyName];

        $yearSuffix = date('y'); // last two digits of the year
        $randomPart = strtoupper(random_string('alnum', 4));

        $data['data']['marriage_code'] = "{$abbr}-{$code}-{$yearSuffix}{$randomPart}";
    }

    // We assume the primary key is auto-incremented and generated *after* insert,
    // so reference_no generation must be done *after* insert if it depends on ID.
    // For now, make it based on marriage_code suffix:
    if (!empty($code)) {
        $lastChar = substr($data['data']['marriage_code'], 6,10);
        $data['data']['reference_no'] = "{$code}-{$lastChar}";
    }

    return $data;
}

}

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
        'SIGNA', 'SIGNB', 'SIGNC', 'ENTRY', 'last_edited_by', 'isWedCertIssued'
    ];

    
}

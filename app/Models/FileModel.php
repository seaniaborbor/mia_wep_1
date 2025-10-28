<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table            = 'attached_file_table';
    protected $primaryKey       = 'fileId';

   
    protected $allowedFields    = [
        'fileCertificateId',
        'fileCreatedBy',
        'fileTitle',
        'certificateFile',
        'certificateFile_category',
        'fileCreatedAt'
    ];

    protected $returnType       = 'array';
}

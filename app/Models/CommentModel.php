<?php  namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'certificate_comments';
    protected $primaryKey = 'comment_id';

    protected $allowedFields = [
        'certificate_id',
        'certificate_type',
        'user_id',
        'comment_text',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
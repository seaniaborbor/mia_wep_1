<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MarriageCertificateFileModel;

class MarriageCertificateFileController extends BaseController
{
   public function upload()
{
    // Validate other fields first
    $validation = \Config\Services::validation();
    $validation->setRules([
        'fileCertificateId' => 'required|numeric',
        'fileTitle' => 'required|max_length[255]',
        'certificateFile' => 'uploaded[certificateFile]|max_size[certificateFile,5120]', // 5MB max
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => implode('<br>', $validation->getErrors())
        ]);
    }

    $file = $this->request->getFile('certificateFile'); // Changed to match form field name

    if (!$file->isValid()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => $file->getErrorString()
        ]);
    }

    // Generate a random name and move to writable/uploads
    $newName = $file->getRandomName();
    $file->move('uploads/files', $newName);

    $model = new MarriageCertificateFileModel();

    $model->insert([
        'fileCertificateId' => $this->request->getPost('fileCertificateId'),
        'certificateFile_category' => $this->request->getPost('certificateFile_category'),
        'certificateFile' => $newName, // Save the generated filename
        'fileTitle' => $this->request->getPost('fileTitle'),
        'fileCreatedBy' => session()->get('userData')['userId'],
        'fileCreatedAt' => date('Y-m-d H:i:s'),
    ]);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'File uploaded successfully.',
        'filename' => $newName
    ]);
}


// get all the files 

public function wedcert_file_get($certificate_type, $certificate_id){
    
    $model = new MarriageCertificateFileModel();
    $files = $model->where('fileCertificateId', $certificate_id)->where('certificateFile_category', $certificate_type)->findAll();

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $files
    ]);
}

public function delete_file($fileId)
{
    $model = new MarriageCertificateFileModel();
    $file = $model->find($fileId);

    if (!$file) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'File not found.'
        ]);
    }

    // Delete the file from the filesystem
    $filePath = '/uploads/files' . $file['certificateFile'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete the record from the database
    $model->delete($fileId);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'File deleted successfully.'
    ]); 
}

}

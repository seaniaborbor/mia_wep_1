<?php 
namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\BranchModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\TraditionalCertificateModel;
use App\Models\FileModel;

class FileUploadController extends BaseController
{
    protected $branchModel;
    protected $userModel;
    protected $marriageModel;
    protected $divorceModel;
    protected $traditionalModel;
    protected $fileModel;

    public function __construct()
    {
        $this->branchModel = new BranchModel();
        $this->userModel = new UsersModel();
        $this->marriageModel = new MarriageCertificateModel();
        $this->divorceModel = new DivorceCertificateModel();
        $this->traditionalModel = new TraditionalCertificateModel();
        $this->fileModel = new FileModel();
    }

    public function upload_certificate_file($cert_id)
    {
        // Validation rules
        $validationRules = [
            'fileTitle' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'label' => 'File Descriptive Title',
                'errors' => [
                    'required'   => 'The file descriptive title is required.',
                    'min_length' => 'The file title must be at least 2 characters long.',
                    'max_length' => 'The file title cannot exceed 255 characters.'
                ]
            ],
            'certificateFile' => [
                'rules' => 'uploaded[certificateFile]|max_size[certificateFile,2048]'
                    . '|ext_in[certificateFile,doc,docx,pdf,jpeg,jpg,png,xls,txt]'
                    . '|mime_in[certificateFile,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/jpeg,image/png,application/vnd.ms-excel,text/plain]',
                'label' => 'File Upload',
                'errors' => [
                    'uploaded' => 'Please upload a file before submitting.',
                    'max_size' => 'The uploaded file must not exceed 2MB.',
                    'ext_in'   => 'Only .doc, .docx, .pdf, .jpeg, .jpg, .png, .xls, or .txt files are allowed.',
                    'mime_in'  => 'Invalid file type. Please upload a valid document or image file.'
                ]
            ],
            'certificateFile_category' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please specify the certificate category.'
                ]
            ]
        ];

        // Run validation
        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('error', 'File upload failed due to validation errors.');
        }

        // Identify certificate type
        $certificateType = $this->request->getPost('certificateFile_category');
        $certificate = [];
        $cert_signed = false;

        if ($certificateType === "marriage") {
            $certificate = $this->marriageModel->find($cert_id);
            if (!empty($certificate)) {
                $cert_signed = !empty($certificate['SIGNA']) ||
                               !empty($certificate['SIGNB']) ||
                               !empty($certificate['SIGNC']);
            }
        } elseif ($certificateType === "divorce") {
            $certificate = $this->divorceModel->find($cert_id);
            if (!empty($certificate)) {
                $cert_signed = !empty($certificate['divorceSIGN_A']) ||
                               !empty($certificate['divorceSIGN_B']) ||
                               !empty($certificate['divorceSIGN_C']);
            }
        } elseif ($certificateType === "traditional") {
            $certificate = $this->traditionalModel->find($cert_id);
            if (!empty($certificate)) {
                $cert_signed = !empty($certificate['tradCertSignatoryA']) ||
                               !empty($certificate['tradCertSignatoryB']) ||
                               !empty($certificate['tradCertSignatoryC']);
            }
        }

        if (empty($certificate)) {
            return redirect()->back()->with('error', 'Invalid certificate record.');
        }



        // Stop upload if certificate has been signed
        if ($cert_signed) {
            return redirect()->back()->with('error', 'This certificate has already been signed. You cannot upload new files.');
        }

        // Handle the uploaded file
        $file = $this->request->getFile('certificateFile');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/certificates/', $newName);

            $data = [
                'fileCertificateId'         => $cert_id,
                'fileCreatedBy'             => session()->get('userData')['userId'] ?? null,
                'fileTitle'                 => $this->request->getPost('fileTitle'),
                'certificateFile'           => $newName,
                'certificateFile_category'  => $certificateType,
                'fileCreatedAt'             => date('Y-m-d H:i:s')
            ];

            if ($this->fileModel->insert($data)) {
                return redirect()->back()->with('success', 'File has been uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to save file information.');
            }

        } else {
            return redirect()->back()->with('error', 'Invalid file upload. Please try again.');
        }
    }


    public function delete($file_id, $cert_id)
    {
        // Find the file record
        $file_to_delete = $this->fileModel->find($file_id);

        if (empty($file_to_delete)) {
            return redirect()->back()->with("error", "The file you're requesting to delete does not exist.");
        }

        // Determine certificate type
        $certificate_type = $file_to_delete['certificateFile_category'];
        $cert_data = [];
        $cert_signed = false;

        if ($certificate_type === "marriage") {
            $cert_data = $this->marriageModel->find($cert_id);
            if (!empty($cert_data)) {

                $cert_signed = !empty($cert_data['SIGNA']) ||
                               !empty($cert_data['SIGNB']) ||
                               !empty($cert_data['SIGNC']);

                $cert_data['last_edited_by'] = session()->get('userData')['userId'];
                $this->marriageModel->update($cert_id, $cert_data);

            }
        } elseif ($certificate_type === "divorce") {
            $cert_data = $this->divorceModel->find($cert_id);
            if (!empty($cert_data)) {
                $cert_signed = !empty($cert_data['divorceSIGN_A']) ||
                               !empty($cert_data['divorceSIGN_B']) ||
                               !empty($cert_data['divorceSIGN_C']);
                $cert_data['divorceupdated_by'] = session()->get('userData')['userId'];
                $this->divorceModel->update($cert_id, $cert_data);

            }
        } elseif ($certificate_type === "traditional") {

            $cert_data = $this->traditionalModel->find($cert_id);
            
            if (!empty($cert_data)) {
                $cert_signed = !empty($cert_data['tradCertSignatoryA']) ||
                               !empty($cert_data['tradCertSignatoryB']) ||
                               !empty($cert_data['tradCertSignatoryC']);

                 $cert_data['tradCertLastUpdatedBy'] = session()->get('userData')['userId'];
                 $this->traditionalModel->update($cert_id, $cert_data);
            }
        }

        if (empty($cert_data)) {
            return redirect()->back()->with("error", "The certificate associated with this file does not exist.");
        }

        // Stop deletion if certificate has been signed
        if ($cert_signed) {
            return redirect()->back()->with("error", "This certificate has already been signed and its attached files cannot be deleted.");
        }

        // Delete the physical file
        $file_path = FCPATH . 'uploads/certificates/' . $file_to_delete['certificateFile'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        // get emails for notification
        $recipients = $this->userModel
            ->where('userBreanch', $cert_data[$certificate_type === "marriage" ? 'breanch_id' : ($certificate_type === "divorce" ? 'divorcebreanch_id' : 'tradCertBranchId')])
            ->where('userAccountActiveStatus', 1)
            ->findAll();
        $emails = array_map(function($user) {
            return $user['userEmail'];
        }, $recipients);
        // Delete database record
        if ($this->fileModel->delete($file_id)) {
            // Send notification emails
            $emailService = \Config\Services::email();
            try{
                foreach ($emails as $email) {
                    $emailService->setTo($email);
                    $emailService->setSubject('Certificate File Deleted');
                    $emailService->setMessage('A file titled "' . $file_to_delete['fileTitle'] . '" associated with certificate ID ' . $cert_id . ' has been deleted.');
                    $emailService->send();
                }   
            }catch(\Exception $e){
                // Log the error but do not interrupt the flow
                log_message('error', 'Failed to send deletion notification emails: ' . $e->getMessage());
            }
            return redirect()->back()->with("success", "File deleted successfully.");
        } else {
            return redirect()->back()->with("error", "Failed to delete file from database.");
        }

    }



}

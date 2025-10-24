<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\MarriageCertificateModel;
use App\Models\DivorceCertificateModel;
use App\Models\UsersModel;
use App\Models\NotificationModel;

class VerificationController extends BaseController
{
    protected $branchModel;
    protected $marriageModel;
    protected $divorceModel;
    protected $userModel;
    protected $notificationModel;

    public function __construct()
    {
        helper(['form', 'url', 'number', 'custom']);
        $this->branchModel = new BranchModel();
        $this->marriageModel = new MarriageCertificateModel();
        $this->divorceModel = new DivorceCertificateModel();
        $this->userModel = new UsersModel();
        $this->notificationModel = new NotificationModel();
    }

    
public function index()
{
    $data = [];
    $data['file_to_include'] = 'partials/fragments/guideline_card.php';
    $data['hide_form'] = '';

    $verificationCode = trim(strip_tags($this->request->getGet('cc')));
    $certificateType = strtolower(trim(strip_tags($this->request->getGet('toc'))));
    $allowedTypes = ['w', 'd'];

    if (!empty($verificationCode) && in_array($certificateType, $allowedTypes)) {

        $data['hide_form'] = 'd-none';

        if ($certificateType === 'w') {
            $data['wedCert'] = $this->marriageModel
                ->where('reference_no', $verificationCode)
                ->first();

                

            $data['file_to_include'] = !empty($data['wedCert']) ?
                'partials/fragments/success_wedding_msg.php' :
                'partials/fragments/invalid_essages.php';

        } elseif ($certificateType === 'd') {
            $data['divoCert'] = $this->divorceModel
                ->where('divorceRefNo', $verificationCode)
                ->first();

            $data['file_to_include'] = !empty($data['divoCert']) ?
                'partials/fragments/success_divorce_msg.php' :
                'partials/fragments/invalid_essages.php';
        }
    }

    return view('public/verification_page', $data);
}



public function instrunction($instrunctions_to_show)
{
    // Define allowed info cards
    $info_cards = [
        'marriage_cert_info',
        'divorce_cert_info',
        'not_available_info',
    ];

    // Check if the provided instruction is valid
    if (!empty($instrunctions_to_show) && in_array($instrunctions_to_show, $info_cards)) {
        $data = [
            'instructions_card' => $instrunctions_to_show,
        ];
    } else {
        // Fallback if invalid or missing
        $data = [
            'instructions_card' => 'not_available_info',
        ];
    }

    // Load the view with data
    return view('public/show_info', $data);
}



}
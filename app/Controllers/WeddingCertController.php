<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\BranchModel;
use App\Models\UsersModel;
use App\Models\MarriageCertificateModel;

class WeddingCertController extends BaseController

{

    public function __construct()
    {

        helper(['form', 'url']);
        $this->branchModel = new BranchModel();
        $this->userModel = new UsersModel();
        $this->weddingCertModel = new MarriageCertificateModel();

    }



    public function index()

    {

        $data['title'] = 'Marriage Certificates';
        $data['passLink'] = 'certificates';

        $data['branch_complete_certificate'] = $this->weddingCertModel

            ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')

            ->where('marriage_certificates.cert_branch', session()->get('userData')['userBreanch'])
            ->where('marriage_certificates.SIGNA !=', null)
            ->where('marriage_certificates.SIGNB !=', null)
            ->where('marriage_certificates.SIGNC !=', null)
            ->orderBy('marriage_certificates.marriage_cert_id', 'DESC')
            ->findAll();

            

        $data['branch_uncomplete_certificate'] = $this->weddingCertModel

                ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')

                ->where('marriage_certificates.cert_branch', session()->get('userData')['userBreanch'])
                ->groupStart()
                    ->where('marriage_certificates.SIGNA', null)
                    ->orWhere('marriage_certificates.SIGNB', null)
                    ->orWhere('marriage_certificates.SIGNC', null)
                ->groupEnd()
                ->orderBy('marriage_certificates.marriage_cert_id', 'DESC')
                ->findAll();

        return view('dashboard/marriage_certificate_list', $data);

    }



    public function view($cert_id){

        

        $data['passLink'] = 'certificates';

        $data['certificate'] = $this->weddingCertModel

                                ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')

                                ->join('login_users', 'login_users.userId = marriage_certificates.ENTRY')

                                ->where('marriage_certificates.marriage_cert_id', $cert_id)

                                ->first();

        // check if the certificate is found

        if(empty($data['certificate'])){

            return redirect()->back()->with('error', 'certificate not found');

            exit();

        }

        $certificate = $data['certificate'];



        if(!(session()->get('userData')['userBreanch'] == $certificate['cert_branch'] || session()->get('userData')['userBreanch'] == 1)){

            return redirect()->back()->with('error', 'Your access to this document is not permissable.');

        }

        

        return view('dashboard/view_marrige_certificate', $data);

    }





    public function sign($cert_id){



        $certificate = $this->weddingCertModel->find($cert_id);



        if(!$certificate){

            return redirect()->back()->with('error', "The wedding certificate is no longer found");

            exit();

        }



        $user_account_type   = session()->get('userData')['userAccountType'];



        if (!in_array($user_account_type, ['SIGNA', 'SIGNB', 'SIGNC'])) {

            return redirect()->back()->with('error', 'You do not have permission to sign this certificate.');

            exit();

        }

        $user_breanch = session()->get('userData')['userBreanch'];



        if($certificate['cert_branch'] != $user_breanch ){

             return redirect()->back()->with('error', 'You do not have permission to sign this certificate. Only signatories at the branch that created this certificate can sign it');

            exit();

        }



       



        // implementation of signatory A - logic 

        if($user_account_type == "SIGNA"){

            if($certificate['SIGNA'] === null){



                $certificate['SIGNA'] = session()->get('userData')['userSignature'];

                $certificate['SIGNA_id'] = session()->get('userData')['userId'];

                $certificate['SIGNA_signedDate'] = date('Y-m-d');  // Full date format



                if($this->weddingCertModel->update($cert_id, $certificate)){

                    return redirect()->back()->with("success", "Your signature has been affixed to this wedding certificate and cannot be channged. The date and time are also recorded when you signed this document");

                }else{

                    return redirect()->back()->with('error', 'There was an undetected errer in affixing your signature');

                }

            }else{

                return redirect()->back()->with('error', "This certificate has already been signed either by you or the person who previosely served this position.");

            }

        }





        // implementation of signatory B - logic 

        if($user_account_type == "SIGNB"){

            if($certificate['SIGNB'] == null){



                $certificate['SIGNB'] = session()->get('userData')['userSignature'];

                 $certificate['SIGNB_id'] = session()->get('userData')['userId'];

                $certificate['SIGNB_signedDate'] = date('Y-m-d');  // Full date format



                if($this->weddingCertModel->update($cert_id, $certificate)){

                    return redirect()->back()->with("success", "Your signature has been affixed to this wedding certificate and cannot be channged. The date and time are also recorded when you signed this document");

                }else{

                    return redirect()->back()->with('error', 'There was an undetected errer in affixing your signature');

                }

            }else{

                                return redirect()->back()->with('error', "You or someone who occupied this position before your tenue have alredy signed this document.");



            }

        }

        

         // implementation of signatory C - logic 

        if($user_account_type == "SIGNC"){

            if($certificate['SIGNC'] == null ){



                $certificate['SIGNC'] = session()->get('userData')['userSignature'];

                $certificate['SIGNC_id'] = session()->get('userData')['userId'];

                $certificate['SIGNC_signedDate'] = date('Y-m-d');  // Full date format



                if($this->weddingCertModel->update($cert_id, $certificate)){

                    return redirect()->back()->with("success", "Your signature has been affixed to this wedding certificate and cannot be channged. The date and time are also recorded when you signed this document");

                }else{

                    return redirect()->back()->with('error', 'There was an undetected errer in affixing your signature');

                }

            }else{

                return redirect()->back()->with('error', "You or someone who occupied this position before your tenue have alredy signed this document.");

            }

        }

        

        return redirect()->back()->with('error', 'Your are not allowed to sign any certificate');

        exit();

        





    }



public function edit($cert_id){



        $data['title'] = 'Edit Marriage Certificate';

        $data['passLink'] = 'certificates';



        // Fetch the certificate to edit

        $certificate = $this->weddingCertModel

            ->where('marriage_cert_id', $cert_id)

            ->first();



        if (!$certificate) {

            return redirect()->back()->with('error', 'Certificate not found.');

        }



        if($certificate['SIGNA'] !== null || $certificate['SIGNB'] !== null || $certificate['SIGNC'] !== null){

            return redirect()->back()->with('error', 'This certificate is locked and cannot be edited. It has already been signed by the required officials.');

        }



        $data['certificate'] = $certificate;



        // Check if the user's branch matches the certificate's branch

        if (session()->get('userData')['userBreanch'] != $certificate['cert_branch']) {

            return redirect()->back()->with('error', 'You do not have permission to edit this certificate. Only the data entry clerk at the branch where the certificate was created can perfom this action');

            exit();

        }



        if (session()->get('userData')['userAccountType'] !== 'ENTRY') {

            return redirect()->back()->with('error', 'Only data entry clerk can edit certificate information. Only the data entry clerk can edit this cerficate');

            exit();

        }



        if (

            !empty($certificate['SIGNA']) &&

            !empty($certificate['SIGNB']) &&

            !empty($certificate['SIGNC'])

        ) {

            return redirect()->back()->with('error', 'This certificate has already been reviewed and signed by all required officials. It cannot be altered.');

            exit();

        }



        if ($this->request->getMethod() === 'post') {

            // Validation rules (reuse from create, adjust file rules for optional upload)

            $rules = [

                // Groom Information

                'groom_name' => 'required|max_length[255]',

                'groom_cell' => 'required|max_length[20]',

                'groom_county_of_origin' => 'required|max_length[100]',

                'groom_nationality' => 'required|max_length[100]',

                'groom_dob' => 'required|valid_date',

                'groom_age' => 'required|integer|greater_than_equal_to[18]',

                'groom_birth_city' => 'required|max_length[100]',

                'groom_birth_county' => 'required|max_length[100]',

                'groom_address' => 'required|max_length[255]',

                'groom_father_name' => 'required|max_length[255]',

                'groom_mother_name' => 'required|max_length[255]',

                // Groom passport photo is optional on edit

                'groom_passport_photo' => [

                    'rules' => 'if_exist|max_size[groom_passport_photo,2048]|is_image[groom_passport_photo]',

                    'errors' => [

                        'max_size' => 'The groom\'s passport photo must not exceed 2MB.',

                        'is_image' => 'The groom\'s passport photo must be an image file.'

                    ]

                ],



                // Bride Information

                'bride_name' => 'required|max_length[255]',

                'bride_cell' => 'required|max_length[20]',

                'bride_county_of_origin' => 'required|max_length[100]',

                'bride_nationality' => 'required|max_length[100]',

                'bride_dob' => 'required|valid_date',

                'bride_age' => 'required|integer|greater_than_equal_to[18]',

                'bride_birth_city' => 'required|max_length[100]',

                'bride_birth_county' => 'required|max_length[100]',

                'bride_address' => 'required|max_length[255]',

                'bride_father_name' => 'required|max_length[255]',

                'bride_mother_name' => 'required|max_length[255]',

                // Bride passport photo is optional on edit

                'bride_passport_photo' => [

                    'rules' => 'if_exist|max_size[bride_passport_photo,2048]|is_image[bride_passport_photo]',

                    'errors' => [

                        'max_size' => 'The bride\'s passport photo must not exceed 2MB.',

                        'is_image' => 'The bride\'s passport photo must be an image file.'

                    ]

                ],



                // Marriage Details

                'place_of_marriage' => 'required|max_length[255]',

                'date_of_marriage' => 'required|valid_date',

                'bride_proposed_name' => 'permit_empty|max_length[255]',



                // Witness & Declaration

                'witness_name' => 'required|max_length[255]',

                'witness_contact' => 'required|max_length[20]',

                'officiator_name' => 'required|max_length[255]',

                'officiator_contact' => 'required|max_length[20]',

                'certificate_cost' => 'required|numeric',

                'certificate_cost_words' => 'required|max_length[255]',

                'declarant_name' => 'required|max_length[255]',

                'declaration_date' => 'required|valid_date',



                // Certification

                'reference_no' => 'required|max_length[50]',

                'marriage_code' => 'required|max_length[50]',

                'revenue_no' => 'permit_empty|max_length[50]',

                'certification_day' => 'required|valid_date',

            ];



            if ($this->request->getPost('groom_married_before') === 'Yes') {

                $rules['groom_previous_marriage_date'] = 'required|valid_date';

                $rules['groom_previous_spouse_name'] = 'required|max_length[255]';

            }



            if ($this->request->getPost('bride_married_before') === 'Yes') {

                $rules['bride_previous_marriage_date'] = 'required|valid_date';

                $rules['bride_previous_spouse_name'] = 'required|max_length[255]';

            }



            if (!$this->validate($rules)) {

                $data['errors'] = $this->validator;

                return view('dashboard/edit_marriage_certificate', $data);

            }



            // Handle file uploads (optional)

            $groomPhoto = $this->request->getFile('groom_passport_photo');

            $bridePhoto = $this->request->getFile('bride_passport_photo');



            $updateData = [

                // Groom Information

                'groom_name' => $this->request->getPost('groom_name'),

                'groom_cell' => $this->request->getPost('groom_cell'),

                'groom_county_of_origin' => $this->request->getPost('groom_county_of_origin'),

                'groom_nationality' => $this->request->getPost('groom_nationality'),

                'groom_dob' => $this->request->getPost('groom_dob'),

                'groom_age' => $this->request->getPost('groom_age'),

                'groom_birth_city' => $this->request->getPost('groom_birth_city'),

                'groom_birth_county' => $this->request->getPost('groom_birth_county'),

                'groom_address' => $this->request->getPost('groom_address'),

                'groom_married_before' => $this->request->getPost('groom_married_before'),

                'groom_previous_marriage_date' => $this->request->getPost('groom_previous_marriage_date'),

                'groom_previous_spouse_name' => $this->request->getPost('groom_previous_spouse_name'),

                'groom_father_name' => $this->request->getPost('groom_father_name'),

                'groom_mother_name' => $this->request->getPost('groom_mother_name'),



                // Bride Information

                'bride_name' => $this->request->getPost('bride_name'),

                'bride_cell' => $this->request->getPost('bride_cell'),

                'bride_county_of_origin' => $this->request->getPost('bride_county_of_origin'),

                'bride_nationality' => $this->request->getPost('bride_nationality'),

                'bride_dob' => $this->request->getPost('bride_dob'),

                'bride_age' => $this->request->getPost('bride_age'),

                'bride_birth_city' => $this->request->getPost('bride_birth_city'),

                'bride_birth_county' => $this->request->getPost('bride_birth_county'),

                'bride_address' => $this->request->getPost('bride_address'),

                'bride_married_before' => $this->request->getPost('bride_married_before'),

                'bride_previous_marriage_date' => $this->request->getPost('bride_previous_marriage_date'),

                'bride_previous_spouse_name' => $this->request->getPost('bride_previous_spouse_name'),

                'bride_father_name' => $this->request->getPost('bride_father_name'),

                'bride_mother_name' => $this->request->getPost('bride_mother_name'),



                // Marriage Details

                'place_of_marriage' => $this->request->getPost('place_of_marriage'),

                'date_of_marriage' => $this->request->getPost('date_of_marriage'),

                'bride_proposed_name' => $this->request->getPost('bride_proposed_name'),



                // Witness & Declaration

                'witness_name' => $this->request->getPost('witness_name'),

                'witness_contact' => $this->request->getPost('witness_contact'),

                'officiator_name' => $this->request->getPost('officiator_name'),

                'officiator_contact' => $this->request->getPost('officiator_contact'),

                'certificate_cost' => $this->request->getPost('certificate_cost'),

                'certificate_cost_words' => $this->request->getPost('certificate_cost_words'),

                'declarant_name' => $this->request->getPost('declarant_name'),

                'declaration_date' => $this->request->getPost('declaration_date'),



                // Certification

                'reference_no' => $this->request->getPost('reference_no'),

                'marriage_code' => $this->request->getPost('marriage_code'),

                'revenue_no' => $this->request->getPost('revenue_no'),

                'certification_date' => $this->request->getPost('certification_day'),





                // System fields

                'last_edited_by' => session()->get('userData')['userId'],

                'updated_at' => date('Y-m-d H:i:s'),

            ];



            // Handle groom photo upload if present

            if ($groomPhoto && $groomPhoto->isValid() && !$groomPhoto->hasMoved()) {

                $groomPhotoName = $groomPhoto->getRandomName();

                $groomPhoto->move(ROOTPATH . 'public/uploads/marriage', $groomPhotoName);

                $updateData['groom_passport_photo'] = $groomPhotoName;

            }



            // Handle bride photo upload if present

            if ($bridePhoto && $bridePhoto->isValid() && !$bridePhoto->hasMoved()) {

                $bridePhotoName = $bridePhoto->getRandomName();

                $bridePhoto->move(ROOTPATH . 'public/uploads/marriage', $bridePhotoName);

                $updateData['bride_passport_photo'] = $bridePhotoName;

            }



            // Update the certificate

            if ($this->weddingCertModel->update($cert_id, $updateData)) {

                return redirect()->to('/weddingcert')->with('success', 'Marriage certificate updated successfully!');

            } else {

                return redirect()->back()->with('error', 'There was an error updating the certificate. Please try again.');

            }

        }



        return view('dashboard/edit_marriage_certificate', $data);

    }



    public function print($cert_id){



        $certificate = $this->weddingCertModel

            ->join('branchs_table', 'branchs_table.branchId = marriage_certificates.cert_branch')

            ->join('login_users', 'login_users.userId = marriage_certificates.ENTRY', 'left')

            ->where('marriage_certificates.marriage_cert_id', $cert_id)

            ->first();



        if (!$certificate) {

            return redirect()->back()->with('error', 'Certificate not found.');

        }



        $data['certificate'] = $certificate;

        $data['title'] = 'Print Marriage Certificate';

        $data['passLink'] = 'certificates';



        $frame = $this->request->getGet('frame');



        if ($frame) {

            $data['frame'] = "/uploads/marriage/template/template.jpeg";

        }else{

            $data['frame'] = '/uploads/marriage/template/template1.jpeg';

        }



        // print_r($certificate);

        // exit();



        return view('dashboard/print_certificate', $data);

    }





    public function create()

    {

        $data['title'] = 'Create Marriage Certificate';

        $data['passLink'] = 'certificates';



        if(session()->get('userData')['userAccountType'] != "ENTRY"){

            return redirect()->back()->with('error', 'Only data entry clerk can log certificate information');

            exit();

        }

       

   

    if($this->request->getMethod() === "post"){

            // Validate form data

        $rules = [

            // Groom Information

            'groom_name' => [

            'label' => 'Groom Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The groom\'s name is required.',

                'max_length' => 'The groom\'s name cannot exceed 255 characters.'

            ]

            ],

            'groom_cell' => [

            'label' => 'Groom Cell',

            'rules' => 'required|max_length[20]',

            'errors' => [

                'required' => 'The groom\'s cell number is required.',

                'max_length' => 'The groom\'s cell number cannot exceed 20 characters.'

            ]

            ],

            'groom_county_of_origin' => [

            'label' => 'Groom County of Origin',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The groom\'s county of origin is required.',

                'max_length' => 'The groom\'s county of origin cannot exceed 100 characters.'

            ]

            ],

            'groom_nationality' => [

            'label' => 'Groom Nationality',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The groom\'s nationality is required.',

                'max_length' => 'The groom\'s nationality cannot exceed 100 characters.'

            ]

            ],

            'groom_dob' => [

            'label' => 'Groom Date of Birth',

            'rules' => 'required|valid_date',

            'errors' => [

                'required' => 'The groom\'s date of birth is required.',

                'valid_date' => 'Please provide a valid date for the groom\'s date of birth.'

            ]

            ],

            'groom_age' => [

            'label' => 'Groom Age',

            'rules' => 'required|integer|greater_than_equal_to[18]',

            'errors' => [

                'required' => 'The groom\'s age is required.',

                'integer' => 'The groom\'s age must be a number.',

                'greater_than_equal_to' => 'The groom must be at least 18 years old.'

            ]

            ],

            'groom_birth_city' => [

            'label' => 'Groom Birth City',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The groom\'s birth city is required.',

                'max_length' => 'The groom\'s birth city cannot exceed 100 characters.'

            ]

            ],

            'groom_birth_county' => [

            'label' => 'Groom Birth County',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The groom\'s birth county is required.',

                'max_length' => 'The groom\'s birth county cannot exceed 100 characters.'

            ]

            ],

            'groom_address' => [

            'label' => 'Groom Address',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The groom\'s address is required.',

                'max_length' => 'The groom\'s address cannot exceed 255 characters.'

            ]

            ],

           

            'groom_father_name' => [

            'label' => 'Groom Father Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The groom\'s father name is required.',

                'max_length' => 'The groom\'s father name cannot exceed 255 characters.'

            ]

            ],

            'groom_mother_name' => [

            'label' => 'Groom Mother Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The groom\'s mother name is required.',

                'max_length' => 'The groom\'s mother name cannot exceed 255 characters.'

            ]

            ],

            'groom_passport_photo' => [

            'label' => 'Groom Passport Photo',

            'rules' => 'uploaded[groom_passport_photo]|max_size[groom_passport_photo,2048]|is_image[groom_passport_photo]',

            'errors' => [

                'uploaded' => 'The groom\'s passport photo is required.',

                'max_size' => 'The groom\'s passport photo must not exceed 2MB.',

                'is_image' => 'The groom\'s passport photo must be an image file.'

            ]

            ],



            // Bride Information

            'bride_name' => [

            'label' => 'Bride Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The bride\'s name is required.',

                'max_length' => 'The bride\'s name cannot exceed 255 characters.'

            ]

            ],

            'bride_cell' => [

            'label' => 'Bride Cell',

            'rules' => 'required|max_length[20]',

            'errors' => [

                'required' => 'The bride\'s cell number is required.',

                'max_length' => 'The bride\'s cell number cannot exceed 20 characters.'

            ]

            ],

            'bride_county_of_origin' => [

            'label' => 'Bride County of Origin',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The bride\'s county of origin is required.',

                'max_length' => 'The bride\'s county of origin cannot exceed 100 characters.'

            ]

            ],

            'bride_nationality' => [

            'label' => 'Bride Nationality',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The bride\'s nationality is required.',

                'max_length' => 'The bride\'s nationality cannot exceed 100 characters.'

            ]

            ],

            'bride_dob' => [

            'label' => 'Bride Date of Birth',

            'rules' => 'required|valid_date',

            'errors' => [

                'required' => 'The bride\'s date of birth is required.',

                'valid_date' => 'Please provide a valid date for the bride\'s date of birth.'

            ]

            ],

            'bride_age' => [

            'label' => 'Bride Age',

            'rules' => 'required|integer|greater_than_equal_to[18]',

            'errors' => [

                'required' => 'The bride\'s age is required.',

                'integer' => 'The bride\'s age must be a number.',

                'greater_than_equal_to' => 'The bride must be at least 18 years old.'

            ]

            ],

            'bride_birth_city' => [

            'label' => 'Bride Birth City',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The bride\'s birth city is required.',

                'max_length' => 'The bride\'s birth city cannot exceed 100 characters.'

            ]

            ],

            'bride_birth_county' => [

            'label' => 'Bride Birth County',

            'rules' => 'required|max_length[100]',

            'errors' => [

                'required' => 'The bride\'s birth county is required.',

                'max_length' => 'The bride\'s birth county cannot exceed 100 characters.'

            ]

            ],

            'bride_address' => [

            'label' => 'Bride Address',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The bride\'s address is required.',

                'max_length' => 'The bride\'s address cannot exceed 255 characters.'

            ]

            ],

    

            'bride_father_name' => [

            'label' => 'Bride Father Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The bride\'s father name is required.',

                'max_length' => 'The bride\'s father name cannot exceed 255 characters.'

            ]

            ],

            'bride_mother_name' => [

            'label' => 'Bride Mother Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The bride\'s mother name is required.',

                'max_length' => 'The bride\'s mother name cannot exceed 255 characters.'

            ]

            ],

            'bride_passport_photo' => [

            'label' => 'Bride Passport Photo',

            'rules' => 'uploaded[bride_passport_photo]|max_size[bride_passport_photo,2048]|is_image[bride_passport_photo]',

            'errors' => [

                'uploaded' => 'The bride\'s passport photo is required.',

                'max_size' => 'The bride\'s passport photo must not exceed 2MB.',

                'is_image' => 'The bride\'s passport photo must be an image file.'

            ]

            ],



            // Marriage Details

            'place_of_marriage' => [

            'label' => 'Place of Marriage',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The place of marriage is required.',

                'max_length' => 'The place of marriage cannot exceed 255 characters.'

            ]

            ],

            'date_of_marriage' => [

            'label' => 'Date of Marriage',

            'rules' => 'required|valid_date',

            'errors' => [

                'required' => 'The date of marriage is required.',

                'valid_date' => 'Please provide a valid date for the marriage.'

            ]

            ],

            'bride_proposed_name' => [

            'label' => 'Bride Proposed Name',

            'rules' => 'permit_empty|max_length[255]',

            'errors' => [

                'max_length' => 'The bride\'s proposed name cannot exceed 255 characters.'

            ]

            ],



            // Witness & Declaration

            'witness_name' => [

            'label' => 'Witness Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The witness name is required.',

                'max_length' => 'The witness name cannot exceed 255 characters.'

            ]

            ],

            'witness_contact' => [

            'label' => 'Witness Contact',

            'rules' => 'required|max_length[20]',

            'errors' => [

                'required' => 'The witness contact is required.',

                'max_length' => 'The witness contact cannot exceed 20 characters.'

            ]

            ],

            'officiator_name' => [

            'label' => 'Officiator Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The officiator name is required.',

                'max_length' => 'The officiator name cannot exceed 255 characters.'

            ]

            ],

            'officiator_contact' => [

            'label' => 'Officiator Contact',

            'rules' => 'required|max_length[20]',

            'errors' => [

                'required' => 'The officiator contact is required.',

                'max_length' => 'The officiator contact cannot exceed 20 characters.'

            ]

            ],

            'certificate_cost' => [

            'label' => 'Certificate Cost',

            'rules' => 'required|numeric',

            'errors' => [

                'required' => 'The certificate cost is required.',

                'numeric' => 'The certificate cost must be a number.'

            ]

            ],

            'certificate_cost_words' => [

            'label' => 'Certificate Cost (in Words)',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The certificate cost in words is required.',

                'max_length' => 'The certificate cost in words cannot exceed 255 characters.'

            ]

            ],

            'declarant_name' => [

            'label' => 'Declarant Name',

            'rules' => 'required|max_length[255]',

            'errors' => [

                'required' => 'The declarant name is required.',

                'max_length' => 'The declarant name cannot exceed 255 characters.'

            ]

            ],

            'declaration_date' => [

            'label' => 'Declaration Date',

            'rules' => 'required|valid_date',

            'errors' => [

                'required' => 'The declaration date is required.',

                'valid_date' => 'Please provide a valid date for the declaration.'

            ]

            ],



            // Certification



            

            'revenue_no' => [

            'label' => 'Revenue Number',

            'rules' => 'permit_empty|max_length[50]',

            'errors' => [

                'max_length' => 'The revenue number cannot exceed 50 characters.'

            ]

            ],

            'certification_day' => [

            'label' => 'Certification Date',

            'rules' => 'required|valid_date',

            'errors' => [

                'required' => 'The certification date is required.',

                'valid_date' => 'Please provide a valid date for the certification.'

            ]

            ],

        ];



        if ($this->request->getPost('groom_married_before') === 'Yes') {

            $rules['groom_previous_marriage_date'] = [

                'label' => 'Groom Previous Marriage Date',

                'rules' => 'required|valid_date',

                'errors' => [

                    'required' => 'The groom\'s previous marriage date is required.',

                    'valid_date' => 'Please provide a valid date for the groom\'s previous marriage.'

                ]

            ];

            $rules['groom_previous_spouse_name'] = [

                'label' => 'Groom Previous Spouse Name',

                'rules' => 'required|max_length[255]',

                'errors' => [

                    'required' => 'The groom\'s previous spouse name is required.',

                    'max_length' => 'The groom\'s previous spouse name cannot exceed 255 characters.'

                ]

            ];

        }



        if ($this->request->getPost('bride_married_before') === 'Yes') {

            $rules['bride_previous_marriage_date'] = [

                'label' => 'Bride Previous Marriage Date',

                'rules' => 'required|valid_date',

                'errors' => [

                    'required' => 'The bride\'s previous marriage date is required.',

                    'valid_date' => 'Please provide a valid date for the bride\'s previous marriage.'

                ]

            ];

            $rules['bride_previous_spouse_name'] = [

                'label' => 'Bride Previous Spouse Name',

                'rules' => 'required|max_length[255]',

                'errors' => [

                    'required' => 'The bride\'s previous spouse name is required.',

                    'max_length' => 'The bride\'s previous spouse name cannot exceed 255 characters.'

                ]

            ];

        }



        if (!$this->validate($rules)) {

            $data['errors'] = $this->validator;

            print_r($data['errors']->listErrors());

            exit();

            

        }else{

             // Handle file uploads

        $groomPhoto = $this->request->getFile('groom_passport_photo');

        $bridePhoto = $this->request->getFile('bride_passport_photo');



        // Generate unique filenames

        $groomPhotoName = $groomPhoto->getRandomName();

        $bridePhotoName = $bridePhoto->getRandomName();



        // Move files to upload directory

        $groomPhoto->move('uploads/marriage', $groomPhotoName);

        $bridePhoto->move('uploads/marriage', $bridePhotoName);



        // Prepare data for database

        $data = [

            // Groom Information

            'groom_name' => $this->request->getPost('groom_name'),

            'groom_cell' => $this->request->getPost('groom_cell'),

            'groom_county_of_origin' => $this->request->getPost('groom_county_of_origin'),

            'groom_nationality' => $this->request->getPost('groom_nationality'),

            'groom_dob' => $this->request->getPost('groom_dob'),

            'groom_age' => $this->request->getPost('groom_age'),

            'groom_birth_city' => $this->request->getPost('groom_birth_city'),

            'groom_birth_county' => $this->request->getPost('groom_birth_county'),

            'groom_address' => $this->request->getPost('groom_address'),

            'groom_married_before' => $this->request->getPost('groom_married_before'),

            'groom_previous_marriage_date' => $this->request->getPost('groom_previous_marriage_date'),

            'groom_previous_spouse_name' => $this->request->getPost('groom_previous_spouse_name'),

            'groom_father_name' => $this->request->getPost('groom_father_name'),

            'groom_mother_name' => $this->request->getPost('groom_mother_name'),

            'groom_passport_photo' => $groomPhotoName,



            // Bride Information

            'bride_name' => $this->request->getPost('bride_name'),

            'bride_cell' => $this->request->getPost('bride_cell'),

            'bride_county_of_origin' => $this->request->getPost('bride_county_of_origin'),

            'bride_nationality' => $this->request->getPost('bride_nationality'),

            'bride_dob' => $this->request->getPost('bride_dob'),

            'bride_age' => $this->request->getPost('bride_age'),

            'bride_birth_city' => $this->request->getPost('bride_birth_city'),

            'bride_birth_county' => $this->request->getPost('bride_birth_county'),

            'bride_address' => $this->request->getPost('bride_address'),

            'bride_married_before' => $this->request->getPost('bride_married_before'),

            'bride_previous_marriage_date' => $this->request->getPost('bride_previous_marriage_date'),

            'bride_previous_spouse_name' => $this->request->getPost('bride_previous_spouse_name'),

            'bride_father_name' => $this->request->getPost('bride_father_name'),

            'bride_mother_name' => $this->request->getPost('bride_mother_name'),

            'bride_passport_photo' => $bridePhotoName,



            // Marriage Details

            'place_of_marriage' => $this->request->getPost('place_of_marriage'),

            'date_of_marriage' => $this->request->getPost('date_of_marriage'),

            'bride_proposed_name' => $this->request->getPost('bride_proposed_name'),



            // Witness & Declaration

            'witness_name' => $this->request->getPost('witness_name'),

            'witness_contact' => $this->request->getPost('witness_contact'),

            'officiator_name' => $this->request->getPost('officiator_name'),

            'officiator_contact' => $this->request->getPost('officiator_contact'),

            'certificate_cost' => $this->request->getPost('certificate_cost'),

            'certificate_cost_words' => $this->request->getPost('certificate_cost_words'),

            'declarant_name' => $this->request->getPost('declarant_name'),

            'declaration_date' => $this->request->getPost('declaration_date'),



            // Certification

            'revenue_no' => $this->request->getPost('revenue_no'),

            'certification_date' => $this->request->getPost('certification_day'),

            'cert_branch' => session()->get('userData')['userBreanch'],



            // System fields

            'ENTRY' => session()->get('userData')['userId'],

            'created_at' => date('Y-m-d H:i:s'),

        ];



        // Save to database

        if ($this->weddingCertModel->save($data)) {

            return redirect()->back()->with('success', 'Marriage certificate created successfully!');

        }else{

            return redirect()->back()->with('error', 'There was saving error please try again');

        }



        }

    }

        return view('dashboard/create_marriage_certificate', $data);



    }



    // In your Wedcert controller

public function getSignerDetails()

{

    $signatureFile = $this->request->getPost('signature_file');

    

    $signer = $this->userModel->where('userId', $signatureFile)

                    ->join('branchs_table', "branchs_table.branchId = $signatureFile")

                    ->first();

    

    if ($signer) {

        return $this->response->setJSON([

            'success' => true,

            'data' => $signer

        ]);

    } else {

        return $this->response->setJSON([

            'success' => false,

            'message' => 'Signer not found'

        ]);

    }

}





public function allow_edit($cert_id)

{

    $data['title'] = 'Edit Marriage Certificate';

    $data['passLink'] = 'certificates';



    // Check if the certificate exists

    $certificate = $this->weddingCertModel->find($cert_id);

    if (!$certificate) {

        return redirect()->back()->with('error', 'Certificate not found.');

    }



    $data['certificate'] = $certificate;



    // check if the user is at the same branch as the certificate

    if (session()->get('userData')['userBreanch'] != $certificate['cert_branch']) {

        return redirect()->back()->with('error', 'You are not allowed to edit this certificate.');

    }



    // only allow edit if the user account type is SIGNC 

    if (session()->get('userData')['userAccountType'] != "SIGNC") {

        return redirect()->back()->with('error', 'Only authorized users can allow edit on this certificate.');

    }



    if($certificate["SIGNC"] != null){



        $certificate["SIGNC"] = null; // clear the SIGNC field to allow edit

        $certificate['SIGNC_id'] = null; 

        $certificate['SIGNC_signedDate'] = null; 



        // perform update

        if($this->weddingCertModel->update($cert_id, $certificate)){

            return redirect()->back()->with('success', 'Certificate edit allowed successfully!');

        } else {

            return redirect()->back()->with('error', 'There was an error allowing edit on the certificate. Please try again.');

        }

    }else{

        return redirect()->back()->with('error', 'Certificate is already allowed for edit.');

    }



}



}
<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Publiccontroller');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->post('/marriage-portal/chat', 'HomeController::chat');
$routes->get('/auth', 'AuthController::index');
$routes->post('/auth', 'AuthController::index');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/verify/(:any)', 'AuthController::verify/$1');
$routes->get('auth/unlock/(:any)', 'AuthController::unlock/$1');

$routes->get('/v', 'VerificationController::index');
$routes->post('/v', 'VerificationController::index');
$routes->get('/b/(:any)', 'HomeController::viewBranch/$1'); // the to the branch page


$routes->get('/instrunction/(:any)', 'VerificationController::instrunction/$1'); // the to the instrunction page


$routes->get('/wedcert/create', 'PublicWeddingCertController::apply');
$routes->post('/wedcert/create', 'PublicWeddingCertController::apply');


$routes->set404Override('App\Controllers\Errors::show404');



// ========== ADMIN ACCESS ONLY ==========

$routes->group("", ['filter'=>'agentProtector'], function($routes){

// dashboard home 
$routes->get('/matrimonial_dashboard', 'WeddingNDivorceDashboard::index');
$routes->get('/matrimonial_dashboard/general', 'WeddingNDivorceDashboard::general_dashboard');


//================== USER MANAGEMENT ROUTES ==============

// create users
$routes->get('/matrimonial_dashboard/users', 'UserController::index'); // view all users 
$routes->get('/matrimonial_dashboard/users/view/(:num)', 'UserController::view/$1'); // view all users 

$routes->get('/matrimonial_dashboard/users/edit/(:num)', 'UserController::edit/$1'); // view to edit user 
$routes->post('/matrimonial_dashboard/users/edit/(:num)', 'UserController::edit/$1'); // save edit

$routes->get('/matrimonial_dashboard/users/create', 'UserController::create'); // load the create user form
$routes->post('/matrimonial_dashboard/users/create', 'UserController::create'); // process the create user form
// activate or deactivate user account
$routes->get('/matrimonial_dashboard/users/activate/(:num)', 'UserController::activate/$1'); // activate or deactivate user account



// ================= BRANCH MANAGEMENT ROUTES ==========================
$routes->get('/matrimonial_dashboard/branches', 'BranchController::index');
$routes->get('/matrimonial_dashboard/branches/view/(:num)', 'BranchController::view/$1');
$routes->get('/matrimonial_dashboard/branches/create', 'BranchController::create');
$routes->post('/matrimonial_dashboard/branches/create', 'BranchController::create');
// edit branches 
$routes->get('/matrimonial_dashboard/branches/edit/(:num)', 'BranchController::edit/$1'); // process the edit user form 
$routes->post('/matrimonial_dashboard/branches/edit/(:num)', 'BranchController::edit/$1'); // process the edit user form 
// deactivate or activate branches
$routes->get('/matrimonial_dashboard/branches/deactivate/(:num)', 'BranchController::deactivate/$1'); // deactivate or activate branches


// ================ MARRIAGE CERT ==========================
$routes->get('/matrimonial_dashboard/wedcert/', 'WeddingCertController::index');
$routes->get('/matrimonial_dashboard/wedcert/view/(:num)', 'WeddingCertController::view/$1');

$routes->get('/matrimonial_dashboard/wedcert/print/(:num)', 'WeddingCertController::print/$1');

$routes->get('/matrimonial_dashboard/wedcert/edit/(:num)', 'WeddingCertController::edit/$1');
$routes->post('/matrimonial_dashboard/wedcert/edit/(:num)', 'WeddingCertController::edit/$1');

$routes->get('/matrimonial_dashboard/wedcert/sign/(:num)', 'WeddingCertController::sign/$1');

$routes->get('/matrimonial_dashboard/wedcert/create', 'WeddingCertController::create');
$routes->post('/matrimonial_dashboard/wedcert/create', 'WeddingCertController::create');
$routes->get('/matrimonial_dashboard/wedcert/allow_edit/(:num)', 'WeddingCertController::allow_edit/$1'); // allow edit for the certificate
$routes->get('/matrimonial_dashboard/wedcert/issue/(:num)', 'WeddingCertController::mark_as_issued/$1'); // mark as issued 



$routes->post('/matrimonial_dashboard/certificate_files/upload_file/(:num)', 'FileUploadController::upload_certificate_file/$1');
$routes->get('/matrimonial_dashboard/certificate_files/delete/(:num)/(:num)', 'FileUploadController::delete/$1/$2');


// divorce certificate routes 
$routes->get('/matrimonial_dashboard/divorce_cert', 'DivorceCertificateController::index');
$routes->get('/matrimonial_dashboard/divorce_cert/create', 'DivorceCertificateController::create');
$routes->post('/matrimonial_dashboard/divorce_cert/create', 'DivorceCertificateController::create');
$routes->get('/matrimonial_dashboard/divorce_cert/view/(:num)', 'DivorceCertificateController::view/$1');
$routes->get('/matrimonial_dashboard/divorce_cert/sign/(:num)', 'DivorceCertificateController::sign/$1');
$routes->get('/matrimonial_dashboard/divorce_cert/generate_certificate/(:num)', 'DivorceCertificateController::generate_certificate/$1');
$routes->get('/matrimonial_dashboard/edit_divorce_cert/(:num)', 'DivorceCertificateController::edit_certificate/$1');
$routes->post('/matrimonial_dashboard/edit_divorce_cert/(:num)', 'DivorceCertificateController::edit_certificate/$1');
$routes->get('/matrimonial_dashboard/divorce_cert/allow_edit/(:num)', 'DivorceCertificateController::allow_edit/$1');

// native certificate management routes 
$routes->get('/matrimonial_dashboard/nativecert', 'NativeDocCertController::index'); ///
$routes->get('/matrimonial_dashboard/nativecert/create', 'NativeDocCertController::new'); 
$routes->post('/matrimonial_dashboard/nativecert/store', 'NativeDocCertController::create'); 
$routes->get('/matrimonial_dashboard/nativecert/view/(:any)', 'NativeDocCertController::view/$1'); // 
$routes->get('/matrimonial_dashboard/nativecert/print/(:any)', 'NativeDocCertController::print/$1');
$routes->get('/nativecert/add-signatories/(:any)', 'NativeDocCertController::addSignatories/$1');
$routes->get('/matrimonial_dashboard/nativecert/edit/(:any)', 'NativeDocCertController::edit/$1');
$routes->post('/matrimonial_dashboard/nativecert/update/(:any)', 'NativeDocCertController::update/$1');
$routes->get('/matrimonial_dashboard/nativecert/issue-certificate/(:any)', 'NativeDocCertController::issue/$1');
$routes->get('/matrimonial_dashboard/nativecert/delete/(:any)', 'NativeDocCertController::delete/$1');
$routes->get('matrimonial_dashboard/nativecert/general', 'NativeDocCertController::generalDashboard');

$routes->get('/matrimonial_dashboard/admin', 'AdminController::index'); /// admin dashboard home
$routes->get('/matrimonial_dashboard/admin/user_list', 'AdminController::usersList'); ///view users on adman dashboard
$routes->get('/matrimonial_dashboard/admin/branch_list', 'AdminController::branchList'); ///view branches on adman dashboard

});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

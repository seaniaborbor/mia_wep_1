

<?php 
// make user session data available all over the page
$userData = session()->get('userData');

// print_r($userData);
// exit();

// this will dynamically make active or collasp open a pan
 function mark_active($typeLink, $passLink)
    {
        if($typeLink == $passLink){
            echo "show";
        }
    }

  
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MIA-Database</title>

    <!-- Custom fonts for this template-->
    <link href="/dashboard_asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/dashboard_asset/css/sb-admin-2.min.css" rel="stylesheet">
<!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery (required for DataTables) -->

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>

<!-- Optional: Buttons extension CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
<style>
    body, h1, h2, h3, h4, h5, h6, 
    .card, .table, .nav-tabs, .badge, 
    .btn, .form-control, .dropdown-menu {
        font-family: "Times New Roman", Times, serif !important;
    }
</style>
</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-start" href="/dashboard">
               <img src="/dashboard_asset/img/mialogo.PNG" alt="" width="50" height="50">
                <div class="sidebar-brand-text mx-3">Matrimonial Database</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Certificates</span>
                </a>
                <div id="collapseTwo" class="collapse <?= mark_active('certificates', $passLink) ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Marriage Certificate</h6>
                        <a class="collapse-item" href="/dashboard/wedcert">Marriage Cert. Log</a>
                        <a class="collapse-item" href="/dashboard/wedcert/create">Issue Marriage Cert.  </a>
                        <?php if($userData['userBreanch'] == 1): ?>
                            <h6 class="collapse-header">Divorce Certificate</h6>
                            <a class="collapse-item" href="/dashboard/divorce_cert">Divorce Cert. Log </a>
                            <a class="collapse-item" href="/dashboard/divorce_cert/create">Issue Divorce Cert.</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Manage Users</span>
                </a>
                <div id="collapseUtilities" class="collapse <?= mark_active('users', $passLink) ?>" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions</h6>
                        <a class="collapse-item" href="/dashboard/users">View Users</a>
                        <?php if($userData['userBreanch'] == 1): ?>
                            <a class="collapse-item" href="/dashboard/users/create">Create User</a>                           
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Manage Branches</span>
                </a>
                <div id="collapsePages" class="collapse <?= mark_active('branches', $passLink) ?>" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Actions</h6>
                        <a class="collapse-item" href="/dashboard/branches">View Branches</a>
                        <?php if($userData['userBreanch'] == 1): ?>
                        <a class="collapse-item" href="/dashboard/branches/create">Create Branche</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                      <a href="#" class="navbar-brand">
                            <h6 class="text-primary text-uppercase fw-bold">
                                <?= $userData['branchName'] ?>
                            </h6>
                        </a>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                      
                           <!-- Marriage Certificate Notifications -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="marriageMessagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ring"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter marriage-counter">0</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="marriageMessagesDropdown">
            <h6 class="dropdown-header">
                Marriage Cert. Notifications
            </h6>
        </div>
    </li>

    <!-- Divorce Certificate Notifications -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="divorceMessagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-heart-broken"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter divorce-counter">0</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="divorceMessagesDropdown">
            <h6 class="dropdown-header">
                Divorce Cert. Notifications
            </h6>
        </div>
    </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$userData['userFullName']?></span>
                                <img class="img-profile rounded-circle"
                                    src="/uploads/users/pictures/<?=$userData['userPicture']?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/dashboard/users/view/<?=$userData['userId']?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="/dashboard/users/edit/<?=$userData['userId']?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Log out
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?=$this->renderSection('main')?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php if (session()->getFlashdata('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?= esc(session()->getFlashdata('success')) ?>',
        confirmButtonColor: '#3085d6'
    });
</script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= esc(session()->getFlashdata('error')) ?>',
        confirmButtonColor: '#d33'
    });
</script>
<?php endif; ?>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/dashboard_asset/vendor/jquery/jquery.min.js"></script>
    <script src="/dashboard_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/dashboard_asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/dashboard_asset/js/sb-admin-2.min.js"></script>



    <!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>

<!-- Optional: Buttons extension -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> -->

<!-- Initialization script -->
<script>
$(document).ready(function() {
    // Initialize DataTable for the first table
    $('.datatable2').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            paginate: {
                previous: "<i class='fas fa-angle-left'></i>",
                next: "<i class='fas fa-angle-right'></i>"
            }
        }
    });

    // Initialize DataTable for the second table
    $('.datatable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            paginate: {
                previous: "<i class='fas fa-angle-left'></i>",
                next: "<i class='fas fa-angle-right'></i>"
            }
        }
    });
});
</script>

<script>
function fetchNotifications() {
    $.ajax({
        url: '/dashboard/ajax/show_notification',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success' && response.notifications.length > 0) {
                const notifications = response.notifications;
                
                // Separate marriage and divorce notifications
                const marriageNotifications = notifications.filter(notif => notif.certificate_type === 'marriage');
                const divorceNotifications = notifications.filter(notif => notif.certificate_type === 'divorce');
                
                // Process marriage notifications
                processNotificationType(marriageNotifications, 'marriage');
                
                // Process divorce notifications
                processNotificationType(divorceNotifications, 'divorce');
            } else {
                // No notifications - clear both
                clearNotifications('marriage');
                clearNotifications('divorce');
            }
        },
        error: function(xhr, status, error) {
            console.error("Notification fetch error:", error);
        }
    });
}

function processNotificationType(notifications, type) {
    if (notifications.length > 0) {
        const messageList = $(`.dropdown-menu[aria-labelledby="${type}MessagesDropdown"]`);
        const badgeCounter = $(`.${type}-counter`);
        
        // Remove old notification items (but leave header)
        messageList.find('.dropdown-item.d-flex').remove();
        
        // Add each notification
        notifications.forEach(notif => {
            const link = `/dashboard/${type === 'marriage' ? 'wedcert' : 'divorce_cert'}/view/${notif.certificate_id}`;
            const messageItem = `
                <a class="dropdown-item d-flex align-items-center" href="${link}">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="/uploads/users/pictures/${notif.userPicture || 'default-user.jpg'}" alt="User">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">${decodeHtml(notif.comment_text)}</div>
                        <div class="small text-gray-500">${notif.userFullName} · ${formatDate(notif.date_notified)}</div>
                    </div>
                </a>
            `;
            $(messageItem).insertAfter(messageList.find('.dropdown-header'));
        });

        // Update badge
        badgeCounter.text(notifications.length).removeClass('d-none');

        // Add footer if not present
        if (messageList.find('.dropdown-item.text-center').length === 0) {
            messageList.append(`
                <a class="dropdown-item text-center small text-gray-500" href="/dashboard/${type === 'marriage' ? 'wedcert' : 'divorce_cert'}">Read More Messages</a>
            `);
        }
    } else {
        clearNotifications(type);
    }
}

function clearNotifications(type) {
    $(`.dropdown-menu[aria-labelledby="${type}MessagesDropdown"] .dropdown-item.d-flex`).remove();
    $(`.${type}-counter`).addClass('d-none');
}

// Utility: Format date to readable format
function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

// Utility: Decode HTML entities
function decodeHtml(html) {
    const txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}

// Poll every 5 seconds
setInterval(fetchNotifications, 5000);
$(document).ready(fetchNotifications);
</script>


</body>

</html>
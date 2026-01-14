 <a class="sidebar-brand d-flex align-items-center justify-content-start" href="/cultural_dashboard/nativecert">
    <img src="/dashboard_asset/img/soft_logo.png" alt="" class="img-fluid">
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="/cultural_dashboard/nativecert">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

    <!-- Divider -->
<hr class="sidebar-divider">
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item ">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Manage Certificates</span>
    </a>
    <div id="collapseTwo" class="collapse <?= mark_active('certificates', $passLink) ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cultural Certificates</h6>
                <a class="collapse-item" href="/cultural_dashboard/nativecert"> Certificate Log</a>
                <a class="collapse-item" href="/cultural_dashboard/nativecert/create"> Create Certificate</a>
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
            <a class="collapse-item" href="/cultural_dashboard/users">View Users</a>
        </div>
    </div>
</li>


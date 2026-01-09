
<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-start" href="/matrimonial_dashboard">
        <img src="/dashboard_asset/img/soft_logo.png" alt="" class="img-fluid">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/matrimonial_dashboard">
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
                <a class="collapse-item" href="/matrimonial_dashboard/wedcert">Marriage Cert. Log</a>
                <a class="collapse-item" href="/matrimonial_dashboard/divorce_cert">Divorce Cert. Log</a>
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
            <a class="collapse-item" href="/matrimonial_dashboard/users">View Users</a>
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
            <a class="collapse-item" href="/matrimonial_dashboard/branches">View Branches</a>
            
            <a class="collapse-item" href="/matrimonial_dashboard/branches/create">Create Branche</a>
        </div>
    </div>
</li>

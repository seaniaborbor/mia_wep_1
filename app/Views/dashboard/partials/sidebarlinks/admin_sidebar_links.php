<!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-start" href="/system_admin_dashboard">
               <img src="/dashboard_asset/img/soft_logo.png" alt="" class="img-fluid">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/system_admin/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

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
                    <a class="collapse-item" href="/system_admin/users">View Users</a>
                    <a class="collapse-item" href="/system_admin/users/create">Create Users</a>
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
                    <a class="collapse-item" href="/system_admin/branches">View Branches</a>
                    <a class="collapse-item" href="/system_admin/branches/create">Create Branche</a>
                </div>
            </div>
        </li>

         <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item ">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseApiUsers" aria-expanded="true"
                aria-controls="collapseApiUsers">
                <i class="fas fa-fw fa-folder"></i>
                <span>API</span>
            </a>
            <div id="collapseApiUsers" class="collapse <?= mark_active('branches', $passLink) ?>" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Actions</h6>
                    <a class="collapse-item" href="/system_admin/branches">API Clients</a>
                    <a class="collapse-item" href="/system_admin/branches/create">API Doc</a>
                </div>
            </div>
        </li>

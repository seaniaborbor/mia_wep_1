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
                <a class="collapse-item" href="/dashboard/nativecert"> Create Certificate</a>
                <a class="collapse-item" href="/dashboard/nativecert"> Certificate Log</a>
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
        </div>
    </div>
</li>


<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>

<div class="row">
    <div class="col-md-8">
        <div class="card border-bottom-primary shadow-sm">
           <div class="card-header text-primary">
             <h4 class="mb-0">
                <i class="fas fa-user-plus"></i> User Account Creation Guidelines
            </h4>
           </div>
            <div class="card-body">
                <?php include('partials/forms/create_user_account.php')?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-bottom-danger">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0">
            <i class="fas fa-user-shield"></i> User Account Creation Guidelines
        </h5>
    </div>
    <div class="card-body">
        <p class="card-text">
            Please read the following rules carefully before creating a user account. These policies help ensure that account management remains secure, organized, and traceable across all branches.
        </p>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <i class="fas fa-users-cog text-secondary mr-2"></i>
                Two users with the same account type cannot exist under the same branch unless the previous one is blocked.
            </li>
            <li class="list-group-item">
                <i class="fas fa-pen-fancy text-info mr-2"></i>
                All users—except those with the "Entry" account type—must provide a scanned signature image with a transparent background.
            </li>
            <li class="list-group-item">
                <i class="fas fa-lock text-danger mr-2"></i>
                Once created, a user account cannot be deleted if it is linked to any certificate.
            </li>
            <li class="list-group-item">
                <i class="fas fa-image text-primary mr-2"></i>
                A profile picture is required for every user account.
            </li>
            <li class="list-group-item">
                <i class="fas fa-file-pdf text-danger mr-2"></i>
                A PDF copy of the application file must be uploaded during account creation.
            </li>
        </ul>
    </div>
</div>

    </div>
</div>

<?=$this->endSection()?>
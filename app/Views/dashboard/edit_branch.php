<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>

<div class="row">
    <div class="col-md-8">
        <div class="card border-bottom-primary shadow-sm">
           <div class="card-header text-primary">
             <h4 class="mb-0">
                <i class="fas fa-building"></i> Create a branch account
            </h4>
           </div>
            <div class="card-body">
                <?php include('partials/forms/edit_branch_account.php')?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
     <div class="card shadow-sm border-bottom-danger">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Account Creation Policy</h5>
    </div>
    <div class="card-body">
        <p class="card-text">
            Before creating a new account, please take note of the following policies. These rules help ensure data integrity, prevent duplication, and protect account-related records in the system.
        </p>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <i class="fas fa-globe-africa text-success mr-2"></i>
                A single county can have as many accounts as needed.
            </li>
            <li class="list-group-item">
                <i class="fas fa-ban text-danger mr-2"></i>
                Each account must be unique—duplicate accounts are not allowed.
            </li>
            <li class="list-group-item">
                <i class="fas fa-file-signature text-warning mr-2"></i>
                Accounts that are linked to certificates cannot be deleted; they can only be closed.
            </li>
        </ul>
    </div>
</div>


    </div>
</div>

<?=$this->endSection()?>
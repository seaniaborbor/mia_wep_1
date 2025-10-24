<form action="/dashboard/users/edit/<?= esc($user['userId']) ?>" method="post" enctype="multipart/form-data" class="user-edit-form">
    <?= csrf_field() ?>

    <!-- Full Name -->
    <div class="form-group">
        <label for="userFullName">Full Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="userFullName" id="userFullName"
                   class="form-control <?= validation_show_error('userFullName') ? 'is-invalid' : '' ?>"
                   value="<?= old('userFullName', $user['userFullName'] ?? '') ?>">
            <div class="invalid-feedback"><?= validation_show_error('userFullName') ?></div>
        </div>
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="userEmail">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" name="userEmail" id="userEmail" disabled
                   class="form-control <?= validation_show_error('userEmail') ? 'is-invalid' : '' ?>"
                   value="<?= old('userEmail', $user['userEmail'] ?? '') ?>">
            <div class="invalid-feedback"><?= validation_show_error('userEmail') ?></div>
        </div>
    </div>

    <!-- Phone Number -->
    <div class="form-group">
        <label for="userPhone">Phone Number</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="tel" name="userPhone" id="userPhone"
                   class="form-control <?= validation_show_error('userPhone') ? 'is-invalid' : '' ?>"
                   value="<?= old('userPhone', $user['userPhone'] ?? '') ?>">
            <div class="invalid-feedback"><?= validation_show_error('userPhone') ?></div>
        </div>
    </div>

    <!-- Position -->
    <div class="form-group">
        <label for="userPosition">Position</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
            </div>
            <input type="text" name="userPosition" id="userPosition"
                   class="form-control <?= validation_show_error('userPosition') ? 'is-invalid' : '' ?>"
                   value="<?= old('userPosition', $user['userPosition'] ?? '') ?>">
            <div class="invalid-feedback"><?= validation_show_error('userPosition') ?></div>
        </div>
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="userPassword">Password <small class="text-muted">(Leave blank to keep current password)</small></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="userPassword" id="userPassword"
                   class="form-control <?= validation_show_error('userPassword') ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= validation_show_error('userPassword') ?></div>
        </div>
    </div>

    <!-- Profile Picture -->
    <div class="form-group">
        <label for="userPicture">Profile Picture</label>
        <?php if (!empty($user['userPicture'])): ?>
            <div class="mb-2">
                <img src="<?= base_url('uploads/users/pictures/' . esc($user['userPicture'])) ?>" alt="Profile Picture" height="60">
            </div>
        <?php endif; ?>
        <div class="custom-file">
            <input type="file" name="userPicture" id="userPicture"
                   class="custom-file-input <?= validation_show_error('userPicture') ? 'is-invalid' : '' ?>">
            <label class="custom-file-label" for="userPicture">Choose image...</label>
            <div class="invalid-feedback d-block"><?= validation_show_error('userPicture') ?></div>
        </div>
    </div>

    <!-- Signature -->
    <div class="form-group">
        <label for="userSignature">Signature Image (Transparent)</label>
        <?php if (!empty($user['userSignature'])): ?>
            <div class="mb-2">
                <img src="<?= base_url('uploads/users/signatures/' . esc($user['userSignature'])) ?>" alt="Signature" height="40">
            </div>
        <?php endif; ?>
        <div class="custom-file">
            <input type="file" name="userSignature" id="userSignature"
                   class="custom-file-input <?= validation_show_error('userSignature') ? 'is-invalid' : '' ?>">
            <label class="custom-file-label" for="userSignature">Choose image...</label>
            <div class="invalid-feedback d-block"><?= validation_show_error('userSignature') ?></div>
        </div>
    </div>

    <!-- Application File -->
    <div class="form-group">
        <label for="userApplicationFile">Application File (PDF)</label>
        <?php if (!empty($user['userApplicationFile'])): ?>
            <div class="mb-2">
                <a href="<?= base_url('uploads/users/applications/' . esc($user['userApplicationFile'])) ?>" target="_blank">View current file</a>
            </div>
        <?php endif; ?>
        <div class="custom-file">
            <input type="file" name="userApplicationFile" id="userApplicationFile"
                   class="custom-file-input <?= validation_show_error('userApplicationFile') ? 'is-invalid' : '' ?>">
            <label class="custom-file-label" for="userApplicationFile">Choose PDF file...</label>
            <div class="invalid-feedback d-block"><?= validation_show_error('userApplicationFile') ?></div>
        </div>
    </div>

    <?php if(session()->get('userData')['userAccountType'] == "SIGNC" || session()->get('userData')['userAccountType'] == "SIGNA"): ?>
    <!-- Account Status -->
    <div class="form-group">
        <label for="userAccountActiveStatus">Account Status</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="userAccountActiveStatus"><i class="fas fa-toggle-on"></i></label>
            </div>
            <select disabled id="userAccountActiveStatus"
                    class="form-control <?= validation_show_error('userAccountActiveStatus') ? 'is-invalid' : '' ?>">
                <option value="1" <?= old('userAccountActiveStatus', $user['userAccountActiveStatus'] ?? '') == '1' ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= old('userAccountActiveStatus', $user['userAccountActiveStatus'] ?? '') == '0' ? 'selected' : '' ?>>Inactive</option>
            </select>
            <div class="invalid-feedback"><?= validation_show_error('userAccountActiveStatus') ?></div>
        </div>
    </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">
        <span class="text">Update user account</span>
    </button>
</form>
<form action="/dashboard/users/create" method="post" enctype="multipart/form-data" class="user-create-form">
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
                   value="<?= old('userFullName') ?>">
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
            <input type="email" name="userEmail" id="userEmail"
                   class="form-control <?= validation_show_error('userEmail') ? 'is-invalid' : '' ?>"
                   value="<?= old('userEmail') ?>">
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
                   value="<?= old('userPhone') ?>">
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
                   value="<?= old('userPosition') ?>">
            <div class="invalid-feedback"><?= validation_show_error('userPosition') ?></div>
        </div>
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="userPassword">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" name="userPassword" id="userPassword"
                   class="form-control <?= validation_show_error('userPassword') ? 'is-invalid' : '' ?>">
            <div class="invalid-feedback"><?= validation_show_error('userPassword') ?></div>
        </div>
    </div>

    <!-- Branch -->
    <div class="form-group">
        <label for="userBreanch">Branch</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
            </div>
            <select name="userBreanch" id="userBreanch"
                    class="form-control <?= validation_show_error('userBreanch') ? 'is-invalid' : '' ?>">
                <option value="">-- Select Branch --</option>
                <?php if (isset($branches) && is_array($branches)): ?>
                    <?php foreach ($branches as $branch): ?>
                        <option value="<?= esc($branch['branchId']) ?>" <?= old('userBreanch') == $branch['branchId'] ? 'selected' : '' ?>>
                            <?= esc($branch['branchName']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <div class="invalid-feedback"><?= validation_show_error('userBreanch') ?></div>
        </div>
    </div>

    <!-- Account Type (dynamic options) -->
    <div class="form-group">
        <label for="userAccountType">Account Type / Signature Position</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="userAccountType"><i class="fas fa-user-tag"></i></label>
            </div>
            <select name="userAccountType" id="userAccountType"
                    class="form-control <?= validation_show_error('userAccountType') ? 'is-invalid' : '' ?>">
                <option value="">-- Select Type --</option>
                        <option value="SIGNA">Signatory A </option>
                        <option value="SIGNB">Signatory B</option>
                        <option value="SIGNC">Signatory C</option>
                        <option value="ENTRY">None</option>
                        </select>
            <div class="invalid-feedback"><?= validation_show_error('userAccountType') ?></div>
        </div>
    </div>

    <!-- Profile Picture -->
    <div class="form-group">
        <label for="userPicture">Profile Picture</label>
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
        <div class="custom-file">
            <input type="file" name="userApplicationFile" id="userApplicationFile"
                   class="custom-file-input <?= validation_show_error('userApplicationFile') ? 'is-invalid' : '' ?>">
            <label class="custom-file-label" for="userApplicationFile">Choose PDF file...</label>
            <div class="invalid-feedback d-block"><?= validation_show_error('userApplicationFile') ?></div>
        </div>
    </div>

    <!-- Account Status -->
    <div class="form-group">
        <label for="userAccountActiveStatus">Account Status</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <label class="input-group-text" for="userAccountActiveStatus"><i class="fas fa-toggle-on"></i></label>
            </div>
            <select name="userAccountActiveStatus" id="userAccountActiveStatus"
                    class="form-control <?= validation_show_error('userAccountActiveStatus') ? 'is-invalid' : '' ?>">
                <option value="1" <?= old('userAccountActiveStatus') == '1' ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= old('userAccountActiveStatus') == '0' ? 'selected' : '' ?>>Inactive</option>
            </select>
            <div class="invalid-feedback"><?= validation_show_error('userAccountActiveStatus') ?></div>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-file"></i>
        </span>
        <span class="text">Create User Account</span>
    </button>
</form>
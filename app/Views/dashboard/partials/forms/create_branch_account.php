<form action="/dashboard/branches/create" method="post">
    <?= csrf_field() ?>

    <div class="row">
        <!-- Branch Name -->
        <div class="col-md-6 form-group mb-3">
            <label for="branchName" class="form-label">Branch Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-building"></i></span>
                <input type="text" name="branchName" id="branchName"
                    class="form-control <?= session()->get('validation') && session()->get('validation')->hasError('branchName') ? 'is-invalid' : '' ?>"
                    value="<?= old('branchName') ?>" required>
                <?php if (session()->get('validation') && session()->get('validation')->hasError('branchName')): ?>
                    <div class="invalid-feedback">
                        <?= session()->get('validation')->getError('branchName') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- County (Dropdown) -->
        <div class="col-md-6 form-group mb-3">
            <label for="branchCounty" class="form-label">County <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                <select name="branchCounty" id="branchCounty"
                    class="form-control <?= session()->get('validation') && session()->get('validation')->hasError('branchCounty') ? 'is-invalid' : '' ?>" required>
                    <option value="">-- Select County --</option>
                    <?php
                    $counties = [
                        "Bomi", "Bong", "Gbarpolu", "Grand Bassa", "Grand Cape Mount",
                        "Grand Gedeh", "Grand Kru", "Lofa", "Margibi", "Maryland",
                        "Montserrado", "Nimba", "River Cess", "River Gee", "Sinoe"
                    ];
                    foreach ($counties as $county):
                    ?>
                        <option value="<?= $county ?>" <?= old('branchCounty') == $county ? 'selected' : '' ?>>
                            <?= $county ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (session()->get('validation') && session()->get('validation')->hasError('branchCounty')): ?>
                    <div class="invalid-feedback">
                        <?= session()->get('validation')->getError('branchCounty') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- City or Town -->
        <div class="col-md-6 form-group mb-3">
            <label for="branchCityOrTown" class="form-label">City/Town <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-city"></i></span>
                <input type="text" name="branchCityOrTown" id="branchCityOrTown"
                    class="form-control <?= session()->get('validation') && session()->get('validation')->hasError('branchCityOrTown') ? 'is-invalid' : '' ?>"
                    value="<?= old('branchCityOrTown') ?>" required>
                <?php if (session()->get('validation') && session()->get('validation')->hasError('branchCityOrTown')): ?>
                    <div class="invalid-feedback">
                        <?= session()->get('validation')->getError('branchCityOrTown') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Contact Number -->
        <div class="col-md-6 form-group mb-3">
            <label for="branchContact" class="form-label">Contact Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                <input type="tel" name="branchContact" id="branchContact"
                    class="form-control <?= session()->get('validation') && session()->get('validation')->hasError('branchContact') ? 'is-invalid' : '' ?>"
                    value="<?= old('branchContact') ?>" required>
                <?php if (session()->get('validation') && session()->get('validation')->hasError('branchContact')): ?>
                    <div class="invalid-feedback">
                        <?= session()->get('validation')->getError('branchContact') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Email Address -->
        <div class="col-md-6 form-group mb-3">
            <label for="branchEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="branchEmail" id="branchEmail"
                    class="form-control <?= session()->get('validation') && session()->get('validation')->hasError('branchEmail') ? 'is-invalid' : '' ?>"
                    value="<?= old('branchEmail') ?>" required>
                <?php if (session()->get('validation') && session()->get('validation')->hasError('branchEmail')): ?>
                    <div class="invalid-feedback">
                        <?= session()->get('validation')->getError('branchEmail') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Active Status -->
        <div class="col-md-6 form-group mb-3">
            <label for="isActive" class="form-label">Status <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                <select name="isActive" id="isActive"
                    class="form-control <?= session()->get('validation') && session()->get('validation')->hasError('isActive') ? 'is-invalid' : '' ?>" required>
                    <option value="1" <?= old('isActive', '1') == '1' ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= old('isActive') == '0' ? 'selected' : '' ?>>Inactive</option>
                </select>
                <?php if (session()->get('validation') && session()->get('validation')->hasError('isActive')): ?>
                    <div class="invalid-feedback">
                        <?= session()->get('validation')->getError('isActive') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i> Save Branch Details
        </button>
    </div>
</form>
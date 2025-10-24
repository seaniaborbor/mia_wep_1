<div class="table-responsive">
    <table class="table table-striped datatable2 table-hover align-middle">
        <thead class="thead-light">
            <tr>
                <th><i class="fas fa-male text-primary"></i> Groom Name</th>
                <th><i class="fas fa-female text-danger"></i> Bride Name</th>
                <th><i class="fas fa-calendar-alt text-info"></i> Marriage Date</th>
                <th><i class="fas fa-map-marker-alt text-warning"></i> County</th>
                <th><i class="fas fa-code-branch text-success"></i> Branch</th>
                <th><i class="fas fa-clock text-secondary"></i> Date Logged</th>
                <th><i class="fas fa-tasks text-dark"></i> Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($branch_complete_certificate) && !empty($branch_complete_certificate)): ?>
                <?php foreach($branch_complete_certificate as $certificate): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle img-thumbnail me-2"
                                    style="height:30px; width:30px;
                                    background-image: url('/uploads/marriage/<?= esc($certificate['groom_passport_photo']) ?>');
                                    background-size: cover; background-position: center;">
                                </div>
                                <?= esc($certificate['groom_name']) ?>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle img-thumbnail me-2"
                                    style="height:30px; width:30px;
                                    background-image: url('/uploads/marriage/<?= esc($certificate['bride_passport_photo']) ?>');
                                    background-size: cover; background-position: center;">
                                </div>
                                <?= esc($certificate['bride_name']) ?>
                            </div>
                        </td>
                        <td><?= esc($certificate['date_of_marriage']) ?></td>
                        <td><?= esc($certificate['branchCounty']) ?></td>
                        <td><?= esc($certificate['branchName']) ?></td>
                        <td><?= esc($certificate['created_at']) ?></td>
                        <td>
                            <a href="/dashboard/wedcert/view/<?= esc($certificate['marriage_cert_id']) ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        <i class="fas fa-info-circle"></i> No marriage certificates have been logged for this branch.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

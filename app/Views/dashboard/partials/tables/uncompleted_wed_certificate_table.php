
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Groom</th>
                        <th>Bride</th>
                        <th>Marriage Date</th>
                        <th>County</th>
                        <th>Branch</th>
                        <th>Date Logged</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($branch_uncomplete_certificate) && !empty($branch_uncomplete_certificate)): ?>
                        <?php foreach ($branch_uncomplete_certificate as $certificate): ?>
                            <?php
                                $completed_steps = 0;
                                $total_steps = 3;
                                if (!empty($certificate['SIGNA'])) $completed_steps++;
                                if (!empty($certificate['SIGNB'])) $completed_steps++;
                                if (!empty($certificate['SIGNC'])) $completed_steps++;
                                $progress_percent = round(($completed_steps / $total_steps) * 100);

                                if ($completed_steps == 0) {
                                    $status_text = 'Not Started';
                                    $status_color = 'danger';
                                    $icon = 'times-circle';
                                } elseif ($completed_steps < $total_steps) {
                                    $status_text = 'In Progress';
                                    $status_color = 'warning';
                                    $icon = 'spinner fa-spin';
                                } else {
                                    $status_text = 'Completed';
                                    $status_color = 'success';
                                    $icon = 'check-circle';
                                }
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <?php if(!empty($certificate['groom_passport_photo'])): ?>
                                                <img src="/uploads/marriage/<?= esc($certificate['groom_passport_photo']) ?>"
                                                     alt="Groom" class="img-profile rounded-circle" width="40" height="40">
                                            <?php else: ?>
                                                <div class="bg-gray-300 rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold"
                                                     style="width:40px;height:40px;font-size:0.9rem;">
                                                    <?= strtoupper(substr(esc($certificate['groom_name']), 0, 2)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="small font-weight-bold"><?= esc($certificate['groom_name']) ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <?php if(!empty($certificate['bride_passport_photo'])): ?>
                                                <img src="/uploads/marriage/<?= esc($certificate['bride_passport_photo']) ?>"
                                                     alt="Bride" class="img-profile rounded-circle" width="40" height="40">
                                            <?php else: ?>
                                                <div class="bg-gray-300 rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold"
                                                     style="width:40px;height:40px;font-size:0.9rem;">
                                                    <?= strtoupper(substr(esc($certificate['bride_name']), 0, 2)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="small font-weight-bold"><?= esc($certificate['bride_name']) ?></div>
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-calendar-alt fa-fw text-gray-400 mr-1"></i>
                                    <?= date('M j, Y', strtotime($certificate['date_of_marriage'])) ?>
                                </td>
                                <td><?= esc($certificate['branchCounty']) ?></td>
                                <td><?= esc($certificate['branchName']) ?></td>
                                <td>
                                    <i class="fas fa-clock fa-fw text-gray-400 mr-1"></i>
                                    <?= date('M j, Y', strtotime($certificate['created_at'])) ?>
                                </td>
                                <td>
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar bg-<?= $status_color ?>
                                             <?= $status_text == 'In Progress' ? 'progress-bar-striped progress-bar-animated' : '' ?>"
                                             role="progressbar"
                                             style="width: <?= $progress_percent ?>%;"
                                             aria-valuenow="<?= $progress_percent ?>" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-<?= $status_color ?> font-weight-bold">
                                        <i class="fas fa-<?= $icon ?> mr-1"></i>
                                        <?= $status_text ?> (<?= $completed_steps ?>/<?= $total_steps ?>)
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="/matrimonial_dashboard/wedcert/view/<?= esc($certificate['marriage_cert_id']) ?>"
                                       class="btn btn-warning btn-sm btn-icon-split" title="View Certificate">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        <span class="text">View</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-gray-500">
                                    <i class="fas fa-hourglass-half fa-3x mb-3 text-gray-300"></i>
                                    <p class="mb-0">No pending marriage certificates found.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

<!-- Optional: Initialize tooltips (SB Admin 2 uses Bootstrap 4 tooltips) -->
<script>
    $(function () {
        $('[title]').tooltip();
    });
</script>
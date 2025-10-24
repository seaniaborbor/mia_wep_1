<div class="table-responsive">
    <table class="table datatable table-striped table-hover align-middle">
        <thead class="thead-light">
            <tr>
                <th><i class="fas fa-male text-primary"></i> Groom</th>
                <th><i class="fas fa-female text-danger"></i> Bride</th>
                <th><i class="fas fa-calendar-alt text-info"></i> Marriage Date</th>
                <th><i class="fas fa-map-marker-alt text-warning"></i> County</th>
                <th><i class="fas fa-code-branch text-success"></i> Branch</th>
                <th><i class="fas fa-clock text-secondary"></i> Date Logged</th>
                <th><i class="fas fa-tasks text-dark"></i> Status</th>
                <th><i class="fas fa-eye text-primary"></i> Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($branch_uncomplete_certificate) && !empty($branch_uncomplete_certificate)): ?>
                <?php foreach ($branch_uncomplete_certificate as $certificate): ?>
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
                        <td><?= esc(date('M j, Y', strtotime($certificate['date_of_marriage']))) ?></td>
                        <td><?= esc($certificate['branchCounty']) ?></td>
                        <td><?= esc($certificate['branchName']) ?></td>
                        <td><?= esc(date('M j, Y', strtotime($certificate['created_at']))) ?></td>
                        <td>
                            <?php
                                // Calculate completion status
                                $completed_steps = 0;
                                $total_steps = 3; // SIGNA, SIGNB, SIGNC
                                
                                if ($certificate['SIGNA'] != null) $completed_steps++;
                                if ($certificate['SIGNB'] != null) $completed_steps++;
                                if ($certificate['SIGNC'] != null) $completed_steps++;
                                
                                $progress_percent = ($completed_steps / $total_steps) * 100;
                                
                                // Determine status text and color
                                if ($completed_steps == 0) {
                                    $status_text = 'Not Started';
                                    $status_color = 'danger';
                                } elseif ($completed_steps < $total_steps) {
                                    $status_text = 'In Progress';
                                    $status_color = 'warning';
                                } else {
                                    $status_text = 'Completed';
                                    $status_color = 'success';
                                }
                            ?>
                            <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar bg-<?= $status_color ?> progress-bar-striped<?= $status_text == 'In Progress' ? ' progress-bar-animated' : '' ?>" 
                                     role="progressbar" 
                                     style="width: <?= $progress_percent ?>%;"
                                     aria-valuenow="<?= $progress_percent ?>" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-<?= $status_color ?>">
                                <i class="fas fa-<?= $status_color == 'success' ? 'check-circle' : ($status_color == 'warning' ? 'spinner' : 'times-circle') ?>"></i>
                                <?= $status_text ?> (<?= $completed_steps ?>/<?= $total_steps ?>)
                            </small>
                        </td>
                        <td>
                            <a href="/dashboard/wedcert/view/<?= esc($certificate['marriage_cert_id']) ?>" 
                               class="btn btn-sm btn-outline-primary"
                               title="View Certificate"
                               data-bs-toggle="tooltip">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-info-circle fa-lg"></i> No uncompleted marriage certificates found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Initialize DataTable if needed
    if ($.fn.DataTable.isDataTable('.datatable')) {
        $('.datatable').DataTable().destroy();
    }
    $('.datatable').DataTable({
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [6, 7] } // Disable sorting for status and action columns
        ]
    });
});
</script>
<!-- partials/tables/user_divorce_cert_log.php -->
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="divorceCertTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="100">Certificate ID</th>
                <th>Plaintiff</th>
                <th>Defendant</th>
                <th>Marriage Date</th>
                <th>Divorce Date</th>
                <th>Issuance Date</th>
                <th class="text-center" width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($divorce_certificates) && !empty($divorce_certificates)): ?>
                <?php foreach($divorce_certificates as $cert): ?>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge badge-info font-weight-bold">
                                #<?= esc($cert['divorceCertId']) ?>
                            </span>
                        </td>
                        <td class="align-middle">
                            <strong><?= esc($cert['divorceplaintiff']) ?></strong>
                        </td>
                        <td class="align-middle">
                            <strong><?= esc($cert['divorcedefendant']) ?></strong>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-calendar-alt text-primary mr-2"></i>
                            <?= date('M d, Y', strtotime($cert['divorcemarriageDate'])) ?>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-heart-broken text-danger mr-2"></i>
                            <?= date('M d, Y', strtotime($cert['divorcedateOfDivorce'])) ?>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-file-contract text-success mr-2"></i>
                            <?= date('M d, Y', strtotime($cert['divorceissuanceDate'])) ?>
                        </td>
                        <td class="text-center align-middle">
                            <a href="/matrimonial_dashboard/divorce_cert/view/<?= $cert['divorceCertId'] ?>"
                               class="btn btn-sm btn-primary"
                               title="View Divorce Certificate">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="fas fa-heart-broken fa-3x text-gray-300 mb-3"></i>
                        <p class="text-gray-600 mb-1">No Divorce Certificates Found</p>
                        <small class="text-muted">This user hasn't processed any divorce certificates yet.</small>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#divorceCertTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[5, 'desc']], // Latest issuance first
        columnDefs: [
            { orderable: false, targets: [6] },
            { searchable: false, targets: [6] }
        ],
        language: {
            emptyTable: "No divorce certificates found",
            zeroRecords: "No matching records found"
        }
    });
});
</script>
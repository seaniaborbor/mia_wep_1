<!-- partials/tables/user_wedding_cert_log.php -->
<div class="table-responsive">
    <table class="table table-bordered table-hover" id="weddingCertTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="100">Certificate ID</th>
                <th>Groom</th>
                <th>Bride</th>
                <th>Marriage Date</th>
                <th>Place of Marriage</th>
                <th>Issuance Date</th>
                 <?php if(session()->get('userData')['userAccountType'] != "ADMIN"): ?>
                <th class="text-center" width="100">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($marriage_certificates) && !empty($marriage_certificates)): ?>
                <?php foreach($marriage_certificates as $cert): ?>
                    <tr>
                        <td class="text-center align-middle">
                            <span class="badge badge-primary font-weight-bold">
                                #<?= esc($cert['marriage_cert_id']) ?>
                            </span>
                        </td>
                        <td class="align-middle"><strong><?= esc($cert['groom_name']) ?></strong></td>
                        <td class="align-middle"><strong><?= esc($cert['bride_name']) ?></strong></td>
                        <td class="align-middle">
                            <i class="fas fa-ring text-warning mr-2"></i>
                            <?= date('M d, Y', strtotime($cert['date_of_marriage'])) ?>
                        </td>
                        <td class="align-middle"><?= esc($cert['place_of_marriage']) ?></td>
                        <td class="align-middle">
                            <i class="fas fa-certificate text-success mr-2"></i>
                            <?= date('M d, Y', strtotime($cert['certification_day'])) ?>
                        </td>
                        <?php if(session()->get('userData')['userAccountType'] != "ADMIN"): ?>
                            <td class="text-center align-middle">
                                <a href="/matrimonial_dashboard/wedcert/view/<?= $cert['marriage_cert_id'] ?>"
                                   class="btn btn-sm btn-success"
                                   title="View Marriage Certificate">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="fas fa-heart fa-3x text-gray-300 mb-3"></i>
                        <p class="text-gray-600 mb-1">No Marriage Certificates Found</p>
                        <small class="text-muted">This user hasn't processed any marriage certificates yet.</small>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table datatable table-striped">
        <thead>
            <tr>
                <td>Groom Name</td>
                <td>Bride Name</td>
                <td>Date of Marriage</td>
                <td>County Logged</td>
                <td>Branch Logged</td>
                <td>Date Recorded</td>
                <td>Details</td>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($marriage_certificates) && !empty($marriage_certificates)): ?>
                <?php foreach($marriage_certificates as $certificate): ?>
                    <tr>
                        <td >
                            <div class="d-flex justify-content-start">
                                <div class="rounded-circle img-thumbnail me-2"
                            style="height:30px; width:30px;
                            background-image: url(/uploads/marriage/<?=$certificate['groom_passport_photo']?>);
                            background-size: cover; background-position:top; "></div>
                            <?=$certificate['groom_name']?>
                            </div>
                        </td>
                        <td class="">
                            <div class="d-flex justify-content-start">
                                <div class="rounded-circle img-thumbnail me-2"
                            style="height:30px; width:30px;
                            background-image: url(/uploads/marriage/<?=$certificate['bride_passport_photo']?>);
                            background-size: cover; background-position:top; "></div>
                            <?=$certificate['bride_name']?>
                            </div>
                        </td>
                        <td><?=$certificate['date_of_marriage']?></td>
                        <td><?=$certificate['branchCounty']?></td>
                        <td><?=$certificate['branchName']?></td>
                        <td><?=$certificate['created_at']?></td>
                        <td>
                            <a href="/dashboard/wedcert/view/<?=$certificate['marriage_cert_id']?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-eye"></i>
                                </span>
                                <span class="text">View Details</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">
                        <div class="alert alert-warning">No Marriage Certificate is associated with this user</div>
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>
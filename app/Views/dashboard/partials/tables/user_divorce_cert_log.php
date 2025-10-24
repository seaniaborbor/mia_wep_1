<div class="tab-pane fade show active" id="uncompleted" role="tabpanel" aria-labelledby="uncompleted-tab">
<!-- Uncompleted Certificates Table -->
<div class="table-responsive">
    <table class="table table-bordered datatable2 table-hover">
        <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Plaintiff</th>
                <th>Defendant</th>
                <th>Marriage Date</th>
                <th>Divorce Date</th>
                <th>Issuance Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($divorce_certificates as $cert): ?>
            <tr>
                <td><?= $cert['divorceCertId'] ?></td>
                <td><?= $cert['divorceplaintiff'] ?></td>
                <td><?= $cert['divorcedefendant'] ?></td>
                <td><?= date('M d, Y', strtotime($cert['divorcemarriageDate'])) ?></td>
                <td><?= date('M d, Y', strtotime($cert['divorcedateOfDivorce'])) ?></td>
                <td><?= date('M d, Y', strtotime($cert['divorceissuanceDate'])) ?></td>
                <td>
                    <a href="/dashboard/divorce_cert/view/<?= $cert['divorceCertId'] ?>" class="btn btn-info btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-eye"></i>
                        </span>
                        <span class="text">View</span>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
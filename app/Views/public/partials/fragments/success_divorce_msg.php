<?php if (!empty($divoCert)): ?>
    <div class="card shadow-sm border-success mb-3">
        <div class="card-header bg-success text-white">
            <h3>✅ Divorce Certificate Verified</h3>
        </div>
        <div class="card-body">
            <h5 class="card-title">Reference No: <?= esc($divoCert['divorceRefNo']) ?></h5>
            <p class="card-text">
                <strong>Certificate Code:</strong> <?= esc($divoCert['divorceCode']) ?><br>
                <strong>Rev. Number:</strong> <?= esc($divoCert['divorceRevNo']) ?><br><br>

                <strong>Plaintiff:</strong> <?= esc($divoCert['divorceplaintiff']) ?><br>
                <img src="<?= base_url('uploads/divorce/' . esc($divoCert['divorceplaintiffPic'])) ?>" alt="Plaintiff Photo" class="img-thumbnail mb-2" style="height:100px;"><br>

                <strong>Defendant:</strong> <?= esc($divoCert['divorcedefendant']) ?><br>
                <img src="<?= base_url('uploads/divorce/' . esc($divoCert['divorcedefendantPic'])) ?>" alt="Defendant Photo" class="img-thumbnail mb-2" style="height:100px;"><br><br>

                <strong>Marriage Date:</strong> <?= date('F d, Y', strtotime($divoCert['divorcemarriageDate'])) ?><br>
                <strong>Date of Divorce:</strong> <?= date('F d, Y', strtotime($divoCert['divorcedateOfDivorce'])) ?><br>
                <strong>Date of Issuance:</strong> <?= date('F d, Y', strtotime($divoCert['divorceissuanceDate'])) ?>
            </p>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger">
        Divorce certificate not found or invalid reference number.
    </div>
<?php endif; ?>

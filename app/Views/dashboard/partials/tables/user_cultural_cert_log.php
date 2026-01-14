<?php if (!empty($cultural_certificate)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Holder Name</th>
                    <th>Application Type</th>
                    <th>Operation Type</th>
                    <th>Date Logged</th>
                    <th>Missing Signatures</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cultural_certificate as $cert): ?>
                    <?php
                        $missing = [];
                        if (empty($cert['tradCertSignatoryA'])) $missing[] = 'A';
                        if (empty($cert['tradCertSignatoryB'])) $missing[] = 'B';
                        if (empty($cert['tradCertSignatoryC'])) $missing[] = 'C';
                    ?>
                    <tr>
                        <td><strong class="text-primary">#<?= esc($cert['tradCertSn'] ?? 'N/A') ?></strong></td>
                        <td><?= esc($cert['tradCertHolderName'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge badge-<?= ($cert['tradCertAppliedType'] ?? '') === 'online' ? 'success' : 'info' ?>">
                                <?= ucfirst($cert['tradCertAppliedType'] ?? 'N/A') ?>
                            </span>
                        </td>
                        <td><?= esc($cert['tradCertHolderOperationType'] ?? 'N/A') ?></td>
                        <td>
                            <i class="fas fa-calendar-alt fa-fw text-gray-400 mr-1"></i>
                            <?= !empty($cert['tradCertLastUpdatedAt']) ? date('M d, Y', strtotime($cert['tradCertLastUpdatedAt'])) : 'N/A' ?>
                        </td>
                        <td>
                            <span class="badge badge-danger font-weight-bold">
                                <?= !empty($missing) ? implode(', ', $missing) : 'None' ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="/cultural_dashboard/nativecert/view/<?= esc($cert['tradCertId']) ?>"
                                class="btn btn-warning btn-sm btn-icon-split">
                                <span class="icon text-white-50"><i class="fas fa-eye"></i></span>
                                <span class="text">View</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="text-center py-5 text-success">
        <i class="fas fa-check-circle fa-3x mb-3 text-gray-300"></i>
        <p class="h5 mb-0">No cultural certificates found.</p>
    </div>
<?php endif; ?>
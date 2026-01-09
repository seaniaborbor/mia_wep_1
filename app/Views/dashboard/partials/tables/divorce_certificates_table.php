<!-- SB Admin 2 Style - Divorce Certificates Table -->

        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Plaintiff</th>
                        <th>Defendant</th>
                        <th>Reference No</th>
                        <th class="text-center">Status</th>
                        <th>Divorce Date</th>
                        <th>Date Logged</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($branchDivorces)): ?>
                        <?php foreach($branchDivorces as $divorce): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <?php if(!empty($divorce['divorceplaintiffPic'])): ?>
                                            <img src="/uploads/divorce/<?= esc($divorce['divorceplaintiffPic']) ?>"
                                                 alt="Plaintiff" class="img-profile rounded-circle" width="40" height="40">
                                        <?php else: ?>
                                            <div class="bg-gray-300 rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold"
                                                 style="width:40px;height:40px;font-size:0.9rem;">
                                                <?= strtoupper(substr(esc($divorce['divorceplaintiff']), 0, 2)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="small">
                                        <div class="font-weight-bold"><?= esc($divorce['divorceplaintiff']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <?php if(!empty($divorce['divorcedefendantPic'])): ?>
                                            <img src="/uploads/divorce/<?= esc($divorce['divorcedefendantPic']) ?>"
                                                 alt="Defendant" class="img-profile rounded-circle" width="40" height="40">
                                        <?php else: ?>
                                            <div class="bg-gray-300 rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold"
                                                 style="width:40px;height:40px;font-size:0.9rem;">
                                                <?= strtoupper(substr(esc($divorce['divorcedefendant']), 0, 2)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="small">
                                        <div class="font-weight-bold"><?= esc($divorce['divorcedefendant']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="font-weight-bold text-gray-800"><?= esc($divorce['divorceRefNo']) ?></span>
                            </td>
                            <td class="text-center">
                                <?php if(empty($divorce['divorceSIGN_A']) || empty($divorce['divorceSIGN_B']) || empty($divorce['divorceSIGN_C'])): ?>
                                    <span class="badge badge-warning">Pending</span>
                                <?php else: ?>
                                    <span class="badge badge-success">Completed</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <i class="fas fa-calendar-alt fa-fw text-gray-400 mr-1"></i>
                                <?= date('M d, Y', strtotime($divorce['divorcedateOfDivorce'])) ?>
                            </td>
                            <td>
                                <i class="fas fa-clock fa-fw text-gray-400 mr-1"></i>
                                <?= date('M d, Y', strtotime($divorce['divorcecreated_at'])) ?>
                            </td>
                            <td class="text-center">
                                <a href="/dashboard/divorce_cert/view/<?= $divorce['divorceCertId'] ?>"
                                   class="btn btn-danger btn-sm btn-icon-split">
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
                            <td colspan="7" class="text-center py-5">
                                <div class="text-gray-500">
                                    <i class="fas fa-heart-broken fa-3x mb-3 text-gray-300"></i>
                                    <h5 class="text-gray-700">No Divorce Certificates Found</h5>
                                    <p class="text-gray-500">No divorce certificates have been logged for this branch yet.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
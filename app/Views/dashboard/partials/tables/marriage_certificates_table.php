
        <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Groom</th>
                    <th>Bride</th>
                    <th>Reference No</th>
                    <th class="text-center">Status</th>
                    <th>Marriage Date</th>
                    <th>Date Logged</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($branchMarriages)): ?>
                    <?php foreach($branchMarriages as $marriage): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <?php if(!empty($marriage['groom_passport_photo'])): ?>
                                        <img src="/uploads/marriage/<?= esc($marriage['groom_passport_photo']) ?>"
                                                alt="Groom" class="img-profile rounded-circle" width="40" height="40">
                                    <?php else: ?>
                                        <div class="bg-gray-300 rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold"
                                                style="width:40px;height:40px;font-size:0.9rem;">
                                            <?= strtoupper(substr(esc($marriage['groom_name']), 0, 2)) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="font-weight-bold small"><?= esc($marriage['groom_name']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <?php if(!empty($marriage['bride_passport_photo'])): ?>
                                        <img src="/uploads/marriage/<?= esc($marriage['bride_passport_photo']) ?>"
                                                alt="Bride" class="img-profile rounded-circle" width="40" height="40">
                                    <?php else: ?>
                                        <div class="bg-gray-300 rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold"
                                                style="width:40px;height:40px;font-size:0.9rem;">
                                            <?= strtoupper(substr(esc($marriage['bride_name']), 0, 2)) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="font-weight-bold small"><?= esc($marriage['bride_name']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-weight-bold text-gray-800"><?= esc($marriage['reference_no']) ?></span>
                        </td>
                        <td class="text-center">
                            <?php if(empty($marriage['SIGNA']) || empty($marriage['SIGNB']) || empty($marriage['SIGNC'])): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-success">Completed</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <i class="fas fa-calendar-alt fa-fw text-gray-400 mr-1"></i>
                            <?= date('M d, Y', strtotime($marriage['date_of_marriage'])) ?>
                        </td>
                        <td>
                            <i class="fas fa-clock fa-fw text-gray-400 mr-1"></i>
                            <?= date('M d, Y', strtotime($marriage['created_at'])) ?>
                        </td>
                        <td class="text-center">
                            <a href="/matrimonial_dashboard/wedcert/view/<?= $marriage['marriage_cert_id'] ?>"
                                class="btn btn-primary btn-sm btn-icon-split">
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
                                <i class="fas fa-ring fa-3x mb-3 text-gray-300"></i>
                                <h5 class="text-gray-700">No Marriage Certificates Found</h5>
                                <p class="text-gray-500">No marriage certificates have been logged for this branch yet.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
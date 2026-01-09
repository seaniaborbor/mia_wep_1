
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Groom Name</th>
                        <th>Bride Name</th>
                        <th>Marriage Date</th>
                        <th>County</th>
                        <th>Branch</th>
                        <th>Date Logged</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($branch_complete_certificate) && !empty($branch_complete_certificate)): ?>
                        <?php foreach($branch_complete_certificate as $certificate): ?>
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
                                        <div class="small">
                                            <div class="font-weight-bold"><?= esc($certificate['groom_name']) ?></div>
                                        </div>
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
                                        <div class="small">
                                            <div class="font-weight-bold"><?= esc($certificate['bride_name']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-calendar-alt fa-fw text-gray-400 mr-1"></i>
                                    <?= date('M d, Y', strtotime($certificate['date_of_marriage'])) ?>
                                </td>
                                <td><?= esc($certificate['branchCounty']) ?></td>
                                <td><?= esc($certificate['branchName']) ?></td>
                                <td>
                                    <i class="fas fa-clock fa-fw text-gray-400 mr-1"></i>
                                    <?= date('M d, Y', strtotime($certificate['created_at'])) ?>
                                </td>
                                <td class="text-center">
                                    <a href="/matrimonial_dashboard/wedcert/view/<?= esc($certificate['marriage_cert_id']) ?>"
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
                                    <i class="fas fa-info-circle fa-3x mb-3 text-gray-300"></i>
                                    <p class="mb-0">No completed marriage certificates found for this branch.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
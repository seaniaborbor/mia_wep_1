
        <table class="table table-bordered mb-0">
            <tbody>
                <!-- Basic Branch Info -->
                <tr class="bg-light">
                    <th colspan="2" class="small font-weight-bold">
                        <i class="fas fa-info-circle mr-1 text-muted"></i> BASIC INFORMATION
                    </th>
                </tr>
                <tr>
                    <th width="35%" class=" text-nowrap">
                        <i class="fas fa-building mr-2 text-muted"></i>Branch Name
                    </th>
                    <td><?= esc($branch_info['branchName']) ?></td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-map-marker-alt mr-2 text-muted"></i>County
                    </th>
                    <td><?= esc($branch_info['branchCounty']) ?></td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-map-marked-alt mr-2 text-muted"></i>City/Town
                    </th>
                    <td><?= esc($branch_info['branchCityOrTown']) ?></td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-id-card mr-2 text-muted"></i>Branch Code
                    </th>
                    <td><span class="font-monospace"><?= esc($branch_info['branchCode']) ?></span></td>
                </tr>
                
                <!-- Contact Information -->
                <tr class="bg-light">
                    <th colspan="2" class="small font-weight-bold">
                        <i class="fas fa-address-book mr-1 text-muted"></i> CONTACT INFORMATION
                    </th>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-phone-alt mr-2 text-muted"></i>Contact Number
                    </th>
                    <td><?= esc($branch_info['branchContact']) ?></td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-envelope mr-2 text-muted"></i>Email Address
                    </th>
                    <td><?= esc($branch_info['branchEmail']) ?></td>
                </tr>
                
                <!-- Administrative Details -->
                <tr class="bg-light">
                    <th colspan="2" class="small font-weight-bold">
                        <i class="fas fa-user-shield mr-1 text-muted"></i> ADMINISTRATIVE DETAILS
                    </th>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-calendar-plus mr-2 text-muted"></i>Date Established
                    </th>
                    <td><?= date('F j, Y', strtotime($branch_info['branchCreatedAt'])) ?></td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-user-edit mr-2 text-muted"></i>Created By
                    </th>
                    <td><?= esc($branch_info['userFullName']) ?></td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-power-off mr-2 text-muted"></i>Status
                    </th>
                    <td>
                        <span class="badge <?= $branch_info['isActive'] ? 'badge-success' : 'badge-secondary' ?>">
                            <?= $branch_info['isActive'] ? 'ACTIVE' : 'INACTIVE' ?>
                        </span>
                    </td>
                </tr>
                
                <!-- Statistics Section -->
                <tr class="bg-light">
                    <th colspan="2" class="small font-weight-bold">
                        <i class="fas fa-chart-bar mr-1 text-muted"></i> OPERATIONAL STATISTICS
                    </th>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-users mr-2 text-muted"></i>Staff Accounts
                    </th>
                    <td>
                        <span class="badge bg-white border text-dark"><?= esc($total_active_user) ?> active</span>
                        <span class="badge bg-white border text-dark ml-2"><?= esc($total_inactive_user) ?> inactive</span>
                    </td>
                </tr>
                <tr>
                    <th class="">
                        <i class="fas fa-certificate mr-2 text-muted"></i>Marriage/Divorce Certificates Logged
                    </th>
                    <td>
                        <span class="badge bg-white border text-dark"><?= esc(count($branch_marriage_certificates)) ?> Marriage Certificates </span>
                        <span class="badge bg-white border text-dark ml-2"><?= esc(count($branch_divorce_certificates)) ?> Divorce</span>
                    </td>
                </tr>
            </tbody>
        </table>
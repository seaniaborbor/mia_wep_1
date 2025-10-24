
        <div class="table-responsive border pt-5">
            <table class="table datatable table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" style="width: 50px">#</th>
                        <th>Branch Name</th>
                        <th>Location</th>
                        <th class="text-center">Code</th>
                        <th>Contact</th>
                        <th>Total Users</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($branches) && is_array($branches)): ?>
                        <?php foreach ($branches as $index => $branch): ?>
                            <tr class="align-middle">
                                <td class="text-center text-"><?= $index + 1 ?></td>
                                <td>
                                    <div class="fw-semibold"><?= esc($branch['branchName']) ?></div>
                                    <small class="text-"><?= esc($branch['branchEmail']) ?></small>
                                </td>
                                <td>
                                    <div><?= esc($branch['branchCityOrTown']) ?></div>
                                    <small class="text-"><?= esc($branch['branchCounty']) ?> County</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border"><?= esc($branch['branchCode']) ?></span>
                                </td>
                                <td>
                                    <?php if ($branch['branchContact']): ?>
                                        <a href="tel:<?= esc($branch['branchContact']) ?>" class="text-decoration-none">
                                            <i class="fas fa-phone me-1 text-"></i>
                                            <?= esc($branch['branchContact']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-">Not provided</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($branch['branchContact']): ?>
                                        <a href="tel:<?= esc($branch['branchContact']) ?>" class="text-decoration-none">
                                            <i class="fas fa-users me-1 text-"></i>
                                            <?= esc($branch['total_users']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-">Not provided</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-center">
                                    <?php if ($branch['isActive']): ?>
                                        <i class="fas fa-check-circle text-success" data-bs-toggle="tooltip" title="Active"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times-circle text-danger" data-bs-toggle="tooltip" title="Inactive"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="/dashboard/branches/view/<?= $branch['branchId'] ?>" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/dashboard/branches/edit/<?= $branch['branchId'] ?>" 
                                           class="btn btn-sm btn-outline-secondary"
                                           data-bs-toggle="tooltip" 
                                           title="Edit Branch">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-building-circle-exclamation text- mb-2" style="font-size: 2rem"></i>
                                    <h6 class="text- mb-1">No branches registered</h6>
                                    <small class="text-">Create your first branch to get started</small>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    </div>
    <?php if (!empty($branches) && is_array($branches)): ?>
        <div class="card-footer bg-white border-top">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-">Showing <?= count($branches) ?> entries</small>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <!-- Pagination would go here -->
                    </ul>
                </nav>
            </div>
        </div>
    <?php endif; ?>
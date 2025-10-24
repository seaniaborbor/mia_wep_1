<!-- Signatures Card -->
                    <div class="certificate-card">
                        <div class="certificate-card-header">
                            <h5 class="govt-label mb-0">
                                <i class="fas fa-signature text-primary"></i> AUTHORIZED SIGNATURES
                            </h5>
                        </div>
                        <div class="p-3">
                            <div class="row text-center">
                                <?php
                                // Map signatory keys to labels
                                $signatories = [
                                    'divorceSIGN_A' => 'A',
                                    'divorceSIGN_B' => 'B',
                                    'divorceSIGN_C' => 'C'
                                ];

                                foreach ($signatories as $key => $label):
                                    // Signature file name
                                    $signature = !empty($certificate[0][$key]) ? $certificate[0][$key] : null;
                                    // Signer ID (may be empty)
                                    $signerId = !empty($certificate[0][$key . '_ID']) ? $certificate[0][$key . '_ID'] : null;
                                    // Date signed (may be empty)
                                    $dateSigned = !empty($certificate[0][$key . '_DATE_SIGNED']) ? $certificate[0][$key . '_DATE_SIGNED'] : null;
                                ?>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <div class="mb-2"><strong>Signatory <?= $label ?></strong></div>
                                            <?php if ($signature): ?>
                                                <img src="/uploads/users/signatures/<?= esc($signature) ?>"
                                                     class="img-fluid signature-img"
                                                     style="max-height: 60px; cursor: pointer;"
                                                     data-toggle="popover"
                                                     data-placement="top"
                                                     <?php if ($signerId): ?>
                                                         data-signer-id="<?= esc($signerId) ?>"
                                                         onclick="loadSignerProfile(event)"
                                                     <?php endif; ?>
                                                >
                                                <?php if ($signerId): ?>
                                                    <div class="mt-1">
                                                        <a href="#" class="btn btn-sm btn-link p-0 view-signer"
                                                           data-toggle="popover"
                                                           data-placement="top"
                                                           data-signer-id="<?= esc($signerId) ?>"
                                                           onclick="loadSignerProfile(event)">
                                                            View Signer
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($dateSigned): ?>
                                                    <div class="small text-muted">Signed: <?= esc(date('M d, Y', strtotime($dateSigned))) ?></div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <div class="text-muted">Not Signed</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <script>
                    // Initialize Bootstrap popovers
                    function initPopovers() {
                        $('[data-toggle="popover"]').popover({
                            html: true,
                            trigger: 'manual',
                            container: 'body',
                            template: `
                                <div class="popover" role="tooltip">
                                    <div class="arrow"></div>
                                    <h3 class="popover-header bg-light"></h3>
                                    <div class="popover-body"></div>
                                </div>
                            `,
                            content: '<div class="text-center py-2"><i class="fas fa-spinner fa-spin"></i> Loading...</div>'
                        });
                    }

                    // Load profile and refresh popover
                    function loadSignerProfile(event) {
                        event.preventDefault();
                        const element = $(event.currentTarget);
                        const signerId = element.data('signer-id');

                        // Dispose any existing popovers
                        $('[data-toggle="popover"]').not(element).popover('hide');

                        // Show loading state
                        element.popover('dispose').popover({
                            html: true,
                            trigger: 'manual',
                            container: 'body',
                            content: '<div class="text-center py-2"><i class="fas fa-spinner fa-spin"></i> Loading...</div>'
                        }).popover('show');

                        // Fetch signer profile
                        fetch(`/dashboard/ajax/user_profile/${signerId}`)
                            .then(res => res.json())
                            .then(data => {
                                let content;
                                if (data.status === 'success') {
                                    const user = data.data;
                                    content = `
                                    <div class="signer-profile">
                                        <div class="media">
                                            <img src="/uploads/users/pictures/${user.userPicture || 'default-user.jpg'}"
                                                 class="mr-3 rounded-circle"
                                                 width="60" height="60" style="object-fit: cover">
                                            <div class="media-body">
                                                <h6 class="mt-0 font-weight-bold">${user.userFullName}</h6>
                                                <span class="badge badge-success">Active</span>
                                                <div class="text-muted small">${user.userPosition}</div>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="user-details">
                                            <p><i class="fas fa-envelope text-primary mr-2"></i> ${user.userEmail}</p>
                                            <p><i class="fas fa-phone text-primary mr-2"></i> ${user.userPhone || 'N/A'}</p>
                                            <p><i class="fas fa-building text-primary mr-2"></i> ${user.branchName}</p>
                                            <p><i class="fas fa-map-marker-alt text-primary mr-2"></i> ${user.branchCityOrTown}, ${user.branchCounty}</p>
                                            <p class="mb-0 small text-muted"><i class="fas fa-calendar-alt mr-1"></i> Registered: ${new Date(user.userDateCreated).toLocaleDateString()}</p>
                                        </div>
                                    </div>
                                    `;
                                } else {
                                    content = '<div class="text-danger p-2"><i class="fas fa-exclamation-circle mr-1"></i> Error loading profile</div>';
                                }

                                element.popover('dispose').popover({
                                    html: true,
                                    trigger: 'manual',
                                    container: 'body',
                                    content: content
                                }).popover('show');
                            })
                            .catch(() => {
                                element.popover('dispose').popover({
                                    html: true,
                                    trigger: 'manual',
                                    container: 'body',
                                    content: '<div class="text-danger p-2"><i class="fas fa-exclamation-circle mr-1"></i> Network error</div>'
                                }).popover('show');
                            });
                    }

                    // Hide popover when clicking outside
                    $(document).on('click', function(e) {
                        const $target = $(e.target);
                        if (
                            !$target.closest('[data-toggle="popover"]').length &&
                            !$target.closest('.popover').length
                        ) {
                            $('[data-toggle="popover"]').popover('hide');
                        }
                    });

                    // DOM ready
                    $(function() {
                        initPopovers();
                    });
                    </script>

                    <style>
                    .signer-profile {
                        max-width: 280px;
                        font-size: 0.9rem;
                    }
                    .popover {
                        border: 1px solid rgba(0,0,0,.1);
                        box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,.1);
                        z-index: 1060;
                    }
                    .popover-header {
                        background-color: #f8f9fa;
                        border-bottom: 1px solid #ebebeb;
                        font-size: 1rem;
                        font-weight: 600;
                    }
                    .user-details p {
                        margin-bottom: 0.4rem;
                        line-height: 1.4;
                    }
                    .signature-img:hover {
                        opacity: 0.9;
                        transform: scale(1.02);
                        transition: all 0.2s ease;
                    }
                    </style>
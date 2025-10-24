<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<style>
@media print {
    .btn, .navbar, .sidebar, .print-hide, .comment-section {
        display: none !important;
    }
    body {
        margin: 0;
        padding: 1cm;
        color-adjust: exact;
    }
}
.govt-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
.govt-label {
    font-weight: 600;
    color: #1a3e72;
}
.photo-id {
    border: 1px solid #dee2e6;
    padding: 3px;
    background: white;
}
.certificate-card {
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    margin-bottom: 20px;
}
.certificate-card-header {
    background-color: #f5f7fa;
    padding: 10px 15px;
    border-bottom: 1px solid #e0e0e0;
}
.comment-form {
    background: #f8fafc;
    padding: 15px;
    border-radius: 4px;
    border: 1px solid #e2e8f0;
}
.remarks-list {
    max-height: 400px;
    overflow-y: auto;
    padding-right: 5px;
}
.remark-item {
    padding: 12px;
    margin-bottom: 10px;
    background: white;
    border-radius: 4px;
    border: 1px solid #edf2f7;
}
.file-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
    transition: background-color 0.3s;
}
.file-item:hover {
    background-color: #f8f9fa;
}
.file-icon {
    font-size: 24px;
    margin-right: 15px;
    color: #6c757d;
}
.file-info {
    flex: 1;
}
.file-actions {
    margin-left: 15px;
}
</style>
<script>
  let allowEdit = true;
</script>

<div class="row">
    <!-- Main Certificate Content -->
    <div class="col-md-8">


        <div class="card">
          <div class="card-header d-flex justify-content-end align-items-center">
            <div class="btn-group">
              <?php if(session()->get('userData')['userBreanch'] == $certificate['cert_branch']) : ?>
                    <a href="/dashboard/wedcert/print/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-certificate"></i>
                        </span>
                        <span class="text">Generate</span>
                    </a>
                    <button onclick="window.print();" class="btn btn-sm btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Print</span>
                    </button>
                        <?php if (session()->get('userData')['userAccountType'] == "ENTRY"): ?>
                          <?php if($certificate['SIGNA'] == null || $certificate['SIGNB'] == null || $certificate['SIGNC'] == null): ?>
                            <a href="/dashboard/wedcert/edit/<?= $certificate['marriage_cert_id'] ?>" class="btn ben-sm btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                            <?php endif; ?>
                        <?php else: ?>
                          <?php if($certificate['SIGNA'] == null || $certificate['SIGNB'] == null || $certificate['SIGNC'] == null): ?>
                            <a href="/dashboard/wedcert/sign/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm btn-warning btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-signature"></i>
                                </span>
                                <span class="text">Sign</span>
                            </a>
                            <?php else: ?>
                              <script>
                                allowEdit = false;
                              </script>
                              <a href="/dashboard/wedcert/allow_edit/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="text">Allow Edit</span>
                              </a>
                              <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
            </div>
          </div>
          <div class="card-body">
            <img src="/uploads/marriage/template/letter_head.png" class="w-100" alt="Letterhead"  class="mb-3">
              <center>
                <h4 class="mb-5"> TRADITIONAL MARRIAGE CERTIFICATE</h4>
              </center>
        <!-- Couple Information -->
        <div class="row mb-4">
            <!-- Groom -->
            <div class="col-md-6">
                <div class="certificate-card">
                    <div class="certificate-card-header">
                        <h5 class="govt-label mb-0"><i class="fas fa-male text-primary"></i> GROOM'S PARTICULARS</h5>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-8">
                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate['groom_name']) ?></p>
                                <p><span class="govt-label">Date of Birth:</span> <?= esc($certificate['groom_dob']) ?> (<?= esc($certificate['groom_age']) ?> yrs)</p>
                                <p><span class="govt-label">Origin:</span> <?= esc($certificate['groom_county_of_origin']) ?></p>
                                <p><span class="govt-label">Birth Place:</span> <?= esc($certificate['groom_birth_city']) ?>, <?= esc($certificate['groom_birth_county']) ?></p>
                                <p><span class="govt-label">Nationality:</span> <?= esc($certificate['groom_nationality']) ?></p>
                                <p><span class="govt-label">Contact:</span> <?= esc($certificate['groom_cell']) ?></p>
                                <p><span class="govt-label">Address:</span><br><?= esc($certificate['groom_address']) ?></p>
                                <p><span class="govt-label">Parents:</span><br>
                                    Father: <?= esc($certificate['groom_father_name']) ?><br>
                                    Mother: <?= esc($certificate['groom_mother_name']) ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <img src="<?= base_url('uploads/marriage/' . $certificate['groom_passport_photo']) ?>" class="photo-id img-fluid mb-2" width="120">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bride -->
            <div class="col-md-6">
                <div class="certificate-card">
                    <div class="certificate-card-header">
                        <h5 class="govt-label mb-0"><i class="fas fa-female text-danger"></i> BRIDE'S PARTICULARS</h5>
                    </div>
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-8">
                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate['bride_name']) ?></p>
                                <p><span class="govt-label">Date of Birth:</span> <?= esc($certificate['bride_dob']) ?> (<?= esc($certificate['bride_age']) ?> yrs)</p>
                                <p><span class="govt-label">Origin:</span> <?= esc($certificate['bride_county_of_origin']) ?></p>
                                <p><span class="govt-label">Birth Place:</span> <?= esc($certificate['bride_birth_city']) ?>, <?= esc($certificate['bride_birth_county']) ?></p>
                                <p><span class="govt-label">Nationality:</span> <?= esc($certificate['bride_nationality']) ?></p>
                                <p><span class="govt-label">Contact:</span> <?= esc($certificate['bride_cell']) ?></p>
                                <p><span class="govt-label">Address:</span><br><?= esc($certificate['bride_address']) ?></p>
                                <p><span class="govt-label">Parents:</span><br>
                                    Father: <?= esc($certificate['bride_father_name']) ?><br>
                                    Mother: <?= esc($certificate['bride_mother_name']) ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <img src="<?= base_url('uploads/marriage/' . $certificate['bride_passport_photo']) ?>" class="photo-id img-fluid mb-2" width="120">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Certificate Details Card -->
        <div class="certificate-card mb-4">
            <div class="certificate-card-header">
                <h5 class="govt-label mb-0"><i class="fas fa-file-alt text-dark"></i> CERTIFICATE DETAILS</h5>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="govt-label">Reference No:</span> <?= esc($certificate['reference_no']) ?></p>
                        <p><span class="govt-label">Marriage Code:</span> <?= esc($certificate['marriage_code']) ?></p>
                        <p><span class="govt-label">Date of Marriage:</span> <?= esc($certificate['date_of_marriage']) ?></p>
                        <p><span class="govt-label">Place of Marriage:</span> <?= esc($certificate['place_of_marriage']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><span class="govt-label">Officiator:</span> <?= esc($certificate['officiator_name']) ?> (<?= esc($certificate['officiator_contact']) ?>)</p>
                        <p><span class="govt-label">Witness:</span> <?= esc($certificate['witness_name']) ?> (<?= esc($certificate['witness_contact']) ?>)</p>
                        <p><span class="govt-label">Certificate Cost:</span> $<?= esc($certificate['certificate_cost']) ?> (<?= esc($certificate['certificate_cost_words']) ?>)</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <p><span class="govt-label">Declarant:</span> <?= esc($certificate['declarant_name']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><span class="govt-label">Declaration Date:</span> <?= esc($certificate['declaration_date']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Administrative Details Card -->
        <div class="certificate-card mb-4">
            <div class="certificate-card-header">
                <h5 class="govt-label mb-0"><i class="fas fa-landmark text-info"></i> ADMINISTRATIVE DETAILS</h5>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-6">
                        <p><span class="govt-label">Branch:</span> <?= esc($certificate['branchName']) ?></p>
                        <p><span class="govt-label">Location:</span> <?= esc($certificate['branchCityOrTown']) ?>, <?= esc($certificate['branchCounty']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><span class="govt-label">Processed By:</span> <?= esc($certificate['userFullName']) ?></p>
                        <p><span class="govt-label">Record Created:</span> <?= date('d/m/Y H:i', strtotime($certificate['created_at'])) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="certificate-card mb-4 pb-0">
            <div class="certificate-card-header">
                <h5 class="govt-label mb-0"><i class="fa  text-danger fa-file-pdf"></i>Attached Document</h5>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-md-12" id="certificateFilesContainer">
                        <!-- Files will be loaded here -->
                        <div class="text-center py-3">
                            <i class="fas fa-spinner fa-spin"></i> Loading files...
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-around  bg-light mb-0">
                        <?php if(session()->get('userData')['userBreanch'] == $certificate['cert_branch']) : ?>
                            <button type="button" class="btn  mt-3 btn-secondary btn-icon-split" data-toggle="modal" data-target="#uploadModal">
                            <span class="icon text-white-50">
                                <i class="fa fa-file-upload"></i>
                            </span>
                            <span class="text">Upload File</span>
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include("partials/popovers/who_sign_button_pop_over.php") ?>


          </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="col-md-4">
        <div class="comment-form mb-4">
            <h5 class="govt-label mb-3"><i class="fas fa-comment-dots text-info"></i> ADD OFFICIAL REMARK</h5>
              <?php if(session()->get('userData')['userBreanch'] == $certificate['cert_branch']) : ?>
            <form action="" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <input type="hidden" name="certificate_id" value="<?= $certificate['marriage_cert_id'] ?>">
                <input type="hidden" name="certificate_type" value="marriage">
                <input type="hidden" name="user_id" value="<?=session()->get('userData')['userId']?>">
                <div class="form-group mb-3">
                    <textarea class="form-control" name="comment_text" rows="4" placeholder="Enter official remarks..." required style="border-radius: 4px;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-paper-plane me-2"></i> Submit Remark
                </button>
            </form>
            <?php else: ?>
                <div class="alert alert-warning">
                    <p class="lead">Only users at this branch can comment on this document.</p>
                </div>
            <?php endif; ?>
        </div>
    
    <div class="card-body shadow-sm" id="comments_div"></div>


    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="uploadForm" enctype="multipart/form-data">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="uploadModalLabel">
            <i class="fas fa-cloud-upload-alt mr-2"></i>Attach Supporting Document
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <!-- Alert Container (for dynamic messages) -->
          <div id="uploadAlertContainer"></div>
          
          <!-- Hidden Fields -->
          <input type="hidden" name="fileCertificateId" value="<?= $certificate['marriage_cert_id'] ?>">
          <input type="hidden" name="certificateFile_category" value="marriage">
          
          <!-- Document Information -->
          <div class="form-group">
            <label for="fileTitle" class="font-weight-bold">Document Title</label>
            <input type="text" class="form-control" id="fileTitle" name="fileTitle" 
                   placeholder="e.g., Marriage Certificate, Affidavit, etc." required>
            <small class="form-text text-muted">Give this document a descriptive name</small>
          </div>
          
          <!-- File Upload Section -->
          <div class="form-group">
            <label for="attached_file" class="font-weight-bold">Select File</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="attached_file" 
                     name="certificateFile" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
              <label class="custom-file-label" for="attached_file" id="fileLabel">Choose file...</label>
            </div>
            <small class="form-text text-muted">
              Accepted formats: PDF, JPG, PNG, DOC/DOCX (Max 2MB)
            </small>
          </div>
          
          <!-- Preview Section (will be shown after file selection) -->
          <div class="card mt-3 d-none" id="filePreviewCard">
            <div class="card-header bg-light">
              <h6 class="mb-0">File Preview</h6>
            </div>
            <div class="card-body p-2">
              <div class="d-flex align-items-center">
                <div id="filePreviewIcon" class="mr-3" style="font-size: 2rem;">
                  <i class="far fa-file-alt text-secondary"></i>
                </div>
                <div>
                  <h6 id="fileNamePreview" class="mb-1">filename.pdf</h6>
                  <small id="fileSizePreview" class="text-muted">0 KB</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-icon-split" data-dismiss="modal">
            <span class="icon text-white-50">
                <i class="fas fa-times"></i>
            </span>
            <span class="text">Cancel</span>
          </button>
          <button type="submit" class="btn btn-primary btn-icon-split" id="submitBtn" style="">
            <span class="icon text-white-50">
                <i class="fas fa-upload"></i>
            </span>
            <span class="text">Upload</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript for Form Functionality -->
<script>
// ========== FILE UPLOAD ===========
document.addEventListener('DOMContentLoaded', function() {
  // Load certificate files
  loadCertificateFiles(<?= $certificate['marriage_cert_id'] ?>);
  
  // Initialize file upload modal functionality
  const uploadForm = document.getElementById('uploadForm');
  if (uploadForm) {
    const fileInput = document.getElementById('attached_file');
    const fileLabel = document.getElementById('fileLabel');
    const filePreviewCard = document.getElementById('filePreviewCard');
    const fileNamePreview = document.getElementById('fileNamePreview');
    const fileSizePreview = document.getElementById('fileSizePreview');
    const filePreviewIcon = document.getElementById('filePreviewIcon');
    const submitBtn = document.getElementById('submitBtn');
    const originalBtnText = submitBtn.innerHTML;
    const alertContainer = document.getElementById('uploadAlertContainer');

    // File input change handler
    fileInput.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const file = this.files[0];
        const fileSize = (file.size / 1024).toFixed(2); // KB
        
        // Update file label
        fileLabel.textContent = file.name;
        
        // Update preview
        fileNamePreview.textContent = file.name;
        fileSizePreview.textContent = `${fileSize} KB`;
        
        // Update icon based on file type
        const fileType = file.type.split('/')[0];
        const fileExtension = file.name.split('.').pop().toLowerCase();
        let iconClass = 'far fa-file-alt';
        
        if (fileType === 'image') {
          iconClass = 'far fa-file-image';
        } else if (fileExtension === 'pdf') {
          iconClass = 'far fa-file-pdf';
        } else if (['doc', 'docx'].includes(fileExtension)) {
          iconClass = 'far fa-file-word';
        }
        
        filePreviewIcon.innerHTML = `<i class="${iconClass} text-secondary"></i>`;
        filePreviewCard.classList.remove('d-none');
      }
    });

    // Form submission handler
    uploadForm.addEventListener('submit', function(e) {
      e.preventDefault();
      clearAlerts();
      
      // Validate file
      if (!fileInput.files || fileInput.files.length === 0) {
        showAlert('danger', 'Please select a file to upload.');
        return;
      }
      
      // Check file size (client-side validation)
      const file = fileInput.files[0];
      if (file.size > 6 * 1024 * 1024) { // 6MB
        showAlert('danger', 'File size exceeds 6MB limit.');
        return;
      }

      // Show loading state
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...';
      submitBtn.disabled = true;

      const formData = new FormData(uploadForm);
      const xhr = new XMLHttpRequest();

      xhr.open('POST', '/dashboard/upload/wedcert_file', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

      xhr.onload = function() {
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;

        try {
          const response = JSON.parse(xhr.responseText);

          if (xhr.status >= 200 && xhr.status < 300) {
            if (response.status === 'success') {
              showAlert('success', 'Document uploaded successfully!');
              uploadForm.reset();
              filePreviewCard.classList.add('d-none');
              fileLabel.textContent = 'Choose file...';
              
              // Reload files after successful upload
              loadCertificateFiles(<?= $certificate['marriage_cert_id'] ?>);
              
              // Close modal after delay
              setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
                if (modal) modal.hide();
              }, 1500);
            } else {
              showAlert('danger', response.message || 'Upload failed.');
            }
          } else {
            showAlert('danger', response.message || `Error: Server returned status ${xhr.status}`);
          }
        } catch (err) {
          showAlert('danger', 'Error processing server response.');
          console.error('Error:', err);
        }
      };

      xhr.onerror = function() {
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
        showAlert('danger', 'Network error occurred. Please try again.');
      };

      xhr.send(formData);
    });

    // Clear alerts when modal is opened/closed
    const uploadModal = document.getElementById('uploadModal');
    if (uploadModal) {
      const modalInstance = new bootstrap.Modal(uploadModal);
      
      uploadModal.addEventListener('show.bs.modal', clearAlerts);
      uploadModal.addEventListener('hidden.bs.modal', function() {
        clearAlerts();
        uploadForm.reset();
        filePreviewCard.classList.add('d-none');
        fileLabel.textContent = 'Choose file...';
      });
    }

    // Helper functions
    function showAlert(type, message) {
      const alertDiv = document.createElement('div');
      alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
      alertDiv.setAttribute('role', 'alert');
      alertDiv.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      `;
      alertContainer.appendChild(alertDiv);
      
      // Auto-dismiss after 5 seconds
      setTimeout(() => {
        if (alertDiv.parentNode) {
          alertDiv.classList.remove('show');
          setTimeout(() => alertDiv.remove(), 150);
        }
      }, 5000);
    }

    function clearAlerts() {
      alertContainer.innerHTML = '';
    }
  }

  // =========== SAVE COMMENT ===========
  const certificateId = <?= $certificate['marriage_cert_id'] ?>;
  fetchAndDisplayComments(certificateId);

  // Comment form submission
  const commentForm = document.querySelector('.comment-form form');
  if (commentForm) {
    commentForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const textarea = this.querySelector('textarea');
      const comment = textarea.value.trim();
      
      if (comment === '') {
        alert('Please enter a comment.');
        textarea.focus();
        return;
      }

      const formData = new FormData(this);
      const xhr = new XMLHttpRequest();
      
      xhr.open('POST', '/dashboard/ajax/save_comment', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            try {
              const response = JSON.parse(xhr.responseText);
              if (response.status === 'success') {
                textarea.value = '';
                fetchAndDisplayComments(certificateId);
                
                // Show success message
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show';
                alertDiv.innerHTML = `
                  Comment submitted successfully!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                const commentFormHeader = document.querySelector('.comment-form h5');
                if (commentFormHeader) {
                  commentFormHeader.parentNode.insertBefore(alertDiv, commentFormHeader.nextSibling);
                  
                  // Auto-dismiss after 3 seconds
                  setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alertDiv);
                    bsAlert.close();
                  }, 3000);
                }
              } else {
                alert('Failed to submit comment: ' + (response.message || 'Unknown error'));
              }
            } catch (err) {
              alert('Error parsing server response.');
              console.error(err);
            }
          } else {
            alert('Error submitting comment. Try again.');
            console.error(xhr.statusText);
          }
        }
      };
      xhr.send(formData);
    });
  }

  // Mark notification as viewed
  const notificationUrl = `/dashboard/ajax/mark_notification_as_view/${certificateId}`;
  const notificationXhr = new XMLHttpRequest();
  notificationXhr.open('GET', notificationUrl, true);
  notificationXhr.send();
});

// ========== LOAD CERTIFICATE FILES ==========

function loadCertificateFiles(certificateId) {
  const container = document.getElementById('certificateFilesContainer');
  if (!container) return;
  
  container.innerHTML = '<div class="text-center py-3"><i class="fas fa-spinner fa-spin"></i> Loading files...</div>';
  
  fetch(`/dashboard/get_file/wedcert_file/marriage/${certificateId}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(response => {
      if (!response || response.status !== 'success' || !Array.isArray(response.data)) {
        throw new Error('Invalid response format from server');
      }

      if (response.data.length === 0) {
        container.innerHTML = '<div class="alert alert-info text-center">No files attached yet.</div>';
        return;
      }

      let html = '';
      response.data.forEach(file => {
        if (!file || !file.fileId) {
          console.warn('Skipping invalid file entry:', file);
          return;
        }

        const fileName = file.certificateFile || 'document.pdf';
        const fileTitle = file.fileTitle || 'Untitled Document';
        const fileId = file.fileId;
        const createdAt = file.fileCreatedAt ? new Date(file.fileCreatedAt) : new Date();

        const fileExtension = fileName.split('.').pop().toLowerCase();
        let iconClass, iconColor;

        switch (fileExtension) {
          case 'jpg':
          case 'jpeg':
          case 'png':
          case 'gif':
            iconClass = 'fa-file-image';
            iconColor = 'text-success';
            break;
          case 'pdf':
            iconClass = 'fa-file-pdf';
            iconColor = 'text-danger';
            break;
          case 'doc':
          case 'docx':
            iconClass = 'fa-file-word';
            iconColor = 'text-primary';
            break;
          default:
            iconClass = 'fa-file-alt';
            iconColor = 'text-secondary';
        }

        html += `
          <div class="file-item">
            <div class="file-icon ${iconColor}">
              <i class="far ${iconClass}"></i>
            </div>
            <div class="file-info">
              <h6 class="mb-1">${fileTitle}</h6>
              <small class="text-muted">Uploaded: ${createdAt.toLocaleDateString()}</small>
            </div>
            <div class="file-actions">
              <a href="/dashboard/download_file/wedcert_file/${fileId}" 
                class="btn btn-sm rounded-pill btn-primary btn-icon-split"
                download="${fileName}">
                <span class="icon text-white-50">
                  <i class="fas fa-download"></i>
                </span>
              </a>
              <button class="btn btn-sm btn-danger rounded-pill btn-icon-split delete-file-btn" data-file-id="${fileId}">
                <span class="icon text-white-50">
                  <i class="fas fa-trash"></i>
                </span>
                
              </button>
            </div>
          </div>
        `;
      });

      container.innerHTML = html || '<div class="alert alert-warning text-center">No valid files found</div>';
      
      // Attach delete handlers
      document.querySelectorAll('.delete-file-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const fileId = this.getAttribute('data-file-id');
          if (confirm('Are you sure you want to delete this file?')) {
            deleteCertificateFile(fileId, certificateId);
          }
        });
      });
    })
    .catch(error => {
      console.error('Error loading files:', error);
      container.innerHTML = `
        <div class="alert alert-danger text-center">
          <i class="fas fa-exclamation-triangle"></i> Failed to load files<br>
          <small>${error.message}</small>
          <div class="mt-2">
            <button onclick="loadCertificateFiles(${certificateId})" 
                  class="btn btn-sm btn-outline-primary">
              <i class="fas fa-sync-alt"></i> Try Again
            </button>
          </div>
        </div>
      `;
    });
}

// =========== FUNCTION TO DELETE CERTIFICATE FILE 
function deleteCertificateFile(fileId, certificateId) {
  if(allowEdit === false) {
    alert('The certificate is locked. You are not allowed to delete files for this certificate.');
    return;
  }
  fetch(`/dashboard/ajax/delete_file/${fileId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then(response => {
    if (response.status === 'success') {
      // Show success message and reload files
      // alert that the document is successfully deleted
      alert('File deleted successfully!');
      loadCertificateFiles(certificateId);
    } else {
      throw new Error(response.message || 'Failed to delete file');
    }
  })
  .catch(error => {
    console.error('Error deleting file:', error);
    alert('Error deleting file: ' + error.message);
  });
}
// =========== LOAD CERTIFICATE COMMENT ===============
function fetchAndDisplayComments(certificateId) {
  const url = `/dashboard/ajax/get_comments/marriage/${certificateId}`;
  const commentsDiv = document.getElementById('comments_div');
  if (!commentsDiv) return;

  // Clear previous content
  commentsDiv.innerHTML = '<p>Loading comments...</p>';

  const xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        try {
          const response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
            const comments = response.comments;

            if (comments.length === 0) {
              commentsDiv.innerHTML = '<p class="alert alert-info">No comments yet.</p>';
              return;
            }

            let html = '';
            comments.forEach(comment => {
              html += `
                <div class="comment mb-3 p-2 border rounded position-relative" data-comment-id="${comment.comment_id}">
                  <div class="d-flex align-items-center mb-2">
                    <img src="/uploads/users/pictures/${comment.userPicture}" alt="User Image" width="40" height="40" class="rounded-circle me-2">
                    <strong>${comment.userFullName}</strong>
                    <button type="button" class="btn btn-sm btn-link text-danger ms-auto delete-comment-btn" title="Delete" data-comment-id="${comment.comment_id}">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                  <div>
                    <p class="mb-1">${comment.comment_text}</p>
                    <small class="text-muted">${new Date(comment.created_at).toLocaleString()}</small>
                  </div>
                </div>
              `;
            });

            commentsDiv.innerHTML = html;

            // Attach delete handlers
            document.querySelectorAll('.delete-comment-btn').forEach(btn => {
              btn.addEventListener('click', function(e) {
                const commentId = this.getAttribute('data-comment-id');
                if (confirm('Are you sure you want to delete this comment?')) {
                  deleteComment(commentId, certificateId);
                }
              });
            });
          } else {
            commentsDiv.innerHTML = '<p class="alert alert-danger">Error: Failed to load comments.</p>';
          }
        } catch (err) {
          console.error(err);
          commentsDiv.innerHTML = '<p class="alert alert-danger">Error parsing server response.</p>';
        }
      } else {
        commentsDiv.innerHTML = `<p class="alert alert-danger">Request failed with status ${xhr.status}.</p>`;
      }
    }
  };

  xhr.send();
}

// ========= DELETE COMMENT 
function deleteComment(commentId, certificateId) {

    if(allowEdit === false) {
        alert('This certificate is locked and as such you cannot delete any comment.');
        return;
    }
    fetch(`/dashboard/ajax/delete_comments/${encodeURIComponent(commentId)}`, {
        method: "GET"
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            // Reload comments
            fetchAndDisplayComments(certificateId);
            alert("Comment deleted successfully!");
        } else {
            alert("Failed to delete comment: " + (data.message || "Unknown error"));
        }
    })
    .catch(error => {
        console.error("Delete comment error:", error);
        alert("An error occurred while deleting the comment.");
    });
}
</script>


<?= $this->endSection() ?>
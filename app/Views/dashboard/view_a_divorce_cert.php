<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>
<script>
    const allowDeleteDocument = true;
</script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom">
                <div class="d-flex justify-content-end align-items-center">
                
                    <div class="btn-group">

                        <?php if(session()->get('userData')['userBreanch'] == $certificate[0]['divorcebreanch_id']) : ?>
                            <a href="/dashboard/divorce_cert/generate_certificate/<?= $certificate[0]['divorceCertId'] ?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                <span class="text">Generate </span>
                            </a>
                           
                            <button class="btn btn-secondary btn-sm btn-icon-split" onclick="window.print()">
                                <span class="icon text-white-50">
                                    <i class="fas fa-print"></i>
                                </span>
                                <span class="text">Print </span>
                            </button>
                            <?php if (session()->get('userData')['userAccountType'] == "ENTRY"): ?>
                                <?php if($certificate[0]['divorceSIGN_A'] == null || $certificate[0]['divorceSIGN_B'] == null || $certificate[0]['divorceSIGN_C'] == null): ?>
                                    <a href="/dashboard/edit_divorce_cert/<?= $certificate[0]['divorceCertId'] ?>" class="btn btn-sm btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <span class="text">Edit </span>
                                </a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (session()->get('userData')['userAccountType'] != "ENTRY"): ?>
                                <?php if($certificate[0]['divorceSIGN_A'] == null || $certificate[0]['divorceSIGN_B'] == null || $certificate[0]['divorceSIGN_C'] == null): ?>
                                    <a href="/dashboard/divorce_cert/sign/<?= $certificate[0]['divorceCertId'] ?>" class="btn btn-sm btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-signature"></i>
                                        </span>
                                        <span class="text">Sign </span>
                                    </a>
                                <?php else: ?>
                                    <a href="/dashboard/divorce_cert/allow_edit/<?= $certificate[0]['divorceCertId'] ?>" class="btn btn-sm btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        <span class="text">Unlock To Edit </span>
                                        <script>
                                            allowDeleteDocument = false;                                          
                                        </script>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Certificate Header -->
                <div class="text-center mb-4">
                    <img src="/uploads/marriage/template/letter_head.png" class="w-100" alt="Letterhead"  class="mb-3">
                    
                    <h4 class=" mt-3 font-weight-bold">DIVORCE CERTIFICATE</h4>
                    <div class=" py-2 my-3">
                        <p class="mb-0 text-muted">
                            <i class="fas fa-certificate text-primary mr-1"></i>
                            Certificate No: <?= $certificate[0]['divorceRefNo'] ?>
                        </p>
                    </div>
                </div>
                
                <!-- Main Certificate Content -->
                <div class="row">
                    <!-- Left Column - Plaintiff Info -->
                    <div class="col-md-6">
                        <div class="card mb-4 mary">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0 font-weight-bold ">
                                    <i class="fas fa-user mr-2"></i>Plaintiff Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <img src="/uploads/divorce/<?= $certificate[0]['divorceplaintiffPic'] ?>" 
                                             alt="Plaintiff Photo" 
                                             class="img-fluid rounded border"
                                             style="max-height: 150px;">
                                    </div>
                                    <div class="col-md-8">
                                        <p class="mb-2">
                                            <strong><i class="fas fa-user-tag mr-2 text-muted"></i>Name:</strong>
                                            <?= $certificate[0]['divorceplaintiff'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Defendant Info -->
                    <div class="col-md-6">
                        <div class="card mb-4 ger">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0 font-weight-bold ">
                                    <i class="fas fa-user-friends mr-2"></i>Defendant Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <img src="/uploads/divorce/<?= $certificate[0]['divorcedefendantPic'] ?>" 
                                             alt="Defendant Photo" 
                                             class="img-fluid rounded border"
                                             style="max-height: 150px;">
                                    </div>
                                    <div class="col-md-8">
                                        <p class="mb-2">
                                            <strong><i class="fas fa-user-tag mr-2 text-muted"></i>Name:</strong>
                                            <?= $certificate[0]['divorcedefendant'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Marriage Details -->
                <div class="card ondary mb-4">
                    <div class="card-header bg-light py-2">
                        <h5 class="mb-0 font-weight-bold text-secondary">
                            <i class="fas fa-heart mr-2"></i>Marriage Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="mb-2">
                                    <strong><i class="fas fa-calendar-check mr-2 text-muted"></i>Marriage Date:</strong>
                                    <?= date('F j, Y', strtotime($certificate[0]['divorcemarriageDate'])) ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-2">
                                    <strong><i class="fas fa-calendar-times mr-2 text-muted"></i>Divorce Date:</strong>
                                    <?= date('F j, Y', strtotime($certificate[0]['divorcedateOfDivorce'])) ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-2">
                                    <strong><i class="fas fa-file-signature mr-2 text-muted"></i>Issuance Date:</strong>
                                    <?= date('F j, Y', strtotime($certificate[0]['divorceissuanceDate'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Certificate Metadata -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card o mb-4">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0 font-weight-bold ">
                                    <i class="fas fa-barcode mr-2"></i>Certificate Codes
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong><i class="fas fa-hashtag mr-2 text-muted"></i>Reference No:</strong>
                                    <?= $certificate[0]['divorceRefNo'] ?>
                                </p>
                                <p class="mb-2">
                                    <strong><i class="fas fa-qrcode mr-2 text-muted"></i>Certificate Code:</strong>
                                    <?= $certificate[0]['divorceCode'] ?>
                                </p>
                                <p class="mb-2">
                                    <strong><i class="fas fa-redo mr-2 text-muted"></i>Revision No:</strong>
                                    <?= $certificate[0]['divorceRevNo'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card cess mb-4">
                            <div class="card-header bg-light py-2">
                                <h5 class="mb-0 font-weight-bold ">
                                    <i class="fas fa-building mr-2"></i>Branch Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong><i class="fas fa-landmark mr-2 text-muted"></i>Branch:</strong>
                                    <?= $certificate[0]['branchName'] ?>
                                </p>
                                <p class="mb-2">
                                    <strong><i class="fas fa-map-marker-alt mr-2 text-muted"></i>Location:</strong>
                                    <?= $certificate[0]['branchCityOrTown'] ?>, <?= $certificate[0]['branchCounty'] ?>
                                </p>
                                <p class="mb-2">
                                    <strong><i class="fas fa-calendar-plus mr-2 text-muted"></i>Date Recorded:</strong>
                                    <?= date('F j, Y h:i A', strtotime($certificate[0]['divorcecreated_at'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Signature Section -->
                <div class=" pt-4 mt-4 text-center">
                    <?php include('partials/popovers/who_sign_button_pop_over2.php'); ?>
                    <div class="mt-4">
                        <p class="text-muted small">
                            <i class="fas fa-info-circle mr-1"></i>
                            This is an official document of the Government of Liberia. Any unauthorized alteration is punishable by law.
                        </p>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h4>Attached files</h4>
                </div>
                <div class="card-body">
                    <div id="file_div"></div>
                </div>
                <div class="card-footer d-flex justify-content-around ">
                    <?php if(session()->get('userData')['userBreanch'] == $certificate[0]['divorcebreanch_id']) : ?>
                            <button type="button" class="btn   btn-dark btn-icon-split" data-toggle="modal" data-target="#uploadModal">
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
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
 <!-- Comments Section -->
    <div class="col-md-12">
        <div class="comment-form mb-4">
            <h5 class="govt-label mb-3"><i class="fas fa-comment-dots text-info"></i> ADD OFFICIAL REMARK</h5>
              <?php if(session()->get('userData')['userBreanch'] == $certificate[0]['divorcebreanch_id']) : ?>
            <form action="" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <input type="hidden" name="certificate_id" value="<?= $certificate[0]['divorceCertId'] ?>">
                <input type="hidden" name="certificate_type" value="divorce">
                <input type="hidden" name="user_id" value="<?=session()->get('userData')['userId']?>">
                <div class="form-group mb-3">
                    <textarea class="form-control" name="comment_text" rows="4" placeholder="Enter official remarks..." required style="border-radius: 4px;"></textarea>
                </div>
                <button type="submit" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-paper-plane"></i>
                    </span>
                    <span class="text">Submit Remark</span>
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
          <input type="hidden" name="fileCertificateId" value="<?=$certificate[0]['divorceCertId'] ?>">
          <input type="hidden" name="certificateFile_category" value="divorce">
          
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

<style>
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .signature-line {
        height: 50px;
    }
</style>

<script>
// Consolidated JavaScript with proper event handling
document.addEventListener("DOMContentLoaded", function() {
    // Initialize all components
    initFileUpload();
    initFileList();
    initComments();
});

/**
 * Initialize file upload functionality
 */
function initFileUpload() {
    const uploadForm = document.getElementById("uploadForm");
    const fileInput = document.getElementById("attached_file");
    const fileLabel = document.getElementById("fileLabel");
    const previewCard = document.getElementById("filePreviewCard");
    const fileNamePreview = document.getElementById("fileNamePreview");
    const fileSizePreview = document.getElementById("fileSizePreview");
    const filePreviewIcon = document.getElementById("filePreviewIcon");
    const alertContainer = document.getElementById("uploadAlertContainer");
    const submitBtn = document.getElementById("submitBtn");

    if (!uploadForm) return;

    // File preview logic
    fileInput.addEventListener("change", function() {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            fileLabel.textContent = file.name;
            fileNamePreview.textContent = file.name;
            fileSizePreview.textContent = (file.size / 1024).toFixed(1) + " KB";
            
            // Set icon based on file type
            let icon = "far fa-file-alt text-secondary";
            if (/\.(pdf)$/i.test(file.name)) icon = "far fa-file-pdf text-danger";
            else if (/\.(jpg|jpeg|png)$/i.test(file.name)) icon = "far fa-file-image text-info";
            else if (/\.(doc|docx)$/i.test(file.name)) icon = "far fa-file-word text-primary";
            
            filePreviewIcon.innerHTML = `<i class="${icon}"></i>`;
            previewCard.classList.remove("d-none");
        } else {
            fileLabel.textContent = "Choose file...";
            previewCard.classList.add("d-none");
        }
    });

    // Upload logic
    uploadForm.addEventListener("submit", function(e) {
        e.preventDefault();
        alertContainer.innerHTML = "";
        submitBtn.disabled = true;
        submitBtn.querySelector(".text").textContent = "Uploading...";

        const formData = new FormData(uploadForm);

        // Client-side file size check (2MB)
        if (fileInput.files.length > 0 && fileInput.files[0].size > 2 * 1024 * 1024) {
            alertContainer.innerHTML = `<div class="alert alert-danger">File size exceeds 2MB limit.</div>`;
            submitBtn.disabled = false;
            submitBtn.querySelector(".text").textContent = "Upload";
            return;
        }

        fetch("/dashboard/upload/wedcert_file", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            submitBtn.disabled = false;
            submitBtn.querySelector(".text").textContent = "Upload";
            
            if (data.status === "success") {
                alertContainer.innerHTML = `<div class="alert alert-success">${data.message || "File uploaded successfully."}</div>`;
                uploadForm.reset();
                previewCard.classList.add("d-none");
                fileLabel.textContent = "Choose file...";
                
                // Refresh file list after successful upload
                loadFiles();
                
                setTimeout(() => {
                    $('#uploadModal').modal('hide');
                    alertContainer.innerHTML = "";
                }, 1200);
            } else {
                alertContainer.innerHTML = `<div class="alert alert-danger">${data.message || "Upload failed."}</div>`;
            }
        })
        .catch(error => {
            submitBtn.disabled = false;
            submitBtn.querySelector(".text").textContent = "Upload";
            alertContainer.innerHTML = `<div class="alert alert-danger">Network error. Please try again.</div>`;
            console.error("Upload error:", error);
        });
    });
}

/**
 * Initialize and manage file list display
 */
function initFileList() {
    const fileDiv = document.getElementById("file_div");
    const certId = <?= json_encode($certificate[0]['divorceCertId']) ?>;

    if (!fileDiv) return;

    // Load files initially
    loadFiles();

    // Make loadFiles available globally for refresh after upload
    window.loadFiles = loadFiles;
    function loadFiles() {
        fetch(`/dashboard/get_file/wedcert_file/divorce/${certId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success" && Array.isArray(data.data)) {
                    if (data.data.length > 0) {
                        fileDiv.innerHTML = `
                            <ul class="list-group">
                                ${data.data.map(file => `
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>${file.fileTitle}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                Uploaded on: ${new Date(file.fileCreatedAt.replace(' ', 'T')).toLocaleString()}
                                            </small>
                                        </div>
                                        <div>
                                            <a download href="/uploads/files/${file.certificateFile}" target="_blank" class="btn btn-sm btn-outline-primary mr-2" title="View/Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" 
                                                onclick="deleteCertificateFile('${file.fileId}', '${certId}')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </li>
                                `).join('')}
                            </ul>
                        `;
                    } else {
                        fileDiv.innerHTML = "<p class='text-muted'>No files attached yet.</p>";
                    }
                } else {
                    fileDiv.innerHTML = "<p class='text-danger'>Could not load files.</p>";
                }
            })
            .catch(error => {
                console.error("File load error:", error);
                fileDiv.innerHTML = "<p class='text-danger'>Could not load files.</p>";
            });
    }
}
/**
 * Initialize comments functionality
 */
function initComments() {
    const form = document.querySelector(".comment-form form");
    const commentsDiv = document.getElementById("comments_div");
    const certificateId = <?= $certificate[0]['divorceCertId'] ?>;
    const certificateType = "divorce";
    
    if (!commentsDiv) return;
    
    // Load comments initially
    loadComments(certificateId, certificateType);
    
    if (form) {
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            
            fetch("/dashboard/ajax/save_comment", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    form.reset();
                    loadComments(certificateId, certificateType);
                } else {
                    alert("Failed to submit comment: " + (data.message || "Unknown error"));
                }
            })
            .catch(error => {
                console.error("Comment submission error:", error);
                alert("An error occurred while submitting the comment.");
            });
        });
    }
    
    function loadComments(certId, certType) {
        fetch(`/dashboard/ajax/get_comments/${certType}/${certId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success" && Array.isArray(data.comments) ){
                    if (data.comments.length > 0) {
                        commentsDiv.innerHTML = data.comments.map(comment => `
                            <div class="media mb-3 p-2 border rounded bg-light position-relative" data-comment-id="${comment.comment_id}">
                                <img src="/uploads/users/pictures/${comment.userPicture}" class="mr-3 rounded-circle border" alt="${comment.userFullName}" style="width:48px;height:48px;object-fit:cover;">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1 font-weight-bold">${comment.userFullName}</h6>
                                    <p class="mb-1">${comment.comment_text}</p>
                                    <small class="text-muted">${new Date(comment.created_at.replace(' ', 'T')).toLocaleString()}</small>
                                </div>
                                ${comment.user_id == <?= json_encode(session()->get('userData')['userId']) ?> ? `
                                    <button class="btn btn-sm btn-danger position-absolute" style="top:8px; right:8px;" onclick="deleteComment('${comment.comment_id}', '${comment.certificate_id}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                ` : ""}
                            </div>
                        `).join('');
                    } else {
                        commentsDiv.innerHTML = "<p class='text-muted'>No remarks yet.</p>";
                    }
                } else {
                    commentsDiv.innerHTML = "<p class='text-danger'>Could not load comments.</p>";
                }
            })
            .catch(error => {
                console.error("Comments load error:", error);
                commentsDiv.innerHTML = "<p class='text-danger'>Could not load comments.</p>";
            });
    }
}

/**
 * Delete a comment
 */
function deleteComment(commentId, certificateId) {
    if(allowDeleteDocument) {
        alert("You cannot delete this comment because the document is locked for editing.");
        return;
    }
    if (!confirm("Are you sure you want to delete this comment?")) return;
    
    fetch(`/dashboard/ajax/delete_comments/${encodeURIComponent(commentId)}`, {
        method: "GET"
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            // Reload comments
            const commentsDiv = document.getElementById("comments_div");
            if (commentsDiv) {
                initComments(); // Reinitialize comments
            }
        } else {
            alert("Failed to delete comment: " + (data.message || "Unknown error"));
        }
    })
    .catch(error => {
        console.error("Delete comment error:", error);
        alert("An error occurred while deleting the comment.");
    });
}

/**
 * Delete a file attached to the certificate
 */
// =========== FUNCTION TO DELETE CERTIFICATE FILE 
function deleteCertificateFile(fileId, certificateId) {
    if(allowDeleteDocument) {
        alert("You cannot delete this file because the document is locked for editing.");
        return;
    }
    if (!confirm("Are you sure you want to delete this file?")) return;

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
            alert('File deleted successfully!');
            // Use the global loadFiles function to refresh the file list
            if (typeof loadFiles === "function") {
                loadFiles();
            }
        } else {
            throw new Error(response.message || 'Failed to delete file');
        }
    })
    .catch(error => {
        console.error('Error deleting file:', error);
        alert('Error deleting file: ' + error.message);
    });
}


// Mark notification as viewed
    const certificate_Id = <?= $certificate[0]['divorceCertId'] ?>;

  const notificationUrl = `/dashboard/ajax/mark_notification_as_view/${certificate_Id}`;
  const notificationXhr = new XMLHttpRequest();
  notificationXhr.open('GET', notificationUrl, true);
  notificationXhr.send();
</script>

<?= $this->endSection() ?>
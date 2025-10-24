<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center">
                <div class="btn-group">
                    <a id="downloadBtn" class="btn btn-primary btn-sm btn-icon-split ">
                        <span class="icon text-white-50">
                            <i class="fas fa-download"></i>
                        </span>
                        <span class="text">Download </span>
                    </a>

                    <a href="/dashboard/divorce_cert/generate_certificate/<?= $certificate['divorceCertId'] ?>?frame=blank" class="btn btn-sm btn-dark btn-icon-split ">
                        <span class="icon text-white-50">
                            <i class="fas fa-pen"></i>
                        </span>
                        <span class="text">No Frame</span>
                    </a>

                    <a href="/dashboard/divorce_cert/generate_certificate/<?= $certificate['divorceCertId'] ?>" class="btn btn-secondary btn-sm btn-icon-split ">
                        <span class="icon text-white-50">
                            <i class="fas fa-eye"></i>
                        </span>
                        <span class="text">With Frame</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                  <canvas id="certificateCanvas" width="1418" height="1038" style="border:1px solid #ddd; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Certificate data from PHP
        const certificate = <?= json_encode($certificate, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
        const frameImage = '<?= isset($frame) ? addslashes($frame) : base_url("assets/img/divorce_certificate.png") ?>';
        
        // Create canvas and context
        const canvas = document.getElementById('certificateCanvas');
        if (!canvas || !canvas.getContext) {
            throw new Error('Canvas element not found or not supported');
        }
        const ctx = canvas.getContext('2d');
        
        // Load background image
        const backgroundImg = new Image();
        backgroundImg.crossOrigin = 'Anonymous';
        backgroundImg.src = frameImage;
        
        backgroundImg.onload = async function() {
            try {
                // Draw background
                ctx.drawImage(backgroundImg, 0, 0, canvas.width, canvas.height);
                
                // Set font styles
                ctx.fillStyle = '#000000';
                ctx.textBaseline = 'top';
                
                // Draw reference number
                ctx.font = 'bold 18px Times New Roman';
                if (certificate.divorceRefNo) {
                    ctx.fillText(String(certificate.divorceRefNo).toUpperCase(), 203, 250);
                }
                
                // Draw code
                if (certificate.divorceCode) {
                    ctx.fillText(String(certificate.divorceCode).toUpperCase(), 1155, 239);
                }
                
                // Draw revenue number
                if (certificate.divorceRevNo) {
                    ctx.fillText(String(certificate.divorceRevNo).toUpperCase(), 1182, 271);
                }
                
                // Draw plaintiff and defendant names
                ctx.font = 'bold 18px Times New Roman';
                if (certificate.divorceplaintiff) {
                    ctx.fillText(String(certificate.divorceplaintiff).toUpperCase(), 920, 389);
                }
                if (certificate.divorcedefendant) {
                    ctx.fillText(String(certificate.divorcedefendant).toUpperCase(), 944, 425);
                }
                
                // Helper function to format dates
                function formatDate(dateString) {
                    if (!dateString) return { day: '', month: '', year: '' };
                    try {
                        const date = new Date(dateString);
                        if (isNaN(date.getTime())) throw new Error('Invalid date');
                        return {
                            day: date.getDate().toString(),
                            month: date.toLocaleString('default', { month: 'long' }).toUpperCase(),
                            year: date.getFullYear().toString()
                        };
                    } catch (e) {
                        console.error('Error formatting date:', dateString, e);
                        return { day: '', month: '', year: '' };
                    }
                }
                
                // Draw marriage date
                const marriageDate = formatDate(certificate.divorcemarriageDate);
                ctx.fillText(marriageDate.day, 968, 505);
                ctx.fillText(marriageDate.month, 1064, 505);
                ctx.fillText(marriageDate.year, 1200, 505);
                
                // Draw divorce date
                const divorceDate = formatDate(certificate.divorcedateOfDivorce);
                ctx.fillText(divorceDate.day, 261, 745);
                ctx.fillText(divorceDate.month, 275, 745);
                ctx.fillText(divorceDate.year, 350, 745);
                
                // Draw issuance date
                const issuanceDate = formatDate(certificate.divorceissuanceDate);
                ctx.fillText(issuanceDate.day, 979, 780);
                ctx.fillText(issuanceDate.month, 1081, 780);
                ctx.fillText(issuanceDate.year, 1264, 780);
                
                // Generate QR code data (using certificate reference number)
               const qrCodeData = "<?= base_url('v') ?>" + '?cc=' + certificate.divorceRefNo + '&toc=d';

                
                // Generate QR code using a free API (QRServer.com)
                const qrCodeImg = new Image();
                qrCodeImg.crossOrigin = 'Anonymous';
                
                // Using QRServer API (free and doesn't require API key)
                // You can adjust size (200x200) and margin (0) as needed
                qrCodeImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(qrCodeData)}&margin=0`;
                
                // Position the QR code on top of defendant's photo (adjust coordinates as needed)
                const qrCodeX = 1190; // Same X as defendant photo
                const qrCodeY = 70; // Same Y as defendant photo
                
                qrCodeImg.onload = function() {
                    // Draw a white background for the QR code (optional)
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(qrCodeX, qrCodeY, 150, 150);
                    
                    // Draw the QR code
                    ctx.drawImage(qrCodeImg, qrCodeX, qrCodeY, 150, 150);
                    
                    // Continue with other image loading
                    loadSignaturesAndPhotos();
                };
                
                qrCodeImg.onerror = function() {
                    console.error('Error loading QR code image');
                    // Continue with other image loading even if QR code fails
                    loadSignaturesAndPhotos();
                };
                
                function loadSignaturesAndPhotos() {
                    // Load and draw signatures and photos
                    const signaturesToLoad = [
                        { img: '/uploads/users/signatures/'+certificate.divorceSIGN_A, x: 629, y: 755, width: 200, height: 80 },
                        { img: '/uploads/users/signatures/'+certificate.divorceSIGN_B, x: 221, y: 870, width: 200, height: 80 },
                        { img: '/uploads/users/signatures/'+certificate.divorceSIGN_C, x: 630, y: 870, width: 200, height: 80 },
                        { img: '/uploads/divorce/'+certificate.divorcedefendantPic, x: 350, y: 150, width: 150, height: 150 },
                        { img: '/uploads/divorce/'+certificate.divorceplaintiffPic, x: 891, y: 148, width: 150, height: 150 }
                    ].filter(item => item.img); // Only include items with images
                    
                    let loadedImages = 0;
                    const totalImagesToLoad = signaturesToLoad.length;
                    
                    if (totalImagesToLoad === 0) {
                        console.log('No images to load');
                        return;
                    }
                    
                    signaturesToLoad.forEach(item => {
                        const img = new Image();
                        img.crossOrigin = 'Anonymous';
                        img.onload = function() {
                            try {
                                ctx.drawImage(img, item.x, item.y, item.width, item.height);
                            } catch (e) {
                                console.error('Error drawing image:', e);
                            }
                            loadedImages++;
                            if (loadedImages === totalImagesToLoad) {
                                console.log('All images loaded successfully');
                            }
                        };
                        img.onerror = function() {
                            console.error('Error loading image:', item.img);
                            loadedImages++;
                        };
                        
                        try {
                            img.src = '<?= base_url() ?>' + encodeURI(item.img);
                        } catch (e) {
                            console.error('Error setting image source:', e);
                        }
                    });
                }
                
            } catch (e) {
                console.error('Error in drawing operations:', e);
                // Fallback: Show error on canvas
                ctx.fillStyle = 'red';
                ctx.font = '20px Arial';
                ctx.fillText('Error generating certificate: ' + e.message, 50, 50);
            }
        };
        
        backgroundImg.onerror = function() {
            console.error('Error loading background image:', frameImage);
            // Draw a blank background if image fails to load
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#000000';
            ctx.font = '20px Arial';
            ctx.fillText('CERTIFICATE BACKGROUND IMAGE MISSING', 100, 100);
        };
        
    } catch (error) {
        console.error('Error in certificate generation:', error);
        // If canvas is available, show error
        if (canvas && canvas.getContext) {
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = 'red';
            ctx.font = '20px Arial';
            ctx.fillText('Fatal Error: ' + error.message, 50, 50);
        }
    }
});
</script>

<script>
document.getElementById('downloadBtn').addEventListener('click', function () {
    const canvas = document.getElementById('certificateCanvas');
    const link = document.createElement('a');
    link.download = 'divorce_certificate.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
});
</script>

<?=$this->endSection()?>
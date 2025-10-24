<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-end align-items-center">
                   
                    <div class="btn-group">
                        <a href="javascript:void(0);" id="downloadBtn" class="btn btn-sm btn-primary btn-icon-split ">
                            <span class="icon text-white-50">
                                <i class="fas fa-download"></i>
                            </span>
                            <span class="text">Download</span>
                        </a>
                        <a href="/dashboard/wedcert/print/<?= $certificate['marriage_cert_id'] ?>?frame=blank" class="btn btn-sm btn-dark btn-icon-split ">
                            <span class="icon text-white-50">
                                <i class="fas fa-pen"></i>
                            </span>
                            <span class="text">No Frame</span>
                        </a>
                        <a href="/dashboard/wedcert/print/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-secondary btn-sm btn-icon-split ">
                            <span class="icon text-white-50">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="text">With Frame</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="certificate-wrapper" style="overflow-x: auto; background-color: #f8f9fa; padding: 20px;">
                        <canvas id="certificateCanvas" width="1419" height="1047" style="max-width: 100%; border: 1px solid #ddd;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Certificate data from PHP
    const certificateData = <?= json_encode($certificate) ?>;
    console.log('Certificate Data:', certificateData);
    const templateImageUrl = '<?= $frame ?>';
    
    // Generate QR code URL using API
    const baseUrl = window.location.origin;
    const qrCodeData = encodeURIComponent(baseUrl + '/v?cc=' + certificateData.reference_no + '&toc=w');
    const qrCodeApiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${qrCodeData}`;
    
    // Canvas setup
    const canvas = document.getElementById('certificateCanvas');
    const ctx = canvas.getContext('2d');
    
    // Create all image objects
    const templateImage = new Image();
    templateImage.crossOrigin = 'Anonymous';
    
    const brideImage = new Image();
    brideImage.crossOrigin = 'Anonymous';
    
    const groomImage = new Image();
    groomImage.crossOrigin = 'Anonymous';
    
    const signAImg = new Image();
    signAImg.crossOrigin = 'Anonymous';
    
    const signBImg = new Image();
    signBImg.crossOrigin = 'Anonymous';
    
    const signCImg = new Image();
    signCImg.crossOrigin = 'Anonymous';
    
    const qrCodeImage = new Image();
    qrCodeImage.crossOrigin = 'Anonymous';
    
    // Set image sources
    templateImage.src = templateImageUrl;
    brideImage.src = '/uploads/marriage/' + certificateData.bride_passport_photo;
    groomImage.src = '/uploads/marriage/' + certificateData.groom_passport_photo;
    signAImg.src = '/uploads/users/signatures/' + certificateData.SIGNA;
    signBImg.src = '/uploads/users/signatures/' + certificateData.SIGNB;
    signCImg.src = '/uploads/users/signatures/' + certificateData.SIGNC;
    qrCodeImage.src = qrCodeApiUrl;
    
    // Track loaded images
    let imagesLoaded = 0;
    const totalImages = 7; // template + bride + groom + 3 signatures + qr code
    
    function imageLoaded() {
        imagesLoaded++;
        if (imagesLoaded === totalImages) {
            drawCertificate();
        }
    }
    
    // Add event listeners for all images
    templateImage.onload = imageLoaded;
    brideImage.onload = imageLoaded;
    groomImage.onload = imageLoaded;
    signAImg.onload = imageLoaded;
    signBImg.onload = imageLoaded;
    signCImg.onload = imageLoaded;
    qrCodeImage.onload = imageLoaded;
    
    // Error handling for images
    function imageError(error) {
        console.error('Error loading image:', error.target.src);
        imageLoaded();
    }
    
    templateImage.onerror = imageError;
    brideImage.onerror = imageError;
    groomImage.onerror = imageError;
    signAImg.onerror = imageError;
    signBImg.onerror = imageError;
    signCImg.onerror = imageError;
    qrCodeImage.onerror = imageError;
    
    function drawCertificate() {
        try {
            // Set canvas dimensions to match the template image
            canvas.width = templateImage.width;
            canvas.height = templateImage.height;
            
            // Draw the template image
            ctx.drawImage(templateImage, 0, 0);
            
            // Draw photos if they loaded successfully
            if (brideImage.complete && brideImage.naturalWidth !== 0) {
                ctx.drawImage(brideImage, 358, 152, 150, 150);
            } else {
                console.error('Bride image failed to load');
            }
            
            if (groomImage.complete && groomImage.naturalWidth !== 0) {
                ctx.drawImage(groomImage, 906, 155, 150, 150);
            } else {
                console.error('Groom image failed to load');
            }
            
            // Draw QR code above groom's picture
            if (qrCodeImage.complete && qrCodeImage.naturalWidth !== 0) {
                ctx.drawImage(qrCodeImage, 1200, 100, 125, 125);
            } else {
                console.error('QR code failed to load');
            }
            
            // Draw signatures if they loaded successfully
            if (signAImg.complete && signAImg.naturalWidth !== 0) {
                ctx.drawImage(signAImg, 971, 760, 200, 100);
            } else {
                console.error('Signature A failed to load');
            }
            
            if (signBImg.complete && signBImg.naturalWidth !== 0) {
                ctx.drawImage(signBImg, 300, 850, 250, 100);
            } else {
                console.error('Signature B failed to load');
            }
            
            if (signCImg.complete && signCImg.naturalWidth !== 0) {
                ctx.drawImage(signCImg, 900, 850, 250, 100);
            } else {
                console.error('Signature C failed to load');
            }
            
            // Set text styles
            ctx.fillStyle = '#4E73DF';
            ctx.font = '21px "Times New Roman", serif';
            ctx.textAlign = 'left';
            
            // Define text positions
            const textPositions = {
                groom_name: { x: 1016, y: 412 },
                groom_day_month: { x: 244, y: 449 },
                groom_year: { x: 490, y: 449 },
                groom_birth_city: { x: 848, y: 450 },
                groom_birth_county: { x: 1156, y: 449 },
                groom_father_name: { x: 445, y: 487 },
                groom_mother_name: { x: 941, y: 487 },
                bride_name: { x: 190, y: 522 },
                bride_day_month: { x: 581, y: 523 },
                bride_year: { x: 790, y: 523 },
                bride_birth_city: { x: 1160, y: 523 },
                bride_birth_county: { x: 271, y: 559 },
                bride_father_name: { x: 783, y: 563 },
                bride_mother_name: { x: 188, y: 597 },
                marriage_day: { x: 1248, y: 599 },
                marriage_month: { x: 225, y: 639 },
                marriage_year: { x: 444, y: 637 },
                place_of_marriage: { x: 982, y: 634 },
                marriage_code: { x: 1153, y: 262 },
                groom_name_again: { x: 188, y: 749 },
                bride_proposed_name: { x: 513, y: 750 },
                declaration_day: { x: 881, y: 791 },
                declaration_month: { x: 1021, y: 794 },
                declaration_year: { x: 1251, y: 790 },
                reference_no: { x: 178, y: 271 },
                revenue_no: { x: 1179, y: 293 },
            };
            
            // Process and draw dates
            const groomDob = parseAndSplitDate(certificateData.groom_dob);
            drawTextWithValidation(ctx, groomDob.dayMonth, textPositions.groom_day_month, 'Groom Day+Month');
            drawTextWithValidation(ctx, groomDob.year, textPositions.groom_year, 'Groom Year');
            
            const brideDob = parseAndSplitDate(certificateData.bride_dob);
            drawTextWithValidation(ctx, brideDob.dayMonth, textPositions.bride_day_month, 'Bride Day+Month');
            drawTextWithValidation(ctx, brideDob.year, textPositions.bride_year, 'Bride Year');
            
            // Draw other text fields
            drawTextWithValidation(ctx, certificateData.groom_name, textPositions.groom_name, 'Groom Name');
            drawTextWithValidation(ctx, certificateData.groom_birth_city, textPositions.groom_birth_city, 'Groom Birth City');
            drawTextWithValidation(ctx, certificateData.groom_birth_county, textPositions.groom_birth_county, 'Groom Birth County');
            drawTextWithValidation(ctx, certificateData.groom_father_name, textPositions.groom_father_name, 'Groom Father Name');
            drawTextWithValidation(ctx, certificateData.groom_mother_name, textPositions.groom_mother_name, 'Groom Mother Name');
            
            drawTextWithValidation(ctx, certificateData.bride_name, textPositions.bride_name, 'Bride Name');
            drawTextWithValidation(ctx, certificateData.bride_birth_city, textPositions.bride_birth_city, 'Bride Birth City');
            drawTextWithValidation(ctx, certificateData.bride_birth_county, textPositions.bride_birth_county, 'Bride Birth County');
            drawTextWithValidation(ctx, certificateData.bride_father_name, textPositions.bride_father_name, 'Bride Father Name');
            drawTextWithValidation(ctx, certificateData.bride_mother_name, textPositions.bride_mother_name, 'Bride Mother Name');
            
            drawTextWithValidation(ctx, getDay(certificateData.date_of_marriage), textPositions.marriage_day, 'Marriage Day');
            drawTextWithValidation(ctx, getMonth(certificateData.date_of_marriage), textPositions.marriage_month, 'Marriage Month');
            drawTextWithValidation(ctx, getYear(certificateData.date_of_marriage), textPositions.marriage_year, 'Marriage Year');
            drawTextWithValidation(ctx, certificateData.place_of_marriage, textPositions.place_of_marriage, 'Place of Marriage');
            
            drawTextWithValidation(ctx, certificateData.groom_name, textPositions.groom_name_again, 'Groom Name (again)');
            drawTextWithValidation(ctx, certificateData.bride_proposed_name || certificateData.bride_name, textPositions.bride_proposed_name, 'Bride Proposed Name');
            
            drawTextWithValidation(ctx, getDay(certificateData.declaration_date), textPositions.declaration_day, 'Declaration Day');
            drawTextWithValidation(ctx, getMonth(certificateData.declaration_date), textPositions.declaration_month, 'Declaration Month');
            drawTextWithValidation(ctx, getYear(certificateData.declaration_date), textPositions.declaration_year, 'Declaration Year');

            drawTextWithValidation(ctx, certificateData.revenue_no, textPositions.revenue_no, 'Revenue No');
            drawTextWithValidation(ctx, certificateData.reference_no, textPositions.reference_no, 'Reference No');
            drawTextWithValidation(ctx, certificateData.marriage_code, textPositions.marriage_code, 'Marriage Code');
            
        } catch (error) {
            console.error('Error drawing certificate:', error);
        }
    }
    
    // Helper functions
    function parseAndSplitDate(dateString) {
        try {
            if (!dateString || dateString === '0000-00-00') {
                return { dayMonth: '', year: '' };
            }
            
            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                console.warn('Invalid date string:', dateString);
                return { dayMonth: '', year: '' };
            }
            
            const day = date.getDate();
            const month = date.toLocaleDateString('en-US', { month: 'long' });
            const dayMonth = `${day} ${month}`.toUpperCase();
            const year = date.getFullYear().toString();
            
            return { dayMonth, year };
        } catch (error) {
            console.error('Error parsing date:', error);
            return { dayMonth: '', year: '' };
        }
    }
    
    function drawTextWithValidation(context, text, position, fieldName) {
        try {
            if (!text) {
                console.warn(`Missing text for field: ${fieldName}`);
                return;
            }
            
            if (fieldName.includes('Date') || fieldName.includes('DOB')) {
                if (text === 'Invalid Date') {
                    console.warn(`Invalid date format for field: ${fieldName}`);
                    return;
                }
            }
            
            const uppercaseText = String(text).toUpperCase();
            context.fillText(uppercaseText, position.x, position.y);
        } catch (error) {
            console.error(`Error drawing text for ${fieldName}:`, error);
        }
    }
    
    function getDay(dateString) {
        try {
            if (!dateString || dateString === '0000-00-00') return '';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                console.warn('Invalid date string:', dateString);
                return '';
            }
            return date.getDate().toString();
        } catch (error) {
            console.error('Error getting day from date:', error);
            return '';
        }
    }
    
    function getMonth(dateString) {
        try {
            if (!dateString || dateString === '0000-00-00') return '';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                console.warn('Invalid date string:', dateString);
                return '';
            }
            return date.toLocaleDateString('en-US', { month: 'long' }).toUpperCase();
        } catch (error) {
            console.error('Error getting month from date:', error);
            return '';
        }
    }
    
    function getYear(dateString) {
        try {
            if (!dateString || dateString === '0000-00-00') return '';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) {
                console.warn('Invalid date string:', dateString);
                return '';
            }
            return date.getFullYear().toString();
        } catch (error) {
            console.error('Error getting year from date:', error);
            return '';
        }
    }
    
    // Download button functionality
    document.getElementById('downloadBtn').addEventListener('click', function() {
        try {
            const link = document.createElement('a');
            link.download = 'marriage-certificate-' + (certificateData.reference_no || 'unknown') + '.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        } catch (error) {
            console.error('Error downloading certificate:', error);
            alert('Error generating download. Please check console for details.');
        }
    });
});
</script>
<?=$this->endSection()?>
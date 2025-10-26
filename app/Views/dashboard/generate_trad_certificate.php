<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-body p-4">

                    <h4 class="mb-4 text-center">Traditional Healer/Herbalist Clearance Certificate</h4>

                    <!-- Responsive wrapper -->
                    <div id="canvasWrapper" class="position-relative mx-auto border rounded overflow-hidden" style="max-width:100%;">
                        <canvas id="certificateCanvas"></canvas>
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button id="downloadBtn" class="btn btn-success">
                            Download Certificate (PNG)
                        </button>
                        <button id="resetZoomBtn" class="btn btn-outline-secondary">
                            Reset Zoom
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('certificateCanvas');
    const ctx = canvas.getContext('2d');

    const CERT_WIDTH = 2343;
    const CERT_HEIGHT = 1646;

    // Resize canvas to fit container while keeping ratio
    function resizeCanvas() {
        const container = canvas.parentElement;
        const scale = container.clientWidth / CERT_WIDTH;

        canvas.style.width = container.clientWidth + 'px';
        canvas.style.height = CERT_HEIGHT * scale + 'px';
    }

    window.addEventListener('resize', resizeCanvas);

    // Load background
    const bgImg = new Image();
    bgImg.src = '<?= base_url('/uploads/marriage/template/trad_cert_frame.png') ?>';

    bgImg.onload = function () {
        drawCertificate();
        resizeCanvas();
    };

    function drawCertificate() {
        canvas.width = CERT_WIDTH;
        canvas.height = CERT_HEIGHT;

        ctx.drawImage(bgImg, 0, 0, CERT_WIDTH, CERT_HEIGHT);

        const data = <?= json_encode($certificate) ?>;

        const sn = data.tradCertSn || '';
        const revenueNo = data.tradRevenueNo || '';
        const name = data.tradCertHolderName || '';
        const town = data.tradCertHolderTownorCity || '';
        const district = data.tradCertHolderDistrict || '';
        const county = data.tradCertHoldercounty || '';
        const operation = data.tradCertHolderOperationType || '';
        const issued = data.tradCertDateIssued || '';
        const duration = parseInt(data.tradCertDuration || 0);
        const expires = new Date(issued);
        expires.setDate(expires.getDate() + duration);
        const expiryDate = expires.toISOString().split('T')[0];

        // === Text Fields ===
        drawText(sn, 1799, 530, 28, 'bold');
        drawText(revenueNo, 1880, 630, 28, 'bold');
        drawText(name, 690, 830, 32, 'bold');
        drawText(town, 350, 900, 35, 'bold');
        drawText(district, 1400, 900, 35, 'bold');
        drawText(county, 350, 970, 35, 'bold');
        drawText(operation, 350, 1050, 35, 'bold');
        drawText(formatDate(issued), 380, 1140, 30, 'bold');
        drawText(formatDate(expiryDate), 380, 1230, 30, 'bold');

        // === Holder's Photo ===
        const holderImage = new Image();
        holderImage.crossOrigin = "Anonymous";
        const imagePath = '<?= base_url('/uploads/certificate_holders/') ?>' + data.tradCertHolderPic;
        holderImage.src = imagePath;

        holderImage.onload = function () {
            const imgX = 300, imgY = 440, imgWidth = 275, imgHeight = 275;

            ctx.fillStyle = '#fff';
            ctx.fillRect(imgX - 5, imgY - 5, imgWidth + 10, imgHeight + 10);
            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.strokeRect(imgX - 5, imgY - 5, imgWidth + 10, imgHeight + 10);
            ctx.drawImage(holderImage, imgX, imgY, imgWidth, imgHeight);

            drawSignatures();   // <-- draw signatures after photo
        };

        holderImage.onerror = function () {
            console.error('Failed to load holder image:', imagePath);
            drawSignatures();
        };

        // -------------------------------------------------
        // === SIGNATURES ==================================
        // -------------------------------------------------
        function drawSignatures() {
            const basePath = '<?= base_url('/uploads/users/signatures/') ?>';
            const sigKeys = ['tradCertSignatoryA', 'tradCertSignatoryB', 'tradCertSignatoryC'];
            const positions = [
                { x: 1580, y: 1105, w: 300, h: 120 },   // A
                { x: 400, y: 1250, w: 300, h: 120 },   // B
                { x: 1560, y: 1290, w: 300, h: 120 }   // C
            ];

            let loaded = 0;
            const total = sigKeys.length;

            sigKeys.forEach((key, idx) => {
                const file = data[key] || '';
                if (!file.trim()) {
                    if (++loaded === total) drawQRCode();
                    return; // skip empty
                }

                const sigImg = new Image();
                sigImg.crossOrigin = "Anonymous";
                sigImg.src = basePath + file;

                sigImg.onload = function () {
                    const { x, y, w, h } = positions[idx];
                    ctx.drawImage(sigImg, x, y, w, h);
                    if (++loaded === total) drawQRCode();
                };

                sigImg.onerror = function () {
                    console.warn(`Signature ${key} failed to load:`, sigImg.src);
                    if (++loaded === total) drawQRCode();
                };
            });

            // If no signatures at all, go straight to QR
            if (total === 0) drawQRCode();
        }

        // === QR CODE ===
        function drawQRCode() {
            const qrData = `https://yourdomain.com/verify?sn=${sn}`;
            const qrSize = 220;
            const qrImg = new Image();
            qrImg.crossOrigin = "Anonymous";
            qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=${qrSize}x${qrSize}&data=${encodeURIComponent(qrData)}`;

            qrImg.onload = function () {
                const qrX = (CERT_WIDTH - qrSize) / 2;
                const qrY = CERT_HEIGHT - 449;
                ctx.drawImage(qrImg, qrX, qrY, qrSize, qrSize);
            };
        }
    }

    // Helpers
    function drawText(text, x, y, size, weight = 'normal') {
        ctx.font = `${weight} ${size}px "Courier New", monospace`;
        ctx.fillStyle = '#000';
        ctx.textAlign = 'left';
        ctx.textBaseline = 'middle';
        ctx.fillText(text, x, y);
    }

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
    }

    // Download
    document.getElementById('downloadBtn').addEventListener('click', function () {
        const link = document.createElement('a');
        link.download = `Clearance_Certificate_${Date.now()}.png`;
        link.href = canvas.toDataURL('image/png');
        link.click();
    });

    // Reset zoom (optional)
    document.getElementById('resetZoomBtn').addEventListener('click', resizeCanvas);
});
</script>


<style>
#certificateCanvas {
    display: block;
    max-width: 100%;
    height: auto;
    border: 1px solid #ddd;
    border-radius: 8px;
    image-rendering: crisp-edges;
}

</style>

<?= $this->endSection() ?>
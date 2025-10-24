<?php $this->extend('public/partials/layout')?>

<?=$this->section('main')?>


<!-- Hero Section -->
<section class="hero">
    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="hero-title animate__animated animate__fadeInDown">
                    Decentralized Digital Certificate Management System
                </h2>
                <p class="hero-subtitle animate__animated animate__fadeIn animate__delay-1s">
                    A secure and transparent digital platform that simplifies the issuance, management, and verification of Marriage, Divorce, Bachelor, and Spinster certificates across Liberia.
                </p>
                <div class="d-flex gap-3 animate__animated animate__fadeIn animate__delay-3s">
                    <a href="/v" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-search me-2"></i> Verify Certificate
                    </a>
                    <button id="heroChatBtn" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-robot me-2"></i> Ask Assistant
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Certificates Section -->
<section id="certificates" class="py-5 bg-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-aos="fade-up">Certificate Services</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Select the certificate type to learn about requirements and procedures</p>
        </div>

        <div class="owl-carousel certificates-slider">
            <!-- Marriage Certificate -->
            <div class="certificate-card">
                <span class="certificate-badge">Marriage</span>
                
                <i class="fas fa-ring certificate-icon"></i>
                
                <h3 class="certificate-name">Marriage Certificate</h3>
                
                <div class="certificate-description">
                    <p>Official documentation of legally recognized marriages in Liberia</p>
                </div>
                
                <div class="certificate-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Processing: 14 working days</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Fee: $25 USD</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Requires both parties</span>
                    </div>
                </div>
                
                <div class="certificate-action">
                    <a href="/instrunction/marriage_cert_info" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane me-1"></i> Find Out More
                    </a>
                </div>
            </div>
            
            <!-- Divorce Certificate -->
            <div class="certificate-card">
                <span class="certificate-badge">Divorce</span>
                
                <i class="fas fa-user-times certificate-icon"></i>
                
                <h3 class="certificate-name">Divorce Certificate</h3>
                
                <div class="certificate-description">
                    <p>Legal proof of marriage dissolution under Liberian law</p>
                </div>
                
                <div class="certificate-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Processing: 21 days after court approval</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Fee: $30 USD</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-gavel"></i>
                        <span>Court decree required</span>
                    </div>
                </div>
                
                <div class="certificate-action">
                    <a href="/instrunction/divorce_cert_info" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane me-1"></i> Find Out More
                    </a>
                </div>
            </div>
            
            <!-- Bachelor Certificate -->
            <div class="certificate-card">
                <span class="certificate-badge">Bachelor</span>
                
                <i class="fas fa-male certificate-icon"></i>
                
                <h3 class="certificate-name">Bachelor Certificate</h3>
                
                <div class="certificate-description">
                    <p>Legal declaration of unmarried status for male applicants</p>
                </div>
                
                <div class="certificate-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Processing: 7 working days</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Fee: $15 USD</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-user-check"></i>
                        <span>Affidavit required</span>
                    </div>
                </div>
                
                <div class="certificate-action">
                    <a href="/instrunction/not_available_info" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane me-1"></i> Find Out More
                    </a>
                </div>
            </div>
            
            <!-- Spinster Certificate -->
            <div class="certificate-card">
                <span class="certificate-badge">Spinster</span>
                
                <i class="fas fa-female certificate-icon"></i>
                
                <h3 class="certificate-name">Spinster Certificate</h3>
                
                <div class="certificate-description">
                    <p>Legal declaration of unmarried status for female applicants</p>
                </div>
                
                <div class="certificate-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Processing: 7 working days</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Fee: $15 USD</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-user-check"></i>
                        <span>Affidavit required</span>
                    </div>
                </div>
                
                <div class="certificate-action">
                    <a href="/instrunction/not_available_info" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane me-1"></i> Find Out More
                    </a>
                </div>
            </div>
            
            <!-- Traditional Healer/Herbalist Certificate -->
            <div class="certificate-card">
                <span class="certificate-badge">Traditional</span>
                
                <i class="fas fa-leaf certificate-icon"></i>
                
                <h3 class="certificate-name">Traditional Healer/Herbalist Certificate</h3>
                
                <div class="certificate-description">
                    <p>Official recognition for traditional medicine practitioners in Liberia</p>
                </div>
                
                <div class="certificate-details">
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <span>Processing: 30 working days</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Fee: $50 USD</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-certificate"></i>
                        <span>Professional assessment required</span>
                    </div>
                </div>
                
                <div class="certificate-action">
                    <a href="/instrunction/traditional_cert_info" class="btn btn-primary btn-sm">
                        <i class="fas fa-paper-plane me-1"></i> Find Out More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Process Section -->
    <section id="process" class="py-5">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-up">Standard Process</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Steps to obtain your certificate</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <!-- Step 1 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-step h-100">
                        <div class="step-number">1</div>
                        <div class="step-content text-center">
                            <h4 class="step-title">Document Preparation</h4>
                            <p class="step-desc">Gather all required documents based on certificate type</p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-step h-100">
                        <div class="step-number">2</div>
                        <div class="step-content text-center">
                            <h4 class="step-title">Submit Application</h4>
                            <p class="step-desc">Submit application in person or online to any nearby offices</p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="process-step h-100">
                        <div class="step-number">3</div>
                        <div class="step-content text-center">
                            <h4 class="step-title">Verification</h4>
                            <p class="step-desc">Ministry officials verify submitted information</p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 4 -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="process-step h-100">
                        <div class="step-number">4</div>
                        <div class="step-content text-center">
                            <h4 class="step-title">Certificate Issuance</h4>
                            <p class="step-desc">Collect your official certificate upon approval</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light shadow-sm">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-up">Frequently Asked Questions</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Quick answers to common questions</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="fas fa-map-marker-alt me-2"></i> Where can I apply for these certificates?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    All applications must be made in person at the Ministry of Internal Affairs headquarters in Monrovia or at designated county offices. Our assistant can provide specific location details based on your county.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="fas fa-dollar-sign me-2"></i> What are the fees for each certificate?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Fees vary by certificate type. Marriage certificates cost $25, divorce certificates $30, and bachelor/spinster certificates $15. All fees are in USD and subject to change. Ask our assistant for the latest fee schedule.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="400">
                            <h3 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="fas fa-clock me-2"></i> How long does processing take?
                                </button>
                            </h3>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Processing times vary: Marriage certificates (14 working days), Divorce certificates (21 days after court approval), Bachelor/Spinster certificates (7 working days). Expedited service may be available for additional fees.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="500">
                            <h3 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <i class="fas fa-user-check me-2"></i> Can someone else collect my certificate?
                                </button>
                            </h3>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, with proper authorization. The authorized person must present a notarized letter of authorization along with their valid ID and your application receipt. Marriage certificates typically require both parties or legal authorization.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-5" data-aos="fade-up">
                        <button class="btn btn-primary btn-lg px-4" id="faqChatBtn">
                            <i class="fas fa-robot me-2"></i> Ask More Questions
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>




<!-- Carousel HTML Section -->
<section class="service-centers-carousel bg-white">
    <div class="container">
        <div class="carousel-header">
            <h2 class="carousel-title">County Service Centers</h2>
            <p class="carousel-subtitle">Find your nearest Ministry of Internal Affairs service center across Liberia. There are <?=count($allBranches)?> County Service centers all spread out in Liberia.</p>
        </div>

        <div class="owl-carousel service-centers-slider">
            <?php foreach ($allBranches as $branch): ?>
            <div class="service-center-card">
                <span class="county-badge"><?= esc($branch['branchCounty']) ?></span>
                
                <i class="fas fa-building center-icon"></i>
                
                <h3 class="center-name"><?= esc($branch['branchName']) ?></h3>
                
                <div class="center-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?= esc($branch['branchCityOrTown']) ?></span>
                </div>
                
                <div class="center-details">
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <span><?= esc($branch['branchContact']) ?></span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-envelope"></i>
                        <span><?= esc($branch['branchEmail']) ?></span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Active Service Center</span>
                    </div>
                </div>
                
                <div class="center-code">
                    Code: <?= esc($branch['branchCode']) ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>





<!-- Contact Section -->
<section id="contact" class="py-5" style="background: linear-gradient(135deg, rgba(0, 35, 102, 0.03) 0%, rgba(191, 10, 48, 0.03) 100%);">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title" data-aos="fade-up">Contact Information</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Reach out for official inquiries and support
            </p>
        </div>

        <div class="row align-items-stretch">
            <!-- Contact Information Cards (7 cols) -->
            <div class="col-lg-7 mb-4 mb-lg-0" data-aos="zoom-in-right">
                <div class="row g-4 h-100">
                    <!-- Main Office Card -->
                    <div class="col-md-6">
                        <div class="contact-info-card h-100">
                            <div class="contact-card-header">
                                <i class="fas fa-building me-2"></i>
                                <h5 class="m-0">Headquarters</h5>
                            </div>
                            <div class="contact-card-body">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <strong>Address</strong>
                                        <p>Capitol Hill, Monrovia, Liberia</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <div>
                                        <strong>Phone</strong>
                                        <p>+231 123 456 789</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <strong>Email</strong>
                                        <p>info@mia.gov.lr</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-globe"></i>
                                    <div>
                                        <strong>Website</strong>
                                        <p>www.mia.gov.lr</p>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-card-footer">
                                <button class="btn btn-outline-primary btn-sm w-100" id="headquartersChatBtn">
                                    <i class="fas fa-robot me-1"></i> Ask About Headquarters
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Office Hours Card -->
                    <div class="col-md-6">
                        <div class="contact-info-card h-100">
                            <div class="contact-card-header">
                                <i class="fas fa-clock me-2"></i>
                                <h5 class="m-0">Office Hours</h5>
                            </div>
                            <div class="contact-card-body">
                                <div class="hours-item">
                                    <div class="day">Monday - Friday</div>
                                    <div class="time">8:00 AM – 5:00 PM</div>
                                </div>
                                <div class="hours-item">
                                    <div class="day">Saturday</div>
                                    <div class="time">9:00 AM – 1:00 PM</div>
                                </div>
                                <div class="hours-item closed">
                                    <div class="day">Sunday & Holidays</div>
                                    <div class="time">Closed</div>
                                </div>
                                <div class="emergency-notice mt-3">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <small>For emergencies, contact our 24/7 support line</small>
                                </div>
                            </div>
                            <div class="contact-card-footer">
                                <button class="btn btn-outline-primary btn-sm w-100" id="hoursChatBtn">
                                    <i class="fas fa-robot me-1"></i> Ask About Hours..
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- County Offices Card -->
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-card-header">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                <h5 class="m-0">County Service Centers</h5>
                            </div>
                            <div class="contact-card-body">
                                <div class="county-stats">
                                    <div class="stat-item">
                                        <div class="stat-number"><?=count($allBranches)?></div>
                                        <div class="stat-label">Service Centers</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">15</div>
                                        <div class="stat-label">Counties</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">24/7</div>
                                        <div class="stat-label">Online Support</div>
                                    </div>
                                </div>
                                <p class="text-center mb-0">Find your nearest Ministry of Internal Affairs service center across Liberia</p>
                            </div>
                            <div class="contact-card-footer">
                                <button class="btn btn-primary btn-sm w-100" onclick="scrollToCarousel()">
                                    <i class="fas fa-arrow-down me-1"></i> View All Centers
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Maps Column (5 cols) -->
            <div class="col-lg-5" data-aos="zoom-in-left" data-aos-delay="200">
                <div class="map-card h-100">
                    <div class="map-header">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        <strong>Head Office Location</strong>
                    </div>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7293072960133!2d-10.798273006837647!3d6.299256962245319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xf09f8011ea16693%3A0x4d13e6d6b6151b3a!2sMinistry%20of%20Internal%20Affairs!5e0!3m2!1sen!2s!4v1760727067864!5m2!1sen!2s" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="map-footer">
                        <button class="btn btn-gradient btn-sm" onclick="openGoogleMaps()">
                            <i class="fas fa-directions me-1"></i> Open in Maps
                        </button>
                        <button class="btn btn-outline-primary btn-sm" id="locationChatBtn">
                            <i class="fas fa-robot me-1"></i> Ask Assistant
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Contact Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="quick-actions-card">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="action-item text-center">
                                <div class="action-icon">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <h6>Call Us</h6>
                                <p>+231 123 456 789</p>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-phone me-1"></i> Call Now
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="action-item text-center">
                                <div class="action-icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <h6>Email Us</h6>
                                <p>info@mia.gov.lr</p>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-envelope me-1"></i> Send Email
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="action-item text-center">
                                <div class="action-icon">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <h6>AI Assistant</h6>
                                <p>24/7 Support</p>
                                <button class="btn btn-primary btn-sm pulse-btn" id="contactChatBtn">
                                    <i class="fas fa-headset me-1"></i> Start Chat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Contact Section Styles */
    .contact-info-card {
        background: var(--liberia-white);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 35, 102, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .contact-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        border-color: var(--liberia-blue);
    }

    .contact-card-header {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, #001a4d 100%);
        color: white;
        padding: 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .contact-card-header h5 {
        margin: 0;
        font-weight: 600;
    }

    .contact-card-body {
        padding: 25px;
        flex-grow: 1;
    }

    .contact-card-footer {
        padding: 20px;
        background: rgba(0, 35, 102, 0.02);
        border-top: 1px solid rgba(0, 35, 102, 0.1);
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-item i {
        color: var(--liberia-blue);
        font-size: 1.1rem;
        margin-top: 2px;
        flex-shrink: 0;
        width: 20px;
    }

    .contact-item strong {
        color: var(--liberia-blue);
        display: block;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    .contact-item p {
        margin: 0;
        color: #333;
        font-weight: 500;
    }

    .hours-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .hours-item:last-child {
        border-bottom: none;
    }

    .hours-item.closed .day,
    .hours-item.closed .time {
        color: #dc3545;
        font-weight: 600;
    }

    .day {
        color: var(--liberia-blue);
        font-weight: 600;
    }

    .time {
        color: #333;
        font-weight: 500;
    }

    .emergency-notice {
        background: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
        border-radius: 8px;
        padding: 10px 15px;
        display: flex;
        align-items: center;
    }

    .emergency-notice i {
        color: #dc3545;
    }

    .emergency-notice small {
        color: #dc3545;
        font-weight: 500;
    }

    .county-stats {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
        text-align: center;
    }

    .stat-item {
        flex: 1;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--liberia-blue);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #666;
        margin-top: 5px;
        font-weight: 500;
    }

    /* Map Card Styles */
    .map-card {
        border-radius: 15px;
        overflow: hidden;
        background: var(--liberia-white);
        border: 1px solid rgba(0, 35, 102, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .map-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0, 35, 102, 0.15);
    }

    .map-header {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, #001a4d 100%);
        color: white;
        padding: 20px;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .map-container {
        flex-grow: 1;
        min-height: 300px;
    }

    .map-footer {
        padding: 20px;
        display: flex;
        gap: 10px;
        justify-content: space-between;
        background: rgba(0, 35, 102, 0.02);
        border-top: 1px solid rgba(0, 35, 102, 0.1);
    }

    /* Quick Actions */
    .quick-actions-card {
        background: var(--liberia-white);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 35, 102, 0.1);
    }

    .action-item {
        padding: 20px;
        border-radius: 12px;
        background: rgba(0, 35, 102, 0.03);
        transition: all 0.3s ease;
        height: 100%;
    }

    .action-item:hover {
        background: rgba(0, 35, 102, 0.08);
        transform: translateY(-3px);
    }

    .action-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: white;
        font-size: 1.5rem;
    }

    .action-item h6 {
        color: var(--liberia-blue);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .action-item p {
        color: #666;
        margin-bottom: 15px;
        font-weight: 500;
    }

    /* Buttons */
    .btn-gradient {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%);
        color: white;
        border: none;
        font-weight: 600;
    }

    .btn-gradient:hover {
        background: linear-gradient(135deg, var(--liberia-red) 0%, var(--liberia-blue) 100%);
        color: white;
        transform: translateY(-2px);
    }

    .btn-outline-primary {
        color: var(--liberia-blue);
        border-color: var(--liberia-blue);
        font-weight: 600;
    }

    .btn-outline-primary:hover {
        background: var(--liberia-blue);
        border-color: var(--liberia-blue);
        color: white;
    }

    .pulse-btn {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(0, 35, 102, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(0, 35, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 35, 102, 0); }
    }

    /* Responsive Design */
    @media (max-width: 991px) {
        .col-lg-7, .col-lg-5 {
            width: 100%;
        }
        
        .map-card {
            margin-top: 20px;
        }
        
        .county-stats {
            justify-content: space-between;
        }
    }

    @media (max-width: 768px) {
        .contact-card-body {
            padding: 20px;
        }
        
        .contact-card-header {
            padding: 15px 20px;
        }
        
        .quick-actions-card {
            padding: 20px;
        }
        
        .action-item {
            margin-bottom: 15px;
        }
        
        .map-footer {
            flex-direction: column;
            gap: 10px;
        }
        
        .map-footer button {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .county-stats {
            flex-direction: column;
            gap: 15px;
        }
        
        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    function openGoogleMaps() {
        window.open('https://www.google.com/maps/place/Monrovia,+Liberia/@6.2905272,-10.8807447,12z/data=!3m1!4b1!4m6!3m5!1s0xf093adcadd88c43:0x5a1e81b7648b43e3!8m2!3d6.2907432!4d-10.7605239!16zL20vMDN0cGc?entry=ttu', '_blank');
    }

    function scrollToCarousel() {
        document.querySelector('.service-centers-carousel').scrollIntoView({ 
            behavior: 'smooth' 
        });
    }

    // Chatbot integration for new buttons
    document.getElementById('headquartersChatBtn').addEventListener('click', function() {
        if (typeof chatbotContainer !== 'undefined') {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "Tell me about the Ministry headquarters";
            sendUserMessage();
        }
    });

    document.getElementById('hoursChatBtn').addEventListener('click', function() {
        if (typeof chatbotContainer !== 'undefined') {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "What are your office hours?";
            sendUserMessage();
        }
    });

    // Existing chatbot integration
    document.getElementById('locationChatBtn').addEventListener('click', function() {
        if (typeof chatbotContainer !== 'undefined') {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "Where are your offices located?";
            sendUserMessage();
        }
    });

    document.getElementById('contactChatBtn').addEventListener('click', function() {
        if (typeof chatbotContainer !== 'undefined') {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "How can I contact the ministry directly?";
            sendUserMessage();
        }
    });
</script>
<?=$this->endSection()?>
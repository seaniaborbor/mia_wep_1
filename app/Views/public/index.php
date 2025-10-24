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
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="cert-card p-4 h-100 text-center">
                        <div class="cert-icon">
                            <i class="fas fa-ring"></i>
                        </div>
                        <h3 class="cert-title">Marriage Certificate</h3>
                        <p class="cert-desc">Official documentation of legally recognized marriages in Liberia</p>
                        <a href="/instrunction/marriage_cert_info" class="btn btn-light btn-lg px-4"><i class="fas fa-paper-plane"></i>Findout More</a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="cert-card p-4 h-100 text-center">
                        <div class="cert-icon">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <h3 class="cert-title">Divorce Certificate</h3>
                        <p class="cert-desc">Legal proof of marriage dissolution under Liberian law</p>
                        <a href="/instrunction/divorce_cert_info" class="btn btn-light btn-lg px-4"><i class="fas fa-paper-plane"></i> Findout More </a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="cert-card p-4 h-100 text-center">
                        <div class="cert-icon">
                            <i class="fas fa-male"></i>
                        </div>
                        <h3 class="cert-title">Bachelor Certificate</h3>
                        <p class="cert-desc">Legal declaration of unmarried status for male applicants</p>
                        <a href="/instrunction/not_available_info" class="btn btn-light btn-lg px-4"><i class="fas fa-paper-plane"></i> Findout More </a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="cert-card p-4 h-100 text-center">
                        <div class="cert-icon">
                            <i class="fas fa-female "></i>
                        </div>
                        <h3 class="cert-title">Spinster Certificate</h3>
                        <p class="cert-desc">Legal declaration of unmarried status for female applicants</p>
                        <a href="/instrunction/not_available_info" class="btn btn-light btn-lg px-4"> Findout More <i class="fas fa-paper-plane"></i> </a>
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
    <section id="faq" class="py-5 bg-light">
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


    <!-- Add these CSS styles to your layout -->
<style>
    /* Service Centers Carousel */
    .service-centers-carousel {
        /*background: linear-gradient(135deg, rgba(0, 35, 102, 0.03) 0%, rgba(191, 10, 48, 0.03) 100%);*/
        padding: 60px 0;
        margin: 40px 0;
    }

    .carousel-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .carousel-title {
        color: var(--liberia-blue);
        font-weight: 700;
        margin-bottom: 15px;
        font-family: 'Merriweather', serif;
        font-size: 2.5rem;
    }

    .carousel-subtitle {
        color: #666;
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .service-center-card {
        background: var(--liberia-white);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 2px solid rgba(0, 35, 102, 0.1);
        padding: 30px;
        margin: 15px;
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .service-center-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: var(--liberia-blue);
    }

    .service-center-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%);
    }

    .county-badge {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .center-icon {
        font-size: 2.5rem;
        color: var(--liberia-blue);
        margin-bottom: 20px;
        display: block;
    }

    .center-name {
        color: var(--liberia-blue);
        font-weight: 700;
        margin-bottom: 15px;
        font-family: 'Merriweather', serif;
        font-size: 1.3rem;
        line-height: 1.3;
        min-height: 60px;
    }

    .center-location {
        color: var(--liberia-red);
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .center-location i {
        font-size: 1.1rem;
    }

    .center-details {
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        color: #555;
    }

    .detail-item i {
        color: var(--liberia-blue);
        width: 20px;
        margin-right: 10px;
        font-size: 1rem;
    }

    .center-code {
        background: rgba(0, 35, 102, 0.1);
        padding: 8px 12px;
        border-radius: 8px;
        font-family: monospace;
        font-weight: 600;
        color: var(--liberia-blue);
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 10px;
    }

    /* Owl Carousel Custom Navigation */
    .owl-nav {
        text-align: center;
        margin-top: 30px;
    }

    .owl-prev, .owl-next {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%) !important;
        color: white !important;
        width: 50px;
        height: 50px;
        border-radius: 50% !important;
        margin: 0 10px !important;
        font-size: 1.5rem !important;
        transition: all 0.3s ease !important;
    }

    .owl-prev:hover, .owl-next:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .owl-dots {
        text-align: center;
        margin-top: 20px;
    }

    .owl-dot span {
        background: #ddd !important;
        margin: 5px;
        transition: all 0.3s ease;
    }

    .owl-dot.active span {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%) !important;
        transform: scale(1.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .service-centers-carousel {
            padding: 40px 0;
        }

        .carousel-title {
            font-size: 2rem;
        }

        .carousel-subtitle {
            font-size: 1.1rem;
        }

        .service-center-card {
            padding: 25px 20px;
            margin: 10px;
        }

        .center-name {
            font-size: 1.2rem;
            min-height: auto;
        }
    }

    @media (max-width: 576px) {
        .carousel-title {
            font-size: 1.8rem;
        }

        .service-center-card {
            padding: 20px 15px;
        }

        .center-icon {
            font-size: 2rem;
        }
    }
</style>

<!-- Add these scripts to your layout -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

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

<script>
    $(document).ready(function(){
        $('.service-centers-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            },
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>'
            ]
        });
    });
</script>


<section id="contact" class="py-5">
  <div class="container">
    <div class="section-header text-center mb-5">
      <h2 class="section-title" data-aos="fade-up">Contact Information</h2>
      <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
        Reach out for official inquiries
      </p>
    </div>

    <div class="row align-items-stretch">
      <!-- Google Maps Column (7 cols) -->
      <div class="col-lg-7 mb-4 mb-lg-0" data-aos="zoom-in-right">
        <div class="map-card">
          <div class="map-header">
            <i class="fas fa-map-marked-alt me-2"></i>
            <strong>Head Office Location</strong>
          </div>
          <div class="map-container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7293072960133!2d-10.798273006837647!3d6.299256962245319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xf09f8011ea16693%3A0x4d13e6d6b6151b3a!2sMinistry%20of%20Internal%20Affairs!5e0!3m2!1sen!2s!4v1760727067864!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="map-footer">
            <button class="btn btn-gradient btn-sm" onclick="openGoogleMaps()">
              <i class="fas fa-directions me-1"></i> Open in Google Maps
            </button>
            <button class="btn btn-outline-primary btn-sm" id="locationChatBtn">
              <i class="fas fa-robot me-1"></i> Ask Assistant
            </button>
          </div>
        </div>
      </div>

      <!-- Contact Chip Column (5 cols) -->
      <div class="col-lg-5" data-aos="zoom-in-left" data-aos-delay="200">
        <div class="contact-chip shadow-lg">
          <div class="chip-header mb-3">
            <i class="fas fa-building me-2 text-primary"></i>
            <h4 class="m-0 fw-bold">Ministry of Internal Affairs</h4>
          </div>

          <div class="chip-section mb-3">
            <h6 class="text-uppercase text-secondary mb-2"><i class="fas fa-map-pin me-2 text-danger"></i> Address</h6>
            <p class="mb-0">Capitol Hill, Monrovia, Liberia</p>
          </div>

          <div class="chip-section mb-3">
            <h6 class="text-uppercase text-secondary mb-2"><i class="fas fa-phone-alt me-2 text-success"></i> Contact</h6>
            <ul class="list-unstyled mb-0">
              <li><strong>Phone:</strong> +231 123 456 789</li>
              <li><strong>Email:</strong> info@mia.gov.lr</li>
              <li><strong>Website:</strong> www.mia.gov.lr</li>
            </ul>
          </div>

          <div class="chip-section mb-3">
            <h6 class="text-uppercase text-secondary mb-2"><i class="fas fa-clock me-2 text-warning"></i> Office Hours</h6>
            <ul class="list-unstyled mb-0">
              <li>Mon - Fri: <strong>8:00 AM – 5:00 PM</strong></li>
              <li>Saturday: <strong>9:00 AM – 1:00 PM</strong></li>
              <li>Sunday & Holidays: <span class="text-danger fw-bold">Closed</span></li>
            </ul>
          </div>

          <div class="chip-footer text-center mt-4">
            <button class="btn btn-gradient w-100 pulse-btn" id="contactChatBtn">
              <i class="fas fa-headset me-2"></i> Contact via Assistant
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
    /* Contact Chip */
.contact-chip {
  background: white;
  border-radius: 20px;
  padding: 30px;
  border: 1px solid rgba(0, 35, 102, 0.1);
  position: relative;
  overflow: hidden;
  transition: all 0.4s ease;
}

.contact-chip::before {
  content: "";
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle at top left, rgba(0, 35, 102, 0.08), transparent 70%);
  transform: scale(0);
  transition: all 0.6s ease;
}

.contact-chip:hover::before {
  transform: scale(1);
}

.contact-chip:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 30px rgba(0, 35, 102, 0.2);
}

.chip-header {
  display: flex;
  align-items: center;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  padding-bottom: 10px;
}

.chip-section h6 {
  font-weight: 700;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
}

.chip-section p, 
.chip-section li {
  font-size: 0.95rem;
  color: #333;
  margin-bottom: 5px;
}

.chip-footer .pulse-btn {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(0, 35, 102, 0.4); }
  70% { box-shadow: 0 0 0 15px rgba(0, 35, 102, 0); }
  100% { box-shadow: 0 0 0 0 rgba(0, 35, 102, 0); }
}

/* Adjust Map to Match Height */
.map-card {
  height: 100%;
  border-radius: 15px;
  overflow: hidden;
  background: var(--liberia-white);
  border: 1px solid rgba(0, 35, 102, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.map-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 35px rgba(0, 35, 102, 0.15);
}

.map-header {
  background: linear-gradient(135deg, var(--liberia-blue) 0%, #001a4d 100%);
  color: white;
  padding: 20px;
  font-size: 1.2rem;
  font-weight: 600;
  display: flex;
  align-items: center;
}

.map-footer {
  padding: 20px;
  display: flex;
  gap: 10px;
  justify-content: space-between;
  background: rgba(0, 35, 102, 0.02);
}

/* Responsive */
@media (max-width: 991px) {
  .col-lg-7, .col-lg-5 {
    width: 100%;
  }
  .contact-chip {
    margin-top: 20px;
  }
}

</style>

<script>
    function openGoogleMaps() {
        window.open('https://www.google.com/maps/place/Monrovia,+Liberia/@6.2905272,-10.8807447,12z/data=!3m1!4b1!4m6!3m5!1s0xf093adcadd88c43:0x5a1e81b7648b43e3!8m2!3d6.2907432!4d-10.7605239!16zL20vMDN0cGc?entry=ttu', '_blank');
    }

    // Chatbot integration
    document.getElementById('locationChatBtn').addEventListener('click', function() {
        // This should trigger your existing chatbot functionality
        if (typeof chatbotContainer !== 'undefined') {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "Where are your offices located?";
            sendUserMessage();
        }
    });

    document.getElementById('contactChatBtn').addEventListener('click', function() {
        // This should trigger your existing chatbot functionality
        if (typeof chatbotContainer !== 'undefined') {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "How can I contact the ministry directly?";
            sendUserMessage();
        }
    });
</script>
<?=$this->endSection()?>
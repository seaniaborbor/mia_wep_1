<?= $this->extend('public/partials/layout') ?>

<?= $this->section('main') ?>

<div class="container  mt-5">
  <div class="row mt-5 py-5 justify-content-between vertical-align-middle">
    <div class="col-md-8">
      <?php if (isset($instructions_card) && !empty($instructions_card)): ?>
        <?= include(APPPATH . 'Views/public/partials/' . $instructions_card . '.php') ?>
      <?php else: ?>
        <?= include(APPPATH . 'Views/public/partials/not_available_info.php') ?>
      <?php endif; ?>

    </div>


    <!-- Right: Dynamic cards will be injected here -->
    <div class="col-md-4 mt-md-0">
        
         <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light rounded shadow-sm p-0">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" data-aos="fade-up">Frequently Asked Questions</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Quick answers to common questions</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-12">
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

    </div>
  </div>
</div>

<style>
.alert-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 15px;
  border: 2px solid;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
}

.alert-card .alert-icon {
  transition: transform 0.3s ease;
}

.alert-card:hover .alert-icon {
  transform: scale(1.1);
}

.glass-card {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 15px;
  border: 1px solid rgba(255, 255, 255, 0.18);
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
}

.hover-3d {
  transition: all 0.3s ease;
  transform-style: preserve-3d;
}

.hover-3d:hover {
  transform: perspective(1000px) rotateY(5deg) rotateX(2deg) scale(1.02);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
  .container.py-5.mt-5 {
    padding-top: 2rem !important;
    margin-top: 2rem !important;
  }
  
  .row.mt-5.py-5 {
    margin-top: 1rem !important;
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
  }
  
  .d-flex.gap-2 {
    gap: 0.5rem !important;
  }
  
  .btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Help button for instructions
  document.getElementById('helpInstructions')?.addEventListener('click', function() {
    if (window.chatbotContainer) {
      chatbotContainer.classList.add('active');
      setTimeout(() => {
        if (window.sendBotMessage) {
          window.sendBotMessage("I need help with the application instructions");
        }
      }, 500);
    }
  });

  // Contact support button
  document.getElementById('contactSupport')?.addEventListener('click', function() {
    if (window.chatbotContainer) {
      chatbotContainer.classList.add('active');
      setTimeout(() => {
        if (window.sendBotMessage) {
          window.sendBotMessage("I need technical support for the application form");
        }
      }, 500);
    }
  });

  // Use assistant button
  document.getElementById('useAssistant')?.addEventListener('click', function() {
    if (window.chatbotContainer) {
      chatbotContainer.classList.add('active');
    }
  });

  // Load alternative info
  document.getElementById('loadAlternativeInfo')?.addEventListener('click', function() {
    const infoContainer = this.closest('.col-md-6');
    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';
    this.disabled = true;
    
    setTimeout(() => {
      infoContainer.innerHTML = `
        <div class="glass-card p-4 mb-4" data-aos="fade-left">
          <div class="d-flex align-items-start mb-3">
            <div class="card-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
              <i class="fas fa-clock text-white"></i>
            </div>
            <div>
              <h4 class="text-primary mb-2">Office Hours</h4>
              <p class="text-muted mb-0">Mon-Fri: 8:00 AM - 4:00 PM<br>Closed on weekends and public holidays</p>
            </div>
          </div>
        </div>
        <div class="glass-card p-4 mb-4" data-aos="fade-left" data-aos-delay="100">
          <div class="d-flex align-items-start mb-3">
            <div class="card-icon bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
              <i class="fas fa-phone text-white"></i>
            </div>
            <div>
              <h4 class="text-primary mb-2">Contact</h4>
              <p class="text-muted mb-0">Phone: +231 123 456 789<br>Email: info@mia.gov.lr</p>
            </div>
          </div>
        </div>
        <div class="glass-card p-4" data-aos="fade-left" data-aos-delay="200">
          <div class="d-flex align-items-start mb-3">
            <div class="card-icon bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
              <i class="fas fa-map-marker-alt text-white"></i>
            </div>
            <div>
              <h4 class="text-primary mb-2">Location</h4>
              <p class="text-muted mb-0">Ministry of Internal Affairs<br>Capitol Hill, Monrovia</p>
            </div>
          </div>
        </div>
      `;
    }, 1000);
  });
});
</script>

<?= $this->endSection() ?>
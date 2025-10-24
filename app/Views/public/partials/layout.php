<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ministry of Internal Affairs - Republic of Liberia</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Sticky FAQ Section */
        .faq-sticky {
          position: sticky;
          top: 90px; /* adjust based on your navbar height */
          z-index: 10;
        }

        :root {
            --liberia-blue: #002366;
            --liberia-red: #BF0A30;
            --liberia-white: #FFFFFF;
            --liberia-light-blue: #E6EEFF;
            --dark: #0A0E17;
            --light: #F5F9FF;
            --gradient: linear-gradient(135deg, var(--liberia-blue) 0%, var(--liberia-red) 100%);
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: var(--liberia-white);
            color: #333;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 700;
        }
        
        /* Top Header */
        .top-header {
            background: var(--liberia-blue);
            color: var(--liberia-white);
            font-size: 0.85rem;
            padding: 8px 0;
            border-bottom: 2px solid var(--liberia-red);
        }
        
        .top-header a {
            color: var(--liberia-white);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .top-header a:hover {
            color: var(--liberia-light-blue);
        }
        
        .top-header .divider {
            color: rgba(255, 255, 255, 0.5);
            margin: 0 10px;
        }
        
        /* Navbar */
        .navbar {
            background: var(--liberia-white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            transition: all 0.3s;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        
        .navbar-brand img {
            height: 55px;
            margin-right: 10px;
        }
        
        .navbar-brand .brand-text {
            display: flex;
            flex-direction: column;
        }
        
        .navbar-brand .brand-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--liberia-blue);
            line-height: 1.1;
            margin-bottom: 2px;
        }
        
        .navbar-brand .brand-subtitle {
            font-size: 0.8rem;
            color: var(--liberia-red);
            font-weight: 600;
        }
        
        .nav-link {
            color: var(--liberia-blue) !important;
            font-weight: 600;
            margin: 0 5px;
            position: relative;
            transition: all 0.3s;
            padding: 8px 15px !important;
            border-radius: 5px;
        }
        
        .nav-link:hover, .nav-link.active {
            background: var(--liberia-blue);
            color: var(--liberia-white) !important;
        }
        
        /*.nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 15px;
            width: 0;
            height: 3px;
            background: var(--liberia-red);
            transition: width 0.3s;
        }*/
        
        .nav-link:hover:after, .nav-link.active:after {
            width: calc(100% - 30px);
        }
        
        .navbar-toggler {
            border: 2px solid var(--liberia-blue);
            padding: 5px 10px;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 35, 102, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* Hero Section */
        .hero {
            min-height: 70vh;
            background: url('/uploads/imgs/banner1.png') no-repeat center center;
            background-size: cover;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        
        .hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 35, 102, 0.85) 0%, rgba(191, 10, 48, 0.8) 100%);
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--liberia-white);
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--liberia-white);
            margin-bottom: 2rem;
            font-weight: 400;
        }
        
        /* Section Headers */
        .section-header {
            margin-bottom: 3rem;
            text-align: center;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--liberia-blue);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        .text-primary{
            color: var(--liberia-blue) !important;

        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--liberia-red);
        }
        
        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Certificate Cards */
        .cert-card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            position: relative;
            z-index: 1;
            border: 1px solid #e0e0e0;
            height: 100%;
            background: var(--liberia-white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .cert-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--liberia-blue);
        }
        
        .cert-card:hover .cert-icon {
            transform: rotate(10deg) scale(1.1);
            color: var(--liberia-blue);
        }
        
        .cert-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
            color: var(--liberia-blue);
        }
        
        .cert-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--liberia-blue);
            transition: all 0.3s;
        }
        
        .cert-desc {
            color: #666;
            transition: all 0.3s;
        }
        
        /* Process Steps */
        .process-step {
            position: relative;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            z-index: 1;
            height: 100%;
            border: 1px solid #e0e0e0;
        }
        
        .process-step:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--liberia-blue);
        }
        
        .step-number {
            position: absolute;
            top: -15px;
            left: 30px;
            width: 50px;
            height: 50px;
            background: var(--gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .step-content {
            padding-top: 30px;
        }
        
        .step-icon {
            font-size: 2.5rem;
            color: var(--liberia-blue);
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        
        .step-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--liberia-blue);
            transition: all 0.3s;
        }
        
        .step-desc {
            color: #666;
            transition: all 0.3s;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--liberia-blue);
            border-color: var(--liberia-blue);
            font-weight: 600;
            padding: 10px 25px;
        }
        
        .btn-primary:hover {
            background: var(--liberia-red);
            border-color: var(--liberia-red);
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
        
        /* FAQ Section */
        .accordion-button {
            font-weight: 600;
            color: var(--liberia-blue);
        }
        
        .accordion-button:not(.collapsed) {
            background: var(--liberia-blue);
            color: white;
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 35, 102, 0.25);
        }
        
        /* Contact Section */
        .contact-card {
            border-radius: 10px;
            padding: 30px;
            height: 100%;
            background: var(--liberia-white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--liberia-blue);
        }
        
        .contact-card h3 {
            color: var(--liberia-blue);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .contact-card i {
            color: var(--liberia-red);
            margin-right: 10px;
            width: 20px;
        }
        
        /* Footer */
        footer {
            background: var(--liberia-blue);
            color: var(--liberia-white);
            padding: 40px 0 20px;
        }
        
        footer a {
            color: var(--liberia-white);
            text-decoration: none;
        }
        
        footer a:hover {
            color: var(--liberia-light-blue);
        }
        
        .footer-links h5 {
            color: var(--liberia-white);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        .footer-links ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 30px;
            font-size: 0.9rem;
        }
        
        /* Chatbot */
        .chatbot-trigger {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s;
        }
        
        .chatbot-trigger:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .chatbot-container {
            position: fixed;
            bottom: 120px;
            right: 30px;
            width: 380px;
            max-height: 600px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: none;
            z-index: 1000;
            transform-origin: bottom right;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid var(--liberia-blue);
        }
        
        .chatbot-container.active {
            display: block;
            opacity: 1;
            transform: scale(1);
        }
        
        .chatbot-header {
            background: var(--liberia-blue);
            color: white;
            padding: 15px 20px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chatbot-body {
            padding: 20px;
            height: 450px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        
        .message {
            margin-bottom: 15px;
            max-width: 80%;
            padding: 12px 18px;
            border-radius: 20px;
            position: relative;
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .bot-message {
            align-self: flex-start;
            background: #F0F4FF;
            border-radius: 20px 20px 20px 5px;
            color: var(--dark);
        }
        
        .user-message {
            align-self: flex-end;
            background: var(--gradient);
            color: white;
            border-radius: 20px 20px 5px 20px;
        }
        
        .chatbot-input {
            display: flex;
            padding: 15px;
            border-top: 1px solid #eee;
        }
        
        .chatbot-input input {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 30px;
            padding: 12px 20px;
            outline: none;
            font-size: 0.9rem;
        }
        
        .chatbot-input button {
            background: var(--liberia-blue);
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            margin-left: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .chatbot-input button:hover {
            background: var(--liberia-red);
            transform: rotate(15deg);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .chatbot-container {
                width: 90%;
                right: 5%;
                bottom: 100px;
            }
            
            .navbar-brand .brand-title {
                font-size: 1.1rem;
            }
            
            .navbar-brand .brand-subtitle {
                font-size: 0.7rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.6rem;
            }
        }


        /* guideline to apply card css */
        .guidelines-card {
        background: var(--liberia-white);
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 35, 102, 0.15);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }
    
    .guidelines-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .guidelines-header {
        background: linear-gradient(135deg, var(--liberia-blue) 0%, #001a4d 100%);
        color: white;
        padding: 20px 25px;
        font-size: 1.2rem;
        font-weight: 600;
        font-family: 'Merriweather', serif;
        display: flex;
        align-items: center;
    }
    
    .guidelines-header i {
        font-size: 1.4rem;
    }
    
    .guidelines-body {
        padding: 25px;
    }
    
    .guideline-item {
        display: flex;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        transition: all 0.2s ease;
    }
    
    .guideline-item:last-child {
        border-bottom: none;
    }
    
    .guideline-item:hover {
        background: rgba(0, 35, 102, 0.03);
        margin: 0 -15px;
        padding: 12px 15px;
        border-radius: 8px;
    }
    
    .guideline-item i {
        margin-top: 2px;
        flex-shrink: 0;
        font-size: 1.1rem;
    }
    
    .guideline-item span {
        color: #444;
        font-weight: 500;
        line-height: 1.5;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .guidelines-header {
            padding: 18px 20px;
            font-size: 1.1rem;
        }
        
        .guidelines-body {
            padding: 20px;
        }
        
        .guideline-item {
            padding: 10px 0;
        }
        
        .row.mt-4 .col-md-4 {
            display: none;
        }
        
        .row.mt-4 .col-md-8 {
            width: 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .guidelines-header {
            padding: 15px 18px;
            font-size: 1rem;
        }
        
        .guidelines-body {
            padding: 18px;
        }
        
        .guideline-item {
            font-size: 0.95rem;
        }
    }


        /* Certificate Verification Error Styles */
.verification-error-card {
    background: var(--liberia-white);
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    border: 2px solid rgba(220, 53, 69, 0.2);
    overflow: hidden;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.verification-error-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
}

.error-card-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    padding: 25px 30px;
    font-size: 1.4rem;
    font-weight: 700;
    font-family: 'Merriweather', serif;
    display: flex;
    align-items: center;
}

.error-card-body {
    padding: 40px 30px;
    text-align: center;
}

.error-title {
    color: #dc3545;
    font-weight: 700;
    margin-bottom: 20px;
    font-family: 'Merriweather', serif;
    font-size: 1.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.error-message {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 15px;
    font-weight: 500;
}

.error-help {
    color: #666;
    font-size: 1rem;
    margin-bottom: 30px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.error-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-retry {
    background: var(--liberia-blue);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-retry:hover {
    background: var(--liberia-red);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    color: white;
    text-decoration: none;
}

.btn-support {
    background: rgba(0, 35, 102, 0.1);
    color: var(--liberia-blue);
    border: 2px solid var(--liberia-blue);
    border-radius: 8px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-support:hover {
    background: var(--liberia-blue);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .error-card-header {
        padding: 20px;
        font-size: 1.2rem;
        text-align: center;
        justify-content: center;
    }
    
    .error-card-body {
        padding: 30px 20px;
    }
    
    .error-title {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 10px;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-retry, .btn-support {
        width: 200px;
        justify-content: center;
    }
}

.certificate-result-card {
        background: var(--liberia-white);
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 35, 102, 0.15);
        overflow: hidden;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    
    .certificate-result-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .certificate-header-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 25px 30px;
        font-size: 1.4rem;
        font-weight: 700;
        font-family: 'Merriweather', serif;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .certificate-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .certificate-body {
        padding: 30px;
    }
    
    .certificate-reference {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(0, 35, 102, 0.1);
    }
    
    .reference-title {
        color: var(--liberia-blue);
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .reference-code {
        color: var(--liberia-red);
        font-weight: 700;
        background: rgba(191, 10, 48, 0.1);
        padding: 5px 15px;
        border-radius: 8px;
    }
    
    .certificate-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .summary-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
        background: rgba(0, 35, 102, 0.03);
        border-radius: 10px;
        border-left: 4px solid var(--liberia-blue);
    }
    
    .summary-item i {
        font-size: 1.5rem;
        margin-top: 2px;
    }
    
    .summary-item strong {
        color: var(--liberia-blue);
        display: block;
        margin-bottom: 5px;
    }
    
    .summary-item p {
        margin: 0;
        color: #333;
        font-weight: 500;
    }
    
    .certificate-parties {
        margin-bottom: 30px;
    }
    
    .party-card {
        background: var(--liberia-white);
        border-radius: 12px;
        border: 2px solid rgba(0, 35, 102, 0.1);
        overflow: hidden;
        height: 100%;
        transition: all 0.3s ease;
    }
    
    .party-card:hover {
        border-color: var(--liberia-blue);
        transform: translateY(-2px);
    }
    
    .groom-card {
        border-top: 4px solid var(--liberia-blue);
    }
    
    .bride-card {
        border-top: 4px solid var(--liberia-red);
    }
    
    .party-header {
        background: rgba(0, 35, 102, 0.05);
        padding: 20px;
        font-weight: 700;
        color: var(--liberia-blue);
        font-size: 1.2rem;
        display: flex;
        align-items: center;
    }
    
    .bride-card .party-header {
        color: var(--liberia-red);
    }
    
    .party-body {
        padding: 25px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: var(--liberia-blue);
        flex: 1;
    }
    
    .info-value {
        flex: 2;
        color: #333;
        text-align: right;
    }
    
    .photo-section {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .party-photo {
        height: 120px;
        width: auto;
        border-radius: 8px;
        border: 2px solid rgba(0, 35, 102, 0.2);
    }
    
    .photo-caption {
        display: block;
        margin-top: 8px;
        color: #666;
        font-weight: 500;
    }
    
    .certificate-officials {
        background: rgba(0, 35, 102, 0.02);
        border-radius: 12px;
        padding: 25px;
        border: 1px solid rgba(0, 35, 102, 0.1);
    }
    
    .officials-header {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--liberia-blue);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        font-family: 'Merriweather', serif;
    }
    
    .officials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .official-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
        background: white;
        border-radius: 10px;
        border-left: 4px solid var(--liberia-blue);
        transition: all 0.3s ease;
    }
    
    .official-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .official-item i {
        font-size: 1.8rem;
        margin-top: 2px;
    }
    
    .official-item strong {
        color: var(--liberia-blue);
        display: block;
        margin-bottom: 5px;
    }
    
    .official-item p {
        margin: 0;
        font-weight: 600;
        color: #333;
    }
    
    .official-item small {
        color: #666;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .certificate-body {
            padding: 20px;
        }
        
        .certificate-header-success {
            padding: 20px;
            font-size: 1.2rem;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
        
        .certificate-summary {
            grid-template-columns: 1fr;
        }
        
        .info-row {
            flex-direction: column;
            gap: 5px;
        }
        
        .info-value {
            text-align: left;
        }
        
        .officials-grid {
            grid-template-columns: 1fr;
        }
        
        .party-photo {
            height: 100px;
        }
    }

       
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span><i class="fas fa-phone-alt me-2"></i> +231 123 456 789</span>
                    <span class="divider">|</span>
                    <span><i class="fas fa-envelope me-2"></i> info@mia.gov.lr</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="/v"><i class="fas fa-globe me-1"></i> Validate Certificate</a>
                    <span class="divider">|</span>
                    <a href="/auth"><i class="fas fa-user me-1"></i>Login</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/uploads/imgs/logo.png" alt="Liberia Coat of Arms">
                <div class="brand-text">
                    <div class="brand-title">Ministry of Internal Affairs</div>
                    <div class="brand-subtitle">Decentralized Digital Certificate Management System</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() === '') ? 'active' : '' ?>
" href="/"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#faq"><i class="fas fa-question-circle me-1"></i> FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#contact"><i class="fas fa-address-book me-1"></i> Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() === base_url('v')) ? 'active' : '' ?>
" href="/v"><i class="fas fa-search me-1"></i> Verify Certificate</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

      <?=$this->renderSection('main')?> 
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        <img src="/uploads/imgs/logo.png" alt="Liberia Coat of Arms" height="60" class="me-3">
                        <div>
                            <h5 class="mb-0">Ministry of Internal Affairs</h5>
                            <small>Republic of Liberia</small>
                        </div>
                    </div>
                    <p>Official government institution responsible for civil registration, certificates, and internal governance matters.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/#certificates">Certificates</a></li>
                            <li><a href="/#process">Process</a></li>
                            <li><a href="/#faq">FAQ</a></li>
                            <li><a href="/#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h5>Services</h5>
                        <ul>
                            <li><a href="/v">Verify Certificate</a></li>
                            <li><a href="#">Marriage Certificate</a></li>
                            <li><a href="#">Divorce Certificate</a></li>
                            <li><a href="#">Bachelor Certificate</a></li>
                            <li><a href="#">Spinster Certificate</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="footer-links">
                        <h5>Government</h5>
                        <ul>
                            <li><a href="#">Executive Mansion</a></li>
                            <li><a href="#">Legislature</a></li>
                            <li><a href="#">Judiciary</a></li>
                            <li><a href="#">Ministries & Agencies</a></li>
                            <li><a href="#">County Information</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom text-center">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start mb-2 mb-md-0">
                        <p class="mb-0">&copy; 2023 Ministry of Internal Affairs, Republic of Liberia. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3">Privacy Policy</a>
                        <a href="#" class="me-3">Terms of Use</a>
                        <a href="#">Accessibility</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Chatbot Trigger -->
    <div class="chatbot-trigger" id="chatbotTrigger">
        <i class="fas fa-robot"></i>
    </div>

    <!-- Chatbot Container -->
    <div class="chatbot-container" id="chatbotContainer">
        <div class="chatbot-header">
            <span><i class="fas fa-robot me-2"></i> MIA Assistant</span>
            <button class="btn-close btn-close-white" id="closeChatbot"></button>
        </div>
        <div class="chatbot-body" id="chatbotBody">
            <div class="message bot-message">
                Hello! I'm the MIA assistant. How can I help you with certificate information today?
            </div>
        </div>
        <div class="chatbot-input">
            <input type="text" id="chatbotInput" placeholder="Type your question here...">
            <button id="sendMessage"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Chatbot functionality
        const chatbotTrigger = document.getElementById('chatbotTrigger');
        const chatbotContainer = document.getElementById('chatbotContainer');
        const closeChatbot = document.getElementById('closeChatbot');
        const sendMessage = document.getElementById('sendMessage');
        const chatbotInput = document.getElementById('chatbotInput');
        const chatbotBody = document.getElementById('chatbotBody');
        
        // Open chatbot
        chatbotTrigger.addEventListener('click', () => {
            chatbotContainer.classList.add('active');
        });
        
        // Close chatbot
        closeChatbot.addEventListener('click', () => {
            chatbotContainer.classList.remove('active');
        });
        
        // Send message
        function sendUserMessage() {
            const message = chatbotInput.value.trim();
            if (message === '') return;
            
            // Add user message
            const userMessage = document.createElement('div');
            userMessage.classList.add('message', 'user-message');
            userMessage.textContent = message;
            chatbotBody.appendChild(userMessage);
            
            // Clear input
            chatbotInput.value = '';
            
            // Scroll to bottom
            chatbotBody.scrollTop = chatbotBody.scrollHeight;
            
            // Simulate bot response
            setTimeout(() => {
                const botMessage = document.createElement('div');
                botMessage.classList.add('message', 'bot-message');
                
                // Simple response logic
                if (message.toLowerCase().includes('marriage')) {
                    botMessage.textContent = "For marriage certificates, you'll need: valid IDs for both parties, proof of single status, two passport photos each, and the completed application form. The fee is $25 USD.";
                } else if (message.toLowerCase().includes('divorce')) {
                    botMessage.textContent = "Divorce certificates require: court decree of divorce, valid ID, completed application form, and two passport photos. The fee is $30 USD.";
                } else if (message.toLowerCase().includes('bachelor') || message.toLowerCase().includes('spinster')) {
                    botMessage.textContent = "Bachelor/Spinster certificates require: valid ID, two passport photos, affidavit of single status, and completed application form. The fee is $15 USD.";
                } else if (message.toLowerCase().includes('location') || message.toLowerCase().includes('where')) {
                    botMessage.textContent = "Our main office is at the Ministry of Internal Affairs, Capitol Hill, Monrovia. We also have county offices in Montserrado, Nimba, Bong, Lofa, Grand Bassa, Margibi and other counties.";
                } else if (message.toLowerCase().includes('time') || message.toLowerCase().includes('hour')) {
                    botMessage.textContent = "Our office hours are Monday-Friday 8:00 AM - 5:00 PM, and Saturday 9:00 AM - 1:00 PM. We're closed on Sundays and public holidays.";
                } else if (message.toLowerCase().includes('fee') || message.toLowerCase().includes('cost') || message.toLowerCase().includes('price')) {
                    botMessage.textContent = "Current fees: Marriage Certificate - $25, Divorce Certificate - $30, Bachelor/Spinster Certificate - $15. All fees are in USD and subject to change.";
                } else {
                    botMessage.textContent = "I can help with information about marriage, divorce, bachelor, and spinster certificates. Please ask about requirements, fees, locations, or processing times.";
                }
                
                chatbotBody.appendChild(botMessage);
                chatbotBody.scrollTop = chatbotBody.scrollHeight;
            }, 1000);
        }
        
        sendMessage.addEventListener('click', sendUserMessage);
        
        chatbotInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendUserMessage();
            }
        });
        
        // Quick action buttons
        document.getElementById('heroChatBtn').addEventListener('click', () => {
            chatbotContainer.classList.add('active');
        });
        
        document.getElementById('faqChatBtn').addEventListener('click', () => {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "I have a question about the certificate process";
            sendUserMessage();
        });
        
        document.getElementById('locationChatBtn').addEventListener('click', () => {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "Where are your offices located?";
            sendUserMessage();
        });
        
        document.getElementById('contactChatBtn').addEventListener('click', () => {
            chatbotContainer.classList.add('active');
            chatbotInput.value = "How can I contact the ministry directly?";
            sendUserMessage();
        });
        
        // Certificate info buttons
        document.querySelectorAll('.cert-info-btn').forEach(button => {
            button.addEventListener('click', function() {
                const certType = this.getAttribute('data-cert');
                chatbotContainer.classList.add('active');
                
                let question = "";
                if (certType === 'marriage') {
                    question = "What are the requirements for a marriage certificate?";
                } else if (certType === 'divorce') {
                    question = "What do I need for a divorce certificate?";
                } else if (certType === 'bachelor') {
                    question = "What documents are needed for a bachelor certificate?";
                } else if (certType === 'spinster') {
                    question = "What are the requirements for a spinster certificate?";
                }
                
                chatbotInput.value = question;
                sendUserMessage();
            });
        });
        
        // Process detail buttons
        document.querySelectorAll('.process-detail-btn').forEach(button => {
            button.addEventListener('click', function() {
                const step = this.getAttribute('data-step');
                chatbotContainer.classList.add('active');
                
                let question = "";
                if (step === '1') {
                    question = "What documents do I need for certificate applications?";
                } else if (step === '2') {
                    question = "Where are your office locations?";
                } else if (step === '3') {
                    question = "How long does certificate verification take?";
                } else if (step === '4') {
                    question = "How do I collect my certificate after approval?";
                }
                
                chatbotInput.value = question;
                sendUserMessage();
            });
        });
    </script>
</body>
</html>

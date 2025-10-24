<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>404 | Ministry of Internal Affairs - Liberia</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Orbitron', sans-serif;
      background: #000;
      color: white;
      position: relative;
      overflow: hidden;
    }

    #particles-js {
      position: fixed;
      width: 100%;
      height: 100%;
      z-index: 0;
      top: 0;
      left: 0;
    }

    .content {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 4rem 2rem;
    }

    .glow {
      font-size: 6rem;
      color: #ffffff;
      text-shadow: 0 0 5px #ff0000, 0 0 10px #ffffff, 0 0 15px #0000ff;
      animation: flicker 1.5s infinite alternate;
    }

    @keyframes flicker {
      from {
        opacity: 1;
      }
      to {
        opacity: 0.9;
        text-shadow: 0 0 10px #ff0000, 0 0 20px #ffffff, 0 0 30px #0000ff;
      }
    }

    .btn-liberia {
      border: 2px solid #fff;
      color: #fff;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      background: transparent;
      text-transform: uppercase;
      transition: 0.3s;
    }

    .btn-liberia:hover {
      background: linear-gradient(to right, #ff0000, #ffffff, #0000ff);
      color: black;
      box-shadow: 0 0 20px #ffffff;
    }

    .tagline {
      font-size: 1rem;
      color: #ccc;
      margin-top: 2rem;
    }
  </style>
</head>
<body>

<!-- Particle Background -->
<div id="particles-js"></div>

<!-- Main Content -->
<div class="container-fluid content d-flex flex-column justify-content-center align-items-center min-vh-100">
  <h1 class="glow">4 <i class="bi bi-exclamation-diamond-fill text-danger"></i> 4</h1>
  <h2 class="mb-3">Lost in Cyberspace</h2>
  <p class="mb-3">This page does not exist or is under construction.</p>
  <p class="text-danger mb-4">Please check back later while we continue upgrading Liberia's digital services.</p>
  <a href="<?= base_url() ?>" class="btn btn-liberia">Return to Home</a>
  <div class="tagline">Ministry of Internal Affairs – Republic of Liberia</div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
  particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 100
      },
      "color": {
        "value": ["#ff0000", "#ffffff", "#0000ff"] // Red, white, blue
      },
      "shape": {
        "type": "circle"
      },
      "opacity": {
        "value": 0.7
      },
      "size": {
        "value": 4,
        "random": true
      },
      "line_linked": {
        "enable": false
      },
      "move": {
        "enable": true,
        "speed": 2,
        "direction": "none",
        "random": true,
        "out_mode": "out"
      }
    },
    "interactivity": {
      "events": {
        "onhover": {
          "enable": true,
          "mode": "repulse"
        }
      }
    },
    "retina_detect": true
  });
</script>

</body>
</html>

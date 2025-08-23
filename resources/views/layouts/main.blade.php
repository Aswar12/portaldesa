<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Website Portal {{ $nm_desa }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">
  
  <!-- Custom Main CSS File (Pusat) -->
  <link href="/assets/css/main.css" rel="stylesheet">
  
  <!-- Additional Styles -->
  @yield('styles')
  
  <!-- Fixed Navbar & Smooth Scroll Styles -->
  <style>
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 80px;
    }
    
    body {
      padding-top: 0 !important;
      margin: 0 !important;
    }
    
    #hero {
      margin-top: 0 !important;
      padding-top: 0 !important;
    }
    
    /* Ensure content sections have proper spacing for fixed navbar */
    section:not(#hero) {
      padding-top: 100px;
      margin-top: -80px;
    }
    
    /* Override any conflicting navbar styles */
    .navbar,
    .navbar-brand,
    .navbar-nav {
      background: transparent !important;
    }
    
    /* Smooth page transitions */
    * {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
  </style>
  
  <!-- Custom IDM Menu Style -->
  <style>
    .navbar .nav-link.scrollto:hover .fas,
    .navbar .nav-link.scrollto.active .fas {
      animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    
    .navbar .nav-link.scrollto[href*="idm"] {
      background: linear-gradient(45deg, #007bff, #00c6ff);
      color: white !important;
      border-radius: 20px;
      padding: 8px 15px !important;
      margin: 0 5px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0,123,255,0.3);
    }
    
    .navbar .nav-link.scrollto[href*="idm"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,123,255,0.5);
    }
    
    .navbar .nav-link.scrollto[href*="idm"].active {
      background: linear-gradient(45deg, #0056b3, #007bff);
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  @include('partials.header')

  <main id="main">

    @yield('content')

  </main><!-- End #main -->

  @include('partials.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/assets/vendor/aos/aos.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>
  
  <!-- Custom Main JS File (Pusat) -->
  <script src="/assets/js/main-custom.js"></script>

  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @include('sweetalert::alert')
  
  <!-- Additional Scripts -->
  @yield('scripts')

</body>

</html>
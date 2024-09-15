<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="<?=Assests("assets/img/logoOf.png")?>" rel="icon">
  <link href="<?=Assests("assets/img/logoOf.png")?>" rel="apple-touch-icon">

  <title><?=$this->e($title)?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/img/favicon.png" rel="icon">
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Vendor CSS Files -->
  <link href="<?=Assests("landpage")?>/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=Assests("landpage")?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=Assests("landpage")?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=Assests("landpage")?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=Assests("landpage")?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=Assests("landpage")?>/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=Assests("landpage")?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=Assests("landpage")?>/css/style.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1671016207258131"
     crossorigin="anonymous"></script>

  <!-- =======================================================
  * Template Name: OnePage
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a class="logo" href="<?=routerConfig()?>"><img src="<?=Assests("assets/img/logoOf.png")?>" alt="" class="img-fluid">Barbearia Match</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="<?=routerConfig()?>">Home</a></li>
          <li><a class="nav-link scrollto" href="<?=routerConfig()?>/procurar">Procurar</a></li>
          <!--<li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>-->
          <li><a class="nav-link scrollto" href="<?=routerConfig()?>/cadastro">Cadastro</a></li>
          <li><a class="getstarted scrollto" href="<?=routerConfig()?>/login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



  <main id="main">

  <?=$this->section('content')?>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <!-- Vendor JS Files -->
  <script src="<?=Assests("landpage")?>//vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?=Assests("landpage")?>//vendor/aos/aos.js"></script>
  <script src="<?=Assests("landpage")?>//vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=Assests("landpage")?>//vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=Assests("landpage")?>//vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?=Assests("landpage")?>//vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?=Assests("landpage")?>//vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=Assests("landpage")?>//js/main.js"></script>

</body>

</html>
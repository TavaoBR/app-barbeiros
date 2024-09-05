<?php 
session_start();
validateUser();

$get = new \Src\GET\Usuario();

$nivel = $get->nivel();
$token = $get->token();
$id = $get->id();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=Assests("assets/img/logoOf.png")?>" rel="icon">
    <link href="<?=Assests("assets/img/logoOf.png")?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Vendor CSS Files -->
    <link href="<?=Assests("assets/vendor/bootstrap/css/bootstrap.min.css")?> " rel="stylesheet">
    <link href="<?=Assests("assets/vendor/bootstrap-icons/bootstrap-icons.css")?>" rel="stylesheet">
    <link href="<?=Assests("assets/vendor/quill/quill.snow.css")?>" rel="stylesheet">
    <link href="<?=Assests("assets/vendor/quill/quill.bubble.css")?>" rel="stylesheet">
    <link href="<?=Assests("assets/vendor/simple-datatables/style.css")?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=Assests("assets/css/Style.css")?>">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Template Main CSS File -->
    <title><?=$this->e($title)?></title>


</head>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=routerConfig()?>/app/perfil" class="logo d-flex align-items-center">
        <img src="<?=Assests("assets/img/logoOf.png")?>" alt="">
        <span class="d-none d-lg-block">Match Barbearia</span>
      </a>
      <i class='bx bx-menu toggle-sidebar-btn'></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" id="searchForm">
        <input type="text" name="nome" id="searchQuery" placeholder="pesquise o nome aqui" title="Enter search keyword" required>
        <button type="submit" title="Search"><i class="bx bx-search"></i></button>
      </form>
    </div> <!--End Search Bar -->

    <script>
$(document).ready(function() {
  $('#searchForm').on('submit', function(e) {
    e.preventDefault(); // Evita o envio tradicional do formulário

    var searchQuery = $('#searchQuery').val(); // Captura o valor do campo de busca

    // Substitui espaços por hífens
    var formattedQuery = searchQuery.replace(/ /g, '-');

    // Construir a URL dinamicamente com o valor formatado
    var url = `<?=routerConfig()?>/app/pesquisa/resultado/${encodeURIComponent(formattedQuery)}`;

    // Redireciona para a nova URL
    window.location.href = url;
  });
});
    </script>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

       <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bx bx-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <!--<li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bx bx-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a>End Notification Icon 

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bx bx-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bx bx-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bx bx-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bx bx-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul>

        </li> -->

       <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
             <i class='bx bx-chat' ></i>
            <span class="badge bg-success badge-number">3</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul>

        </li> -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?=Assests("img/avatar/")?><?=$get->id()?>/<?=$get->avatar()?>" alt="Profile" class="rounded-circle">
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">


            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=routerConfig()."/app/perfil"?>">
                <i class="bx bx-person"></i>
                <span>Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=routerConfig()?>/app/perfil/trocar/senha">
                <i class="bx bx-gear"></i>
                <span>Alterar Senha</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!--<li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bx bx-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>-->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=routerConfig()?>/sair">
                <i class="bx bx-box-arrow-right"></i>
                <span>Sair</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <!--<li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bx bx-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
        <i class='bx bxs-home'></i>
          <span>Home</span>
        </a>
      </li>
      </li>-->



      <li class="nav-item">
        <a class="nav-link " data-bs-target="#cliente" data-bs-toggle="collapse" href="#">
        <i class='bx bxs-user-circle'></i><span>Cliente</span><i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <ul id="cliente" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li class="nav-item">
              <a href="<?=routerConfig()?>/app/perfil "  >
              <i class='bx bxs-user-circle'></i> <span>Perfil</span>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?=routerConfig()?>/app/agenda/confirmar/presenca"  href="#">
                <i class='bx bxs-check-shield'></i><span>Confirmar Presença</span>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?=routerConfig()?>/app/agenda/cancelar/presenca"  href="#">
                <i class='bx bxs-message-alt-x'></i><span>Cancelar Presença</span>
              </a>
            </li>


            <li class="nav-item">
              <a href="<?=routerConfig()?>/app/atendimento/avaliar"  href="#">
              <i class='bx bx-clipboard'></i><span>Avaliar Atendimento</span>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?=routerConfig()?>/sair"  href="#">
              <i class='bx bx-clipboard'></i><span>Sair</span>
              </a>
            </li>

        </ul>
      </li>


  <?php 
  if($nivel == 1):
  ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#edit-user" data-bs-toggle="collapse" href="#">
        <i class='bx bxs-id-card'></i><span>Admin</span><i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <ul id="edit-user" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=routerConfig()?>/app/admin/solicitacoes/acesso/barbeiro">
              <i class="bx bx-circle"></i><span>Solicitações de Acesso </span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="bx bx-circle"></i><span>Usuários</span>
            </a>
          </li>


          <li>
            <a href="#">
              <i class="bx bx-circle"></i><span>Alterar Dados de login</span>
            </a>
          </li>

        
        </ul>
      </li>

  <?php 
    endif;
  ?>     


  <?php 
  if($nivel == 3):
  ?>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#barbearia" data-bs-toggle="collapse" href="#">
        <i class='bx bx-map'></i></i><span>Barbearia</span><i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <ul id="barbearia" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=routerConfig()?>/app/barbearia/perfil/<?=$token?>">
              <i class="bx bx-circle"></i><span>Perfil</span>
            </a>
          </li>

          <li>
            <a href="<?=routerConfig()?>/app/barbearia/configuracao/<?=$token?>">
              <i class="bx bx-circle"></i><span>Configuração</span>
            </a>
          </li>

          <li>
            <a href="<?=routerConfig()?>/app/barbearia/atendimento/cadastro/horarios/<?=$token?>">
              <i class="bx bx-circle"></i><span>Horarios de atendimento</span>
            </a>
          </li>

          <li>
            <a href="<?=routerConfig()?>/app/barbearia/servicos/<?=$token?>">
              <i class="bx bx-circle"></i><span>Serviços</span>
            </a>
          </li>




        </ul>
      </li>


  <?php 
  endif;
  ?>
      
    <?php 
     if($nivel == 2):
    ?>  
      <li class="nav-item">
        <a href="<?=routerConfig()?>/app/solicitar/acesso/barbeiro" class="nav-link collapsed" href="#">
        <i class='bx bxs-lock-open'></i>
          <span>Solicitar acesso</span>
        </a>
      </li>
      <?php 
       endif; 
      ?>

      <li class="nav-item">
        <a href="<?=routerConfig()?>/app/procurar" class="nav-link collapsed" href="#">
        <i class='bx bx-map'></i>
         <span>Procurar</span>
        </a>
      </li>

     




      <!-- End Charts Nav -->


      <!--<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#empresa" data-bs-toggle="collapse" href="#">
        <i class='bx bx-buildings'></i><span>Empresa</span><i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <ul id="empresa" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bx bx-circle"></i><span>Cadastrar sua empresa</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bx bx-circle"></i><span>Entra na empresa</span>
            </a>
          </li>


        </ul>
      </li>-->


      <!--<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#suporte" data-bs-toggle="collapse" href="#">
        <i class='bx bxs-comment-detail'></i><span>Suporte</span><i class="bx bx-chevron-down ms-auto"></i>
        </a>
        <ul id="suporte" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="#">
              <i class="bx bx-circle"></i><span>Relatar problema</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="bx bx-circle"></i><span>Ajuda</span>
            </a>
          </li>

        </ul>
      </li>--><!-- End Charts Nav -->


      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#">
         <i class='bx bxs-message-check'></i>
          <span>Tire suas dúvidas</span>
        </a>
      </li>--><!-- End Dashboard Nav -->



    </ul>

  </aside><!-- End Sidebar-->


  <main id="main" class="main">
    <?=$this->section('content')?>
  </main>


    <!-- Vendor JS Files -->
  <script src="<?=Assests("assets/vendor/apexcharts/apexcharts.min.js")?>"></script>
  <script src="<?=Assests("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
  <script src="<?=Assests("assets/vendor/chart.js/chart.umd.js")?>"></script>
  <script src="<?=Assests("assets/vendor/echarts/echarts.min.js")?>"></script>
  <script src="<?=Assests("assets/vendor/quill/quill.min.js")?>"></script>
  <script src="<?=Assests("assets/vendor/simple-datatables/simple-datatables.js")?>"></script>
  <script src="<?=Assests("assets/vendor/tinymce/tinymce.min.js")?>"></script>
  <script src="<?=Assests("assets/vendor/php-email-form/validate.js")?>"></script>

  <!-- Template Main JS File -->
  <script src="<?=Assests("assets/js/main.js")?>"></script>
</body>
</html>
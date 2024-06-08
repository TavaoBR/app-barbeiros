<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?=Assests("outros/libs/css/bootstrap.min.css")?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Tela de login</title>
</head>
<body>


<section class="background-radial-gradient overflow-hidden">
  <style>
     body{
      background-color: hsl(218, 41%, 15%);
      background-image: 
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
     } 



    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>


 

  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
  
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          App Barbeiros <br />
          <span style="color: hsl(218, 81%, 75%)">Tela Login</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          Por favor entre com seu usuario e senha para entrar no sistema. Em caso de problema, entre em contato com o suporte
          E-mail: suporteimaginario@gmail.com
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative py-5">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form action="<?=routerConfig()?>/login" method="POST">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <?=validateSession("Mensagem")?>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="usuario" value="<?=validateSession("userForm")?>" id="form3Example3" class="form-control" />
                <label class="form-label" for="form3Example3">Usuario</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="senha" value="<?=validateSession("senhaForm")?>" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">Senha</label>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">
                Logar
              </button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script src="<?=Assests("outros/libs/js/jquery-3.3.1.slim.min.js")?>"></script>
<script src="<?=Assests("outros/libs/js/popper.min.js")?>"></script>
<script src="<?=Assests("outros/libs/js/bootstrap.min.js")?>"></script>
<script src="<?=Assests("outros/libs/js/jquery-3.3.1.min.js")?>"></script>
<script src="<?=Assests("outros/libs/js/jquery.mask.js")?>"></script>



</body>
</html>
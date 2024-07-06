<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<?php 



$pontos = 15236;
$pontosFormatados = formatarNumero($pontos);


?>

<style>
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>


<div class="container-fluid">
    <div class="main-body">
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?=Assests("img/avatar/$id/$avatar")?>" id="imagePreview" alt="Sem avatar" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?=$nome?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            

            <div class="col-md-8">
              <?=validateSession("MessageUpdate")?>
            <form action="<?=routerConfig()?>/usuario/atualizar/info/<?=getSession("id")?>" method="POST" enctype="multipart/form-data">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome de usuario</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="usuario" class="form-control" value="<?=$usuario?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="nome" class="form-control" value="<?=$nome?>" required>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Senha <i class="fa-solid fa-eye text-primary" id="visualizarSenha" onclick="toggleSenhaVisibility()" style="cursor:pointer"></i></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">  
                      <input type="password"  class="form-control" value="<?=$senha?>" id="senha" readonly>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="email" name="email" class="form-control" value="<?=$email?>" required> 
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Celular</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="celular" id="celular" class="form-control" value="<?=$celular?>" required>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Avatar</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="file" name="avatar" class="form-control" accept="image/*" id="fileInput">
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn btn-info "  type="submit">Salvar</button>
                      <a class="btn btn-danger " href="<?=routerConfig()?>/app/perfil/trocar/senha">Trocar senha</a>
                    </div>
                  </div>
                </div>
              </div>
              </form>
            </div>

            

          </div>

        </div>
    </div>

    <script>

        $('#celular').mask("+9999999999999");

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });


        function toggleSenhaVisibility() {
        var senhaInput = document.getElementById("senha");
        var visualizarSenhaIcon = document.getElementById("visualizarSenha");

        if (senhaInput.type === "password") {
            senhaInput.type = "text";
            visualizarSenhaIcon.classList.remove("fa-eye");
            visualizarSenhaIcon.classList.add("fa-eye-slash");
        } else {
            senhaInput.type = "password";
            visualizarSenhaIcon.classList.remove("fa-eye-slash");
            visualizarSenhaIcon.classList.add("fa-eye");
        }
    }
    </script>




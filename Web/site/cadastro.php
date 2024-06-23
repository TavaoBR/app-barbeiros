<?=$this->layout('themes/site', ['title' => $title]);?>


<style>
    body{
    margin-top: 120px;
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
                    <img src="" id="imagePreview" alt="Sem avatar"  width="150">
                    <div class="mt-3">
                      <h4>Prévia do avatar</h4>
                    </div>
                  </div>
                </div>

                
                            <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label text-center" for="billing-email-address">A senha precisa conter os seguintes comportamentos</label>
                                        <ul style="list-style:none;">
                                            <li ><i class="fa-solid fa-xmark text-danger" id="minimoChar"></i> Precisa conter no minimo 8 caracteres </li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="numero"></i> Precisa conter número de 1 até 9</li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="maiuscula"></i> Precisa conter uma letra Maiúscula (A ... Z)</li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="minuscula"></i> Precisa conter letras Minúsculas (a ... z)</li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="simbolo"></i> Precisa conter caracter especial (@ ou ! ou & ou ?)</li>
                                        </ul>
                                    </div>
                                </div>
              </div>
            </div>

            

            <div class="col-md-8">
              <?=validateSession("MessageRegister")?>
            <form action="<?=routerConfig()?>/usuario/cadastrar" method="POST" enctype="multipart/form-data">
              <div class="card mb-3">
                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="nome" class="form-control"  >
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome de usuario</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="usuario" class="form-control" >
                    </div>
                  </div>


                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Senha</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" name="senha" class="form-control" onkeyup="validaSenha(this.value)" id="senha">
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Confirme Senha</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="password" name="confirmaSenha" class="form-control" id="confirmaSenha" >
                    </div>
                  </div>
                  <hr>


                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="email" name="email" class="form-control" > 
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Celular</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="celular" id="celular" class="form-control" >
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
                       <button class="btn btn-success"  type="submit">Salvar</button>
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

        $('#celular').mask("99 9 9999-9999");

        document.getElementById('fileInput').addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (file) {
              // Verifica o tamanho do arquivo
              const maxSizeInMB = 2;
              const maxSizeInBytes = maxSizeInMB * 1024 * 1024;
              
              if (file.size > maxSizeInBytes) {
                  alert('O arquivo é muito grande. O tamanho máximo permitido é de 2 MB.');
                  return;
              }

              const reader = new FileReader();
              reader.onload = function(e) {
                  const imagePreview = document.getElementById('imagePreview');
                  imagePreview.src = e.target.result;
                  imagePreview.style.display = 'block';
              }
              reader.readAsDataURL(file);
          }
      });


      let minimoChar = document.getElementById("minimoChar");
    let numero = document.getElementById("numero");
    let maiuscula = document.getElementById("maiuscula");
    let minuscula = document.getElementById("minuscula");
    let simbolo =   document.getElementById("simbolo");

    function validaSenha(password){
       
        const caracteres = new RegExp('^(?=.*.{8,})');
        const number = new RegExp('(?=.*[0-9])');
        const upper = new RegExp('(?=.*[A-Z])');
        const lower = new RegExp('(?=.*[a-z])');
        const symbol = new RegExp('(?=.*[!@#\$%\^&\*])');

        if(caracteres.test(password)){
           minimoChar.classList.remove("fa-xmark", "text-danger");
           minimoChar.classList.add("fa-circle-check", "text-success");
        }else{
          minimoChar.classList.add("fa-xmark", "text-danger");
          minimoChar.classList.remove("fa-circle-check", "text-success");
        }

        if(lower.test(password)){
            minuscula.classList.remove("fa-xmark", "text-danger");
            minuscula.classList.add("fa-circle-check", "text-success");
        }else{
            minuscula.classList.add("fa-xmark", "text-danger");
            minuscula.classList.remove("fa-circle-check", "text-success");
        }

        if(number.test(password)){
            numero.classList.remove("fa-xmark", "text-danger");
            numero.classList.add("fa-circle-check", "text-success");
        }else{
            numero.classList.add("fa-xmark", "text-danger");
            numero.classList.remove("fa-circle-check", "text-success");
        }

        if(upper.test(password)){
            maiuscula.classList.remove("fa-xmark", "text-danger");
            maiuscula.classList.add("fa-circle-check", "text-success");
        }else{
            maiuscula.classList.add("fa-xmark", "text-danger");
            maiuscula.classList.remove("fa-circle-check", "text-success");
        }

        if(symbol.test(password)){
          simbolo.classList.remove("fa-xmark", "text-danger");
          simbolo.classList.add("fa-circle-check", "text-success");
        }else{
          simbolo.classList.add("fa-xmark", "text-danger");
          simbolo.classList.remove("fa-circle-check", "text-success");
        }

      }


    </script>
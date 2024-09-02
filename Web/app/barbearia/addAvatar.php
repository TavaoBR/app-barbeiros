<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<style>
    .img-account-profile {
    height: 15rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>


<div class="container-xl px-4 mt-4">

    <div class="row">
    <?=validateSession("MessageAvatarB")?>
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Avatar</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <center><img class="img-account-profile rounded-circle mb-2 " src="" id="imagePreview" alt="" width="300"></center>
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">A iamgem deve conter tamanho de até 5 MB</div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Form</div>
                <div class="card-body">
                    <form method="POST" id="confirmationForm" action="<?=routerConfig()?>/barbeiro/perfil/avatar/<?=$id?>" enctype="multipart/form-data">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="customFile">Procurar Imagem</label>
                            <input class="form-control"  accept="image/*" id="customFile" type="file" name="avatar">
                        </div>
                        <button class="btn btn-primary" id="submitButton" onclick="handleSubmit()">Upload Avatar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        document.getElementById('customFile').addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (file) {
              // Verifica o tamanho do arquivo
              const maxSizeInMB = 5;
              const maxSizeInBytes = maxSizeInMB * 1024 * 1024;
              
              if (file.size > maxSizeInBytes) {
                  alert('O arquivo é muito grande. O tamanho máximo permitido é de 5 MB.');
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
</script>

<script>
    function handleSubmit() {
        const submitButton = document.getElementById('submitButton');
        submitButton.setAttribute('disabled', 'disabled');
        // Exibe o SweetAlert de carregamento
        Swal.fire({
            title: 'Enviando Requisição',
            text: 'Por favor, aguarde.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Aguarda 2 segundos antes de enviar o formulário
        setTimeout(() => {
            // Fecha o SweetAlert
            Swal.close();

            // Envia o formulário manualmente
            const form = document.getElementById('confirmationForm');
            form.submit();
        }, 2000); // 2000 milissegundos = 2 segundos
    }
</script>
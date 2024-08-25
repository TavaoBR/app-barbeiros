
<?=$this->layout('themes/site', ['title' => $title]);?>

<style>
    body {
        margin-top: 20px;
    }

    .mail-seccess {
        text-align: center;
        background: #fff;
        border-top: 1px solid #eee;
    }

    .mail-seccess .success-inner {
        display: inline-block;
    }

    .mail-seccess .success-inner h1 {
        font-size: 100px;
        text-shadow: 3px 5px 2px #3333;
        color: #006DFE;
        font-weight: 700;
    }

    .mail-seccess .success-inner h1 span {
        display: block;
        font-size: 25px;
        color: #333;
        font-weight: 600;
        text-shadow: none;
        margin-top: 20px;
    }

    .mail-seccess .success-inner p {
        padding: 20px 15px;
    }

    .mail-seccess .success-inner .btn {
        color: #fff;
    }
    </style>

<?=validateSession("Mensagem")?>
<section class="mail-seccess section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <!-- Error Inner -->
                    <div class="success-inner">
                        <h1><i class="fa fa-envelope"></i><span>Olá <?=$usuario?></span></h1>
                        <p>Clique no botão para recuperar sua conta, após esse processo, enviaremos uma nova senha de acesso para você</p>
                        <p>Após acessar, atualize a senha para a de seu desejo</p>
                        <form  method="POST" action="<?=routerConfig()?>/usuario/recuperar/conta/<?=$id?>">
                            <button id="submitButton" type="button" onclick="handleSubmit()"  class="btn btn-primary btn-lg">Recuperar Conta</button>
                            </form>
                    </div>
                    <!--/ End Error Inner -->
                </div>
            </div>
        </div>
    </section>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>

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
        }, 2000);
		
		// 2000 milissegundos = 2 segundos
    }
</script>
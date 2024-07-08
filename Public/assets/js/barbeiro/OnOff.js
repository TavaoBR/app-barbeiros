function FicarOnline(id)
{
    Swal.fire({
        title: 'Aguarde',
        text: 'Estamos enviando sua requisição...',
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        const requestUrl = `${url}/barbeiro/online/${id}`;
        console.log("Request URL:", requestUrl); // Verificar a URL

        $.ajax({
            url: requestUrl,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                Swal.close();

                console.log("Response:", response); // Logar a resposta completa

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: response.message
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: response.message
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.close();

                console.log("AJAX error:", textStatus, errorThrown); // Logar erros do AJAX

                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao processar o request.'
                }).then(function(){
                    location.reload();
                });
            }
        });
    }, 2000);
}

function FicarOffline(id)
{

    Swal.fire({
        title: 'Aguarde',
        text: 'Estamos enviando sua requisição...',
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        const requestUrl = `${url}/barbeiro/offline/${id}`;
        console.log("Request URL:", requestUrl); // Verificar a URL

        $.ajax({
            url: requestUrl,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                Swal.close();

                console.log("Response:", response); // Logar a resposta completa

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: response.message
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: response.message
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.close();

                console.log("AJAX error:", textStatus, errorThrown); // Logar erros do AJAX

                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao processar o request.'
                }).then(function(){
                    location.reload();
                });
            }
        });
    }, 2000);

}
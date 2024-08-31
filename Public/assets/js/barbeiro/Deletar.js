function Servico(id)
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
        $.ajax({
            url: `${url}/barbeiro/servico/deletar/${id}`,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                // Fechar o SweetAlert de "Aguarde"
                Swal.close();
    
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
                // Fechar o SweetAlert de "Aguarde"
                Swal.close();
    
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: jqXHR.responseText || 'Ocorreu um erro ao processar o request.'
                }).then(function() {
                    location.reload();
                });

                // Log para diagnóstico
                console.log('Erro AJAX:', textStatus, errorThrown);
            }
        });
    }, 2000); 
}
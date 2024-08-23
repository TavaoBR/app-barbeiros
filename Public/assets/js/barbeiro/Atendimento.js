function ConfirmarAtendimento(codigo)
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
            url: `${url}/barbeiro/agenda/confirmar/${codigo}`,
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
function CancelarAtendimento(codigo)
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
        const requestUrl = `${url}/barbeiro/agenda/cancelar/${codigo}`;

        $.ajax({
            url: requestUrl,
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

function ConcluirAtendimento(codigo)
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
        const requestUrl = `${url}/barbeiro/agenda/concluir/${codigo}`;

        $.ajax({
            url: requestUrl,
            type: 'POST',
            dataType: 'json',
            success: (response) =>{
               Swal.close();

               console.log("Response:", response);
               
               if(response.success){
                  Swal.fire({
                    icon: 'success',
                    title: ''
                  }).then(() => {
                     location.reload();
                  });
               } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: response.message
                  }).then(() => {
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
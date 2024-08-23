function UpdateAndamento(id) {
    // Mostrar o SweetAlert de "Aguarde"
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
            url: `${url}/solicitacoes/acesso/barbeiro/andamento/${id}`,
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
            error: function() {
                // Fechar o SweetAlert de "Aguarde"
                Swal.close();
    
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: jqXHR.responseText || 'Ocorreu um erro ao processar o request.'
                }).then(function() {
                    location.reload();
                });

                
            }
        });


    }, 2000); 

    
}


function UpdateAprovado(id) {
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
        const requestUrl = `${url}/solicitacoes/acesso/barbeiro/aprovado/${id}`;
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



function UpdateReprovado(id)
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
            url: `${url}/solicitacoes/acesso/barbeiro/reprovado/${id}`,
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
            error: function() {
                // Fechar o SweetAlert de "Aguarde"
                Swal.close();
    
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Ocorreu um erro ao processar o request.'
                }).then(function() {
                    location.reload();
                });
            }
        });


    }, 2000); 
}
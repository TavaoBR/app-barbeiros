<?php 

function validateUser(){
    if(!getSession("id") && !getSession("token")){
     setSession("Mensagem", sweetAlertError("Acesso Restrito"));
     redirect(routerConfig()."/login");
     exit();
    }
 }


function avatarUser()
{
 validateUser();   
 $get = new \Src\GET\Usuario();
 echo $get->avatar();

} 

/* function configTemaColor(){
   
    $read = new \Src\Model\Usuario\Read;

    $data = $read->userId(getSession("id"));
    $dados = $data[1];

    $tema = $dados['tema'];

    return $tema;
    
 }*/
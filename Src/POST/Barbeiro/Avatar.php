<?php 

namespace Src\POST\Barbeiro;

use Src\Database\Model\Barbeiro;
use Src\Services\Validate;

class Avatar 
{

    private Barbeiro $barbeiro;
    private $avatar;
    private Validate $validate;

    public function __construct()
    {
        $this->barbeiro = new Barbeiro;
        $this->validate = new Validate;
        $this->avatar = $_FILES['avatar'];
    }

    public function Result($data)
    {
        session_start();
        if(!$this->request()){
           $this->upload($data['id']);
        }
    }

    private function request()
    {
       $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;
       $request = [
        "Avatar" => $avatarValue
       ]; 

       if($this->validate->validate($request) != false){

        setSession("MessageAvatarB", messageWarning($this->validate->validate($request)));
        redirectBack();
        return true;
       }

       return false;

    }

    private function upload(int $id)
    {
        $foto = $this->avatar['name'];
         $update = $this->barbeiro->update("id", $id, [
           "avatarBarbeiro" => $foto
         ]);

         if($update > 0){
            $this->createFolder($id);
            setSession("MessageAvatarB", sweetAlertSuccess("Avatar adicionado ao seu perfil com sucesso", "Upload concluido com sucesso"));
            redirectBack();
         }else{
            setSession("MessageAvatarB", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
            redirectBack();
         }
    }

    private function createFolder(int $id)
    {
        $file = $this->avatar['tmp_name'];
        $foto = $this->avatar['name'];
        $_UP['pasta'] = "Public/img/barbeiro/$id/";
        mkdir($_UP['pasta'], 0777);
        move_uploaded_file($file, $_UP['pasta'].$foto);
    }

}
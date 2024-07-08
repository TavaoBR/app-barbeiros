<?php

namespace Src\POST\Barbeiro;

class GaleriaAddImagens
{
    private $image;
    private $nameImage;
    private int $id;

    public function __construct()
    {
       $this->image = $_FILES['image']['tmp_name'];
       $this->nameImage = $_FILES['image']['name'];
       $this->id = $_POST['id'];
    }

    public function adicionar()
    {
       $id = $this->id;
       $image = $this->image;
       $nameImage = $this->nameImage;

       if(isset($nameImage)){
          $_UP['pasta'] = "Public/img/galeria/$id/";
          mkdir($_UP['pasta'], 0777);
          if(move_uploaded_file($image, $_UP['pasta'].$nameImage) === TRUE){
            echo json_encode("Sucesso");
          }else{
            echo json_encode("Error: Upload das imagens não teve exito");
          }
       }
    }


}
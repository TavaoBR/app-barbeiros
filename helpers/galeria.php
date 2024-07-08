<?php
 
function pegarImagens($id)
{
   $host = routerConfig(); 
   $path = "Public/img/galeria/$id/";

   if(is_dir($path)){
       if($open = opendir($path)){
         while(false !== ($arquivo = readdir($open))){
             if($arquivo != "." && $arquivo != ".."){
                $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
                if(in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'gif'])){
                  echo "
                  <li>
                     <a href='$host/$path$arquivo' target='blank'><img src='$host/$path$arquivo' alt='btman' class='img-portrait' /></a>    
                  </li>  
                ";
                }
             }
         }  
         closedir($open);
       }else{ 
          echo "Nenhuma imagem encontrada";
       }
   }else{
     echo "Nenhuma imagem encontrada";
   }
}

function totalGaleria($id)
{
    $path = "Public/img/galeria/$id/";
    
    if(is_dir($path)){
        if($open = opendir($path)){
           $total = 0;
             while(false !== ($arquivo = readdir($open))){
                if($arquivo != "." && $arquivo != ".."){
                    $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
                    if(in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'gif'])){
                       $total++;
                    }
                }

             }
            echo $total;
        }else{
           echo "0";
        }
    }else{
       echo "0";
    }
}
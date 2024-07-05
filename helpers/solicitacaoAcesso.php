<?php 

function colorStatusAcesso($status)
{

    switch($status){
        case 1:
         case 2:
           echo  "primary";
        break;   
       
       case 3:
         echo "success";
       break;
       
       case 4:
         case 5:
           echo  "danger";
       break;    
 
     }
    
}

function tipoStatusAcesso($status)
{

    switch($status){
        case 1:
           echo "Solicitado";
        break;
        
        case 2: 
           echo  "Em Andamento";
        break;
        
        case 3:
           echo  "Aprovado";
        break;   
   
        case 4:
           echo "Reprovado";
        break;   
   
        case 5:
          echo "Cancelado";
        break;   
    }

}
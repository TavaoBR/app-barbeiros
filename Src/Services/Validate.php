<?php 

namespace Src\Services;

class Validate 
{

    public function validate(array $request)
    {

        $html = "<ol>"; 
        
        $camposEmBranco = false;
        
        foreach($request as $data => $value){
         
            if(!isset($value) || empty($value)){
                $camposEmBranco = true;
                $html .= "
                    <li>O CAMPO <strong>'$data'</strong> está em branco. Por favor, preencha esse campo.<br></li>
                ";
            }
        }

        $html .= "</ol>";

        if($camposEmBranco){
            
            return $html;
        }
            
        
        return false;

    }

}
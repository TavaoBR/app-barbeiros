<?php 

function activeMenu($data)
{
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Compara o caminho atual com o caminho passado como argumento
    if ($currentPath === $data) {
        echo ""; // Não exibe "collapsed"
    } else {
        echo "collapsed";
    }
} 


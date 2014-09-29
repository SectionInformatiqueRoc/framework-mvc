<?php


if(!empty($_POST)){
    $params=$_POST;
}else{
    $params=$_GET;
}

$nomControleur = '\\Blog\C\\'.$params['controleur'];
$nomAction = $params['action'];

unset($params['controleur'],$params['action']);

function __autoload($class){
    $class= strtolower($class);
    $class = str_replace('\\', '/', $class);
    
    include('/var/www/blog/'.$class.'.php');
}


$objetControleur = new $nomControleur();
$objetControleur->$nomAction($params);
<?php
header('Content-Type: text/html; charset=utf-8');

$session=MVC\Session::getInstance();

//test of the connexion
if(!empty($_POST)){
    $params=$_POST;
}else{
    $params=$_GET;
}

//the params of the connexion is valid
//the connexion is autorized
if(empty($params))
{
    $params['controleur'] = Blog\Params\Appli::controleurparDefaut;
    $params['action'] = Blog\Params\Appli::actionParDefaut;
}

$nomControleur = '\\Blog\C\\'.$params['controleur'];
$nomAction = $params['action'];

unset($params['controleur'],$params['action']);

//For call the great function
function __autoload($class){
    $class= strtolower($class);
    $class = str_replace('\\', '/', $class);
    
    include('/var/www/blog/'.$class.'.php');
}


$objetControleur = new $nomControleur();
$objetControleur->$nomAction($params);
<?php


$nomControleur = '\\Blog\C\\'.$_GET['controleur'];
$nomAction = $_GET['action'];

function __autoload($class){
    $class= strtolower($class);
    $class = str_replace('\\', '/', $class);
    
    include('/var/www/blog/'.$class.'.php');
}

$objetControleur = new $nomControleur();
$objetControleur->$nomAction();
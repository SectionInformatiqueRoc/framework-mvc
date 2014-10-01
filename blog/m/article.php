<?php
namespace Blog\M;

class Article extends \MVC\Table{
    
    
    function getTable(){
        return 'article';
    }
    
    
    function listeDerniersArticles(){
        
        return  \MVC\Connexion::query(
                'select * from article order by dateCreation desc limit 0,5', 
                array()
                );
        
    }

    function listePremiersArticles(){
        return  \MVC\Connexion::query(
                'select * from article order by dateCreation asc limit 0,5', 
                array()
                );        
    }
    
    function listeTousArticles(){
        return  \MVC\Connexion::query(
                'select * from article order by dateCreation', 
                array()
                );        
    }
    
}

























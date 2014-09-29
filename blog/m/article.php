<?php
namespace Blog\M;

class Article extends \MVC\Table{
    
    function getTable(){
        return 'article';
    }
    
    
    function listeDerniersArticles(){
        $query = 'select * from article order by dateCreation desc limit 0,5';
        $connexion = new \MVC\Connexion();
        $queryPrepare = $connexion->prepare($query);
        $queryPrepare->execute();
        //return a table with Article objects
        $articles = $queryPrepare->fetchAll(\PDO::FETCH_CLASS,__CLASS__);
        return $articles;
    }
    
}

























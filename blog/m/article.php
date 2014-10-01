<?php
namespace Blog\M;

class Article extends \MVC\Table{
    
    
    function getTable(){
        return 'article';
    }
    
    function getClassRow() {
        return '\Blog\M\ArticleRow';
    }
    
    function listeDerniersArticles(){
        return $this->where('1 order by dateCreation desc limit 0,5');
    }

    
    function listeTousArticles(){
        return $this->getAll('dateCreation');
    }
    
}

























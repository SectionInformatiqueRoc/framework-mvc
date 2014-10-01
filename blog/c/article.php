<?php

namespace Blog\C;

class Article {

    function listeDerniersArticles($params) {
        //lien vers Model
        $article = new \Blog\M\Article();
        $derniersArticles = $article->listeDerniersArticles();
        //envoyer vers la vue
        include('/var/www/blog/blog/v/article/listederniersarticles.php');
    }

    function afficher($params) {
        $article = new \Blog\M\Article();
        $articleAAfficher = $article->get($params['id']);

        include('/var/www/blog/blog/v/article/afficher.php');
    }

    function formulaire($params) {
        $article = new \Blog\M\Article();
        $articleAAfficher = $article->get($params['id']);

        include('/var/www/blog/blog/v/article/formulaire.php');
    }
    
    function modifier($params){
        $article = new \Blog\M\Article();
        $articleAModifier = $article->get($params['id']);
        
        $articleAModifier->titre=$params['titre'];
        $articleAModifier->texte=$params['texte'];
        $articleAModifier->tags=$params['tags'];
        $articleAModifier->dateModification=date('Y-m-d');
        $articleAModifier->store();
        
        if($params['submit']=='Enregistrer'){
            $this->afficher($params);
        }else{
            $this->formulaire($params);
        }        
    }
    
    function ajouterCommentaire($params){
        $article = new \Blog\M\Article();
        $articleAModifier = $article->get($params['id']);

        $articleAModifier->addCommentaire($params['texte'],$params['auteur']);
        $this->afficher($params);
    }
}


























































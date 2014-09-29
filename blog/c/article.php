<?php

namespace Blog\C;

class Article {

    function listeDerniersArticles() {
        //lien vers Model
        $article = new \Blog\M\Article();
        $derniersArticles = $article->listeDerniersArticles();
        //envoyer vers la vue
        include('/var/www/blog/blog/v/article/listederniersarticles.php');
    }

    function afficher() {
        $article = new \Blog\M\Article();
        $articleAAfficher = $article->get($_GET['id']);

        include('/var/www/blog/blog/v/article/afficher.php');
    }

    function formulaire() {
        $article = new \Blog\M\Article();
        $articleAAfficher = $article->get($_GET['id']);

        include('/var/www/blog/blog/v/article/formulaire.php');
    }
    function modifier(){
        $article = new \Blog\M\Article();
        $articleAModifier = $article->get($_GET['id']);
        
        $articleAModifier->titre=$_GET['titre'];
        $articleAModifier->texte=$_GET['texte'];
        $articleAModifier->dateModification=date('Y-m-d');
        $articleAModifier->tags=$_GET['tags'];
        $articleAModifier->store();
        
        if($_GET['submit']=='Enregistrer'){
            $this->afficher();
        }else{
            $this->formulaire();
        }
        
    }
}


























































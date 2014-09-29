<?php
foreach ($derniersArticles as $article){
    echo' <h1><a href="index.php?controleur=Article&action=afficher&id=',$article->id,'">',$article->titre,'</a></h1>';
    echo '<p>',substr($article->texte,0,10),'</p>';
}
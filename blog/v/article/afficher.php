<?php
var_dump($articleAAfficher);
echo '<h1>',$articleAAfficher->titre,'</h1>';
echo '<a href="index.php?controleur=Article&action=formulaire&id=',$articleAAfficher->id,'">Modifier</a>';
echo '<p>',nl2br($articleAAfficher->texte),'</p>'; //nl2br convert \n into <br />
echo '<p>',implode(' - ',$articleAAfficher->getTagsLabel()),'</p>'; 
?>
<a href="index.php?controleur=Article&action=listeDerniersArticles">Retour</a>

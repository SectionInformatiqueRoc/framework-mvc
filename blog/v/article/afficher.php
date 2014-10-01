<?php
echo '<h1>',$articleAAfficher->titre,'</h1>';
echo '<a href="index.php?controleur=Article&action=formulaire&id=',$articleAAfficher->id,'">Modifier</a>';
echo '<p>',nl2br($articleAAfficher->texte),'</p>'; //nl2br convert \n into <br />
echo '<p>',implode(' - ',$articleAAfficher->getTagsLabel()),'</p><hr />'; 

    $commentaires=$articleAAfficher->getCommentaires();
    foreach ($commentaires as $comm) {
        echo '<p>',$comm->texte,'</p>';
        echo '<i>',$comm->auteur,' ',$comm->date,'</i><hr>';
    }
?>
<form action="index.php" method="GET">
    <input type="hidden" name="controleur" value="Article">
    <input type="hidden" name="action" value="ajouterCommentaire">
    <input type="hidden" name="id" value="<?php echo $articleAAfficher->id; ?>">
    Ajouter un commentaire :<br />
    <textarea name="texte"></textarea><br />
    Auteur<input type="text" name="auteur"><br />
    <input type="submit" name="submit" value="Enregistrer">
</form>
        
<a href="index.php?controleur=Article&action=listeDerniersArticles">Retour</a>

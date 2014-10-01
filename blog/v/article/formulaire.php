<form action="index.php" method="GET">
    <input type="hidden" name="controleur" value="Article">
    <input type="hidden" name="action" value="modifier">
    <input type="hidden" name="id" value="<?php echo $articleAAfficher->id; ?>">
    Titre : <input type="text" name="titre" value="<?php echo $articleAAfficher->titre; ?>">
    <br />
    Texte : <textarea name="texte"><?php echo $articleAAfficher->texte; ?></textarea>
    <br />
    Tags : <input type="text" name="tags" value="<?php echo implode(', ',$articleAAfficher->getTagsLabel());?>">
    <br />
    <input type="submit" name="submit" value="Enregistrer">
    <input type="submit" name="submit" value="Enregistrer sans quitter">

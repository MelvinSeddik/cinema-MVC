<?php

ob_start();

$genre = $genre->fetch(PDO::FETCH_ASSOC);
?>

<form action="./index.php?action=editGenre&id=<?=$genre["id"]?>" method="POST" class="margin-center">

    <h2>Modifier un genre</h2>

    <div class="form-group">
        <label for="libelle">Nom du genre </label>
        <input type="text" class="form-control" id="libelle" name="libelle" value="<?=$genre["libelle"];?>" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Modifier</button>

</form>

<?php

$titre = "Modifier un genre";
$contenu = ob_get_clean();
require "views/template.php"; 

?>
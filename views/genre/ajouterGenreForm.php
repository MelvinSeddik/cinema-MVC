<?php

ob_start();


?>

<form action="./index.php?action=ajouterGenre" method="POST" class="margin-center">

    <h2>Ajouter un genre</h2>

    <div class="form-group">
        <label for="prenom_real">Nom du genre </label>
        <input type="text" class="form-control" id="personnage" name="libelle" placeholder="nom du genre" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Ajouter</button>

    <?php
    if(isset($ajoutGenre)){
        echo "<span class='alert alert-success center'>Le genre ".$libelle." a été ajouté avec succès!</span>";
    }
    ?>
</form>

<?php

$titre = "Ajouter un genre";
$contenu = ob_get_clean();
require "views/template.php"; 
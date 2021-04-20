<?php

ob_start();


?>

<form action="./index.php?action=ajouterRole" method="POST" class="margin-center">

    <h2>Ajouter un rôle</h2>

    <div class="form-group">
        <label for="prenom_real">Nom du rôle </label>
        <input type="text" class="form-control" id="personnage" name="personnage" placeholder="Dark Vador" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Ajouter</button>

    <?php
    if(isset($ajoutRole)){
        echo "<span class='alert alert-success center'>Le rôle ".$personnage." a été ajouté avec succès!</span>";
    }
    ?>
</form>

<?php

$titre = "Ajouter un rôle";
$contenu = ob_get_clean();
require "views/template.php"; 
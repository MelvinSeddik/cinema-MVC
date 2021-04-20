<?php

ob_start();


?>

<form action="./index.php?action=ajouterActeur" method="POST" class="margin-center">

    <h2>Ajouter un acteur</h2>

    <div class="form-group">
        <label for="prenom_acteur">Prénom : </label>
        <input type="text" class="form-control" id="prenom_acteur" name="prenom_acteur" placeholder="John" required>
    </div class="form-group">

    <div class="form-group">
        <label for="nom_acteur">Nom : </label>
        <input type="text" class="form-control" id="nom_acteur" name="nom_acteur" placeholder="Doe" required>
    </div class="form-group">

    <div class="form-group">
        <label for="sexe_acteur">Sexe :</label>
        <input type="text" class="form-control" id="sexe_acteur" name="sexe_acteur" placeholder="H" required>
    </div class="form-group">

    <div class="form-group">
        <label for="naissance_acteur">Date de naissance : </label>
        <input type="date" class="form-control" id="naissance_acteur" name="naissance_acteur" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Ajouter</button>

    <?php
    if(isset($ajoutActeur)){
        echo "<span class='alert alert-success center'>L'acteur ".$prenom." ".$nom." a été ajouté avec succès!</span>";
    }
    ?>
</form>

<?php

$titre = "Ajout Acteur";
$contenu = ob_get_clean();
require "views/template.php"; 
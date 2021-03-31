<?php

ob_start();


?>

<form action="./index.php?action=ajouterRealisateur" method="POST" class="margin-center">

    <h2>Ajouter un réalisateur</h2>

    <div class="form-group">
        <label for="prenom_real">Prénom : </label>
        <input type="text" class="form-control" id="prenom_real" name="prenom_real" placeholder="John" required>
    </div class="form-group">

    <div class="form-group">
        <label for="nom_real">Nom : </label>
        <input type="text" class="form-control" id="nom_real" name="nom_real" placeholder="Doe" required>
    </div class="form-group">

    <div class="form-group">
        <label for="sexe_real">Sexe :</label>
        <input type="text" class="form-control" id="sexe_real" name="sexe_real" placeholder="H" required>
    </div class="form-group">

    <div class="form-group">
        <label for="naissance_real">Date de naissance : </label>
        <input type="text" class="form-control" id="naissance_real" name="naissance_real" placeholder="aaaa-mm-jj" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Ajouter</button>

    <?php
    if(isset($ajoutReal)){
        echo "<span class='alert alert-success center'>Le réalisateur ".$prenom." ".$nom." a été ajouté avec succès!</span>";
    }
    ?>
</form>

<?php

$titre = "Ajout Réalisateur";
$contenu = ob_get_clean();
require "views/template.php"; 
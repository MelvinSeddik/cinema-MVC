<?php

ob_start();

if(isset($_GET["id"])){
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
}

$acteur = $acteur->fetch();

?>

<form action="./index.php?action=editActeur&id=<?=$id?>" method="POST" class="margin-center">

    <h2>Modifier l'acteur</h2>

    <div class="form-group">
        <label for="prenom_acteur">Prénom : </label>
        <input type="text" class="form-control" id="prenom_acteur" name="prenom_acteur" value="<?=$acteur["prenom"]?>" required>
    </div class="form-group">

    <div class="form-group">
        <label for="nom_acteur">Nom : </label>
        <input type="text" class="form-control" id="nom_acteur" name="nom_acteur" value="<?=$acteur["nom"]?>" required>
    </div class="form-group">

    <div class="form-group">
        <label for="sexe_acteur">Sexe :</label>
        <input type="text" class="form-control" id="sexe_acteur" name="sexe_acteur" value="<?=$acteur["sexe"]?>" required>
    </div class="form-group">

    <div class="form-group">
        <label for="naissance_acteur">Date de naissance : </label>
        <input type="text" class="form-control" id="naissance_acteur" name="naissance_acteur" value="<?=$acteur["dateNaissance"]?>" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Modifier</button>

</form>

<?php

$titre = "Ajout Acteur";
$contenu = ob_get_clean();
require "views/template.php"; 
?>
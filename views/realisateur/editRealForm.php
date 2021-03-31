<?php

ob_start();

if(isset($_GET["id"])){
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
}

$real = $realisateur->fetch();
?>

<form action="./index.php?action=editReal&id=<?=$id?>" class="margin-center" method="POST">

    <h2>Modifier le réalisateur</h2>
    <div class="form-group">
        <label for="prenom_real">Prénom : </label>
        <input type="text" class="form-control" id="prenom_real" name="prenom_real" placeholder="John" value="<?=$real["prenom"]?>" required>
    </div>
    <div class="form-group">
        <label for="nom_real">Nom : </label>
        <input type="text" class="form-control" id="nom_real" name="nom_real" placeholder="Doe" value="<?=$real["nom"]?>" required>
    </div>
    <div class="form-group">
        <label for="sexe_real">Sexe :</label>
        <input type="text" class="form-control" id="sexe_real" name="sexe_real" placeholder="H" value="<?=$real["sexe"]?>" required>
    </div>
    <div class="form-group">
        <label for="naissance_real">Date de naissance : </label>
        <input type="text" class="form-control" id="naissance_real" name="naissance_real" placeholder="1967-05-19" value="<?=$real["dateNaissance"]?>" required>
    </div>
      
    <button type="submit" class="btn btn-primary">Modifier</button>
    
</form>

<?php

$titre = "Modifier un réalisateur";
$contenu = ob_get_clean();
require "views/template.php"; 
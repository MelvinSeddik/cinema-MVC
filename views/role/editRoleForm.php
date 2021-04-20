<?php

ob_start();

$role = $role->fetch(PDO::FETCH_ASSOC);
?>

<form action="./index.php?action=editRole&id=<?=$role["id"]?>" method="POST" class="margin-center">

    <h2>Modifier un rôle</h2>

    <div class="form-group">
        <label for="personnage">Nom du rôle </label>
        <input type="text" class="form-control" id="personnage" name="personnage" value="<?=$role["personnage"];?>" required>
    </div class="form-group">
      
    <button type="submit" class="btn btn-primary">Modifier</button>

</form>

<?php

$titre = "Modifier un rôle";
$contenu = ob_get_clean();
require "views/template.php"; 

?>
<?php

ob_start();

if(isset($_SESSION["user"])){

    die("Vous êtes déjà connecté!");
}

$_SESSION["token"] = bin2hex(random_bytes(24)); 
    
?>

<form action="./index.php?action=login" method="POST" class="mx-auto p-5 log-form">

    <h2>Connectez-vous!</h2>

    <div class="form-group">
        <label for="email" class="required">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="mdp" class="required">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" class="form-control" required>
    </div>

    <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php

$titre = "Connexion";
$contenu = ob_get_clean();
require "views/template.php";

?>
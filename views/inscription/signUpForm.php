<?php

ob_start();

?>

<form action="./index.php?action=signUp" method="POST" class="mx-auto">

    <h2>Inscrivez-vous!</h2>

    <div class="form-group">
        <label for="nom" class="required">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="prenom" class="required">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="email" class="required">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="mdp" class="required">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="mdp2" class="required">Confirmez votre mot de passe</label>
        <input type="password" name="mdp2" id="mdp2" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<div class='container mx-auto'>
<?php
if(isset($signUpFail)){
    if($signUpFail){
        echo "<p>Vérifiez les informations saisies et réssayez.</p>";
        echo ($emailValidate) ?  "" : "<p class='text-danger'>Votre adresse e-mail est invalide <i class='fas fa-times'></i></p>";
        echo ($passwordLength) ?  "<p class='text-success'>Votre mot de passe comporte au moins 8 caractères <i class='fas fa-check'></i></p>" : "<p class='text-danger'>Votre mot de passe doit comporter au moins 8 caractères <i class='fas fa-times'></i></p>";
        echo ($passwordIdentical) ? "<p class='text-success'>Les deux mots de passe sont identiques <i class='fas fa-check'></i></p>" : "<p class='text-danger'>Les deux mots de passes ne correspondent pas <i class='fas fa-times'></i></p>";
        echo ($passwordUppercase) ? "<p class='text-success'>Votre mot de passe comporte au moins une majuscule <i class='fas fa-check'></i></p>" : "<p class='text-danger'>Votre mot de passe comporte au moins une majuscule <i class='fas fa-times'></i></p>";
        echo ($passwordLowercase) ? "<p class='text-success'>Votre mot de passe comporte au moins une minuscule <i class='fas fa-check'></i></p>" : "<p class='text-danger'>Votre mot de passe comporte au moins une minuscule <i class='fas fa-times'></i></p>";
        echo ($passwordNumber) ? "<p class='text-success'>Votre mot de passe comporte au moins un chiffre <i class='fas fa-check'></i></p>" : "<p class='text-danger'>Votre mot de passe comporte au moins un chiffre <i class='fas fa-times'></i></p>";
        echo ($passwordSpecialChars) ? "<p class='text-success'>Votre mot de passe comporte au moins un caractère spécial <i class='fas fa-check'></i></p>" : "<p class='text-danger'>Votre mot de passe comporte au moins un caractère spécial <i class='fas fa-times'></i></p>";
    }
}


?>
</div>

<?php

$titre = "Inscription";
$contenu = ob_get_clean();
require "views/template.php";

?>
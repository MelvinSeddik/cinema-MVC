<?php

ob_start();

$detailActeur = $acteur->fetch();
$filmographie = ActeurController::filmographie($detailActeur["id"]);


?>

<article class="pad5">

    <h1 class="center">Fiche de <?= $detailActeur['acteur']?></h1>

    <h2>Informations</h2>

    <ul>
        <li>Sexe : <?= $detailActeur["sexe"]?></li>
        <li>Date de naissance : <?= $detailActeur["dateNaissance"]?></li>
    </ul>

    <h2>Filmographie</h2>

    <ul>
        <?php 
        foreach($filmographie as $film){
            echo "<li><a href='index.php?action=detailFilm&id=".$film["id"]."'>".$film["titre"]."</a></li>";         
        }

        ?>
    </ul>

</article>





<?php

$acteur->closeCursor();
$titre = $detailActeur["acteur"];
$contenu = ob_get_clean();
require "views/template.php";
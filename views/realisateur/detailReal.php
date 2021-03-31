
<?php

ob_start();

$detailReal = $realisateur->fetch();
$filmographie = RealController::filmographie($detailReal["id"]);


?>

<article class="pad5">
    <h1 class="center">Fiche de <?= $detailReal['prenom']." ".$detailReal["nom"]?></h1>

    <h2>Informations</h2>
    <ul>
        <li>Prénom : <?= $detailReal["prenom"]?></li>
        <li>Nom : <?= $detailReal["nom"]?></li>
        <li>Sexe : <?= $detailReal["sexe"]?></li>
        <li>Date de naissance : <?= $detailReal["dateNaissance"]?></li>
    </ul>

    <h2>Filmographie</h2>

    <ul>
    <?php 
        foreach($filmographie as $film){
            foreach($film as $key => $value){
                if($key === "titre"){ 
                    echo "<li><a href='index.php?action=detailFilm&id=".$film["id"]."'>".$value."</a></li>";
                }  
            }
        }

        ?>
    </ul>
</article>



<?php

$realisateur->closeCursor();
$titre = $detailReal['prenom']." ".$detailReal["nom"];
$contenu = ob_get_clean();
require "views/template.php";
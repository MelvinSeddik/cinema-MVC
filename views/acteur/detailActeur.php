<?php

ob_start();

$detailActeur = $acteur->fetch(PDO::FETCH_ASSOC);

$rows = $acteur->rowCount();
if($rows === 1){
    $filmographie = $detailActeur;
}
else
{
   $filmographie = $acteur2->fetchAll(PDO::FETCH_ASSOC);
}

?>

<article class="pad5">

    <h1 class="center">Fiche de l'acteur <?= $detailActeur['acteur']?></h1>

    <h2>Informations</h2>

    <ul>
    <li>Prénom : <?= $detailActeur["prenom"]?></li>
        <li>Nom : <?= $detailActeur["nom"]?></li>
        <li>Sexe : <?= $detailActeur["sexe"]?></li>
        <li>Date de naissance : <?= $detailActeur["dateNaissance"]?></li>
    </ul>

    <h2>Filmographie</h2>

    <ul>
        <?php 
        if($rows === 1){
            echo "<li><a href='index.php?action=detailFilm&id=".$filmographie["id_film"]."'>".$filmographie["titre"]."</a> (".$filmographie["personnage"].")</li>";
        }
        else{
            foreach($filmographie as $film){
                echo "<li><a href='index.php?action=detailFilm&id=".$film["id_film"]."'>".$film["titre"]."</a> (".$film["personnage"].")</li>";         
            }
        }


        ?>
    </ul>

</article>





<?php

$acteur->closeCursor();
$acteur2->closeCursor();
$titre = $detailActeur["acteur"];
$contenu = ob_get_clean();
require "views/template.php";
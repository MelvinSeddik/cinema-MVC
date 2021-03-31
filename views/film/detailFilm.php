<?php

ob_start();

$detailFilm = $film->fetch();
$genres = FilmController::getGenres($detailFilm["id"]);
$acteurs = FilmController::getActeurs($detailFilm["id"]);


$genresArray = [];
foreach($genres as $genre){
    array_push($genresArray, "<a href='index.php?action=filmsGenre&id=".$genre["id"]."'>".$genre["libelle"]."</a>");
}

$acteursArray = [];
foreach($acteurs as $acteur){
    array_push($acteursArray, "<a href='index.php?action=detailActeur&id=".$acteur["id"]."'>".$acteur["acteur"]."</a> (".$acteur["personnage"].")");
}


?>

<article class="container detail-film">

    <h2 class="center"><?= $detailFilm["titre"]?></h2>

    <div class="flex">
        <figure class="image-film"><img src="<?= $detailFilm["imgPath"]?>" alt=""></figure>
        <div class="f-column jaround mleft">
            <p>Sortie en <?= $detailFilm["annee"]?> / durée : <?= $detailFilm["duree"]?> / genres : <?= implode($genresArray, ", ") ?></p>
            <p>De <?="<a href='index.php?action=detailRealisateur&id=".$detailFilm['id_realisateur']."'>"?><?= $detailFilm["realisateur"]?></a></p>
            <p>Avec <?= implode($acteursArray, ", ") ?></p>
            <p>Note : <?= $detailFilm["note"]?> / 5</p>
        </div>
    </div>

    <h2 class="mtop">Synopsis</h2>
    <p><?= $detailFilm["resume"]?></p>



</article>





<?php


$titre = $detailFilm["titre"];
$contenu = ob_get_clean();
require "views/template.php";

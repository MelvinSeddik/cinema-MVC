<?php

ob_start();

$best = $idBestFilms->fetchAll();
$recent = $idFilmsRecent->fetchAll();

//Récupère tous les id d'un tableau de film
function idFilmArray($array){
    $idArray = [];
    foreach ($array as $film){
        foreach($film as $key => $value){
            if($key === "id"){
            array_push($idArray, $value);
            }
        }
    }
    return $idArray;
}

//Récupère tous les genres d'un film
function getGenres($id){
    $genresArray = [];
    foreach(AccueilController::getGenresById($id) as $genres){

        array_push($genresArray, "<a href='index.php?action=filmsGenre&id=".$genres["id"]."'>".$genres["libelle"]."</a>");

    }
    return implode($genresArray, ", ");
}

function showDetails($id){
    $details = AccueilController::getDetailsById($id);//On récupére les informations d'un film via son id 
    $date = new DateTime($details["dateSortie"]); //Conversion de la date en format date pour pouvoir la formater facilement
    $note = $details["note"] + 0; //Permet de supprimer les 0 inutiles dans le cas d'un décimal entier (exemple : 4,0 deviendra 4)
    $genres = AccueilController::getGenresById($id);//Récupère les genres pour un film

    echo "
    <h5><a href='index.php?action=detailFilm&id=".$id."'>".$details["titre"]."</a></h5>
    <div class='flex acenter film-box'>
        <figure class='image-film-m mright'><img src='".$details["imgPath"]."' alt='affiche ".$details["titre"]."'></figure>
        <div class='f-column'>
            <p>Genres : ".getGenres($id)."
            <p>Année de sortie : ".date_format($date, "Y")."</p>
            <p>Note : ".$note."/5</p>
        </div>
    </div>
    ";
}




?>

<h1 class="text-center container-fluid">Page d'accueil</h1>

<main class="container row" style="width:100%;">

    <section class="col-6">
            <h2 class="center">Films les mieux notés</h2>

        <?php 
        foreach(idFilmArray($best) as $id){
            showDetails($id);
        }
        ?>

    </section >
    

    <section class="col-6">
    
        <h2 class="center">Films les plus récents</h2>

        <?php 
        foreach(idFilmArray($recent) as $id){
            showDetails($id);
        }
        ?>

    </section>

</main>






<?php

$titre = "Page d'accueil de notre site";
$contenu = ob_get_clean();
require "views/template.php";



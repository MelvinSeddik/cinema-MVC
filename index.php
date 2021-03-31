<?php

require_once "controllers/FilmController.php";
require_once "controllers/AccueilController.php";
require_once "controllers/RealController.php";
require_once "controllers/ActeurController.php";
require_once "controllers/GenreController.php";
require_once "controllers/SearchController.php";


$ctrlAccueil = new AccueilController;
$ctrlFilm = new FilmController;
$ctrlReal = new RealController;
$ctrlActeur = new ActeurController;
$ctrlGenre = new GenreController;
$ctrlSearch = new SearchController;


if(isset($_GET["id"])){
  $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
}

if(isset($_GET["search"])){
  $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_STRING);
}

if(isset($_GET['action'])){
  $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

  switch($action){
          //FILM
          case "listFilms" : $ctrlFilm->findAll(); break; //Liste des films
          case "detailFilm" : $ctrlFilm->getDetails($id); break; // Detail d'un film
          case "filmsGenre" : $ctrlGenre->findFilmsById($id); break; //Affiche les films d'un genre
          case "addFilmForm" : $ctrlFilm->addFilmForm(); break; //Formulaire pour ajouter un film
          case "addFilm" : $ctrlFilm->addFilm($_POST); break; //Execution de l'ajout du film

          //ACTEUR
          case "detailActeur" : $ctrlActeur->findOneById($id); break; // Detail d'un acteur
          case "listActeurs" : $ctrlActeur->findAll(); break; // Liste de tous les acteurs
          case "ajouterActeurForm" : $ctrlActeur->addActeurForm(); break; // Formulaire pour ajouter un acteur
          case "ajouterActeur" : $ctrlActeur->addActeur($_POST); break;
          case "editActeurForm" : $ctrlActeur->editActeurForm($id); break;
          case "editActeur" : $ctrlActeur->editActeur($id, $_POST); break;
          case "deleteActeur" : $ctrlActeur->deleteActeur($id); break;


          //REALISATEUR
          case "detailRealisateur" : $ctrlReal->findOneById($id); break; // Detail d'un réalisateur
          case "listReal" : $ctrlReal->findAll(); break; // Liste de tous les réalisateurs
          case "ajouterRealForm" : $ctrlReal->addRealForm(); break; // Formulaire pour ajouter un réalisateur
          case "ajouterRealisateur" : $ctrlReal->addReal($_POST); break; // Execution de l'ajout du réalisateur
          case "editRealForm" : $ctrlReal->editRealForm($id); break; // Formulaire pour modifier un réalisateur
          case "editReal" : $ctrlReal->editReal($id, $_POST); break; // Exécution de la modification
          case "deleteReal" : $ctrlReal->deleteReal($id); break; // Supprime un réalisateur

          //SEARCH
          case "search" : $ctrlSearch->getResult($search); break; //




  }
}

elseif(isset($_GET["submit"])){
  $submit = filter_input(INPUT_GET, "submit", FILTER_SANITIZE_STRING);
  switch($submit){

    case "Search" : $ctrlSearch->getResult($search); break;
  }
}

else{
    $ctrlAccueil->pageAccueil();
}



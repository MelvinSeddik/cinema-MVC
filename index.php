<?php

require_once "controllers/FilmController.php";
require_once "controllers/AccueilController.php";
require_once "controllers/RealController.php";
require_once "controllers/ActeurController.php";
require_once "controllers/GenreController.php";
require_once "controllers/SearchController.php";
require_once "controllers/RoleController.php";
require_once "controllers/SignUpController.php";
require_once "controllers/LogInController.php";

$ctrlAccueil = new AccueilController;
$ctrlFilm = new FilmController;
$ctrlReal = new RealController;
$ctrlActeur = new ActeurController;
$ctrlGenre = new GenreController;
$ctrlSearch = new SearchController;
$ctrlRole = new RoleController;
$ctrlSignUp = new SignUpController;
$ctrlLogIn = new LogInController;


if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

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
          case "addFilmForm" : $ctrlFilm->addFilmForm(); break; //Formulaire pour ajouter un film
          case "addFilm" : $ctrlFilm->addFilm($_POST, $_FILES); break; //Execution de l'ajout du film
          case "editFilmForm" : $ctrlFilm->editFilmForm($id); break; // Formulaire pour editer un film
          case "editFilm" : $ctrlFilm->editFilm($id, $_POST, $_FILES); break; // Execution de la modification du film
          case "deleteFilm" : $ctrlFilm->deleteFilm($id); break; // Supprime un film

          //ACTEUR
          case "detailActeur" : $ctrlActeur->findOneById($id); break; // Detail d'un acteur
          case "listActeurs" : $ctrlActeur->findAll(); break; // Liste de tous les acteurs
          case "ajouterActeurForm" : $ctrlActeur->addActeurForm(); break; // Formulaire pour ajouter un acteur
          case "ajouterActeur" : $ctrlActeur->addActeur($_POST); break; // Ajoute un acteur
          case "editActeurForm" : $ctrlActeur->editActeurForm($id); break; //Formulaire pour ??diter un acteur
          case "editActeur" : $ctrlActeur->editActeur($id, $_POST); break; // Ex??cution de la modification
          case "deleteActeur" : $ctrlActeur->deleteActeur($id); break; // Supprime un acteur


          //REALISATEUR
          case "detailRealisateur" : $ctrlReal->findOneById($id); break; // Detail d'un r??alisateur
          case "listReal" : $ctrlReal->findAll(); break; // Liste de tous les r??alisateurs
          case "ajouterRealForm" : $ctrlReal->addRealForm(); break; // Formulaire pour ajouter un r??alisateur
          case "ajouterRealisateur" : $ctrlReal->addReal($_POST); break; // Execution de l'ajout du r??alisateur
          case "editRealForm" : $ctrlReal->editRealForm($id); break; // Formulaire pour modifier un r??alisateur
          case "editReal" : $ctrlReal->editReal($id, $_POST); break; // Ex??cution de la modification
          case "deleteReal" : $ctrlReal->deleteReal($id); break; // Supprime un r??alisateur

          //ROLE
          case "listRoles" : $ctrlRole->allRoles(); break; // Liste de tous les r??les
          case "detailRole" : $ctrlRole->getDetailsById($id); break; // Detail d'un r??le
          case "ajouterRoleForm" : $ctrlRole->addRoleForm(); break; // Formulaire pour ajouter un r??le
          case "ajouterRole" : $ctrlRole->addRole($_POST); break; // Ajoute un r??le
          case "editRoleForm" : $ctrlRole->editRoleForm($id); break; // Formulaire pour modifier un r??le
          case "editRole" : $ctrlRole->editRole($id, $_POST); break; // Ex??cution de la modification du r??le
          case "deleteRole" : $ctrlRole->deleteRole($id); break; // Supprime un r??le

          //GENRE
          case "listGenres" : $ctrlGenre->findAll(); break; // Liste de tous les genres
          case "filmsGenre" : $ctrlGenre->findFilmsById($id); break; //Affiche les films d'un genre
          case "ajouterGenreForm" : $ctrlGenre->addGenreForm(); break; // Formulaire pour ajouter un genre
          case "ajouterGenre" : $ctrlGenre->addGenre($_POST); break; // Ajoute un genre
          case "editGenreForm" : $ctrlGenre->editGenreForm($id); break; // Formulaire pour modifier un genre
          case "editGenre" : $ctrlGenre->editGenre($id, $_POST); break; // Ex??cution de la modification du genre
          case "deleteGenre" : $ctrlGenre->deleteGenre($id); break; // Supprime un genre

          //SEARCH
          case "search" : $ctrlSearch->getResult($search); break; // R??sultat de la recherche

          //INSCRIPTION - CONNEXION
          case "signUpForm" : $ctrlSignUp->signUpForm(); break; // Formulaire d'inscription
          case "signUp" : $ctrlSignUp->signUp($_POST); break; // Ex??cution de l'inscription
          case "loginForm" : $ctrlLogIn->loginForm(); break; // Formulaire de connexion
          case "login" : $ctrlLogIn->login($_POST); break; // Ex??cution de la connexion

          //DECONNEXION
          case "logout" : $ctrlLogIn->logout(); break; // Deconnexion


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



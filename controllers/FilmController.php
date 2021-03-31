<?php

require_once "bdd/DAO.php";

class FilmController{

    public function findAll(){

        $dao = new DAO();

        $sql = "SELECT f.id, f.titre, CONCAT(FLOOR(f.duree/60), 'h', f.duree % 60) AS duree, YEAR(f.dateSortie) AS annee, f.id, CONCAT(r.prenom, ' ', r.nom) AS realisateur
        FROM Film f
        INNER JOIN Realisateur r
        ON f.id_realisateur = r.id
        ORDER BY f.titre ASC";

        $films = $dao->executerRequete($sql);

        require "views/film/listFilms.php";
    }

    public function getDetails($id){
        $dao = new DAO();

        $sql = "SELECT f.id, f.titre, CONCAT(FLOOR(f.duree/60), 'h', f.duree % 60) AS duree, YEAR(f.dateSortie) AS annee, note, resume, imgPath, libelle, f.id_realisateur, CONCAT(r.prenom, ' ', r.nom) AS realisateur, c.id_acteur, CONCAT(a.prenom, ' ', a.nom) AS acteur, personnage
        FROM Film f
        INNER JOIN Realisateur r ON f.id_realisateur = r.id
        INNER JOIN casting c ON c.id_film = f.id
        INNER JOIN Acteur a ON a.id = c.id_acteur
        INNER JOIN est_classifie e ON e.id_film = f.id
        INNER JOIN Genre g ON g.id = e.id_genre
        INNER JOIN Role ro ON ro.id = c.id_role
        WHERE f.id = :id";

        $film = $dao->executerRequete($sql, [":id"=> $id]);

        require "views/film/detailFilm.php";
    }

    public function getGenres($id){
        $dao = new DAO();

        $sql = "SELECT g.id, libelle
        FROM Genre g
        INNER JOIN est_classifie e ON e.id_genre = g.id
        WHERE e.id_film = :id";

        $genres = $dao->executerRequete($sql, [":id"=> $id]);

        return $genres->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActeurs($id){
        $dao = new DAO();

        $sql = "SELECT a.id, CONCAT(prenom, ' ', nom) AS acteur, personnage
        FROM Film f
        INNER JOIN casting c ON c.id_film = f.id
        INNER JOIN Acteur a ON a.id = c.id_acteur
        INNER JOIN Role r on r.id = c.id_role
        WHERE f.id = :id";

        $acteurs = $dao->executerRequete($sql, [":id"=> $id]);

        return $acteurs->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFilmForm(){
        $dao = new DAO();

        $realisateur = "SELECT DISTINCT id, CONCAT(nom, ' ', prenom) as realisateur
        FROM realisateur";

        $genre = "SELECT id, libelle
        FROM Genre";


        require "views/film/addFilmForm.php";
    }

    public function addFilm($array){

        $dao = new DAO();

        $sql = "INSERT INTO Film (titre, dateSortie, duree, resume, note, imgPath, id_realisateur)
        VALUES(:titre, :dateSortie, :duree, :resume, :note, :imgPath, :id_realisateur)";

        $titre = filter_var($array["titre_film"], FILTER_SANITIZE_STRING);
        $dateSortie = filter_var($array["date_film"], FILTER_SANITIZE_STRING);
        $duree = filter_var($array["duree_film"], FILTER_SANITIZE_STRING);
        $resume = filter_var($array["resume_film"], FILTER_SANITIZE_STRING);
        $note = filter_var($array["note_film"], FILTER_SANITIZE_STRING);
        $image = filter_var($array["image_film"], FILTER_SANITIZE_STRING);
        $realisateur = filter_var($array["real_film"], FILTER_SANITIZE_STRING);

        $ajoutFilm = $dao->executerRequete($sql, [":titre"=> $titre, ":dateSortie"=> $dateSortie, ":duree"=> $duree, ":resume"=> $resume, ":note"=> $note, ":imgPath"=> $image, ":id_realisateur"=> $realisateur]);

        $dernierId = $dao->getBdd()->lastInsertId();
        
        $sql2 = "INSERT INTO est_classifie (id_genre, id_film)
        VALUES (:id_genre, :id_film)";

        require "views/film/addFilmForm.php";

    }
}
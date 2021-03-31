<?php

require_once "bdd/DAO.php";



class GenreController{

    public function findFilmsById($id){
        $dao = new DAO();

        $sql = "SELECT f.id, titre, dateSortie, duree, note, imgPath, libelle
        FROM Film f
        INNER JOIN est_classifie e ON e.id_film = f.id
        INNER JOIN Genre g ON g.id = e.id_genre
        WHERE id_genre = :id";

        $filmsGenre = $dao->executerRequete($sql, ["id"=> $id]);

        require "views/genre/filmsGenre.php";
    }

    public function getGenres(){

        $dao = new DAO();

        $sql = "SELECT id, libelle FROM Genre";

        $genres = $dao->executerRequete($sql);
        return $genres;
    }

}


?>
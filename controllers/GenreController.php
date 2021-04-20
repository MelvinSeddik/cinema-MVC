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

        $sql = "SELECT id, libelle
        FROM Genre
        WHERE id = :id";

        $thisGenre = $dao->executerRequete($sql, ["id"=> $id]);

        require "views/genre/filmsGenre.php";
    }

    public function getDetailById($id){

        $dao = new DAO();
        
        $sql = "SELECT id, libelle
        FROM Genre
        WHERE id = :id";

        $detailGenre = $dao->executerRequete($sql, [":id"=> $id]);

        return $detailGenre;
    }

    public function getGenres(){

        $dao = new DAO();

        $sql = "SELECT id, libelle FROM Genre";

        $genres = $dao->executerRequete($sql);
        return $genres;
    }

    public function findAll(){

        $dao = new DAO();

        $sql = "SELECT id, libelle
        FROM Genre";

        $genres = $dao->executerRequete($sql);

        require "views/genre/listGenres.php";
    }

    public function addGenreForm(){

        require "views/genre/ajouterGenreForm.php";
    }

    public function addGenre($post){

        $dao = new DAO();

        $sql = "INSERT INTO Genre (libelle)
        VALUES (:libelle)";

        $libelle = filter_var($post["libelle"], FILTER_SANITIZE_STRING);

        $ajoutGenre = $dao->executerRequete($sql, [":libelle"=> $libelle]);

        require "views/genre/ajouterGenreForm.php";
    }

    public function editGenreForm($id){

        $genre = $this->getDetailById($id);
        require "views/genre/editGenreForm.php";
    }

    public function editGenre($id, $post){

        $dao = new DAO();

        $sql = "UPDATE Genre
        SET libelle = :libelle
        WHERE id = :id";

        $libelle = filter_var($post["libelle"], FILTER_SANITIZE_STRING);

        $dao->executerRequete($sql, [":libelle"=> $libelle, ":id"=> $id]);

        header("Location: index.php?action=listGenres");
    }

    public function deleteGenre($id){

        $dao = new DAO();

        $sql = "DELETE FROM Genre
        WHERE id = :id";

        $dao->executerRequete($sql, [":id"=> $id]);

        header("Location: index.php?action=listGenres");
    }
}


?>
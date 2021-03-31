<?php


require_once "bdd/DAO.php";

class AccueilController{



    public function pageAccueil(){
        $dao = new DAO();

        $sql = "SELECT id
        FROM Film    
        ORDER BY note DESC
        ";

        $idBestFilms = $dao->executerRequete($sql);

        $sql = "SELECT id
        FROM Film
        ORDER BY dateSortie DESC
        ";

        $idFilmsRecent = $dao->executerRequete($sql);

        require "views/accueil/accueil.php";
    }

    public static function getDetailsById($id){
        $dao = new DAO();

        $sql = "SELECT titre, dateSortie, duree, note, imgPath
        FROM Film
        WHERE id = :id";

        $detailsById = $dao->executerRequete($sql, ["id"=> $id]);

        return $detailsById->fetch();
    }

    public static function getGenresById($id){
        $dao = new DAO();

        $sql = "SELECT g.id, libelle
        FROM Genre g
        INNER JOIN est_classifie e ON e.id_genre = g.id
        WHERE e.id_film = :id";

        $genres = $dao->executerRequete($sql, ["id"=> $id])->fetchAll(PDO::FETCH_ASSOC);

        return $genres;
    }



}
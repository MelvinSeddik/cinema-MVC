<?php

require_once "bdd/DAO.php";

class SearchController{

    public static function getResult($search){

        $dao = new DAO();

        $sql = "SELECT id, titre
        FROM Film f
        WHERE titre LIKE'%$search%'";

        $searchResult = $dao->executerRequete($sql);

        $sql = "SELECT id, CONCAT(prenom, ' ', nom) AS acteur
        FROM Acteur
        WHERE prenom LIKE'%$search%' OR nom LIKE '%$search%' OR CONCAT(prenom, ' ', nom) LIKE '%$search%' OR CONCAT(nom, ' ', prenom) LIKE '%$search%'";

        $searchResult2 = $dao->executerRequete($sql);

        $sql = "SELECT id, CONCAT(prenom, ' ', nom) AS realisateur
        FROM Realisateur 
        WHERE prenom LIKE'%$search%' OR nom LIKE '%$search%' OR CONCAT(prenom, ' ', nom) LIKE '%$search%' OR CONCAT(nom, ' ', prenom) LIKE '%$search%'";

        $searchResult3 = $dao->executerRequete($sql);

       require_once "views/search/searchResult.php";
    }
}
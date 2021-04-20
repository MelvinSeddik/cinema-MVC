<?php

require_once "../bdd/DAO.php";



try{

    $dao = new DAO();

    $sql="SELECT id, CONCAT(prenom, ' ', nom) AS acteur
    FROM Acteur";
    
    $acteurs = $dao->executerRequete($sql)->fetchAll(PDO::FETCH_ASSOC);

    exit(json_encode($acteurs));

}

catch(Exception $e){
    echo $e->getMessage();
}



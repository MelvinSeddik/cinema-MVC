<?php

require_once "../bdd/DAO.php";



try{

    $dao = new DAO();

    $sql="SELECT id, personnage
    FROM Role";
    
    $roles = $dao->executerRequete($sql)->fetchAll(PDO::FETCH_ASSOC);

    exit(json_encode($roles));

}

catch(Exception $e){
    echo $e->getMessage();
}
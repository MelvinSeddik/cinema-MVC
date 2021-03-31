<?php

require_once "bdd/DAO.php";

class RealController{

    public function findAll(){
        $dao = new DAO();
        
        $sql = "SELECT id, CONCAT(prenom, ' ', nom) AS realisateur
        FROM Realisateur";
        $realisateurs = $dao->executerRequete($sql);

        require "views/realisateur/listReal.php";
    }

    public function findOneById($id, $edit = false){

        $dao = new DAO();

        $sql = "SELECT id, prenom, nom, sexe, dateNaissance
        FROM realisateur r
        WHERE r.id = :id";
        $realisateur = $dao->executerRequete($sql, [":id"=> $id]);
        
        if($edit){
            return $realisateur;
        }
        else{
            require "views/realisateur/detailReal.php";
        }
    }

    public function filmographie($id){
        
        $dao = new DAO();

        $sql = "SELECT id, titre
        FROM Film f
        WHERE f.id_realisateur = :id";

        $filmsReal = $dao->executerRequete($sql, [":id"=> $id]);


        return $filmsReal->fetchAll();
    }

    public function addRealForm(){
        require "views/realisateur/ajouterRealForm.php";
    }

    public function addReal($array){
        $dao = new DAO();

        $sql = "INSERT INTO realisateur (prenom, nom, sexe, dateNaissance) 
        VALUES (:prenom, :nom, :sexe, :dateNaissance)";
        $prenom = filter_var($array["prenom_real"], FILTER_SANITIZE_STRING);
        $nom = filter_var($array["nom_real"], FILTER_SANITIZE_STRING);
        $sexe = filter_var($array["sexe_real"], FILTER_SANITIZE_STRING);
        $naissance = filter_var($array["naissance_real"], FILTER_SANITIZE_STRING);

        $ajoutReal = $dao->executerRequete($sql, [":prenom"=> $prenom, ":nom"=> $nom, ":sexe"=> $sexe, ":dateNaissance"=> $naissance]);

        require "views/realisateur/ajouterRealForm.php";
    }

    public function editRealForm($id){

        $realisateur = $this->findOneById($id, true);
        require "views/realisateur/editRealForm.php";
    }

    public function editReal($id, $array){

        $dao = new DAO();

        $sql = "UPDATE realisateur
        SET prenom = :prenom, nom = :nom, sexe = :sexe, dateNaissance = :dateNaissance
        WHERE id = :id";

        $prenom = filter_var($array["prenom_real"], FILTER_SANITIZE_STRING);
        $nom = filter_var($array["nom_real"], FILTER_SANITIZE_STRING);
        $sexe = filter_var($array["sexe_real"], FILTER_SANITIZE_STRING);
        $naissance = filter_var($array["naissance_real"], FILTER_SANITIZE_STRING);

        $editReal = $dao->executerRequete($sql, [":prenom"=> $prenom, ":nom"=> $nom, ":sexe"=> $sexe, ":dateNaissance"=> $naissance, ":id"=>$id]);

        header("Location: index.php?action=listReal");
    }

    public function deleteReal($id){

        $dao = new DAO();

        $sql = "DELETE FROM realisateur
        WHERE id = :id";

        $deleteReal = $dao->executerRequete($sql, [":id"=> $id]);

        header("Location: index.php?action=listReal");
    }
}
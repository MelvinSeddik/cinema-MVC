<?php

require_once "bdd/DAO.php";

class ActeurController{

    public function findAll(){
        $dao = new DAO();
        
        $sql = "SELECT id, CONCAT(prenom, ' ', nom) AS acteur
        FROM Acteur
        ORDER BY acteur";
        
        $acteurs = $dao->executerRequete($sql);

        require "views/acteur/listActeurs.php";
    }

    public function findOneById($id, $edit = false){

        $dao = new DAO();

        $sql = "SELECT a.id, prenom, nom, CONCAT(prenom, ' ', nom) AS acteur, sexe, dateNaissance, id_role, personnage, id_film, titre
        FROM acteur a
        INNER JOIN casting c ON C.id_acteur = a.id
        INNER JOIN Role r ON r.id = c.id_role
        INNER JOIN Film f ON f.id = c.id_film
        WHERE a.id = :id";
        $acteur = $dao->executerRequete($sql, [":id"=> $id]);
        $acteur2 = $dao->executerRequete($sql, [":id"=> $id]);
        
        if($edit){
            return $acteur;
        }
        else{
            require "views/acteur/detailActeur.php";
        }
    }

    public function addActeurForm(){
        require "views/acteur/ajouterActeurForm.php";
    }

    public function addActeur($array){

        $dao = new DAO();

        $sql = "INSERT INTO acteur (prenom, nom, sexe, dateNaissance) 
        VALUES (:prenom, :nom, :sexe, :dateNaissance)";
        $prenom = filter_var($array["prenom_acteur"], FILTER_SANITIZE_STRING);
        $nom = filter_var($array["nom_acteur"], FILTER_SANITIZE_STRING);
        $sexe = filter_var($array["sexe_acteur"], FILTER_SANITIZE_STRING);
        $naissance = new DateTime(filter_var($array["naissance_acteur"], FILTER_SANITIZE_STRING));
        $naissance = $naissance->format("Ymd");

        $ajoutActeur = $dao->executerRequete($sql, [":prenom"=> $prenom, ":nom"=> $nom, ":sexe"=> $sexe, ":dateNaissance"=> $naissance]);

        require "views/acteur/ajouterActeurForm.php";
    }

    public function editActeurForm($id){

        $acteur = $this->findOneById($id, true);
        require "views/acteur/editActeurForm.php";
    }

    public function editActeur($id, $array){

        $dao = new DAO();

        $sql = "UPDATE acteur
        SET prenom = :prenom, nom = :nom, sexe = :sexe, dateNaissance = :dateNaissance
        WHERE id = :id";

        $prenom = filter_var($array["prenom_acteur"], FILTER_SANITIZE_STRING);
        $nom = filter_var($array["nom_acteur"], FILTER_SANITIZE_STRING);
        $sexe = filter_var($array["sexe_acteur"], FILTER_SANITIZE_STRING);
        $naissance = new DateTime(filter_var($array["naissance_acteur"], FILTER_SANITIZE_STRING));
        $naissance = $naissance->format("Ydm");

        $editReal = $dao->executerRequete($sql, [":prenom"=> $prenom, ":nom"=> $nom, ":sexe"=> $sexe, ":dateNaissance"=> $naissance, ":id"=>$id]);

        header("Location: index.php?action=listActeurs");
    }

    public function deleteActeur($id){

        $dao = new DAO();

        $sql = "DELETE FROM acteur
        WHERE id = :id";

        $deleteReal = $dao->executerRequete($sql, [":id"=> $id]);

        header("Location: index.php?action=listActeurs");
    }
}
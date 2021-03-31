<?php

require_once "bdd/DAO.php";

class ActeurController{

    public function findAll(){
        $dao = new DAO();
        
        $sql = "SELECT id, CONCAT(prenom, ' ', nom) AS acteur
        FROM Acteur";
        $acteurs = $dao->executerRequete($sql);

        require "views/acteur/listActeurs.php";
    }

    public function findOneById($id, $edit = false){

        $dao = new DAO();

        $sql = "SELECT id, prenom, nom, CONCAT(prenom, ' ', nom) AS acteur, sexe, dateNaissance
        FROM acteur a
        WHERE a.id = :id";
        $acteur = $dao->executerRequete($sql, [":id"=> $id]);
        
        if($edit){
            return $acteur;
        }
        else{
            require "views/acteur/detailActeur.php";
        }
    }

    public function filmographie($id){
        
        $dao = new DAO();

        $sql = "SELECT f.id, titre
        FROM Acteur a
        INNER JOIN casting c ON a.id = c.id_acteur
        INNER JOIN Film f ON f.id = c.id_film
        WHERE c.id_acteur = :id";

        $filmsActeur = $dao->executerRequete($sql, [":id"=> $id]);


        return $filmsActeur->fetchAll(PDO::FETCH_ASSOC);
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
        $naissance = filter_var($array["naissance_acteur"], FILTER_SANITIZE_STRING);

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
        $naissance = filter_var($array["naissance_acteur"], FILTER_SANITIZE_STRING);

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
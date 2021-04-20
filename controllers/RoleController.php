<?php

require_once "bdd/DAO.php";

class RoleController{

    public function allRoles(){

        $dao = new DAO();

        $sql = "SELECT id, personnage
        FROM Role";

        $roles = $dao->executerRequete($sql);

        require "views/role/listRoles.php";
    }

    public function getDetailsById($id, $edit = false){
        
        $dao = new DAO();

        $sql = "SELECT r.id, personnage, id_acteur, CONCAT(prenom, ' ', nom) AS acteur, id_film, titre
        FROM Role r
        INNER JOIN Casting c ON c.id_role = r.id
        INNER JOIN Acteur a ON a.id = c.id_acteur
        INNER JOIN Film f ON f.id = c.id_film
        WHERE r.id = :id";

        $role = $dao->executerRequete($sql, [":id"=> $id]);

        if($edit){
            return $role;
        }
        else
        {
            require "views/role/detailRole.php";
        }
    }

    public function addRoleForm(){
        require "views/role/addRoleForm.php";
    }

    public function addRole($post){

        $dao = new DAO();

        $sql = "INSERT INTO Role (personnage)
        VALUES (:personnage)";

        $personnage = filter_var($post["personnage"], FILTER_SANITIZE_STRING);

        $ajoutRole = $dao->executerRequete($sql, [":personnage"=> $personnage]);

        header("Location: index.php?action=listRoles");
    }

    public function editRoleForm($id){
        
        $role = $this->getDetailsById($id, true);
        require "views/role/editRoleForm.php";
    }

    public function editRole($id, $post){

        $dao = new DAO();

        $sql = "UPDATE Role
        SET personnage = :personnage
        WHERE id = :id";

        $personnage = filter_var($post["personnage"], FILTER_SANITIZE_STRING);

        $dao->executerRequete($sql, [":personnage"=> $personnage, ":id"=> $id]);

        header("Location: index.php?action=listRoles");
    }

    public function deleteRole($id){

        $dao = new DAO();

        $sql = "DELETE FROM Role
        WHERE id = :id";

        $dao->executerRequete($sql, [":id"=> $id]);
        
        header("Location: index.php?action=listRoles");
    }
}

?>
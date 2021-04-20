<?php

require_once "bdd/DAO.php";

class LogInController{

    public function loginForm(){

        require "views/connexion/loginForm.php";

    }

    public function login($post){

        if(isset($post["email"]) && isset($post["mdp"])){

            $email = strtolower(filter_var($post["email"], FILTER_SANITIZE_EMAIL));

            $mdp = filter_var($post["mdp"], FILTER_SANITIZE_STRING);

            $token = filter_var($post["token"], FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "#^[A-Fa-f0-9]{48}$#"]]);

            $dao = new DAO();

            $sql = "SELECT CONCAT(prenom, ' ', nom) AS fullname, mdp
            FROM Users
            WHERE email = :email";

            $user = $dao->executerRequete($sql, [":email"=> $email])->fetch();

            if(is_array($user))
            {

                if(password_verify($mdp, $user["mdp"]))
                {

                    if(hash_equals($_SESSION["token"], $token))
                    {
                        $_SESSION["user"] = $user;
                        header("Location: index.php");
                    }
                    else
                    {
                        echo "Erreur inconnue";
                    }

                }
                else
                {
                    echo "Mauvais mot de passe! Réessayez...";
                }
            }
            else
            {
                echo "Aucun utilisateur pour cet email";
            }

        }

    }

    public function logout(){
        
        unset($_SESSION["user"]);
        unset($_SESSION["token"]);

        header("Location: index.php");
    }
}
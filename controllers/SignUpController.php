<?php

require_once "bdd/DAO.php";

class SignUpController{

    public function signUpForm(){

        require "views/inscription/signUpForm.php";
    }

    public function signUp($post){
        $nom = filter_var($post["nom"], FILTER_SANITIZE_STRING);
        $prenom = filter_var($post["prenom"], FILTER_SANITIZE_STRING);
        $email = strtolower(filter_var($post["email"], FILTER_SANITIZE_EMAIL));
        $emailValidate = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = filter_var($post["mdp"], FILTER_SANITIZE_STRING);
        $password2 = filter_var($post["mdp2"], FILTER_SANITIZE_STRING);

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        $passwordIdentical = ($password === $password2) ? true : false;
        $passwordUppercase = ($uppercase > 0) ? true : false;
        $passwordLowercase = ($lowercase > 0) ? true : false;
        $passwordNumber = ($number > 0) ? true : false;
        $passwordSpecialChars = ($specialChars > 0) ? true : false;
        $passwordLength = (strlen($password) >= 8) ? true : false;

        if($emailValidate && $passwordIdentical && $passwordUppercase && $passwordLowercase && $passwordNumber && $passwordSpecialChars && $passwordLength){
            
            $password = password_hash($password, PASSWORD_ARGON2I);

            $dao = new DAO();

            $sql = "INSERT INTO users (prenom, nom, email, mdp)
            VALUES(:prenom, :nom, :email, :mdp)";

            $dao->executerRequete($sql, [":prenom"=> $prenom, ":nom"=> $nom, ":email"=> $email, ":mdp"=> $password]);
        }
        else{
            $signUpFail = true;
            require "views/inscription/signUpForm.php";
        }


    }
}
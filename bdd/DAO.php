<?php

class DAO{

    private $bdd;


    public function __construct(){
        $this->bdd = new PDO('mysql:host=localhost;dbname=cinema2;charset=utf8', 'root', '');
    }


    

    /**
     * Get the value of bdd
     */ 
    public function getBdd()
    {
        return $this->bdd;
    }


    public function executerRequete($sql, $params = NULL){

        if ($params == NULL){

            $result = $this->bdd->query($sql);
        }else{
            $result = $this->bdd->prepare($sql);
            $result->execute($params);
        }

        return $result;
    }
}
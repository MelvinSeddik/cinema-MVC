<?php

require_once "bdd/DAO.php";

class FilmController{

    public function findAll(){

        $dao = new DAO();

        $sql = "SELECT f.id, f.titre, duree, YEAR(f.dateSortie) AS annee, f.id_realisateur, CONCAT(r.prenom, ' ', r.nom) AS realisateur
        FROM Film f
        INNER JOIN Realisateur r
        ON f.id_realisateur = r.id
        ORDER BY f.titre ASC";

        $films = $dao->executerRequete($sql);

        require "views/film/listFilms.php";
    }

    public function getDetails($id, $edit = false){
        $dao = new DAO();


        $sql = "SELECT f.id, f.titre, duree, dateSortie, YEAR(dateSortie) AS annee, note, resume, imgPath, GROUP_CONCAT(DISTINCT g.id) AS genres_id, GROUP_CONCAT(DISTINCT libelle SEPARATOR ',') AS genres, f.id_realisateur, 
        CONCAT(r.prenom, ' ', r.nom) AS realisateur, GROUP_CONCAT(DISTINCT a.id) AS acteurs_id, GROUP_CONCAT(DISTINCT CONCAT(a.prenom, ' ',a.nom) SEPARATOR ',') AS acteurs, GROUP_CONCAT(DISTINCT c.id_role) AS roles_id, GROUP_CONCAT(DISTINCT personnage) AS roles
                FROM Film f
                INNER JOIN Realisateur r ON f.id_realisateur = r.id
                INNER JOIN casting c ON c.id_film = f.id
                INNER JOIN Acteur a ON a.id = c.id_acteur
                INNER JOIN est_classifie e ON e.id_film = f.id
                INNER JOIN Genre g ON g.id = e.id_genre
                INNER JOIN Role ro ON ro.id = c.id_role
        
                WHERE f.id = :id
        ";

        $film = $dao->executerRequete($sql, [":id"=> $id]);

        if($edit){
            return $film;
        }
        else
        {
            require "views/film/detailFilm.php";
        }

    }

    public function getGenres($id){
        $dao = new DAO();

        $sql = "SELECT g.id, libelle
        FROM Genre g
        INNER JOIN est_classifie e ON e.id_genre = g.id
        WHERE e.id_film = :id";

        $genres = $dao->executerRequete($sql, [":id"=> $id]);

        return $genres->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActeurs($id){
        $dao = new DAO();

        $sql = "SELECT a.id, CONCAT(prenom, ' ', nom) AS acteur, personnage
        FROM Film f
        INNER JOIN casting c ON c.id_film = f.id
        INNER JOIN Acteur a ON a.id = c.id_acteur
        INNER JOIN Role r on r.id = c.id_role
        WHERE f.id = :id";

        $acteurs = $dao->executerRequete($sql, [":id"=> $id]);

        return $acteurs->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFilmForm(){
        $dao = new DAO();

        $sql = "SELECT DISTINCT id, CONCAT(prenom, ' ', nom) as realisateur
        FROM realisateur";

        $allRealisateurs = $dao->executerRequete($sql);

        $sql = "SELECT id, libelle
        FROM Genre";

        $allGenres = $dao->executerRequete($sql);

        $sql = "SELECT id, CONCAT(prenom, ' ', nom) as acteur
        FROM acteur";

        $allActeurs = $dao->executerRequete($sql);

        $sql = "SELECT id, personnage
        FROM Role";

        $allRoles = $dao->executerRequete($sql);


        require_once "views/film/addFilmForm.php";


    }

    public function addFilm($array, $files){

        $dao = new DAO();

        $sql = "INSERT INTO Film (titre, dateSortie, duree, resume, note, imgPath, id_realisateur)
        VALUES(:titre, :dateSortie, :duree, :resume, :note, :imgPath, :id_realisateur)";

        $titre = filter_var($array["titre_film"], FILTER_SANITIZE_STRING);
        $dateSortie = new DateTime(filter_var($array["date_film"], FILTER_SANITIZE_STRING));
        $dateSortie = $dateSortie->format("Ymd");
        $duree = filter_var($array["duree_film"], FILTER_SANITIZE_NUMBER_INT);
        $resume = filter_var($array["resume_film"], FILTER_SANITIZE_STRING);
        $note = filter_var($array["note_film"], FILTER_SANITIZE_STRING);

        $imageName = filter_var($files["image_film"]["name"], FILTER_SANITIZE_STRING);
        $imageTmp = $files["image_film"]["tmp_name"];
        $imageSize = $files["image_film"]["size"];
        $fileType = $files["image_film"]["type"];
        $fileError = $files["image_film"]["error"];

        $fileExt = explode(".", $imageName);
        $fileExt = strtolower(end($fileExt));

        $allowedTypes = ["jpg", "jpeg", "png"];

        if(in_array($fileExt, $allowedTypes))
        {

            if($fileError === 0)
            {
                if($imageSize <= 4000000)
                {
                    $imageName = bin2hex(random_bytes(20)).".".$fileExt;
                    $fileDest = "img/".$imageName;
                    move_uploaded_file($imageTmp, $fileDest);
                }
                else
                {
                    echo "<span class='alert alert-danger'>Fichier trop volumineux (".$imageSize.")</span>";
                }
            }
            else
            {
                echo "<span class='alert alert-danger'>Erreur !</span>";
            }
        }
        else
        {
            echo "<span class='alert alert-danger'>Ce type de fichier n'est pas pris en charge</span>";
        }


        $realisateur = filter_var($array["select_real"], FILTER_SANITIZE_STRING);
        $genresFilm = [];
        foreach($array["select_genres"] as $option){
            array_push($genresFilm, filter_var($option, FILTER_SANITIZE_NUMBER_INT));
        }
        $acteurs = [];
        foreach($array["select_acteur"] as $acteur){
            array_push($acteurs, filter_var($acteur, FILTER_SANITIZE_NUMBER_INT));
        }
        $roles = [];
        foreach($array["select_role"] as $role){
            array_push($roles, filter_var($role, FILTER_SANITIZE_NUMBER_INT));
        }
        $castings = array_combine($acteurs, $roles);




        $ajoutFilm = $dao->executerRequete($sql, [":titre"=> $titre, ":dateSortie"=> $dateSortie, ":duree"=> $duree, ":resume"=> $resume, ":note"=> $note, ":imgPath"=> $fileDest, ":id_realisateur"=> $realisateur]);

        $dernierId = $dao->getBdd()->lastInsertId();
        
        $sql2 = "INSERT INTO est_classifie (id_genre, id_film)
        VALUES (:id_genre, :id_film)";

        foreach ($genresFilm as $element){
            $dao->executerRequete($sql2, [":id_genre"=> $element, ":id_film"=> $dernierId]);
        }
        
        $sql = "INSERT INTO casting (id_film, id_acteur, id_role)
        VALUES (:id_film, :id_acteur, :id_role)";

        foreach ($castings as $acteur => $role){
            $dao->executerRequete($sql, [":id_film"=> $dernierId, ":id_acteur"=> $acteur, ":id_role"=> $role]);
        }


        header("Location: index.php?action=listFilms");

    }

    public function editFilmForm($id){

        $film = $this->getDetails($id, true);

        $dao = new DAO();

        $sql = "SELECT DISTINCT id, CONCAT(prenom, ' ', nom) as realisateur
        FROM realisateur";

        $allRealisateurs = $dao->executerRequete($sql);

        $sql = "SELECT id, libelle
        FROM Genre";

        $allGenres = $dao->executerRequete($sql);

        $sql = "SELECT id, CONCAT(prenom, ' ', nom) as acteur
        FROM acteur";

        $allActeurs = $dao->executerRequete($sql);

        $sql = "SELECT id, personnage
        FROM Role";

        $allRoles = $dao->executerRequete($sql);

        $sql = "SELECT a.id AS id_acteur, CONCAT(a.prenom, ' ', a.nom) AS acteur, r.id AS id_role, r.personnage
        FROM Acteur a
        INNER JOIN Casting c ON c.id_acteur = a.id
        INNER JOIN Role r ON r.id = c.id_role
        WHERE c.id_film = :id";

        $acteursFilm = $dao->executerRequete($sql, ["id"=> $id]);

        require "views/film/editFilmForm.php";
    }

    public function editFilm($id, $post, $files){

        $dao = new DAO();
        
        $titre = filter_var($post["titre_film"], FILTER_SANITIZE_STRING);
        $dateSortie = new DateTime(filter_var($post["date_film"], FILTER_SANITIZE_STRING));
        $dateSortie = $dateSortie->format("Ymd");
        $duree = filter_var($post["duree_film"], FILTER_SANITIZE_NUMBER_INT);
        $resume = filter_var($post["resume_film"], FILTER_SANITIZE_STRING);
        $note = filter_var($post["note_film"], FILTER_SANITIZE_STRING);
        $realisateur = filter_var($post["select_real"], FILTER_SANITIZE_STRING);

        $image = $files["image_film"];
        $imageName = filter_var($files["image_film"]["name"], FILTER_SANITIZE_STRING);
        $imageTmp = $files["image_film"]["tmp_name"];
        $imageSize = $files["image_film"]["size"];
        $fileType = $files["image_film"]["type"];
        $fileError = $files["image_film"]["error"];

        $fileExt = explode(".", $imageName);
        var_dump($fileExt);
        var_dump($imageName);
        $fileExt = strtolower(end($fileExt));

        $allowedTypes = ["jpg", "jpeg", "png"];

        if(in_array($fileExt, $allowedTypes))
        {

            if($fileError === 0)
            {
                if($imageSize <= 4000000)
                {
                    $imageName = bin2hex(random_bytes(20)).".".$fileExt;
                    $fileDest = "img/".$imageName;
                    move_uploaded_file($imageTmp, $fileDest);
                }
                else
                {
                    echo "<span class='alert alert-danger'>Fichier trop volumineux (".$imageSize.")</span>";
                }
            }
            else
            {
                echo "<span class='alert alert-danger'>Erreur !</span>";
            }
        }
        else
        {
            echo "<span class='alert alert-danger'>Ce type de fichier n'est pas pris en charge</span>";
        }


        $sql = "UPDATE Film f
        SET titre = :titre, dateSortie = :dateSortie, duree = :duree, resume = :resume, note = :note, imgPath = :image, id_realisateur = :realisateur
        WHERE f.id = :id";
        
        $dao->executerRequete($sql, [":titre"=> $titre, ":dateSortie"=> $dateSortie, ":duree"=> $duree, ":resume"=> $resume, ":note"=> $note, ":image"=> $fileDest, ":realisateur"=> $realisateur, ":id"=> $id]);

        $genresFilm = [];
        foreach($post["select_genres"] as $option){
            array_push($genresFilm, filter_var($option, FILTER_SANITIZE_NUMBER_INT));
        }
        $acteurs = [];
        foreach($post["select_acteur"] as $acteur){
            array_push($acteurs, filter_var($acteur, FILTER_SANITIZE_NUMBER_INT));
        }
        $roles = [];
        foreach($post["select_role"] as $role){
            array_push($roles, filter_var($role, FILTER_SANITIZE_NUMBER_INT));
        }
        $castings = array_combine($acteurs, $roles);

        $sql = "DELETE FROM est_classifie
        WHERE id_film = :id";

        $dao->executerRequete($sql, [":id"=> $id]);

        $sql = "INSERT INTO est_classifie (id_genre, id_film)
        VALUES (:id_genre, :id_film)";

        foreach ($genresFilm as $element){
            $dao->executerRequete($sql, [":id_genre"=> $element, ":id_film"=> $id]);
        }

        $sql = "DELETE FROM casting
        WHERE id_film = :id";

        $dao->executerRequete($sql, [":id"=> $id]);

        $sql = "INSERT INTO casting (id_film, id_acteur, id_role)
        VALUES (:id_film, :id_acteur, :id_role)";

        foreach ($castings as $acteur => $role){
            $dao->executerRequete($sql, [":id_film"=> $id, ":id_acteur"=> $acteur, ":id_role"=> $role]);
        }

        header("Location:index.php?action=listFilms");
    }


    public function deleteFilm($id){

        $dao = new DAO();

        $sql = "DELETE FROM Film
        WHERE id = :id";

        $dao->executerRequete($sql, ["id"=> $id]);

        header("Location: index.php?action=listFilms");
    }
}
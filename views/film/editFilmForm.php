<?php

ob_start();

$film = $film->fetch(PDO::FETCH_ASSOC);

$acteurs = explode(",", $film["acteurs"]);

$roles = explode(",", $film["roles"]);

$allGenres = $allGenres->fetchAll(PDO::FETCH_ASSOC);

?>

<form action="./index.php?action=editFilm&id=<?=$film["id"]?>" method="POST" name="film_form" id="film-form" class="margin-center col-7" enctype="multipart/form-data">


    <h2>Modifier un film</h2>

    <div class="form-group">
        <label for="titre_film">Titre : </label>
        <input type="text" class="form-control" id="titre_film" name="titre_film" placeholder="Titanic" value="<?=$film["titre"]?>" required>
    </div>

    <div class="form-group">
        <label for="date_film">Date de sortie : </label>
        <input type="date" class="form-control" name="date_film" placeholder="1998-01-07" value="<?=$film["dateSortie"]?>" required>
    </div>

    <div class="form-group">
        <label for="duree_film">Durée (minutes) :</label>
        <input type="text" class="form-control" id="duree_film" name="duree_film" placeholder="194" value="<?=$film["duree"]?>" required>
    </div>

    <div class="form-group">
        <label for="resume_film">Resume : </label>
        <textarea class="form-control textarea" id="resume_film" name="resume_film">
            <?=$film["resume"]?>
        </textarea>
    </div>

    <div class="form-group">
        <label for="note_film">Note : </label>
        <input type="text" class="form-control" id="note_film" name="note_film" placeholder="4.9" value="<?=$film["note"]?>">
    </div>

    <div class="form-group">
        <label for="image_film">Image : </label>
        <input type="file" class="form-control" id="image_film" name="image_film">
    </div>

    <div class="form-group">
        <label>Selectionnez un réalisateur</label>
        <select name="select_real" class="custom-select custom-select-lg mb-3">
            <?php

            $allRealisateurs = $allRealisateurs->fetchAll(PDO::FETCH_ASSOC);
            foreach ($allRealisateurs as $realisateur){
                if($realisateur["realisateur"] === $film["realisateur"]){
                    echo "<option value=".$film["id_realisateur"]." selected>".$film["realisateur"]."</option>";
                }
                else
                {
                    echo "<option value=".$realisateur["id"].">".$realisateur["realisateur"]."</option>";
                }
            }


            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Selectionnez un ou plusieurs genre(s)</label>
        <select name="select_genres[]" class="custom-select custom-select-lg mb-3 multiple-select" multiple required>
        <?php
            $genres = explode("," ,$film["genres"]);
            $id_genres = explode(",", $film["genres_id"]);
            $genres_id = array_combine($id_genres, $genres);


            foreach($allGenres as $genre){
                if(in_array($genre["libelle"], $genres)){
                    echo "<option selected value=".$genre["id"].">".$genre["libelle"]."</option>";
                }
                else{
                    echo "<option value='".$genre["id"]."'>".$genre["libelle"]."</option>";
                }

            }

            ?>
        </select>
    </div>

    <div class="form-group" id="casting">

        <?php

        function getLargerArray($array, $array2){
            if(count($array) >= count($array2)){
                return $array;
            }
            else{
                return $array2;
            }
        }
        
        $allActeurs = $allActeurs->fetchAll(PDO::FETCH_ASSOC);
        $allRoles = $allRoles->fetchAll(PDO::FETCH_ASSOC);
        $acteursFilm = $acteursFilm->fetchAll(PDO::FETCH_ASSOC);

        $acteurs_found = [];

        $counter = 1;
        foreach(getLargerArray($acteurs, $roles) as $element){

            echo "<div class='added-casting'>";
            echo "<h5>Casting ".$counter."</h5>";
            echo "<label>Selectionnez un acteur</label>";
            echo "<select name='select_acteur[]' class='custom-select custom-select-lg mb-3'>";


            foreach($allActeurs as $acteur){

                if(in_array($acteur["acteur"], $acteurs) && !in_array($acteur["acteur"], $acteurs_found))
                {
                    $acteurs_found[$acteur["id"]] = $acteur["acteur"];
                }
                else
                {
                    echo "<option value='".$acteur["id"]."'>".$acteur["acteur"]."</option>";
                }

            }


            foreach($acteurs_found as $id => $acteur){
                if($acteur === $acteursFilm[$counter-1]["acteur"])
                {
                    echo "<option value='".$id."' selected>".$acteur."</option>";
                }
                else
                {
                    echo "<option value='".$id."'>".$acteur."</option>";
                }

            }

            echo "</select>";

            echo "<label>Selectionnez son rôle</label>";
            echo "<select name='select_role[]' class='custom-select custom-select-lg mb-3'>";

            $roles_found = [];
            
            foreach($allRoles as $role){

                if(in_array($role["personnage"], $roles) && !in_array($role["personnage"], $roles_found))
                {
                    $roles_found[$role["id"]] = $role["personnage"];
                }
                else
                {
                    echo "<option value='".$role["id"]."'>".$role["personnage"]."</option>";
                }

            }


            foreach($roles_found as $id => $role){
                if($role === $acteursFilm[$counter-1]["personnage"])
                {
                    echo "<option value='".$id."' selected>".$role."</option>";
                }
                else
                {
                    echo "<option value='".$id."'>".$role."</option>";
                }

            }

            echo "</select>";
            echo "<span class='btn btn-danger delete-casting'><i class='fas fa-trash-alt margin-center'></i></span>";
            echo "</div>";


            $counter++;
        }

        ?>

    </div>
    
    <div class="form-group">
        <span id="add-casting" class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter un casting </span>
    </div>



       
    <button type="submit" class="btn btn-primary">Modifier le film</button>
    
</form>

<?php

$titre = "Modifier un film";
$contenu = ob_get_clean();
$jsPath = "./js/main.js";
require "views/template.php"; 

?>
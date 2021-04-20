<?php

ob_start();

?>

<form action="./index.php?action=addFilm" method="POST" name="film_form" id="film-form" class="margin-center col-7" enctype="multipart/form-data">


    <h2>Ajouter un film</h2>

    <div class="form-group">
        <label for="titre_film">Titre : </label>
        <input type="text" class="form-control" id="titre_film" name="titre_film" placeholder="Titanic" required>
    </div>

    <div class="form-group">
        <label for="date_film">Date de sortie : </label>
        <input type="date" class="form-control" id="date_film" name="date_film" placeholder="1998-01-07" required>
    </div>

    <div class="form-group">
        <label for="duree_film">Durée (minutes) :</label>
        <input type="text" class="form-control" id="duree_film" name="duree_film" placeholder="194" required>
    </div>

    <div class="form-group">
        <label for="resume_film">Resume : </label>
        <textarea type="text" class="form-control" id="resume_film" name="resume_film" placeholder="Le paquebot le plus grand et le plus moderne du monde...">

        </textarea>
    </div>

    <div class="form-group">
        <label for="note_film">Note : </label>
        <input type="text" class="form-control" id="note_film" name="note_film" placeholder="4.9">
    </div>

    <div class="form-group">
        <label for="image_film">Image : </label>
        <input type="file" class="form-control" id="image_film" name="image_film">
    </div>

    <div class="form-group">
        <label>Selectionnez un réalisateur</label>
        <select name="select_real" class="custom-select custom-select-lg mb-3">
            <?php
            while($realisateurs = $allRealisateurs->fetch()){
                echo "<option value=".$realisateurs["id"].">".$realisateurs["realisateur"]."</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Selectionnez un ou plusieurs genre(s)</label>
        <select name="select_genres[]" class="custom-select custom-select-lg mb-3 multiple-select" multiple required>
            <?php
            while($genres = $allGenres->fetch()){
                echo "<option value=".$genres["id"].">".$genres["libelle"]."</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group" id="casting">


    </div>
    
    <div class="form-group">
        <span id="add-casting" class="btn btn-secondary"><i class="fas fa-plus"></i> Ajouter un casting </span>
    </div>



       
    <button type="submit" class="btn btn-primary">Ajouter le film</button>
    
</form>

<?php

$titre = "Ajouter un film";
$contenu = ob_get_clean();
$jsPath = "./js/main.js";
require "views/template.php"; 

?>
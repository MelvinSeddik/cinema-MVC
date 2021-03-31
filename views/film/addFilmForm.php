<?php

ob_start();

?>

<form action="./index.php?action=addFilm" method="POST" class="margin-center">
<?php
 if(isset($ajoutFilm)){
    echo "<span class='success center'>Film ".$titre." ajouté avec succès!</span>";
}
?>
    <h2>Ajouter un film</h2>

    <div class="form-group">
        <label for="titre_film">Titre : </label>
        <input type="text" class="form-control" id="titre_film" name="titre_film" placeholder="Titanic" required>
    </div>

    <div class="form-group">
        <label for="date_film">Date de sortie : </label>
        <input type="text" class="form-control" id="date_film" name="date_film" placeholder="1998-01-07" required>
    </div>

    <div class="form-group">
        <label for="duree_film">Durée (minutes) :</label>
        <input type="text" class="form-control" id="duree_film" name="duree_film" placeholder="194" required>
    </div>

    <div class="form-group">
        <label for="resume_film">Resume : </label>
        <textarea type="text" class="form-control" id="resume_film" name="resume_film" placeholder="Le paquebot le plus grand et le plus moderne du monde..."></textarea>
    </div>

    <div class="form-group">
        <label for="note_film">Note : </label>
        <input type="text" class="form-control" id="note_film" name="note_film" placeholder="4.9">
    </div>

    <div class="form-group">
        <label for="image_film">Chemin vers l'image : </label>
        <input type="text" class="form-control" id="image_film" name="image_film" placeholder="img/titanic.jpg">
    </div>

    <div class="form-group">
        <select class="custom-select custom-select-lg mb-3">
            <option selected>Ajoutez un réalisateur</option>
            <?php
            while($realisateurs = $realisateur->fetch()){
                echo "<option>".$realisateurs["realisateur"]."</option>";
            }
            ?>
        </select>
    </div>


    <div class="form-group">
        <select multiple class="custom-select custom-select-lg mb-3">
            <option selected>Selectionnez plusieurs genres</option>
            <?php
            $genres = GenreController::getGenres();
            while($genres = $genre->fetch()){
                echo "<option>".$genres["libelle"]."</option>";
            }
            ?>
        </select>
    </div>

       
    <button type="submit" class="btn btn-primary">Ajouter</button>
    
</form>

<?php

$titre = "Ajouter un film";
$contenu = ob_get_clean();
require "views/template.php"; 
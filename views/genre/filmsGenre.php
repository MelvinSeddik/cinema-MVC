<?php

ob_start();

$films = $filmsGenre->fetchAll(PDO::FETCH_ASSOC);


?>


<main class="container row">

    <section class="col-10">
            <h2 class="center">Films du genre <?= $films[0]["libelle"]?></h2>

        <?php 
        foreach($films as $film){
            $date = new DateTime($film["dateSortie"]);
            $note = $film["note"] + 0;
            echo "
            <h5><a href='index.php?action=detailFilm&id=".$film["id"]."'>".$film["titre"]."</a></h5>
            <div class='flex acenter film-box'>
                <figure class='image-film-m mright'><img src='".$film["imgPath"]."' alt='affiche ".$film["titre"]."'></figure>
                <div class='f-column'>
                    
                    <p>Année de sortie : ".date_format($date, "Y")."</p>
                    <p>Note : ".$note."/5</p>
                </div>
            </div>
            ";
        }
        ?>

    </section >


</main>

<?php
$filmsGenre->closeCursor();
$titre = "Films pour le genre";
$contenu = ob_get_clean();
require "views/template.php";

?>
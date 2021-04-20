<?php

ob_start();

?>

<h1 class="center">Liste des films (<?= $films->rowCount();?>)</h1>

<a href="index.php?action=addFilmForm" class="btn btn-primary text-white m-3">Ajouter un film</a>

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Duree</th>
            <th scope="col">Année</th>
            <th scope="col">Réalisateur</th>
            <th scope="col">Modifier</th>
            <th scope="col">Suppr.</th>
        </tr>    
    </thead>
    <tbody>
        <?php
            $counter = 1;
            while($film = $films->fetch()){
                
                $duree = $film["duree"];
                $duree = floor(($duree/60))."h".sprintf('%02d', ($duree%60));

                echo "<tr><th scope='row'>".$counter."</th><td><a href='index.php?action=detailFilm&id=".$film['id']."'>".$film['titre']."</a></td>";
                echo "<td>".$duree."</td>";
                echo "<td>".$film["annee"]."</td>";
                echo "<td><a href='index.php?action=detailRealisateur&id=".$film['id_realisateur']."'>".$film['realisateur']."</a></td>
                <td><a href='index.php?action=editFilmForm&id=".$film['id']."' class='text-info'>Modifier <i class='fas fa-edit'></i></a></td>
                <td><a href='index.php?action=deleteFilm&id=".$film['id']."' class='text-danger'>Supprimer <i class='fas fa-trash-alt'></i></a></td></tr>";
                $counter++;
            }

        ?>
    </tbody>
</table>

<?php

$films->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "views/template.php";
?>
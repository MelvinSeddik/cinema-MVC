<?php

ob_start();

?>

<h1 class="center">Liste des films (<?= $films->rowCount();?>)</h1>

<a href="index.php?action=addFilmForm" class="btn btn-primary text-white">Ajouter un film</a>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Duree</th>
            <th scope="col">Année</th>
            <th scope="col">Réalisateur</th>
        </tr>    
    </thead>
    <tbody>
        <?php

            while($film = $films->fetch()){
                echo "<tr><td><a href='index.php?action=detailFilm&id=".$film['id']."'>".$film['titre']."</a></td>";
                echo "<td>".$film["duree"]."</td>";
                echo "<td>".$film["annee"]."</td>";
                echo "<td><a href='index.php?action=detailRealisateur&id=".$film['id']."'>".$film['realisateur']."</a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$films->closeCursor();
$titre = "La liste de films";
$contenu = ob_get_clean();
require "views/template.php";
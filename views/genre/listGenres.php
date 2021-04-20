<?php

ob_start();
 
?>


<h1 class="center">Liste des genres (<?= $genres->rowCount();?>)</h1>

<a href="index.php?action=ajouterGenreForm" class="btn btn-primary text-white m-3">Ajouter un genre</a>

<table class="table table-striped table-dark">
    <thead>
        <tr>
        <th scope="col">#</th>
            <th scope="col">Libelle </th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>    
    </thead>
    <tbody>
        <?php
            $counter = 1;
            while($genre = $genres->fetch()){
                echo "<tr><th scope='row'>".$counter++."</th><td><a href='index.php?action=filmsGenre&id=".$genre['id']."'>".$genre['libelle']."</a></td>
                <td><a href='index.php?action=editGenreForm&id=".$genre['id']."' class='text-info'>Modifier <i class='fas fa-edit'></i></a></td>
                <td><a href='index.php?action=deleteGenre&id=".$genre['id']."' class='text-danger'>Supprimer <i class='fas fa-trash-alt'></i></a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$genres->closeCursor();
$titre = "Tous les genres";
$contenu = ob_get_clean();
require "views/template.php";

?>
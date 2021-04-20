<?php

ob_start();

?>

<h1 class="center">Liste des realisateurs (<?= $realisateurs->rowCount();?>)</h1>

<a href="index.php?action=ajouterRealForm" class="btn btn-primary text-white m-3">Ajouter un réalisateur</a>

<table class="table table-striped table-dark">
    <thead>
        <tr>
        <th scope="col">#</th>
            <th scope="col">Nom du realisateur</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>    
    </thead>
    <tbody>
        <?php
            $counter = 1;
            while($realisateur = $realisateurs->fetch()){
                echo "<tr><th scope='row'>".$counter++."</th><td><a href='index.php?action=detailRealisateur&id=".$realisateur['id']."'>".$realisateur['realisateur']."</a></td>
                <td><a href='index.php?action=editRealForm&id=".$realisateur['id']."' class='text-info'>Modifier <i class='fas fa-edit'></i></a></td>
                <td><a href='index.php?action=deleteReal&id=".$realisateur['id']."' class='text-danger'>Supprimer <i class='fas fa-trash-alt'></i></a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$realisateurs->closeCursor();
$titre = "La liste de realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
<?php

ob_start();

?>

<h1 class="center">Liste des realisateurs (<?= $realisateurs->rowCount();?>)</h1>

<a href="index.php?action=ajouterRealForm" class="btn btn-primary text-white">Ajouter un réalisateur</a>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nom du realisateur</th>
            <th scope="col"><i class="fas fa-edit"></i></th>
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
        </tr>    
    </thead>
    <tbody>
        <?php

            while($realisateur = $realisateurs->fetch()){
                echo "<tr><td><a href='index.php?action=detailRealisateur&id=".$realisateur['id']."'>".$realisateur['realisateur']."</a></td>
                <td><a href='index.php?action=editRealForm&id=".$realisateur['id']."' class='text-info'>Modifier</a></td>
                <td><a href='index.php?action=deleteReal&id=".$realisateur['id']."' class='text-danger'>Supprimer</a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$realisateurs->closeCursor();
$titre = "La liste de realisateurs";
$contenu = ob_get_clean();
require "views/template.php";
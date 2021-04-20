<?php

ob_start();


?>


<h1 class="center">Liste des acteurs (<?= $acteurs->rowCount();?>)</h1>

<a href="index.php?action=ajouterActeurForm" class="btn btn-primary text-white m-3">Ajouter un acteur</a>

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom de l'acteur</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>    
    </thead>
    <tbody>
        <?php
            $counter = 1;
            while($acteur = $acteurs->fetch()){
                echo "<tr><th scope='row'>".$counter++."</th><td><a href='index.php?action=detailActeur&id=".$acteur['id']."'>".$acteur['acteur']."</a></td>
                <td><a href='index.php?action=editActeurForm&id=".$acteur['id']."' class='text-info'>Modifier <i class='fas fa-edit'></i></a></td>
                <td><a href='index.php?action=deleteActeur&id=".$acteur['id']."' class='text-danger'>Supprimer <i class='fas fa-trash-alt'></i></a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$acteurs->closeCursor();
$titre = "La liste de acteurs";
$contenu = ob_get_clean();
require "views/template.php";
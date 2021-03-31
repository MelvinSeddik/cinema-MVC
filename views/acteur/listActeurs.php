<?php

ob_start();


?>


<h1 class="center">Liste des acteurs (<?= $acteurs->rowCount();?>)</h1>

<a href="index.php?action=ajouterActeurForm" class="btn btn-primary text-white">Ajouter un acteur</a>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Nom de l'acteur</th>
            <th scope="col"><i class="fas fa-edit"></i></th>
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
        </tr>    
    </thead>
    <tbody>
        <?php

            while($acteur = $acteurs->fetch()){
                echo "<tr><td><a href='index.php?action=detailActeur&id=".$acteur['id']."'>".$acteur['acteur']."</a></td>
                <td><a href='index.php?action=editActeurForm&id=".$acteur['id']."' class='text-info'>Modifier</a></td>
                <td><a href='index.php?action=deleteActeur&id=".$acteur['id']."' class='text-danger'>Supprimer</a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$acteurs->closeCursor();
$titre = "La liste de acteurs";
$contenu = ob_get_clean();
require "views/template.php";
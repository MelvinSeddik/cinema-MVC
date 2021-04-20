<?php

ob_start();
 
?>


<h1 class="center">Liste des rôles (<?= $roles->rowCount();?>)</h1>

<a href="index.php?action=ajouterRoleForm" class="btn btn-primary text-white m-3">Ajouter un rôle</a>

<table class="table table-striped table-dark">
    <thead>
        <tr>
        <th scope="col">#</th>
            <th scope="col">Personnage</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>    
    </thead>
    <tbody>
        <?php
            $counter = 1;
            while($role = $roles->fetch()){
                echo "<tr><th scope='row'>".$counter++."</th><td><a href='index.php?action=detailRole&id=".$role['id']."'>".$role['personnage']."</a></td>
                <td><a href='index.php?action=editRoleForm&id=".$role['id']."' class='text-info'>Modifier <i class='fas fa-edit'></i></a></td>
                <td><a href='index.php?action=deleteRole&id=".$role['id']."' class='text-danger'>Supprimer <i class='fas fa-trash-alt'></i></a></td></tr>";
            }

        ?>
    </tbody>
</table>


<?php

$roles->closeCursor();
$titre = "Tous les rôles";
$contenu = ob_get_clean();
require "views/template.php";

?>
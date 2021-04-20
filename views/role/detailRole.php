
<?php

ob_end_clean();
ob_start();

$detailRole = $role->fetchAll(PDO::FETCH_ASSOC);

?>


<h2 class="center">Le rôle <?=$detailRole[0]["personnage"]?> apparaît dans les films :</h2>


<table class="table table-striped table-dark">
    <thead class="bgblack">
        <tr>
        <th scope="col">#</th>
            <th scope="col">Film</th>
            <th scope="col">Acteur</th>
        </tr>    
    </thead>
    <tbody>
        <?php
            $counter = 1;
            foreach($detailRole as $detail){
                echo "<tr><th scope='row'>".$counter++."</th><td><a href='index.php?action=detailFilm&id=".$detail['id_film']."'>".$detail['titre']."</a></td>
                <td><a href='index.php?action=detailActeur&id=".$detail['id_acteur']."'>".$detail["acteur"]."</a></td></tr>";
            }

        ?>
    </tbody>
</table>



<?php

$role->closeCursor();
$titre = $detailRole[0]["personnage"];
$contenu = ob_get_clean();
require "views/template.php";
?>
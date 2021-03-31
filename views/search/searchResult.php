<?php

ob_start();


$results = $searchResult->fetchAll(PDO::FETCH_ASSOC); //film
$results2 = $searchResult2->fetchAll(); //acteur
$results3 = $searchResult3->fetchAll(); //realisateur

echo "<main class='container'>";

if($results || $results2 || $results3){
    echo "<h3 class='center'>".($searchResult->rowCount() + $searchResult2->rowCount() + $searchResult3->rowCount())." résultat(s) pour \"".$search."\"</h3>";

    if($results){
        echo "
            <h5>Film : </h5>";
         
            
            foreach($results as $result){
                echo "<p><a href='index.php?action=detailFilm&id=".$result["id"]."'>".$result["titre"]."</a></p>";
            }
            
    }
    
    if($results2){
        echo "<h5>Acteurs : </h5>";
    
    
        foreach($results2 as $result){
            echo "<p><a href='index.php?action=detailActeur&id=".$result["id"]."'>".$result["acteur"]."</a></p>";
        }
        
    }
    
    if($results3){
        echo "<h5>Réalisateurs : </h5>";
        foreach($results3 as $result){
            echo "<p><a href='index.php?action=detailRealisateur&id=".$result["id"]."'>".$result["realisateur"]."</a></p>";
        }
    }
}


else{
    echo "<h3 style='color:red;'>Aucun résultat pour la recherche</h3>";
}

echo "</main>";
?>





<?php

$titre = "Résultats pour \"".$search."\"";
$contenu = ob_get_clean();
require "views/template.php";

?>
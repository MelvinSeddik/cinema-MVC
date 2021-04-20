<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">

</head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="index.php" class="navbar-brand">Cinema</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php?action=listFilms" class="nav-link">Films</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=listActeurs" class="nav-link">Acteurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=listReal" class="nav-link">Réalisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=listRoles" class="nav-link">Rôles</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=listGenres" class="nav-link">Genres</a>
                    </li>
                </ul>

                <form action="" method="GET" class="container">
                <div class="input-group row">
                    <input type="search" name="search" id="search" placeholder="Chercher un film, acteur..." class="form-control col-3">
                    <button type="submit" name="submit" value="Search" class="btn btn-primary"><i class="margin-center fas fa-search"></i></button>
                </div>

                </form>
                
                <?php
                if(!isset($_SESSION["user"])){
                    echo '<a href="index.php?action=signUpForm" class="btn btn-outline-primary mx-2 text-white">Inscription</a>';
                    echo '<a href="index.php?action=loginForm" class="btn btn-primary mx-2 text-white">Connexion</a>';
                }
                else{
                    echo "<span class='mx-2 text-white'>Bienvenue ".$_SESSION["user"]["fullname"]." !</span>";
                    echo '
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="index.php?action=logout">Déconnexion</a>
                        </div>
                    </div>';

                }
                

                ?>

            </div>

        </nav>


    </body>
</html>

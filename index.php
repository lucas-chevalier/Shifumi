<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu du shifumi</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icone.ico">
</head>
<?php
require './database/pdo.php'; // Inclusion du script qui fait la connexion à la bdd
?>
<body class="shifumi_body">
    <header class="index_header"> <!-- header à ajouter dans le futur -->
    </header>
    <section class="index_section">
        <h1 class="index_h1">Jeu du shifumi</h1> <!-- le titre H1 -->
        <div class="index_credits"> <!-- les crédits des développeurs -->
            <p>Affrontez Hal au shifumi</p>
            <p>Ce jeu vous est proposé par</p>
            <p>Kévin L, Lucas C, et Kean M.</p>
        </div>
        <form action="#" method="POST" class="index_form"> <!-- le formulaire avec le nom d'utilisateur (classes bizarres = bootstrap) -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Nom" require>
            <div id="emailHelp" class="form-text"></div>
            <button type="submit" class="btn btn-primary">Jouer</button>
        </div>
        <!-- ------====== Partie PHP/SQL ======------ -->
        <?php
        $token = bin2hex(random_bytes(32)); // Génère un jeton CSRF pour éviter les attaques CSRF
        session_start();
        $_SESSION['token'] = $token;
        if (isset($nom)) { // Attends que le nom soit rempli avant d'éxecuter la suite
            $nom = $_POST["Nom"]; // Récupération du nom d'utilisateur
            if (!isset($_SESSION['token']) || !isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) { // Vérifie que l'utilisateur possède le bon jeton CSRF
                die('Erreur: Jeton CSRF invalide');
            }
            if (preg_match('/^[a-zA-Z0-9]*$/', $nom)) { // Vérifie que le nom ne comporte pas de charactères spéciaux
                $sth = $dbh->prepare("SELECT nom FROM utilisateurs WHERE nom = :nom"); // Préparation de la requête SQL qui regarde si le nom existe ou pas
                $sth->execute(array(':nom' => $nom));
                $sth->setFetchMode(PDO::FETCH_NUM);
                $traitement = $sth->execute(); // Execution de la requête
                $resultat->fetchAll(); // Récupère le résultat de la requête
                if ($resultat->rowCount() == 1) {
                    $_SESSION['nom'] = $nom;
                    $_SESSION = array();
                    $_SESSION["nom"] = $nom;
                    header('./jeu.php');
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $sth = $dbh->prepare("INSERT INTO utilisateurs (Nom, Adresse IP) VALUES(:Nom :Adresse IP);"); // Préparation de la requête SQL insérant le nom entré par l'utilisateur
                    $traitement = $sth->execute(['Nom' => $nom, 'Adresse IP' => $ip]); // Execution de la requête
                    if (!$traitement) { // En cas d'erreur on affiche les détails de pourquoi ça à planté
                        print_r($statement->errorInfo());
                        ?><script>alert("Une erreur est survenue.")</script><?php
                    }
                }
            }
            else {
                ?><script>alert("Seuls les caractères alphanumériques sont autorisés");</script><?php
                exit;
            }
        }
        ?>
        <input type="hidden" name="jetonCSRF" value="'.$token.'">
        </form>
        <div class="index_tableau_scores">
            <?php
            $sth = $dbh->prepare("SELECT nom, score_utilisateur, nombre_parties FROM utilisateurs GROUP BY score_utilisateur LIMIT 5");
            $sth->execute();
            $resultat = $sth->fetchAll();
            $i = 1;
            ?>
            <h2 class="tableau_h2">Meilleurs joueurs</h2>
            <table class="tableau_des_scores">
                <tr>
                    <th>Rang</th>
                    <th>Joueur</th>
                    <th>Ratio</th>
                </tr>
            <?php
            foreach($resultat as $tableau_scores){
                $ratio_joueur = $tableau_scores['score_utilisateur']/$tableau_scores['nombre_parties'];
                ?>
                <tr>
                    <td><?= $i?></td>
                    <td><?= $tableau_scores['nom']?></td>
                    <td><?= $ratio_joueur?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </table>
        </div>
    </section>
</body>
</html>
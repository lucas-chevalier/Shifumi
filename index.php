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
require "./database/pdo.php"; // Inclusion du script qui fait la connexion à la bdd
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
        <button type="submit" class="btn btn-primary" href="jeu.php">Jouer</button>
        <!-- ------====== Partie PHP/SQL ======------ -->
        <?php
        $nom = $_POST["Nom"]; // Récupération du nom d'utilisateur
        $sth = $dbh->prepare("INSERT INTO utilisateurs (Nom) VALUES(:Nom)"); // Préparation de la requête SQL
        $traitement = $sth->execute(['Nom' => $nom]); // Execution de la requête
        ?>
        <input type="hidden" id="traitement" value=<?php echo $traitement; ?>/> <!-- Type hidden pour que la variable traitement soit accessible pour le JS -->
        </form>
    </section>
    <script src="etat_connexion.js"></script> <!-- Liaison de notre script javascript qui envoie une alerte en cas d'échec de connexion -->
    <?php
    if(!$traitement){ // En cas d'erreur on affiche les détails de pourquoi ça à planté
        print_r($statement->errorInfo());
      }
    ?>
</body>
</html>
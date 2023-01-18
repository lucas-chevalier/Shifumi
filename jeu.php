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
<body>
<?php
$token = bin2hex(random_bytes(32)); // Génère un jeton CSRF pour éviter les attaques CSRF
session_start();
$_SESSION['token'] = $token;
?>
<input type="hidden" name="jetonCSRF" value="'.$token.'"> <!-- On stocke le jeton CSRF dans le formulaire en caché -->
<?php
require "./database/pdo.php";
$_SESSION["nom"] = "jak";
const PIERRE = 1; // Il serait préférable de remplacer 1 par 'pierre' pour améliorer la visibilité de ton code
const CISEAUX = 2;
const FEUILLE = 3;
$nom = $_SESSION["nom"];
$sth = $dbh->prepare("SELECT nombre_parties FROM utilisateurs WHERE nom = :nom;"); // J'ai remplacé ta requête par une requête préparée
$sth->execute(['nom' => $nom]);
$n_partie = $sth->fetchAll();
list($nb_partie) = $n_partie[0];

$sth = $dbh->prepare("SELECT score_utilisateur FROM utilisateurs WHERE nom = :nom;");
$sth->execute(['nom' => $nom]);
$s_user = $sth->fetchAll();
list($score_user) = $s_user[0];

$sth = $dbh->prepare("SELECT score_hal FROM utilisateurs WHERE nom = :nom;");
$sth->execute(['nom' => $nom]);
$s_hal = $sth->fetchAll();
list($score_hal) = $s_hal[0];
echo $score_user;





if ($_GET != NULL) { //Jeu du shifumi
  
  require 'HAL.php';
  $rep_bot = $_SESSION['HAL'];
  $rep_user = $_GET['rep'];

  if ($rep_user == 3 && $rep_bot == 1) {
    ?>
    Victoire
    <?php
    $score_user = $score_user + 1;
  }  
  elseif ($rep_user < $rep_bot) {
    ?>
    Victoire
    <?php
    $score_user = $score_user + 1;
  }
  elseif ($rep_user > $rep_bot) {
    ?>
    Défaite
    <?php
    $score_hal = $score_hal + 1;
    
  }
  elseif ($rep_user == $rep_bot) {
    ?>
    Egalité
    <?php
  }
  $nb_partie = $nb_partie + 1;
  $statement = $dbh->prepare("UPDATE utilisateurs SET score_utilisateur = :score_utilisateur, score_hal = :score_hal, nombre_parties = :nombre_parties WHERE nom = ':nom'");
  $traitement = $statement->execute(['nom' => $nom, 'score_utilisateur' => $score_user, 'score_hal' => $score_hal, 'nombre_parties' => $nb_partie]);
  if(!$traitement) {
    var_dump($statement->errorInfo());
  }
}
  else {
  $_SESSION['nb_jeux'] = 0;
}







?>
<!-- Partie HTML -->
    <form action="#" method="post" class="jeu_form"> <!-- Le contenu de mon formulaire -->
      <div class="jeu_bouton">
        <input type="radio" name="choix_joueur" value="pierre" id="pierre" class="jeu_input_radio">
        <br>
        <img src="images\fist.png" alt="Pierre" class="jeu_form_img"/>
        <br> <!-- Je me suis permis de remplacer ce que tu avais fait pour que ça colle avec le css -->
        <label for="pierre" class="jeu_label">Pierre</label>
      </div>
      <div class="jeu_bouton">
        <input type="radio" name="choix_joueur" value="feuille" id="feuille" class="jeu_input_radio">
        <br>
        <img src="images\hand.png" alt="Feuille" class="jeu_form_img"/>
        <br>
        <label for="feuille" class="jeu_label">Feuille</label>
      </div>
      <div class="jeu_bouton">
        <input type="radio" name="choix_joueur" value="ciseaux" id="ciseaux" class="jeu_input_radio">
        <br>
        <img src="images\scissors.png" alt="Ciseaux" class="jeu_form_img"/>
        <br>
        <label for="ciseaux" class="jeu_label">Ciseaux</label>
        </div>
      <input type="submit" name="reponse_joueur" value="Je valide mon choix" class="jeu_form_valider">
    </form>
  </div>
</body>
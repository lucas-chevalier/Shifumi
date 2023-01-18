<?php
session_start();
include "./database/pdo.php";

const PIERRE = 1;
const CISEAUX = 2;
const FEUILLE = 3;
$nom = $_SESSION["nom"];
$sth = $dbh->prepare("SELECT nombre_parties FROM utilisateurs WHERE nom = '$nom';");
$sth->execute();
$n_partie = $sth->fetchAll();
list($nb_partie) = $n_partie[0];

$sth = $dbh->prepare("SELECT score_utilisateur FROM utilisateurs WHERE nom = '$nom';");
$sth->execute();
$s_user = $sth->fetchAll();
list($score_user) = $s_user[0];

$sth = $dbh->prepare("SELECT score_hal FROM utilisateurs WHERE nom = '$nom';");
$sth->execute();
$s_hal = $sth->fetchAll();
list($score_hal) = $s_hal[0];

?>

<!DOCTYPE html> 
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  


<?php





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
  $statement = $dbh->prepare("UPDATE utilisateurs SET score_utilisateur = :score_user, score_hal = :score_hal, nombre_parties = :nb_partie WHERE nom = '$nom'");
  
  $traitement = $statement->execute(['score_user' => $score_user,'score_hal' => $score_hal,'nb_partie' => $nb_partie]);
  if(!$traitement) {
    var_dump($statement->errorInfo());
  }
}
  else {
  $_SESSION['nb_jeux'] = 0;
}







?>
<br>
  <a href=jeu.php?rep=<?php echo PIERRE ?>><img src="Images\fist.png" alt=""/></a>
  <a href=jeu.php?rep=<?php echo CISEAUX?>><img src="Images\scissors.png" alt=""/></a>
  <a href=jeu.php?rep=<?php echo FEUILLE?>><img src="Images\hand.png" alt=""/></a>
  
</body>


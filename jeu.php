<?php
session_start();
include "./database/pdo.php";
const PIERRE = 1;
const CISEAUX = 2;
const FEUILLE = 3;
$nom = $_SESSION["nom"];
$sth = $dbh->prepare("SELECT nombre_parties FROM utilisateurs WHERE nom = '$nom';");
$sth->execute();
$nb_partie = $sth->fetchAll();

$sth = $dbh->prepare("SELECT score_utilisateur FROM utilisateurs WHERE nom = '$nom';");
$sth->execute();
$score_user = $sth->fetchAll();

$sth = $dbh->prepare("SELECT score_hal FROM utilisateurs WHERE nom = '$nom';");
$sth->execute();
$score_hal = $sth->fetchAll();



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
$nb_jeux=$_GET;

$_SESSION["jeux_humain"][$nb_jeux];
require 'HAL.php';


if ($_GET != NULL) { //Jeu du shifumi
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
  $statement = $pdo->prepare("UPDATE FROM utilisateur SET score_utilisateur ='$nb_partie', nombre_parties ='$nb_partie', nombre_parties ='$nb_partie' WHERE ID = '$id'"); 
  
  $traitement = $statement->execute();
}
//Comportement du bot HAL






?>
<br>
  <a href=jeu.php?rep=<?php echo PIERRE ?>><img src="Images\fist.png" alt=""/></a>
  <a href=jeu.php?rep=<?php echo CISEAUX?>><img src="Images\scissors.png" alt=""/></a>
  <a href=jeu.php?rep=<?php echo FEUILLE?>><img src="Images\hand.png" alt=""/></a>
  
</body>


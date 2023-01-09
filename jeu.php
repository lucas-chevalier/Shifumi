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
/*require 'config.php';
//include 'config.php';
echo $hostname;
$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $dbuser, $dbpass);
*/
$rep_bot = '2';
$rep_bot = '0';
$rep_user = '0';
if ($_GET != NULL) {
  $rep_user = $_GET['rep'];
  

}
if ($rep_user == 3 && $rep_bot == 1) {
  ?>
  Victoire
  <?php
}
elseif ($rep_user == 0) {

}

elseif ($rep_user < $rep_bot) {
  ?>
  Victoire
  <?php
}
elseif ($rep_user > $rep_bot) {
  ?>
  Défaite
  <?php
}
elseif ($rep_user == $rep_bot) {
  ?>
  Egualité
  <?php
}


?>
<br>
  <a href=jeu.php?rep=1><img src="Images\fist.png" alt=""/></a>
  <a href=jeu.php?rep=2><img src="Images\scissors.png" alt=""/></a>
  <a href=jeu.php?rep=3><img src="Images\hand.png" alt=""/></a>
  
</body>


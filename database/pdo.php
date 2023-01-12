<?php
require("config.env");
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", "PDO::ERRMODE_EXCEPTION"
  ];
$dsn = "mysql:host=$hostname;dbname=$base_de_donnees";
$dbh = new PDO($dsn, $user, $password, $options);
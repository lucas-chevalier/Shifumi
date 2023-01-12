<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'", "PDO::ERRMODE_EXCEPTION"
  ];
$hostname = getenv("hostname");
$base_de_donnees = getenv("base_de_donnees");
$user = getenv("user");
$password = getenv("password");
$dsn = "mysql:host=$hostname;dbname=$base_de_donnees";
$dbh = new PDO($dsn, $user, $password, $options);
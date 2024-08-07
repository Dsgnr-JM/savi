<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$hostConfig = "localhost";
$userConfig = "root";
$passwordConfig = "";
$dbNameConfig = "SAVI";
$charset = "utf8";
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

$pdo = new PDO("mysql:host=$hostConfig;dbname=$dbNameConfig;charset=$charset", $userConfig, $passwordConfig, $options);

define("URI_PATH","http://" . $_SERVER["SERVER_NAME"] . "/SAVI/dashboard/");

?>
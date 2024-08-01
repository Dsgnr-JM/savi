<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$hostConfig = "localhost";
$userConfig = "root";
$passwordConfig = "";
$dbNameConfig = "SAVI";

$pdo = new PDO("mysql:host=$hostConfig;dbname=$dbNameConfig", $userConfig, $passwordConfig);

define("URI_PATH","http://" . $_SERVER["SERVER_NAME"] . "/SAVI/dashboard/");

?>
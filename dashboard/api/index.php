<?php

// require_once "helpers/encryptPassword.php";

// echo encryptText("jotadev0");

if (!isset($_GET["slot"])) return;

// ini_set("display_errors", 1);
// error_reporting(E_ALL);

require_once "../../config.php";
require_once "lib/updatePersonal.php";
require_once "lib/updatePassword.php";
require_once "lib/getData.php";
require_once "lib/updateAditional.php";
require_once "lib/insertClient.php";
require_once "lib/insertData.php";
require_once 'lib/updateData.php';

$action = $_GET["action"] ?? "";
$slot = $_GET["slot"] ?? "";
$message = array("result" => false, "description" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($slot === "profile") {
        if($action === "updatePersonal"){
            echo updateName($pdo, $_POST, $message);
        }
        if($action === "updatePassword"){
            echo updatePassword($pdo, $_POST, $message);
        }     
        if($action === "updateAditional"){
            echo updateAditional($pdo, array_merge($_FILES, $_POST), $message);
        }
    }
    if($slot === "config"){
        if($action === "update"){
            echo updateData($pdo,$slot,$_POST,$message);
        }
    }
    if($slot === "client"){
        if($action === "insert"){
            echo insertClient($pdo, array_merge($_POST,$_FILES), $message);
        }
    }
    if($slot !== "client"){
        if($action === "insert"){
            echo insertData($pdo, $slot ,array_merge($_POST,$_FILES), $message);
        }
    }
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo getData($pdo, $slot, $_GET);
}
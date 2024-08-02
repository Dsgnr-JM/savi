<?php
if (!isset($_GET["slot"])) return;

// ini_set("display_errors", 1);
// error_reporting(E_ALL);

require_once "../../config.php";
require_once "lib/updatePersonal.php";
require_once "lib/updatePassword.php";
require_once "lib/getData.php";
require_once "lib/updateAditional.php";
require_once "lib/getProducts.php";
require_once "lib/getClients.php";

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
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["ci"]) && $slot === "profile"){
        echo getUser($pdo, $_GET["ci"]);
    }
    if($slot === "products"){
        echo getProducts($pdo);
    }
    if($slot === "clients"){
        echo getClients($pdo);
    }
}

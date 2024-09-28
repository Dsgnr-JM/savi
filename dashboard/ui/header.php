<?php
    session_start();
if (!isset($_SESSION["session"]) || empty(($_SESSION["session"]))) {
    if(file_exists("../logout.php")) return header("Location: ../logout.php");
    header("Location: ./logout.php");
}
header('Content-Type: text/html; charset=utf-8');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SAVI/global.css">
    <link rel="stylesheet" href="/SAVI/dashboard/globals.css">
    <link rel="stylesheet" type="text/css" href="/SAVI/lib/bell.css">
    <script src="/SAVI/dashboard/lib/scrollreveal.min.js"></script>
    <script type="module" defer src="/SAVI/dashboard/lib/nav-bar.js"></script>
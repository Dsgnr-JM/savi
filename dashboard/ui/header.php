<?php
    session_start();
if (!isset($_SESSION["session"]) || empty(($_SESSION["session"]))) {
    header("Location: ./logout.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SAVI/global.css">
    <link rel="stylesheet" href="/SAVI/dashboard/globals.css">
    <link rel="stylesheet" type="text/css" href="/SAVI/lib/bell.css">
    <script type="module" defer src="/SAVI/dashboard/lib/nav-bar.js"></script>
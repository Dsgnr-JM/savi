<?php

require_once './config.php';
if (isset($_POST)) {
    header("Content-Type: application/json");
    extract($_POST); // $name, $surname, $ci, $username, $password, $terms
    if (isset($surname)) {
        try {
            $pdo = new PDO("mysql:host=$hostConfig;dbname=$dbNameConfig", $userConfig, $passwordConfig);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM tb_users WHERE username = :username OR ci = :ci");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":ci", $ci);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result['count'] > 0) {
                $response = array("message" => "El email o usuario ya esta en uso", "success" => false, "error" => 1);
            } else {
                $stmt = $pdo->prepare("INSERT INTO tb_users (name ,surname ,ci ,phone , username, password, role, photo) VALUES (:name, :surname, :ci, :phone, :username, :password, 'seller', '')");
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":surname", $surname);
                $stmt->bindParam(":ci", $ci);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password);
                $stmt->execute();
                $response = array("message" => "Usuario registrado correctamente", "success" => true);
            }
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("message" => "Error en el servidor" . $e->getMessage(), "success" => false);
            echo json_encode($response);
        }
    }
    if (isset($_POST['login'])) {
        session_start();
        try {
            $pdo = new PDO("mysql:host=$hostConfig;dbname=$dbNameConfig", $userConfig, $passwordConfig);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("SELECT * FROM tb_users WHERE username = :username AND password = :password");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                $_SESSION["session"] = $user["ci"];
                $response = array("message" => "Usuario validado correctamente", "success" => true);
            } else {
                $response = array("message" => "Datos invalidos", "success" => false);
            }
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("message" => "Error en el servidor" . $e->getMessage(), "success" => false);
            echo json_encode($response);
        }
        exit();
    }
}

<?php 
    $method = $_SERVER["REQUEST_METHOD"];
    require_once "../config.php";

    try{
        $pdo = new PDO("mysql:host=$hostConfig;dbname=$dbNameConfig;", $userConfig, $passwordConfig);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $response;
        if($method === "GET"){

        }else if($method === "POST"){
            if($_GET["target"] === "supplier"){
                extract($_POST);
                $stmt = $pdo->prepare("INSERT INTO supliers (suplier_rif, suplier_name, suplier_image, suplier_phone, suplier_email, suplier_location)VALUES(:rif, :name, 'img', :phone, :email, :location)");
                $stmt->bindParam(":rif",$rif);
                $stmt->bindParam(":name",$name);
                $stmt->bindParam(":phone",$phone);
                $stmt->bindParam(":email",$email);
                $stmt->bindParam(":location",$location);
                $stmt->execute();
                $response = array("message" => "Proveedor registrado correctamente", "success" => true);
            }elseif ($_GET["target"] === "product") {
                extract($_POST);
                $stmt = $pdo->prepare("INSERT INTO product (code, name, description, photo, price, category, models, brad, supplier) VALUES (:code, :name, :description, 'hola', :price, :category, :models, :brad, :supplier)");
                $stmt->bindParam(":code",$code);
                $stmt->bindParam(":name",$name);
                $stmt->bindParam(":description",$description);
                $stmt->bindParam(":price",$price);
                $stmt->bindParam(":category",$category);
                $stmt->bindParam(":models",$models);
                $stmt->bindParam(":brad",$brad);
                $stmt->bindParam(":supplier",$supplier);
                $stmt->execute();
                $stmt = $pdo->prepare("INSERT INTO inventary (code_products, inventary_stock, inventary_stock_min, inventary_stock_max) VALUES (:code, :stock, :stock_min, :stock_max)");
                $stmt->bindParam(":code_products",$code_products);
                $stmt->bindParam(":stock",$stock);
                $stmt->bindParam(":stock_min",$stock_min);
                $stmt->bindParam(":stock_max",$stock_max);
                $stmt->execute();
                $response = array("message" => "Producto registrado correctamente", "success" => true);
            }

        }elseif($method === "PUT"){

        }elseif($method === "DELETE"){

        }
        echo json_encode($response);
        
    }catch(PDOException $e){
        $response = array("message" => "Error en el servidor" . $e->getMessage(), "success" => false);
            echo json_encode($response);
    }

 ?>
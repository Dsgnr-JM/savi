<?php

function updateData(PDO $pdo,String $slot,Array $data,Array $message){
    $operationsSQL = array(
        "config" => "UPDATE config SET dollar_price = :dollar_price,date = :date WHERE id = 1",
        "role" => "UPDATE role SET manage_stadistics = :manage_stadistics,manage_products = :manage_products,
        manage_clients = :manage_clients,
        manage_informs = :manage_informs,
        manage_providers = :manage_providers,
        manage_sales = :manage_sales,
        manage_system = :manage_system,
        manage_expenses= :manage_expenses WHERE role = :role",
        "client" => "UPDATE client SET dni = :dni, name = :name,image = :photo, surname = :surname, phone = :phone,location = :location WHERE dni = :key",
        "product" => "UPDATE product SET code = :code, name = :name,photo = :photo, selling_price = :selling_price, purchase_price = :purchase_price, category = :category, supplier = :supplier,stock_min = :stock_min, stock_max = :stock_max WHERE code = :key",
        "supplier" => "UPDATE supliers SET rif = :rif, name = :name, manager = :manager, phone = :phone, email = :email, location = :location, image = :photo WHERE rif = :key",
        "sale" => "UPDATE sale SET payment = :payment, status = :status WHERE nro_factura = :key"
    );
    $operationsImageSQL = array(
        "product" => "SELECT photo as image FROM product where code = :key",
        "client" => "SELECT image from client where dni = :key",
        "supplier" => "SELECT image from supliers WHERE rif = :key"
    );
    
    if($slot == "config"){
        date_default_timezone_set("America/Caracas");
        $data["date"] = date("Y-m-d");
    }
    try{
        if($slot == "client"){
            $data = handlerRepeatClient($pdo,$data);
        }
        if($slot == "sale"){
            $data = changeStatusOfSale($pdo,$data);
        }
        $sql = $operationsSQL[$slot];
        $stmt = $pdo->prepare($sql);


        $keys = array_keys($data);
        $keyLog = array_filter($keys,function($item){
            return $item == "code" || $item == "dni" || $item == "rif" || $item == "id" || $item == "category_id" || $item == "ci" || $item == "nro_factura";
        });
        $keyLog = $data[implode("",$keyLog)] ?? "";
        $i = 0;
        foreach($keys as $key){
            $i++;
            if($key == "photo" || $key == "image") {
                $sqlImage = $operationsImageSQL[$slot];
                $stmtImage = $pdo->prepare($sqlImage);
                $stmtImage->bindParam(":key",$data["key"]);
                $stmtImage->execute();
                $result = $stmtImage->fetch(PDO::FETCH_ASSOC);
                $file_name = $result["image"];
                if(!empty($data[$key]["tmp_name"])){
                    $file_name = uploadFile($data[$key],$result["image"]);
                }

                $stmt->bindParam(":photo", $file_name);
                continue;
            };
            if($key == "on") $key = true;
            //echo $key. "---".$data[$key]."\n";

            $stmt->bindParam(":$key", $data[$key]);
        }
        $result = $stmt->execute();
        $message["result"] = true;
        $message["description"] = "Successfully update";

        require_once 'lib/createLog.php';

        createLog($pdo,"update",$slot,$keyLog);
    }catch (PDOException $e) {
        $message["description"] = $e->getMessage();
        return json_encode($message);
    }
    return json_encode($message);
}

function handlerRepeatClient(PDO $pdo, array $data){
    $sql = "SELECT COUNT(*) as total FROM client_enterprise where dni = :key";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":key",$data["key"]);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    $sql = "UPDATE client_enterprise SET enterprise_name = :enterprise_name WHERE dni = :key";
    if($result == 0) $sql = "INSERT INTO client_enterprise (dni,enterprise_name) VALUES(:key,:enterprise_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":enterprise_name",$data["enterprise_name"]);
    $stmt->bindParam(":key",$data["key"]);
    $stmt->execute();
    unset($data["enterprise_name"]); 
    return $data;
}
function changeStatusOfSale(PDO $pdo,array $data){
    try{
        $sql = "select ROUND(sum(p.selling_price * sp.amount) * 1.16,2) as total from sale s JOIN sale_product sp ON s.nro_factura = sp.nro_factura JOIN product p ON p.code = sp.product WHERE s.nro_factura = :key";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":key",$data["key"]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $data["status"] = $data["payment"] >= $result["total"] ? "complete" : "pending";
        return $data;

    }catch(PDOException $e){
        return $e->getMessage();
    }
}
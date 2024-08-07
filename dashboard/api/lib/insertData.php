<?php

require_once "helpers/uploadFile.php";

function insertData(PDO $pdo, string $operation, array $data, array $message)
{
    try{
        $operationsSQL = array(
            "product" => "INSERT INTO product (code, name, photo, selling_price, purchase_price, category, models, brand, supplier, stock, stock_min, stock_max) VALUES (:code, :name, :photo, :selling_price, :purchase_price, :category, :models, :brand, :supplier, :stock, :stock_min, :stock_max)",
        );

        $sql = $operationsSQL[$operation];

        $stmt = $pdo->prepare($sql);

        $keys = array_keys($data);
        
        foreach($keys as $key){

            if($key == "photo" || $key == "image") {
                $file_name = "";

                if(!empty($data[$key]["tmp_name"])){
                    $file_name = uploadFile($data[$key]);
                }

                $stmt->bindParam(":photo", $file_name);
                continue;
            };

            $stmt->bindParam(":$key", $data[$key]);
        }
        $stmt->execute();

        $message["result"] = true;
        $message["description"] = "Successfully insert product";

    }catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);

}
?>
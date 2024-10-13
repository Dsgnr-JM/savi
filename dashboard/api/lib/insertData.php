<?php

require_once "helpers/uploadFile.php";

function insertData(PDO $pdo, string $operation, array $data, array $message)
{
    try{
        $operationsSQL = array(
            "product" => "INSERT INTO product (code, name, photo, selling_price, purchase_price, category, supplier,stock, stock_min, stock_max,isRemoved) VALUES (:code, :name, :photo, :selling_price, :purchase_price, :category, :supplier,0, :stock_min, :stock_max,0)",
            "category" => "INSERT INTO category (category_name) VALUES(:category_name)",
            "supplier" => "INSERT INTO supliers (rif,name,image,phone,manager,email,location) VALUES (:rif,:name,:photo,:phone,:manager,:email,:location)"
        );

        $sql = $operationsSQL[$operation];

        $stmt = $pdo->prepare($sql);

        $keys = array_keys($data);
        $keyLog = array_filter($keys,function($item){
            return $item == "code" || $item == "dni" || $item == "rif" || $item == "id" || $item == "category_id" ??$item == "ci";
        });
        $keyLog = $data[implode("",$keyLog)] ?? "";
        
        foreach($keys as $key){

            if($key == "photo" || $key == "image") {
                $file_name = "";

                if(!empty($data[$key]["tmp_name"])){
                    $file_name = uploadFile($data[$key],"");
                }

                $stmt->bindParam(":photo", $file_name);
                continue;
            };

            $stmt->bindParam(":$key", $data[$key]);
        }
        $stmt->execute();

        $message["result"] = true;
        $message["description"] = "Successfully insert";
        require_once 'lib/createLog.php';
        createLog($pdo,"insert",$operation,$keyLog);

    }catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);

}
?>
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
        manage_expenses= :manage_expenses WHERE role = :role"
    );
    if($slot == "config"){
        date_default_timezone_set("America/Caracas");
        $data["date"] = date("Y-m-d");
    }
    try{
        $sql = $operationsSQL[$slot];
        $stmt = $pdo->prepare($sql);

        $keys = array_keys($data);
        
        foreach($keys as $key){

            // if($key == "photo" || $key == "image") {
            //     $file_name = "";

            //     if(!empty($data[$key]["tmp_name"])){
            //         $file_name = uploadFile($data[$key]);
            //     }

            //     $stmt->bindParam(":photo", $file_name);
            //     continue;
            // };
            if($key == "on") $key = true;
            //echo $key. "---".$data[$key]."\n";

            $stmt->bindParam(":$key", $data[$key]);
        }
        $stmt->execute();
        $message["result"] = true;
        $message["description"] = "Successfully update config";

        require_once 'lib/createLog.php';

        createLog($pdo,"update",$slot);
    }catch (PDOException $e) {
        $message["description"] = $e->getMessage();
        return json_encode($message);
    }
    return json_encode($message);
}

?>
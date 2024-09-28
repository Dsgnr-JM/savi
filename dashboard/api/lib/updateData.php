<?php

function updateData(PDO $pdo,String $slot,Array $data,Array $message){
    $operationsSQL = array(
        "config" => "UPDATE config SET dollar_price = :dollar_price,date = :date WHERE id = 1"
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

            $stmt->bindParam(":$key", $data[$key]);
        }
        $stmt->execute();
        $message["result"] = true;
        $message["description"] = "Successfully update config";

        require_once 'lib/createLog.php';

        createLog($pdo,"update",$slot);
    }catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}

?>
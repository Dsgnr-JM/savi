<?php 
    function insertClient(PDO $pdo, array $data, array $message){
        try {
            $sql = "INSERT INTO client (dni, name, surname, phone, image, location)VALUES(:dni, :name,:surname, :phone,'',:location)";
            $stmt = $pdo->prepare($sql);          
            if(isset($data["image"]) && !empty($data["image"]["name"])){
                $typesImage = array(
                    "image/png" => ".png",
                    "image/jpg" => ".jpg"
                );
                $destination_folder = "../assets/img/";
                $file = $data["image"];
                $file_type = $typesImage[$file["type"]];   
                $file_name = uniqid() . $file_type; 
                $tmp_name = $file['tmp_name'];
                $file_name_destination = $destination_folder . $file_name;
 
                if(empty($file_type)) {
                    $message["result"] = false;
                    $message["description"] = "Image format not supported";
                    return json_encode($message);
                }

                move_uploaded_file($tmp_name, $file_name_destination);

                $sql = "INSERT INTO client (dni, name, surname, phone, image, location)VALUES(:dni, :name,:surname, :phone,'$file_name',:location)";
            }

            $stmt->bindParam(":dni", $data["dni"]);
            $stmt->bindParam(":name", $data["name"]);
            $stmt->bindParam(":surname", $data["surname"]);
            $stmt->bindParam(":phone", $data["phone"]);
            $stmt->bindParam(":location", $data["location"]);

            $stmt->execute();

            if(!empty($data["enterprise-name"])){
                $stmt = $pdo->prepare("INSERT INTO client_enterprise VALUES(NULL, :dni,:client_enterprise)");
                $stmt->bindParam(":dni", $data["dni"]);
                $stmt->bindParam(":client_enterprise", $data["enterprise-name"]);
                $stmt->execute();
            }

            $message["result"] = true;
            $message["description"] = "Successfully insert client";
        } catch (PDOException $e) {
            $message["description"] = $e;
            return json_encode($message);
        }
        return json_encode($message);
    }
?>
<?php
function updateAditional(PDO $pdo, array $data, array $message)
{
    try {

        if(isset($data["image"])){

            $stmt = $pdo->prepare("SELECT photo FROM tb_users WHERE ci = :ci");
            $stmt->bindParam(":ci", $data["ci"]);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $destination_folder = "./";
            $file = $data["image"];
            $file_name = $file["name"];
            $tmp_name = $file['tmp_name'];

            if(!empty($result["image"])){
                $file_name = $result["image"];
            }
            echo $tmp_name . $destination_folder . $file_name;

            move_uploaded_file($tmp_name, $destination_folder . $file_name);
        }

        // $stmt = $pdo->prepare("UPDATE tb_users SET phone = :phone, image = :image WHERE ci = :ci");
        // $stmt->bindParam(":ci", $data["ci"]);
        // $stmt->bindParam(":phone", $data["phone"]);
        // $stmt->bindParam(":image", $data["image"]);

        // $stmt->execute();


        $message["result"] = true;
        $message["description"] = $result;
    } catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}
<?php
function updateAditional(PDO $pdo, array $data, array $message)
{
    try {

        if(isset($data["image"])){

            $stmt = $pdo->prepare("SELECT photo FROM tb_users WHERE ci = :ci");
            $stmt->bindParam(":ci", $data["ci"]);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $typesImage = array(
                "image/png" => ".png",
                "image/jpg" => ".jpg"
            );

            $destination_folder = "../assets/img/";
            $file = $data["image"];
            $file_name = $result["photo"] ?? "";
            $file_type = $typesImage[$file["type"]];

            if(empty($file_type)) {
                $message["result"] = false;
                $message["description"] = "Image format not supported";
                return json_encode($message);
            }

            $tmp_name = $file['tmp_name'];
            $file_name_destination = $destination_folder . $file_name . $file_type;

            if(empty($result["image"])){
                $file_name = uniqid() . $file_type;
                $file_name_destination = $destination_folder . $file_name;
                $stmt = $pdo->prepare("UPDATE tb_users SET photo = :photo WHERE ci = :ci");
                $stmt->bindParam(":ci", $data["ci"]);
                $stmt->bindParam(":photo", $file_name_destination);
                $stmt->execute();
            }

            move_uploaded_file($tmp_name, $file_name_destination);
        }

        $stmt = $pdo->prepare("UPDATE tb_users SET phone = :phone WHERE ci = :ci");
        $stmt->bindParam(":ci", $data["ci"]);
        $stmt->bindParam(":phone", $data["phone"]);

        $stmt->execute();

        $message["result"] = true;
        $message["description"] = "Change of successfull information";
    } catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}
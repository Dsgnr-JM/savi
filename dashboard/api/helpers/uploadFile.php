<?php
    function uploadFile(array $file)
    {
        $typesImage = array(
            "image/png" => ".png",
            "image/jpg" => ".jpg",
            "image/jpeg" => ".jpeg",
        );

        $destination_folder = "../assets/img/";
        $file_type = $typesImage[$file["type"]];
        $file_name = uniqid() . $file_type;
        $tmp_name = $file['tmp_name'];
        $file_name_destination = $destination_folder . $file_name;
        move_uploaded_file($tmp_name, $file_name_destination);

        return $file_name_destination;
    }
?>
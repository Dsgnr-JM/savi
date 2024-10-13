<?php
    function uploadFile(array $file, string $dir)
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
        $file_name_destination = empty($dir) ? $destination_folder . $file_name : $dir;
        move_uploaded_file($tmp_name, $file_name_destination);

        return $file_name_destination;
    }
?>
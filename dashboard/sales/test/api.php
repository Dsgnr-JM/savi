<?php
if($_POST){
    $data = file_get_contents("php://input");
    var_dump($data);
}
?>
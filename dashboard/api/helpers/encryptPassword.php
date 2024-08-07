<?php

function encryptText(string $text){
    $textEncrypt = hash("md5", $text);
    return $textEncrypt;
}

function decodeText(string $text){
    $textDesencripted = hash("md5", $text);;
    return $textDesencripted;
}

?>
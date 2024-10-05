<?php

    function template(string $template,array $data=[]){
        extract($data);
        require_once 'templates/'.$template.".php";
    };
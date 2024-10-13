<?php

function matchWords(string $word)
{
    $word = explode(" ",$word);
    for ($i=0; $i < count($word); $i++) { 
        if($i % 2) $word[$i] = "<strong>$word[$i]</strong>";
    }

    return implode(" ",$word);
}

?>
<?php

$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

for($i = 0; $i < strlen($alphabet); $i++){
    $numAlph[$alphabet[$i]] = $i;
}

function Encode($text, $key){
    global $alphabet, $numAlph;
    $code = "";
    
    for($i = 0; $i < strlen($text); $i++){
        $code .= $alphabet[($numAlph[$text[$i]] + $numAlph[$key[$i % strlen($key)]]) % strlen($alphabet)];
    }
    return $code;
}

function Decode($text, $key){
    global $alphabet, $numAlph;
    $code = "";
    
    for($i = 0; $i < strlen($text); $i++){
        $code .= $alphabet[($numAlph[$text[$i]] - $numAlph[$key[$i % strlen($key)]]) % strlen($alphabet)];
    }
    return $code;
}

echo "encoded  word: " . Encode("STUDENT", "EXAM") . "\n";
echo "encoded  word: " . Decode("WQUPIKT", "EXAM") . "\n";
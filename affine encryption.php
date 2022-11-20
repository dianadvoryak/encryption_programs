<?php

$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

for($i = 0; $i < strlen($alphabet); $i++){
    $numAlph[$alphabet[$i]] = $i;
}

function getInvMultKey($multKey){
    global $alphabet;
    
    if($multKey < 0 || $multKey > strlen($alphabet)){
        $multKey = $multKey % strlen($alphabet) + strlen($alphabet);
    }
    for($i = 0; $i < strlen($alphabet); $i++){
        if($multKey * $i % strlen($alphabet) == 1){
            $invMultKey = $i;
            echo "multiplicative key inversion = " . $invMultKey . "\n";
            return $invMultKey;
        }
    }
    echo "no inversion input, try another key\n";
    return;
}

function Encode($txt, $addKey, $multKey){
    global $alphabet, $numAlph;
    $code = "";
    
    $invMultKey = getInvMultKey($multKey);
    if(!$invMultKey) return;
    
    for($i = 0; $i < strlen($txt); $i++){
        
        $code .=  $alphabet[($numAlph[$txt[$i]] * $multKey + $addKey) % strlen($alphabet)];
    }
    return $code;
}

function Decode($txt, $addKey, $multKey){
    global $alphabet, $numAlph;
    $code = "";
    
    $invMultKey = getInvMultKey($multKey);
    if(!$invMultKey) return;
    
    for($i = 0; $i < strlen($txt); $i++){
        $code .=  $alphabet[(($numAlph[$txt[$i]] - $addKey) * $invMultKey) % strlen($alphabet)];
    }
    return $code;
}

echo Encode("STUDENT", 2, 3) . "\n";
echo Decode("EHKLOPH", 2, 3);


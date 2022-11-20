<?php

function prepare($keyword, $code){
    $alphabet = "ABCDEFGHIJKLMNOPRSTUVWXYZ";
    
    $keyword = join(array_unique(str_split($keyword)));
    
    // удаление букв ключевого слова из алфавита
    $alphabet = preg_replace('/[' . $keyword . ']/', '', $alphabet);
    
    $alphabet = $keyword . $alphabet;
    
    // ввод данных в массив
    $k = 0;
    for($i = 0; $i < 5; $i++){
        for($j = 0; $j < 5; $j++){
            $matrix[$i][$j] = $alphabet[$k];
            $k++;
        }
    }
    
    for($i = 0; $i < 5; $i++){
        for($j = 0; $j < 5; $j++){
            echo $matrix[$i][$j] . " ";
        }
        echo "\n";
    }
    
    // обработка дублирования в биграмме
    $code = preg_replace('/(\w)\1/', '$1'.'X'.'$1', $code);
    
    // добавление символа в неполную биграмму
    if(strlen($code) % 2 != 0) $code .= 'X';
    
    // формирование биграмм
    for($i = 0; $i < strlen($code); $i+=2){
        echo $code[$i] . $code[$i + 1] . " ";
    }
    
    // нахождение индексов в матрице
    $index = '';
    for($i = 0; $i < strlen($code); $i++){
        for($j = 0; $j < 5; $j++){
            for($k = 0; $k < 5; $k++){
                if($code[$i] == $matrix[$j][$k]){
                    $index .= $j . $k;
                }
            }
        }
    }
    echo "\n" . $index;
    return [$index, $matrix];
}

function Encode($keyword, $code){
    [$index, $matrix] = prepare($keyword, $code);
    
    $a = 0;
    $b = 0;
    echo "\nencrypted sequence: \n";
    for($i = 0; $i < strlen($index)-3; $i += 4){
        // если на одной строке
        $a = $index[$i + 3] + 1;
        if($index[$i] == $index[$i + 2] && $a < 5){
            echo $matrix[$index[$i]][$index[$i + 1] + 1] . $matrix[$index[$i + 2]][$a] . " ";
        }
        // если на одной строке и у края
        if($index[$i] == $index[$i + 2] && $a >= 5){
            $a = 0;
            echo $matrix[$index[$i]][$index[$i + 1] + 1] . $matrix[$index[$i + 2]][$a] . " ";
        }
        // если в одном столбце
        $b = $index[$i + 2] + 1;
        if($index[$i + 1] == $index[$i + 3] && $b < 5){
            echo $matrix[$index[$i] + 1][$index[$i + 1]] . $matrix[$b][$index[$i + 3]] . " ";
        }
        // если в одном столбце и у края
        if($index[$i + 1] == $index[$i + 3] && $b >= 5){
            $b = 0;
            echo $matrix[$index[$i] + 1][$index[$i + 1]] . $matrix[$b][$index[$i + 3]] . " ";
        }
        
        if($index[$i] != $index[$i + 2] && $index[$i + 1] != $index[$i + 3]){
            echo $matrix[$index[$i + 2]][$index[$i + 1]] . $matrix[$index[$i]][$index[$i + 3]] . " ";
        }
    }
}

function Decode($keyword, $code){
    [$index, $matrix] = prepare($keyword, $code);
    
    $a = 0;
    $b = 0;
    echo "\ndecrypted sequence: \n";
    for($i = 0; $i < strlen($index)-3; $i +=4){
        
        // если на одной строке
        $a = $index[$i + 3] - 1;
        if($index[$i] == $index[$i + 2] && $a >= 0){
            echo $matrix[$index[$i]][$index[$i + 1] - 1] . $matrix[$index[$i + 2]][$a] . " ";
        }
        // если на одной строке и у края
        if($index[$i] == $index[$i + 2] && $a < 0){
            $a = 4;
            echo $matrix[$index[$i]][$index[$i + 1] - 1] . $matrix[$index[$i + 2]][$a] . " ";
        }
        
        // если в одном столбце
        $b = $index[$i + 2] - 1;
        if($index[$i + 1] == $index[$i + 3] && $b >= 0){
            echo $matrix[$index[$i] - 1][$index[$i + 1]] . $matrix[$b][$index[$i + 3]] . " ";
        }
        // если в одном столбце и у края
        if($index[$i + 1] == $index[$i + 3] && $b < 0){
            $b = 4;
            echo $matrix[$index[$i] - 1][$index[$i + 1]] . $matrix[$b][$index[$i + 3]] . " ";
        }
        
        if($index[$i] != $index[$i + 2] && $index[$i + 1] != $index[$i + 3]){
            echo $matrix[$index[$i + 2]][$index[$i + 1]] . $matrix[$index[$i]][$index[$i + 3]] . " ";
        }
    }
}

echo Encode("CAT", "STUDENT") . "\n\n";
echo Decode("CAT", "BRZIJIGT") . "\n";








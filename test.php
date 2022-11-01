<?php

$line = '1 6 4 3';

$arr = explode(' ', $line);

$uarr = array_unique($arr);

function getMode ($keys, $values) {
    $modes = array_fill_keys($keys, 0);
    foreach ($keys as $key) {
        foreach ($values as $value) {
            if ($key == $value) {
                $modes[$key] += 1;
            }
        }
    }
    $maxent = array_keys($modes, max($modes));
    return implode($maxent);
}

//$a = getMode($uarr, $arr);
//print_r($a);

$zeroarr = [];
for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i] == 0) {
        $zeroarr[] = $arr[$i];
    }
}

$nearr = array_diff($arr, [0]);
$result = array_merge($nearr, $zeroarr);

//print_r($result);


function getMult (array $arr, $index) {

    if ($index != 0) {
        $mod = 0;
        $mult = $arr[0];
    } else {
        $mod = 1;
        $mult = $arr[1];
    }
    foreach ($arr as $i => $n) {
        if ($index != $i && $i != $mod) {
            $mult *= $n;
        }

    }

    return $mult;
}

function calc (array $arr) {
    $result = [];
    foreach ($arr as $i => $num) {
        $result[] = getMult($arr, $i);
    }
    return $result;
}

//$a = calc([4, 2, 3]);
//print_r(implode(' ', $a));

function getMaxDiv (array $arr) {
    $result = [];

    for ($i = 0; $i < count($arr); $i ++) {
        for ($j = $i; $j < count($arr); $j ++) {
            $result[] = $arr[$i] - $arr[$j];
        }
    }
    print_r($result);
    return max($result);
}

//$a = getMaxDiv([1, 6, 4, 3]);
//print_r($a);

function getCombo (array $arr) {
    $combo = [];

    foreach ($arr as $i => $n) {
        foreach ($arr as $ii => $nn) {
            $combo[] = [$n, $nn];
        }
    }

    $result = array_filter($combo, function ($item) {
        if ($item[0] != $item[1]) {
            return $item;
        }
        return null;
    });

    $merged = [];
    foreach ($result as $arr) {
        $merged[] = implode(' ', $arr);
    }

    return $merged;
}

//$res = getCombo([1, 2, 3, 4]);
//
//
//
//print_r(implode(' ', $res));

$arr = [3, 2, 1, 6, 1, 2, 10];
$count = count($arr);
$profit = 0;
for ($i = 1; $i < $count; $i++) {
    if ($arr[$i] > $arr[$i-1]) {
        $d = $arr[$i] - $arr[$i-1];
        $profit += $d;
    }
}
echo $profit;
//
//getProfit([3, 2, 1, 6, 2, 10]);



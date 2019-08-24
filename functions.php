<?php
if (session_id() == '') {
    session_start();
}
if (isset($_SESSION['grid'])) {
	$array = $_SESSION['grid'];
} else {
    $array = ['','','','','','','','',''];
    $_SESSION['grid'] = $array;
}
if (isset($_POST['new'])) {
    $new = $_POST['new'];
    if ($new == 'new') {
        $array = ['','','','','','','','',''];
        $_SESSION['grid'] = $array;
    }
}
if (isset($_POST['index'])) {
    $index = $_POST['index'];
    if (preg_match('/^[0-8]{1}$/', $index)) {
        $array[$index] = 'X';
        $_SESSION['grid'] = $array;
    }
}
$count = count(array_filter($array));
if ($count % 2 == 1) {
    $turn = 'O';
} else {
    $turn = 'X';
}
$winners = [
    [0,1,2],
    [3,4,5],
    [6,7,8],
    [0,4,8],
    [2,4,6],
    [0,3,6],
    [1,4,7],
    [2,5,8]
];
$win = 'F';
$tie = 'F';
foreach ($winners as $arr) {
    if (($array[$arr[0]] == $array[$arr[1]]) &&
        ($array[$arr[0]] == $array[$arr[2]]) &&
        ($array[$arr[0]]) != '') {
        $win = 'T';
        $winner = $arr;
    }
}
if (($count == 9) && ($win == 'F')) {
    $tie = 'T';
}
if (($turn == 'O') && ($count <= 9)  && ($win == 'F')  && ($tie == 'F')) {
    $a = ['','','','','','','','',''];
    $intersect = array_intersect_assoc($a,$array);
    shuffle($winners);
    $okeys = array_keys($array,'O');
    $xkeys = array_keys($array,'X');
    $n = 0;
    // check if O can win, and win
    foreach ($winners as $winner) {
        $counto = count(array_intersect($winner,$okeys));
        if ($counto == 2) {
            $countx = count(array_intersect($winner,$xkeys));
            if ($countx != 1) {
                $n = 2;
                $twos = array_intersect($winner,$okeys);
                $one = array_values(array_diff($winner,$twos));
                $key = $one[0];
                break;
            }
        }
    }
    // check if X can win, and block
    if ($n != 2) {
        foreach ($winners as $winner) {
            $counto = count(array_intersect($winner,$xkeys));
            if ($counto == 2) {
                $countx = count(array_intersect($winner,$okeys));
                if ($countx != 1) {
                    $n = 2;
                    $twos = array_intersect($winner,$xkeys);
                    $one = array_values(array_diff($winner,$twos));
                    $key = $one[0];
                    break;
                }
            }
        }
    }
    if (($n != 2) && (count($intersect) <= 9)) {
        $key = array_rand($intersect);
    }
    $array[$key] = 'O';
    $_SESSION['grid'] = $array;
    header('location: ./');
}

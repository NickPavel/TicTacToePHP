<?php 
if (session_status() != 2) {
	session_start();
}
function presets() {
	$array = ['','','','','','','','',''];
    $_SESSION['grid'] = $array;
    $_SESSION['xpoints'] = 0;
    $_SESSION['opoints'] = 0;
    $_SESSION['tiepoints'] = 0;
    $_SESSION['switch'] = 'Yes';
    $_SESSION['start'] = 'First';
}
if (isset($_POST['reset'])) {
	if (is_numeric($_POST['reset'])) {
		$_SESSION = array();
	}
}
if ($_SESSION == array()) {
	presets();
}
if (isset($_SESSION['grid'])) {
	$array = $_SESSION['grid'];
}
if (isset($_POST['new'])) {
    if (is_numeric($_POST['new'])) {
        $array = ['','','','','','','','',''];
        $start = $_SESSION['start'];
        $_SESSION['grid'] = $array;
		if ($_SESSION['switch'] == 'Yes') {
		$_SESSION['start'] = ($start == 'First') ? 'Second' : 'First';
		}	
    }
}
if (isset($_POST['index'])) {
    $index = $_POST['index'];
    if (preg_match('/^[0-8]{1}$/', $index)) {
        $array[$index] = 'X';
        $_SESSION['grid'] = $array;
    }
}
if (isset($_POST['switch'])) {
    if (is_numeric($_POST['switch'])) {
		$switch = $_SESSION['switch'];
		$_SESSION = array();
		presets();
	    $_SESSION['switch'] = ($switch == 'Yes') ? 'No' : 'Yes';
    }
}
if (isset($_POST['start'])) {
    if (is_numeric($_POST['start'])) {
		$start = $_SESSION['start'];
		$switch = $_SESSION['switch'];
		$_SESSION = array();
		presets();
	    $_SESSION['start'] = ($start == 'First') ? 'Second' : 'First';
	    $_SESSION['switch'] = $switch;
    }
}
$array = $_SESSION['grid'];
$count = count(array_filter($array));
if ($count % 2 == 1) {
    $turn = ($_SESSION['start'] == 'First') ? 'O' : 'X';
} else {
    $turn = ($_SESSION['start'] == 'First') ? 'X' : 'O';
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
        $_SESSION['xpoints'] = $_SESSION['xpoints'] + 1;
        $winner = $arr;
    }
}
if (($count == 9) && ($win == 'F')) {
    $tie = 'T';
    $_SESSION['tiepoints'] = $_SESSION['tiepoints'] + 1;
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
                $_SESSION['opoints'] = $_SESSION['opoints'] + 1;
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
    // randomly choose an empty box
    if (($n != 2) && (count($intersect) <= 9)) {
        $key = array_rand($intersect);
    }
    $array[$key] = 'O';
    $_SESSION['grid'] = $array;
    header('location: ./');
}

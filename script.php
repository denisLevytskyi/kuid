<?php

$step = $_POST['step'];
$stop = $_POST['stop'];
$kuid = explode($stop, $_POST['kuid']);
$miss = 0;
$kuid_list = array();
$kuid_list_control = array();

foreach ($kuid as $key => $value) {
    if (in_array($value, $kuid_list_control) == false) {
        array_push($kuid_list_control, $value);
        array_push($kuid_list, $value);
    } else {
        $miss++;
    };
    if ( (count($kuid_list) == $step) || ($key == count($kuid) - 1) ) {
        $kuid_str = implode(",", $kuid_list);
        echo ("<xmp>" . ($kuid_str) . "</xmp>");
        $kuid_list = array();
    };
};

echo (
    '<pre>' .
        'ПОЛУЧЕНО KUIDs   : ' . count($kuid) . '<br>' .
        'ИЗ НИХ ПОВТОРОВ  : ' . $miss . '<br>' . 
        'ВОЗВРАЩЕНО KUIDs : ' . (count($kuid) - $miss) .
    '</pre>'
);
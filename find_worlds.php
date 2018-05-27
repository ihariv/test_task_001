<?php
/**
 * Created by PhpStorm.
 * User: ihar
 * Date: 27.05.18
 * Time: 13:16
 */

$file_in = "test.txt";
$file_out = "test_out.txt";

$modificator = [
    "-"=>"___"
];
$r = [
    3=>"-ТРИ-",
    5=>"-ПЯТЬ-",
    15=>"-ПЯТНАДЦАТЬ-",
];

$str = file_get_contents($file_in);

foreach($r as $key=>$val){
    str_pattern_replace($str, $key, $val);
}

finalize($str);

file_put_contents($file_out, $str);

function get_pattern($cnt){
    $need = (string) $cnt-1;
    return "/(?:(([\\w]+[^\\w]+){{$need}}))([\\w]+)/su";
}


function str_pattern_replace(&$str, $cnt, $need){
    $pattern = get_pattern($cnt);
    prepare($need);
    $str = preg_replace($pattern, "$1".$need, $str ) ;
}

function finalize(&$str){
    global $modificator;
    foreach ($modificator as $key=>$val) {
        $str = str_replace($val, $key, $str);
    }

}

function prepare(&$str){
    global $modificator;
    foreach ($modificator as $key=>$val) {
        $str = str_replace($key, $val, $str);
    }

}
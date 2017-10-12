<?php

/**
 *  回调函数
 * （1）通过可变函数来回调
 */
function study($name) {
    echo $name . " is studying...<br/>";
}

function play($name) {
    echo $name . " is playing...<br/>";
}

function sing($name) {
    echo $name . " is singing...<br/>";
}

function dowhat($funcname, $name) {
    $funcname($name);
}

dowhat("sing", "xiaoxin");
dowhat("study", "xiaoxin");
dowhat("play", "xiaoxin");
echo "<hr/>";

function add($x, $y) {
    return $x + $y;
}

function reduce($x, $y) {
    return $x - $y;
}

function dowhat2($funcname, $val1, $var2) {
    return $funcname($val1, $var2);
}

echo dowhat2("add", 1, 2);
echo "<br/>";
echo dowhat2("reduce", 9, 6);
echo "<hr/>";

/**
 *  回调函数
 * （2）通过系统回调函数来回调
 */
call_user_func("sing", "xiaoxin");
call_user_func_array("play", array("xiaoxin"));

echo call_user_func("add", 2, 4);
echo "<br/>";
echo call_user_func_array("reduce", array(4, 5.5));
?>
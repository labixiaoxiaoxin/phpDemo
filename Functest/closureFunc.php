<?php
/**
 * 匿名函数（闭包函数）：通过可变函数形式
 */
header('content-type:text/html;chatset=utf-8');
$func = function () {
    echo "string<br/>";
};
$func1 = function ($name) {
    echo "hi " . $name;
};
$func();
$func1("xiaoxin");

echo "<hr/>";

/**
 * 匿名函数：通过create_function()创建
 */
$func2 = create_function("", 'echo "string<br/>";');
$func2();
$func3 = create_function('$x,$y', 'return $x+$y;');
echo $func3(3, 5);
echo "<hr/>";
$arr = array_map(create_function('$a', 'return $a*2;'), array(1, 2, 3, 4, 5));
print_r($arr);
echo "<br/>";

?>
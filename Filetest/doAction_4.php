<?php

require_once "function/upload.func.php";

foreach ($_FILES as $fileinfo) {
    $files[] = uploadFile($fileinfo);
}
var_dump($files);

?>
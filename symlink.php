<?php 
$target = "/home/bacapaja/laravel/storage/app/public";
$link = "/home/bacapaja/public_html/storage";

$a = symlink($target, $link);
if (!$a) {
    echo "ERROR ! ";
} else {
    echo "SUCCESS !";
}
?>
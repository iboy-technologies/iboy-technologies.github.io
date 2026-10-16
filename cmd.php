<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$data = $_POST['data'];
$filename = $_POST['filename'];
file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
echo 'done'

?>
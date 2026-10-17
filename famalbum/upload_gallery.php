<?php

$family = urldecode($_SERVER['HTTP_FAMILY']);
$upload_dir = $family ."/gallery/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$filename = urldecode($_SERVER['HTTP_FILENAME']);
$file_data = file_get_contents('php://input');



if (!empty($filename) && !empty($file_data)) {
    $file_path = $upload_dir . $filename;
    if (file_put_contents($file_path, $file_data)) {
        http_response_code(200);
        $newgalla = '"'. $filename . '"' . ', ';
        file_put_contents($upload_dir . 'gallery.db', $newgalla, FILE_APPEND | LOCK_EX);
        echo "success";
    } else {
        http_response_code(500);
        echo "error uploading file";
    }
} else {
    http_response_code(400);
    echo "invalid request";
}


?>
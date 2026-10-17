<?php

$family = urldecode($_SERVER['HTTP_FAMILY']);
$upload_dir = $family ."/trending/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$filename = urldecode($_SERVER['HTTP_FILENAME']);
$file_data = '"' . $filename . '"' . ", ";
$file_opener = "[";

if (!empty($filename) && !empty($file_data)) {
    $file_path = $upload_dir . 'trending.db';
    if (!file_exists($file_path)) {
        if (file_put_contents($file_path, $file_opener)){
            if (file_put_contents($file_path, $file_data, FILE_APPEND | LOCK_EX)) {
                http_response_code(200);
                echo "success";
            } else {
                http_response_code(500);
                echo "error uploading file";
            }
        }
    } else {
        if (file_put_contents($file_path, $file_data, FILE_APPEND | LOCK_EX)) {
            http_response_code(200);
            echo "success";
        } else {
            http_response_code(500);
            echo "error uploading file";
        }
    }
    
} else {
    http_response_code(400);
    echo "invalid request";
}
?>
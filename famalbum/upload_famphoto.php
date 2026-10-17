<?php

$family = urldecode($_SERVER['HTTP_FAMILY']);
$upload_dir = $family ."/";
if (!is_dir($upload_dir)) {
    echo "invalid family";
}

$filename = urldecode($_SERVER['HTTP_FILENAME']);
$file_data = file_get_contents('php://input');


if (!empty($filename) && !empty($file_data)) {
    $file_path = $upload_dir . $filename;
    if (file_put_contents($file_path, $file_data)) {
        http_response_code(200);
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
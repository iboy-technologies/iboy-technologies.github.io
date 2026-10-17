<?php


$fam = urldecode($_SERVER['HTTP_FAM']);

if (!empty($fam)){
    $dir = $fam. "/gallery";
    if (is_dir($dir)){
        $files = array_diff(scandir($dir), ['.', '..']);
        echo json_encode($files);
    } else{
        mkdir($dir, 0755, true);
        $files = array_diff(scandir($dir), ['.', '..']);
        echo json_encode($files);
    }
}


























?>
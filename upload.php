<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create uploads directory if it doesn't exist
$uploadDir = __DIR__ . "/uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}


$filename = $_GET['filename'];
$data = file_get_contents('php://input');


// Save file to server root
$destination = $uploadDir . $filename;

if (file_put_contents($destination, $data) !== false) {
    chmod($destination, 0644); 
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'File uploaded successfully',
        'filename' => $filename,
        'size' => strlen($data),
        'path' => $destination
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save file to server']);
}
?>
<?php
// api/test_fs.php
require_once 'config.php';

header('Content-Type: application/json');

$testFile = DATA_DIR . 'test_write.txt';
$content = "Write Test OK at " . date('Y-m-d H:i:s');

if (file_put_contents($testFile, $content)) {
    echo json_encode([
        'status' => 'success',
        'message' => 'File written successfully',
        'path' => $testFile,
        'content_verify' => file_get_contents($testFile)
    ]);
} else {
    $error = error_get_last();
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to write file',
        'php_error' => $error ? $error['message'] : 'Unknown error',
        'data_dir' => DATA_DIR,
        'is_writable' => is_writable(DATA_DIR)
    ]);
}
?>

<?php
// api/update.php
require_once 'config.php';
session_start();

// Basic auth check
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

// Check for special actions
if (isset($input['action']) && $input['action'] === 'promote_scoreboard') {
    $stagingFile = DATA_DIR . 'scoreboard_staging.json';
    $liveFile = DATA_DIR . 'scoreboard.json';
    
    if (!file_exists($stagingFile)) {
        echo json_encode(['error' => 'No staging data found']);
        exit;
    }
    
    $data = file_get_contents($stagingFile);
    if (file_put_contents($liveFile, $data)) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to promote staging']);
    }
    exit;
}

if (!isset($input['type']) || !isset($input['data'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$type = preg_replace('/[^a-zA-Z0-9_-]/', '', $input['type']); // Sanitize filename
$filePath = DATA_DIR . $type . '.json';

// Add timestamp to data
$input['data']['last_updated'] = microtime(true);

if (file_put_contents($filePath, json_encode($input['data']))) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    $error = error_get_last();
    echo json_encode([
        'error' => 'Failed to save data', 
        'details' => $error ? $error['message'] : 'Unknown error',
        'path' => $filePath,
        'writable' => is_writable(dirname($filePath))
    ]);
}
?>

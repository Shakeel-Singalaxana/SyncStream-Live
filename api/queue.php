<?php
// api/queue.php
require_once 'config.php';
session_start();

// Auth Check
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

// Determine Queue Type
$type = $_GET['type'] ?? $input['type'] ?? 'lowerthird';
$type = preg_replace('/[^a-zA-Z0-9_-]/', '', $type); // Sanitize
$filename = 'queue_' . $type . '.json';
$file = DATA_DIR . $filename;

// Helper to read queue
function getQueue($file) {
    if (!file_exists($file)) return [];
    $content = file_get_contents($file);
    return json_decode($content, true) ?: [];
}

// Handle GET (Fetch Queue)
if ($method === 'GET') {
    echo json_encode(getQueue($file));
    exit;
}

// Handle POST (Add/Delete)
$action = $input['action'] ?? '';
$queue = getQueue($file);

if ($action === 'add') {
    $item = $input['data'];
    $item['id'] = uniqid(); // Unique ID
    $item['timestamp'] = time(); // Add timestamp for "newest" linking
    $queue[] = $item;
    
    if (file_put_contents($file, json_encode($queue))) {
        echo json_encode(['success' => true, 'queue' => $queue]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save']);
    }

} elseif ($action === 'delete') {
    $id = $input['id'];
    $queue = array_values(array_filter($queue, function($i) use ($id) {
        return $i['id'] !== $id;
    }));

    if (file_put_contents($file, json_encode($queue))) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete']);
    }

} elseif ($action === 'clear') {
    // Optional: Clear entire queue
    if (file_put_contents($file, json_encode([]))) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to clear']);
    }

} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid action']);
}
?>

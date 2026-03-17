<?php
// api/login.php
require_once 'config.php';
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['password']) && $data['password'] === ADMIN_PASSWORD) {
    $_SESSION['logged_in'] = true;
    $_SESSION['role'] = $data['role'] ?? 'operator'; // Store selected role
    echo json_encode(['success' => true]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Invalid password']);
}
?>

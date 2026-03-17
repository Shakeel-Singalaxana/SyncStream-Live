<?php
// api/check_auth.php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo json_encode(['logged_in' => true, 'role' => $_SESSION['role'] ?? 'operator']);
} else {
    http_response_code(401);
    echo json_encode(['logged_in' => false]);
}
?>

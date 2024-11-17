<?php
// logout.php
session_start();
session_destroy();
header('Location: index.php');
exit();

// check_auth.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
    exit();
}
?>
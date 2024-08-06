<?php
require_once '../include/login.php';

$result = [];
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check for empty fields
    if (empty($username) || empty($password)) {
        $response['status'] = false;
        $response['message'] = 'Please fill in all fields.';
    } else {
        $result = login_user($username, $password);
    }
    echo json_encode($result);
}
?>

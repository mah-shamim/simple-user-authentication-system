<?php

require_once '../include/register.php';

$username = $password = $confirm_password= $email = "";
$response = [];
$response['status'] = true;
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty(trim($_POST["username"]))) {
        $response['status'] = false;
        $response['field'] = 'username';
        $response['message'] = "Please enter a username.";
    } elseif(empty(trim($_POST["email"]))) {
        $response['status'] = false;
        $response['field'] = 'email';
        $response['message'] = "Please enter a email.";
    } elseif(empty(trim($_POST["password"]))) {
        $response['status'] = false;
        $response['field'] = 'password';
        $response['message'] = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6) {
        $response['status'] = false;
        $response['field'] = 'password';
        $response['message'] = "Password must have at least 6 characters.";
    } elseif(empty(trim($_POST["confirm_password"]))) {
        $response['status'] = false;
        $response['field'] = 'confirm_password';
        $response['message'] = "Please confirm password.";
    } elseif(trim($_POST["password"]) != trim($_POST["confirm_password"])) {
        $response['status'] = false;
        $response['field'] = 'confirm_password';
        $response['message'] = "Password did not match.";
    }else {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $confirm_password = trim($_POST["confirm_password"]);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $response = register_user($username, $email, $password_hash);
    }

}
echo json_encode($response);
?>

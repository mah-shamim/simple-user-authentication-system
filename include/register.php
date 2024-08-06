<?php
require_once 'db.php';
/**
 * @param $username
 * @param $email
 * @param $password
 * @return array
 */
function register_user($username, $email, $password) {
    global $pdo;
    $response = [];
    $response['status'] = true;
    // Check if the username already exists
    $sql = "SELECT id FROM users WHERE username = :username OR email = :email";
    if($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        if($stmt->execute()) {
            if($stmt->rowCount() == 1) {
                $response['status'] = false;
                $response['message'] = "Username or email already exists.";
            } else {
                // Username is available, so insert the new user
                $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                if($stmt = $pdo->prepare($sql)) {
                    // Bind variables to the prepared statement
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $password, PDO::PARAM_STR);

                    // Attempt to execute the prepared statement
                    if($stmt->execute()) {
                        $response['message'] = "Registration successful!";
                    } else {
                        $response['status'] = false;
                        $response['message'] = "Something went wrong. Please try again later.";
                    }
                }else{
                    $response['status'] = false;
                    $response['message'] = 'Registration failed. Please try again.';
                }
            }
        } else {
            $response['status'] = false;
            $response['message'] = "Oops! Something went wrong. Please try again later.";
        }
    }
    unset($stmt);
    unset($pdo);
    return $response;
}

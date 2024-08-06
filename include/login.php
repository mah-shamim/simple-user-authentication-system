<?php
require_once 'db.php';
/**
 * @param $username
 * @param $password
 * @return array
 */
function login_user($username, $password) {
    global $pdo;
    $response = array();
    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    if($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        if($stmt->execute()) {
            if($stmt->rowCount() == 1) {
                if($row = $stmt->fetch()) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $hashed_password = $row["password"];
                    if(password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        $response['status'] = true;
                        $response['message'] = 'Login successful!';
                    } else {
                        $response['status'] = false;
                        $response['message'] = 'The password you entered was not valid.';
                    }
                }
            } else {
                $response['status'] = false;
                $response['message'] = 'No account found with that username.';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'Oops! Something went wrong. Please try again later.';
        }
    }
    unset($stmt);
    unset($pdo);
    return $response;
}

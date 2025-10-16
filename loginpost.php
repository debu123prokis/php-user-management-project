<?php

include 'includes/connection.php';

$response = array();

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($password)) {
    $password = md5($password);
}

$result = $conn->query("select * from `users` where `email`='$email' and `password`='$password'");

if (empty($email) || empty($password)) {
    $missingfields = [];
    if (empty($email)) {
        $missingfields[] = "Email";
    }
    if (empty($password)) {
        $missingfields[] = "Password";
    }
    $response = ["process_sts" => "NO", "process_msg" => "Please enter the following field(s): " . implode(',', $missingfields)];
} elseif ($result->rowCount() > 0) {
    $response = ["process_sts" => "YES", "process_msg" => "User found...", "page" => "userprofile.php"];
} else
    $response = ["process_sts" => "NO", "process_msg" => "No User found. Please try again..."];

echo json_encode($response);

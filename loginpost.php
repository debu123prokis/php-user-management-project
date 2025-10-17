<?php
session_start();

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
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $status = $row['status'];
    $name = $row['name'];
    $email = $row['email'];

    if ($status == 0) {
        $response = ["process_sts" => "NO", "process_msg" => "Account Inactive. Contact Administrator!!!"];
    } else {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $response = ["process_sts" => "YES", "process_msg" => "Welcome " . $name, "page" => "userprofile.php"];
    }
} else
    $response = ["process_sts" => "NO", "process_msg" => "No User found. Please try again..."];

echo json_encode($response);

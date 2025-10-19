<?php

session_start();

include '../includes/connection.php';

$response = array();

$_SESSION = array();
session_destroy();
$response = ["process_sts" => "YES", "process_msg" => "Logout successfully!!!"];

echo json_encode($response);

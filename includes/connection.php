<?php

$dbname = 'mysql:host=localhost;dbname=user_management';
$username = 'root';
$password = '';

$conn = new PDO($dbname, $username, $password);

if ($conn) {
    echo '';
} else
    echo 'Sorry!!! DB not connected!!!';
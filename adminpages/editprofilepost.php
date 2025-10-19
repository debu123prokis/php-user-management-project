<?php
include '../includes/connection.php';

$res_msg = array();

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$oldpassword = $_POST['oldpassword'] ?? '';
if (!empty($oldpassword)) {
    $enc_password = md5($oldpassword);
}
$newpassword = $_POST['newpassword'] ?? '';
$status = $_POST['status'] ?? '';

$query4 = $conn->query('select * from `admin`');
while ($result = $query4->fetch(PDO::FETCH_ASSOC)) {
    $tbl_email[] = $result['email'];
}
$query = $conn->query("select `password` from `admin` where `id`='$id'");
$passwordrow = $query->fetch(PDO::FETCH_ASSOC);
$dbpassword = $passwordrow['password'];

if (empty($oldpassword) && empty($newpassword)) {

    $query5 = $conn->query("update `admin` set `username`='$name',`email`='$email',`status`='$status' where `id`='$id'");

    $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
} elseif (empty($oldpassword) && !empty($dbpassword) && !empty($newpassword)) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Please type your old password for confirmation...");
} elseif (empty($oldpassword) && empty($dbpassword) && !empty($newpassword)) {

    $enc_newpassword = md5($newpassword);

    $query1 = $conn->query("update `admin` set `username`='$name',`email`='$email',`password`='$enc_newpassword',`status`='$status' where `id`='$id'");

    if ($query1) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
    }
} elseif ($enc_password == $dbpassword && !empty($newpassword)) {
    $enc_newpassword = md5($newpassword);

    $query1 = $conn->query("update `admin` set `username`='$name',`email`='$email',`password`='$enc_newpassword',`status`='$status' where `id`='$id'");

    if ($query1) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
    }
} elseif ($enc_password == $dbpassword && empty($newpassword)) {

    $query6 = $conn->query("update `admin` set `username`='$name',`email`='$email',`password`='$enc_password',`status`='$status' where `id`='$id'");

    if ($query6) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
    }
} else {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Your old password does not match...");
}

if (empty($name) && empty($email) && $status == '') {
    $res_msg = array("process_sts" => "NO", "process_msg" => "⚠️ Please fill all required fields!");
} elseif (empty($name) || empty($email) || $status == '') {
    $missing_fields = [];

    if (empty($name)) {
        $missing_fields[] = "Name";
    }
    if (empty($email)) {
        $missing_fields[] = "Email";
    }
    if ($status == '') {
        $missing_fields[] = "Status";
    }
    $res_msg = array(
        "process_sts" => "NO",
        "process_msg" => "⚠️ Please fill the following field(s): " . implode(", ", $missing_fields)
    );
}

header('Content-Type: application/json');
echo json_encode($res_msg);

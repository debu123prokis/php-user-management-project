<?php
include '../includes/connection.php';

$res_msg = array();

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirmpassword'] ?? '';
$status = $_POST['status'] ?? '';

$tbl_email = array();

$query = $conn->query('select * from `admin`');
while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $tbl_email[] = $result['email'];
}
if (in_array($email, $tbl_email)) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Email already submitted...Please submit another email!!!");
} elseif ($password != $confirm_password) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Password must be same as Confirm Password!!!");
} elseif (!empty($name) && !empty($email) && !empty($password)) {

    $password = md5($password);
    $query1 = $conn->query("INSERT INTO `admin`(`username`,`email`,`password`,`status`) 
                           VALUES('$name','$email','$password','$status')");

    if ($query1) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ Successfully inserted!");
    } else {
        $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Database error!");
    }
} else {
    if (empty($name) && empty($email) && empty($password) && $status == '') {
        $res_msg = array("process_sts" => "NO", "process_msg" => "⚠️ Please fill all required fields!");
    } elseif (empty($name) || empty($email) || empty($password) || $status == '') {
        $missing_fields = [];

        if (empty($name)) {
            $missing_fields[] = "Name";
        }
        if (empty($email)) {
            $missing_fields[] = "Email";
        }
        if (empty($password)) {
            $missing_fields[] = "Password";
        }
        if ($status == '') {
            $missing_fields[] = "Status";
        }
        $res_msg = array(
            "process_sts" => "NO",
            "process_msg" => "⚠️ Please fill the following field(s): " . implode(", ", $missing_fields)
        );
    }

}

header('Content-Type: application/json');
echo json_encode($res_msg);

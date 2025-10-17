<?php
include 'includes/connection.php';

$res_msg = array();

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirmpassword'] ?? '';
$phone = $_POST['phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$status = $_POST['status'] ?? '';
// $image = $_POST['profile_image'] ?? '';

// Handle file upload if available
$profile_image = '';

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $profile_image = time() . "_" . basename($_FILES['profile_image']['name']);
    move_uploaded_file($_FILES['profile_image']['tmp_name'], "assets/images/" . $profile_image);
}
$tbl_email = array();

$query = $conn->query('select * from `users`');
while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $tbl_email[] = $result['email'];
}
if (in_array($email, $tbl_email)) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Email already submitted...Please submit another email!!!");
} elseif (!empty($phone) && strlen($phone) != 10) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "⚠️ Phone number must be of 10 digits!!!");
} elseif ($password != $confirm_password) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Password must be same as Confirm Password!!!");
} elseif (!empty($name) && !empty($email) && !empty($password) && !empty($gender) && $gender != 'undefined' && $status != '') {

    $password = md5($password);
    $query1 = $conn->query("INSERT INTO `users`(`name`,`email`,`password`,`phone`,`gender`,`image`,`status`) 
                           VALUES('$name','$email','$password','$phone','$gender','$profile_image','$status')");

    if ($query1) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ Successfully inserted!");
    } else {
        $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Database error!");
    }
} else {
    if (empty($name) && empty($email) && empty($password) && (empty($gender) || $gender == 'undefined') && $status == '') {
        $res_msg = array("process_sts" => "NO", "process_msg" => "⚠️ Please fill all required fields!");
    } elseif (empty($name) || empty($email) || empty($password) || empty($gender) || $gender == 'undefined' || $status == '') {
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
        if (empty($gender) || $gender == 'undefined') {
            $missing_fields[] = "Gender";
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

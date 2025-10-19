<?php
include 'includes/connection.php';

$res_msg = array();

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$oldpassword = $_POST['oldpassword'] ?? '';
if (!empty($oldpassword)) {
    $enc_password = md5($oldpassword);
}
$newpassword = $_POST['newpassword'] ?? '';
$phone = $_POST['phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$status = $_POST['status'] ?? '';
// $image = $_POST['profile_image'] ?? '';

$query4 = $conn->query('select * from `users`');
while ($result = $query4->fetch(PDO::FETCH_ASSOC)) {
    $tbl_email[] = $result['email'];
}
$query = $conn->query("select `password` from `users` where `id`='$id'");
$passwordrow = $query->fetch(PDO::FETCH_ASSOC);
$dbpassword = $passwordrow['password'];

if (empty($oldpassword) && empty($newpassword)) {
    // Handle file upload if available
    $profile_image = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = time() . "_" . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "assets/images/" . $profile_image);
    }
    if ($profile_image == '') {
        $query5 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`gender`='$gender',`status`='$status' where `id`='$id'");
    } else {
        $query5 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`gender`='$gender',`status`='$status',`image`='$profile_image' where `id`='$id'");
    }

    $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
} elseif (empty($oldpassword) && !empty($dbpassword) && !empty($newpassword)) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Please type your old password for confirmation...");
} elseif (empty($oldpassword) && empty($dbpassword) && !empty($newpassword)) {
    // Handle file upload if available
    $profile_image = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = time() . "_" . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "assets/images/" . $profile_image);
    }

    $enc_newpassword = md5($newpassword);

    if ($profile_image == '') {
        $query1 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`password`='$enc_newpassword',`gender`='$gender',`status`='$status' where `id`='$id'");
    } else {
        $query1 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`password`='$enc_newpassword',`gender`='$gender',`status`='$status',`image`='$profile_image' where `id`='$id'");
    }

    if ($query1) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
    }
} elseif ($enc_password == $dbpassword && !empty($newpassword)) {
    // Handle file upload if available
    $profile_image = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = time() . "_" . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "assets/images/" . $profile_image);
    }

    $enc_newpassword = md5($newpassword);

    if ($profile_image == '') {
        $query1 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`password`='$enc_newpassword',`gender`='$gender',`status`='$status' where `id`='$id'");
    } else {
        $query1 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`password`='$enc_newpassword',`gender`='$gender',`status`='$status',`image`='$profile_image' where `id`='$id'");
    }

    if ($query1) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
    }
} elseif ($enc_password == $dbpassword && empty($newpassword)) {
    // Handle file upload if available
    $profile_image = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = time() . "_" . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "assets/images/" . $profile_image);
    }
    if ($profile_image == '') {
        $query6 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`password`='$enc_password',`gender`='$gender',`status`='$status' where `id`='$id'");
    } else {
        $query6 = $conn->query("update `users` set `name`='$name',`email`='$email',`phone`='$phone',`password`='$enc_password',`gender`='$gender',`status`='$status',`image`='$profile_image' where `id`='$id'");
    }

    if ($query6) {
        $res_msg = array("process_sts" => "YES", "process_msg" => "✅ All data successfully inserted...");
    }
} else {
    $res_msg = array("process_sts" => "NO", "process_msg" => "❌ Your old password does not match...");
}

if (!empty($phone) && strlen($phone) != 10) {
    $res_msg = array("process_sts" => "NO", "process_msg" => "⚠️ Phone number must be of 10 digits!!!");
} else {
    if (empty($name) && empty($email) && (empty($gender) || $gender == 'undefined') && $status == '') {
        $res_msg = array("process_sts" => "NO", "process_msg" => "⚠️ Please fill all required fields!");
    } elseif (empty($name) || empty($email) || empty($gender) || $gender == 'undefined' || $status == '') {
        $missing_fields = [];

        if (empty($name)) {
            $missing_fields[] = "Name";
        }
        if (empty($email)) {
            $missing_fields[] = "Email";
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

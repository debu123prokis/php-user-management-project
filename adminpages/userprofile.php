<?php
session_start();

if (count($_SESSION) == 0) {
    header('Location: login.php');
    exit;
} else {

    include '../includes/connection.php';
    $title = 'Admin Profile';
    include '../includes/header.php';
    $email = $_SESSION['email'];
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ||
        $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $host = $_SERVER['HTTP_HOST']; // e.g. localhost or yourdomain.com
    $projectPath = "/PHPPractice/MainPHPProject1/";

    $base_url = $protocol . $host . $projectPath;
    $result = $conn->query("select * from `admin` where `email`='$email'");
    $profileimage = $base_url . '/user_management/assets/images/defaultimage.png';

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $id = $row['id'];
        $name = $row['username'];
        $status = $row['status'];
        $password = $row['password'];

        if ($status == 0) {
            $status = 'Inactive';
            $_SESSION['status'] = 0;
        } elseif ($status == 1) {
            $status = 'Active';
            $_SESSION['status'] = 1;
        }

        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $joining_date = $row['created_at'];
    }
    ?>

    <section id="content" class="container">
        <!-- Begin .page-heading -->
        <div class="page-heading">
            <div class="media" style="display: flex; align-items: flex-start; gap: 30px;">

                <!-- Left: Profile Image -->
                <div class="media-left">
                    <img class="media-object" style="width: 200px; height: 200px; border-radius: 10px; object-fit: cover;"
                        src="<?= $profileimage ?>" alt="profile image">
                </div>

                <!-- Right: About Me -->
                <div class="media-body va-m">
                    <h2 class="media-heading"><?= $name ?>
                        <small> - Profile</small>
                    </h2><br>

                    <div class="panel" style="max-width: 500px;">
                        <div class="panel-heading">
                            <span class="panel-icon">
                                <i class="fa fa-pencil"></i>
                            </span>
                            <span class="panel-title">About Me</span>
                        </div><br>

                        <div class="panel-body pb5">
                            <h6>Email: <a href="mailto:<?= $email ?>"><?= $email ?></a></h6>
                            <hr class="short br-lighter">
                            <h6>Status: <?= $status ?></h6>
                            <hr class="short br-lighter">
                            <h6>Joined: <?= $joining_date ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br>

        <div class="row">
            <div class="col-md-4">
                <button type="button" id="Logout" name="Logout" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-warning btn-lg ms-2" onclick="sessionDestroyfunc()">Logout</button>
            </div>
            <div class="col-md-8">
                <a href="editprofile.php"><button type="button" id="editprofile" name="editprofile" data-mdb-button-init
                        data-mdb-ripple-init class="btn btn-warning btn-lg ms-2">Edit Profile</button></a>
            </div>
        </div>
    </section>
    <?php include '../includes/footer.php';
}
?>

<script>

    function sessionDestroyfunc() {
        jQuery.ajax({
            url: "logoutpost.php",
            type: "POST",
            dataType: "json",
            success: function (response) {

                if (response.process_sts == "YES") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Submitted!',
                        text: response.process_msg,
                        showClass: { popup: 'animate__animated animate__fadeInDown' },
                        hideClass: { popup: 'animate__animated animate__fadeOutUp' }
                    });
                    setTimeout(function () {
                        window.location.href = 'login.php';
                    }, 2000); // Reloads after 5 seconds (5000 milliseconds)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);

            }
        });
    }

    function clearfields() {
        jQuery('#email').val('');
        jQuery('#password').val('');
    }
</script>
<?php
session_start();

if (count($_SESSION) == 0) {
    header('Location: login.php');
    exit;
} else {
    include 'includes/connection.php';
    $title = 'User Profile';
    include 'includes/header.php';
    $email = $_SESSION['email'];

    $result = $conn->query("select * from `users` where `email`='$email'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $profile_image = $row['image'];
        if (empty($profile_image)) {
            $profile_image = 'assets/images/defaultimage.png';
        }
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gender = $row['gender'];
        $status = $row['status'];
        if ($status == 0) {
            $status = 'Inactive';
        } else {
            $status = 'Active';
        }
        $joining_date = $row['created_at'];
    }
    ?>

    <section id="content" class="container">
        <!-- Begin .page-heading -->
        <div class="page-heading">
            <div class="media clearfix">
                <div class="media-left pr30">
                    <a href="#">
                        <img class="media-object" style="width:400px;" src="<?= $profile_image ?>" alt="profile image">
                    </a>
                </div>
                <div class="media-body va-m">
                    <h2 class="media-heading"><?= $name ?>
                        <small> - Profile</small>
                    </h2>
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-icon">
                                <i class="fa fa-pencil"></i>
                            </span>
                            <span class="panel-title">About Me</span>
                        </div>
                        <div class="panel-body pb5">

                            <h6>Email: <a href="mailto:"><?= $email ?></a></h6>

                            <hr class="short br-lighter">

                            <h6>Phone: <?= $phone ?></h6>

                            <hr class="short br-lighter">

                            <h6>Gender: <?= $gender ?></h6>
                            <hr class="short br-lighter">

                            <h6>Status: <?= $status ?></h6>
                            <hr class="short br-lighter">

                            <h6>Joined: <?= $joining_date ?></h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <button type="button" id="Logout" name="Logout" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-warning btn-lg ms-2" onclick="sessionDestroyfunc()">Logout</button>
            </div>
            <div class="col-md-8">


            </div>
        </div>
    </section>
    <?php include 'includes/footer.php';
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

    function loginfunc(e) {
        e.preventDefault();

        let email = jQuery('#email').val();
        let password = jQuery('#password').val();

        jQuery.ajax({
            url: "logoutpost.php",
            type: "POST",
            dataType: 'json',
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
                        window.location.href = "login.php";
                    }, 2000); // Reloads after 5 seconds (5000 milliseconds)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Error',
                        text: response.process_msg,
                        showClass: { popup: 'animate__animated animate__shakeX' },
                        hideClass: { popup: 'animate__animated animate__fadeOutUp' }
                    });
                    setTimeout(function () {
                        window.location.href = "login.php";
                    }, 2000); // Reloads after 5 seconds (5000 milliseconds)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);

            }
        });
    }
</script>
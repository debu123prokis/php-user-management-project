<?php

include 'includes/connection.php';
$title = 'User Profile';
include 'includes/header.php';
?>

<section class="h-100 bg-dark">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="assets/images/img4.jpg" alt="Sample photo" class="img-fluid"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-5 text-uppercase">User Profile Page</h3>
                                <form id="loginForm" onsubmit="return loginfunc(event)" method="POST">
                                    <div class="row">

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="email">Email</label>
                                        </div>

                                    </div><br><br>

                                    <div class="row">

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div><br><br>
                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="button" id="reset" name="reset" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-primary btn-lg"
                                            onclick="clearfields()">Reset all</button>

                                        <a href="register.php"><button type="button" id="signup" name="signup"
                                                data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-warning btn-lg ms-2">Sign
                                                Up</button></a>
                                        <button type="submit" id="signin" name="signin" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-warning btn-lg ms-2">Sign
                                            In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>

<script>

    function clearfields() {
        jQuery('#email').val('');
        jQuery('#password').val('');
    }

    function loginfunc(e) {
        e.preventDefault();

        let email = jQuery('#email').val();
        let password = jQuery('#password').val();

        jQuery.ajax({
            url: "loginpost.php",
            type: "POST",
            dataType: 'json',
            data: "email=" + email + "&password=" + password,
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
                        location.reload();
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
                        location.reload();
                    }, 2000); // Reloads after 5 seconds (5000 milliseconds)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);

            }
        });
    }
</script>
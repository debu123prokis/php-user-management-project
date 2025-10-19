<?php

include '../includes/connection.php';
$title = 'Admin Register Form';
include '../includes/header.php';
?>

<section class="h-100 bg-dark">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="../assets/images/img4.jpg" alt="Sample photo" class="img-fluid"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                        </div>
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-5 text-uppercase">Admin registration form</h3>
                                <form id="myForm" name="myForm" onsubmit="return formSubmit(event)" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="name" name="name"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label" for="name">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="email" id="email" name="email"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label" for="email">Email</label>
                                            </div>
                                        </div>
                                    </div><br><br>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="password" maxlength="12" id="password" name="password"
                                                    class="form-control form-control-lg" />
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div data-mdb-input-init class="form-outline">
                                                <input type="password" id="confirm_password" name="confirm_password"
                                                    class="form-control form-control-lg" onchange="pwdaction()" />
                                                <label class="form-label" for="confirm_password">Confirm
                                                    Password</label>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <select id="status" name="status" data-mdb-select-init>
                                                <option value="">Status</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                            </select>

                                        </div><br><br><br>

                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="button" id="reset" name="reset" data-mdb-button-init
                                                data-mdb-ripple-init class="btn btn-primary btn-lg"
                                                onclick="clearfunc()">Reset all</button>
                                            <a href="login.php"><button type="button" id="signin" name="signin"
                                                    data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-warning btn-lg ms-2">Sign
                                                    In</button></a>
                                            <button type="submit" id="signup" name="signup" data-mdb-button-init
                                                data-mdb-ripple-init class="btn btn-warning btn-lg ms-2">Sign
                                                Up</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include '../includes/footer.php'; ?>

<script>
    function clearfunc() {
        jQuery('#name').val('');
        jQuery('#email').val('');
        jQuery('#phone').val('');
        jQuery('#password').val('');
        jQuery('#status').val('');
        jQuery('#confirm_password').val('');
        jQuery('#profile_image').val('');
        jQuery('input[name="gender"]:checked').val('');
    }

    function formSubmit(e) {
        e.preventDefault();
        let name = jQuery('#name').val();
        let email = jQuery('#email').val();
        let password = jQuery('#password').val();
        let status = jQuery('#status').val();
        let confirmpassword = jQuery('#confirm_password').val();

        let formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('status', status);
        formData.append('confirmpassword', confirmpassword);

        jQuery.ajax({
            url: "regpost.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
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

                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);

            }
        });
    }

</script>
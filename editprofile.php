<?php
session_start();

if (count($_SESSION) == 0) {
    header('Location: login.php');
    exit;
} else {
    include 'includes/connection.php';
    $title = 'Edit Profile Page';
    include 'includes/header.php';

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $phone = $_SESSION['phone'];
    $profile_image = $_SESSION['profile_image'];
    $gender = $_SESSION['gender'];
    $status = $_SESSION['status'];

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
                                    <h3 class="mb-5 text-uppercase">User Profile Edit Page</h3>
                                    <form id="myForm" name="myForm" onsubmit="return updatedFormSubmit(event)" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="hidden" id="hiddenfield" value="<?= $id; ?>">
                                                    <input type="text" id="name" name="name"
                                                        class="form-control form-control-lg" value="<?= $name ?>" />
                                                    <label class="form-label" for="name">Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="email" id="email" name="email"
                                                        class="form-control form-control-lg" value="<?= $email ?>" />
                                                    <label class="form-label" for="email">Email</label>
                                                </div>
                                            </div>
                                        </div><br><br>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="password" maxlength="12" id="oldpassword"
                                                        name="oldpassword" class="form-control form-control-lg" />
                                                    <label class="form-label" for="password">Your Old Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="password" id="newpassword" name="newpassword"
                                                        class="form-control form-control-lg" />
                                                    <label class="form-label" for="newpassword">New Password</label>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="number" id="phone" name="phone"
                                                        class="form-control form-control-lg" value="<?= $phone ?>" />
                                                    <label class="form-label" for="phone">Phone (Optional)</label>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div data-mdb-input-init class="form-outline mb-4 mx-auto"
                                                style="height:200px;width:200px;">
                                                <img style="height:200px;width:200px;"
                                                    src="<?php echo $_SESSION['completeprofileimage'] ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div data-mdb-input-init class="form-outline mb-4">
                                                <input type="file" id="profile_image" name="profile_image"
                                                    class="form-control form-control-sm" />
                                                <label class="form-label" for="profile_image">Profile image
                                                    (Optional)</label>
                                            </div>
                                        </div><br><br>

                                        <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                            <h6 class="mb-0 me-4">Gender: </h6>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="female" <?php if ($gender == 'female')
                                                        echo 'checked'; ?> />
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0 me-4">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" <?php if ($gender == 'male')
                                                        echo 'checked'; ?> />
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>

                                            <div class="form-check form-check-inline mb-0">
                                                <input class="form-check-input" type="radio" name="gender" id="other"
                                                    value="other" />
                                                <label class="form-check-label" for="other">Other</label>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">

                                                <select id="status" name="status" data-mdb-select-init>
                                                    <option value="">Status</option>
                                                    <option value="0" <?php if ($status == 0)
                                                        echo 'selected' ?>>0</option>
                                                        <option value="1" <?php if ($status == 1)
                                                        echo 'selected' ?>>1</option>
                                                    </select>

                                                </div><br><br><br>

                                                <div class="d-flex justify-content-end pt-3">
                                                    <div class="col-md-4">
                                                        <button type="button" id="Logout" name="Logout" data-mdb-button-init
                                                            data-mdb-ripple-init class="btn btn-warning btn-lg ms-2"
                                                            onclick="sessionDestroyfunc()">Logout</button>
                                                    </div>
                                                    <button type="button" id="reset" name="reset" data-mdb-button-init
                                                        data-mdb-ripple-init class="btn btn-primary btn-lg"
                                                        onclick="clearfunc()">Reset all</button>

                                                    <button type="submit" id="update" name="update" data-mdb-button-init
                                                        data-mdb-ripple-init class="btn btn-warning btn-lg ms-2">Update
                                                        Profile</button>
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
    <?php include 'includes/footer.php';
}
?>

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

    function updatedFormSubmit(e) {
        e.preventDefault();
        let id = jQuery('#hiddenfield').val();
        let name = jQuery('#name').val();
        let email = jQuery('#email').val();
        let phone = jQuery('#phone').val();
        let oldpassword = jQuery('#oldpassword').val();
        let status = jQuery('#status').val();
        let newpassword = jQuery('#newpassword').val();
        let gender = jQuery('input[name="gender"]:checked').val();
        let profile_image = $('#profile_image')[0].files[0];

        let formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('oldpassword', oldpassword);
        formData.append('status', status);
        formData.append('gender', gender);
        formData.append('newpassword', newpassword);
        formData.append('profile_image', profile_image);

        jQuery.ajax({
            url: "editprofilepost.php",
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
                        window.location.href = "userprofile.php";
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
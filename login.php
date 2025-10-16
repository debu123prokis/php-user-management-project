<?php

include 'includes/connection.php';
$title = 'User Login Form';
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
                                <h3 class="mb-5 text-uppercase">User login form</h3>

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
                                        data-mdb-ripple-init class="btn btn-primary btn-lg">Reset all</button>
                                    <a href="login.php"><button type="button" id="signin" name="signin"
                                            data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-warning btn-lg ms-2">Sign
                                            In</button></a>
                                    <button type="button" id="signup" name="signup" data-mdb-button-init
                                        data-mdb-ripple-init class="btn btn-warning btn-lg ms-2">Sign
                                        Up</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
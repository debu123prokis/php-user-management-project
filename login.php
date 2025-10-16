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
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="name" name="name"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="name">Name</label>
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
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="password" id="confirnm_password" name="confirnm_password"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="confirnm_password">Confirm
                                                Password</label>
                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="number" id="phone" class="form-control form-control-lg" />
                                            <label class="form-label" for="phone">Phone (Optional)</label>
                                        </div>
                                    </div>
                                </div><br><br>
                                <div class="row">
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="file" id="profile_image" name="profile_image"
                                            class="form-control form-control-sm" />
                                        <label class="form-label" for="profile_image">Profile image (Optional)</label>
                                    </div>
                                </div><br><br>

                                <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                                    <h6 class="mb-0 me-4">Gender: </h6>

                                    <div class="form-check form-check-inline mb-0 me-4">
                                        <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                            value="female" />
                                        <label class="form-check-label" for="femaleGender">Female</label>
                                    </div>

                                    <div class="form-check form-check-inline mb-0 me-4">
                                        <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                            value="male" />
                                        <label class="form-check-label" for="maleGender">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="radio" name="gender" id="otherGender"
                                            value="other" />
                                        <label class="form-check-label" for="otherGender">Other</label>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <select id="status" name="status" data-mdb-select-init>
                                            <option>Status</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>

                                    </div><br><br><br>

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
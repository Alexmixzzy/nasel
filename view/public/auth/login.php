<?php
$obj->loginUser($params);
?>
<?php $obj->renderStep('siteHead.php'); ?>

<body>

    <!-- *****Main Wrapper***** -->
    <div id="home" class="main-wrapper">
        <!-- SUB NAVBAR -->
        <?php $obj->renderStep('siteHeaderNav.php'); ?>

        <div class="page_banner">
            <div class="overl"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="section-heading">
                            <h1 class="display-4 text-white">Authentication</h1>
                        </div>
                        <div class="section-inline">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="home text-white" href="../">Home</a>
                                </li>
                                <li class="list-inline-item">
                                    <i class="home text-white fa fa-angle-double-right"></i>
                                </li>
                                <li class="list-inline-item">
                                    <p class="home text-white">Secure Account Login</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- *****Login section***** -->


        <div id="member-login" style="background-image: url('{{ loadImage }}')">
            <div class="container">
            <?php $obj->voidFormMsg(); ?>
                <div class="login_content p-5 bg-white">
                    <div class="section-heading">
                        <h1>Members login</h1>
                        <p>Login to your member area.</p>



                        <!-- <p class="p-3 mb-2 bg-danger text-white">{{message}}</p> -->
                    


                    </div>

                    <form method="POST" action="" enctype="multipart/form-data">
                        <?php $obj->crfToken(); ?>


                        <input type="text" name="username" id="username" placeholder="Username">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Remember Password
                            </label>
                        </div>
                        <button name="loginUser" value="x1" class="btn btn-primary btn-block mt-4" type="submit">Login</button>

                    </form>
                    <p class="mt-3 text-center login_content form-check-label">Don't have an account?&nbsp;<a href="../register/">Sign Up</a></p>
                    <p class="mt-3 text-center login_content form-check-label">Forgot Password?&nbsp;<a href="../recover/">Reset</a></p>
                </div>
            </div>
        </div>

        <!-- *****Our Core Values section***** -->


        <!-- ***** Our Experts section start ***** -->


        <!-- ***** Testimonial section start ***** -->




        <?php $obj->renderStep('siteFooter.php'); ?>
        <!-- ***** Footer section start ***** -->

    </div>
    <!-- ***** End Main Wrapper ***** -->

    <!-- Vendor JS Files -->
    <?php $obj->renderStep('siteFooterJs.php'); ?>

</body>

</html>
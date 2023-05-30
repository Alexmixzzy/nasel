<?php $obj->registerUser($params);?>
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
									<p class="home text-white">Signup for new Account</p>
								  </li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<!-- *****Login section***** -->

            <div id="member-login">
		    	<div class="container">
                <?php $obj->voidFormMsg(); ?>
            
		    		<div class="login_content p-5 bg-white">
						<div class="section-heading">
							<h1>Registration</h1>
							<p>Register your account.</p>
						</div>
					    <form method="POST" action="" enctype="multipart/form-data">
                        <?php $obj->crfToken(); ?>
						<?php $rname =   'peter%$# james   pacc(&^%' ;?>
						<?php //echo  $obj->cleanName('peter%$# james   pacc(&^%') ;?><br>
						<?php echo $obj->cleanEmail('$james-.8_pas@gmail.com');?>
                        <input type="text" id="fullname" placeholder="fullname" name="fullname">
					        <input type="text" id="username" name="username" placeholder="Username">
                            <input type="email" id="email" name="email" placeholder="Enter Email">
					        <input type="password" id="password" name="password" placeholder="Password">
                            <input type="password" id="cpassword" name="cpassword" placeholder="Retype Password">
                            <input type="text" id="ref" name="ref" placeholder="Referral Username  (optional)">
                            <?php if(!empty($_SESSION['ref'])){} ?>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							  <label class="form-check-label" for="defaultCheck1">
								 Remember Password
							  </label>
							</div>
					  		<button name="signUser" class="btn btn-primary btn-block mt-4" type="submit">Signup</button>
						</form>
							<p class="mt-3 text-center login_content form-check-label">Already have an account?&nbsp;<a href="../login/">Login</a></p>
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
<?php $obj->handleProfileUpdate($params);?>
<?php $obj->renderView('siteHead.php'); ?>

<body>

	<!-- Loading starts -->
	<?php $obj->renderView('siteLoader.php'); ?>
	<!-- Loading ends -->

	<!-- Page wrapper start -->
	<div class="page-wrapper">

		<!-- Sidebar wrapper start -->
		<?php $obj->renderView('siteNav.php'); ?>
		<!-- Sidebar wrapper end -->

		<!-- Page content start  -->
		<div class="page-content">

			<!-- Header start -->
			<?php $obj->renderView('siteHeader.php'); ?>
			<!-- Header end -->

			<!-- Main container start -->
			<div class="main-container">

				<!-- Page header start -->
				<?php //$obj->renderView('siteCrumb.php'); 
				?>
				<?php $compo->userCrumb('Edit Profile'); ?>
				<!-- Page header end -->

				<!-- Row start -->
				<div class="row gutters">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
						<div class="card h-100">
							<div class="card-body">
								<div class="account-settings">
									<div class="user-profile">
										<div class="user-avatar">
											<img src="<?php $model->profileImage();  ?>" alt="<?php $model->voidUser('username');  ?> Image">
										</div>
										<h5 class="user-name"><?php $model->voidUser('fullname');  ?></h5>
										<h6 class="user-email"><?php $model->voidUser('email');  ?></h6>
									</div>
									<div class="about">
										<h5 class="mb-2 text-primary">About</h5>
										<p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
						<?php $obj->voidFormMsg(); ?>
						<div class="card h-100">
							<form action="edit-profile" method="POST" enctype="multipart/form-data">
							<?php $obj->crfToken(); ?>
								<div class="card-body">
									<div class="row gutters">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<h6 class="mb-3 text-primary">Personal Details</h6>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="fullName">Full Name</label>
												<input type="text" class="form-control" id="fullName" placeholder="Enter full name" value="<?php $model->voidUser('fullname');  ?>">
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="eMail">Email</label>
												<input type="email" class="form-control" id="eMail" placeholder="Enter email ID" value="<?php $model->voidUser('email');  ?>">
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="phone">Phone</label>
												<input type="text" class="form-control" id="phone" placeholder="Enter phone number" value="<?php $model->voidUser('phone');  ?>">
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="website">Website URL</label>
												<input type="text" class="form-control" id="address" name="address" placeholder="Your Address" value="<?php $model->voidUser('address');  ?>">
											</div>
										</div>
									</div>
									<div class="row gutters">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<h6 class="mb-3 text-primary">Address</h6>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
											<div class="form-group">
												<label for="Street">Address</label>
												<input type="name" class="form-control" id="address" placeholder="Enter Street" value="<?php $model->voidUser('address');  ?>">
											</div>
										</div>


									</div>
									<div class="row gutters">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="text-right">
												<button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
												<button type="submit" id="submit" name="updateProfile" class="btn btn-primary">Update</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Row end -->

			</div>
			<!-- Main container end -->

			<!-- Container fluid start -->
			<?php $obj->renderView('siteFooter.php'); ?>
			<!-- Container fluid end -->

			<!-- Chat start -->

			<!-- Chat end -->

		</div>
		<!-- Page content end -->

	</div>
	<!-- Page wrapper end -->

	<!--**************************
			**************************
				**************************
							Required JavaScript Files
				**************************
			**************************
		**************************-->
	<!-- Required jQuery first, then Bootstrap Bundle JS -->
	<?php $obj->renderView('siteFooterJs.php'); ?>

</body>


</html>
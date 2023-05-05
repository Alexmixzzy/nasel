<?php $obj->handleResetInvest($params);?>
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
				<?php $compo->userCrumb('Reset  Investment'); ?>
				<!-- Page header end -->
                    
				<!-- Row start -->

				<div class="row gutters">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php $obj->voidFormMsg(); ?>
					
					<?php // var_dump(count(array('peter'), '--'.$frk[0])); ?>
                </div>
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
					
						<?php $compo->userProfileCard();?>
					</div>

					
					
					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                

                
					
						<div class="card h-100">
                        <div class="card-header">
									<div class="card-title">Completed Investments </div>
								</div>
							
								<div class="card-body">
                                    <?php $compo->userCapitalReset();  ?>
									
									<ul class="team-activity" hidden >
										<li class="product-list clearfix">
											<div class="product-time">
												<p class="date center-text">02:30 pm</p>
												<span class="badge badge-info">New</span>
											</div>
											<div class="product-info">
												<div class="activity">
													<h6>Smart - Admin Dashboard</h6>
													<p>by Luke Etheridge</p>
												</div>
												<div class="status">
													<div class="progress">
														<div class="progress-bar bg-danger" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 49%">
															<span class="sr-only">49% Complete (success)</span>
														</div>
													</div>
													<p>(225 of 700gb)</p>
												</div>
											</div>
										</li>
										<li class="product-list clearfix">
											<div class="product-time">
												<p class="date center-text">11:30 am</p>
												<span class="badge badge-info">Task</span>
											</div>
											<div class="product-info">
												<div class="activity">
													<h6>User_Profile.php</h6>
													<p>by Rovane Durso</p>	
												</div>
												<div class="status">
													<div class="progress">
														<div class="progress-bar bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
															<span class="sr-only">75% Complete (success)</span>
														</div>
													</div>
													<p>(485 of 850gb)</p>
												</div>
											</div>
										</li>
										<li class="product-list clearfix">
											<div class="product-time">
												<p class="date center-text">12:50 pm</p>
												<span class="badge badge-success">Closed</span>
											</div>
											<div class="product-info">
												<div class="activity">
													<h6>Material Design Kit</h6>
													<p>by Cosmin Capitanu</p>
												</div>
												<div class="status">
													<span class="line-seven" style="display: none;">5,3,9,6,5,9,7,3,5,7</span><svg class="peity" height="25" width="150"><polyline fill="none" points="0 11.333333333333332 16.666666666666668 16 33.333333333333336 2 50 9 66.66666666666667 11.333333333333332 83.33333333333334 2 100 6.666666666666668 116.66666666666667 16 133.33333333333334 11.333333333333332 150 6.666666666666668" stroke="#5fa22d" stroke-width="4" stroke-linecap="square"></polyline></svg>
												</div>
											</div>
										</li>
									</ul>
								</div>
							


								
                        
						
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
	<?php //$obj->renderJs('vendor/input-masks/cleave.min.js'); ?>
	<?php //$obj->renderJs('vendor/input-masks/cleave-phone.js'); ?>
	<?php //$obj->renderJs('vendor/input-masks/cleave-custom.js'); ?>
	<!-- Input Masks JS -->
	<script src="../static/secure/vendor/input-masks/cleave.min.js"></script>
		<!-- <script src="../static/secure/vendor/input-masks/cleave-phone.js"></script> -->
		<script src="../static/secure/vendor/input-masks/readyCustom.js"></script>

</body>


</html>
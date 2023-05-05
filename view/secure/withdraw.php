<?php $obj->handleWithdrawFund($params);?>
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
				<?php //$obj->renderView('siteCrumb.php');?>
				<?php $compo->userCrumb('Withdraw  Investment'); ?>
				<!-- Page header end -->
                    
				<!-- Row start -->

				<div class="row gutters">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
					
						<?php $compo->userProfileCard();?>
					</div>

					
					
					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <?php $obj->voidFormMsg();  ?>
                    <?php  //$jd = json_encode($json); ?>
                    <?php //$jd2 = json_decode($jd,true); ?>
                    <?php //echo  $jd2['coin_type'];  echo $jd; ?>
                    <?php // $compo->userPayWallet2('peter'); ?>
                    <?php  //$compo->userPayWallet('clems'); ?>
                    <?php  //$compo->userWithdrawMethods(); ?>

                    <?php //var_dump($params);?>
                

					
						<div class="card h-100">
							<form action="withdraw" method="POST" enctype="multipart/form-data">
								<div class="card-body">
									<div class="row gutters">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<h6 class="mb-3 text-primary">Required Withdrawal Details</h6>
										</div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
												
												
										</div>
										<div class="form-group">
										<label>Availble balance</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><?php $site->voidSym(); ?></span>
													</div>
													<input disabled type="text" class="form-control form-control-lg" placeholder="Enter Amount" id="balance" name="balance" value="<?php echo $obj->fmt($model->getProfit('balance')); ?>">
													<div class="input-group-append">
														<span class="input-group-text"><?php $site->voidSite('currency'); ?></span>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
												
												
										</div>
										<div class="form-group">
										<label>Enter Amount (digit)</label>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><?php $site->voidSym(); ?></span>
													</div>
													<input type="text" class="form-control form-control-lg input-numeral-thousand" placeholder="Enter Amount" id="payAmount" name="payAmount" value="">
													<div class="input-group-append">
														<span class="input-group-text"><?php $site->voidSite('currency'); ?></span>
													</div>
												</div>
											</div>
										</div>
										
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label for="eMail">Payment Method</label>
												<select  class="form-control form-control-lg" id="payMethod" name="payMethod" >
                                                    <?php  $compo->userWithdrawMethods(); ?>
												</select>
											</div>
										</div>
										
									</div>

									

									

									<div class="row gutters">
										<div hidden class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<h6 class="mb-3 text-primary">Investment Plans</h6>
										</div>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label for="Street">Receiving Account</label>
												<select  class="form-control form-control-lg" id="payAddress" name="payAddress">
												<?php  $compo->userPayWallet(); ?>
												</select>
											</div>
										</div>


									</div>


									<div class="row gutters" hidden>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										
										<?php  $obj->crfToken(); ?>
										</div>
										


									</div>


									
									
									
									<div class="row gutters">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="text-right">
												<button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
												<button type="submit" id="wFund" name="wFund" class="btn btn-primary">Continue</button>
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
	<?php //$obj->renderJs('vendor/input-masks/cleave.min.js'); ?>
	<?php //$obj->renderJs('vendor/input-masks/cleave-phone.js'); ?>
	<?php //$obj->renderJs('vendor/input-masks/cleave-custom.js'); ?>
	<!-- Input Masks JS -->
	<script src="../static/secure/vendor/input-masks/cleave.min.js"></script>
		<!-- <script src="../static/secure/vendor/input-masks/cleave-phone.js"></script> -->
		<script src="../static/secure/vendor/input-masks/readyCustom.js"></script>

</body>


</html>
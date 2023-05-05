<?php $obj->handleWithdrawCapital($params);?>
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
				<?php $compo->userCrumb('Request  Capital'); ?>
				<!-- Page header end -->
                    
				<!-- Row start -->

				<div class="row gutters">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
					
						<?php $compo->userProfileCard();?>
					</div>

					
					
					<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <?php $obj->voidFormMsg(); ?>
					<?php 
					$keys = array('reqCapital'=>'', 'cTokens'=>'','payAddress'=>'', 'payMethod'=>'','invest_id'=>'');
					$keys2 = array('reqCapital'=>'', 'cTokens'=>'','payAddressf'=>'', 'payMethod'=>'','invest_id'=>'');
					//var_dump($params);

					$result=array_diff_key($keys2,$keys);
                    //print_r($result);\
					foreach ($keys2 as $key => $value) {
						# code...
                        $false = false;
						if(!array_key_exists($key,$keys)){
							$false = false;
							//echo 'no';
						    break;
							
							
						}else{
							//echo 'yes';
							$false = true;

						}

						
					}

					//echo (int) $false;
					
					?>

                
					
						<div class="card h-100">
                        <div class="card-header">
									<div class="card-title">Completed Investments</div>
								</div>
							

								<div class="card-body">
                                    <?php $compo->userCapitalWithdraw();  ?>
									
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
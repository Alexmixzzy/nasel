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
				<?php $compo->userCrumb(); ?>
				<!-- Page header end -->

				<!-- Row start -->
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Investment Chart Data</div>
							</div>
							<div class="card-body pt-0">
								<div class="custom-icon-group right-align" role="group">
									<a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download">
										<i class="icon-download1"></i>
									</a>
									<a href="#" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Export">
										<i class="icon-export"></i>
									</a>
									<a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh">
										<i class="icon-refresh-cw"></i>
									</a>
								</div>
								<div id="lineGraph8"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end -->

				<!-- Row start -->
				<div class="row gutters">
					<?php $wiget->moneyCards($site->sym.$obj->fmt($model->investModel->investTotalDeposit()), 'Deposits'); ?>

					<!--$money=0,$name='Widget',$bg='info',$icon='local_atm'-->
					<?php $wiget->moneyCards($site->sym.$obj->fmt($model->getProfit('total_withdraw')), 'Withdrawals', 'danger'); ?>
					<?php $wiget->moneyCards($site->sym.$obj->fmt($model->investModel->investPendingDeposit()), 'Pending Deposit', 'warning'); ?>

					<?php $wiget->moneyCards($site->sym.$obj->fmt($model->investModel->investActiveDeposit()), 'Investments', 'success'); ?>


					<div class="col-xl-4 col-lg-8 col-md-8 col-sm-8 col-12">
						<div class="card h-165">
							<div class="payments-card">
								<h6>Profit Balance</h6>
								
								<h2><?php  $obj->voidCal($obj->xeSym($site->getSite('currency')).$obj->fmt($model->getProfit('balance'))); ?></h2>
								<?php //$site->voidSite('name'); ?>

								<div class="custom-btn-group mt-4">
									<button class="btn btn-success ml-0"><i class="icon-credit-card"></i>Add Funds</button>
									<button class="btn btn-danger"><i class="icon-credit-card"></i>Withdraw</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row end -->

				<!-- Row start -->
				<div class="row gutters">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<!-- Card start -->
						<div class="card">
							<div class="card-header">
								<div class="card-title">Bonuses</div>
							</div>
							<div class="card-body">
								<div class="customScroll5">
									<div class="products-sold-container">
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob1.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 11</div>
													<div class="price">$999.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">8250</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob2.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 10</div>
													<div class="price">$899.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">9347</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob3.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 9</div>
													<div class="price">$799.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">6269</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob4.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 8</div>
													<div class="price">$699.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">5950</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob5.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 7</div>
													<div class="price">$599.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">2875</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob6.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 6</div>
													<div class="price">$499.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">2300</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob7.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone 5</div>
													<div class="price">$399.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">5150</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
										<div class="product">
											<div class="product-details">
												<img src="img/mobiles/mob8.jpg" alt="Apple iPhone 11">
												<div class="product-title">
													<div class="title">Apple iPhone</div>
													<div class="price">$299.00</div>
												</div>
											</div>
											<div class="product-sold">
												<div class="sold text-success">2195</div>
												<div class="sold-title">sold</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Card end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<!-- Card start -->
						<div class="card">
							<div class="card-header">
								<div class="card-title">Sales by Location</div>
							</div>
							<div class="card-body">
								<div class="customScroll5">
									<div class="top-locations-container">
										<!-- <div id="world-map-markers" class="location-map"></div> -->
										<div class="location">
											<div class="location-details">
												<img src="flags/4x3/br.svg" alt="Country" />
												<div class="location-name">
													<div class="name">Brazil</div>
												</div>
											</div>
											<div class="total-sessions text-success">36.7%</div>
										</div>
										<div class="location">
											<div class="location-details">
												<img src="flags/4x3/no.svg" alt="Country" />
												<div class="location-name">
													<div class="name">Norway</div>
												</div>
											</div>
											<div class="total-sessions text-info">25.2%</div>
										</div>
										<div class="location">
											<div class="location-details">
												<img src="flags/4x3/ua.svg" alt="Country" />
												<div class="location-name">
													<div class="name">Ukraine</div>
												</div>
											</div>
											<div class="total-sessions text-warning">21.8%</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Card end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Revenue</div>
							</div>
							<div class="card-body">
								<div class="customScroll5">
									<div class="revenue-container">
										<div class="revenue-graph">
											<div id="overallRevenue1"></div>
										</div>
										<div class="overall-revenue">
											65,000
										</div>
										<div class="revenue-details">
											Great sales this week. Overall revenue is 5% more<br />than last week.
										</div>
										<a href="#" class="btn btn-success">View Report</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<!-- Card start -->
						<div class="card">
							<div class="card-header">
								<div class="card-title">Reviews</div>
							</div>
							<div class="card-body">
								<div class="customScroll5">
									<ul class="customer-rating">
										<li class="clearfix">
											<div class="customer">
												<img src="img/user2.png" alt="Tycoon Admin">
											</div>
											<div class="customer-review">
												<div class="stars">
													<div id="rate1"></div>
												</div>
												<h5>Excellent Product</h5>
												<h6 class="by">By <a href="#" class="text-info">William Meleski</a></h6>
												<p>The atmosphere is excellent along with the greenery around. Market, hospital and schools are easily accessible.</p>
											</div>
										</li>
										<li class="clearfix">
											<div class="customer">
												<img src="img/user.png" alt="Tycoon Admin">
											</div>
											<div class="customer-review">
												<div class="stars" id="rate2"></div>
												<h5>Best Product</h5>
												<h6 class="by">By <a href="#" class="text-info">Joshua Galleher</a></h6>
												<p>The atmosphere is excellent along with the greenery around. Market, hospital and schools are easily accessible.</p>
											</div>
										</li>
										<li class="clearfix">
											<div class="customer">
												<img src="img/user3.png" alt="Tycoon Admin">
											</div>
											<div class="customer-review">
												<div class="stars" id="rate3"></div>
												<h5>Awesome Deal</h5>
												<h6 class="by">By <a href="#" class="text-info">Mark Lee</a></h6>
												<p>This Location has good connectivity with nearby schools, colleges and hospitals. Public transport is available.</p>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- Card end -->
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Top Users</div>
							</div>
							<div class="card-body">
								<div class="customScroll5">
									<div class="top-agents-container">
										<div class="top-agent">
											<img src="img/user.png" class="avatar" alt="Agent" />
											<div class="agent-details">
												<h6>Amy Diaz</h6>
												<div class="agent-score">
													<div class="progress">
														<div class="progress-bar bg-info" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<div class="points">
														<div class="left">Rank #1</div>
													</div>
												</div>
											</div>
										</div>
										<div class="top-agent">
											<img src="img/user22.png" class="avatar" alt="Agent" />
											<div class="agent-details">
												<h6>Lily Jordan</h6>
												<div class="agent-score">
													<div class="progress">
														<div class="progress-bar bg-danger" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<div class="points">
														<div class="left">Rank #2</div>
													</div>
												</div>
											</div>
										</div>
										<div class="top-agent">
											<img src="img/user6.png" class="avatar" alt="Agent" />
											<div class="agent-details">
												<h6>Shawn Mark</h6>
												<div class="agent-score">
													<div class="progress">
														<div class="progress-bar bg-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<div class="points">
														<div class="left">Rank #3</div>
													</div>
												</div>
											</div>
										</div>
										<div class="top-agent">
											<img src="img/user20.png" class="avatar" alt="Agent" />
											<div class="agent-details">
												<h6>Ryan Collins</h6>
												<div class="agent-score">
													<div class="progress">
														<div class="progress-bar bg-success" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<div class="points">
														<div class="left">Rank #4</div>
													</div>
												</div>
											</div>
										</div>
										<div class="top-agent">
											<img src="img/user13.png" class="avatar" alt="Agent" />
											<div class="agent-details">
												<h6>Joyce Roy</h6>
												<div class="agent-score">
													<div class="progress">
														<div class="progress-bar bg-info" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
													<div class="points">
														<div class="left">Rank #5</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<!-- Card start -->
						<div class="card">
							<div class="card-header">
								<div class="card-title">Top Countries</div>
							</div>
							<div class="card-body">
								<div class="customScroll5">
									<div class="top-countries-container">
										<div class="country">
											<div class="country-details">
												<img src="flags/4x3/us.svg" alt="Country" />
												<div class="country-name">
													<div class="name">US</div>
													<div class="progress">
														<div class="progress-bar bg-info" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="total-amount">
												<div class="amount text-info">$78</div>
												<div class="amount-title">Millions</div>
											</div>
										</div>
										<div class="country">
											<div class="country-details">
												<img src="flags/4x3/ca.svg" alt="Country" />
												<div class="country-name">
													<div class="name">Canada</div>
													<div class="progress">
														<div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="total-amount">
												<div class="amount text-info">$69</div>
												<div class="amount-title">Millions</div>
											</div>
										</div>
										<div class="country">
											<div class="country-details">
												<img src="flags/4x3/in.svg" alt="Country" />
												<div class="country-name">
													<div class="name">India</div>
													<div class="progress">
														<div class="progress-bar bg-warning" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="total-amount">
												<div class="amount text-info">$57</div>
												<div class="amount-title">Millions</div>
											</div>
										</div>
										<div class="country">
											<div class="country-details">
												<img src="flags/4x3/de.svg" alt="Country" />
												<div class="country-name">
													<div class="name">Germany</div>
													<div class="progress">
														<div class="progress-bar bg-success" role="progressbar" style="width: 59%" aria-valuenow="59" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="total-amount">
												<div class="amount text-info">$51</div>
												<div class="amount-title">Millions</div>
											</div>
										</div>
										<div class="country">
											<div class="country-details">
												<img src="flags/4x3/br.svg" alt="Country" />
												<div class="country-name">
													<div class="name">Brazil</div>
													<div class="progress">
														<div class="progress-bar bg-info" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="total-amount">
												<div class="amount text-info">$48</div>
												<div class="amount-title">Millions</div>
											</div>
										</div>
										<div class="country">
											<div class="country-details">
												<img src="flags/4x3/tr.svg" alt="Country" />
												<div class="country-name">
													<div class="name">Turkey</div>
													<div class="progress">
														<div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</div>
											<div class="total-amount">
												<div class="amount text-info">$36</div>
												<div class="amount-title">Millions</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Card end -->
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
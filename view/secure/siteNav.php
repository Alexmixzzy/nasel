
<!-- Sidebar wrapper start -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar brand start  -->
    <div class="sidebar-brand">
        <a href="" class="logo"><?php $site->voidSite('name'); ?></a>
    </div>
    <!-- Sidebar brand end  -->
    
    <!-- Quick links start -->
    <div class="sidebar-user-details">
					<div class="user-profile">
						<img src="<?php $model->profileImage(); ?>" class="profile-thumb" alt="User Thumb">
						<span class="status-label"></span>
					</div>
					<h6 class="profile-name"><?php $model->voidUser('fullname') ?></h6>
					<div class="profile-actions">
						<a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
							<i class="icon-settings1"></i>
						</a>
						<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
							<i class="icon-twitter1"></i>
						</a>
						<a href="../logout/" class="red" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout">
							<i class="icon-power1"></i>
						</a>
					</div>					
				</div>
    <!-- Quick links end -->

    <!-- Sidebar content start -->
    <div class="sidebar-content">

        <!-- sidebar menu start -->
        <div class="sidebar-menu">
            <ul>
                <li >
                    <a href="home">
                        <i class="icon-home2"></i>
                        <span class="menu-text">Dashboards</span>
                    </a>

                    
                </li>
                <li>
                    <a href="widgets.html">
                        <i class="icon-circular-graph"></i>
                        <span class="menu-text">Widgets</span>
                    </a>
                </li>
                <li>
                    <a href="graph-widgets.html" class="current-page">
                        <i class="icon-line-graph"></i>
                        <span class="menu-text">Graph Widgets</span>
                    </a>
                </li>
                <li class="sidebar-dropdown">
                    <a >
                        <i class="icon-line-graph"></i>
                        <span class="menu-text">Investment</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                        <li>
                                <a href="myinvestment">My Investments</a>
                            </li>
                            <li>
                                <a href="deposit">New Deposit</a>
                            </li>
                            <li>
                                <a href="reset-investment">Reset Investment</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="icon-user"></i>
                        <span class="menu-text">Profile Data</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="profile">Profile</a>
                            </li>
                            <li>
                                <a href="edit-profile">Update Profile</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="icon-layers2"></i>
                        <span class="menu-text">Layouts</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="default-layout.html">Default Layout</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                <li class="sidebar-dropdown">
                    <a >
                        <i class="icon-calendar"></i>
                        <span class="menu-text">History</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                        <li>
                                <a href="myinvestment">My Investments</a>
                            </li>
                            <li>
                                <a href="deposit">New Deposit</a>
                            </li>
                            <li>
                                <a href="reset-investment">Reset Investment</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                

                <li class="sidebar-dropdown">
                    <a >
                        <i class="icon-line-graph"></i>
                        <span class="menu-text">Withdrawals</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                        <li>
                                <a href="withdraw">Withdraw Profit</a>
                            </li>
                            <li>
                                <a href="requestCapital">Request Capital</a>
                            </li>
                            <li>
                                <a href="reset-investment">Reset Investment</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="icon-unlock"></i>
                        <span class="menu-text">Authentication</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                            <li>
                                <a href="signup.html">Signup</a>
                            </li>
                            <li>
                                <a href="forgot-pwd.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="error.html">404</a>
                            </li>
                            <li>
                                <a href="error2.html">505</a>
                            </li>
                            <li>
                                <a href="coming-soon.html">Coming Soon</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end -->

    </div>
    <!-- Sidebar content end -->
    
</nav>
<!-- Sidebar wrapper end -->
<!-- Header start -->
<header class="header">
    <div class="toggle-btns">
        <a id="toggle-sidebar" href="#">
            <i class="icon-menu"></i>
        </a>
        <a id="pin-sidebar" href="#">
            <i class="icon-menu"></i>
        </a>
    </div>
    <div class="header-items">
        <!-- Custom search start -->
        <div class="custom-search">
            <input type="text" class="search-query" placeholder="Search here ...">
            <i class="icon-search1"></i>
        </div>
        <!-- Custom search end -->

        <!-- Header actions start -->
        <ul class="header-actions">
            <li class="dropdown d-none d-sm-block">
                <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                    <i class="icon-calendar1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                    <div class="dropdown-menu-header">
                        Events (10)
                    </div>
                    <ul class="header-notifications">
                        <li>
                            <a href="#">
                                <div class="user-img away">
                                    <img src="<?php $model->profileImage();  ?>" alt="User">
                                </div>
                                <div class="details">
                                    <div class="user-title">Abbott</div>
                                    <div class="noti-details">Membership has been ended.</div>
                                    <div class="noti-date">Oct 20, 07:30 pm</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="user-img busy">
                                    <img src="<?php $model->profileImage();  ?>" alt="User">
                                </div>
                                <div class="details">
                                    <div class="user-title">Braxten</div>
                                    <div class="noti-details">Approved new design.</div>
                                    <div class="noti-date">Oct 10, 12:00 am</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="user-img online">
                                    <img src="../static/user/img/user19.png" alt="User">
                                </div>
                                <div class="details">
                                    <div class="user-title">Larkyn</div>
                                    <div class="noti-details">Check out every table in detail.</div>
                                    <div class="noti-date">Oct 15, 04:00 pm</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="dropdown d-none d-sm-block">
                <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                    <i class="icon-star2"></i>
                    <span class="count-label blue"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                    <div class="dropdown-menu-header">
                        Bookmarks (21)
                    </div>
                    <div class="customScroll5">
                        <ul class="bookmarks p-3">
                            <li>
                                <a href="#">Bootstrap admin template</a>
                            </li>
                        
                        </ul>
                    </div>
                </div>
            </li>
            <li class="dropdown d-none d-sm-block">
                <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                    <i class="icon-bell"></i>
                    <span class="count-label"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">
                    <div class="dropdown-menu-header">
                        Notifications (40)
                    </div>
                    <ul class="header-notifications">
                        <li>
                            <a href="#">
                                <div class="user-img away">
                                    <img src="{% static 'user/img/user21.png' %}" alt="User">
                                </div>
                                <div class="details">
                                    <div class="user-title">Abbott</div>
                                    <div class="noti-details">Membership has been ended.</div>
                                    <div class="noti-date">Oct 20, 07:30 pm</div>
                                </div>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <li class="dropdown user-settings">
                <a href="#" id="userSettings" data-toggle="dropdown" aria-haspopup="true">
                    <img src="<?php $model->profileImage();  ?>" class="user-avatar" alt="Avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <div class="header-user-profile">
                            <div class="header-user">
                                <img src="<?php $model->profileImage();  ?>" alt="Admin Template">
                            </div>
                            <h5><?php $model->voidUser('fullname'); ?></h5>
                            <p>Account User</p>
                        </div>
                        <a href="profile"><i class="icon-user1"></i> My Profile</a>
                        <a href="settings"><i class="icon-settings1"></i> Account Settings</a>
                        <a href="../logout/"><i class="icon-log-out1"></i> Sign Out</a>
                    </div>
                </div>
            </li>
        </ul>						
        <!-- Header actions end -->
    </div>
</header>
<!-- Header end -->
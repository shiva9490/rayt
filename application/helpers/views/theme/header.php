<div class="edu_logo_header_wrapper float_left">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="edu_border_line">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="edu_logo_main_wrapper">
                                <a href="<?php echo base_url();?>">
                                    <img src="<?php echo $this->config->item("themeassets");?>logo.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10 d-block d-sm-block d-md-block">
                            <div class="edu_navihation_header_wrapper float_left">
                                <div class="container">
                                    <input type="hidden" value="<?php echo $this->session->userdata("register_id");?>" class="loginid"/>
                                    <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
                                        <div class="cd-dropdown-wrapper">
                                            <a class="house_toggle" href="#0"> <i class="flaticon-menu"></i></a>
                                            <nav class="cd-dropdown">
                                                <h2><a href="#"><img src="<?php echo $this->config->item("themeassets");?>logo.png" class="img img-responsive"/></a></h2>
                                                <a href="#0" class="cd-close">Close</a>
                                                <ul class="cd-dropdown-content">
                                                    <li><a href="<?php echo base_url();?>">Home</a></li>
                                                    <?php if($this->session->userdata("register_type") == "Student"){ ?>
                                                    <li class="has-children"><a href="#">Tutors</a>
                                                        <ul class="cd-secondary-dropdown icon_menu is-hidden">
                                                            <li class="go-back"><a href="#0">Tutors</a></li>
                                                            <li><a href="<?php echo base_url("All-Tutors");?>">All Tutors</a></li>
                                                            <li><a href="<?php echo base_url("Online-Tutors");?>">Online Tutors</a></li>
                                                        </ul>
                                                    </li>
                                                    <?php } if($this->session->userdata("register_type") == "Student"){ ?>
                                                    <li class="has-children"><a href="#">Gallery</a>
                                                        <ul class="cd-secondary-dropdown icon_menu is-hidden">
                                                            <li class="go-back"><a href="#0">Tutor Jobs</a>
                                                            </li>
                                                            <li><a href="<?php echo base_url("All-Tutor-Jobs");?>">All Tutor Jobs</a></li>
                                                            <li><a href="<?php echo base_url("Online-Tutor-Jobs");?>">Online Tutor Jobs</a></li>
                                                        </ul>
                                                    </li>
                                                    <?php } ?>
                                                    <li><a href="javascript:void(0);" onclick="checkotpvalue($(this))">Login</a></li>
                                                    <li><a href="<?php echo base_url("Register");?>">Register</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </header>
                                    <div class="kv_navigation_wrapper">
                                        <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                            <ul class="main_nav_ul">
                                                <li class="has-mega gc_main_navigation"><a href="<?php echo base_url();?>" class="gc_main_navigation hover_color">Home</a></li>
                                                <?php if($this->session->userdata("register_type") == "Student") { ?>
                                                <li class="has-mega gc_main_navigation"><a href="javascript:void(0);" class="gc_main_navigation hover_color">  Tutors <i class="fa fa-angle-down"></i></a>
                                                    <ul>
                                                        <li class="parent"><a href="<?php echo base_url("All-Tutors");?>">All Tutors</a></li>
                                                        <li class="parent"><a href="<?php echo base_url("Online-Tutors");?>">Online Tutors</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-mega gc_main_navigation"><a href="<?php echo base_url("Buy-Coins");?>" class="gc_main_navigation hover_color">Buy Coins</a></li>
                                                <li class="has-mega gc_main_navigation"><a href="<?php echo base_url("Post-Requirement");?>" class="gc_main_navigation hover_color">Request</a></li>
                                                <?php } if($this->session->userdata("register_type") == "Teacher") { ?>
                                                <li class="has-mega gc_main_navigation"><a href="javascript:void(0);" class="gc_main_navigation hover_color">  Tutor Jobs <i class="fa fa-angle-down"></i></a>
                                                    <ul>
                                                        <li class="parent"><a href="<?php echo base_url("All-Tutor-Jobs");?>">All Tutor Jobs</a></li>
                                                        <li class="parent"><a href="<?php echo base_url("Online-Tutor-Jobs");?>">Online Tutor Jobs</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-mega gc_main_navigation"><a href="<?php echo base_url("Buy-Coins");?>" class="gc_main_navigation hover_color">Buy Coins</a></li>
                                                <?php } ?>
                                                <?php if($this->session->userdata("register_id") == "") { ?>
                                                <li class="has-mega gc_main_navigation"><a href="javascript:void(0);" class="gc_main_navigation hover_color">  Tutors <i class="fa fa-angle-down"></i></a>
                                                    <ul>
                                                        <li class="parent"><a href="<?php echo base_url("All-Tutors");?>">All Tutors</a></li>
                                                        <li class="parent"><a href="<?php echo base_url("Online-Tutors");?>">Online Tutors</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-mega gc_main_navigation"><a href="javascript:void(0);" class="gc_main_navigation hover_color">  Tutor Jobs <i class="fa fa-angle-down"></i></a>
                                                    <ul>
                                                        <li class="parent"><a href="<?php echo base_url("All-Tutor-Jobs");?>">All Tutor Jobs</a></li>
                                                        <li class="parent"><a href="<?php echo base_url("Online-Tutor-Jobs");?>">Online Tutor Jobs</a></li>
                                                    </ul>
                                                </li>
                                                <li class="has-mega gc_main_navigation"><a href="javascript:void(0);" onclick="checkotpvalue($(this))" class="gc_main_navigation hover_color">Login</a></li>
                                                <li class="has-mega gc_main_navigation"><a href="<?php echo base_url("Register");?>" class="gc_main_navigation hover_color">Register</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php if($this->session->userdata("register_id") != "") { 
                                        if($this->session->userdata("register_type") == "Teacher") { ?>
                                            <div class="edu_profile_wrapper">
                                                <div class="nice-select" tabindex="0"> <span class="current"><img src="<?php echo $this->config->item("themeassets");?>images/profile_img.png" alt="img"> <span class="hidden_xs_content"></span></span>
                                                    <ul class="list">
                                                        <li><a href="<?php echo base_url("Tutor-Profile");?>"> Profile</a></li>
                                                        <li><a href="<?php echo base_url("Tutor-Balance");?>"> My Balance</a></li>
                                                        <li><a href="<?php echo base_url("Tutor-Transactions");?>"> Payments</a>
                                                        <li><a href="<?php echo base_url("Logout");?>"> Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="edu_message_dropbox_wrapper">
                                                <div class="nice-select budge_noti_wrapper" tabindex="0"> <span class="current"><i class="flaticon-notification"></i></span>
                                                    <div class="budge_noti">0</div>
                                                    <ul class="list">
                                                        <li>
                                                            <div class="crm_mess_main_box_wrapper">
                                                                <div class="crm_mess_img_wrapper">
                                                                    <img src="<?php echo $this->config->item("themeassets");?>images/mess1.jpg" alt="img">
                                                                </div>
                                                                <div class="crm_mess_img_cont_wrapper">
                                                                    <h4>Mr.Farhan <span>01:30PM</span></h4>
                                                                    <p>I'm Leaving early</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="crm_mess_all_main_box_wrapper">
                                                                <p><a href="#">See All</a>
                                                                </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php } else{ ?>
                                            <div class="edu_profile_wrapper">
                                                <div class="nice-select" tabindex="0"> <span class="current"><img src="<?php echo $this->config->item("themeassets");?>images/profile_img.png" alt="img"> <span class="hidden_xs_content"></span></span>
                                                    <ul class="list">
                                                        <li><a href="<?php echo base_url("My-Profile");?>"> Profile</a></li>
                                                        <li><a href="<?php echo base_url("My-Balance");?>"> My Balance</a></li>
                                                        <li><a href="<?php echo base_url("My-Transactions");?>"> Payments</a>
                                                        <li><a href="<?php echo base_url("My-Posts");?>"> Posts</a>
                                                        <li><a href="<?php echo base_url("Logout");?>"> Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="edu_message_dropbox_wrapper">
                                                <div class="nice-select budge_noti_wrapper" tabindex="0"> <span class="current"><i class="flaticon-notification"></i></span>
                                                    <div class="budge_noti">4</div>
                                                    <ul class="list">
                                                        <li><a href="#">2 New Messages</a>
                                                        </li>
                                                        <li>
                                                            <div class="crm_mess_main_box_wrapper">
                                                                <div class="crm_mess_img_wrapper">
                                                                    <img src="<?php echo $this->config->item("themeassets");?>images/mess1.jpg" alt="img">
                                                                </div>
                                                                <div class="crm_mess_img_cont_wrapper">
                                                                    <h4>Mr.Farhan <span>01:30PM</span></h4>
                                                                    <p>I'm Leaving early</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="crm_mess_main_box_wrapper">
                                                                <div class="crm_mess_img_wrapper">
                                                                    <img src="<?php echo $this->config->item("themeassets");?>images/mess2.jpg" alt="img">
                                                                </div>
                                                                <div class="crm_mess_img_cont_wrapper">
                                                                    <h4>Mr.ajay <span>01:30PM</span></h4>
                                                                    <p>I'm Leaving early</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="crm_mess_main_box_wrapper">
                                                                <div class="crm_mess_img_wrapper">
                                                                    <img src="<?php echo $this->config->item("themeassets");?>images/mess3.jpg" alt="img">
                                                                </div>
                                                                <div class="crm_mess_img_cont_wrapper">
                                                                    <h4>Mr.akshay <span>01:30PM</span></h4>
                                                                    <p>I'm Leaving early</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="crm_mess_main_box_wrapper">
                                                                <div class="crm_mess_img_wrapper">
                                                                    <img src="<?php echo $this->config->item("themeassets");?>images/mess4.jpg" alt="img">
                                                                </div>
                                                                <div class="crm_mess_img_cont_wrapper">
                                                                    <h4>Mr.john <span>01:30PM</span></h4>
                                                                    <p>I'm Leaving early</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="crm_mess_all_main_box_wrapper">
                                                                <p><a href="#">See All</a>
                                                                </p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php } 
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
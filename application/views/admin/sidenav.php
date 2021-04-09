<!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="<?php echo adminurl('Dashboard');?>" data-active="true" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
					<?php if($this->session->userdata("manage-permissions") == "1"
				   || $this->session->userdata("manage-users") == "1"
				   || $this->session->userdata("manage-roles") == "1"){?>
                    <li class="menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                <span>Administration</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                            <?php if($this->session->userdata("manage-permissions") == "1"){?>
							<li>
                                <a href="<?php echo adminurl('Permissions');?>"> Permissions </a>
                            </li>
							<?php  } if($this->session->userdata("manage-roles") == "1"){?>
                            <li>
                                <a href="<?php echo adminurl('Roles');?>"> Roles  </a>
                            </li>
							<?php  } if($this->session->userdata("manage-users") == "1"){?>
                            <li>
                                <a href="<?php echo adminurl('Users');?>"> Users </a>
                            </li>                            
							<?php  } ?>
                        </ul>
                    </li>
					<?php } ?>
                    <li class="menu">
                        <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Components</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
                            <li>
                                <a href="component_tabs.html"> Tabs </a>
                            </li>
                            <li>
                                <a href="component_accordion.html"> Accordions  </a>
                            </li>
                            <li>
                                <a href="component_modal.html"> Modals </a>
                            </li>                            
                            <li>
                                <a href="component_cards.html"> Cards </a>
                            </li>
                            <li>
                                <a href="component_bootstrap_carousel.html">Carousel</a>
                            </li>
                            <li>
                                <a href="component_blockui.html"> Block UI </a>
                            </li>
                            <li>
                                <a href="component_countdown.html"> Countdown </a>
                            </li>
                            <li>
                                <a href="component_counter.html"> Counter </a>
                            </li>
                            <li>
                                <a href="component_sweetalert.html"> Sweet Alerts </a>
                            </li>
                            <li>
                                <a href="component_timeline.html"> Timeline </a>
                            </li>
                            <li>
                                <a href="component_snackbar.html"> Notifications </a>
                            </li>
                            <li>
                                <a href="component_session_timeout.html"> Session Timeout </a>
                            </li>
                            <li>
                                <a href="component_media_object.html"> Media Object </a>
                            </li>
                            <li>
                                <a href="component_list_group.html"> List Group </a>
                            </li>
                            <li>
                                <a href="component_pricing_table.html"> Pricing Tables </a>
                            </li>
                            <li>
                                <a href="component_lightbox.html"> Lightbox </a>
                            </li>
                        </ul>
                    </li>

                   
				   <?php if($this->session->userdata("manage-customers") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Customers');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                <span>Customers</span>
                            </div>
                        </a>
                    </li>
				   <?php } if($this->session->userdata("manage-resturant") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Resturant');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                                <span>Resturant</span>
                            </div>
                        </a>
                    </li>
					<?php } if($this->session->userdata("manage-country") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Country');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
								<span>Country</span>
                            </div>
                        </a>
                    </li>
					<?php } ?>                    
                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->
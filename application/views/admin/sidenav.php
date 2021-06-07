<!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="<?php echo adminurl('Dashboard');?>" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
					<?php if($this->session->userdata("manage-master") == "1"){ ?>
					<?php } if($this->session->userdata("manage-permissions") == "1"
				   || $this->session->userdata("manage-users") == "1"
				   || $this->session->userdata("manage-roles") == "1"){
				   ?>
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
							<?php  } //if($this->session->userdata("manage-users") == "1"){?>
                            <li>
                                <a href="<?php echo adminurl('Users');?>"> Users </a>
                            </li>                            
							<?php  //} ?>
                        </ul>
                    </li>
					<?php } if($this->session->userdata("manage-Orders") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Orders');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                <span>Orders</span>
                            </div>
                        </a>
                    </li>
                      <?php } if($this->session->userdata("manage-reports") == "1"){ ?>
                      <li class="menu">
                        <a href="#componentss" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span>Reports</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="componentss" data-parent="#accordionExample">
                            <li>
                                <a href="<?php echo adminurl('Sales-Reports');?>"> Sales Report </a>
                            </li>
                            <li>
                                <a href="<?php echo adminurl('Reports');?>"> Report  </a>
                            </li>
                        </ul>
                    </li>
				   <?php } if($this->session->userdata("manage-customers") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Customers');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Customers</span>
                            </div>
                        </a>
                    </li>
				   <?php } if($this->session->userdata("manage-resturant") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Resturant');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Out_line" data-name="Out line" viewBox="0 0 512 512" width="512" height="512"><path d="M488,424H432V263.29A34.78715,34.78715,0,0,0,457.46,216.72L432,150.51V24a7.9979,7.9979,0,0,0-8-8H88a7.9979,7.9979,0,0,0-8,8V150.51L54.54,216.72A34.78715,34.78715,0,0,0,80,263.29V424H24a7.9979,7.9979,0,0,0-8,8v56a7.9979,7.9979,0,0,0,8,8H488a7.9979,7.9979,0,0,0,8-8V432A7.9979,7.9979,0,0,0,488,424Zm-88,0V253.37012a34.71789,34.71789,0,0,0,16,9.42968V424Zm-64,8v48H304V424h16a8.00008,8.00008,0,0,0,8-8V392a8.00008,8.00008,0,0,0-8-8H272a8.00008,8.00008,0,0,0-8,8v24a8.00008,8.00008,0,0,0,8,8h16v56H256V432a7.9979,7.9979,0,0,0-8-8H232V400a7.9979,7.9979,0,0,0-8-8H208V263.27a34.76613,34.76613,0,0,0,19.77-11.91992c.49.60986,1.01,1.2,1.56006,1.77978A34.45484,34.45484,0,0,0,254.59009,264h2.81982a34.45484,34.45484,0,0,0,25.26-10.87012c.55-.57983,1.07007-1.16992,1.56006-1.77978a35.34823,35.34823,0,0,0,3.77,3.89306V280a40.04018,40.04018,0,0,0-40,40,7.9979,7.9979,0,0,0,8,8h80a7.9979,7.9979,0,0,0,8-8,40.04018,40.04018,0,0,0-40-40V263.27a34.32831,34.32831,0,0,0,7.07007.73h2.5A34.74109,34.74109,0,0,0,340.1,251.72c.21008-.24.41-.49.6-.74A34.66032,34.66032,0,0,0,367.88,264h1.54993A34.87794,34.87794,0,0,0,384,260.83984V392H368a7.9979,7.9979,0,0,0-8,8v24H344A7.9979,7.9979,0,0,0,336,432Zm-56-24v-8h32v8ZM124.43994,224.27,142.1,160h32.47009l-11.91016,72.27A18.72575,18.72575,0,0,1,144.12,248h-1.54993a18.79649,18.79649,0,0,1-18.13013-23.73ZM128,260.83984A34.87794,34.87794,0,0,0,142.57007,264H144.12a34.66032,34.66032,0,0,0,27.18-13.02c.18994.25.38989.5.6.74A34.7192,34.7192,0,0,0,192,263.3999V304H128ZM198.42993,248A18.78368,18.78368,0,0,1,179.89,226.1499L190.79,160h32.76l-3.86011,70.24a18.79017,18.79017,0,0,1-18.76,17.76Zm72.62012-5.87012A18.62778,18.62778,0,0,1,257.40991,248h-2.81982a18.78805,18.78805,0,0,1-18.76-19.77l3.74-68.23h32.85986l3.74,68.17993v.05A18.56839,18.56839,0,0,1,271.05005,242.12988Zm21.26-11.88989L288.45,160h32.76l10.9,66.1499A18.78368,18.78368,0,0,1,313.57007,248h-2.5A18.79017,18.79017,0,0,1,292.31006,230.24ZM304,296a24.04436,24.04436,0,0,1,22.63,16H265.37A24.04436,24.04436,0,0,1,288,296Zm80.37-55.3999A18.646,18.646,0,0,1,369.42993,248H367.88a18.72575,18.72575,0,0,1-18.53991-15.73L337.42993,160H369.9l17.65,64.23c0,.01.01.03.01.04A18.66841,18.66841,0,0,1,384.37,240.6001ZM376,408h8v16h-8Zm66.53-185.54A18.79162,18.79162,0,0,1,424.99,248a18.848,18.848,0,0,1-18.12-13.81006L386.49,160h32.02ZM96,32H416V144H96ZM71.52,239.8501A18.53785,18.53785,0,0,1,69.47,222.46L93.49,160h32.02l-20.38,74.18994A18.848,18.848,0,0,1,87.01,248,18.53854,18.53854,0,0,1,71.52,239.8501ZM96,262.7998a34.71789,34.71789,0,0,0,16-9.42968V424H96ZM160,480H32V440H160Zm8-56H128V320h64V480H176V432A7.9979,7.9979,0,0,0,168,424Zm40-16h8v24a7.9979,7.9979,0,0,0,8,8h16v40H208Zm272,72H352V440H480Z"/><path d="M312,96h-8.67944A48.10631,48.10631,0,0,0,264,56.67944V48a8,8,0,0,0-16,0v8.67944A48.10631,48.10631,0,0,0,208.67944,96H200a8.00008,8.00008,0,0,0-8,8,32.03635,32.03635,0,0,0,32,32h64a32.03635,32.03635,0,0,0,32-32A8.00008,8.00008,0,0,0,312,96ZM256,72a32.0583,32.0583,0,0,1,30.98779,24H225.01221A32.0583,32.0583,0,0,1,256,72Zm32,48H224a16.008,16.008,0,0,1-13.85254-8h91.70508A16.008,16.008,0,0,1,288,120Z"/><path d="M196.4375,78.65625A7.99943,7.99943,0,0,0,200,72V48H184V67.43164a35.21285,35.21285,0,0,1-8,2.926V48H160V70.35767a35.22267,35.22267,0,0,1-8-2.926V48H136V72a7.99943,7.99943,0,0,0,3.5625,6.65625A51.28005,51.28005,0,0,0,160,86.65576V136h16V86.65576A51.28005,51.28005,0,0,0,196.4375,78.65625Z"/><path d="M344,40a32.00193,32.00193,0,0,0-8,62.9873V136h16V102.9873A32.00193,32.00193,0,0,0,344,40Zm0,48a16,16,0,1,1,16-16A16.01833,16.01833,0,0,1,344,88Z"/></svg>
                                <span>Resturant</span>
                            </div>
                        </a>
                    </li>
					<?php } if($this->session->userdata("manage-zones") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Zones');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
								<span>Zones</span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="menu">
                        <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                <span>Masters</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">
                            <?php  if($this->session->userdata("manage-country") == "1"){ ?>
                            <li>
                                <a  href="<?php echo adminurl('Country');?>"> Country </a>
                            </li>
                            <?php } if($this->session->userdata("manage-cuisine") == "1"){ ?>
                            <li>
                                <a  href="<?php echo adminurl('Cuisine');?>"> Cuisine </a>
                            </li>
                            <?php } if($this->session->userdata("manage-addon") == "1"){ ?>
                            <li>
                                <a href="<?php echo adminurl('Addon');?>"> Addon </a>
                            </li>
                            <?php } if($this->session->userdata("manage-variant") == "1"){ ?>
                            <li>
                                <a href="<?php echo adminurl('Variant');?>"> Variant </a>
                            </li>       
                            <?php } if($this->session->userdata("manage-banner") == "1"){ ?>
                            <li>
                                <a href="<?php echo adminurl('Banner');?>"> Featuerd Banners </a>
                            </li>
                            <?php } if($this->session->userdata("manage-resturant_banner") == "1"){ ?>
                            <li>
                                <a href="<?php echo adminurl('Resturant-Banner');?>"> Resturant-Banner </a>
                            </li>
                             <?php } if($this->session->userdata("manage-helpdesk") == "1"){?>
                            <li>
                                <a href="#appInvoice" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Helpdesk <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="appInvoice" data-parent="#app"> 
                                    <li>
                                        <a href="<?php echo adminurl('Helpdesk-Category');?>"> Category </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo adminurl('Helpdesk-Subcategory');?>"> Sub Category </a>
                                    </li>                                   
                                </ul>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo adminurl('Content-Pages');?>"> Pages </a>
                            </li>
                        </ul>
                    </li>
                    
					
					<?php  if($this->session->userdata("manage-category") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Category');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
								<span>Category</span>
                            </div>
                        </a>
                    </li> 
					<?php } ?>    
					  <?php  if($this->session->userdata("manage-driver") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Drivers');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m426.131 310.922c.378-6.253.441-12.758.171-19.522-1.452-36.122-16.428-70.418-32.283-106.729-2.726-6.244-5.504-12.626-8.26-19.104h1.836c11.344 0 20.573-9.229 20.573-20.573v-47.055c0-11.344-9.229-20.573-20.573-20.573h-70.665c-20.877 0-38.4 14.587-42.943 34.101h-34.272c-5.522 0-10 4.477-10 10s4.478 10 10 10h34.272c3.674 15.78 15.835 28.331 31.398 32.557l21.545 96.068c6.81 30.308-5.029 48.22-16.16 57.91-17.259 15.022-44.523 19.801-66.307 11.62-18.894-7.096-30.903-22.73-33.815-44.022l-.828-6.049h8.466c5.522 0 10-4.477 10-10v-27.638c0-15.4-10.222-28.454-24.236-32.743v-163.36c0-5.523-4.478-10-10-10h-171.862c-5.522 0-10 4.477-10 10v41.018c0 5.523 4.478 10 10 10s10-4.477 10-10v-31.018h35.246v60.186c0 3.624 1.961 6.965 5.125 8.731 3.165 1.767 7.037 1.683 10.123-.219l25.423-15.672 25.422 15.672c1.606.991 3.426 1.488 5.248 1.488 1.678 0 3.357-.422 4.875-1.269 3.164-1.767 5.125-5.107 5.125-8.731v-60.186h35.274v151.866h-151.861v-31.046c0-5.523-4.478-10-10-10s-10 4.477-10 10v41.046 48.649c-7.98 11.576-12.188 25.013-12.188 39.083v78.747c0 16.205 13.171 29.389 29.36 29.389h23.927c4.889 35.34 35.277 62.646 71.94 62.646 36.677 0 67.076-27.306 71.968-62.646h149.983c4.889 35.34 35.277 62.646 71.939 62.646 36.677 0 67.076-27.306 71.968-62.646h10.915c5.522 0 10-4.477 10-10 0-48.857-37.917-89.024-85.869-92.622zm-297.356-212.839-15.422-9.507c-3.219-1.984-7.277-1.983-10.496 0l-15.423 9.508v-42.274h41.341zm236.303-.717h22.518c.289 0 .573.284.573.573v47.056c0 .289-.284.573-.573.573h-22.515c-6.377-15.88-6.378-32.341-.003-48.202zm-50.246 48.105c-.175-.02-.351-.038-.528-.049-11.815-1.286-21.086-11.145-21.456-23.209.018-.247.038-.494.038-.746s-.02-.499-.038-.746c.396-12.945 11.043-23.355 24.082-23.355h26.938c-4.871 15.947-4.87 32.244.004 48.202h-26.942c-.708 0-1.406-.037-2.098-.097zm-282.644 82.204h161.862c7.85 0 14.236 6.386 14.236 14.236v17.638h-176.098zm93.039 228.515c-25.609 0-46.994-18.384-51.68-42.646h103.388c-4.689 24.262-26.086 42.646-51.708 42.646zm-72.153-62.646c4.889-35.472 35.372-62.886 72.153-62.886 36.794 0 67.289 27.413 72.18 62.886zm263.969 0h-99.473c-5.004-46.532-44.506-82.886-92.343-82.886-47.824 0-87.314 36.354-92.316 82.886h-3.55c-5.161 0-9.36-4.212-9.36-9.389v-78.747c0-9.223 2.559-18.07 7.425-25.858h162.208l1.198 8.76c3.898 28.494 20.883 50.375 46.6 60.034 9.483 3.562 19.606 5.287 29.744 5.287 20.655 0 41.355-7.165 56.726-20.544 21.536-18.747 29.542-46.228 22.544-77.376l-20.217-90.143h37.836c3.859 9.291 7.794 18.329 11.627 27.107 15.736 36.038 29.326 67.162 30.627 99.525 1.359 34.076-6.383 60.129-23.014 77.436-15.244 15.864-37.538 23.908-66.262 23.908zm102.073 62.646c-25.609 0-46.994-18.384-51.68-42.646h103.388c-4.688 24.262-26.085 42.646-51.708 42.646zm-32.917-62.646c4.144-3.021 7.993-6.374 11.526-10.051 13.159-13.694 21.826-31.333 25.947-52.677 34.731 2.155 62.958 28.73 67.644 62.727h-105.117z"/><path d="m22.188 141.756c5.522 0 10-4.505 10-10.028s-4.478-10-10-10-10 4.477-10 10v.057c0 5.523 4.478 9.971 10 9.971z"/></g></g></svg>
                                <span>Drivers</span>
                            </div>
                        </a>
                    </li> 
					<?php } ?> 
					  <?php  if($this->session->userdata("manage-helpdeskenquire") == "1"){ ?>
                    <li class="menu">
                        <a href="<?php echo adminurl('Helpdesk-Enquire');?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
								<span>Enquire Form </span>
                            </div>
                        </a>
                    </li> 
					<?php } ?>  
                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->
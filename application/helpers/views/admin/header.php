<header class="topbar-nav">
    <nav id="header-setting" class="navbar navbar-expand fixed-top">
       <ul class="navbar-nav mr-auto align-items-center">
          <li class="nav-item">
             <a class="nav-link toggle-menu" href="javascript:void();">
             <i class="icon-menu menu-icon"></i>
             </a>
          </li>
          <li>
              <a href="<?php echo base_url();?>" target="_blank"><i class="fa fa-globe"></i></a>
          </li>
       </ul>
       <ul class="navbar-nav align-items-center right-nav-link">
          <li class="nav-item dropdown-lg">
             <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
             <i class="fa fa-envelope-open-o"></i><span class="badge badge-primary badge-up">12</span></a>
             <div class="dropdown-menu dropdown-menu-right">
                <ul class="list-group list-group-flush">
                   <li class="list-group-item d-flex justify-content-between align-items-center">
                      You have 12 new messages
                      <span class="badge badge-primary">12</span>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">Jhon Deo</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                               <small>Today, 4:10 PM</small>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">Sara Jen</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                               <small>Yesterday, 8:30 AM</small>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">Dannish Josh</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                               <small>5/11/2018, 2:50 PM</small>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet.</p>
                               <small>1/11/2018, 2:50 PM</small>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item text-center"><a href="javaScript:void();">See All Messages</a></li>
                </ul>
             </div>
          </li>
          <li class="nav-item dropdown-lg">
             <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
             <i class="fa fa-bell-o"></i><span class="badge badge-info badge-up">14</span></a>
             <div class="dropdown-menu dropdown-menu-right">
                <ul class="list-group list-group-flush">
                   <li class="list-group-item d-flex justify-content-between align-items-center">
                      You have 14 Notifications
                      <span class="badge badge-info">14</span>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <i class="zmdi zmdi-accounts fa-2x mr-3 text-info"></i>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">New Registered Users</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <i class="zmdi zmdi-coffee fa-2x mr-3 text-warning"></i>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">New Received Orders</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item">
                      <a href="javaScript:void();">
                         <div class="media">
                            <i class="zmdi zmdi-notifications-active fa-2x mr-3 text-danger"></i>
                            <div class="media-body">
                               <h6 class="mt-0 msg-title">New Updates</h6>
                               <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                            </div>
                         </div>
                      </a>
                   </li>
                   <li class="list-group-item text-center"><a href="javaScript:void();">See All Notifications</a></li>
                </ul>
             </div>
          </li>
          <li class="nav-item">
             <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="javascript:void(0);">
                <span class="user-profile">
                    <img src="<?php echo $this->config->item("tutorassets");?>avatar.png" class="img-circle" alt="<?php echo $this->session->userdata("loginname");?>">
                </span>
             </a>
             <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-item user-details">
                   <a href="javaScript:void();">
                      <div class="media">
                         <div class="avatar">
                             <img class="align-self-start mr-3" src="<?php echo $this->config->item("tutorassets");?>avatar.png" alt="<?php echo $this->session->userdata("loginname");?>"></div>
                         <div class="media-body">
                            <h6 class="mt-2 user-title"><?php echo $this->session->userdata("login_name");?></h6>
                            <p class="user-subtitle"><?php echo $this->session->userdata("login_users");?></p>
                         </div>
                      </div>
                   </a>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-item">
                    <a href="<?php echo adminurl("Change-Password");?>"><i class="icon-settings mr-2"></i> Setting</a>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-item">
                    <a href="<?php echo adminurl("Logout");?>"><i class="icon-power mr-2"></i> Logout</a>
                </li>
             </ul>
          </li>
       </ul>
    </nav>
 </header>
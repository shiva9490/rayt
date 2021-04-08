<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
       <a href="<?php echo adminurl("Dashboard");?>">
          <img src="<?php echo $this->config->item("tutorassets");?><?php echo sitedata("site_logo");?>" class="logo-icon" alt="logo icon">
          <h5 class="logo-text"><?php echo sitedata("site_name");?></h5>
       </a>
    </div>
    <div class="user-details">
       <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
          <div class="avatar"><img class="mr-3 side-user-img" src="<?php echo $this->config->item("tutorassets");?>avatar.png" alt="user avatar"></div>
          <div class="media-body">
             <h6 class="side-user-name"><?php echo $this->session->userdata("login_name");?></h6>
          </div>
       </div>
       <div id="user-dropdown" class="collapse">
          <ul class="user-setting-menu">
             <li><a href="<?php echo adminurl("Change-Password");?>"><i class="icon-settings"></i> Setting</a></li>
             <li><a href="<?php echo adminurl("Logout");?>"><i class="icon-power"></i> Logout</a></li>
          </ul>
       </div>
    </div>
    <ul class="sidebar-menu">
       <li class="sidebar-header">MAIN NAVIGATION</li>
       <li class="Dashboard">
          <a href="<?php echo adminurl("Dashboard");?>" class="waves-effect">
             <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span></i>
          </a>
       </li>
       <?php if($this->session->userdata("manage-permissions") == "1"
               || $this->session->userdata("manage-users") == "1"
               || $this->session->userdata("manage-roles") == "1"){?>
       <li class="Roles Users Update-User Update-Role Permissions">
          <a href="javaScript:void();" class="waves-effect">
              <i class="zmdi zmdi-layers"></i>
              <span>Administration</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="sidebar-submenu">
                <?php if($this->session->userdata("manage-permissions") == "1"){?>
                <li class="Permissions"><a href="<?php echo adminurl("Permissions");?>"><i class="zmdi zmdi-dot-circle-alt"></i> Permissions</a></li>
                <?php  } if($this->session->userdata("manage-roles") == "1"){?>
                <li class="Roles Update-Role"><a href="<?php echo adminurl('Roles');?>"><i class="zmdi zmdi-dot-circle-alt"></i> Roles</a></li>
                <?php  } if($this->session->userdata("manage-users") == "1"){?>
                <li class="Users Update-User"><a href="<?php echo adminurl('Users');?>"><i class="zmdi zmdi-dot-circle-alt"></i> Users</a></li>
                <?php  } ?>
          </ul>
       </li>
        <?php } if($this->session->userdata("manage-degree-type") == "1"
                || $this->session->userdata("manage-institution") == "1"
                || $this->session->userdata("manage-subjects") == "1"
                || $this->session->userdata("manage-opportunities") == "1"
                || $this->session->userdata("manage-levels") == "1"
               || $this->session->userdata("manage-id-proof") == "1"){?>
       <li class="Update-Opportunity Opportunities Update-Degree Levels Institutions Update-Level Update-Organization Subjects Update-Subject Degree-Type ID-Proof Update-Proof">
          <a href="javaScript:void();" class="waves-effect">
            <i class="zmdi zmdi-card-travel"></i>
            <span>Masters</span><i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="sidebar-submenu">
              <?php if($this->session->userdata("manage-degree-type") == "1"){?>
              <li class="Update-Degree Degree-Type"><a href="<?php echo adminurl("Degree-Type");?>"><i class="zmdi zmdi-dot-circle-alt"></i> Degree Type</a></li>
              <?php } if($this->session->userdata("manage-id-proof") == "1"){?>
             <li class="ID-Proof Update-Proof"><a href="<?php echo adminurl("ID-Proof");?>"><i class="zmdi zmdi-dot-circle-alt"></i> ID Proof</a></li>
             <?php } if($this->session->userdata("manage-subjects") == "1"){?>
             <li class="Subjects Update-Subject"><a href="<?php echo adminurl("Subjects");?>"><i class="zmdi zmdi-dot-circle-alt"></i> Subjects</a></li>
             <?php } if($this->session->userdata("manage-levels") == "1"){?>
             <li class="Levels Update-Level"><a href="<?php echo adminurl("Levels");?>"><i class="zmdi zmdi-dot-circle-alt"></i> Levels</a></li>
             <?php }  if($this->session->userdata("manage-institution") == "1"){?>
             <li class="Institutions Update-Organization"><a href="<?php echo adminurl("Institutions");?>"><i class="zmdi zmdi-dot-circle-alt"></i> Institutions</a></li>
             <?php }   if($this->session->userdata("manage-opportunity") == "1"){?>
             <li class="Update-Opportunity Opportunities"><a href="<?php echo adminurl("Opportunities");?>"><i class="zmdi zmdi-dot-circle-alt"></i> Opportunities</a></li>
             <?php } ?>
          </ul>
       </li>
       <?php }  if($this->session->userdata("manage-packages") == "1"){ ?>
       <li class="Packages Update-Package">
          <a href="<?php echo adminurl("Packages");?>" class="waves-effect">
              <i class="fa fa-tags"></i><span>Packages </span>
          </a>
       </li>
       <?php } if($this->session->userdata("manage-students") == "1"){ ?>
       <li class="Students-List">
          <a href="<?php echo adminurl("Students-List");?>" class="waves-effect">
              <i class="zmdi zmdi-account-circle"></i><span>Students </span>
          </a>
       </li>
       <?php }  if($this->session->userdata("manage-tutors-list") == "1"){ ?>
       <li class="Tutors-List">
          <a href="<?php echo adminurl("Tutors-List");?>" class="waves-effect">
              <i class="zmdi zmdi-accounts"></i><span>Tutors </span>
          </a>
       </li>
       <?php } ?>
    </ul>
 </div>
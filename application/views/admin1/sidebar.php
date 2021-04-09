<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#" align="center" class="p-0"> <img src="<?php echo $this->config->item('admin_assets');?>images/logo.png" width="85px"/></a>
       <?php $uri=$this->uri->segment(2);?>
        <a href="<?php echo adminurl('Home');?>" <?php if($uri=='Home'){echo 'class="active"';}?>>
          <img src="<?php echo $this->config->item('admin_assets');?>images/dashboard.png" width="18px"/>
          &nbsp;&nbsp;Dashboard
        </a>
        <?php if($this->session->userdata("manage-permissions") == "1"
               || $this->session->userdata("manage-users") == "1"
               || $this->session->userdata("manage-roles") == "1"){?>
              <a href="javaScript:void();" class="waves-effect">
                  <span>Administration</span>
              </a>
                    <?php if($this->session->userdata("manage-permissions") == "1"){?>
                    <a href="<?php echo adminurl("Permissions");?>"> Permissions</a>
                    <?php  } if($this->session->userdata("manage-roles") == "1"){?>
                    <a href="<?php echo adminurl('Roles');?>"> Roles</a>
                    <?php  } if($this->session->userdata("manage-users") == "1"){?>
                    <a href="<?php echo adminurl('Users');?>"> Users</a>
                    <?php  } ?>
            <?php } ?>
        <a href="<?php echo adminurl('Orders');?>" <?php if($uri=='Orders'){echo 'class="active"';}?>>
          <img src="<?php echo $this->config->item('admin_assets');?>images/orders.png" width="18px"/>
          &nbsp;&nbsp;Orders
        </a>
        <a href="<?php echo adminurl('Address-Evalution');?>" <?php if($uri=='Address-Evalution'){echo 'class="active"';}?>>
          <img src="<?php echo $this->config->item('admin_assets');?>images/address.png" width="18px"/>
          &nbsp;&nbsp;Address Evalution
        </a>
        <a href="<?php echo adminurl('Zones');?>" <?php if($uri=='Zones'){echo 'class="active"';}?>>
          <img src="<?php echo $this->config->item('admin_assets');?>images/zones.png" width="18px"/>
          &nbsp;&nbsp;Zones
        </a>
        <?php if($this->session->userdata("manage-resturant") == "1"){?>
        <a href="<?php echo adminurl('Resturant');?>" <?php if($uri=='Resturant'){echo 'class="active"';}?>>
          <img src="<?php echo $this->config->item('admin_assets');?>images/restuarants.png" width="18px"/>
          &nbsp;&nbsp;Resturant
        </a>
        <?php } ?>
        <a href="<?php echo adminurl('Drivers');?>" <?php if($uri=='Drivers'){echo 'class="active"';}?>>
          <img src="<?php echo $this->config->item('admin_assets');?>images/drivers.png" width="18px"/>
          &nbsp;&nbsp;Drivers
        </a>
        
      </div>
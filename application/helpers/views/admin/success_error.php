<?php  if($this->session->flashdata("err") != ""){?>
<div class="alert alert-outline-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="alert-icon">
     <i class="fa fa-times"></i>
    </div>
    <div class="alert-message">
      <span><strong><?php echo $this->session->flashdata("err");?></strong></span>
    </div>
</div>
<?php }  if($this->session->flashdata("suc") != ""){?>
<div class="alert alert-outline-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="alert-icon">
     <i class="fa fa-check"></i>
    </div>
    <div class="alert-message">
      <span><strong><?php echo $this->session->flashdata("suc");?></strong></span>
    </div>
</div>
<?php }  if($this->session->flashdata("war") != ""){?>
<div class="alert alert-outline-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="alert-icon">
     <i class="fa fa-exclamation-triangle"></i>
    </div>
    <div class="alert-message">
      <span><strong><?php echo $this->session->flashdata("war");?></strong></span>
    </div>
</div>
<?php }  if($this->session->flashdata("info") != ""){?>
<div class="alert alert-outline-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="alert-icon">
     <i class="fa fa-bell-o"></i>
    </div>
    <div class="alert-message">
      <span><strong><?php echo $this->session->flashdata("info");?></strong></span>
    </div>
</div>
<?php }?>
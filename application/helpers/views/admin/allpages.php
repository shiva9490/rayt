<div class="row pt-2 pb-2">
   <div class="col-sm-12">
      <h4 class="page-title"><?php echo $title;?></h4>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo adminurl("Dashboard");?>">Home</a></li>
         <?php echo $vitil;?>
         <li class="breadcrumb-item active" aria-current="page"><?php echo $title;?></li>
      </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
          <div class="card-header">View <?php echo $title;?></div>
         <div class="card-body">
             <?php $this->load->view("admin/search");?>
         </div>
      </div>
   </div>
</div>
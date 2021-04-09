<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $this->config->item('admin_assets');?>css/bootstrap.min.css">
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">-->
<link rel="stylesheet" href="<?php echo $this->config->item('admin_assets');?>custom/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-mdc-2 p-0 side">
      <?php $this->load->view('admin/sidebar');?>
    </div>
    <div class="col-md-10 p-0" id="main_content">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()" id="menu">&#9776; Menu</span>
        <?php $this->load->view($content);?>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo $this->config->item('admin_assets');?>custom/script.js"></script>
<script>
searchFilter('','<?php echo ($urlvalue)??'';?>');
</script>
</body>
</html> 

                

<?php  if($this->session->flashdata("suc") != ""){?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span>
          <b> Success - </b> <?php echo $this->session->flashdata("suc");?></span>
     </div>
<?php }  if($this->session->flashdata("err") != ""){?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span>
          <b> Error - </b> <?php echo $this->session->flashdata("err");?></span>
     </div>
<?php } ?>
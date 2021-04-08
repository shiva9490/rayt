<div class="modal-header">
    <h4 class="modal-title" id="largeModalLabel">Message</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <form class="validstudeheck" novalidate="" method="post">
        <div class="row">
            <?php if(count($view) > "0"){?>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Message <span class="text-danger">*</span></label>
                    <input type="hidden" name="studentid" value="<?php echo $studentid;?>"/>
                    <textarea class="form-control" required="" placeholder="Message" name="message"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn-primary sendmesh  btnbal" name="submit" value="submit"> Send Message</button>
                </div>
            </div>
            <?php  } else { ?>
            <div class="col-sm-12 text-center">
                <div class="iconsvalue">
                    <i class="fas fa-coins"></i>
                    <span><?php echo $coins;?></span>
                </div>
                <div class="text-success">
                    <p>No Coins are available</p>
                    <a class="btn-success mt-3 btnbal" href="<?php echo base_url("/Buy-Coins");?>">Buy Coins</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </form>  
</div>
<script>
    validdfromInti();
</script>
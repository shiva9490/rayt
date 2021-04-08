<div class="modal-header">
    <h4 class="modal-title" id="largeModalLabel">Whatsappp (or) Contact</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="row">
        <?php  if(count($view) > "0"){ ?>
        <div class="col-sm-12">
            <?php if($cobna == "1") { ?>
                <div class="form-group">
                    <label class="text-success">Whatsapp </label>
                    <?php  if($view["register_iswhatsapp"] == "1") { ?>
                        <h4><?php echo $view["register_whatsapp"];?></h4>
                    <?php } else{ ?>
                        <h4>No Whatsapp number mentioned</h4>
                    <?php } ?>
                </div>
            <?php  if($cobna == "0") { ?>
                <div class="form-group">
                    <label class="text-success">Contact No. </label>
                    <h4><?php echo $view["register_mobile"];?></h4>
                </div>
                <?php }
            }
            ?>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="text-success">Details of requirements</label>
                <p><?php echo $view["student_requirements"];?></p>
            </div>
        </div>
        <?php } else { ?>
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
</div>
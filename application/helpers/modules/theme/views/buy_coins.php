<div class="breadcrumbs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumbs-style1 sep1 posr">
                    <ul>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url();?>" title="Return to home">Home</a>
                            </div>
                        </li>
                        <li>/ <?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <aside class="single-aside pb-20">
                    <div class="aside-inner-wrapper">
                        <div class="aside-title aside-underline posr">
                            <h5>Buy Coins</h5>
                        </div>
                        <div class="aside-text">
                            <div class=""><?php $this->load->view("admin/success_error");?></div>
                            <div class="row">
                                <?php
                                if(count($view) > 0){
                                    foreach ($view as $ve){
                                        ?>
                                <div class="col-sm-3">
                                    <div class="card cardcoind mb-10 text-center">
                                        <form method="post">
                                            <div class="iconsvalue">
                                                <i class="fas fa-coins"></i>
                                                <span><?php echo $ve->package_coins;?></span>
                                            </div>
                                            <div class="text-success">
                                                    <?php echo $ve->package_name;?>
                                            </div>
                                            <div class="proceveal">
                                                <i class="fa fa-inr"></i> &nbsp;<?php echo $ve->package_price;?>
                                            </div>
                                            <input type="hidden" name="packageamount" value="<?php echo $ve->package_price;?>"/>
                                            <input type="hidden" name="packageid" value="<?php echo $ve->package_id;?>"/>
                                            <div class="form-group">
                                                <button type="submit" class="btn-success  btnbal" name="submit" value="submit"> Buy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
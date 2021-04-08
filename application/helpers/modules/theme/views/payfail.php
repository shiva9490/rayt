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
                        <li>/</li>
                        <li>
                            <div class="breadcrumbs-icon1">
                                <a href="<?php echo base_url('My-Profile');?>" title="Dashboard">Dashboard</a>
                            </div>
                        </li>
                        <li>/</li>
                        <li><?php echo $ctitle;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-10">
                <aside class="single-aside pb-20">
                    <div class="aside-inner-wrapper">
                        <div class="aside-title aside-underline posr">
                            <h5><?php echo $ctitle;?></h5>
                        </div>
                        <div class="aside-text text-center ">
                             <?php
                            if(isset($war)){
                                echo "<h4 class='text-danger mb-10'>".$war."</h4>";
                            }else{
                                echo "<h3 class='mb-10 text-danger'>Your order status is ". $status .".</h3>";
                                echo "<h4 class='mb-10'>Your transaction id for this transaction is ".$txnid.". <br/>"
                                    . "You may try making the payment by clicking the link below.</h4>";
                            }
                            ?>
                            <a href="<?php echo base_url();?>" class="text-success">
                                <i class="fa fa-home"></i> Home
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
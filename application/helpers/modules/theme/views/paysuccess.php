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
                                echo "<h3 class='mb-10 text-success'>Thank You for your payment.</h3>";
                                echo "<h3 class='mb-10'>Your order status is ". $status .".</h3>";
                                echo "<h4 class='mb-10'>Your Transaction ID for this transaction : ".$txnid.".</h4>";
                                echo "<h4 class='mb-10'>We have received a payment of Rs. " . $amount . ".</h4>";
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
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Package<i class="fa font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_coins" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Coins <i class="fa font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="package_price" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Price <i class="fa font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="trans_created_on" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Date<i class="fa font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="trans_transaction_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Transaction Id<i class="fa font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="trans_paystatus" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status<i class="fa font-14 fa-sort pull-right"></i></a> </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($view) > 0){
                foreach ($view as $ve){
                    ?>
            <tr>
                <td><?php echo $limit++;?></td>
                <td><?php echo $ve->package_name;?></td>
                <td><i class="fas fa-coins"></i>&nbsp;<?php echo $ve->package_coins;?></td>
                <td><i class="fa fa-inr"></i>&nbsp;<?php echo $ve->package_price;?></td>
                <td><?php echo date("d-m-Y h:i A",strtotime($ve->trans_created_on));?></td>
                <td><?php echo $ve->trans_transaction_id;?></td>
                <td><?php echo $ve->trans_paystatus;?></td>
            </tr>
                    <?php
                }
            }else{
                ?>
            <tr>
                <td colspan="10" class="text-danger text-center"><i class="fa fa-info-circle"></i> No Transaction data are available</td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
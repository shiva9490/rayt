<div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="register_unique" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Profile<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="studentbalance_for" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">For<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="studentbalance_type" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Type<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="studentbalance_balance" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Coins<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="studentbalamce_by" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">By<i class="fas font-14 fa-sort pull-right"></i></a> </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($view) > 0){
                foreach ($view as $ve){
                    $una    =   $ve->register_unique;
                    $byt    =   $ve->studentbalance_by;
                    $typ    =   $ve->studentbalance_type;
                    $typc   =   ($typ == "Credit")?"text-danger":"text-success";
                    $rypc   =   ($typ == "Credit")?"<i class='fa fa-minus-circle'></i>":"<i class='fa fa-plus-circle'></i>";
                    ?>
            <tr class="<?php echo $typc;?>">
                <td><?php echo $limit++;?></td>
                <td>
                    <a href="<?php echo base_url('Tutor-Profile/'.$una);?>">
                        <?php echo $ve->register_name;?>
                    </a>
                </td>
                <td><?php echo $ve->studentbalance_for;?></td>
                <td><?php echo $rypc." &nbsp;".$typ;?></td>
                <td><?php echo $ve->studentbalance_balance;?></td>
                <td><?php echo ($byt == "Student")?"<label>Request</label>":$byt;?></td>
            </tr>
                    <?php
                }
            }else{
                ?>
            <tr>
                <td colspan="10" class="text-danger text-center"><i class="fa fa-info-circle"></i> No Profiles data are available</td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
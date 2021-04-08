<div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="tutorbalance_for" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">For<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="tutorbalance_for" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Type<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="tutorbalance_type" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Type<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="tutorbalance_balance" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Coins<i class="fas font-14 fa-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="tutorbalamce_by" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">By<i class="fas font-14 fa-sort pull-right"></i></a> </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(count($view) > 0){
                foreach ($view as $ve){
                    $una    =   $ve->student_unique;
                    $byt    =   $ve->tutorbalance_by;
                    $typ    =   $ve->tutorbalance_type;
                    $typc   =   ($typ == "Credit")?"text-danger":"text-success";
                    $rypc   =   ($typ == "Credit")?"<i class='fa fa-minus-circle'></i>":"<i class='fa fa-plus-circle'></i>";
                    ?>
            <tr class="<?php echo $typc;?>">
                <td><?php echo $limit++;?></td>
                <td>
                    <?php if($una != "") { ?>
                    <a href="<?php echo base_url('Teaching-Profile/'.$una);?>">
                        <?php echo $ve->student_title;?>
                    </a>
                    <?php } else {
                        
                    } ?>
                </td>
                <td><?php echo $ve->tutorbalance_for;?>
                <td><?php echo $rypc." &nbsp;".$typ;?></td>
                <td><?php echo $ve->tutorbalance_balance;?></td>
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
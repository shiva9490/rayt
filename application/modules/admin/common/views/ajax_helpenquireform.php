<div class="table-responsive mt-4"> 
    <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_branch_name" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Resturant Branch<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_email" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Resturant Email<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="helpdesk_ques_cat" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Enquire About<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="helpdesk_ques_subcat" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Enquire For <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_enquire_details" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Enquire Details<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="resturant_enquire_image" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Image<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="enquire_created_on" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Enquire Date<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="" urlvalue="<?php echo adminurl('viewHelpenquireform/');?>" onclick="getdatafiled($(this))">Respond<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
              
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){                   
            ?>
            <tr>
                <td><?php echo $limit++;?></td>
                <td><?php echo $ve->resturant_branch_name; ?></td>
                <td><?php echo $ve->resturant_email; ?></td>
                <td><?php echo $ve->helpdesk_ques_cat; ?></td>
                <td><?php echo $ve->helpdesk_ques_subcat;?></td>
                <td><?php echo $ve->resturant_enquire_details;?></td>              
                <td><img src="<?php echo base_url();?>upload/helpdesk/<?php echo $ve->resturant_enquire_image;?>" width="100px" /></td>
                <td><?php echo date("d-m-Y h:i:sa",strtotime($ve->enquire_created_on));?>  </td>
                <td></td>
                <?php }  ?>
            </tr>
                <?php
                }
            else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Enquire are not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div> 
<?php echo $this->ajax_pagination->create_links();?>
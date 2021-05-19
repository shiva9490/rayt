<?php
$sr     =   $this->session->userdata("active-deactive-customers");
$cr     =   $this->session->userdata("create-customers");
$ur     =   $this->session->userdata("update-customers");
$dr     =   $this->session->userdata("delete-customers");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_id" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Customers Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_name" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Customers Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_email_id" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Email<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_mobile" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="customer_status" urlvalue="<?php echo adminurl('viewCustomers/');?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){ 
                foreach($view as $ve){
                    $vad    =   ucwords($ve->customer_abc);
                    if($vad == "Active"){
                        $icon   =   "times-circle";
                        $vadv   =   "Deactive";
                        $textico    =   "text-warning";
                        $vdata  =   "<label class='badge abelsctive badge-success'>Active</label>";
                    }else{
                        $vdata  =   "<label class='badge abelsctive badge-danger'>Deactive</label>";
                        $vadv   =   "Active";
                        $textico    =   "text-primary";
                        $icon   =   "check-circle";
                    }
            ?>
            <tr>
                <td><?php echo $limit++;?></td>
                <td class="fonn"><?php echo $ve->customer_id;?></td>
                <td><?php echo $ve->customer_name;?></td>
                <td><?php echo $ve->customer_email_id;?></td>
                <td><?php echo $ve->customer_mobile;?></td>
                <td><?php echo $vdata;?></td>
                <?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Customers-Active')" fields="<?php echo $ve->customer_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </a>
                    <?php }  if($ur == '1'){?>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Customers')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Customers/".$ve->customer_id);?>" data-original-title="Delete country" class="text-danger">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
					</a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="5"><i class="zmdi zmdi-info-outline"></i> Customers are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>
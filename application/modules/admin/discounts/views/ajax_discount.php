<?php
$sr     =   $this->session->userdata("active-deactive-discount");
$cr     =   $this->session->userdata("create-discount");
$ur     =   $this->session->userdata("update-discount");
$dr     =   $this->session->userdata("delete-discount");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1){
        $ct     =   1;
}
?>

<div class="col-md-12 mt-5 t_div">
    <table class="table b-g">
        <thead>
            <tr id="filters">
                <th>S.No</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="discount_discount" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Description<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="discount_date_from" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> From 
                    <i class="zmdi font-14 zmdi-sort pull-right"></i></a> 
                </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="discount_date_to" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> To 
                    <i class="zmdi font-14 zmdi-sort pull-right"></i></a> 
                </th>
                <th> Time Slot </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="discount_approve" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Approval <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="discount_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){
                foreach($view as $ve){
                    $vad    =   ucwords($ve->discount_abc);
                    if($vad == "Active"){
                        $icon   =   "times-circle";
                        $vadv   =   "Deactive";
                        $textico    =   "text-warning";
                        $vdata  =   "<label class='badge abelsctive badge-success'>".$vad."</label>";
                    }else{
                        $vdata  =   "<label class='badge abelsctive badge-danger'>".$vad."</label>";
                        $vadv   =   "Active";
                        $textico    =   "text-primary";
                        $icon   =   "check-circle";
                    }
            ?>
            <tr>
                <td><?php echo $limit++;?></td>
                <td class="fonn">
                    <?php 
                        echo $ve->discount_discount; 
                        if($ve->discount_type == 'Percentage'){echo '%  off on Orders Above '.$ve->discount_min_value;}else
                        if($ve->discount_type == 'Amount'){echo 'KD  off on Orders Above '.$ve->discount_min_value;}
                    ?>
                </td>
                <td>
                <?php $date=date_create($ve->discount_date_from);
                        echo date_format($date,"d/m/Y");
                        $time1 = date('g:i A',strtotime($ve->discount_time_from));
                       
                ?>
                </td>
                <td>
                <?php $date=date_create($ve->discount_date_to);
                        echo date_format($date,"d/m/Y");
                        $time2 = date('g:i A',strtotime($ve->discount_time_to));
                        
                ?>
                </td>
                <td><?php echo $time1.' to '.$time2;?> </td>
                <td>
                    <select id="discStatusUpdate<?php echo $ve->discount_id;?>" class="form-control" onchange="discStatusUpdatee($(this))"  fields="<?php echo $ve->discount_id;?>">
                        <option value="">Select Status</option>
                        <option value="Pending" <?php if($ve->discount_approve=="Pending"){echo 'selected';}?>>Pending</option>
                        <option value="Approve" <?php if($ve->discount_approve=="Approve"){echo 'selected';}?>>Approve</option>
                        <option value="Reject" <?php if($ve->discount_approve=="Reject"){echo 'selected';}?>>Reject</option>
                    </select>
                </td>
                <td><?php echo $vdata;?></td>
				<?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="partneractiveform($(this),'Ajax-Discount-Active')" fields="<?php echo $ve->discount_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </a>
                    <?php }  if($sr == '1'){?>
                    <a href='<?php echo partnerurl("Update-Discount/".$ve->discount_id);?>' data-toggle='tooltip' title="Update Discount" class="text-success tip-left">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Discount')" data-toggle='tooltip' attrvalue="<?php echo partnerurl("Delete-Discount/".$ve->discount_id);?>" data-original-title="Delete country" class="text-danger">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
					</a>
                    <?php }  ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Discounts are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>
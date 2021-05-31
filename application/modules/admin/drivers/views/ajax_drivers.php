<?php
$sr     =   $this->session->userdata("active-deactive-driver");
$cr     =   $this->session->userdata("create-driver");
$ur     =   $this->session->userdata("update-driver");
$dr     =   $this->session->userdata("delete-driver");
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
                <th><a href="javascript:void(0);" data-type="order" data-field="driver_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">driver Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="driver_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Driver Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th><a href="javascript:void(0);" data-type="order" data-field="driver_phone" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Email</th>   
                <th>Address </th>
                <th>Login Details</th>
                <th><a href="javascript:void(0);" data-type="order" data-field="driver_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            if(count($view) > 0){
                foreach($view as $ve){
                    $vad    =   ucwords($ve->driver_status);
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
                    <a href="<?php echo adminurl("Driver-Details/".$ve->driver_id);?>">
                        <span id="paragraph-copy<?php echo $ve->driver_id;?>" style="color:blue"><?php echo $ve->driver_id;?></span>
                    </a>
                    <a class="copy<?php echo $ve->driver_id;?>" href="javascript:;" data-clipboard-action="copy" data-tap<?php echo $ve->driver_id;?>="<?php echo $ve->driver_id;?>" data-clipboard-target="#paragraph-copy<?php echo $ve->driver_id;?>" onclick="copy('<?php echo $ve->driver_id;?>');">
                        <i class="far fa-clone" aria-hidden="true"></i>
                    </a>
                </td>
                <td><a href="#"><?php echo $ve->driver_name;?></a></td>
                <td><?php echo $ve->driver_phone;?></td>
                <td><?php echo $ve->driver_email;?></td>
                <td><?php echo $ve->driver_address;?></td>
                <td><?php echo 'User Id : '.$ve->driver_login_username.'<br>Password : '.$ve->driver_login_password;?></td>
                <td><?php echo $vdata;?></td>
				<?php if($ct == '1'){?>
                <td> 
                    <?php if($sr == '1'){?>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Driver-Active')" fields="<?php echo $ve->driver_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </a>
                    <?php }  if($ur == '1'){?>
                         <a href='<?php echo adminurl("Update-Driver/".$ve->driver_id);?>' data-toggle='tooltip' data-original-title="Update Driver" class="text-success tip-left">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                        
                        <a href='<?php echo adminurl("Update-Driver-Document/".$ve->driver_id);?>' data-toggle='tooltip' data-original-title="Update Driver" class="text-success tip-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                        </a>
                    <?php } if($dr == '1'){?>
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Driver')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Driver/".$ve->driver_id);?>" data-original-title="Delete driver" class="text-danger">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
					</a>
                    <?php } ?>
                </td>
                <?php }  ?>
            </tr>
                <?php
                }
            }else {
                echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Drivers are  not available</td></tr>';
            }
            ?>
        </tbody>
    </table>
  </div> 
  <?php //echo $this->ajax_pagination->create_links();?>
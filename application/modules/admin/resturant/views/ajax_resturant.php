<?php
$sr     =   $this->session->userdata("active-deactive-resturant");
$cr     =   $this->session->userdata("create-resturant");
$ur     =   $this->session->userdata("update-resturant");
$dr     =   $this->session->userdata("delete-resturant");
$drs     =   $this->session->userdata("menu-edit-resturant");
$ct     =   "0";
if($ur  == 1 || $dr == '1' || $sr == 1 || $drs == 1){
        $ct     =   1;
}
?>
<div class="col-md-12  t_div">
    <div class="table-responsive">
        <table class="table b-g">
            <thead>
                <tr id="filters">
                    <th>S.No</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="resturant_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Restaurant Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="resturant_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Restaurant Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <th>Address </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="resturant_contact_no" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <!--<th>Menu Hours (closed)</th>-->
                    <th>Login Details</th>
                    <th>Total Branches</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="resturant_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){
                    foreach($view as $ve){
                        $vad    =   ucwords($ve->resturant_status);
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
                    <td class="fonn"><?php echo $ve->restraint_login_username;?><i class="fa fa-clone" aria-hidden="true"></i></td>
                    <td><a href="#"><?php echo $ve->resturant_name;?></a></td>
                    <td><?php echo $ve->resturant_area.','.$ve->resturant_block.','.$ve->resturant_street.','.$ve->resturant_jaada.','.$ve->resturant_house.','.$ve->resturant_building;?></td>
                    <td><?php echo $ve->resturant_contact_no;?></td>
                    <!--<td><?php echo $ve->resturant_menu_hours;?></td>-->
                    <td><?php echo $ve->restraint_login_username.'<br>'.$ve->restraint_login_password;;?></td>
                    <td>1</td>
                    <td><?php echo $vdata;?></td>
    				<?php if($ct == '1'){?>
                    <td> 
                        
                        <div class="dropdown custom-dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                <?php if($sr == '1'){?>
                                <a class="<?php echo $textico;?> dropdown-item" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Resturant-Active')" fields="<?php echo $ve->resturant_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                    Actice/Inactive
                                </a>
                                <?php } if($drs == '1'){?>
                                <a href='<?php echo adminurl("Menus/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Resturant Menus" class="text-success tip-left dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                    <span>Menus</span>
                                </a>
                                <?php }  if($ur == '1'){?>
                                <a href='<?php echo adminurl("Update-Resturant/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Update Resturant" class="text-success tip-left dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    Edit
                                </a>
                                <a href='<?php echo adminurl("Update-Resturant-Document/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Update Resturant" class="text-success tip-left dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                    Resturant-Document
                                </a>
                                <?php } if($dr == '1'){?>
                                <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Resturant')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Resturant/".$ve->resturant_id);?>" data-original-title="Delete country" class="text-danger dropdown-item">
            						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            					    Delete
            					</a>
                                <?php }  ?>
                            </div>
                        </div>
                        <!--
                        <?php if($sr == '1'){?>
                        <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Ajax-Resturant-Active')" fields="<?php echo $ve->resturant_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </a>
                        <?php }  if($ur == '1'){?>
                        <a href='<?php echo adminurl("Update-Resturant/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Update Resturant" class="text-success tip-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                        <a href='<?php echo adminurl("Update-Resturant-Document/".$ve->resturant_id);?>' data-toggle='tooltip' data-original-title="Update Resturant" class="text-success tip-left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                        </a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Resturant')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Resturant/".$ve->resturant_id);?>" data-original-title="Delete country" class="text-danger">
    						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
    					</a>
                        <?php }  ?>-->
                        
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Resturants are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>    
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>

<div class="col-md-12  t_div">
    <div class="table-responsive">
        <table class="table b-g">
            <thead>
                <tr id="filters">
                    <th>S.No</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="user_id" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">User Id <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="user_name" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">User Name <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>                  
                    <th><a href="javascript:void(0);" data-type="order" data-field="user_phone" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Phone No<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                       <th><a href="javascript:void(0);" data-type="order">Login Details<i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="user_status" urlvalue="<?php echo $urlvalue;?>" onclick="getdatafiled($(this))">Status <i class="zmdi font-14 zmdi-sort pull-right"></i></a> </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){
                    foreach($view as $ve){
                        $vad    =   ucwords($ve->user_status);
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
                    <td class="fonn"><?php echo $ve->user_id;?><i class="far fa-clone" aria-hidden="true"></i></td> 
                    <td><?php echo $ve->user_name;?></td>
                    <td><?php echo $ve->user_phone;?></td>
                      <td><?php echo $ve->user_name.'<br>'.$ve->login_password;;?></td>
                    <td><?php echo $vdata;?></td>    			
                    <td>
                    <a class="<?php echo $textico;?>" href="javascript:void(0);" onclick="activeform($(this),'Active-Deactive-Users')" fields="<?php echo $ve->user_id;?>" data-toggle='tooltip' title="<?php echo $vadv;?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-primary"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </a>
                   
                        <a href='<?php echo adminurl("Update-Users/".$ve->user_id);?>' data-toggle='tooltip' data-original-title="Update Users" class="text-success tip-left">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </a>
                  
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Users')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Users/".$ve->user_id);?>" data-original-title="Delete Users" class="text-danger">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
					</a>
                   
                </td>
                  
                </tr>
                    <?php
                   
                } }else {
                    echo '<tr class="text-center text-danger"><td colspan="9"><i class="zmdi zmdi-info-outline"></i> Users are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>    
  </div> 
  <?php echo $this->ajax_pagination->create_links();?>
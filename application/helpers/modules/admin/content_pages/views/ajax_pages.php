<?php
$cr     =   $this->session->userdata("create-role");
$ur     =   $this->session->userdata("update-role");
$dr     =   $this->session->userdata("delete-role");
$ct     =   "0";
if($ur  == 1 || $dr == '1'){
        $ct     =   1;
}
?>
<div class=" col-sm-12 col-md-12 col-lg-12 col-xs-12">
    <div class="table-responsive"> 
        <table class="table table-striped table-hover js-basic-example tablehrcover" id="myTable">
            <thead>
                <tr id="filters">
                    <th>S.No</th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="cpage_title" urlvalue="<?php echo bildourl('viewContent/');?>" onclick="getdatafiled($(this))">Page Title <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="content_from_name" urlvalue="<?php echo bildourl('viewContent/');?>" onclick="getdatafiled($(this))">Content <i class="fa fa-sort pull-right"></i></a> </th>
                    <th><a href="javascript:void(0);" data-type="order" data-field="layout_name" urlvalue="<?php echo bildourl('viewContent/');?>" onclick="getdatafiled($(this))">Layout <i class="fa fa-sort pull-right"></i></a> </th>
                    <th></th>
                    <?php if($ct == '1'){?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php  
                if(count($view) > 0){ 
                    foreach($view as $ve){
                ?>
                <tr>
                    <td><?php echo $limit++;?></td>
                    <td><?php echo $ve->cpage_title;?></td>
                    <td><?php echo $ve->content_from_name;?></td>
                    <td><?php echo $ve->layout_name;?></td>
                    <td>
                        <?php 
                            if($ve->cpage_show_menu == '1'){
                                echo "<label class='label label-info'>Menu</label>";
                            }
                        ?>
                    </td>
                    <?php if($ct == '1'){?>
                    <td>
                        <?php if($ur == '1'){?>
                        <a href='<?php echo bildourl("update-content-page/".$ve->cpage_id);?>' data-toggle='tooltip' title="Update Content Page" class="btn btn-sm btn-success tip-left"><i class="fa fa-edit"></i></a>
                        <?php } if($dr == '1'){?>
                        <a href="javascript:void(0)" onclick="confirmationDelete($(this),'Content Page')" attrvalue="<?php echo bildourl("delete-content-page/".$ve->cpage_id);?>"   title="Delete Content Page" class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </td>
                    <?php }  ?>
                </tr>
                    <?php
                    }
                }else {
                    echo '<tr class="text-center"><td colspan="5">Content Pages are  not available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>                        
    <?php echo $this->ajax_pagination->create_links();?>
</div>
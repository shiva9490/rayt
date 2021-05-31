<?php
    $parAddon['whereCondition']     = "ra.resturant_addon_temp_id = '".$tempid."'";
    $viewAddon = $this->menu_model->viewAddona($parAddon);
    if(is_array($viewAddon) && count($viewAddon) > 0){
        foreach($viewAddon as $add){
?>
    <div class="col-md-4">
        <blockquote class="blockquote media-object">
            <div class="note-inner-content">
                <div class="note-content">
                    <p class="note-title" data-noteTitle="Receive Package"><b><?php echo ($add->addon_name!="")?$add->addon_name:$add->resturant_customisation;;?></b></p>
                    <div class="note-description-content">
                        <?php
                            $parAddon['whereCondition']     = "ral.resturant_addon_id LIKE '".$add->resturant_addon_id."'";
                            $addpnlist = $this->menu_model->viewAddon($parAddon);
                            if(is_array($addpnlist) && count($addpnlist) > 0){
                                foreach($addpnlist as $addd){
                        ?>
                        <p class="note-description" data-noteDescription="<?php echo $addd->resturant_addonitem;?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <?php echo $addd->resturant_addonitem;?>
                                </div>
                                <div class="col-md-4">
                                   - <?php echo number_format((float)$addd->resturant_addonitem_amount, 3, '.', '');?>
                                </div>
                            </div>
                        </p>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="note-action">
                    <a href="javascript:void(0);" onclick="confirmationDelete($(this),'Delete Addons')" data-toggle='tooltip' attrvalue="<?php echo adminurl("Delete-Addon-List/".$add->resturant_addon_id);?>" data-original-title="Delete country" class="text-danger">
					    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </div>
            </div>
        </blockquote>
    </div>
<?php
        }
    }
 ?>
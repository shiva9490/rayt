<?php
class Discounts_model extends CI_Model{

public function status_update($uri,$status){
    $dat=array(
        "discount_approve"           => $status,
        "discount_md_by"             => $this->input->post("login_id"),
        "discount_md_on"             => date('Y-m-d H:i:s')
    );
    $this->db->where('discount_id',$uri)->update("discount",$dat);
    $vsp   =    $this->db->affected_rows();
    if($vsp > 0){
        return true;
    }
    return FALSE;
}

}
?>
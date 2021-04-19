<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! function_exists('sitedata')){ 
        function sitedata($uri){
                $CI =& get_instance();
                $vsp 	=	$CI->common_config->getsitevalue($uri);
                return $vsp['siteval'];
        }
}
if ( ! function_exists('adminurl')){ 
    function adminurl($uri){ 
        return base_url(sitedata("site_admin")."/".$uri);
    }
}if ( ! function_exists('partnerurl')){ 
    function partnerurl($uri){ 
        return base_url(sitedata("site_partner")."/".$uri);
    }
}  
if ( ! function_exists('contenturl')){ 
    function contenturl($uri){ 
        return base_url(sitedata("site_content")."/".$uri);
    }
}  
if ( ! function_exists('widget_path')){ 
        function widget_path(){
            $CI =& get_instance();
            $vsp1 	=	sitedata("widget_path");   
            return $vsp1; 
        }
}
if ( ! function_exists('include_widget')){ 
        function include_widget($filename){
            $CI =& get_instance();
            $parms['unique_widget']     =   $filename;
            $vsp          =   $CI->widget_model->query_widget($parms)->row_array();
            $tg           =   widget_path().'/'.$filename.'.php';
            if($vsp != "" && count($vsp) > 0){
                if(read_file($tg)){
                    include_once $tg;
                }else{
                    include_once $filename.'.php';
                }
            } 
        }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Map extends CI_Controller{
        public function __construct() {
                parent::__construct();
        }
        public function driverpoint(){
            $root = null;
            $par['columns']         =   "driver_address_latitude,driver_address_longitude";
            $par['whereCondition']  =   "d.driver_id LIKE '1DRIVER'";
            $par['tipoOrderby']     =   "driver_addressid";
            $par['order_by']        =   "DESC";
            $point  = $this->drivers_model->getDriverupdate($par);
            echo $this->api_model->jsonencodevalues("1",$point);
        }
}
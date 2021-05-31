<?php



/* 

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



class Common_config{

        public function getsitevalue($uri){

                $ci     =   &get_instance();

                $ci->load->database(); 

                $ci->db->select("$uri as siteval");

                return $ci->db->get_where("config_settings",array("id" => '1'))->row_array(); 

        }

        public function resclean($string) {

            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens

            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        }

        public function resmyclean($string) {

            $string = str_replace('[', '', $string);

            $string = str_replace(']', '', $string);

            $string = str_replace('"', '', $string);

            return $string;

        }

        public function cleanstr($string){

            $string = str_replace(' ', '-', $string);

            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

            return preg_replace('/-+/', '-', $string);

        }

        public function updateconfig($uri){

                $ci     =   &get_instance();

                $ci->load->database();

                $dta    =   array(

                    "site_name"             =>  $ci->input->post("site_name"),

                    "site_admin"            =>  $ci->input->post("site_address"),

                    "site_pagination"       =>  $ci->input->post("site_pagination"),

                    "site_host"             =>  $ci->input->post("site_host"),

                    "site_port"             =>  $ci->input->post("site_port"),

                    "site_email"            =>  $ci->input->post("site_email"),

                    "site_emailpassword"    =>  $ci->input->post("site_emailpassword"),

                    "site_modified_on"      =>  date("Y-m-d H:i:s")

                );

                if(count($_FILES) > 0){

                    if($_FILES["site_logo"]["name"] != "" && $_FILES["site_logo"]["name"] != "noname"){

                        $target_dir =   $ci->config->item("uploads_path")."/";

                        $fname      =   $_FILES["site_logo"]["name"];

                        $vsp        =   explode(".",$fname);

                        if(count($vsp) > 1){

                            $j          =   count($vsp)-1;

                            $fname      =   time().".".$vsp[$j];

                        }

                        $uploadfile     =   $target_dir . basename($fname);

                        move_uploaded_file($_FILES['site_logo']['tmp_name'], $uploadfile); 

                        $dta["site_logo"]    =   $fname;

                    }

                }

                $ci->db->update("config_settings",$dta,array("id" => $uri));

                if($ci->db->affected_rows() > 0){

                        return TRUE;

                }

                return FALSE;

        }

        public function getvalueImagesize($epic){

                $ci     =   &get_instance(); 

                $isms   =   $ci->config->item('admin_upload')."logo.png";

                $pic    =   $ci->config->item('admin_upload').$epic; 

                if(@getimagesize($pic)){

                    $isms   =   $pic;

                } 

                return $isms;

        }

        public function getallvalues($uri){

                $ci     =   &get_instance();

                $ci->load->database(); 

                $ci->db->select("*");

                return $ci->db->get_where("config_settings",array("id" => $uri))->row_array(); 

        }

        function dateDiff($time2, $precision = 6) {

            $time1  =   date("Y-m-d H:i:s");

            // If not numeric then convert texts to unix timestamps

            if (!is_int($time1)) {

              $time1 = strtotime($time1);

            }

            if (!is_int($time2)) {

              $time2 = strtotime($time2);

            }

        

            // If time1 is bigger than time2

            // Then swap time1 and time2

            if ($time1 > $time2) {

              $ttime = $time1;

              $time1 = $time2;

              $time2 = $ttime;

            }

        

            // Set up intervals and diffs arrays

            $intervals = array('year','month','day','hour','minute','second');

            $diffs = array();

        

            // Loop thru all intervals

            foreach ($intervals as $interval) {

              // Create temp time from time1 and interval

              $ttime = strtotime('+1 ' . $interval, $time1);

              // Set initial values

              $add = 1;

              $looped = 0;

              // Loop until temp time is smaller than time2

              while ($time2 >= $ttime) {

                // Create new temp time from time1 and interval

                $add++;

                $ttime = strtotime("+" . $add . " " . $interval, $time1);

                $looped++;

              }

         

              $time1 = strtotime("+" . $looped . " " . $interval, $time1);

              $diffs[$interval] = $looped;

            }

            

            $count = 0;

            $times = array();

            // Loop thru all diffs

            foreach ($diffs as $interval => $value) {

              // Break if we have needed precission

              if ($count >= $precision) {

                break;

              }

              // Add value and interval 

              // if value is bigger than 0

              if ($value > 0) {

                // Add s if value is not 1

                if ($value != 1) {

                  $interval .= "s";

                }

                // Add value and interval to times array

                $times[] = $value . " " . $interval;

                $count++;

              }

            }

        

            // Return string with times

            return $times["0"];//implode(", ", $times);

          }

        public function configemail($toemail,$subject,$message){
            $ci     =   &get_instance();  
            $ci->load->library("email"); 
            $fromemail  =   sitedata("site_email");
            $config     =   array(
                    'protocol'    =>  'smtp', 
                    'smtp_user'   =>  $fromemail,
                    'smtp_host'   =>  sitedata("site_host"),
                    'smtp_pass'   =>  sitedata("site_emailpassword"),
                    'smtp_port'   =>  '465', 
                    'wordwrap'    =>   TRUE,
                    'mailtype'    =>   'html'
                ); 
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers    .= 'From: ' .$fromemail. "\r\n";
            $toemail    =   $toemail;
            $mail       =   mail($toemail,$subject,$message,$headers);
            if($mail){
                return true;
            }
            return false;

        }

        public function sendmessagemobile($phone_number,$message_string) {  

            $url 	=   "http://login.rock2connect.com/MOBILE_APPS_API/sms_api.php?type=smsquicksend&user=".sitedata("site_username")

                    . "&pass=".sitedata("site_userpassword")

                    . "&sender=".sitedata("site_usersender")

                    . "&to_mobileno=".$phone_number."&sms_text=".($message_string);

            $ulr    =   ($url);

            $ch     =   curl_init();

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

            curl_setopt($ch, CURLOPT_URL, $ulr);

            $result = curl_exec($ch); 

            curl_close($ch);

            $obj 	= (array)json_decode($result); 

            $ci     =   &get_instance();

            $ci->load->database();   

            $data    =   array( 

                "sms_to"            =>  $phone_number,

                "sms_content"       =>  urldecode($message_string),

                "sms_sent_time"     =>  date("Y-m-d H:i:s"),

                "sms_response"      =>  $result

            );

            $ci->db->insert('sms_log',$data);

            $vsdp    =   $ci->db->insert_id();   

            if(is_array($obj) && count($obj) > 0){

                if($obj['status_id'] == "success_1002"){ 

                    $ci->db->update("sms_log",array("sms_sent" => "1"),array("smsid" => $vsdp));  

                    return TRUE; 

                }

            } 

            return FALSE;

        }

        public function getString($n){ 

                $characters 	= 	'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 

                $randomString 	= 	''; 

                for ($i = 0; $i < $n; $i++) { 

                        $index = rand(0, strlen($characters) - 1); 

                        $randomString .= $characters[$index]; 

                } 

                return $randomString;  		

        }
        function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
            $theta = $longitude1 - $longitude2; 
            $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
            $distance = acos($distance); 
            $distance = rad2deg($distance); 
            $distance = $distance * 60 * 1.1515; 
            switch($unit){
                case 'miles': 
                  break; 
                case 'kilometers' : 
                  $distance = $distance * 1.609344; 
            }
            return (round($distance,2)); 
        }
        
        function GetDrivingDistance($lat1, $lat2, $long1, $long2){
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en-EN&sensor=false&key=AIzaSyBe-HPCsy9e136sYKeO549pu3Zj8GytkXI";
            
            //print_r($url);exit;
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response_a = json_decode($response, true);
            //print_r($response_a['rows'][0]['elements'][0]['status']);exit;
            $response_as ="";
            if($response_a['rows'][0]['elements'][0]['status'] =="OK"){
                $response_as = array(
                                'distance'  => $response_a['rows'][0]['elements'][0]['distance']['text'],
                                'time'      => $response_a['rows'][0]['elements'][0]['duration']['text']
                            );
            }
            return $response_as;
        }
        function clean($string) {
           $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
           $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        
           return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        }
        
         public function send_pushnotifications($title,$message,$mobileno = 0){
        $ci     =   &get_instance();
        $ci->load->database(); 
        $tokens		=	$ci->db->get_where("tokens",array("token_open" => '1'))->result(); 
        if($mobileno != '0'){
            $tokens		=	$ci->db->get_where("tokens",array("token_open" => '1',"token_mobile" => $mobileno))->result();
        }
        if(count($tokens) > 0){
            $offset =   0; 
            while($offset <= count($tokens)){
                $dtokens		=	$ci->db->get_where("tokens",array("token_open" => '1'), '1000', $offset)->result();
                if($mobileno != '0'){
                    $dtokens		=	$ci->db->get_where("tokens",array("token_open" => '1',"token_mobile" => $mobileno))->result();
                } 
                 //echo "<pre>";print_r($dtokens);exit;
                $d_name     = array();
                foreach($dtokens as $tu){
                    $d_name[]	=	$tu->token_name;
                }
                $url        =   'https://fcm.googleapis.com/fcm/send';
                $priority   =   "high";
                $notification   = array('title' => $title,'body' => $message);
                $fields = array(
                        'registration_ids'  => $d_name,
                        'notification'      => $notification 
                );
                $headers = array(
                    'Authorization:key=AAAA_Zgkrek:APA91bH2u9jTxJnTzJPgw_nns-RGNMzSgvJU0mkuJHZuRjJteqAYdkQy7UueJvG-AxGJeZmG0aVfdvSH-11bkH1TP6gPAhpRe3uA5Y5OXYNWILUapRbBFtx8FZZgfZYFzI5DUyqx3GHP',
                    'Content-Type: application/json'
                ); 
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_POST, true);
               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                // echo json_encode($fields);
               $result = curl_exec($ch);    
                if ($result === FALSE) {
                   die('Curl failed: ' . curl_error($ch));
                }
                $vspr    =   json_decode($result,true);
                $res = array();
                $res['registration_ids'] = $title;
                $res['notification']     = $message;
                $res['responce']         = $result;
                $res['token']            = $mobileno;
                $res['date_time']        = date('Y-m-d H:i:s a');
                $ci->db->insert('notification',$res);
                $vrfg =  array();
                if(count($vspr) > 0){
                    $vsfr =  $vspr['results'];
                    foreach($vsfr as $key => $byh){
                        if(array_key_exists("error",$byh)){
                            if($byh['error'] == 'NotRegistered'){
                                array_push($vrfg,$key);
                            }
                        }
                    }
                    foreach($d_name as $keu =>  $dtu){
                        if(in_array($keu,$vrfg)){
                            $ci->db->update("tokens",array("token_open" => '0',"token_update" => date("Y-m-d H:i:s")),array("token_name" => $dtu));
                        }
                    }
                }
                curl_close($ch); 
                $offset =    $offset+1000; 
            } 
            return $result;
        }
    }
}
<?php 

        $extraMerchantsData = array(
            'amounts' => array(10,20),
            'charges' => array(1,5),
            'chargeType' => array('percentage','percentage'),
            'cc_charges' => array(1,5),
            'cc_chargeType' => array('percentage','percentage'),
            'ibans' => array('iban_number_of_vendor_1','iban_number_of_vendor_2')
        );
	    
	    $fields = array(
            'merchant_id'=>'1201',
             'username' => 'test',
            'password'=>stripslashes('test'), 'api_key'=>'jtest123', // in sandbox request
             //'api_key' =>password_hash('API_KEY',PASSWORD_BCRYPT), //In production mode, please pass
            //API_KEY with BCRYPT function
            'order_id'=>time(), // MIN 30 characters with strong unique function (like hashing function with time)
            'total_price'=>'10',
            'CurrencyCode'=>'KWD',//only works in production mode
            'CstFName'=>'Test Name',
            'CstEmail'=>'test@test.com',
            'CstMobile'=>'12345678',
            'success_url'=> base_url().'.success.html',
            'error_url'=> base_url().'error.html',
            'test_mode'=>1, // test mode enabled
            'whitelabled'=>true, // only accept in live credentials (it will not work in test)
            'payment_gateway'=>'knet',// only works in production mode
            'ProductName'=>json_encode(['computer','television']),
            'ProductQty'=>json_encode([2,1]),
            'ProductPrice'=>json_encode([150,1500]),
            'reference'=>'Ref00001', // Reference that you want to show in invoice in ref column
            'ExtraMerchantsData'=>json_encode($extraMerchantsData)
        );
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.upayments.com/test-payment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output,true);
        ?>
        <script>
        window.location.href= <?php $server_output['paymentURL']; ?> // javascript
        </script>
        <?php 
        header('Location:'.$server_output['paymentURL']); // PHP
?>
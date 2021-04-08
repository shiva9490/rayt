<?php
$SALT           =   $this->config->item("saltkey");
$PAYU_BASE_URL  =   $this->config->item("payubaseurl");
$action = '';
$posted = array();
if(!empty($_POST)) {
    foreach($_POST as $key => $value) {    
        $posted[$key] = $value; 
    }
}
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
    foreach($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash       =   strtolower(hash('sha512', $hash_string));
    $action     =   $PAYU_BASE_URL . '/_payment';
} elseif(!empty($posted['hash'])) {
    $hash   = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
        payuForm.submit();
    }
  </script>
    </head>
    <body onload="submitPayuForm()">
        <div  style="margin-top: 10rem;text-align: center;">
            <i class="fas fa-4x fa-spinner text-success fa-spin"></i>
            <br/><br/>
            <h4>Please wait payment is going on.............</h4>
        </div>
        <form action="<?php echo $action; ?>" method="post" name="payuForm">
            <input name="amount" type="hidden" value="<?php echo $pkgpackage_price;?>" />
            <input name="firstname" type="text" id="firstname" value="<?php echo $register_name;?>" />
            <input name="email" id="email" type="text" value="<?php echo $register_email;?>" />
            <input name="phone" type="hidden" value="<?php echo $register_mobile;?>" />
            <input type="text" name="key" type="hidden" value="<?php echo $merch ?>" />
            <input type="text" name="hash" type="hidden" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" type="hidden" value="<?php echo $txnid ?>" />
            <textarea name="productinfo"><?php echo $pkgin;?></textarea>
            <input name="surl" type="text" value="<?php echo $surl?>" size="64" />
            <input name="furl" type="text" value="<?php echo $furl?>" size="64" />
            <input type="text" name="service_provider" value="<?php echo $payu_paisa;?>" size="64" />
        </form>
    </body>
</html>
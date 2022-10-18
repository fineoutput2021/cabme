<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Processing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
  <style>
  .loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #d92c2f; /* Blue */
  border-radius: 50%;
  width: 100px;
  height: 100px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  </style>
  <div style="display: flex;
    justify-content: center;
  margin-top: 20%;">
<div class="loader"></div>
</div>
  <form action="<?php echo $action; ?>/_payment" method="post" id="payuForm" name="payuForm">
    <input type="hidden" name="key" value="<?php echo $mkey; ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash; ?>" />
    <input type="hidden" name="txnid" value="<?php echo $tid; ?>" />
    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $name; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $mailid; ?>" />
    <input type="hidden" name="phone" value="<?php echo $phoneno; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />
    <input type="hidden" name="address1" value="<?php echo $address; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $productinfo; ?>" />
    <input type="hidden" name="surl" value="<?php echo $sucess; ?>" size="64" type="hidden" />
    <input type="hidden" name="furl" value="<?php echo $failure; ?>" size="64" type="hidden" />
    <!--for test environment comment  service provider   -->
    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
    <input type="hidden" name="curl" value="<?php echo $cancel; ?> " type="hidden" />
  </form>
</body>
<script>
window.onload = function(){
document.forms['payuForm'].submit();
}
</script>
</html>

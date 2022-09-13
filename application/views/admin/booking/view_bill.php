<!DOCTYPE html>
<html>
<html lang="en">
<input type="hidden" value="<?php if(!empty($order1_data)){ echo $order1_data->final_amount; }?>" id="tot_amnt">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!-- Css file include -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/frontend/css/style.css">
<link rel="shortcut icon" href="<?=base_url()?>assets/logo.png" type="image/x-icon" />

	<title>Tiara Bill</title>
</head>
<body style="padding-top:75px;">
<div class="container main_container">
	<div class="row">
		<div class="col-sm-6 oswal_logo">
		<img src="<?=base_url()?>assets/logo.png" class="img-fluid" style="width:150px;">
		</div>
		<div class="col-sm-6 content_part">Tax Invoice/Bill of Supply/Cash Memo
			<p>(Original for Recipient)</p>
		</div>
	</div><br>

<div class="container">
	<div class="row">
		<div class="col-sm-6"><span class="font-weight-bold ">Sold By</span><br>
<span class="seller_details">Tiara  <br>

Rajasthan<br>India
<br><br>
		www.tiara.com<br></span>
		</div>

		<div class="col-sm-6 billing_content"><span class="font-weight-bold ">Billing Address:</span><br>
      <!-- code here -->
<?php
if(!empty($order1_data->user_id)){
$this->db->select('*');
$this->db->from('tbl_users');
$this->db->where('id',$order1_data->user_id);
$users_data= $this->db->get()->row();
if(!empty($users_data)){
  $user_name= $users_data->f_name." ".$users_data->l_name;
  $user_contact= $order1_data->phone;
}else{
  $user_name="";
  $user_contact="";
}
}else{
  $this->db->select('*');
  $this->db->from('tbl_reseller');
  $this->db->where('id',$order1_data->reseller_id);
  $users_data= $this->db->get()->row();
  if(!empty($users_data)){
    $user_name= $users_data->name;
    $user_contact= $order1_data->phone;
  }else{
    $user_name="";
    $user_contact="";
  }
}
?>


User Name: <?=$user_name;?>
<!-- <br />Address Name: <?=$order1_data->name;?> -->
<!-- <br>Email: <?=$order1_data->email;?> -->
<br>Contact: <?=$user_contact;?><br>


      <?php
  if(!empty($order1_data)){


    $name=$order1_data->name;
    $phone=$order1_data->phone;
    $pincode=$order1_data->pincode;
    $email=$order1_data->email;
    $address=$order1_data->address;
    $city=$order1_data->city;


  }

      ?>

		</div>
	</div>

<br>
<div class="row">
	<div class="col-sm-6"></div>
<div class="col-sm-6 shipping_content"><span class="font-weight-bold ">Shipping Address:</span>	<br>
Name:<?php

if(!empty($name)){
  echo $name;
}else{
  echo "No Name Found";
}
?> <br>
Phone:<?php

if(!empty($phone)){
  echo $phone;
}else{
  echo "no phone number";
}
?> <br>

Pincode: <?php echo $pincode;?><br>

Email:<?php
if(!empty($email)){
  echo $email;
}else{
  echo "no email";
}
?> <br>

Address: <?php


if(!empty($address)){
  echo $address;
}else{
  echo "no address";
}
?> <br>

State: <?
            $this->db->select('*');
$this->db->from('all_states');
$this->db->where('id',$order1_data->state);
$state= $this->db->get()->row();
if(!empty($state)){
echo $state->state_name;}
else{
  echo"";
}?><br>

City:<?php
if(!empty($city)){
  echo $city;
}else{
  echo "";
}
?> <br>
</div>
</div>
<div class="row">
	<div class="col-sm-6">Order No: &nbsp; <?php if(!empty($order1_data)){ echo $order1_data->id; }?><br>
<p> Order Date:  &nbsp;
   <?php if(!empty($order1_data)){
  $source = $order1_data->date;
     $date = new DateTime($source);
     echo $date->format('F j, Y, g:i a');
  }?>
	<div><br> <br>




</div>
</div>

<div class="container">
  <table class="table table-black">
    <thead class="product_table">

      <tr>
        <th>SNo.</th>
        <th>Description</th>
        <th>HSN Code</th>
        <!-- <th>Type</th> -->
        <!-- <th>Unit Name</th> -->
        <th>Unit Price</th>
        <th>Discount</th>
        <th>Qty</th>
        <th>Net Amount</th>
        <!-- <th>GST(%)</th> -->
        <th>Tax Rate</th>
        <th>Tax Type</th>
        <th>Tax Amount</th>
        <th>Total Amount</th>

    </thead>
    <tbody>
  <?php
  $total_weight = 0;
  $total_gst_percentt = 0;
  $total_gst_pricee = 0;
if(!empty($order2_data)){
  $i=1; foreach($order2_data->result() as $data) {
    // print_r($data);die();
    $this->db->select('*');
$this->db->from('tbl_product');
$this->db->where('id',$data->product_id);
$product_data= $this->db->get()->row();
    ?>
      <tr class="product_table2">
       <td><?php echo $i;?></td>
        <td><?php

if(!empty($product_data)){
echo $product_name= $product_data->name;
// echo $hsn_code= $product_data->hsn_code;
}else{
  $product_name= "";
  // $hsn_code="";
}

        ?></td>
        <td><?php

if(!empty($product_data)){
echo $hsn_code= $product_data->hsn_code;
// echo $hsn_code= $product_data->hsn_code;
}else{
  $hsn_code= "";
  // $hsn_code="";
}

        ?></td>
<!-- <td>
<?//typename
              $this->db->select('*');
  $this->db->from('tbl_type');
  $this->db->where('id', $data->type_id);
  $type = $this->db->get()->row();
  if(!empty($type)){
    echo $type->name;
  }else{
    echo"";
  }
 ?>
</td> -->
    <!-- <td ><?php if(!empty($product_data)){echo "".$type->mrp;} ?></td> -->

        <td ><?php if(!empty($type)){echo "₹".$type->mrp;} ?></td>
        <td ></td>
        <td ><?php echo $data->quantity;?></td>
        <td><? if(!empty($type)){echo "₹".$product_sp= $type->sp;}?> </td>
        <!-- <td ><?php if(!empty($type)){echo $type->gst."%";}?></td> -->
        <!-- <td>9%</td>
        <td>CGST</td>
        <td>200</td> -->
        <?php
        ?>
        <?php if($order1_data->state == 29){?>
    <td><span> <?php  $half= $data->gst/2; echo $half."%"; ?>  </span> <br> <span> <?php  $half= $data->gst/2; echo $half."%"; ?> </span></td>
      <?php }else{?>
    <td><?php echo $data->gst."%";?></td>
      <?php }?>
      <?php if($order1_data->state == 29){?>

      <td><span> CGST  </span> <br> <span>  SGST </span></td>
  <?php }else{?>
    <td>IGST</td>
  <?php }?>
  <?php if($order1_data->state == 29){?>
    <td>
  <span> <?php
$total_gst = $type->sp * $data->gst /100 ;
   $total_gst_amount=$total_gst * $data->quantity;
    $half_P= $total_gst_amount/2; echo "₹".$half_P;?>
  </span>
    <br>
     <span> <?php  $total_gst_amount=$total_gst * $data->quantity;
    $half_P= $total_gst_amount/2; echo "₹".$half_P;?>
   </span>
 </td>
  <?php }else{?>

  <td><?php if(!empty($type)){echo "₹".$total_gst_amount=$type->sp * $data->gst/100 * $data->quantity;}?></td>

  <?php }?>
  <td><?php
        $total = $data->total_amount;
         echo "₹".round($total,2);?></td>
      </tr>
  <?php $i++;} }?>
  </tr>
  <tr>
      <tr>
        <th>Total</th>
        <th class="product_table" ><?php if(!empty($order1_data)){ echo ""; }?></th>
        <th class="product_table" colspan="8"><?php if(!empty($order1_data)){ echo ""; }?></th>

        <th class="product_table"><?php if(!empty($order1_data)){ echo "₹".$order1_data->total_amount; }?></th>
      </tr>

      <?php if(!empty($order1_data->promocode) && $order1_data->promocode != "Apply coupon" ){
                    $this->db->select('*');
        $this->db->from('tbl_promocode');
        $this->db->where('id',$order1_data->promocode);
        $promo_da= $this->db->get()->row();

        if(!empty($promo_da)){
          $peomocode_id= $promo_da->id;
          $promocode_name= $promo_da->promocode;
        }else{
          $peomocode_id="";
          $promocode_name="";
        }
        ?>
        <tr>
          <th colspan="9">Promocode: <?=$promocode_name;?> </th>
          <th class="product_table"><?php if(!empty($order1_data)){ echo " "; }?></th>
          <th class="product_table"><?php if(!empty($order1_data->promocode)){
                      $this->db->select('*');
          $this->db->from('tbl_promocode');
          $this->db->where('id',$order1_data->promocode);
          $promo_da= $this->db->get()->row();
          if(!empty($promo_da)){
            // echo $promo_da->promocode;

          }else{
            $promo_discount= 0;
          }
            echo "- ₹".$order1_data->promo_discount; }else{ echo "-₹0"; }?>

<!-- from table order1  start-->

<?php //if(!empty($order1_data)){ echo "- ₹ ".$order1_data->promo_deduction_amount; }else{ echo "-₹0"; }?>

<!-- from table order1  end-->

          </th>

        </tr>
      <?php }?>
      <tr>
        <th>Shipping</th>
        <th class="product_table" ><?php if(!empty($order1_data)){ echo ""; }?></th>
        <th class="product_table" colspan="8"><?php if(!empty($order1_data)){ echo ""; }?></th>

        <th class="product_table"><?php if(!empty($order1_data)){ echo "₹50.00"; }?></th>
      </tr>

      <tr>
        <th colspan="10">SubTotal</th>
        <th class="product_table"><?php if(!empty($order1_data)){ echo "₹".$order1_data->final_amount; }?></th>

      </tr>



    </tbody>
    </table>

      <h6 class="amount_content" >Amount in Words:<br>
      <span id="checks123" style="text-transform: capitalize;font-style: revert;"></span></h6><br>




      <h4 class="oswal_head"><br><br>

      Authorized Signatory </h4>

      </tr>

</div>


<h5 class="warning" style="margin-left: 15px;">Whether tax is payable under reverse charge-No</h5>


</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
 //alert('Changed!')

       $('#gst_percentage').keyup(function() {
       // alert("Key up detected");

       var total_price = $("#mrp").val();
       //var gst_percentage = $("#gst_percentage").val();$(this).val
       var gst_percentage = $(this).val();
       var gst_price = (total_price*gst_percentage)/100;
       var total_gst_price = parseInt(total_price) + parseInt(gst_price);
       //alert(total_gst_price);
       $('#gst_percentage_price').val(gst_price);
       $('#selling_price').val(total_gst_price);

     });

 </script>

<script>

window.onload = function() {

  var unit_mrp = $(".unit_mrp").text();
  var unit_qty = $(".qty").text();
  //var gst_percentage = $("#gst_percentage").val();$(this).val

  var total_unit_mrp = parseInt(unit_mrp) * parseInt(unit_qty);
  //alert(total_gst_price);
  $('.net_unit_mrp').text(total_unit_mrp);

  var total_amount= document.getElementById("tot_amnt").value;
  //alert(total_amount);
  inWords(total_amount);
  window.print();
};



var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'And ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'Only ' : '';
    //return str;
    // alert(str);
    $("#checks123").text(str);

}
</script>

</html>

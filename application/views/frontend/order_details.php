<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">

      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url()?>Home/my_profile/order">My Orders</a></li>
          <li class="breadcrumb-item active">Order Details</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

  <div class="container">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr class="text-center" style="vertical-align: top;">
              <th>S.No.</th>
              <th>Product Name</th>
              <th>Image</th>
              <th>Size</th>
              <th>Color</th>
              <th>Quantity</th>
              <th>Selling Price</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?$i = 1; foreach($order_detail->result() as $details){
                    $return_data = $this->db->get_where('tbl_replacement_order', array('order2_id'=> $details->id))->result();
                    ?>
            <tr class="text-center" style="border-bottom: 2px solid #dee2e6;">
              <td><?=$i;?></td>
              <td><? $product_name = $this->db->get_where('tbl_product', array('id = ' => $details->product_id))->result();
                   if(!empty($product_name)){echo $product_name[0]->name;}else{echo "NA";}
                   ?></td>
              <?$type_data = $this->db->get_where('tbl_type', array('id = ' => $details->type_id))->result();
                   if(!empty($type_data)){
                    $sizeOfType = $this->db->get_where('tbl_size', array('id = ' => $type_data[0]->size_id))->result();
                    $colorOfType = $this->db->get_where('tbl_colour', array('id = ' => $type_data[0]->colour_id))->result();
                  }else{
                    $sizeOfType = [];
                    $colorOfType = [];
                  }
                   ?>
              <td><img src="<?=base_url().$type_data[0]->image?>" style="height: 8rem; width: auto" class="img-fluid"></td>
              <td>
                <?if(!empty($sizeOfType)){echo $sizeOfType[0]->name;}else{echo "NA";}?>
              </td>
              <td>
                <?if(!empty($colorOfType)){?><span style="background-color:<?php echo $colorOfType[0]->name ?>;border-radius:80%">&nbsp&nbsp&nbsp&nbsp</span>
                <?echo $colorOfType[0]->colour_name;}else{echo "NA";}?>
              </td>
              <td><?=$details->quantity?></td>
              <td>₹<?=$details->spgst?></td>
              <td>₹<?=$details->total_amount?></td>

              </td>
              <td>
                <?if(empty($return_data)){?>
                <a href="<?=base_url()?>Order/return_replace/<?=base64_encode($details->id)?>"> <button type="submit" class="btn btn-fill-out" name="submit" value="Submit" style="padding:5px 10px;"><span>Return</span></button></a>
                <?}else{
                    if($return_data[0]->replace_status==0){
                    ?>
                <span class="bg-warning" style="padding:5px 10px;color:white">Request Submitted</span>
                <?}else if($return_data[0]->replace_status==1){?><span class="bg-primary" style="padding:5px 10px;color:white">Request Accepted</span>
                <?}else if($return_data[0]->replace_status==2){?><span class="bg-success" style="padding:5px 10px;color:white">Request Completed</span>
                <?}
                else{?>
                <span class="bg-danger" style="padding:5px 10px;color:white">Request Rejected</span>
                <?}}?>
              </td>
            </tr>
            <?$i ++; }?>

          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
<!-- END MAIN CONTENT -->

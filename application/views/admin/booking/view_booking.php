<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?=$heading?> Bookings
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <!-- <li class="active"></li> -->
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Orders</h3>
          </div>
          <div class="panel panel-default">
            <?php if (!empty($this->session->flashdata('smessage'))) { ?>
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Alert!</h4>
              <?php echo $this->session->flashdata('smessage'); ?>
            </div>
            <?php }
                      if (!empty($this->session->flashdata('emessage'))) { ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Alert!</h4>
              <?php echo $this->session->flashdata('emessage'); ?>
            </div>
            <?php } ?>
            <div class="panel-body">
              <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover table-striped" id="orderTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Booking</th>
                      <th>User</th>
                      <th>Total Amount</th>
                      <th>Promocode</th>
                      <th>Promocode Discount</th>
                      <th>Final Amount</th>
                      <th>City </th>
                      <th>Car </th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <?if ($booking_type==2) {?>
                      <th>Car Type</th>
                      <?}?>
                      <?if ($booking_type==3) {?>
                      <th>Car Type</th>
                      <?}?>
                      <th>Pick Location</th>
                      <th>Drop Location</th>
                      <th>Start Kilometer</th>
                      <th>End Kilometer</th>
                      <th>Invoice</th>
                      <?if ($booking_type==1) {?>
                      <th>Aadhar Image Front</th>
                      <th>Aadhar Image Back</th>
                      <th>Licence Image Front</th>
                      <th>License Image Back</th>
                      <?}?>
                      <th>Date</th>
                      <th>Order Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
foreach ($booking_data->result() as $data) {
    $user_data = $this->db->get_where('tbl_users', array('is_active'=> 1,'id'=> $data->user_id))->result();
    $promo_data = $this->db->get_where('tbl_promocode', array('is_active'=> 1,'id'=> $data->promocode))->result();
    if(!empty($promo_data)){
      $promocode=$promo_data[0]->promocode ;
      $discount=$data->promo_discount ;
    }else{
      $promocode="NA";
      $discount=0 ;
    }
    // $Self_drive_data = $this->db->get_where('tbl_selfdrive', array('is_active'=> 1,'id'=> $data->car_id))->result();?>
                    <tr>
                      <td><?=$i?></td>
                      <td>
                        <?php if ($data->booking_type== 1) {
        echo "self-drive";
    } elseif ($data->booking_type== 2) {
        echo "intercity";
    } elseif ($data->booking_type== 3) {
        echo "outstation";
    } ?></td>
                      </td>
                      <td><?php echo $user_data[0]->f_name." ".$user_data[0]->l_name ?></td>
                      <td>₹<?php echo $data->total_amount ?></td>
                      <td><?php echo $promocode ?></td>
                      <td>₹<?php echo $discount ?></td>
                      <td>₹<?php echo $data->final_amount ?></td>
                      <td><?php echo $data->city_id ?></td>
                      <td><?php echo $data->car_id ?></td>
                      <td><?php echo $data->start_date ?></td>
                      <td><?php echo $data->end_date ?></td>
                      <td><?php echo $data->start_time ?></td>
                      <td><?php echo $data->end_time ?></td>
                      <?if ($booking_type==2) {?>
                      <td>
                        <?php if ($data->cab_type== 1) {
        echo "HATCHBACK";
    } elseif ($data->cab_type== 2) {
        echo " 	SEDAN ";
    } elseif ($data->cab_type== 3) {
        echo "SUV";
    } ?>
                      </td>
                      <?} ?>
                      <?if ($booking_type==3) {?>
                      <td>
                        <?php if ($data->cab_type== 1) {
        echo "HATCHBACK";
    } elseif ($data->cab_type== 2) {
        echo " 	SEDAN ";
    } elseif ($data->cab_type== 3) {
        echo "SUV";
    } ?>
                      </td>
                      <?} ?>
                      <td><?php echo $data->pick_location ?></td>
                      <td><?php echo $data->drop_location ?></td>
                      <td><?php echo $data->start_kilometer ?></td>
                      <td><?php echo $data->end_kilometer?></td>
                      <td>
                        <?php if ($data->invoice_image!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->invoice_image ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                      </td>
                      <?if ($booking_type==1) {?>
                        <td>
                        <?php if ($data->aadhar_front!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->aadhar_front ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                          </td>
                            <td>
                        <?php if ($data->aadhar_back!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->aadhar_back ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                          </td>
                            <td>
                        <?php if ($data->license_front!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->license_front ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                          </td>
                            <td>
                        <?php if ($data->license_back!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->license_back ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                      </td>
                      <?} ?>
                      <td><?php echo $data->date?></td>

                      <td><?php if ($data->order_status==1) {?>
                        <p class="label bg-yellow">Pending</p>
                        <?} elseif ($data->order_status==2) {?>
                        <p class="label bg-blue">Accepted</p>
                        <?} elseif ($data->order_status==3) {?>
                        <p class="label bg-green">Compeleted</p>
                        <?} elseif ($data->order_status==4) {?>
                        <p class="label bg-red">Rejected</p>
                        <?} ?>
                      <td>
                        <?if($data->order_status!=3 && $data->order_status!=4){?>
                        <div class="btn-group" id="btns<?php echo $i ?>">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                              <?php
                        if ($data->booking_type==1 || $data->booking_type==2) {
                            if ($data->order_status==1) { ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/booking/updateorderStatus/<?php echo base64_encode($data->id) ?>/accepted">Accepted</a></li>
                              <li><a href="<?php echo base_url() ?>dcadmin/booking/updateorderStatus/<?php echo base64_encode($data->id) ?>/reject">Reject</a></li>
                              <?php } elseif ($data->order_status==2) {?>
                                <li><a href="<?php echo base_url() ?>dcadmin/booking/Confirm_booking/<?php echo base64_encode($data->id) ?>/<?=$heading?>">Completed</a></li>
                              <?}
                        } else {
                            if ($data->order_status==1) { ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/booking/start_outstation_booking/<?php echo base64_encode($data->id)?>">Accepted</a></li>
                              <li><a href="<?php echo base_url() ?>dcadmin/booking/updateorderStatus/<?php echo base64_encode($data->id) ?>/reject">Reject</a></li>
                                <?php } elseif ($data->order_status==2) {?>
                              <li><a href="<?php echo base_url() ?>dcadmin/booking/end_outstation_booking/<?php echo base64_encode($data->id)?>">Complete</a></li>
                              <?}?>
                              <?
                        } ?>
                      </ul>
                          </div>
                          </div>
                          <?}echo "NA";?>
                      </td>
                    </tr>
                    <?php $i++;
} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style>
  label {
    margin: 5px;
  }
</style>
<!-- //===========================order excel====================================\\ -->
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
  // buttons: [
  //     'copy', 'csv', 'excel', 'pdf', 'print'
  // ]
  $(document).ready(function() {
    $('#orderTable').DataTable({
      responsive: true,
      "bStateSave": true,
      "fnStateSave": function(oSettings, oData) {
        localStorage.setItem('offersDataTables', JSON.stringify(oData));
      },
      "fnStateLoad": function(oSettings) {
        return JSON.parse(localStorage.getItem('offersDataTables'));
      },
      dom: 'Bfrtip',
      buttons: [{
          extend: 'copyHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19] //number of columns, excluding # column
          }
        },
        {
          extend: 'csvHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
          }
        },
        {
          extend: 'excelHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
          }
        },
        {
          extend: 'pdfHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
          }
        },
      ]
    });
    $(document.body).on('click', '.dCnf', function() {
      var i = $(this).attr("mydata");
      console.log(i);
      $("#btns" + i).hide();
      $("#cnfbox" + i).show();
    });
    $(document.body).on('click', '.cans', function() {
      var i = $(this).attr("mydatas");
      console.log(i);
      $("#btns" + i).show();
      $("#cnfbox" + i).hide();
    })
  });
</script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->

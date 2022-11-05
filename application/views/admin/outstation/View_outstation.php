<div class="content-wrapper">
  <section class="content-header">
    <h1>
       Outstation
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Outstation/View_outstation"><i class="fa fa-dashboard"></i> view Outstation </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <?if ($this->session->userdata('position')!='Manager') {?>
        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/Outstation/Add_outstation" role="button" style="margin-bottom:12px;"> Add Outstation</a>
        <?}?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Outstation</h3>
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
                <table class="table table-bordered table-hover table-striped" id="userTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Brand Name</th>
                      <th>Car Name</th>
                      <th>Seating Capacity</th>
                      <th>Image</th>
                      <th>Rate Per Kilometer</th>
                      <th>Location</th>
                      <th>City</th>
                      <th>Minimum Booking Amount</th>
                      <th>Date</th>
                      <th>Booking Status</th>
                      <th>Status</th>
                      <?if ($this->session->userdata('position')!='Manager') {?>
                      <th>Action</th>
                      <?}?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($station_data->result() as $data) {
    $city_data = $this->db->get_where('tbl_cities', array('id'=> $data->city_id))->result(); ?>
                    <tr>
                      <td><?php echo $i ?> </td>
                      <td><?php echo $data->brand_name?> </td>
                      <td><?php echo $data->car_name ?> </td>
                      <td><?php if ($data->seatting==1) {
    echo '4 Seater';
} else if($data->seatting==2){
    echo '5 Seater';
}else if($data->seatting==3){
echo '7 Seater';
} ?> </td>
                      <td>
                        <?php if ($data->photo!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->photo ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                      </td>
                      <td>₹<?php echo $data->per_kilometre?> </td>
                      <td><?php echo $data->location ?> </td>
                      <td><?php
                      echo $city_data[0]->name; ?>
                      </td>
                      <td>₹<?php echo $data->min_booking_amt ?> </td>
                      <td><?php echo $data->date ?> </td>
                      <td><?php if ($data->is_available==1) { ?>
                    <p class="label bg-green">Available</p>
                    <?php } else { ?>
                    <p class="label bg-red">Unavailable</p>
                    <?php		} ?>
                  </td>
                      <td><?php if ($data->is_active==1) { ?>
                        <p class="label bg-green">Active</p>
                        <?php } else { ?>
                        <p class="label bg-yellow">Inactive</p>
                        <?php		} ?>
                      </td>
                      <?if ($this->session->userdata('position')!='Manager') {?>
                      <td>
                        <div class="btn-group" id="btns<?php echo $i ?>">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                              <?php if ($data->is_active==1) { ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/Outstation/updateoutstationStatus/<?php echo base64_encode($data->id) ?>/inactive">Inactive</a></li>
                              <?php } else { ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/Outstation/updateoutstationStatus/<?php echo base64_encode($data->id) ?>/active">Active</a></li>
                              <?php		}   ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/Outstation/Update_outstation/<?php echo base64_encode($data->id) ?>">Edit</a></li>
                              <?if ($this->session->userdata('position')=='Super Admin') {?>
                              <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li>
                              <?}?>
                            </ul>
                          </div>
                        </div>
                        <div style="display:none" id="cnfbox<?php echo $i ?>">
                          <p> Are you sure delete this </p>
                          <a href="<?php echo base_url() ?>dcadmin/Outstation/delete_outstation/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
                          <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
                        </div>
                      </td>
                      <?} ?>
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
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
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
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/size/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/size/rs.js"></script>	  -->

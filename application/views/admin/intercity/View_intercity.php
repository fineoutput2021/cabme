<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Inter-City
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Intercity/View_intercity"><i class="fa fa-undo" aria-hidden="true"></i> View Intercity </a></li>
      <!-- <li class="active"></li> -->
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <?if ($this->session->userdata('position')!='Manager') {?>
        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/Intercity/Add_intercity" role="button" style="margin-bottom:12px;"> Add Intercity</a>
        <?}?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Intercity</h3>
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
                      <th>City Name</th>
                      <th>Cab Type</th>
                      <th>Price</th>
                      <th>Kilometer Cap</th>
                      <th>Minimum Booking Amount</th>
                      <th>Status</th>
                      <?if ($this->session->userdata('position')!='Manager') {?>
                      <th>Action</th>
                      <?}?>
                    </tr>
                  </thead>
                  <tbody>
    <?php $i=1; foreach ($intercity_data->result() as $data) {
        $city_data = $this->db->get_where('tbl_cities', array('id'=> $data->city_id))->result(); ?>
                    <tr>
                      <td><?php echo $i ?> </td>
                          <td><?php echo $city_data[0]->name ?></td>
                      <td>
                        <?php
                            echo $data->cab_type;
                          ?>


                      </td>
                      <td>???<?php echo $data->price ?></td>
                      <td><?php echo $data->Kilomitere_cab ?></td>
                      <td>???<?php echo $data->min_amount ?></td>
                      <td><?php if ($data->is_active==1) { ?>
                        <p class="label bg-green">Active</p>
                        <?php } else { ?>
                        <p class="label bg-yellow">Inactive</p>
                        <?php		}   ?>
                      </td>
                      <?if ($this->session->userdata('position')!='Manager') {?>
                      <td>
                        <div class="btn-group" id="btns<?php echo $i ?>">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                              <?php if ($data->is_active==1) { ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/Intercity/updateintercityStatus/<?php echo base64_encode($data->id) ?>/inactive">Inactive</a></li>
                              <?php } else { ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/Intercity/updateintercityStatus/<?php echo base64_encode($data->id) ?>/active">Active</a></li>
                              <?php		}   ?>
                              <li><a href="<?php echo base_url() ?>dcadmin/Intercity/Update_intercity/<?php echo base64_encode($data->id) ?>">Edit</a></li>
                              <?if ($this->session->userdata('position')=='Super Admin') {?>
                              <!-- <li><a href="javascript:;" class="dCnf" mydata="<?php echo $i ?>">Delete</a></li> -->
                              <?}?>
                            </ul>
                          </div>
                        </div>
                        <div style="display:none" id="cnfbox<?php echo $i ?>">
                          <p> Are you sure delete this </p>
                          <a href="<?php echo base_url() ?>dcadmin/Intercity/delete_intercity/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
                          <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
                        </div>
                      </td>
                      <?}?>
                    </tr>
                    <?php $i++; } ?>
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
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->

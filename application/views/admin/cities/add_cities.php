<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New City
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/City/view_cities"><i class="fa fa-undo" aria-hidden="true"></i></i> View City </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New City</h3>
          </div>
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
            <div class="col-lg-10">
              <form action="<?php echo base_url() ?>dcadmin/City/add_cities_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="name" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="file" name="photo" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Top </strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="top" class="form-control" required>
                          <option value="">---Select -----</option>
                          <option value="Yes">Yes</option>
                          <option value="NO">NO</option>

                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>City Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="radio" id="with_fair" name="city_type" value="1" checked>
                        <label for="with_fair">Self Drive City</label></label>
                        <input type="radio" id="without_fair" name="city_type" value="2">
                        <label for="without_fair">Outstation City</label>
                      </td>
                    </tr>
                    <tr>

                      <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success" value="save">
                      </td>
                    </tr>
                  </table>
                </div>
              </form>
            </div>
            <style>
              .btn-success {
                background-color: red;
                border-color: red;
              }

              .btn-success:hover {
                background-color: red;
                border-color: red;
              }
            </style>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/size/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Complete <?=$heading?> Booking
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <!-- <li><a href="<?php echo base_url() ?>dcadmin/City/view_cities"><i class="fa fa-undo" aria-hidden="true"></i></i> View City </a></li> -->
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Complete <?=$heading?> Booking</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/booking/complete_booking/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <input type="hidden" name="id" class="form-control" placeholder="" required value="<?=base64_decode($id)?>" />
                <div class="table-responsive">
                  <table class="table table-hover">
                    <input type="hidden" name="heading" value="<?=$heading?>">
                    <tr>
                      <td> <strong>Invoice</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="file" name="invoice_image" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
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

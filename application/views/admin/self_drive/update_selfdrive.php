<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update self-Drive
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Self_drive/view_selfdrive"><i class="fa fa-undo" aria-hidden="true"></i> View self-Drive </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update self-  Drive</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Self_drive/add_selfdrive_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>City-Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="city_id" class="form-control">
                          <option value="">-----select City-----</option>
                          <?php $i=1; foreach ($cities_data->result() as $cat) { ?>
                          <option value="<?=$cat->id?>" <?if ($cat->id==$Self_drive->city_id) {
                            echo 'selected';
                            }?>><?=$cat->name?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Brand-name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="brand_name" class="form-control" placeholder="brand_name" required value="<?=$Self_drive->brand_name?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Car-name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="car_name" class="form-control" placeholder="car_name" required value="<?=$Self_drive->car_name?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;"><br />Big: 190px X 73px<br />Small: 190px X 73px</span></strong> </td>
                      <td>
                        <input type="file" name="photo" class="form-control" placeholder="" value="<?=$Self_drive->photo?>" />
                        <?php if ($Self_drive->photo!="") {  ?>
                        <img id="slide_img_path" height=75 width=150 src="<?php echo base_url().$Self_drive->photo ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Fuel-Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="fule_type" class="form-control" required>

                          <option value="1" <?if($Self_drive->fule_type==1){echo 'selected' ;}?>>Petrol</option>
                          <option value="2" <?if($Self_drive->fule_type==2){echo 'selected' ;}?>>Diesel</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Transmission</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="transmission" class="form-control" required>
                          <option value="1" <?if($Self_drive->transmission==1){echo 'selected' ;}?>>Manual</option>
                          <option value="2" <?if($Self_drive->transmission==2){echo 'selected' ;}?>>Automatic</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Seating Capacity</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="seatting" class="form-control" required>
                          <option value="1" <?if($Self_drive->seatting==1){echo 'selected' ;}?>>4 Seater</option>
                          <option value="2" <?if($Self_drive->seatting==2){echo 'selected' ;}?>>5 Seater</option>
                          <option value="2" <?if($Self_drive->seatting==3){echo 'selected' ;}?>>7 Seater</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>kilometer1</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="kilometer1" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->kilometer1?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Price1</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price1" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->price1?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilometer2</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="kilometer2" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->kilometer2?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>price2</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price2" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->price2?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilometre3</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="kilometer3" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->kilometer3?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>price3</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price3" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->price3?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Extra-kilomerter</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="extra_kilo" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->extra_kilo?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Refundable Security Deposit Amount</strong>*<span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="rsda" onkeypress="return isNumberKey(event)" class="form-control" placeholder="name" required value="<?=$Self_drive->rsda?>" />
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success primary" value="save">
                      </td>
                    </tr>
                  </table>
                </div>
                <style>
                  .primary {
                    background-color: #ff0000;
                  }

                  .primary:hover {
                    background-color: #ff0000 !important;
                  }
                </style>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Team
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/System/view_team"><i class="fa fa-undo" aria-hidden="true"></i> View Team </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Team</h3>
          </div>
          <div class="panel-body">
            <?php if (!empty($this->session->flashdata('smessage'))) { ?>
            <div class="alert alert-success alert-dismissible fade in">
              <strong><?php echo $this->session->flashdata('smessage'); ?></strong>
            </div>
            <?php }
                       if (!empty($this->session->flashdata('emessage'))) { ?>
            <div class="alert alert-danger alert-dismissible fade in">
              <strong><?php echo $this->session->flashdata('emessage'); ?></strong>
            </div>
            <?php } ?>
            <div class="col-lg-10">
              <form action="<?php echo base_url() ?>dcadmin/System/add_team_data/<? echo base64_encode(2); ?>/<?=$id;?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">

                    <tr>
                      <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="name" class="form-control" placeholder="" required value="<?=$team_data->name?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Email</strong> <span style="color:red;">*</span></strong> </td>
                      <td>

                        <input type="email" name="email" class="form-control" placeholder="" required value="<?=$team_data->email?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Phone (optional)</strong> </strong> </td>
                      <td>

                        <input type="text" min="0" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" maxlength="10" name="phone" class="form-control" placeholder="" value="<?=$team_data->phone?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Address (optional)</strong> </strong> </td>
                      <td>

                        <input type="text" name="address" class="form-control" placeholder="" value="<?=$team_data->address?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Password</strong></td>
                      <td>

                        <input type="password" name="password" class="form-control" placeholder="" value="<?=$team_data->password?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Permission Level</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <div class="form-group">

                          <select class="form-control" name="power" required>
                            <option value="1">Please select Type</option>
                            <option value="1" <?if($team_data->power==1){ echo "selected";}?>>Super Admin</option>
                            <option value="2" <?if($team_data->power==2){ echo "selected";}?>>Admin</option>
                            <option value="3" <?if($team_data->power==3){ echo "selected";}?>>Manager</option>

                          </select>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>services</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <div class="form-group">
                          <div class="checkbox">
                            <label><input type="checkbox" <?if($team_data->services=='["999"]'){echo 'checked';}?> name="service" value="999">All</label>
                          </div>
                          <?php foreach ($side->result() as $s) {
                           ?>
                          <div class="checkbox">
                            <label><input <?if (strpos($team_data->services, $s->id)==true){echo "checked";}?> type="checkbox" name="services[]" value="<?php echo $s->id; ?>"><?php echo $s->name; ?></label>
                          </div>
                          <?php
                       } ?>

                        </div>
                      </td>
                    </tr>


                    <tr>
                      <td> <strong>Image</strong> </td>
                      <td>
                        <input type="file" name="fileToUpload1" value"<?=$team_data->image?>"> </input>
                        <?php if ($team_data->image!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$team_data->image ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                </div>
                </td>
                </tr>


                <tr>
                  <td colspan="2">
                    <input type="submit" class="btn custom_btn  primary" value="save">
                  </td>
                </tr>
                </table>
            </div>
            <style>
            .primary{
              background-color: #ff0000;
            }
            .primary:hover{
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


<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />



<style>

</style>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->

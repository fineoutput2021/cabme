<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Buy With It
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Product/view_product/<?=base64_encode($subcategory_id)?>"><i class="fa fa-undo" aria-hidden="true"></i> View Product </a></li>
      <!-- <li class="active"></li> -->
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <?if ($this->session->userdata('position')!='Manager') {?>
        <a class="btn custom_btn" href="<?php echo base_url() ?>dcadmin/Product/add_buy_with_it/<?=$id?>" role="button" style="margin-bottom:12px;"> Add Buy With It</a>
        <?}?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Buy With It </h3>
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
                      <th>Category Name</th>
                      <th>SubCategory Name</th>
                      <th>Product Name</th>
                      <th>Image</th>
                      <th>SKU</th>
                      <th>HSN Code</th>
                      <th>Vendor Code</th>
                      <th>Product Type</th>
                      <th>Description</th>
                      <th>Exclusive Product</th>
                      <!-- <th>Inventory</th> -->
                      <th>Tags</th>
                      <th>Trending</th>
                      <th>Status</th>
                      <?if ($this->session->userdata('position')!='Manager') {?>
                      <th>Action</th>
                      <?}?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (!empty($product->buy_with)) {
                        $i=1;
                        foreach ($product_data->result() as $data) {
                            $a=0;
                            $buy_arr=json_decode($product->buy_with);
                            if(!empty($buy_arr)){
                            $length = count($buy_arr);
                            // echo$length;die();
                            for ($j=0; $j<$length;$j++) {
                                if ($data->id == $buy_arr[$j]) {
                                    $a=1;
                                }
                            }
                          }
                            if ($a==1) {
                                ?>
                    <tr>

                      <td><?=$i?></td>
                      <td><?php                    $this->db->select('*');
                                $this->db->from('tbl_category');
                                $this->db->where('id', $data->category_id);
                                $category_data= $this->db->get()->row();
                                echo $category_data->name; ?></td>
                      <td><?php
               $this->db->select('*');
                                $this->db->from('tbl_subcategory');
                                $this->db->where('id', $data->subcategory_id);
                                $subcategory_data= $this->db->get()->row();
                                echo $subcategory_data->name; ?></td>
                      <td><?php echo $data->name ?></td>

                      <td>
                        <?php if ($data->image1!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$data->image1 ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                      </td>
                      <td><?php echo $data->sku ?></td>
                      <td><?php echo $data->hsn_code ?></td>
                      <td><?php echo $data->vendor_code ?></td>

                      <td><?php
                      if ($data->product_type==1) {
                                    echo"Online";
                                }
                                if ($data->product_type==2) {
                                    echo"Offline";
                                }
                                if ($data->product_type==3) {
                                    echo"Both";
                                } ?></td>
                      <td><?php echo $data->description ?></td>
                      <td><?php
                      if ($data->exclusive==1) {
                                    echo"yes";
                                } else {
                                    echo"No";
                                } ?></td>

                      <td><?php echo $data->tags ?></td>
                      <td><?php
if ($data->trending==1) {
                                    echo"yes";
                                } else {
                                    echo"No";
                                } ?></td>

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
                            <?if ($this->session->userdata('position')=='Super Admin') {?>
                            <button class="dCnf" mydata="<?php echo $i ?>" type="button" class="btn btn-default "> Remove</button>
                            <?}?>
                          </div>
                        </div>

                        <div style="display:none" id="cnfbox<?php echo $i ?>">
                          <p> Are you sure delete this </p>
                          <a href="<?php echo base_url() ?>dcadmin/Product/remove_buy_with/<?=$id?>/<?php echo base64_encode($data->id); ?>" class="btn btn-danger">Yes</a>
                          <a href="javasript:;" class="cans btn btn-default" mydatas="<?php echo $i ?>">No</a>
                        </div>
                      </td>
                      <?} ?>
                    </tr>
                    <?php $i++;
                            }
                        }
                    }?>
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

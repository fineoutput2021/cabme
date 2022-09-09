<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Product
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url() ?>dcadmin/Product/view_product/<?=$subcategory_id?>"><i class="fa fa-undo" aria-hidden="true"></i> View Product </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New product</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/product/add_product_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">

                    <!-- <tr>
                      <td> <strong>Category</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="category_id" id="category_id" class="form-control">
                          <?php $i=1; foreach ($category_data->result() as $category) { ?>
                          <option value="<?=$category->id?>"><?=$category->name?></option>
                          <?php $i++; } ?>
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Subcategory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                          <?php $i=1; foreach ($subcategory_data->result() as $subcategory) { ?>
                          <option value="<?=$subcategory->id?>"><?=$subcategory->name?></option>
                          <?php $i++; } ?>
                      </td>
                    </tr> -->
                    <input type="hidden" name="category_id" value="<?=base64_decode($category_id)?>" />
                    <input type="hidden" name="subcategory_id" value="<?=base64_decode($subcategory_id)?>" />
                    <tr>
                      <td> <strong>Product Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="name" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image size chart</strong> <span style="color:red;">*<br />Size: 969px X 695px</span></strong> </td>
                      <td>
                        <input type="file" name="image1" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>SKU</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="sku" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>HSN Code</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="hsn_code" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Vendor Code</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="vendor_code" class="form-control" placeholder="" requird value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Product Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="product_type"  class="form-control">
                          <option value="1">Online</option>
                          <option value="2">Offline</option>
                          <option value="3">Both</option>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Product View</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="product_view"  class="form-control">
                          <option value="1">Retailer</option>
                          <option value="2">Reseller</option>
                          <option value="3">Both</option>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea name="description" id="editor1" required value=""></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Exclusive Product</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="exclusive"  class="form-control">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                      </td>
                    </tr>
                    <!-- <tr>
                      <td> <strong>Inventory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="inventory" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr> -->
                    <tr>
                      <td> <strong>Tags</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="tags" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Trending Product</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="trending"  class="form-control">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                      </td>
                    </tr>

                    <?php $i=1;
                    // $filter_arr=[];
                     foreach($filters_data->result() as $filter) {
                      if(empty($filter_arr)) {
                        $filter_arr = [$filter->id];
                      }else{
                          // print_r($filter_arr);
                    array_push($filter_arr, $filter->id);
                    }

                      $this->db->select('*');
                      $this->db->from('tbl_attribute');
                      $this->db->where('filter_id',$filter->id);
                      $this->db->where('is_active',1);
                      $attributes= $this->db->get();
                      ?>
                    <tr>
                      <td>Filter <strong><?=$filter->name?></strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="attribute_<?=$filter->id?>[]"  class="form-control" multiple class="chosen-select" >
                          <option value="">--- select filter -----  </option>
                          <?php $i=1; foreach($attributes->result() as $data) { ?>
                          <option value="<?=$data->id?>"><?=$data->name?></option>
                          <?php $i++; } ?>
                      </td>
                    </tr>
                    <?php $i++; } ?>
                    <input type="hidden" name="filter_arr" value='<?=json_encode($filter_arr)?>'/>
                    <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success" value="save">
                      </td>
                    </tr>
                  </table>
                </div>

              </form>

            </div>



          </div>

        </div>

      </div>
    </div>
  </section>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $(document).ready(function() {
    $("#category_id").change(function() {
      var vf = $(this).val();
      if (vf == "") {
        return false;
      } else {
        // alert(vf)
        $('#subcategory_id option').remove();
        // var opton = "<option value=''>Please Select </option>";
        var opton = '';
        $.ajax({
          url: base_url + "dcadmin/Product/get_subcategory?cat_id=" + vf,
          data: '',
          type: "get",
          success: function(response) {
            if (response != "NA") {
              var data = jQuery.parseJSON(response);
              $.each(data, function(i) {
                opton += '<option value="' + data[i]['id'] + '">' + data[i]['name'] + '</option>';
              });
              $('#subcategory_id').append(opton);
            } //if end
          } //success end
        }); //ajax end
      }
    });
  });
</script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
      <script>
        CKEDITOR.replace('editor1');
      </script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
  $('select').selectpicker();
</script>

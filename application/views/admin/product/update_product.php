<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Product
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Product/view_product/<?=base64_encode($subcategory_id)?>"><i class="fa fa-undo" aria-hidden="true"></i> view Product </a></li>

    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Product</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/product/add_product_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">

                    <!-- <tr>
                      <td> <strong>Category</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="category_id" id="category_id" class="form-control">
                          <option value="">=========select category==============</option>
                          <?php $i=1; foreach ($category_data->result() as $category) { ?>
                          <option value="<?=$category->id?>" <?if ($category->id==$product->category_id) {
                                           echo "selected";
                                       }?>><?=$category->name?></option>
                          <?php $i++; } ?>
                      </td>
                    </tr>

                    <tr>
                      <td> <strong>Subcategory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                          <option value="">=========select subcategory==============</option>
                          <?php $i=1; foreach ($subcategory_data->result() as $subcategory) { ?>
                          <option value="<?=$subcategory->id?>" <?if ($subcategory->id==$product->subcategory_id) {
                                           echo "selected";
                                       }?>><?=$subcategory->name?></option>
                          <?php $i++; } ?>
                      </td>
                    </tr> -->
                    <input type="hidden" name="category_id" value="<?=$product->category_id?>" />
                    <input type="hidden" name="subcategory_id" value="<?=$product->subcategory_id?>" />

                    <tr>
                      <td> <strong> Product Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="name" class="form-control" placeholder="" required value="<?=$product->name?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image size chart</strong> <span style="color:red;"><br />Size: 969px X 695px</span></strong> </td>
                      <td>
                        <input type="file" name="image1" class="form-control" placeholder="" />
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$product->image1 ?>">
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>SKU</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="sku" class="form-control" placeholder="" required value="<?=$product->sku?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>HSN Code</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="hsn_code" class="form-control" placeholder="" required value="<?=$product->hsn_code?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Vendor code</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="vendor_code" class="form-control" placeholder="" required value="<?=$product->vendor_code?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Product Type</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="product_type" class="form-control">
                          <option <?if ($product->product_type=="1") {
                            echo "selected";
                            }?> value="1">Online</option>
                          <option <?if ($product->product_type=="2") {
                            echo "selected";
                            }?> value="2">Offline</option>
                          <option <?if ($product->product_type=="3") {
                            echo "selected";
                            }?> value="3">Both</option>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Product View</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="product_view" class="form-control">
                          <option <?if ($product->product_view=="1") {
                            echo "selected";
                          }?> value="1">Retailer</option>
                          <option <?if ($product->product_view=="2") {
                            echo "selected";
                          }?> value="2">Reseller</option>
                          <option <?if ($product->product_view=="3") {
                            echo "selected";
                            }?> value="3">Both</option>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Description</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <textarea id="editor1" name="description"><?=$product->description?></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Exclusive Product</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="feature" class="form-control">
                          <option <?if ($product->exclusive=="0") {
                            echo "selected";
                            }?> value="0">No</option>
                          <option <?if ($product->exclusive=="1") {
                            echo "selected";
                            }?> value="1">Yes</option>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Tags</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="tags" class="form-control" placeholder="" required value="<?=$product->tags?>" />
                      </td>
                    </tr>
                    <!-- <tr>
                      <td> <strong>Inventory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="inventory" class="form-control" placeholder="" required value="<?=$product->inventory?>" />
                      </td>
                    </tr> -->
                    <tr>
                      <td> <strong>Trending Product</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="trending" class="form-control">
                          <option <?if ($product->trending=="0") {
                            echo "selected";
                            }?> value="0">No</option>
                          <option <?if ($product->trending=="1") {
                            echo "selected";
                            }?> value="1">Yes</option>
                      </td>
                    </tr>



                    <?php $i=1; foreach ($filters_data->result() as $filter) {
                      if(empty($filter_arr)) {
                        $filter_arr = [$filter->id];
                      }else{
                          // print_r($filter_arr);
                    array_push($filter_arr, $filter->id);
                    }
                                           $this->db->select('*');
                                           $this->db->from('tbl_attribute');
                                           $this->db->where('filter_id', $filter->id);
                                           $this->db->where('is_active', 1);
                                           $attributes= $this->db->get(); ?>
                    <tr>
                      <td>Filter <strong><?=$filter->name?></strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="attribute_<?=$filter->id?>[]" class="form-control" multiple class="chosen-select">
                          <option value="">--- select filter ----- </option>
                          <?php $i=1;
                          $attriutes_arr=json_decode($product->all_attributes);
                                           foreach ($attributes->result() as $data) {
                                             $s=0;
                                             foreach ($attriutes_arr as $value) {
                                              if($data->id == $value){
                                                $s=1;
                                              }
                                             }?>
                          <option value="<?=$data->id?>" <?if($s==1){echo 'selected';}?>><?=$data->name?></option>
                          <?php
                          $i++; } ?>
                      </td>
                    </tr>
                    <?php $i++;
                                       } ?>
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
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $(document).ready( => () {
    $("#category_id").change(function() {
      var vf = $(this).val();
      if (vf == "") {
        return false;
      } else {
        // alert(vf)
        $('#subcategory_id option').remove();
        var opton = "<option value=''>Please Select </option>";
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

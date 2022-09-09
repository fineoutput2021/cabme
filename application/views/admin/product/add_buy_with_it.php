<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Buy with it
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Product/view_buy_with_it/<?=$id?>"><i class="fa fa-undo" aria-hidden="true"></i> View Buy With It </a></li>

    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Buy with it</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Product/add_buy_with_it_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive" style="min-height: 20rem;">
                  <table class="table table-hover">
                    <input type="hidden" name="pro_id" value="<?=$id?>" />
                    <tr>
                      <td> <strong>Product Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="product_id" class="form-control select2" </select>
                          <option value="">----select product------</option>
                          <?php $i=1; foreach ($product_data->result() as $product) {
                            $a=0;
                            $buy_arr=json_decode($pro_data->buy_with);
                            if(!empty($buy_arr)){
                            $length = count($buy_arr);
                            // echo$length;die();
                            for ($j=0; $j<$length;$j++) {
                                if ($product->id == $buy_arr[$j]) {
                                    $a=1;
                                }
                            }}
                            if ($a==0) {
                             ?>
                          <option value="<?=$product->id?>"><?=$product->name?> (<?=$product->sku?>)</option>
                          <?php $i++; } }?>
                        </select>
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



          </div>

        </div>

      </div>
    </div>
  </section>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script>
  $('.select2').select2();
</script>

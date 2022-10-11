<!-- ============================================== START SECTION BREADCRUMB =========================================== -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">

      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Replace</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!--=============================================== END SECTION BREADCRUMB ==================================================-->

<!-- =============================================== START MAIN CONTENT ======================================================-->
<div class="main_content">
  <!-- ========================================== START SECTION SHOP ========================================================-->
  <div class="section" style="padding-top: 20px;">
    <div class="container-fluid">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-12 text-center">
            <img src="<?=base_url().$type_data[0]->image?>" alt="blog_small_img2" width="50%">
            <h5 class="mt-3"><?=$pro_data[0]->name?></h5>
            <h5> Qty: &nbsp;<?=$order2_data[0]->quantity?></h5>
          </div>
          <div class="col-md-8 col-12">
            <form method="post" action="<?=base_url()?>Order/insert_return_request" enctype="multipart/form-data">
              <input type="hidden" name="order1_id" value="<?=$order2_data[0]->main_id?>">
              <input type="hidden" name="order2_id" value="<?=$order2_data[0]->id?>">
              <div class="form-group">
                  <input type="radio" id="return" name="type" value="1" checked>
                  <label for="return">Return</label>
                  <input type="radio" id="replace" name="type" value="2">
                  <label for="replace">Replace</label>
              </div>
              <div class="form-group">
                <div class="custom_select">
                  <select class="form-control" name='quantity' required>
                    <option value="">Quantity...</option>
                    <?php for ($i=1;$i<=$order2_data[0]->quantity;$i++){ ?>
                      <option value="<?=$i?>"><?=$i?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="custom_select">
                  <select class="form-control" name="reason" required>
                    <option value="">Reason...</option>
                    <option value="Defective product received">Defective product received</option>
                    <option value="Wrong product received">Wrong product received </option>
                    <option value="Wrong size received">Wrong size received</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
            <div class="col-lg-12" style="padding:0px;">
              <textarea name="message" cols="70" rows="5" style="width:100%; border:1px solid #ced4da;padding:10px;" placeholder="Enter Your Reason"></textarea>
            </div> <br>
            <h5>Select Your Product Images</h5><br>
            <div class="row">
              <div class="col-md-4 mt-2"><input type="file" name="image1"></div>
              <div class="col-md-4 mt-2"> <input type="file" name="image2"></div>
              <div class="col-md-4 mt-2"> <input type="file" name="image3"></div>
            </div>
            <div class="row">
              <div class="col-md-4 mt-2"><input type="file" name="image4"></div>
              <div class="col-md-4 mt-2"> <input type="file" name="image5"></div>
              <div class="col-md-4 mt-2"> <input type="file" name="image6"></div>
            </div>
            <div class="row mt-5 justify-content-center">
              <div class="col-md-4">
                <button type="submit" class="btn btn-fill-out btn-block">Submit</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================================================== END SECTION SHOP =======================================================-->
</div>
<!-- ========================================================== END MAIN CONTENT =======================================================-->

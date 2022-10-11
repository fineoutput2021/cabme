<!--  ============================ START SECTION BREADCRUMB ======================================================-->
<div class="breadcrumb_section page-title-mini">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url()?>Home/all_blogs">All Blogs</a></li>
          <li class="breadcrumb-item active"><?=$blog_data->heading?></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- ========================================== END SECTION BREADCRUMB =================================================-->

<!-- ========================================== START MAIN CONTENT ===================================================== -->
<div class="main_content">

  <!-- ==========================================  START SECTION BLOG  =================================================== -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="single_post text-center">
            <h2 class="blog_title"><?=$blog_data->heading?></h2>
            <div class="blog_img">
              <img src="<?=base_url().$blog_data->image?>" alt="blog_img1">
            </div>
            <div class="blog_content">
              <div class="blog_text text-justify">
                <p><?=$blog_data->full_description?></p>
              </div>
            </div>

            <!-- ========================================START RELATED BLOGS =================================================== -->
            <div class="related_post mt-5 mb-4">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <div class="heading_s1 text-center">
                    <h2>Related Blogs</h2>
                    <img src="<?=base_url()?>assets/frontend/images/under.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="false" data-dots="false" data-nav="true" data-autoplay="true" data-margin="20"
                    data-responsive='{"0":{"items": "2"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    <?php $i=1; foreach($related_data->result() as $related) { ?>
                    <div class="item">
                      <div class="blog_post blog_style2 box_shadow1">
                        <div class="blog_img">
                          <a href="<?=base_url()?>Home/blog_details/<?=base64_encode($related->id)?>">
                            <img src="<?=base_url().$related->image?>" alt="<?=$related->heading?>">
                          </a>
                        </div>
                        <div class="blog_content bg-white">
                          <div class="blog_text">
                            <h5 class="blog_title text-2"><a href="<?=base_url()?>Home/blog_details/<?=base64_encode($related->id)?>"><?=$related->heading?></a></h5>
                            <p class="text-4"><?=$blog_data->description?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php $i++; }  ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- ======================================== END RELATED BLOGS =================================================== -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- END SECTION BLOG -->

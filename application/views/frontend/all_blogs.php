<!--  ============================ START SECTION BREADCRUMB ======================================================-->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">

      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item active">All Blogs</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- ========================================== END SECTION BREADCRUMB =================================================-->

<!-- ========================================== START MAIN CONTENT ===================================================== -->
<div class="main_content">

  <!-- ==========================================  START SECTION BLOG  =================================================== -->
  <div class="section">
    <div class="container">
      <div class="row">

        <?php $i=1; foreach($blog_data->result() as $blog) { ?>
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="blog_post blog_style2 box_shadow1">
            <div class="blog_img">
              <a href="<?=base_url()?>Home/blog_details/<?=base64_encode($blog->id)?>">
                <img src="<?=base_url().$blog->image?>" alt="<?=$blog->heading?>">
              </a>
            </div>
            <div class="blog_content bg-white">
              <div class="blog_text">
                <h6 class="blog_title text-2"><a href="<?=base_url()?>Home/blog_details/<?=base64_encode($blog->id)?>"><?=$blog->heading?></a></h6>
                <p class="text-4"><?=$blog->description?></p>
              </div>
            </div>
          </div>
        </div>
        <?php $i++; } ?>
      </div>
      <div class="row">
        <?php echo $links;?>
      </div>
    </div>
  </div>
  <!-- ==========================================  END SECTION BLOG  =================================================== -->


</div>
<!-- ============================================ END MAIN CONTENT =======================================================-->

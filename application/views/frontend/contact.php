<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION CONTACT -->
    <div class="section pb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-map2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Address</span>
                            <p>Plot no. C-2, Shop No 14,15, Saurav Tower, Gautam Marg, Vaishali Nagar, Jaipur, Rajasthan, 302021</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-envelope-open"></i>
                        </div>
                        <div class="contact_text">
                            <span>Email Address</span>
                            <a href="mailto:contactus@tiarastore.co.in">contactus@tiarastore.co.in</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-tablet2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Phone</span>
                            <a href="tel:+919511351606"><p>+919511351606</p></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->

    <!-- START SECTION CONTACT -->
    <div class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading_s1">
                        <h2>Get In touch</h2>
                    </div>

                    <div class="field_form">
                        <form method="POST" action="<?= base_url() ?>Home/contact_form_submit" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input required placeholder="Enter Name *" class="form-control" name="name" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input required placeholder="Enter Email *" class="form-control" name="email" type="email">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea required placeholder="Message *" class="form-control" name="message" rows="4"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" title="Submit Your Message!" class="btn btn-fill-out" name="submit" value="Submit">Send Message</button>
                                </div>
                                <div class="col-md-12">
                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                    <div id="map" class="" data-zoom="12" data-latitude="40.680" data-longitude="-73.945">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3557.6805537097002!2d75.7434083!3d26.9136315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db36200bedf37%3A0x65718608e95e2659!2sSaurav%20Tower!5e0!3m2!1sen!2sin!4v1664271893681!5m2!1sen!2sin" width="100%" height="400"></iframe> </div>

                        <!-- data-icon="<?= base_url() ?>assets\frontend\images\marker.png" -->

                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->

<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
    }
    //=============================================== Index ==============================================================
    public function index()
    {

        $this->db->select('*');
        $this->db->from('tbl_banner');
        $this->db->order_by('id', 'desc');
        $this->db->where('is_active', 1);
        $data['banner_data']= $this->db->get();


        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/index');
        $this->load->view('frontend/common/footer');
    }

    //================================================= ALL PRODUCTS ======================================
    public function all_products($url, $sort="", $page_index="")
    {
        $product = $this->products->all_products($url, $sort, $page_index);

        // print_r($product['product_data']);die();
        $data['product'] = $product['product_data'];
        $data['links'] = $product['links'];
        $data['category_name'] = $product['category_name'];
        $data['subcategory_name'] = $product['subcategory_name'];
        $data['page_index'] = $page_index;
        $data['url'] = 'all_products/'.$url;
        $data['filter_category'] = $this->db->get_where('tbl_category', array('is_active = ' => 1));
        $data['filter_size'] = $this->db->get_where('tbl_size', array('is_active = ' => 1));
        $data['filter_color'] = $this->db->get_where('tbl_colour', array('is_active = ' => 1));
        $data['filter_main'] = $this->db->get_where('tbl_filters', array('is_active = ' => 1));

        $this->load->view('frontend/common/header2', $data);
        $this->load->view('frontend/all_products');
        $this->load->view('frontend/common/footer2');
    }

    // ============================================ ABOUT =================================================
    public function about()
    {
        $this->db->select('*');
        $this->db->from('tbl_testimonials');
        $this->db->where('is_active', 1);
        $data['testimonials_data']= $this->db->get();
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/about');
        $this->load->view('frontend/common/footer');
    }

      //================================================= FILTERS ON ALL PRODUCTS ======================================
    public function filter_check()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('size[]', 'size[]', 'xss_clean|trim');
            $this->form_validation->set_rules('color[]', 'color[]', 'xss_clean|trim');
            $this->form_validation->set_rules('attribute[]', 'attribute[]', 'xss_clean|trim');
            $this->form_validation->set_rules('category_name', 'category_name', 'xss_clean|trim');
            $this->form_validation->set_rules('products', 'products', 'xss_clean|trim');
            $this->form_validation->set_rules('subcategory_name', 'subcategory_name', 'xss_clean|trim');
            $this->form_validation->set_rules('minprice', 'minprice', 'xss_clean|trim');
            $this->form_validation->set_rules('maxprice', 'maxprice', 'xss_clean|trim');


            if ($this->form_validation->run()== true) {
                $sized=$this->input->post('size[]');
                $color=$this->input->post('color[]');
                $attribute=$this->input->post('attribute[]');
                $category_name=$this->input->post('category_name');
                $subcategory_name=$this->input->post('subcategory_name');
                $minprice=$this->input->post('minprice');
                $maxprice=$this->input->post('maxprice');
                $products = json_decode($this->input->post('products'));
                $filtered = $this->products->filterProducts($sized, $color, $attribute, $products, $minprice, $maxprice);
                $data['sized'] = $sized;
                $data['color'] = $color;
                $data['attribute'] = $attribute;
                $data['product'] = $filtered;
                $data['minprice'] = $minprice;
                $data['maxprice'] = $maxprice;
                $data['sendProducts'] = $products;
                $data['category_name'] = $category_name;
                $data['subcategory_name'] = $subcategory_name;
                $data['filter_category'] = $this->db->get_where('tbl_category', array('is_active = ' => 1));
                $data['filter_size'] = $this->db->get_where('tbl_size', array('is_active = ' => 1));
                $data['filter_color'] = $this->db->get_where('tbl_colour', array('is_active = ' => 1));
                $data['filter_main'] = $this->db->get_where('tbl_filters', array('is_active = ' => 1));

                $this->load->view('frontend/common/header2', $data);
                $this->load->view('frontend/filter_products');
                $this->load->view('frontend/common/footer2');
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }



    // =========================================== MY PROFILE ===============================================
    public function my_profile()
    {
        if (!empty($this->session->userdata('user_type'))) {
            if ($this->session->userdata('user_type')==2) {
                $data['user_data']= $this->db->get_where('tbl_reseller', array('id = ' => $this->session->userdata('user_id')))->result();
            } else {
                $data['user_data']= $this->db->get_where('tbl_users', array('id = ' => $this->session->userdata('user_id')))->result();
            }
            if (!empty($data['user_data'])) {
                if ($data['user_data'][0]->is_active==1) {
                  if ($this->session->userdata('user_type')==2) {
                    $data['order1_dataa'] = $this->db->order_by('id', 'desc')->get_where('tbl_order1', array('reseller_id = ' => $this->session->userdata('user_id'), 'order_status != '=>0));
                  } else {
                      $data['order1_dataa'] = $this->db->order_by('id', 'desc')->get_where('tbl_order1', array('user_id = ' => $this->session->userdata('user_id'), 'order_status != '=>0));
                  }


                    $data['model_table'] = $this->db->get_where('tbl_model_products', array('user_id = ' => $this->session->userdata('user_id')));
                    $data['model_data_exists'] = $data['model_table']->result();

                    $this->load->view('frontend/common/header', $data);
                    $this->load->view('frontend/my_profile');
                    $this->load->view('frontend/common/footer');
                } else {
                    $Logout = $this->login->UserOtpLogout();
                    $this->session->set_flashdata('emessage', 'Your account is inactive! Please contact admin');
                    redirect("/", "refresh");
                }
            } else {
                $Logout = $this->login->UserOtpLogout();
                $this->session->set_flashdata('emessage', 'User not found');
                redirect("/", "refresh");
            }
        }
    }

    // ============================================ ORDER DETAILS ======================================================
    public function order_details($idd)
    {
        if (!empty($this->session->userdata('user_data'))) {
            $id=base64_decode($idd);
            $data['order_detail'] = $this->db->get_where('tbl_order2', array('main_id = ' => $id));
            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/order_details');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("/", "refresh");
        }
    }

    //============================================= VIEW CART ========================================================
    public function my_bag()
    {
        if (!empty($this->session->userdata('user_data'))) {
            $cart_fetch = $this->cart->ViewCartOnline();
        } else {
            $cart_fetch = $this->cart->ViewCartOffline();
        }
        $this->load->view('frontend/common/header', $cart_fetch);
        $this->load->view('frontend/cart');
        $this->load->view('frontend/common/footer');
    }

    public function contact_form_submit()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'name', 'xss_clean|trim');
            $this->form_validation->set_rules('message', 'message', 'xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $name=$this->input->post('name');
                $message=$this->input->post('message');
                $email=$this->input->post('email');
                $response_entry = $this->forms->contactFormSubmit($name, $message, $email);
                redirect("/", "refresh");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    //================================== SUBCRIBED TO NEWSLETTER =====================================
    public function subscribe_data()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');

            if ($this->form_validation->run()== true) {
                $email=$this->input->post('email');
                $subscribeentry = $this->forms->subscribeToUs($email);
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // ============================================== POPUP FORM SUBMIT ==================================================

    public function subscribe_to_popup()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $name=$this->input->post('name');
                $phone=$this->input->post('phone');
                $email=$this->input->post('email');
                $submit_popup = $this->forms->popupFormSubmit($email, $name, $phone);
                redirect('/', 'refresh');
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function reseller_register()
    {
        if (empty($this->session->userdata('user_data'))) {
            $data['state_data'] = $this->db->from('all_states')->get();
            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/register');
            $this->load->view('frontend/common/footer');
        } else {
            redirect('/', 'refresh');
        }
    }


    // ======================================= SEARCH ==================================================
    public function search()
    {
        $string= $this->input->get('search');
        $search_results = $this->products->searchForProducts($string);
        $data['product'] = $search_results['product_data'];
        $data['links'] = $search_results['links'];
        $data['category_name'] = $search_results['category_name'];
        $data['subcategory_name'] = $search_results['subcategory_name'];
        $data['url'] = 'search';
        $data['filter_category'] = $this->db->get_where('tbl_category', array('is_active = ' => 1));
        $data['filter_size'] = $this->db->get_where('tbl_size', array('is_active = ' => 1));
        $data['filter_color'] = $this->db->get_where('tbl_colour', array('is_active = ' => 1));
        $data['filter_main'] = $this->db->get_where('tbl_filters', array('is_active = ' => 1));
        $this->load->view('frontend/common/header2', $data);
        $this->load->view('frontend/all_products');
        $this->load->view('frontend/common/footer2');
    }



    public function product_detail($url)
    {
        $data['type_id']= base64_decode($this->input->get('type'));
        $returnarray = $this->products->product_detail($url);
        $related_products = $this->products->related_products($url);
        $buy_with_it = $this->products->buy_with_it($url);
        $product_reviews = $this->products->productReviews($url);
        $type_datas = $this->db->get_where('tbl_type', array('product_id = ' => $returnarray['product_data'][0]->id, 'is_active = ' =>1));
        $type_data = $type_datas->result();
        $type_dataSize = $this->db->get_where('tbl_type', array('id = ' => $data['type_id']))->result();
        // print_r($type_data);die();
        $color_arr = $this->products->unique_multidim_array($type_data, 'colour_id');
        $size_arr = $this->products->getColorSize($type_data[0]->product_id, $type_dataSize[0]->colour_id);
        $data['buy_with_it'] = $buy_with_it;
        $data['related_data'] = $related_products;
        $data['product_reviews'] = $product_reviews;
        $data['product_data'] = $returnarray['product_data'];
        $data['color_arr'] = $color_arr;
        $data['size_arr'] = $size_arr;
        if (!empty($returnarray['type_exists'])) {
            $this->load->view('frontend/common/header2', $data);
            $this->load->view('frontend/product_details');
            $this->load->view('frontend/common/footer2');
        } else {
            $this->session->set_flashdata('emessage', 'Product not found');
            redirect("/", "refresh");
        }
    }

    public function my_wishlist()
    {
        $wishlist_data = $this->wishlist->ViewWishlist();
        $this->load->view('frontend/common/header', $wishlist_data);
        $this->load->view('frontend/wishlist');
        $this->load->view('frontend/common/footer');
    }

    public function error404()
    {
        $this->load->view('errors/error404');
    }

    //==================================================== ALL BLOGS ====================================================
    public function all_blogs()
    {
        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'DESC');
        $data['blog_data']= $this->db->get();

        $this->load->view('frontend/common/header2', $data);
        $this->load->view('frontend/all_blogs');
        $this->load->view('frontend/common/footer2');
    }

    //==================================================== BLOG DETAILS ====================================================

    public function blog_details($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;

        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('id', $id);
        $this->db->where('is_active', 1);
        $data['blog_data']= $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('tbl_blog');
        $this->db->where('id !=', $id);
        $this->db->where('is_active', 1);
        $this->db->limit(10);
        $data['related_data']= $this->db->get();

        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/blog_details');
        $this->load->view('frontend/common/footer');
    }

    // ==================================== SUBMIT PRODUCT REVIEW ===================================================
    public function product_review()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('product_data', 'product_data', 'required|xss_clean|trim');
            $this->form_validation->set_rules('message', 'message', 'required|xss_clean|trim');
            $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('star_rating', 'star_rating', 'required|xss_clean|trim');


            if ($this->form_validation->run()== true) {
                $product_data=$this->input->post('product_data');
                $message=$this->input->post('message');
                $name=$this->input->post('name');
                $email=$this->input->post('email');
                $star_rating=$this->input->post('star_rating');

                $submit_review = $this->forms->submitProductReview($product_data, $message, $name, $email, $star_rating);
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function contact()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/contact');
        $this->load->view('frontend/common/footer');
    }

    public function term_and_condition()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/term_and_condition');
        $this->load->view('frontend/common/footer');
    }

    public function sign_in()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/login');
        $this->load->view('frontend/common/footer');
    }
    ///=============================== GET SIZE BY COLOR =======================
    public function GetSize()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('color_id', 'color_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $color_id=$this->input->post('color_id');
                $product_id=$this->input->post('product_id');
                $size_arr = $this->products->getColorSize($product_id, $color_id);
                $respone['status'] = true;
                $respone['data'] = $size_arr;
                echo json_encode($respone);
            } else {
                $respone['status'] = false;
                $respone['message'] =validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] ="Please insert some data, No data available";
            echo json_encode($respone);
        }
    }
}

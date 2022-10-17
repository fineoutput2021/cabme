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
        $this->load->library("custom/Booking");
    }
    //=============================================== Index ==============================================================
    public function index()
    {
        $data['banner_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_banner', array('is_active'=> 1))->result();
        $data['testimonials_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_testimonials', array('is_active'=> 1))->result();
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/index');
        $this->load->view('frontend/common/footer');
    }
    //================================================= SELF DRIVE CARS ======================================
    public function self_drive_cars()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $duration=$this->input->post('duration');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $data_insert = array(
              'city_id'=>$city_id,
              'start_date'=>$start_date,
              'start_time'=>$start_time,
              'end_date'=>$end_date,
              'end_time'=>$end_time,
              'duration'=>$duration,
              'date'=>$cur_date,
                        );
                $last_id=$this->base_model->insert_table("tbl_search", $data_insert, 1) ;
                $id = base64_encode($last_id);
                redirect("Home/show_self_drive_cars/$id");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //========================== self drive cars ============================
    public function show_self_drive_cars($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        $search = $this->db->get_where('tbl_search', array('id'=> $id))->result();
        $send= array(
        'city_id'=>$search[0]->city_id,
        'start_date'=>$search[0]->start_date,
        'start_time'=>$search[0]->start_time,
        'end_date'=>$search[0]->end_date,
        'end_time'=>$search[0]->end_time,
        'duration'=>$search[0]->duration,
        // 'index'=>$index,
      );
        $car_data = $this->booking->ViewSelfDriveCars($send);
        $data['car_data']= $car_data['car_data'];
        $data['search']= $search;
        $this->load->view('frontend/common/header2', $data);
        $this->load->view('frontend/self_drive_cars');
        $this->load->view('frontend/common/footer');
    }
    //========================== self drive cars ============================
    public function self_drive_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('car_id', 'car_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('search_id', 'search_id', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $duration=$this->input->post('duration');
                $city_id=$this->input->post('city_id');
                $car_id=$this->input->post('car_id');
                $type_id=$this->input->post('type_id');
                $search_id=$this->input->post('search_id');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $send = array(
              'city_id'=>$city_id,
              'start_date'=>$start_date,
              'start_time'=>$start_time,
              'end_date'=>$end_date,
              'end_time'=>$end_time,
              'duration'=>$duration,
              'city_id'=>$city_id,
              'car_id'=>$car_id,
              'type_id'=>$type_id,
              'search_id'=>$search_id,
                        );
                $response = $this->booking->selfDriveCarCalculate($send);
                $id = base64_encode($response['id']);
                redirect("Home/self_drive_summary/$id");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //========================== SELF DRIVE SUMMARY =============================
    public function self_drive_summary($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        $self = $this->db->get_where('tbl_selfdrive', array('id'=> $data['booking_data'][0]->car_id))->result();
        $data['user_data'] = $this->db->get_where('tbl_users', array('id'=> $data['booking_data'][0]->user_id))->result();
        //-----========= city data =============
        $city = $this->db->get_where('tbl_cities', array('id'=> $data['booking_data'][0]->city_id))->result();
        $data['city_data']=$city;
        //------ fuel type ---
        if ($self[0]->fule_type==1) {
            $fuel_type = 'Petrol';
        } elseif ($self[0]->fule_type==2) {
            $fuel_type = 'Diesel';
        } else {
            $fuel_type = 'CNG';
        }
        //------ Transmission  ---
        if ($self[0]->transmission==1) {
            $transmission = 'Manual';
        } elseif ($self[0]->transmission==2) {
            $transmission = 'Automatic';
        }
        //------ seating  ---
        if ($self[0]->seatting==1) {
            $seating = '4 Seates';
        } elseif ($self[0]->seatting==2) {
            $seating = '5 Seates';
        } else {
            $seating = '7 Seates';
        }
        $days =$data['booking_data'][0]->duration*24;
        $car_data= array(
                      'brand_name'=>$self[0]->brand_name,
                      'car_name'=>$self[0]->car_name,
                      'photo'=>$self[0]->photo,
                      'fuel_type'=>$fuel_type,
                      'transmission'=>$transmission,
                      'seating'=>$seating,
                      'kilometer1'=>$self[0]->kilometer1*$days,
                            'price1'=>$self[0]->price1*$days,
                            'kilometer2'=>$self[0]->kilometer2*$days,
                            'price2'=>$self[0]->price2*$days,
                            'kilometer3'=>$self[0]->kilometer3*$days,
                            'price3'=>$self[0]->price3*$days,
                      'extra_kilo'=>$self[0]->extra_kilo,
                      );
        $data['car_data']=$car_data;
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/self_summary');
        $this->load->view('frontend/common/footer');
    }
    // ============ SELF DRIVE CHECKOUT ==========================
    public function self_checkout($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        $data_update = array('order_status'=>1,
            'payment_status'=>1,
              );
        $this->db->where('id', $id);
        $zapak=$this->db->update('tbl_booking', $data_update);
        $booking_data = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        $data['booking_id']=$booking_data[0]->id;
        $data['amount']=$booking_data[0]->final_amount;
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/booking_success');
        $this->load->view('frontend/common/footer');
    }
    //======== Intercity calculate ===========
    public function intercity_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('cab_type', 'cab_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $cab_type=$this->input->post('cab_type');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $city_id=$this->input->post('city_id');
                $duration=$this->input->post('duration');
$response = $this->booking->intercityCalculate($cab_type, $start_date, $start_time, $end_date, $end_time, $city_id, $duration);
echo json_encode($response);
            } else {
    $res = array('message'=>validation_errors(),
    'status'=>201
    );
                echo json_encode($res);
            }
        } else {
            $res = array('message'=>"Please insert some data, No data available",
'status'=>201
);
            echo json_encode($res);
        }
    }
    //======== Intercity calculate ===========
    public function intercity_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amount', 'amount', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $id=base64_decode($this->input->post('id'));
                $amount=$this->input->post('amount');
                  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $name=$this->session->userdata('name');
                  $email=$this->session->userdata('email');
                  $phone=$this->session->userdata('phone');
                  $posted['key'] = MERCHANT_KEY;
                  $posted['txnid'] = $txnid;
                  $posted['amount'] = $amount;
                  $posted['productinfo'] = 'Cabme';
                  $posted['firstname'] = $name;
                  $posted['email'] = $email;
                  $posted['phone'] = $phone;
                  $posted['surl'] = base_url().'Home/intercity_succss';
                  $posted['furl'] = $email;
                  $posted['service_provider'] = 'payu_paisa';
                // Hash Sequence
                $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

                	$hashVarsSeq = explode('|', $hashSequence);
                    $hash_string = '';
                	foreach($hashVarsSeq as $hash_var) {
                      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                      $hash_string .= '|';
                    }
                    $hash_string .= SALT;


                    $hash = strtolower(hash('sha512', $hash_string));
                    $action = PAYU_BASE_URL . '/_payment';

                    $hash = strtolower(hash('sha512', $hash_string));
            } else {
    $res = array('message'=>validation_errors(),
    'status'=>201
    );
                echo json_encode($res);
            }
        } else {
            $res = array('message'=>"Please insert some data, No data available",
'status'=>201
);
            echo json_encode($res);
        }
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
        if (!empty($this->session->userdata('user_data'))) {
            $data['user_data']= $this->db->get_where('tbl_users', array('id = ' => $this->session->userdata('user_id')))->result();
            if (!empty($data['user_data'])) {
                if ($data['user_data'][0]->is_active==1) {
                    $data['booking_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_booking', array('user_id = ' => $this->session->userdata('user_id'), 'order_status != '=>0))->result();
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
        } else {
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
    public function error404()
    {
        $this->load->view('errors/error404');
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
}

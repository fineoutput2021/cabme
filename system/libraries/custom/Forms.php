<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_Forms
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->model("admin/login_model");
        $this->CI->load->model("admin/base_model");
    }

    // =============================== CONTACT FORM SUBMIT ============================================
    public function contactFormSubmit($name, $message, $email)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $data_insert = array('name'=>$name,
         'email'=>$email,
         'message'=>$message,
         'ip'=>$ip,
         'date'=>$cur_date
       );
        $last_id=$this->CI->base_model->insert_table("tbl_contact_us", $data_insert, 1) ;
        if ($last_id!=0) {
            $this->CI->session->set_flashdata('smessage', "Thank you for contacting us! We will get back to you soon");
            return 1;
        } else {
            $this->CI->session->set_flashdata('emessage', "Some unknown error occurred");
            return 0;
        }
    }

    // ================================= SUBSCRIBE TO US FORM SUBMIT ==============================================
    public function subscribeToUs($email)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $data_insert = array(
          'email'=>$email,
          'date'=>$cur_date,
          'ip' =>$ip,
          'is_active' =>1,
          );
        $last_id=$this->CI->base_model->insert_table("tbl_subscribe", $data_insert, 1) ;
        if ($last_id!=0) {
            $this->CI->session->set_flashdata('smessage', 'Subscribed successfully!');
            return 1;
        } else {
            $this->CI->session->set_flashdata('emessage', 'Sorry error occurred');
            return 1;
        }
    }

    //================================= POPUP FORM SUBMIT ==============================================
    public function popupFormSubmit($email, $name, $phone)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $inser = array('email'=>$email, 'name'=>$name, 'phone'=>$phone, 'ip'=>$ip, 'date'=>$cur_date);
        $last_id=$this->CI->base_model->insert_table("tbl_popup", $inser, 1);
        if ($last_id!=0) {
            $this->CI->session->set_flashdata('smessage', 'Thank you for your response!');
            return 1;
        } else {
            $this->CI->session->set_flashdata('emessage', 'Some unknown error occurred');
            return 1;
        }
    }


    //================================= PRODUCT REVIEWW SUBMIT ==============================================
    public function submitProductReview($product_data, $message, $name, $email, $star_rating)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $inser = array('product_id'=>$product_data, 'review'=>$message, 'name'=>$name, 'email'=>$email, 'star_rating'=>$star_rating, 'ip'=>$ip, 'date'=>$cur_date);
        $last_id=$this->CI->base_model->insert_table("tbl_product_review", $inser, 1);
        if ($last_id!=0) {
            $this->CI->session->set_flashdata('smessage', 'Thank you for your response!');
            return 1;
        } else {
            $this->CI->session->set_flashdata('emessage', 'Some unknown error occurred');
            return 1;
        }
    }


    //================================= REDEEM REFER POINTS SUBMIT ==============================================
    public function redeemModelPoints($points, $accountnumber, $ifsccode, $redeem_points)
    {
        $model_id = $this->CI->session->userdata('user_id');
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        if ($redeem_points >= MINREDEEM_POINTS) {
            $user_data = $this->CI->db->get_where('tbl_users', array('id = ' => $model_id))->result();
            if ($user_data[0]->total_points >= $redeem_points) {
                $check_previous_req = $this->CI->db->get_where('tbl_points_transation', array('model_id = ' => $model_id, 'status'=>0))->result();
                if (empty($check_previous_req)) {
                    $insert_point_request = array('model_id'=>$model_id, 'available_points'=>$user_data[0]->total_points, 'req_points'=>$redeem_points,'status'=>0, 'date'=>$cur_date, 'ip'=>$ip);
                    $last_id=$this->CI->base_model->insert_table("tbl_points_transation", $insert_point_request, 1);
                    if ($last_id!=0) {
                      $this->CI->session->set_flashdata('smessage', 'Request submitted successfully!');
                    } else {
                      $this->CI->session->set_flashdata('emessage', 'Some unknown error occurred');
                    }
                } else {
                    $this->CI->session->set_flashdata('emessage', 'Request to redeem points already submitted!');
                }
            } else {
                $this->CI->session->set_flashdata('emessage', 'Sorry! Not enough points available');
            }
        } else {
            $this->CI->session->set_flashdata('emessage', 'Minimum '.MINREDEEM_POINTS.' points should be redeemed');
        }
    }
}

<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Logincontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library('pagination');
        $this->load->library('custom/Login');
    }
     //======================================= USER REGISTER PROCESS===================================//
     public function register_process()
     {
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->load->helper('security');
         if ($this->input->post()) {
             $this->form_validation->set_rules('fname', 'fname', 'required|xss_clean|trim');
             $this->form_validation->set_rules('lname', 'lname', 'required|xss_clean|trim');
             $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
             $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
             if ($this->form_validation->run()== true) {
                 $fname=$this->input->post('fname');
                 $lname=$this->input->post('lname');
                $email=$this->input->post('email');
                $phone=$this->input->post('phone');
                 //-------------- register user  with otp ------------
                 $Register = $this->login->RegisterWithOtp($fname, $lname, $phone, $email);
                 echo $Register;
             } else {
                 $respone['status'] = false;
                 $respone['message'] = validation_errors();
                 echo json_encode($respone);
             }
         } else {
             $respone['status'] = false;
             $respone['message'] = 'Please insert some data';
             echo json_encode($respone);
         }
     }
     //============================== USER REGISTER OTP VERIFY =====================================//
    public function register_otp_verify()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
            $this->form_validation->set_rules('otp', 'otp', 'required|xss_clean|trim');
          
            if ($this->form_validation->run()== true) {
                $phone=$this->input->post('phone');
                $otp=$this->input->post('otp');
              
            
                //-------------- register otp verify ------------
                $RegisterVerify = $this->login->RegisterOtpVerify($phone, $otp);
                // redirect($_SERVER['HTTP_REFERER']);
                echo $RegisterVerify;
            } else {
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
          
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data';
            echo json_encode($respone);
        }
    }
    //==================================== USER LOGIN PROCESS ========================================//
    public function login_process()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $phone=$this->input->post('phone');
                //------ user login send otp ----------
                $Login = $this->login->LoginWithOtp($phone);
                echo $Login;
      } else {
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data';
            echo json_encode($respone);
        }
    }
    //======================================= USER LOGIN OTP VERIFY =======================================//
    public function login_otp_verify()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
            $this->form_validation->set_rules('otp', 'otp', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $phone=$this->input->post('phone');
                $otp=$this->input->post('otp');
                //-------------- register otp verify ------------
                $LoginVerify = $this->login->LoginOtpVerify($phone, $otp);
                echo $LoginVerify;
            } else {
                $respone['status'] = false;
                $respone['message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Please insert some data';
            echo json_encode($respone);
        }
    }
}
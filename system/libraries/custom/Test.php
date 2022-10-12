<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
        // require_once(APPPATH.'libraries\custom\Login');
        // include APPPATH."libraries/custom\Login.php";
        // $this->load->library('custom/Login');
        // $this->load->library('custom/Login');
        // $this->load->library('custom/Forms');
    }
    //=============================================== USER REGISTER =============================================================
    public function RegisterWithOtp($fname, $lname, $phone)
    {
      echo $phone;die();
    }

}

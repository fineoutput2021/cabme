<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Contact_Us extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
    }
    //====================view_contact_us==================\\
    public function view_contact_us()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_contact_us');
            $this->db->order_by('id', 'desc');
            $data['contact_us_data']= $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/contact_us/view_contact_us');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
}

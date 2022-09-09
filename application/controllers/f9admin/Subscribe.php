<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Subscribe extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //========================view_banner======================\\
    public function view_subscribe()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_subscribe');
            $this->db->order_by('id', 'desc');
            //$this->db->where('id',$usr);
            $data['subscribe_data']= $this->db->get();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/subscribe/view_subscribe');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
}

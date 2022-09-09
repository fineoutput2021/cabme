<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Users extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    public function view_users()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->order_by('id', 'desc');
            //$this->db->where('id',$usr);
            $data['users_data']= $this->db->get();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/users/view_users');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function delete_users($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_users', array('id' => $id));
                $zapak=$this->db->delete('tbl_cart', array('user_id' => $id));
                $zapak=$this->db->delete('tbl_wishlist', array('user_id' => $id));
                if ($zapak!=0) {
                    // $path = FCPATH . "assets/public/users/".$img;
                    // unlink($path);
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/users/view_users", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            } else {
                $data['e']="Sorry You Don't Have Permission To Delete Anything.";
                // exit;
                $this->load->view('errors/error500admin', $data);
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    public function updateusersStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
                       'is_active'=>1

                       );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_users', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/users/view_users", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            }
            if ($t=="inactive") {
                $data_update = array(
                        'is_active'=>0

                        );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_users', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/users/view_users", "refresh");
                } else {
                    $data['e']="Error occurred";
                    // exit;
                    $this->load->view('errors/error500admin', $data);
                }
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
}

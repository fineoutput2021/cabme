<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Intercity extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //================================VIEW INTERCITY===================================
    public function View_intercity()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_intercity');
            //$this->db->where('id',$usr);
            $data['intercity_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/intercity/View_intercity');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================ADD INTERCITY===================================
    public function Add_intercity()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/intercity/Add_intercity');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================ADD INTERCITY DATA===================================
    public function add_intercity_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('cab_type', 'cab_type', 'required|xss_clean|trim');
                $this->form_validation->set_rules('price', 'price', 'required|xss_clean|trim');
                $this->form_validation->set_rules('Kilomitere_cab', 'Kilomitere_cab', '');
                $this->form_validation->set_rules('min_amount', 'min_amount', 'required|xss_clean|trim');
                if ($this->form_validation->run()== true) {
                    $cab_type=$this->input->post('cab_type');
                    $price=$this->input->post('price');
                    $Kilomitere_cab=$this->input->post('Kilomitere_cab');
                    $min_amount=$this->input->post('min_amount');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");
                    $addedby=$this->session->userdata('admin_id');
                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('cab_type'=>$cab_type,
                        'price'=>$price,
                        'Kilomitere_cab'=>$Kilomitere_cab,
                        'min_amount'=>$min_amount,
                              // 'ip' =>$ip,
                              // 'added_by' =>$addedby,
                              'is_active' =>1,
                              // 'date'=>$cur_date
                              );
                        // die();
                        $last_id=$this->base_model->insert_table("tbl_intercity", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Intercity/View_intercity", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        $data_insert = array('cab_type'=>$cab_type,
                        'price'=>$price,
                        'Kilomitere_cab'=>$Kilomitere_cab,
                        'min_amount'=>$min_amount,
                              );
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_intercity', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');
                            redirect("dcadmin/Intercity/View_intercity", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                } else {
                    $this->session->set_flashdata('emessage', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================UPDATE INTERCITY===================================
    public function Update_intercity($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_intercity');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['intercity']=$dsa->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/intercity/Update_intercity');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================DELETE INTERCITY===================================
    public function delete_intercity($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_intercity', array('id' => $id));
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Intercity/View_intercity", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            } else {
                $this->session->set_flashdata('emessage', "Sorry You Don't Have Permission To Delete Anything");
                redirect("dcadmin/Intercity/View_intercity", "refresh");
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    //================================UPDATE STATUS INTERCITY===================================
    public function updateintercityStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            if ($t=="active") {
                $data_update = array(
                               'is_active'=>1
                               );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_intercity', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                if ($zapak!=0) {
                    redirect("dcadmin/Intercity/View_intercity", "refresh");
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
                $zapak=$this->db->update('tbl_intercity', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                if ($zapak!=0) {
                    redirect("dcadmin/Intercity/View_intercity", "refresh");
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
//==============================END INTERCITY=========================================

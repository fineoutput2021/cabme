<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Subcategory extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //===============================view_subcategory========================\\
    public function view_subcategory()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_subcategory');

            $data['subcategory_data']= $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/subcategory/view_subcategory');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=============================add_subcategory========================\\
    public function add_subcategory()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('is_active', 1);
            $data['category_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/subcategory/add_subcategory');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================add_subcaategory_data===================\\
    public function add_subcategory_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('category_id', 'category_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');


                if ($this->form_validation->run()== true) {
                    $category_id=$this->input->post('category_id');
                    $name=$this->input->post('name');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    $sub = explode(" ", $name);
                    $url = implode("-", $sub);
                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('name'=>$name,
                                  'category_id'=>$category_id,
                                  'url'=>$url,
                                  'ip' =>$ip,
                                  'added_by' =>$addedby,
                                  'is_active' =>1,
                                  'date'=>$cur_date

                                  );





                        $last_id=$this->base_model->insert_table("tbl_subcategory", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Subcategory/view_subcategory", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);



                        $data_insert = array('name'=>$name,
                                  'category_id'=>$category_id,
                                  'url'=>$url
                                );
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_subcategory', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');

                            redirect("dcadmin/Subcategory/view_subcategory", "refresh");
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
    //============================update_subcategory======================\\
    public function update_subcategory($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $this->db->select('*');
            $this->db->from('tbl_category');

            $data['category_data']= $this->db->get();
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_subcategory');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['subcategory']=$dsa->row();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/subcategory/update_subcategory');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==============================delete_subcategory=====================\\
    public function delete_subcategory($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $this->db->select('*');
                $this->db->from('tbl_product');
                $this->db->where('subcategory_id', $id);
                $pro_delete= $this->db->get();
                foreach ($pro_delete->result() as $pro) {
                    $zapak1=$this->db->delete('tbl_cart', array('product_id' => $pro->id));
                    $zapak1=$this->db->delete('tbl_wishlist', array('product_id' => $pro->id));
                }
                $zapak=$this->db->delete('tbl_subcategory', array('id' => $id));
                $zapak2=$this->db->delete('tbl_product', array('subcategory_id' => $id));
                $this->session->set_flashdata('smessage', 'Data Deleted successfully');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $data['e']="Sorry You Don't Have Permission To Delete Anything.";
                // exit;
                $this->load->view('errors/error500admin', $data);
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    //==============================update_status=======================\\
    public function updatesubcategoryStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
                                 'is_active'=>1
                                 );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_subcategory', $data_update);

                $this->db->where('subcategory_id', $id);
                $zapakPro=$this->db->update('tbl_product', array('subcat_active'=>1));

                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Subcategory/view_subcategory", "refresh");
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
                $zapak=$this->db->update('tbl_subcategory', $data_update);

                $this->db->where('subcategory_id', $id);
                $zapakPro=$this->db->update('tbl_product', array('subcat_active'=>0));

                $this->db->select('*');
                $this->db->from('tbl_product');
                $this->db->where('subcategory_id', $id);
                $pro_delete= $this->db->get();
                foreach ($pro_delete->result() as $pro) {
                    $zapak1=$this->db->delete('tbl_cart', array('product_id' => $pro->id));
                    $zapak1=$this->db->delete('tbl_wishlist', array('product_id' => $pro->id));
                }

                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Subcategory/view_subcategory", "refresh");
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

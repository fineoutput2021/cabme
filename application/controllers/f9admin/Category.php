<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Category extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library("upload");
    }
    //====================view_category==================\\
    public function view_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_category');

            $data['category_data']= $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/category/view_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=======================add category==================\\
    public function add_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/category/add_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //===================add_category_data======================\\
    public function add_category_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');

                if ($this->form_validation->run()== true) {
                    $name=$this->input->post('name');


                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');


                    $img1='image';
                    $nnnn = '';

                    $file_check=($_FILES['image']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/category/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="category_image".date("Ymdhms");
                        $this->upload_config = array(
                                'upload_path'   => $image_upload_folder,
                                'file_name' => $new_file_name,
                                'allowed_types' =>'jpg|jpeg|png',
                                'max_size'      => 25000
                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img1)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            // echo $upload_error;
                            $this->session->set_flashdata('emessage', $upload_error);
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/category/".$new_file_name.$file_info['file_ext'];
                            $nnnn=$videoNAmePath;
                        }
                    }
                    //==========================================iamge upload2
                    $img2='image2';
                    $nnnn2 = '';

                    $file_check=($_FILES['image2']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/category/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="category_image2".date("Ymdhms");
                        $this->upload_config = array(
                                'upload_path'   => $image_upload_folder,
                                'file_name' => $new_file_name,
                                'allowed_types' =>'jpg|jpeg|png',
                                'max_size'      => 25000
                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img2)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            // echo $upload_error;
                            $this->session->set_flashdata('emessage', $upload_error);
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/category/".$new_file_name.$file_info['file_ext'];
                            $nnnn2=$videoNAmePath;
                        }
                    }

                    $cat = explode(" ", $name);
                    $url = implode("-", $cat);


                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('name'=>$name,
                        'image'=>$nnnn,
                        'image2'=>$nnnn2,
                        'url'=>$url,
                          'ip' =>$ip,
                                'added_by' =>$addedby,
                                'is_active' =>1,
                                'date'=>$cur_date

                                );


                        $last_id=$this->base_model->insert_table("tbl_category", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Category/view_category", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        $this->db->select('*');
                        $this->db->from('tbl_category');
                        $this->db->where('id', $idw);
                        $pro_data= $this->db->get()->row();
                        if (empty($nnnn)) {
                            $nnnn=$pro_data->image;
                        }
                        if (empty($nnnn2)) {
                            $nnnn2=$pro_data->image2;
                        }
                        $data_insert = array('name'=>$name,
                              'image'=>$nnnn,
                              'image2'=>$nnnn2,
                              'url'=>$url,
                                          );
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_category', $data_insert);

                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');
                            redirect("dcadmin/Category/view_category", "refresh");
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
    //=========================update_category==========================\\
    public function update_category($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['category']=$dsa->row();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/category/update_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=====================delete_category=====================\\
    public function delete_category($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {

                // if ($zapak!=0) {
                $this->session->set_flashdata('smessage', 'Data deleted successfully');
                $this->db->select('*');
                $this->db->from('tbl_product');
                $this->db->where('category_id', $id);
                $pro_delete= $this->db->get();
                foreach ($pro_delete->result() as $pro) {
                    $zapak1=$this->db->delete('tbl_cart', array('product_id' => $pro->id));
                    $zapak1=$this->db->delete('tbl_wishlist', array('product_id' => $pro->id));
                }
                $zapak=$this->db->delete('tbl_category', array('id' => $id));
                $zapak=$this->db->delete('tbl_subcategory', array('category_id' => $id));
                $zapak2=$this->db->delete('tbl_product', array('category_id' => $id));
                redirect("dcadmin/category/view_category", "refresh");
            // } else {
                //     echo "Error";
                //     exit;
                // }
            } else {
                $data['e']="Sorry You Don't Have Permission To Delete Anything.";
                // exit;
                $this->load->view('errors/error500admin', $data);
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    public function updatecategoryStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
       'is_active'=>1

       );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_category', $data_update);

                $this->db->where('category_id', $id);
                $zapakPro=$this->db->update('tbl_product', array('cat_active'=>1));

                $this->session->set_flashdata('smessage', 'Status updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Category/view_category", "refresh");
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
                $zapak=$this->db->update('tbl_category', $data_update);

                $this->db->where('category_id', $id);
                $zapakPro=$this->db->update('tbl_product', array('cat_active'=>0));

                $this->db->select('*');
                $this->db->from('tbl_product');
                $this->db->where('category_id', $id);
                $pro_delete= $this->db->get();
                foreach ($pro_delete->result() as $pro) {
                    $zapak1=$this->db->delete('tbl_cart', array('product_id' => $pro->id));
                    $zapak1=$this->db->delete('tbl_wishlist', array('product_id' => $pro->id));
                }
                
                $this->session->set_flashdata('smessage', 'Status updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/Category/view_category", "refresh");
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

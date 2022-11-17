<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Self_drive extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
        $this->load->library('upload');
    }
    //======================================VIEW DRIVE=================================//
    public function view_selfdrive()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_selfdrive');
            $data['Self_drive_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/self_drive/view_selfdrive');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //======================================ADD DRIVE=================================//
    public function add_selfdrive()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_cities');
            $this->db->where('is_active', 1);
            $data['cities_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/self_drive/add_selfdrive');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //======================================ADD DATA DRIVE=================================//
    public function add_selfdrive_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->library('upload');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('brand_name', 'brand_name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('car_name', 'car_name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('fule_type', 'fule_type', 'required|xss_clean|trim');
                $this->form_validation->set_rules('transmission', 'transmission', 'required|xss_clean|trim');
                $this->form_validation->set_rules('seatting', 'seatting', 'required|xss_clean|trim');
                $this->form_validation->set_rules('kilometer1', 'kilometer1', 'required|xss_clean|trim');
                $this->form_validation->set_rules('price1', 'price1', 'required|xss_clean|trim');
                $this->form_validation->set_rules('kilometer2', 'kilometer2', 'required|xss_clean|trim');
                $this->form_validation->set_rules('price2', 'price2', 'required|xss_clean|trim');
                $this->form_validation->set_rules('kilometer3', 'kilometer3', 'required|xss_clean|trim');
                $this->form_validation->set_rules('price3', 'price3', 'required|xss_clean|trim');
                $this->form_validation->set_rules('extra_kilo', 'extra_kilo', 'required|xss_clean|trim');
                $this->form_validation->set_rules('rsda', 'rsda', 'required|xss_clean|trim');
                if ($this->form_validation->run()== true) {
                    $city_id=$this->input->post('city_id');
                    $brand_name=ucfirst($this->input->post('brand_name'));
                    $car_name=$this->input->post('car_name');
                    $fule_type=$this->input->post('fule_type');
                    $transmission=$this->input->post('transmission');
                    $seatting=$this->input->post('seatting');
                    $kilometer1=$this->input->post('kilometer1');
                    $price1=$this->input->post('price1');
                    $kilometer2=$this->input->post('kilometer2');
                    $price2=$this->input->post('price2');
                    $kilometer3=$this->input->post('kilometer3');
                    $price3=$this->input->post('price3');
                    $extra_kilo=$this->input->post('extra_kilo');
                    $rsda=$this->input->post('rsda');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");
                    $addedby=$this->session->userdata('admin_id');
                    $image="";
                    $img1='photo';
                    $file_check=($_FILES['photo']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/self_drive/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="category".date("Ymdhms");
                        $this->upload_config = array(
                          'upload_path'   => $image_upload_folder,
                          'file_name' => $new_file_name,
                          'allowed_types' =>'jpg|jpeg|png',
                          'max_size'      => 25000
                  );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img1)) {
                            $upload_error = $this->upload->display_errors();
                            $this->session->set_flashdata('emessage', $upload_error);
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();
                            $image = "assets/uploads/self_drive/".$new_file_name.$file_info['file_ext'];
                        }
                    }
                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array(
  'city_id'=>$city_id,
'brand_name'=>$brand_name,
'car_name'=>$car_name,
'photo'=>$image,
'fule_type'=>$fule_type,
'transmission'=>$transmission,
'seatting'=>$seatting,
'kilometer1'=>$kilometer1,
'price1'=>$price1,
'kilometer2'=>$kilometer2,
'price2'=>$price2,
'kilometer3'=>$kilometer3,
'price3'=>$price3,
'extra_kilo'=>$extra_kilo,
'rsda'=>$rsda,
'is_active' =>1,
'is_available' =>1,
'date'=>$cur_date
);
                        $last_id=$this->base_model->insert_table("tbl_selfdrive", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Self_drive/view_selfdrive", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        $this->db->select('*');
                        $this->db->from('tbl_selfdrive');
                        $this->db->where('id', $idw);
                        $damm= $this->db->get()->row();
                        if (empty($image)) {
                            $image=$damm->photo;
                        }
//    foreach($damm->result() as $da) {
//      $uid=$da->id;
                        // if($uid==$idw)
                        // {
//
                        //  }
                        // else{
//    echo "Multiple Entry of Same Name";
//       exit;
                        //  }
//     }
                        $data_insert = array(
    'city_id'=>$city_id,
  'brand_name'=>$brand_name,
  'car_name'=>$car_name,
  'photo'=>$image,
  'fule_type'=>$fule_type,
  'transmission'=>$transmission,
  'seatting'=>$seatting,
  'kilometer1'=>$kilometer1,
  'price1'=>$price1,
  'kilometer2'=>$kilometer2,
  'price2'=>$price2,
  'kilometer3'=>$kilometer3,
  'price3'=>$price3,
  'extra_kilo'=>$extra_kilo,
  'rsda'=>$rsda,
);
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_selfdrive', $data_insert);
                    }
                    if ($last_id!=0) {
                        $this->session->set_flashdata('smessage', 'Data inserted successfully');
                        redirect("dcadmin/Self_drive/view_selfdrive", "refresh");
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occured');
                        redirect($_SERVER['HTTP_REFERER']);
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
    //======================================UPDATE DRIVE=================================//
    public function update_selfdrive($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_cities');
            $this->db->where('is_active', 1);
            $data['cities_data']= $this->db->get();
            $this->db->select('*');
            $this->db->from('tbl_selfdrive');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['Self_drive']=$dsa->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/self_drive/update_selfdrive');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //======================================DELETE DRIVE=================================//
    public function delete_drive($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);
            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_selfdrive', array('id' => $id));
                if ($zapak!=0) {
                    redirect("dcadmin/Self_drive/view_selfdrive", "refresh");
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
    //======================================STATUS DRIVE=================================//
    public function updatedriveStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
//
            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);
            if ($t=="active") {
                $data_update = array(
'is_active'=>1
);
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_selfdrive', $data_update);
                if ($zapak!=0) {
                    redirect("dcadmin/Self_drive/view_selfdrive", "refresh");
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
                $zapak=$this->db->update('tbl_selfdrive', $data_update);
                if ($zapak!=0) {
                    redirect("dcadmin/Self_drive/view_selfdrive", "refresh");
                } else {
                    $data['e']="Error Occured";
                    // exit;
                    $this->load->view('errors/error500admin', $data);
                }
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
}
//======================================END DRIVE=================================//

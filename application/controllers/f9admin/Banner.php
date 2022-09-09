<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Banner extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
  //================================VIEW BANNER===================================
    public function view_banner()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_banner');
            //$this->db->where('id',$usr);
            $data['banner_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/banner/view_banner');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
  //================================ADD BANNER===================================
    public function add_banner()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/banner/add_banner');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function add_banner_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            $ip = $this->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            $addedby=$this->session->userdata('admin_id');
            $this->load->library('upload');
    //================================IMAGE UPLOAD===================================
        $photo1="";
        $photo2="";
        $image1='photo1';
        $file_check=($_FILES['photo1']['error']);
        if($file_check!=4){
        $image_upload_folder = FCPATH . "assets/uploads/banner/";
          if (!file_exists($image_upload_folder))
          {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
          }
          $new_file_name="banner".date("Ymdhms");
          $this->upload_config = array(
              'upload_path'   => $image_upload_folder,
              'file_name' => $new_file_name,
              'allowed_types' =>'jpg|jpeg|png',
              'max_size'      => 25000
          );
          $this->upload->initialize($this->upload_config);
          if (!$this->upload->do_upload($image1))
          {
            $upload_error = $this->upload->display_errors();
            // echo json_encode($upload_error);
            echo $upload_error;
          }
          else
          {
            $file_info = $this->upload->data();
            $photo1 = "assets/uploads/banner/".$new_file_name.$file_info['file_ext'];
          }
        }
        $image2='photo2';
        $file_check=($_FILES['photo2']['error']);
        if ($file_check!=4) {
        $image_upload_folder = FCPATH . "assets/uploads/banner/";
        if (!file_exists($image_upload_folder)) {
        mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }
        $new_file_name="banner2".date("Ymdhms");
        $this->upload_config = array(
        'upload_path'   => $image_upload_folder,
        'file_name' => $new_file_name,
        'allowed_types' =>'jpg|jpeg|png',
        'max_size'      => 25000
        );
        $this->upload->initialize($this->upload_config);
        if (!$this->upload->do_upload($image2)) {
        $upload_error = $this->upload->display_errors();
        // echo json_encode($upload_error);
        // if($typ == 1){
        //            $this->session->set_flashdata('emessage',$upload_error);
        //              redirect($_SERVER['HTTP_REFERER']);
        //            }
        } else {
        $file_info = $this->upload->data();
        $videoNAmePath = "assets/uploads/banner/".$new_file_name.$file_info['file_ext'];
        $photo2=$videoNAmePath;
        }
      }
        // echo json_encode($file_info);
        // if ($typ==1) {
        $ip = $this->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $addedby=$this->session->userdata('admin_id');
        $typ=base64_decode($t);
        if ($typ==1) {
        $data_insert = array(
          'photo1'=>$photo1,
          'photo2'=>$photo2,
          'is_active' =>1,
        );
        $last_id=$this->base_model->insert_table("tbl_banner", $data_insert, 1) ;
        }
        if ($typ==2) {
        $idw=base64_decode($iw);
        $this->db->select('*');
        $this->db->from('tbl_banner');
        $this->db->where('id',$idw);
        $slider_data = $this->db->get()->row();
        if (empty($photo1)) {
        $photo1 = $slider_data->photo1;
        }
        if (empty($photo2)) {
        $photo2 = $slider_data->photo2;
        }
        $data_insert = array(
        'photo1'=>$photo1,
        'photo2'=>$photo2,
        );
        $this->db->where('id', $idw);
        $last_id=$this->db->update('tbl_banner', $data_insert);
        }
        if($last_id!=0){
        $this->session->set_flashdata('smessage','Data inserted successfully');
      redirect("dcadmin/Banner/view_banner", "refresh");
        }
        else
        {
        $this->session->set_flashdata('emessage','Sorry error occured');
        redirect($_SERVER['HTTP_REFERER']);
        }
        }

        else{
        redirect("login/admin_login","refresh");
        }
        }
    //================================UPDATE BANNER===================================
    public function update_banner($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_banner');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['banner']=$dsa->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/banner/update_banner');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
  //================================DELETE BANNER===================================
    public function delete_banner($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);
            if ($this->load->get_var('position')=="Super Admin") {
                // $this->db->select('image');
                $this->db->from('tbl_banner');
                $this->db->where('id', $id);
                $dsa= $this->db->get();
                $da=$dsa->row();
                // $img=$da->image;
                $zapak=$this->db->delete('tbl_banner', array('id' => $id));
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                     redirect("dcadmin/banner/view_banner", "refresh");
                }
                else {
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
//================================STATUS BANNER===================================
    public function updatebannerStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            if ($t=="active") {
                $data_update = array(
                              'is_active'=>1
                              );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_banner', $data_update);
                $this->session->set_flashdata('smessage', 'Status updated successfully');
                if ($zapak!=0) {
                    redirect("dcadmin/banner/view_banner", "refresh");
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
                $zapak=$this->db->update('tbl_banner', $data_update);
                $this->session->set_flashdata('smessage', 'Status updated successfully');
                if ($zapak!=0) {
                    redirect("dcadmin/banner/view_banner", "refresh");
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
    //================================END BANNER===================================

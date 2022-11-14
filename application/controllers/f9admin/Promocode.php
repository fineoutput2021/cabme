<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Promocode extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //================================VIEW PROMOCODE===================================
    public function view_promocode()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_promocode');
            //$this->db->where('id',$usr);
            $data['promocode_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/promocode/view_promocode');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================ADD PROMOCODE===================================
    public function add_promocode()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/promocode/add_promocode');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================ADD PROMOCODE DATA===================================
    public function add_promocode_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('promocode', 'promocode', 'required|xss_clean|trim');
                $this->form_validation->set_rules('percentage', 'percentage', 'required|xss_clean|trim');
                $this->form_validation->set_rules('ptype', 'ptype', '');
                $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
                $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
                $this->form_validation->set_rules('mindays', 'mindays', 'required|xss_clean|trim');
                $this->form_validation->set_rules('max', 'max', 'required|xss_clean|trim');
                if ($this->form_validation->run()== true) {
                    $promocode=$this->input->post('promocode');
                    $percentage=$this->input->post('percentage');
                    $ptype=$this->input->post('ptype');
                    $start_date=$this->input->post('start_date');
                    $end_date=$this->input->post('end_date');
                    $mindays=$this->input->post('mindays');
                    $max=$this->input->post('max');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");
                    $addedby=$this->session->userdata('admin_id');
                    $typ=base64_decode($t);
                    $this->load->library('upload');
                    $photo="";
                    $image1='photo';
                    $file_check=($_FILES['photo']['error']);
                    if($file_check!=4){
                    $image_upload_folder = FCPATH . "assets/uploads/promocode/";
                      if (!file_exists($image_upload_folder))
                      {
                        mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                      }
                      $new_file_name="promocode".date("Ymdhms");
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
                        $this->session->set_flashdata('emessage', $upload_error);
                        redirect($_SERVER['HTTP_REFERER']);
                      }
                      else
                      {
                        $file_info = $this->upload->data();
                        $photo = "assets/uploads/promocode/".$new_file_name.$file_info['file_ext'];
                      }
                    }
                    if ($typ==1) {
                        $data_insert = array('promocode'=>$promocode,
                        'percentage'=>$percentage,
                        'ptype'=>$ptype,
                        'photo'=>$photo,
                        'start_date'=>$start_date,
                              'end_date'=>$end_date,
                              'mindays'=>$mindays,
                              'max'=>$max,
                              'ip' =>$ip,
                              'added_by' =>$addedby,
                              'is_active' =>1,
                              'date'=>$cur_date
                              );
                        // die();
                        $last_id=$this->base_model->insert_table("tbl_promocode", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');
                            redirect("dcadmin/Promocode/view_promocode", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        if(empty($photo)){
                          $promo_data = $this->db->get_where('tbl_promocode', array('id'=> $idw))->result();
                          $photo = $promo_data[0]->photo;
                        }
                        $data_insert = array('promocode'=>$promocode,
                        'percentage'=>$percentage,
                        'photo'=>$photo,
                        'ptype'=>$ptype,
                        'start_date'=>$start_date,
                              'end_date'=>$end_date,
                              'mindays'=>$mindays,
                              'max'=>$max,
                              );
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_promocode', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');
                            redirect("dcadmin/Promocode/view_promocode", "refresh");
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
    //================================UPDATE PROMOCODE===================================
    public function update_promocode($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_promocode');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['promocode']=$dsa->row();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/promocode/update_promocode');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================DELETE PROMOCODE===================================
    public function delete_promocode($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_promocode', array('id' => $id));
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/Promocode/view_promocode", "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            } else {
                $this->session->set_flashdata('emessage', "Sorry You Don't Have Permission To Delete Anything");
                redirect("dcadmin/Promocode/view_promocode", "refresh");
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    //================================UPDATE STATUS PROMOCODE===================================
    public function updatepromocodeStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            if ($t=="active") {
                $data_update = array(
                               'is_active'=>1
                               );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_promocode', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                if ($zapak!=0) {
                    redirect("dcadmin/Promocode/view_promocode", "refresh");
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
                $zapak=$this->db->update('tbl_promocode', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                if ($zapak!=0) {
                    redirect("dcadmin/Promocode/view_promocode", "refresh");
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

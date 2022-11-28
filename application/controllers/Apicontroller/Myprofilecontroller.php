<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Myprofilecontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library('pagination');
    }
     //================================ UPDATE USER PROFILE ===========================================//
     public function update_profile()
     {
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->load->helper('security');
         if ($this->input->post()) {
             $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
             $this->form_validation->set_rules('dob', 'dob', 'required|xss_clean|trim');
             $this->form_validation->set_rules('aadhar_no', 'aadhar_no', 'required|xss_clean|trim');
             $this->form_validation->set_rules('driving_lience', 'driving_lience', 'required|xss_clean|trim');
             if ($this->form_validation->run()== true) {
                 $phone=$this->input->post('phone');
                 $dob=$this->input->post('dob');
                 $aadhar_no=$this->input->post('aadhar_no');
                 $driving_lience=$this->input->post('driving_lience');

                 $update = array('phone'=>$phone,
                  'dob'=>$dob,
                  'aadhar_no'=>$aadhar_no, 
                  'driving_lience'=>$driving_lience, 
                );
                 $this->db->where('id', $this->session->userdata('user_id'));
                 $zapak2 = $this->db->update('tbl_users', $update);
                 if ($zapak2==1) {
                     $this->session->set_flashdata('smessage', 'Profile updated successfully!');
                     redirect('Home/my_profile/account', 'refresh');
                 } else {
                     $this->session->set_flashdata('emessage', 'Some unknown error occurred');
                     redirect('Home/my_profile/account', 'refresh');
                 }
             } else {
                 $this->session->set_flashdata('emessage', validation_errors());
                 redirect($_SERVER['HTTP_REFERER']);
             }
         } else {
             $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
             redirect($_SERVER['HTTP_REFERER']);
         }
     }
     //=========================================VIEW PROFILE=================================================//
     public function view_profile()
     {
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->load->helper('security');
         if ($this->input->post()) {
             $this->form_validation->set_rules('phone', 'phone', 'required|xss_clean|trim');
             $this->form_validation->set_rules('dob', 'dob', 'required|xss_clean|trim');
             $this->form_validation->set_rules('aadhar_no', 'aadhar_no', 'required|xss_clean|trim');
             $this->form_validation->set_rules('driving_lience', 'driving_lience', 'required|xss_clean|trim');
            
             if ($this->form_validation->run()== true) {
                 $phone=$this->input->post('phone');
                 $dob=$this->input->post('dob');
                 $aadhar_no=$this->input->post('aadhar_no');
                 $driving_lience=$this->input->post('driving_lience');
               
                 $profile_data = $this->db->get_where('tbl_users', array('is_active'=> 1,))->result();
                 $data=[];
                 foreach ($profile_data as $profile) {
                     $data[]=array('phone'=>$profile->phone,
                       'dob'=>$profile->dob,
                                'aadhar_no'=>$profile->aadhar_no,
                                'driving_lience'=>$profile->driving_lience,
                               
                                
                              );
                 }
                 $res=array(
                                 'message'=>"success",
                                 'status'=>200,
                                 'data'=>$data
                                 );
                 echo json_encode($res);
             } else {
                 $res=array(
                  'message'=>validation_errors(),
                  'status'=>201
                );
                 echo json_encode($res);
             }
         } else {
             $res=array(
                'message'=>'please insert data',
                'status'=>201
              );
             echo json_encode($res);
         }
     }
     
}

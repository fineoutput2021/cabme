<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Booking extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
          $this->load->library('upload');
    }
    //============================== VIEW SELF DRIVE BOOKING =========================\\
    public function view_self_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_booking');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('booking_type', 1);//new orders
            $data['booking_data']= $this->db->get();
            $data['heading'] = "Self Drive";
            $data['booking_type'] = 1;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/booking/view_booking');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=========================== VIEW INTERCITY BOOKINGS ===========================\\
    public function view_intercity_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->from('tbl_booking');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('booking_type', 2);//new orders
            $data['booking_data']= $this->db->get();
            $data['heading'] = "Intercity";
            $data['booking_type'] = 2;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/booking/view_booking');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================VIEW OUTSTATION BOOKING=======================\\
    public function view_outstation_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_booking');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('booking_type', 3);//new orders
            $data['booking_data']= $this->db->get();
            $data['heading'] = "Outstation";
            $data['booking_type'] = 3;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/booking/view_booking');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //============================START OUTSTATION BOOKING=======================\\
    public function start_outstation_booking($id)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['id'] = $id;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/booking/start_outstation_booking');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //================================END OUTSTATION BOOKING=======================\\
    public function end_outstation_booking($id)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['id'] = $id;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/booking/end_outstation_booking');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function Confirm_booking($id,$heading)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['id'] = $id;
            $heading= str_replace("%20"," ",$heading);
            $data['heading'] = $heading;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/booking/Confirm_booking');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //===============================ACCEPTED OUTSTATION BOOKING=======================\\
    public function accepted_outsation_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('start_kilometer', 'start_kilometer', 'required|xss_clean|trim');
                if ($this->form_validation->run()== true) {
                    $id=$this->input->post('id');
                    $start_kilometer=$this->input->post('start_kilometer');
                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");
                    $data_insert = array(
                        'start_kilometer'=>$start_kilometer,
                        'order_status'=>2,

                        );
                    $this->db->where('id', $id);
                    $last_id=$this->db->update('tbl_booking', $data_insert);
                    if ($last_id!=0) {
                        $this->session->set_flashdata('smessage', 'Data updates successfully');
                        redirect("dcadmin/Booking/view_outstation_booking", "refresh");
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
    //================================CONFIRMED OUTSTATION BOOKING=======================\\
    public function complete_outsation_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('location', 'location', 'required|xss_clean|trim');
                $this->form_validation->set_rules('end_kilometer', 'end_kilometer', 'required|xss_clean|trim');
                if ($this->form_validation->run()== true) {
                             date_default_timezone_set("Asia/Calcutta");
                             $cur_date=date("Y-m-d H:i:s");
                    $id=$this->input->post('id');
                    $location=$this->input->post('location');
                    $end_kilometer=$this->input->post('end_kilometer');
                    $image="";
                    $img1='invoice_image';
                    $file_check=($_FILES['invoice_image']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/booking/";
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
                            $image = "assets/uploads/booking/".$new_file_name.$file_info['file_ext'];
                        }
                    }
                    $this->db->select('*');
                    $this->db->from('tbl_booking');
                    $this->db->where('id', $id);//new orders
                    $booking_data= $this->db->get()->row();
                    $data_insert1 = array(
                        'location'=>$location,
                        );
                    $this->db->where('id', $booking_data->car_id);
                    $last_id=$this->db->update('tbl_outstation', $data_insert1);
                    $data_insert = array(
                        'end_kilometer'=>$end_kilometer,
                        'invoice_image'=>$image,
                        'order_status'=>3,
                          'date'=>$cur_date
                        );
                    $this->db->where('id', $id);
                    $last_id=$this->db->update('tbl_booking', $data_insert);
                    if ($last_id!=0) {
                        $this->session->set_flashdata('smessage', 'Data updates successfully');
                        redirect("dcadmin/Booking/view_outstation_booking", "refresh");
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
    //================================Complete  BOOKING=======================\\
    public function complete_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('heading', 'heading', 'required|xss_clean|trim');
                $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
                if ($this->form_validation->run()== true) {
                    $heading=$this->input->post('heading');
                    $id=$this->input->post('id');
                    $image="";
                    $img1='invoice_image';
                    $file_check=($_FILES['invoice_image']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/booking/";
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
                            $image = "assets/uploads/booking/".$new_file_name.$file_info['file_ext'];
                        }
                    }
                    $data_insert = array(
                        'invoice_image'=>$image,
                        'order_status'=>3,
                        );
                    $this->db->where('id', $id);
                    $last_id=$this->db->update('tbl_booking', $data_insert);
                    $booking_data = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
                    if($booking_data[0]->booking_type==1 || $booking_data[0]->booking_type==3){
                    $data_update = array('is_available'=>1);
                    $this->db->where('id', $booking_data[0]->car_id);
                    if($booking_data[0]->booking_type==1){
                      $zapak=$this->db->update('tbl_selfdrive', $data_update);
                    }else{
                      $zapak=$this->db->update('tbl_outstation', $data_update);
                    }
                    }
                    if ($last_id!=0) {
                        $this->session->set_flashdata('smessage', 'Data updates successfully');
                        if($heading =="Self Drive"){
                        redirect("dcadmin/Booking/view_self_booking", "refresh");
                      }else{
                        redirect("dcadmin/Booking/view_intercity_booking", "refresh");
                      }
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
    //===============================dispatched_orders========================\\
    public function dispatched_order()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('order_status', 3);//dispatched_orders
            $data['order1_data']= $this->db->get();
            $data['heading'] = "Dispatched";
            $data['order_type'] = 1;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/order/view_order');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=========================delievered_orders=========================\\
    public function completed_order()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('order_status', 4);//delievered orders
            $data['order1_data']= $this->db->get();
            $data['heading'] = "Completed";
            $data['order_type'] = 1;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/order/view_order');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=========================delievered_orders=========================\\
    public function offline_orders()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('order_type', 2);//delievered orders
            $data['order1_data']= $this->db->get();
            $data['heading'] = "Offline";
            $data['order_type'] = 2;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/order/view_order');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=============================cancelled_order==========================\\
    public function cancelled_order()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->order_by('id', 'desc');
            $this->db->where('payment_status', 1);
            $this->db->where('order_status > ', 4);//cancelled orders
            $data['order1_data']= $this->db->get();
            $data['heading'] = "Rejected/Cancelled";
            $data['order_type'] = 1;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/order/view_order');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function rejected_order()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('payment_status', 1);
            $this->db->order_by('id', 'desc');
            $this->db->where('order_status', 6);//rejected orders
            $data['order1_data']= $this->db->get();
            $data['heading'] = "Rejected";
            $data['order_type'] = 1;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/order/view_order');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==============================update_order_status========================\\
    public function updateorderStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            if ($t=="accepted") {
                $data_update = array(
                                           'order_status'=>2
                                           );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_booking', $data_update);
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', $upload_error);
                    exit;
                }
            }
            if ($t=="completed") {
                $data_update = array('order_status'=>3);
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_booking', $data_update);
                $booking_data = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', $upload_error);
                    exit;
                }
            }
            if ($t=="reject") {
                $data_update = array('order_status'=>4
                                           );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_booking', $data_update);
                $booking_data = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
                if($booking_data[0]->booking_type==1 || $booking_data[0]->booking_type==3){
                $data_update = array('is_available'=>1);
                $this->db->where('id', $booking_data[0]->car_id);
                if($booking_data[0]->booking_type==1){
                  $zapak=$this->db->update('tbl_selfdrive', $data_update);
                }else{
                  $zapak=$this->db->update('tbl_outstation', $data_update);
                }
                }

                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', $upload_error);
                    exit;
                }
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    //==================================order_detail==========================\\
    public function order_detail($idd, $t='')
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_order2');
            $this->db->where('main_id', $id);
            $data['order2_data']= $this->db->get();
            if (!empty($t)) {
                $data['order_type']= 2;
            } else {
                $data['order_type']= 1;
            }
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('id', $id);
            $order1_data= $this->db->get()->row();
            $data['status']= $order1_data->order_status;
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/order/order_details');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=================================view_bill=============================\\
    public function view_bill($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('id', $id);
            $data['order1_data']= $this->db->get()->row();
            $this->db->select('*');
            $this->db->from('tbl_order2');
            $this->db->where('main_id', $id);
            $data['order2_data']= $this->db->get();
            $this->load->view('admin/order/view_bill', $data);
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
}

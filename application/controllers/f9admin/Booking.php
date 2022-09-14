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
    }
    //============================== VIEW SELF DRIVE BOOKING =========================\\
    public function view_self_booking()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->db->select('*');
            $this->db->from('tbl_booking');
            // $this->db->where('payment_status', 1);
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
                    $id=$this->input->post('id');
                    $location=$this->input->post('location');
                    $end_kilometer=$this->input->post('end_kilometer');
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
                        'order_status'=>3,
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
            if ($t=="confirmed") {
                $data_update = array(
                                           'order_status'=>2
                                           );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_order1', $data_update);
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', $upload_error);
                    exit;
                }
            }
            if ($t=="dispatched") {
                $data_update = array(
                                           'order_status'=>3
                                           );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_order1', $data_update);
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', $upload_error);
                    exit;
                }
            }
            if ($t=="delievered") {
                $data_update = array(
                                           'order_status'=>4
                                           );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_order1', $data_update);
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->session->set_flashdata('emessage', $upload_error);
                    exit;
                }
            }
            if ($t=="reject") {
                $data_update = array('order_status'=>5);
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_order1', $data_update);
                //-------update inventory-------
                $this->db->select('*');
                $this->db->from('tbl_order2');
                $this->db->where('main_id', $id);
                $data_order2= $this->db->get();
                foreach ($data_order2->result() as $data) {
                    $this->db->select('*');
                    $this->db->from('tbl_type');
                    $this->db->where('id', $data->type_id);
                    $pro_data= $this->db->get()->row();
                    if (!empty($pro_data)) {
                        $update_inv = $pro_data->inventory + $data->quantity;
                        $data_update = array('inventory'=>$update_inv);
                        $this->db->where('id', $pro_data->id);
                        $zapak2=$this->db->update('tbl_type', $data_update);
                    }
                }
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                    redirect($_SERVER['HTTP_REFERER']);
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

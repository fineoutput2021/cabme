<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Bookingcontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library('pagination');
        $this->load->library("custom/Booking");
    }
    //============================= SELF CARS CALCULATE =================================//
    public function self_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            $this->form_validation->set_rules('car_id', 'car_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $city_id = $this->input->post('city_id');
                $start_date = $this->input->post('start_date');
                $start_time = $this->input->post('start_time');
                $end_date = $this->input->post('end_date');
                $end_time = $this->input->post('end_time');
                $duration = $this->input->post('duration');
                $car_id = $this->input->post('car_id');
                $type_id = $this->input->post('type_id');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
                if (!empty($user_data)) {
                    $send = array(
                        'user_id' => $user_data[0]->id,
                        'city_id' => $city_id,
                        'start_date' => $start_date,
                        'start_time' => $start_time,
                        'end_date' => $end_date,
                        'end_time' => $end_time,
                        'duration' => $duration,
                        'city_id' => $city_id,
                        'car_id' => $car_id,
                        'type_id' => $type_id,
                    );
                    $response = $this->booking->selfDriveCarCalculate($send);
                    echo json_encode($response);
                } else {
                    $res = array(
                        'message' => 'Permission Denied!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'please insert data',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //========================= SELF CARS CHECKOUT ========================//
    public function self_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('dob', 'dob', 'required|xss_clean|trim');
            $this->form_validation->set_rules('aadhar_no', 'aadhar_no', 'required|xss_clean|trim');
            $this->form_validation->set_rules('driving_lience', 'driving_lience', 'required|xss_clean|trim');
            // $this->form_validation->set_rules('agree', 'agree', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $id = base64_decode($this->input->post('id'));
                $dob = $this->input->post('dob');
                $aadhar_no = $this->input->post('aadhar_no');
                $driving_lience = $this->input->post('driving_lience');
                // $agree = $this->input->post('agree');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $this->load->library('upload');
                $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
                if (!empty($user_data)) {
                    //----- verify date -----
                    $bday = new DateTime($dob); // Your date of birth
                    $today = new Datetime(date('m.d.y'));
                    $diff = $today->diff($bday);
                    if ($diff->y < 18) {
                        $res = array(
                            'message' => 'Age is less than 18 years!',
                            'status' => 201
                        );
                        echo json_encode($res);
                        return;
                    }
                    //----------------aadhar front ----------
                    $img1 = 'aadhar_front';
                    $file_check = ($_FILES['aadhar_front']['error']);
                    if ($file_check != 4) {
                        $image_upload_folder = FCPATH . "assets/uploads/documents/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name = "aadhar_front" . date("Ymdhms");
                        $this->upload_config = array(
                            'upload_path'   => $image_upload_folder,
                            'file_name' => $new_file_name,
                            'allowed_types' => 'jpg|jpeg|png',
                            'max_size'      => 25000
                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img1)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            echo $upload_error;
                        } else {
                            $file_info = $this->upload->data();
                            $aadhar_front = "assets/uploads/documents/" . $new_file_name . $file_info['file_ext'];
                        }
                    }
                    //----------------aadhar back ----------
                    $img2 = 'aadhar_back';
                    $file_check = ($_FILES['aadhar_back']['error']);
                    if ($file_check != 4) {
                        $image_upload_folder = FCPATH . "assets/uploads/documents/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name = "aadhar_back" . date("Ymdhms");
                        $this->upload_config = array(
                            'upload_path'   => $image_upload_folder,
                            'file_name' => $new_file_name,
                            'allowed_types' => 'jpg|jpeg|png',
                            'max_size'      => 25000
                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img2)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            echo $upload_error;
                        } else {
                            $file_info = $this->upload->data();
                            $aadhar_back = "assets/uploads/documents/" . $new_file_name . $file_info['file_ext'];
                        }
                    }
                    //----------------license_front ----------
                    $img3 = 'license_front';
                    $file_check = ($_FILES['license_front']['error']);
                    if ($file_check != 4) {
                        $image_upload_folder = FCPATH . "assets/uploads/documents/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name = "license_front" . date("Ymdhms");
                        $this->upload_config = array(
                            'upload_path'   => $image_upload_folder,
                            'file_name' => $new_file_name,
                            'allowed_types' => 'jpg|jpeg|png',
                            'max_size'      => 25000
                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img3)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            echo $upload_error;
                        } else {
                            $file_info = $this->upload->data();
                            $license_front = "assets/uploads/documents/" . $new_file_name . $file_info['file_ext'];
                        }
                    }
                    //----------------license_back ----------
                    $img4 = 'license_back';
                    $file_check = ($_FILES['license_back']['error']);
                    if ($file_check != 4) {
                        $image_upload_folder = FCPATH . "assets/uploads/documents/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name = "license_back" . date("Ymdhms");
                        $this->upload_config = array(
                            'upload_path'   => $image_upload_folder,
                            'file_name' => $new_file_name,
                            'allowed_types' => 'jpg|jpeg|png',
                            'max_size'      => 25000
                        );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img4)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            echo $upload_error;
                        } else {
                            $file_info = $this->upload->data();
                            $license_back = "assets/uploads/documents/" . $new_file_name . $file_info['file_ext'];
                        }
                    }

                    $amount = $this->booking->selfCheckout($id, $dob, $aadhar_no, $driving_lience, $aadhar_front, $aadhar_back, $license_front, $license_back,$user_data[0]->id);
                    $data_update = array(
                        'payment_status' => 1,
                        'order_status' => 1,
                        'final_amount' => $amount,
                    );
                    $this->db->where('id', $id);
                    $zapak = $this->db->update('tbl_booking', $data_update);
                    $bookingdata = $this->db->get_where('tbl_booking', array('id' => $id))->result();
                    //---- car status update ----
                    $data_update2 = array('is_available' => 0,);
                    $this->db->where('id', $bookingdata[0]->car_id);
                    $zapak = $this->db->update('tbl_selfdrive', $data_update2);
                    $data = [];
                    $data = array('booking_id' => $bookingdata[0]->id, 'amount' => $bookingdata[0]->final_amount);
                    $res = array(
                        'message' => 'Booking Success!',
                        'status' => 201,
                        'data' => $data
                    );
                    echo json_encode($res);
                } else {
                    $res = array(
                        'message' => 'Permission Denied!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'please insert data',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //========================== GET OUTSTATION CARS CALCULATE ==================================//
    public function outstation_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'xss_clean|trim');
            $this->form_validation->set_rules('car_id', 'car_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('round_type', 'round_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pick_location', 'pick_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('drop_location', 'drop_location', 'xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $city_id = $this->input->post('city_id');
                $start_date = $this->input->post('start_date');
                $start_time = $this->input->post('start_time');
                $end_date = $this->input->post('end_date');
                $end_time = $this->input->post('end_time');
                $duration = $this->input->post('duration');
                $car_id = $this->input->post('car_id');
                $round_type = $this->input->post('round_type');
                $pick_location = $this->input->post('pick_location');
                $drop_location = $this->input->post('drop_location');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = date("Y-m-d H:i:s");
                $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
                if (!empty($user_data)) {
                    $send = array(
                        'user_id' => $user_data[0]->id,
                        'city_id' => $city_id,
                        'start_date' => $start_date,
                        'start_time' => $start_time,
                        'end_date' => $end_date,
                        'end_time' => $end_time,
                        'duration' => $duration,
                        'car_id' => $car_id,
                        'round_type' => $round_type,
                        'pick_location' => $pick_location,
                        'drop_location' => $drop_location,
                    );
                    $response = $this->booking->outstationCalculate($send);
                    echo json_encode($response);
                } else {
                    $res = array(
                        'message' => 'Permission Denied!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'please insert data',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //========================== GET OUTSTATION CARS CHECKOUT  ===================//
    public function outstation_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $id = $this->input->post('id');
                $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
                if (!empty($user_data)) {
                    $data_update = array(
                        'payment_status' => 1,
                        'order_status' => 1,
                    );
                    $this->db->where('id', base64_decode($id));
                    $zapak = $this->db->update('tbl_booking', $data_update);
                    $bookingdata = $this->db->get_where('tbl_booking', array('id' => base64_decode($id)))->result();
                    $data = array(
                        'booking_id' => $bookingdata[0]->id,
                        'amount' => $bookingdata[0]->final_amount,
                    );
                    $res = array(
                        'message' => 'Booking Success!',
                        'status' => 200,
                        'data' => $data
                    );
                    echo json_encode($res);
                } else {
                    $res = array(
                        'message' => 'Permission Denied!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'please insert data',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //======================= GET INTERCITY CARS CALCULATE  =====================//
    public function intercity_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        if ($this->input->post()) {
            $this->form_validation->set_rules('cab_type', 'cab_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $cab_type = $this->input->post('cab_type');
                $start_date = $this->input->post('start_date');
                $start_time = $this->input->post('start_time');
                $end_date = $this->input->post('end_date');
                $end_time = $this->input->post('end_time');
                $city_id = $this->input->post('city_id');
                $duration = $this->input->post('duration');
                $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
                if (!empty($user_data)) {
                    $response = $this->booking->intercityCalculate($cab_type, $start_date, $start_time, $end_date, $end_time, $city_id, $duration, $user_data[0]->id);
                    echo json_encode($response);
                } else {
                    $res = array(
                        'message' => 'Permission Denied!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'please insert data',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //======================  INTERCITY CARS CHECKOUT ============================//
    public function intercity_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $id = $this->input->post('id');
                $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
                if (!empty($user_data)) {
                    $data_update = array(
                        'payment_status' => 1,
                        'order_status' => 1,
                    );
                    $this->db->where('id', base64_decode($id));
                    $zapak = $this->db->update('tbl_booking', $data_update);
                    $bookingdata = $this->db->get_where('tbl_booking', array('id' => base64_decode($id)))->result();
                    $data = array(
                        'booking_id' => $bookingdata[0]->id,
                        'amount' => $bookingdata[0]->final_amount,
                    );
                    $res = array(
                        'message' => 'Booking Success!',
                        'status' => 200,
                        'data' => $data
                    );
                    echo json_encode($res);
                } else {
                    $res = array(
                        'message' => 'Permission Denied!',
                        'status' => 201
                    );
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'message' => validation_errors(),
                    'status' => 201
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'please insert data',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    //==============================================MY BOOKING============================================//
}

<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Apicontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library('pagination');
        $this->load->library("custom/Booking");
    }
    //================================= GET SELF CITY =================================//
    public function get_self_city()
    {
        $top_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 1, 'city_type' => 1))->result();
        $other_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 0, 'city_type' => 1))->result();
        $top = [];
        $other = [];
        foreach ($top_data as $cities) {
            if (!empty($cities->photo)) {
                $image = base_url() . $cities->photo;
            } else {
                $image = '';
            }
            $top[] = array(
                'id' => $cities->id,
                'name' => $cities->name,
                'image' => $image,
            );
        }
        foreach ($other_data as $cities2) {
            if (!empty($cities2->photo)) {
                $image = base_url() . $cities2->photo;
            } else {
                $image = '';
            }
            $other[] = array(
                'id' => $cities2->id,
                'name' => $cities2->name,
                'image' => $image,
            );
        }
        $data = array('top' => $top, 'other' => $other,);
        $res = array(
            'message' => "success",
            'status' => 200,
            'data' => $data
        );
        echo json_encode($res);
    }
    //================================= GET OUTSTATION1 CITY =================================//
    public function get_outstation1_city()
    {
        $top_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 1, 'city_type' => 2, 'ot_city_type' => 1))->result();
        $other_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 0, 'city_type' => 2, 'ot_city_type' => 1))->result();
        $top = [];
        $other = [];
        foreach ($top_data as $cities) {
            if (!empty($cities->photo)) {
                $image = base_url() . $cities->photo;
            } else {
                $image = '';
            }
            $top[] = array(
                'id' => $cities->id,
                'name' => $cities->name,
                'image' => $image,
            );
        }
        foreach ($other_data as $cities2) {
            if (!empty($cities2->photo)) {
                $image = base_url() . $cities2->photo;
            } else {
                $image = '';
            }
            $other[] = array(
                'id' => $cities2->id,
                'name' => $cities2->name,
                'image' => $image,
            );
        }
        $data = array('top' => $top, 'other' => $other,);
        $res = array(
            'message' => "success",
            'status' => 200,
            'data' => $data
        );
        echo json_encode($res);
    }
    //================================= GET OUTSTATION2 CITY =================================//
    public function get_outstation2_city()
    {
        $top_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 1, 'city_type' => 2, 'ot_city_type' => 2))->result();
        $other_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 0, 'city_type' => 2, 'ot_city_type' => 2))->result();
        $top = [];
        $other = [];
        foreach ($top_data as $cities) {
            if (!empty($cities->photo)) {
                $image = base_url() . $cities->photo;
            } else {
                $image = '';
            }
            $top[] = array(
                'id' => $cities->id,
                'name' => $cities->name,
                'image' => $image,
            );
        }
        foreach ($other_data as $cities2) {
            if (!empty($cities2->photo)) {
                $image = base_url() . $cities2->photo;
            } else {
                $image = '';
            }
            $other[] = array(
                'id' => $cities2->id,
                'name' => $cities2->name,
                'image' => $image,
            );
        }
        $data = array('top' => $top, 'other' => $other,);
        $res = array(
            'message' => "success",
            'status' => 200,
            'data' => $data
        );
        echo json_encode($res);
    }
    //============================== SELF DRIVE CARS ========================\\
    public function get_self_drive_cars()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            $this->form_validation->set_rules('sort', 'sort', 'xss_clean|trim');
            $this->form_validation->set_rules('filter[]', 'filter', 'xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $city_id = $this->input->post('city_id');
                $start_date = $this->input->post('start_date');
                $start_time = $this->input->post('start_time');
                $end_date = $this->input->post('end_date');
                $end_time = $this->input->post('end_time');
                $duration = $this->input->post('duration');
                $sort = $this->input->post('sort');
                $filter = $this->input->post('filter[]');
                //----- start check date is past ----------
                date_default_timezone_set('Asia/Kolkata');
                $newdate = new DateTime($start_date);
                $date = $newdate->format('Y-m-d');
                $newtime = new DateTime($start_time);
                $time = $newtime->format('H:i:s');
                $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
                $curDateTime = date("Y-m-d H:i:s");
                if ($curDateTime > $myDate) {
                    $res = array(
                        'message' => "Please select date and time again!",
                        'status' => 201,
                        'data' => []
                    );
                    echo json_encode($res);
                    return;
                }
                if (!empty($filter["brand"])) {
                    $brand = $filter["brand"];
                } else {
                    $brand = '';
                }
                if (!empty($filter["fuel"])) {
                    $fuel = $filter["fuel"];
                } else {
                    $fuel = '';
                }
                if (!empty($filter["transmission"])) {
                    $transmission = $filter["transmission"];
                } else {
                    $transmission = '';
                }
                if (!empty($filter["seating"])) {
                    $seating = $filter["seating"];
                } else {
                    $seating = '';
                }
                // print_r($filter['brand']);die();
                $send = array(
                    'city_id' => $city_id,
                    'start_date' => $start_date,
                    'start_time' => $start_time,
                    'end_date' => $end_date,
                    'end_time' => $end_time,
                    'duration' => $duration,
                    'brand' => $brand,
                    'fuel' => $fuel,
                    'transmission' => $transmission,
                    'seating' => $seating,
                    'sort' => $sort,
                    // 'index'=>$index,
                );
                $car_data = $this->booking->ViewSelfDriveCars($send);
                echo json_encode($car_data);
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
    //============================== OUTSTATION  CARS ========================\\
    public function get_outstation_cars()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            $this->form_validation->set_rules('round_type', 'round_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('sort', 'sort', 'xss_clean|trim');
            $this->form_validation->set_rules('filter[]', 'filter', 'xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $city_id = $this->input->post('city_id');
                $start_date = $this->input->post('start_date');
                $start_time = $this->input->post('start_time');
                $end_date = $this->input->post('end_date');
                $end_time = $this->input->post('end_time');
                $duration = $this->input->post('duration');
                $round_type = $this->input->post('round_type');
                $sort = $this->input->post('sort');
                $filter = $this->input->post('filter[]');
                //----- start check date is past ----------
                date_default_timezone_set('Asia/Kolkata');
                $newdate = new DateTime($start_date);
                $date = $newdate->format('Y-m-d');
                $newtime = new DateTime($start_time);
                $time = $newtime->format('H:i:s');
                $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
                $curDateTime = date("Y-m-d H:i:s");
                if ($curDateTime > $myDate) {
                    $res = array(
                        'message' => "Please select date and time again!",
                        'status' => 201,
                        'data' => []
                    );
                    echo json_encode($res);
                    return;
                }
                if (!empty($filter["seating"])) {
                    $seating = $filter["seating"];
                } else {
                    $seating = '';
                }
                // print_r($filter['brand']);die();
                $send = array(
                    'city_id' => $city_id,
                    'start_date' => $start_date,
                    'start_time' => $start_time,
                    'end_date' => $end_date,
                    'end_time' => $end_time,
                    'duration' => $duration,
                    'round_type' => $round_type,
                    'seating' => $seating,
                    'sort' => $sort,
                );
                $car_data = $this->booking->ViewOutstationCars($send);
                $data['car_data'] = $car_data['car_data'];
                $data['seating'] = $seating;
                $data['sort'] = $sort;
                echo json_encode($car_data);
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
    //========================== outstation SUMMARY =============================
    public function outstation_summary($idd)
    {
        $id = base64_decode($idd);
        $data['id'] = $idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id' => $id))->result();
        if ($data['booking_data'][0]->payment_status != 1) {
            //----- start check date is past ----------
            date_default_timezone_set('Asia/Kolkata');
            $newdate = new DateTime($data['booking_data'][0]->start_date);
            $date = $newdate->format('Y-m-d');
            $newtime = new DateTime($data['booking_data'][0]->start_time);
            $time = $newtime->format('H:i:s');
            $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
            $curDateTime = date("Y-m-d H:i:s");
            if ($curDateTime > $myDate) {
                $res = array(
                    'message' => "Please Select date and time again!",
                    'status' => 201
                );
                echo json_encode($res);
            }
            //----- end check date is past ----------
            $car = $this->db->get_where('tbl_outstation', array('id' => $data['booking_data'][0]->car_id))->result();
            $data['user_data'] = $this->db->get_where('tbl_users', array('id' => $data['booking_data'][0]->user_id))->result();
            //-----========= city data =============
            $city = $this->db->get_where('tbl_cities', array('id' => $data['booking_data'][0]->city_id))->result();
            $data['city_data'] = $city;
            //------ seating  ---
            if ($car[0]->seatting == 1) {
                $seating = '4 Seates';
            } elseif ($car[0]->seatting == 2) {
                $seating = '5 Seates';
            } else {
                $seating = '7 Seates';
            }
            $car_data = array(
                'brand_name' => $car[0]->brand_name,
                'car_name' => $car[0]->car_name,
                'photo' => base_url() . $car[0]->photo,
                'seating' => $seating,
                'per_kilometer' => $car[0]->per_kilometre,
                'location' => $car[0]->location,
                'min_booking_amt' => $car[0]->min_booking_amt,
            );
            $data['car_data'] = $car_data;
            $res = array(
                'message' => "Please Select date and time again!",
                'status' => 200,
                'data' => $data
            );
            echo json_encode($res);
        } else {
            $res = array(
                'message' => "Please Select date and time again!",
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    // ====================================== SELF DRIVE PROMOCODE ==========================
    public function self_promocode()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('promocode', 'promocode', 'required|xss_clean|trim');
            if ($this->form_validation->run() == true) {
                $id = base64_decode($this->input->post('id'));
                $promocode = strtoupper($this->input->post('promocode'));
                date_default_timezone_set("Asia/Calcutta");
                $cur_date = strtotime(date("Y-m-d"));
                // echo $promocode;die();
                //----check promocode----
                $promocode_data = $this->db->get_where('tbl_promocode', array('is_active' => 1, 'promocode' => $promocode))->result();
                $booking_data = $this->db->get_where('tbl_booking', array('id' => $id))->result();
                if (!empty($promocode_data)) {
                    if (strtotime($promocode_data[0]->end_date) >= $cur_date && strtotime($promocode_data[0]->start_date) <= $cur_date) {
                        //---- one time promocode -------
                        if ($promocode_data[0]->ptype == 1) {
                            $promocodeAlreadyUsed = $this->db->get_where('tbl_booking', array('user_id = ' => $booking_data[0]->user_id, 'promocode' => $promocode_data[0]->id, 'payment_status' => 1))->result();
                            if (empty($promocodeAlreadyUsed)) {
                                if ($booking_data[0]->duration > $promocode_data[0]->mindays * 24) { //----checking minorder for promocode
                                    $discount_amt = $booking_data[0]->total_amount * $promocode_data[0]->percentage / 100;
                                    if ($discount_amt > $promocode_data[0]->max) {
                                        // will get max amount
                                        $discount =  $promocode_data[0]->max;
                                    } else {
                                        $discount =  round($discount_amt, 2);
                                    }
                                    //---- booking entry update -----
                                    $data_update = array(
                                        'promocode' => $promocode_data[0]->id,
                                        'promo_discount' => $discount,
                                    );
                                    $this->db->where('id', $id);
                                    $zapak = $this->db->update('tbl_booking', $data_update);
                                    $data = [];
                                    $data = array(
                                        'promocode' => $promocode_data[0]->promocode,
                                        'promo_discount' => $discount,
                                    );
                                    $res = array(
                                        'message' => 'Promocode Applied Successfully!',
                                        'status' => 200,
                                        'data' => $data,
                                    );
                                    echo json_encode($res);
                                } else {
                                    $res = array(
                                        'message' => 'Minimum ' . $promocode_data[0]->mindays . ' days booking required for this promocode!',
                                        'status' => 201
                                    );
                                    echo json_encode($res);
                                }
                            } else {
                                $res = array(
                                    'message' => 'Promocode is already used!',
                                    'status' => 201
                                );
                                echo json_encode($res);
                            }
                        }
                        //---- every time promocode -------
                        else {
                            $discount_amt = $booking_data[0]->total_amount * $promocode_data[0]->percentage / 100;
                            if ($discount_amt > $promocode_data[0]->max) {
                                // will get max amount
                                $discount =  $promocode_data[0]->max;
                            } else {
                                $discount =  round($discount_amt, 2);
                            }
                            $data_update = array(
                                'promocode' => $promocode_data[0]->id,
                                'promo_discount' => $discount,
                            );
                            $this->db->where('id', $id);
                            $zapak = $this->db->update('tbl_booking', $data_update);
                            $data = [];
                            $data = array(
                                'promocode' => $promocode_data[0]->promocode,
                                'promo_discount' => $discount,
                            );
                            $res = array(
                                'message' => 'Promocode Applied Successfully!',
                                'status' => 200,
                                'data' => $data,
                            );
                            echo json_encode($res);
                        }
                    } else {
                        $res = array(
                            'message' => 'Invalid Promocode Used!',
                            'status' => 201
                        );
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'message' => 'Invalid Promocode Used!',
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
    public function remove_promo($idd)
    {
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
        if (!empty($user_data)) {
            $id = base64_decode($idd);
            $data['id'] = $idd;
            $user_id = $this->session->userdata('user_id');
            $order1 = $this->db->get_where('tbl_booking', array('user_id' => $user_data[0]->id, 'id' => $id))->result();
            if (!empty($order1)) {
                $data_update = array(
                    'promocode' => '',
                    'promo_discount' => '',
                );
                $this->db->where('id', $id);
                $zapak = $this->db->update('tbl_booking', $data_update);
                $res = array(
                    'message' => 'Promocode Removed Successfully!',
                    'status' => 200
                );
                echo json_encode($res);
            }
        } else {
            $res = array(
                'message' => 'Permission Denied!',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    public function self_booking_details($id)
    {
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
        if (!empty($user_data)) {
            $booking_data = $this->db->get_where('tbl_booking', array('id' => $id))->result();
            $car = $this->db->get_where('tbl_selfdrive', array('id' => $booking_data[0]->car_id))->result();
            $city = $this->db->get_where('tbl_cities', array('id' => $booking_data[0]->city_id))->result();
            //------ fuel type ---
            if ($car[0]->fule_type == 1) {
                $fuel_type = 'Petrol';
            } elseif ($car[0]->fule_type == 2) {
                $fuel_type = 'Diesel';
            } else {
                $fuel_type = 'CNG';
            }
            //------ Transmission  ---
            if ($car[0]->transmission == 1) {
                $transmission = 'Manual';
            } elseif ($car[0]->transmission == 2) {
                $transmission = 'Automatic';
            }
            $extra_kilo = $car[0]->extra_kilo;
            //------ seating  ---
            if ($car[0]->seatting == 1) {
                $seating = '4 Seates';
            } elseif ($car[0]->seatting == 2) {
                $seating = '5 Seates';
            } else {
                $seating = '7 Seates';
            }
            $data = [];
            $data = array(
                'city_id' => $car[0]->city_id,
                'car_id' => $car[0]->id,
                'brand_name' => $car[0]->brand_name,
                'car_name' => $car[0]->car_name,
                'photo' => base_url() . $car[0]->photo,
                'fuel_type' => $fuel_type,
                'transmission' => $transmission,
                'seating' => $seating,
                'extra_kilo' => $car[0]->extra_kilo,
                'kilometer' => $booking_data[0]->kilometer,
                'total_amount' => $booking_data[0]->total_amount,
                'final_amount' => $booking_data[0]->final_amount,
                'rsda' => $booking_data[0]->rsda,
                'kilometer_type' => $booking_data[0]->kilometer_type,
                'start_date' => $booking_data[0]->start_date,
                'start_time' => $booking_data[0]->start_time,
                'end_date' => $booking_data[0]->end_date,
                'end_time' => $booking_data[0]->end_time,
                'duration' => $booking_data[0]->duration,
                'promo_discount' => $booking_data[0]->promo_discount,
                'city_name' => $city[0]->name,
                'id' => "Booking Id: #" . $id
            );
            $res = array(
                'message' => 'Success!',
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
    }
    public function outstation_booking_details($id)
    {
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
        if (!empty($user_data)) {
            $booking_data = $this->db->get_where('tbl_booking', array('id' => $id))->result();
            $car = $this->db->get_where('tbl_outstation', array('id' => $booking_data[0]->car_id))->result();
            $city = $this->db->get_where('tbl_cities', array('id' => $booking_data[0]->city_id))->result();
            //------ seating  ---
            if ($car[0]->seatting == 1) {
                $seating = '4 Seates';
            } elseif ($car[0]->seatting == 2) {
                $seating = '5 Seates';
            } else {
                $seating = '7 Seates';
            }
            $data = [];
            $data = array(
                'city_id' => $car[0]->city_id,
                'car_id' => $car[0]->id,
                'brand_name' => $car[0]->brand_name,
                'car_name' => $car[0]->car_name,
                'photo' => base_url() . $car[0]->photo,
                'seating' => $seating,
                'per_kilometer' => $car[0]->per_kilometre,
                'location' => $car[0]->location,
                'min_booking_amt' => $booking_data[0]->mini_booking,
                'total_amount' => $booking_data[0]->total_amount,
                'final_amount' => $booking_data[0]->final_amount,
                'start_date' => $booking_data[0]->start_date,
                'start_time' => $booking_data[0]->start_time,
                'end_date' => $booking_data[0]->end_date,
                'end_time' => $booking_data[0]->end_time,
                'duration' => $booking_data[0]->duration,
                'round_type' => $booking_data[0]->round_type,
                'city_name' => $city[0]->name,
                'id' => "Booking Id: #" . $id
            );
            $res = array(
                'message' => 'Success!',
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
    }
    public function intercity_booking_details($id)
    {
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
        if (!empty($user_data)) {
            $booking_data = $this->db->get_where('tbl_booking', array('id' => $id))->result();
            $car = $this->db->get_where('tbl_intercity', array('id' => $booking_data[0]->car_id))->result();
            $city_data = $this->db->get_where('tbl_cities', array('id' => $booking_data[0]->city_id))->result();
            $data = [];
            $data = array(
                'city' => $city_data[0]->name,
                'cab_type' => $booking_data[0]->cab_type,
                'start_date' => $booking_data[0]->start_date,
                'start_time' => $booking_data[0]->start_time,
                'end_date' => $booking_data[0]->end_date,
                'end_time' => $booking_data[0]->end_time,
                'duration' => $booking_data[0]->duration,
                'kilometer_cap' => $booking_data[0]->kilometer,
                'final_amount' => $booking_data[0]->final_amount,
                'mini_booking' => $booking_data[0]->mini_booking,
                'id' => "Booking Id: #" . $id
            );
            $res = array(
                'message' => 'Success!',
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
    }
}

<?php
if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}
class CI_Booking
{
  protected $CI;
  public function __construct()
  {
    $this->CI = &get_instance();
    $this->CI->load->helper('form');
    $this->CI->load->model("admin/login_model");
    $this->CI->load->model("admin/base_model");
    $this->CI->load->library('pagination');
  }
  //======================== VIEW SELF DRIVE CARS ====================
  public function ViewSelfDriveCars($receive)
  {
    // print_r();die();
    //   if(!empty($receive['index'])){
    //     //--------- pagination config ----------------------
    //   $count = $this->CI->db->get_where('tbl_selfdrive', array('city_id'=> $receive['city_id'],'is_available'=> 1,'is_active'=>1))->num_rows();
    //         $config['base_url'] = base_url().'Home/self_drive_cars?city_id='.$receive['city_id'].'&start_date='.$receive['start_date'].'&start_time='.$receive['start_time'].'&end_date='.$receive['end_date'].'&end_time='.$receive['end_time'].'&duration='.$receive['duration'].'&index=';
    //         $per_page = 1;
    //         $config['total_rows'] = $count;
    //         $config['per_page'] = $per_page;
    //         $config['num_links'] = 5;
    //         $config['full_tag_open'] = '<ul class="pagination">';
    //         $config['full_tag_close'] = '</ul>';
    //         $config['use_page_numbers'] = true;
    //         $config['next_link'] = 'First';
    //         $config['first_tag_open'] = '<li class="first page">';
    //         $config['first_tag_close'] = '</li>';
    //         $config['last_link'] = 'Last';
    //         $config['last_tag_open'] = '<li class="last page">';
    //         $config['last_tag_close'] = '</li>';
    //         $config['next_link'] = 'Next';
    //         $config['next_tag_open'] = '<li class="page-item nextpage">';
    //         $config['next_tag_close'] = '</li>';
    //         $config['prev_link'] = ' Previous';
    //         $config['prev_tag_open'] = '<li class="page-item prevpage">';
    //         $config['prev_tag_close'] = '</li>';
    //         $config['cur_tag_open'] = '<li class="page-item"><a href="">';
    //         $config['cur_tag_close'] = '</a></li>';
    //         $config['num_tag_open'] = '<li class="page-item">';
    //         $config['num_tag_close'] = '</li>';
    //         $this->CI->pagination->initialize($config);
    //         if (!empty($receive['index'])) {
    //             // $i = $per_page * ($page - 1) + 1;
    //             $start = ($receive['index'] - 1) * $config['per_page'];
    //         } else {
    //             $page_index = 0;
    //             $start = 0;
    //             // $i=1;
    //         }
    //   $self_cars = $this->CI->db->limit($config["per_page"], $start)->get_where('tbl_selfdrive', array('city_id'=> $receive['city_id'],'is_available'=> 1,'is_active'=>1))->result();
    //     $links = $this->CI->pagination->create_links();
    //     print_r($links);die();
    // }else{
    if ($receive['sort'] != 'none') {
      $self_cars = $this->CI->db->order_by('price1', $receive['sort'])->get_where('tbl_selfdrive', array('city_id' => $receive['city_id'], 'is_active' => 1))->result();
    } else {
      $self_cars = $this->CI->db->order_by('is_available', 'desc')->get_where('tbl_selfdrive', array('city_id' => $receive['city_id'], 
       'is_active' => 1))->result();
    }
    //     $links='';
    // }
    // print_r($receive['brand']);die();
    $car_data = [];
    foreach ($self_cars as $self) {
      $b = 0;
      // ---brandwise filter -----
      if (!empty($receive['brand'])) {
        foreach ($receive['brand'] as $brd) {
          if ($brd == $self->brand_name) {
            $b = 1;
            break;
          }
        }
      }
      if ($b == 1 || empty($receive['brand'])) {
        //------ fuel type ---
        if ($self->fule_type == 1) {
          $fuel_type = 'Petrol';
        } elseif ($self->fule_type == 2) {
          $fuel_type = 'Diesel';
        } else {
          $fuel_type = 'CNG';
        }
        //------ Transmission  ---
        if ($self->transmission == 1) {
          $transmission = 'Manual';
        } elseif ($self->transmission == 2) {
          $transmission = 'Automatic';
        }
        //------ seating  ---
        if ($self->seatting == 1) {
          $seating = '5 Seates';
        } elseif ($self->seatting == 2) {
          $seating = '7 Seates';
        } else {
          $seating = '9 Seates';
        }
        $days = $receive['duration'] / 24;
        $car_data[] = array(
          'city_id' => $self->city_id,
          'car_id' => $self->id,
          'brand_name' => $self->brand_name,
          'car_name' => $self->car_name,
          'photo' => base_url() . $self->photo,
          'fuel_type' => $fuel_type,
          'transmission' => $transmission,
          'seating' => $seating,
          'kilometer1' => round($self->kilometer1 * $days, 2),
          'price1' => round($self->price1 * $days, 2),
          'kilometer2' => round($self->kilometer2 * $days, 2),
          'price2' => round($self->price2 * $days, 2),
          'kilometer3' => round($self->kilometer3 * $days, 2),
          'price3' => round($self->price3 * $days, 2),
          'extra_kilo' => $self->extra_kilo,
          'rsda' => $self->rsda,
          'active' => 1,
          'is_available' => $self->is_available,
          'price' => round($self->price1 * $days, 2)
        );
      }
    }
    //----------- fule typewise sort -----
    if (!empty($receive['fuel'])) {
      foreach ($car_data as $key => $self) {
        $b = 0;
        foreach ($receive['fuel'] as $f) {
          //------ fuel type ---
          if ($self['fuel_type'] == 'Petrol') {
            $fuel_type = 1;
          } elseif ($self['fuel_type'] == 'Diesel') {
            $fuel_type = 2;
          } else {
            $fuel_type = 3;
          }
          if ($f == $fuel_type) {
            $b = 1;
            break;
          }
        }
        if ($b == 0) {
          // echo $key;die();
          unset($car_data[$key]);
        }
      }
    }
    //----------- transmission typewise sort -----
    if (!empty($receive['transmission'])) {
      foreach ($car_data as $key => $self) {
        $b = 0;
        foreach ($receive['transmission'] as $f) {
          //------ fuel type ---
          //------ Transmission  ---
          if ($self['transmission'] == 'Manual') {
            $transmission = 1;
          } elseif ($self['transmission'] == 'Automatic') {
            $transmission = 2;
          }
          if ($f == $transmission) {
            $b = 1;
            break;
          }
        }
        if ($b == 0) {
          // echo $key;die();
          unset($car_data[$key]);
        }
      }
    }
    //----------- seating typewise sort -----
    if (!empty($receive['seating'])) {
      foreach ($car_data as $key => $self) {
        $b = 0;
        foreach ($receive['seating'] as $f) {
          //------ seating  ---
          if ($self['seating'] == '5 Seates') {
            $seating = 1;
          } elseif ($self['seating'] == '7 Seates') {
            $seating = 2;
          } else {
            $seating = 3;
          }
          if ($f == $seating) {
            $b = 1;
            break;
          }
        }
        if ($b == 0) {
          // echo $key;die();
          unset($car_data[$key]);
        }
      }
    }
    $respone['status'] = true;
    $respone['message'] = "Success";
    $respone['car_data'] = $car_data;
    // $respone['links'] =$links;
    return $respone;
    // return json_encode($respone);
  }
  //=========================== SELF DRIVE CAR CALCULATE ========================================
  public function selfDriveCarCalculate($receive)
  {
    $ip = $this->CI->input->ip_address();
    date_default_timezone_set("Asia/Calcutta");
    $cur_date = date("Y-m-d H:i:s");
    // echo $receive['type_id'];die();
    //------ get car data --------
    $car_data = $this->CI->db->get_where('tbl_selfdrive', array('id' => $receive['car_id']))->result();
    //----- check kilometer plan ------
    $days = $receive['duration'] / 24;
    if ($receive['type_id'] == 1) {
      $kilometer = round($car_data[0]->kilometer1 * $days, 2);
      $kilometer_price = round($car_data[0]->price1 * $days, 2);
    } elseif ($receive['type_id'] == 2) {
      $kilometer = round($car_data[0]->kilometer2 * $days, 2);
      $kilometer_price = round($car_data[0]->price2 * $days, 2);
    } else {
      $kilometer = round($car_data[0]->kilometer3 * $days, 2);
      $kilometer_price = round($car_data[0]->price3 * $days, 2);
    }
    //---- calculate total amount -------
    $rsda = $car_data[0]->rsda;
    $total = $kilometer_price;
    $final_amount = round($total + $rsda, 2);
    //------- insert into booking table --------
    if (!empty($receive['search_id'])) {
      $search_id = $receive['search_id'];
    } else {
      $search_id = '';
    }
    $data_insert = array(
      'user_id' => $receive['user_id'],
      'booking_type' => 1,
      'rsda' => $rsda,
      'kilometer' => $kilometer,
      'kilometer_price' => $kilometer_price,
      'total_amount' => $total,
      'final_amount' => $final_amount,
      'city_id' => $receive['city_id'],
      'start_date' => $receive['start_date'],
      'start_time' => $receive['start_time'],
      'end_date' => $receive['end_date'],
      'end_time' => $receive['end_time'],
      'duration' => $receive['duration'],
      'car_id' => $receive['car_id'],
      'kilometer_type' => $receive['type_id'],
      'search_id' => base64_decode($search_id),
      'order_status' => 0,
      'payment_status' => 0,
      'ip' => $ip,
      'date' => $cur_date,
    );
    $last_id = $this->CI->base_model->insert_table("tbl_booking", $data_insert, 1);
    $self = $this->CI->db->get_where('tbl_selfdrive', array('id' => $receive['car_id']))->result();
    //------ fuel type ---
    if ($self[0]->fule_type == 1) {
      $fuel_type = 'Petrol';
    } elseif ($self[0]->fule_type == 2) {
      $fuel_type = 'Diesel';
    } else {
      $fuel_type = 'CNG';
    }
    //------ Transmission  ---
    if ($self[0]->transmission == 1) {
      $transmission = 'Manual';
    } elseif ($self[0]->transmission == 2) {
      $transmission = 'Automatic';
    }
    //------ seating  ---
    if ($self[0]->seatting == 1) {
      $seating = '4 Seates';
    } elseif ($self[0]->seatting == 2) {
      $seating = '5 Seates';
    } else {
      $seating = '7 Seates';
    }
    $car_data = array(
      'city_id' => $self[0]->city_id,
      'car_id' => $self[0]->id,
      'brand_name' => $self[0]->brand_name,
      'car_name' => $self[0]->car_name,
      'photo' => base_url() . $self[0]->photo,
      'fuel_type' => $fuel_type,
      'transmission' => $transmission,
      'seating' => $seating,
      'kilometer1' => round($self[0]->kilometer1 * $days, 2),
      'price1' => round($self[0]->price1 * $days, 2),
      'kilometer2' => round($self[0]->kilometer2 * $days, 2),
      'price2' => round($self[0]->price2 * $days, 2),
      'kilometer3' => round($self[0]->kilometer3 * $days, 2),
      'price3' => round($self[0]->price3 * $days, 2),
      'extra_kilo' => $self[0]->extra_kilo,
      'kilometer' => $kilometer,
      'total_amount' => $total,
      'final_amount' => $final_amount,
      'rsda' => $rsda,
      'kilometer_type' => $receive['type_id'],
      'id' => base64_encode($last_id)
    );
    $respone['status'] = true;
    $respone['message'] = "Success";
    $respone['car_data'] = $car_data;
    $respone['id'] = $last_id;
    // $respone['links'] =$links;
    return $respone;
  }
  //========= selfdrive booking checkout========
  public function selfCheckout($id, $dob, $aadhar_no, $driving_lience, $aadhar_front, $aadhar_back, $license_front, $license_back, $user_id)
  {
    //-------- update user data ------
    $user_update = array(
      'dob' => $dob,
      'aadhar_no' => $aadhar_no,
      'driving_lience' => $driving_lience,
    );
    $this->CI->db->where('id', $user_id);
    $zapak = $this->CI->db->update('tbl_users', $user_update);
    $data = $this->CI->db->get_where('tbl_booking', array('id' => $id))->result();
    $final_amt = $data[0]->total_amount - $data[0]->promo_discount + $data[0]->rsda;
    //--------------------- update booking data -------------------
    $booking_update = array(
      'aadhar_front' => $aadhar_front,
      'aadhar_back' => $aadhar_back,
      'license_front' => $license_front,
      'license_back' => $license_back,
    );
    $this->CI->db->where('id', $id);
    $zapak = $this->CI->db->update('tbl_booking', $booking_update);
    return $final_amt;
  }
  //========= INTERCITY CALCULATE ========
  public function intercityCalculate($cab_type, $start_date, $start_time, $end_date, $end_time, $city_id, $duration, $user_id)
  {
    // echo $cab_type;die();
    $inter_data = $this->CI->db->get_where('tbl_intercity', array('is_active' => 1, 'city_id' => $city_id, 'cab_type' => $cab_type))->result();
    // print_r($inter_data);die();
    if (empty($inter_data)) {
      $respone['status'] = false;
      $respone['message'] = "Sorry! Currently No Car available for the selected city.";
      return $respone;
    }
    $city_data = $this->CI->db->get_where('tbl_cities', array('is_active' => 1, 'id' => $city_id))->result();
    $hours = $duration;
    // echo $hours;die();
    $kilometer = $inter_data[0]->Kilomitere_cab;
    if ($duration < 6) {
      $kilometer_price = $inter_data[0]->price * 6;
    } else {
      $kilometer_price = $inter_data[0]->price * $hours;
    }
    // echo $kilometer_price;die();
    $total = $kilometer_price;
    $final_amount = $kilometer_price;
    $ip = $this->CI->input->ip_address();
    date_default_timezone_set("Asia/Calcutta");
    $cur_date = date("Y-m-d H:i:s");
    //------- insert into booking table --------
    $data_insert = array(
      'user_id' => $user_id,
      'booking_type' => 2,
      'cab_type' => $cab_type,
      'kilometer' => $kilometer,
      'kilometer_price' => $kilometer_price,
      'total_amount' => $total,
      'final_amount' => $final_amount,
      'city_id' => $city_id,
      'start_date' => $start_date,
      'start_time' => $start_time,
      'end_date' => $end_date,
      'end_time' => $end_time,
      'duration' => $duration,
      'car_id' => $inter_data[0]->id,
      'mini_booking' => $inter_data[0]->min_amount,
      'order_status' => 0,
      'payment_status' => 0,
      'ip' => $ip,
      'date' => $cur_date,
    );
    $last_id = $this->CI->base_model->insert_table("tbl_booking", $data_insert, 1);
    $data = array(
      'city' => $city_data[0]->name,
      'cab_type' => $cab_type,
      'start_date' => $start_date,
      'start_time' => $start_time,
      'end_date' => $end_date,
      'end_time' => $end_time,
      'kilometer_cap' => $kilometer,
      'final_amount' => $final_amount,
      'mini_booking' => $inter_data[0]->min_amount,
      'id' => base64_encode($last_id),
    );
    $respone['status'] = true;
    $respone['message'] = "Success";
    $respone['data'] = $data;
    return $respone;
  }
  //======================== VIEW OUTSTATION CARS ====================
  public function ViewOutstationCars($receive)
  {
    if ($receive['sort'] != 'none') {
      $outstation_cars = $this->CI->db->order_by('per_kilometre', $receive['sort'])->get_where('tbl_outstation', array('city_id' => $receive['city_id'],  'is_active' => 1))->result();
    } else {
      $outstation_cars = $this->CI->db->order_by('is_available', 'desc')->get_where('tbl_outstation', array('city_id' => $receive['city_id'],  'is_active' => 1))->result();
    }
    $car_data = [];
    foreach ($outstation_cars as $car) {
      $b = 0;
      // --- seating wise filter -----
      if (!empty($receive['seating'])) {
        foreach ($receive['seating'] as $brd) {
          if ($brd == $car->seatting) {
            $b = 1;
            break;
          }
        }
      }
      if ($b == 1 || empty($receive['seating'])) {
        //------ seating  ---
        if ($car->seatting == 1) {
          $seating = '5 Seates';
        } elseif ($car->seatting == 2) {
          $seating = '7 Seates';
        } else {
          $seating = '9 Seates';
        }
        // $days =$receive['duration']/24;
        $car_data[] = array(
          'city_id' => $car->city_id,
          'car_id' => $car->id,
          'brand_name' => $car->brand_name,
          'car_name' => $car->car_name,
          'photo' => base_url() . $car->photo,
          'seating' => $seating,
          'per_kilometer' => $car->per_kilometre,
          'location' => $car->location,
          'min_booking_amt' => $car->min_booking_amt,
          'is_available' => $car->is_available,
        );
      }
    }
    $respone['status'] = true;
    $respone['message'] = "Success";
    $respone['car_data'] = $car_data;
    // $respone['links'] =$links;
    return $respone;
    // return json_encode($respone);
  }
  //=========================== outstation CAR CALCULATE ========================================
  public function outstationCalculate($receive)
  {
    $ip = $this->CI->input->ip_address();
    date_default_timezone_set("Asia/Calcutta");
    $cur_date = date("Y-m-d H:i:s");
    // echo $receive['type_id'];die();
    //------ get car data --------
    $car_data = $this->CI->db->get_where('tbl_outstation', array('id' => $receive['car_id']))->result();
    //---- calculate total amount -------
    $mini_booking = $car_data[0]->min_booking_amt;
    $kilometer_price = $car_data[0]->per_kilometre;
    $total = $car_data[0]->min_booking_amt;
    $final_amount = $mini_booking;
    if (!empty($receive['search_id'])) {
      $search_id = $receive['search_id'];
      $search_data = $this->CI->db->get_where('tbl_search', array('id' => $receive['search_id']))->result();
      $pick_location = $search_data[0]->pick_location;
      $drop_location = $search_data[0]->drop_location;
    } else {
      $search_id = '';
      $pick_location = $receive['pick_location'];
      $drop_location = $receive['drop_location'];
    }
    //------- insert into booking table --------
    $data_insert = array(
      'user_id' => $receive['user_id'],
      'booking_type' => 3,
      'mini_booking' => $mini_booking,
      'kilometer_price' => $kilometer_price,
      'total_amount' => $total,
      'final_amount' => $final_amount,
      'city_id' => $receive['city_id'],
      'start_date' => $receive['start_date'],
      'start_time' => $receive['start_time'],
      'end_date' => $receive['end_date'],
      'end_time' => $receive['end_time'],
      'duration' => $receive['duration'],
      'round_type' => $receive['round_type'],
      'car_id' => $receive['car_id'],
      'pick_location' => $pick_location,
      'drop_location' => $drop_location,
      'search_id' => base64_decode($search_id),
      'order_status' => 0,
      'payment_status' => 0,
      'ip' => $ip,
      'date' => $cur_date,
    );
    $last_id = $this->CI->base_model->insert_table("tbl_booking", $data_insert, 1);
    $car = $this->CI->db->get_where('tbl_outstation', array('id' => $receive['car_id']))->result();
    //------ seating  ---
    if ($car[0]->seatting == 1) {
      $seating = '4 Seates';
    } elseif ($car[0]->seatting == 2) {
      $seating = '5 Seates';
    } else {
      $seating = '7 Seates';
    }
    $car_data = array(
      'city_id' => $car[0]->city_id,
      'car_id' => $car[0]->id,
      'brand_name' => $car[0]->brand_name,
      'car_name' => $car[0]->car_name,
      'photo' => base_url() . $car[0]->photo,
      'seating' => $seating,
      'per_kilometer' => $car[0]->per_kilometre,
      'location' => $car[0]->location,
      'min_booking_amt' => $car[0]->min_booking_amt,
      'id' => base64_encode($last_id)
    );
    $respone['status'] = true;
    $respone['message'] = "Success";
    $respone['car_data'] = $car_data;
    $respone['id'] = $last_id;
    // $respone['links'] =$links;
    return $respone;
  }
}

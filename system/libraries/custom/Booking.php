<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_Booking
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
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
        $self_cars = $this->CI->db->get_where('tbl_selfdrive', array('city_id'=> $receive['city_id'],'is_available'=> 1,'is_active'=>1))->result();
        //     $links='';
        // }
        // print_r($self_cars);die();
        $car_data=[];
        foreach ($self_cars as $self) {
            //------ fuel type ---
            if ($self->fule_type==1) {
                $fuel_type = 'Petrol';
            } elseif ($self->fule_type==2) {
                $fuel_type = 'Diesel';
            } else {
                $fuel_type = 'CNG';
            }
            //------ Transmission  ---
            if ($self->transmission==1) {
                $transmission = 'Manual';
            } elseif ($self->transmission==2) {
                $transmission = 'Automatic';
            }
            //------ seating  ---
            if ($self->seatting==1) {
                $seating = '4 Seates';
            } elseif ($self->seatting==2) {
                $seating = '5 Seates';
            } else {
                $seating = '7 Seates';
            }
            $days =$receive['duration']*24;
            $car_data[] = array('city_id'=>$self->city_id,
                    'car_id'=>$self->id,
                    'brand_name'=>$self->brand_name,
                    'car_name'=>$self->car_name,
                    'photo'=>$self->photo,
                    'fuel_type'=>$fuel_type,
                    'transmission'=>$transmission,
                    'seating'=>$seating,
                    'kilometer1'=>$self->kilometer1*$days,
                    'price1'=>$self->price1*$days,
                    'kilometer2'=>$self->kilometer2*$days,
                    'price2'=>$self->price2*$days,
                    'kilometer3'=>$self->kilometer3*$days,
                    'price3'=>$self->price3*$days,
                    'extra_kilo'=>$self->extra_kilo,
                    'rsda'=>$self->rsda,
                    );
        }
        $respone['status'] = true;
        $respone['message'] ="Success";
        $respone['car_data'] =$car_data;
        // $respone['links'] =$links;
        return $respone;
        // return json_encode($respone);
    }
    //=========================== SELF DRIVE CAR CALCULATE ========================================
    public function selfDriveCarCalculate($receive)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        // echo $receive['type_id'];die();
        //------ get car data --------
        $car_data = $this->CI->db->get_where('tbl_selfdrive', array('id'=> $receive['car_id']))->result();
        //----- check kilometer plan ------
        $days =$receive['duration']*24;
        if ($receive['type_id']==1) {
            $kilometer = $car_data[0]->kilometer1*$days;
            $kilometer_price = $car_data[0]->price1*$days;
        } elseif ($receive['type_id']==2) {
            $kilometer = $car_data[0]->kilometer2*$days;
            $kilometer_price = $car_data[0]->price2*$days;
        } else {
            $kilometer = $car_data[0]->kilometer3*$days;
            $kilometer_price = $car_data[0]->price3*$days;
        }
        //---- calculate total amount -------
        $rsda = $car_data[0]->rsda;
        $total = $kilometer_price;
        $final_amount = $total + $rsda;
        $user_id=$this->CI->session->userdata('user_id');
        //------- insert into booking table --------
        $data_insert = array('user_id'=>$user_id,
              'booking_type'=>1,
              'rsda'=>$rsda,
              'kilometer'=>$kilometer,
              'kilometer_price'=>$kilometer_price,
              'total_amount'=>$total,
              'final_amount'=>$final_amount,
              'city_id'=>$receive['city_id'],
              'start_date'=>$receive['start_date'],
              'start_time'=>$receive['start_time'],
              'end_date'=>$receive['end_date'],
              'end_time'=>$receive['end_time'],
              'duration'=>$receive['duration'],
              'city_id'=>$receive['city_id'],
              'car_id'=>$receive['car_id'],
              'kilometer_type'=>$receive['type_id'],
              'search_id'=>base64_decode($receive['search_id']),
              'order_status'=>0,
              'payment_status'=>0,
              'ip'=>$ip,
              'date'=>$cur_date,
                  );
        $last_id=$this->CI->base_model->insert_table("tbl_booking", $data_insert, 1) ;
        $self= $this->CI->db->get_where('tbl_selfdrive', array('id'=> $receive['car_id']))->result();
        //------ fuel type ---
        if ($self[0]->fule_type==1) {
            $fuel_type = 'Petrol';
        } elseif ($self[0]->fule_type==2) {
            $fuel_type = 'Diesel';
        } else {
            $fuel_type = 'CNG';
        }
        //------ Transmission  ---
        if ($self[0]->transmission==1) {
            $transmission = 'Manual';
        } elseif ($self->transmission==2) {
            $transmission = 'Automatic';
        }
        //------ seating  ---
        if ($self[0]->seatting==1) {
            $seating = '4 Seates';
        } elseif ($self[0]->seatting==2) {
            $seating = '5 Seates';
        } else {
            $seating = '7 Seates';
        }
        $car_data= array('city_id'=>$self[0]->city_id,
                              'car_id'=>$self[0]->id,
                              'brand_name'=>$self[0]->brand_name,
                              'car_name'=>$self[0]->car_name,
                              'photo'=>$self[0]->photo,
                              'fuel_type'=>$fuel_type,
                              'transmission'=>$transmission,
                              'seating'=>$seating,
                              'extra_kilo'=>$self[0]->extra_kilo,

                              );
        $respone['status'] = true;
        $respone['message'] ="Success";
        $respone['car_data'] =$car_data;
        $respone['id'] =$last_id;
        // $respone['links'] =$links;
        return $respone;
    }
    //========= selfdrive booking checkout========
    public function selfCheckout($id,$dob,$aadhar_no,$driving_lience,$pickup_location,$aadhar_front,$aadhar_back,$license_front,$license_back)
    {
    $user_id=$this->CI->session->userdata('user_id');
      //-------- update user data ------
      $user_update = array('dob'=>$dob,
                        'aadhar_no'=>$aadhar_no,
                        'driving_lience'=>$driving_lience,
                  );
                  $this->CI->db->where('id', $user_id);
                  $zapak=$this->CI->db->update('tbl_users', $user_update);

//--------------------- update booking data -------------------
$booking_update = array('pick_location'=>$pickup_location,
                  'aadhar_front'=>$aadhar_front,
                  'aadhar_back'=>$aadhar_back,
                  'license_front'=>$license_front,
                  'license_back'=>$license_back,
            );
            $this->CI->db->where('id', $id);
            $zapak=$this->CI->db->update('tbl_booking', $booking_update);
  return ;
    }
    //========= INTERCITY CALCUALTE ========
    public function intercityCalculate($cab_type, $start_date, $start_time, $end_date, $end_time, $city_id, $duration)
    {

        $inter_data = $this->CI->db->get_where('tbl_intercity', array('is_active'=> 1,'city_id'=> $city_id,'cab_type'=> $cab_type))->result();
        // print_r($inter_data);die();
        $city_data = $this->CI->db->get_where('tbl_cities', array('is_active'=> 1,'id'=> $city_id))->result();
        $hours=$duration;
        $user_id=$this->CI->session->userdata('user_id');
        $kilometer = $inter_data[0]->Kilomitere_cab;
        if ($duration<6) {
            $kilometer_price = $inter_data[0]->price*6;
        } else {
            $kilometer_price = $inter_data[0]->price*$hours;
        }
        $total = $kilometer_price;
        $final_amount = $kilometer_price;
        $ip = $this->CI->input->ip_address();
                   date_default_timezone_set("Asia/Calcutta");
                   $cur_date=date("Y-m-d H:i:s");
        //------- insert into booking table --------
        $data_insert = array('user_id'=>$user_id,
              'booking_type'=>2,
              'cab_type'=>$cab_type,
              'kilometer'=>$kilometer,
              'kilometer_price'=>$kilometer_price,
              'total_amount'=>$total,
              'final_amount'=>$final_amount,
              'city_id'=>$city_id,
              'start_date'=>$start_date,
              'start_time'=>$start_time,
              'end_date'=>$end_date,
              'end_time'=>$end_time,
              'duration'=>$duration,
              'car_id'=>$inter_data[0]->id,
              'mini_booking'=>$inter_data[0]->min_amount,
              'order_status'=>0,
              'payment_status'=>0,
              'ip'=>$ip,
              'date'=>$cur_date,
                  );
        $last_id=$this->CI->base_model->insert_table("tbl_booking", $data_insert, 1) ;
        $data= array('city'=>$city_data[0]->name,
                  'cab_type'=>$cab_type,
                  'start_date'=>$start_date,
                  'start_time'=>$start_time,
                  'end_date'=>$end_date,
                  'end_time'=>$end_time,
                  'kilometer_cap'=>$kilometer,
                  'final_amount'=>$final_amount,
                  'mini_booking'=>$inter_data[0]->min_amount,
                  'id'=>base64_encode($last_id),

                  );
        $respone['status'] = true;
        $respone['message'] ="Success";
        $respone['data'] =$data;
        return $respone;
    }
    //======================== VIEW OUTSTATION CARS ====================
    public function ViewOutstationCars($receive)
    {

        $outstation_cars = $this->CI->db->get_where('tbl_outstation', array('city_id'=> $receive['city_id'],'is_available'=> 1,'is_active'=>1))->result();

        $car_data=[];
        foreach ($outstation_cars as $car) {
            //------ seating  ---
            if ($car->seatting==1) {
                $seating = '4 Seates';
            } elseif ($car->seatting==2) {
                $seating = '5 Seates';
            } else {
                $seating = '7 Seates';
            }
            // $days =$receive['duration']*24;
            $car_data[] = array('city_id'=>$car->city_id,
                    'car_id'=>$car->id,
                    'brand_name'=>$car->brand_name,
                    'car_name'=>$car->car_name,
                    'photo'=>$car->photo,
                    'seating'=>$seating,
                    'per_kilometer'=>$car->per_kilometre,
                    'location'=>$car->location,
                    'min_booking_amt'=>$car->min_booking_amt,
                    );
        }
        $respone['status'] = true;
        $respone['message'] ="Success";
        $respone['car_data'] =$car_data;
        // $respone['links'] =$links;
        return $respone;
        // return json_encode($respone);
    }
    //=========================== outstation CAR CALCULATE ========================================
    public function outstationCalculate($receive)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        // echo $receive['type_id'];die();
        //------ get car data --------
        $car_data = $this->CI->db->get_where('tbl_outstation', array('id'=> $receive['car_id']))->result();
        //----- check kilometer plan ------
        // $days =$receive['duration']*24;

        //---- calculate total amount -------
        $mini_booking = $car_data[0]->min_booking_amt;
        $total = $car_data[0]->min_booking_amt;
        $final_amount = $total + $mini_booking;
        $user_id=$this->CI->session->userdata('user_id');
        //------- insert into booking table --------
        $data_insert = array('user_id'=>$user_id,
              'booking_type'=>1,
              'mini_booking'=>$mini_booking,
              'total_amount'=>$total,
              'final_amount'=>$final_amount,
              'city_id'=>$receive['city_id'],
              'start_date'=>$receive['start_date'],
              'start_time'=>$receive['start_time'],
              'end_date'=>$receive['end_date'],
              'end_time'=>$receive['end_time'],
              'duration'=>$receive['duration'],
              'round_type'=>$receive['round_type'],
              'city_id'=>$receive['city_id'],
              'car_id'=>$receive['car_id'],
              'search_id'=>base64_decode($receive['search_id']),
              'order_status'=>0,
              'payment_status'=>0,
              'ip'=>$ip,
              'date'=>$cur_date,
                  );
        $last_id=$this->CI->base_model->insert_table("tbl_booking", $data_insert, 1) ;
        $car= $this->CI->db->get_where('tbl_outstation', array('id'=> $receive['car_id']))->result();

        //------ seating  ---
        if ($car[0]->seatting==1) {
            $seating = '4 Seates';
        } elseif ($car[0]->seatting==2) {
            $seating = '5 Seates';
        } else {
            $seating = '7 Seates';
        }
        $car_data= array('city_id'=>$car[0]->city_id,
                              'car_id'=>$car[0]->id,
                              'brand_name'=>$car[0]->brand_name,
                              'car_name'=>$car[0]->car_name,
                              'photo'=>$car[0]->photo,
                              'seating'=>$seating,
                              'per_kilometer'=>$car[0]->per_kilometre,
                              'location'=>$car[0]->location,
                              'min_booking_amt'=>$car[0]->min_booking_amt,

                              );
        $respone['status'] = true;
        $respone['message'] ="Success";
        $respone['car_data'] =$car_data;
        $respone['id'] =$last_id;
        // $respone['links'] =$links;
        return $respone;
    }
}

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
    public function selfDriveCarCalculate($receive){
      $ip = $this->CI->input->ip_address();
      date_default_timezone_set("Asia/Calcutta");
      $cur_date=date("Y-m-d H:i:s");
      // echo $receive['type_id'];die();
      //------ get car data --------
      $car_data = $this->CI->db->get_where('tbl_selfdrive', array('id'=> $receive['car_id']))->result();
      //----- check kilometer plan ------
      if($receive['type_id']==1){
      $kilometer = $car_data[0]->kilometer1;
      $kilometer_price = $car_data[0]->price1;
      }else if($receive['type_id']==2){
        $kilometer = $car_data[0]->kilometer2;
        $kilometer_price = $car_data[0]->price3;
      }else{
        $kilometer = $car_data[0]->kilometer3;
        $kilometer_price = $car_data[0]->price3;
      }
      //---- calculate total amount -------
      $rsda = $car_data[0]->rsda;
      $total = $kilometer_price*$receive['duration'];
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
              'order_status'=>0,
              'payment_status'=>0,
              'ip'=>$ip,
              'date'=>$cur_date,
                  );
          $last_id=$this->CI->base_model->insert_table("tbl_booking",$data_insert,1) ;
          return $last_id;
    }
}

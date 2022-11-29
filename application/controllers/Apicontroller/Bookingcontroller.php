<?php
if (! defined('BASEPATH')) {
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
    }
    //==============================SELF DRIVE CARS========================\\
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
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $self_drive_data = $this->db->get_where('tbl_selfdrive', array('is_active'=> 1,'city_id'=>$city_id,'is_available'=>1))->result();
                $data=[];
                foreach ($self_drive_data as $self_drive) {
                    if (!empty($self_drive->photo)) {
                        $photo=base_url().$self_drive->photo;
                    } else {
                        $photo='';
                    }
                    $data[]=array('city_id'=>$self_drive->city_id,
                               'brand_name'=>$self_drive->brand_name,
                               'car_name'=>$self_drive->car_name,
                               'photo'=>$photo,
                               'fule_type'=>$self_drive->fule_type,
                               'transmission'=>$self_drive->transmission,
                               'seatting'=>$self_drive->seatting,
                               'kilometer1'=>$self_drive->kilometer1,
                               'price1'=>$self_drive->price1,
                               'kilometer2'=>$self_drive->kilometer2,
                               'price2'=>$self_drive->price2,
                               'kilometer3'=>$self_drive->kilometer3,
                               'price3'=>$self_drive->price3,
                               'extra_kilo'=>$self_drive->extra_kilo,
                               'rsda'=>$self_drive->rsda
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
    //=================================================GET OUTSATION CARS==================================//
    public function get_outstation_cars()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('drop_location', 'drop_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('trip_status', 'trip_status', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_date', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $pickup_location=$this->input->post('pickup_location');
                $drop_location=$this->input->post('drop_location');
                $trip_status=$this->input->post('trip_status');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $outstation_data = $this->db->get_where('tbl_outstation', array('is_active'=> 1,'city_id'=>$city_id,'is_available'=>1))->result();
                $data=[];
                foreach ($outstation_data as $outstation) {
                    if (!empty($outstation->photo)) {
                        $photo=base_url().$outstation->photo;
                    } else {
                        $photo='';
                    }
                    $data[]=array(   'city_id'=>$outstation->city_id,
                      'brand_name'=>$outstation->brand_name,
                               'car_name'=>$outstation->car_name,
                               'seatting'=>$outstation->seatting,
                           'photo'=>$photo,
                               'per_kilometre'=>$outstation->per_kilometre,
                               'location'=>$outstation->location
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
    //==============================================GET INTERCITY CARS=======================================//
    
    public function get_intercity_booking()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('drop_location', 'drop_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('trip_status', 'trip_status', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $pickup_location=$this->input->post('pickup_location');
                $drop_location=$this->input->post('drop_location');
                $trip_status=$this->input->post('trip_status');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $intercity_data = $this->db->get_where('tbl_intercity', array('is_active'=> 1,))->result();
                $data=[];
                foreach ($intercity_data as $intercity) {
                    $data[]=array(   'city_id'=>$intercity->city_id,
                      'cab_type'=>$intercity->cab_type,
                               'cab_type'=>$intercity->cab_type,
                               'Kilomitere_cab'=>$intercity->Kilomitere_cab,
                               'min_amount'=>$intercity->min_amount,
                               
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
    //========================================SELF CARS CALCULAT==========================================//
    public function self_calculat()
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
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $self_drive_data = $this->db->get_where('tbl_selfdrive', array('is_active'=> 1,'city_id'=>$city_id,'is_available'=>1))->result();
                $data=[];
                foreach ($self_drive_data as $self_drive) {
                    if (!empty($self_drive->photo)) {
                        $photo=base_url().$self_drive->photo;
                    } else {
                        $photo='';
                    }
                    $data[]=array('city_id'=>$self_drive->city_id,
                               'brand_name'=>$self_drive->brand_name,
                               'car_name'=>$self_drive->car_name,
                               'photo'=>$photo,
                               'fule_type'=>$self_drive->fule_type,
                               'transmission'=>$self_drive->transmission,
                               'seatting'=>$self_drive->seatting,
                               'kilometer1'=>$self_drive->kilometer1,
                               'price1'=>$self_drive->price1,
                               'kilometer2'=>$self_drive->kilometer2,
                               'price2'=>$self_drive->price2,
                               'kilometer3'=>$self_drive->kilometer3,
                               'price3'=>$self_drive->price3,
                               'extra_kilo'=>$self_drive->extra_kilo,
                               'rsda'=>$self_drive->rsda
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
    //========================================SELF CARS CHECKOUT==========================================//
    public function self_checkout()
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
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $self_drive_data = $this->db->get_where('tbl_selfdrive', array('is_active'=> 1,'city_id'=>$city_id,'is_available'=>1))->result();
                $data=[];
                foreach ($self_drive_data as $self_drive) {
                    if (!empty($self_drive->photo)) {
                        $photo=base_url().$self_drive->photo;
                    } else {
                        $photo='';
                    }
                    $data[]=array('city_id'=>$self_drive->city_id,
                               'brand_name'=>$self_drive->brand_name,
                               'car_name'=>$self_drive->car_name,
                               'photo'=>$photo,
                               'fule_type'=>$self_drive->fule_type,
                               'transmission'=>$self_drive->transmission,
                               'seatting'=>$self_drive->seatting,
                               'kilometer1'=>$self_drive->kilometer1,
                               'price1'=>$self_drive->price1,
                               'kilometer2'=>$self_drive->kilometer2,
                               'price2'=>$self_drive->price2,
                               'kilometer3'=>$self_drive->kilometer3,
                               'price3'=>$self_drive->price3,
                               'extra_kilo'=>$self_drive->extra_kilo,
                               'rsda'=>$self_drive->rsda
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
     //=================================================GET OUTSATION CARS CALCULAT==================================//
     public function outsation_calculat()
     {
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->load->helper('security');
         if ($this->input->post()) {
             $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
             $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
             $this->form_validation->set_rules('drop_location', 'drop_location', 'required|xss_clean|trim');
             $this->form_validation->set_rules('trip_status', 'trip_status', 'required|xss_clean|trim');
             $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
             $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
             $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
             $this->form_validation->set_rules('end_time', 'end_date', 'required|xss_clean|trim');
             if ($this->form_validation->run()== true) {
                 $city_id=$this->input->post('city_id');
                 $pickup_location=$this->input->post('pickup_location');
                 $drop_location=$this->input->post('drop_location');
                 $trip_status=$this->input->post('trip_status');
                 $start_date=$this->input->post('start_date');
                 $start_time=$this->input->post('start_time');
                 $end_date=$this->input->post('end_date');
                 $end_time=$this->input->post('end_time');
                 $outstation_data = $this->db->get_where('tbl_outstation', array('is_active'=> 1,'city_id'=>$city_id,'is_available'=>1))->result();
                 $data=[];
                 foreach ($outstation_data as $outstation) {
                     if (!empty($outstation->photo)) {
                         $photo=base_url().$outstation->photo;
                     } else {
                         $photo='';
                     }
                     $data[]=array(   'city_id'=>$outstation->city_id,
                       'brand_name'=>$outstation->brand_name,
                                'car_name'=>$outstation->car_name,
                                'seatting'=>$outstation->seatting,
                            'photo'=>$photo,
                                'per_kilometre'=>$outstation->per_kilometre,
                                'location'=>$outstation->location
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
      //=================================================GET OUTSATION CARS CHECKOUT==================================//
      public function outsation_checkout()
      {
          $this->load->helper(array('form', 'url'));
          $this->load->library('form_validation');
          $this->load->helper('security');
          if ($this->input->post()) {
              $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
              $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
              $this->form_validation->set_rules('drop_location', 'drop_location', 'required|xss_clean|trim');
              $this->form_validation->set_rules('trip_status', 'trip_status', 'required|xss_clean|trim');
              $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
              $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
              $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
              $this->form_validation->set_rules('end_time', 'end_date', 'required|xss_clean|trim');
              if ($this->form_validation->run()== true) {
                  $city_id=$this->input->post('city_id');
                  $pickup_location=$this->input->post('pickup_location');
                  $drop_location=$this->input->post('drop_location');
                  $trip_status=$this->input->post('trip_status');
                  $start_date=$this->input->post('start_date');
                  $start_time=$this->input->post('start_time');
                  $end_date=$this->input->post('end_date');
                  $end_time=$this->input->post('end_time');
                  $outstation_data = $this->db->get_where('tbl_outstation', array('is_active'=> 1,'city_id'=>$city_id,'is_available'=>1))->result();
                  $data=[];
                  foreach ($outstation_data as $outstation) {
                      if (!empty($outstation->photo)) {
                          $photo=base_url().$outstation->photo;
                      } else {
                          $photo='';
                      }
                      $data[]=array(   'city_id'=>$outstation->city_id,
                        'brand_name'=>$outstation->brand_name,
                                 'car_name'=>$outstation->car_name,
                                 'seatting'=>$outstation->seatting,
                             'photo'=>$photo,
                                 'per_kilometre'=>$outstation->per_kilometre,
                                 'location'=>$outstation->location
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
      //==============================================GET INTERCITY CARS CALCULAT=======================================//
    
    public function intercity_calculat()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('drop_location', 'drop_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('trip_status', 'trip_status', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $pickup_location=$this->input->post('pickup_location');
                $drop_location=$this->input->post('drop_location');
                $trip_status=$this->input->post('trip_status');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $intercity_data = $this->db->get_where('tbl_intercity', array('is_active'=> 1,))->result();
                $data=[];
                foreach ($intercity_data as $intercity) {
                    $data[]=array(   'city_id'=>$intercity->city_id,
                      'cab_type'=>$intercity->cab_type,
                               'cab_type'=>$intercity->cab_type,
                               'Kilomitere_cab'=>$intercity->Kilomitere_cab,
                               'min_amount'=>$intercity->min_amount,
                               
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
    //==============================================GET INTERCITY CARS CHECKOUT=======================================//
    
    public function intercity_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('drop_location', 'drop_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('trip_status', 'trip_status', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $pickup_location=$this->input->post('pickup_location');
                $drop_location=$this->input->post('drop_location');
                $trip_status=$this->input->post('trip_status');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $intercity_data = $this->db->get_where('tbl_intercity', array('is_active'=> 1,))->result();
                $data=[];
                foreach ($intercity_data as $intercity) {
                    $data[]=array(   'city_id'=>$intercity->city_id,
                      'cab_type'=>$intercity->cab_type,
                               'cab_type'=>$intercity->cab_type,
                               'Kilomitere_cab'=>$intercity->Kilomitere_cab,
                               'min_amount'=>$intercity->min_amount,
                               
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
    //==============================================MY BOOKING============================================//
}
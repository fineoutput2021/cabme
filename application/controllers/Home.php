<?php
if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library("custom/Booking");
        $this->load->library("custom/Forms");
    }
    //=============================================== Index ==============================================================
    public function index()
    {
        $data['banner_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_banner', array('is_active'=> 1))->result();
        $data['testimonials_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_testimonials', array('is_active'=> 1))->result();
        $data['promocode_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_promocode', array('is_active'=> 1))->result();
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/index');
        $this->load->view('frontend/common/footer');
    }
    //================================================= SELF DRIVE Search ======================================
    public function self_drive_cars()
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
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $duration=$this->input->post('duration');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $data_insert = array(
              'city_id'=>$city_id,
              'start_date'=>$start_date,
              'start_time'=>$start_time,
              'end_date'=>$end_date,
              'end_time'=>$end_time,
              'duration'=>$duration,
              'date'=>$cur_date,
                        );
                $last_id=$this->base_model->insert_table("tbl_search", $data_insert, 1) ;
                $id = base64_encode($last_id);
                redirect("Home/show_self_drive_cars/$id", "refresh");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //========================== self drive cars ============================
    public function show_self_drive_cars($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        $search = $this->db->get_where('tbl_search', array('id'=> $id))->result();
        //----- start check date is past ----------
        date_default_timezone_set('Asia/Kolkata');
        $newdate = new DateTime($search[0]->start_date);
        $date=$newdate->format('Y-m-d');
        $newtime= new DateTime($search[0]->start_time);
        $time=$newtime->format('H:i:s');
        $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
        $curDateTime = date("Y-m-d H:i:s");
          if ($curDateTime > $myDate) {
        $this->session->set_flashdata('emessage', 'Please select date and time agian!');
          redirect("Home","refresh");
        }
        //----- end check date is past ----------
        if (isset($_GET['sort'])) {
            $sort = $_GET["sort"];
        } else {
            $sort ='';
        }
        if (isset($_GET['brand'])) {
            $brand = $_GET["brand"];
        } else {
            $brand ='';
        }
        if (isset($_GET['fuel'])) {
            $fuel = $_GET["fuel"];
        } else {
            $fuel ='';
        }
        if (isset($_GET['transmission'])) {
            $transmission = $_GET["transmission"];
        } else {
            $transmission ='';
        }
        if (isset($_GET['seating'])) {
            $seating = $_GET["seating"];
        } else {
            $seating ='';
        }
        // print_r($brand);die();
        $send= array(
        'city_id'=>$search[0]->city_id,
        'start_date'=>$search[0]->start_date,
        'start_time'=>$search[0]->start_time,
        'end_date'=>$search[0]->end_date,
        'end_time'=>$search[0]->end_time,
        'duration'=>$search[0]->duration,
        'brand'=>$brand,
        'fuel'=>$fuel,
        'transmission'=>$transmission,
        'seating'=>$seating,
        'sort'=>$sort,
        // 'index'=>$index,
      );
        $car_data = $this->booking->ViewSelfDriveCars($send);
        $data['car_data']= $car_data['car_data'];
        $data['search']= $search;
        $data['brand']= $brand;
        $data['fuel']= $fuel;
        $data['transmission']= $transmission;
        $data['seating']= $seating;
        $data['sort']= $sort;
        $this->load->view('frontend/common/header2', $data);
        $this->load->view('frontend/self_drive_cars');
        $this->load->view('frontend/common/footer', "refresh");
    }
    //========================== self drive calculate ============================
    public function self_drive_calculate()
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
            $this->form_validation->set_rules('car_id', 'car_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('search_id', 'search_id', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $duration=$this->input->post('duration');
                $car_id=$this->input->post('car_id');
                $type_id=$this->input->post('type_id');
                $search_id=$this->input->post('search_id');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $user_id=$this->session->userdata('user_id');
                $send = array(
              'user_id'=>$user_id,
              'city_id'=>$city_id,
              'start_date'=>$start_date,
              'start_time'=>$start_time,
              'end_date'=>$end_date,
              'end_time'=>$end_time,
              'duration'=>$duration,
              'city_id'=>$city_id,
              'car_id'=>$car_id,
              'type_id'=>$type_id,
              'search_id'=>$search_id,
                        );
                $response = $this->booking->selfDriveCarCalculate($send);
                $id = base64_encode($response['id']);
                redirect("Home/self_drive_summary/$id");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //========================== SELF DRIVE SUMMARY =============================
    public function self_drive_summary($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        if($data['booking_data'][0]->payment_status!=1){
        //----- start check date is past ----------
        date_default_timezone_set('Asia/Kolkata');
        $newdate = new DateTime($data['booking_data'][0]->start_date);
        $date=$newdate->format('Y-m-d');
        $newtime= new DateTime($data['booking_data'][0]->start_time);
        $time=$newtime->format('H:i:s');
        $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
        $curDateTime = date("Y-m-d H:i:s");
          if ($curDateTime > $myDate) {
        $this->session->set_flashdata('emessage', 'Please select date and time agian!');
          redirect("Home","refresh");
        }
        //----- end check date is past ----------
        $self = $this->db->get_where('tbl_selfdrive', array('id'=> $data['booking_data'][0]->car_id))->result();
        $data['user_data'] = $this->db->get_where('tbl_users', array('id'=> $data['booking_data'][0]->user_id))->result();
        //-----========= city data =============
        $city = $this->db->get_where('tbl_cities', array('id'=> $data['booking_data'][0]->city_id))->result();
        $data['city_data']=$city;
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
        } elseif ($self[0]->transmission==2) {
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
        $days =$data['booking_data'][0]->duration/24;
        $car_data= array(
                      'brand_name'=>$self[0]->brand_name,
                      'car_name'=>$self[0]->car_name,
                      'photo'=>$self[0]->photo,
                      'fuel_type'=>$fuel_type,
                      'transmission'=>$transmission,
                      'seating'=>$seating,
                      'kilometer1'=>$self[0]->kilometer1*$days,
                            'price1'=>$self[0]->price1*$days,
                            'kilometer2'=>$self[0]->kilometer2*$days,
                            'price2'=>$self[0]->price2*$days,
                            'kilometer3'=>$self[0]->kilometer3*$days,
                            'price3'=>$self[0]->price3*$days,
                      'extra_kilo'=>$self[0]->extra_kilo,
                      );
        $data['car_data']=$car_data;
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/self_summary');
        $this->load->view('frontend/common/footer');
      }else{
        redirect("/","refresh");
      }
    }
    //========= self drive change plane ==========
    public function change_plan()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('booking_id', 'booking_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('km_type', 'km_type', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $booking_id=base64_decode($this->input->post('booking_id'));
                $km_type=$this->input->post('km_type');
                $booking_data = $this->db->get_where('tbl_booking', array('id'=> $booking_id))->result();
                $car_data = $this->db->get_where('tbl_selfdrive', array('id'=> $booking_data[0]->car_id))->result();
                //----- check kilometer plan ------
                $days =$booking_data[0]->duration/24;
                if ($km_type==1) {
                    $kilometer = $car_data[0]->kilometer1*$days;
                    $kilometer_price = $car_data[0]->price1*$days;
                } elseif ($km_type==2) {
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
                $user_id=$this->session->userdata('user_id');
                //------- insert into booking table --------
                $data_update = array(
                   'rsda'=>$rsda,
                   'kilometer'=>$kilometer,
                   'kilometer_price'=>$kilometer_price,
                   'total_amount'=>$total,
                   'final_amount'=>$final_amount,
                   'kilometer_type'=>$km_type,
                       );
                       $this->db->where('id', $booking_id);
                       $zapak=$this->db->update('tbl_booking', $data_update);
                       $respone['status'] = true;
                       // $respone['message'] ='Plan Change Successfully!';
                       $this->session->set_flashdata('smessage', 'Plan Change Successfully!');
                       echo json_encode($respone);
            } else {
              $respone['status'] = false;
              // $respone['message'] ='Plan Change Successfully!';
              $this->session->set_flashdata('emessage', validation_errors());
              echo json_encode($respone);
            }
        } else {
          $respone['status'] = false;
          // $respone['message'] ='Plan Change Successfully!';
          $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
          echo json_encode($respone);
        }
    }
    // ====================================== SELF DRIVE CHECKOUT ==========================
    public function self_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('dob', 'dob', 'required|xss_clean|trim');
            $this->form_validation->set_rules('aadhar_no', 'aadhar_no', 'required|xss_clean|trim');
            $this->form_validation->set_rules('driving_lience', 'driving_lience', 'required|xss_clean|trim');
            // $this->form_validation->set_rules('pickup_location', 'pickup_location', 'required|xss_clean|trim');
            $this->form_validation->set_rules('agree', 'agree', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $id=base64_decode($this->input->post('id'));
                $dob=$this->input->post('dob');
                $aadhar_no=$this->input->post('aadhar_no');
                $driving_lience=$this->input->post('driving_lience');
                // $pickup_location=$this->input->post('pickup_location');
                $agree=$this->input->post('agree');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $this->load->library('upload');
                //----- verify date -----
                $bday = new DateTime($dob); // Your date of birth
                $today = new Datetime(date('m.d.y'));
                $diff = $today->diff($bday);
                if($diff->y<18){
                  $this->session->set_flashdata('emessage', 'Age is less than 18 years!');
                  redirect($_SERVER['HTTP_REFERER']);
                }
                //----------------aadhar front ----------
                $img1='aadhar_front';
                $file_check=($_FILES['aadhar_front']['error']);
                if ($file_check!=4) {
                    $image_upload_folder = FCPATH . "assets/uploads/documents/";
                    if (!file_exists($image_upload_folder)) {
                        mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                    }
                    $new_file_name="aadhar_front".date("Ymdhms");
                    $this->upload_config = array(
                                                'upload_path'   => $image_upload_folder,
                                                'file_name' => $new_file_name,
                                                'allowed_types' =>'jpg|jpeg|png',
                                                'max_size'      => 25000
                                        );
                    $this->upload->initialize($this->upload_config);
                    if (!$this->upload->do_upload($img1)) {
                        $upload_error = $this->upload->display_errors();
                        // echo json_encode($upload_error);
                        echo $upload_error;
                    } else {
                        $file_info = $this->upload->data();
                        $aadhar_front = "assets/uploads/documents/".$new_file_name.$file_info['file_ext'];
                    }
                }
                //----------------aadhar back ----------
                $img2='aadhar_back';
                $file_check=($_FILES['aadhar_front']['error']);
                if ($file_check!=4) {
                    $image_upload_folder = FCPATH . "assets/uploads/documents/";
                    if (!file_exists($image_upload_folder)) {
                        mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                    }
                    $new_file_name="aadhar_back".date("Ymdhms");
                    $this->upload_config = array(
                                      'upload_path'   => $image_upload_folder,
                                      'file_name' => $new_file_name,
                                      'allowed_types' =>'jpg|jpeg|png',
                                      'max_size'      => 25000
                                  );
                    $this->upload->initialize($this->upload_config);
                    if (!$this->upload->do_upload($img2)) {
                        $upload_error = $this->upload->display_errors();
                        // echo json_encode($upload_error);
                        echo $upload_error;
                    } else {
                        $file_info = $this->upload->data();
                        $aadhar_back = "assets/uploads/documents/".$new_file_name.$file_info['file_ext'];
                    }
                }
                //----------------license_front ----------
                $img3='license_front';
                $file_check=($_FILES['aadhar_front']['error']);
                if ($file_check!=4) {
                    $image_upload_folder = FCPATH . "assets/uploads/documents/";
                    if (!file_exists($image_upload_folder)) {
                        mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                    }
                    $new_file_name="license_front".date("Ymdhms");
                    $this->upload_config = array(
                                      'upload_path'   => $image_upload_folder,
                                      'file_name' => $new_file_name,
                                      'allowed_types' =>'jpg|jpeg|png',
                                      'max_size'      => 25000
                                  );
                    $this->upload->initialize($this->upload_config);
                    if (!$this->upload->do_upload($img3)) {
                        $upload_error = $this->upload->display_errors();
                        // echo json_encode($upload_error);
                        echo $upload_error;
                    } else {
                        $file_info = $this->upload->data();
                        $license_front = "assets/uploads/documents/".$new_file_name.$file_info['file_ext'];
                    }
                }
                //----------------license_back ----------
                $img4='license_back';
                $file_check=($_FILES['aadhar_front']['error']);
                if ($file_check!=4) {
                    $image_upload_folder = FCPATH . "assets/uploads/documents/";
                    if (!file_exists($image_upload_folder)) {
                        mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                    }
                    $new_file_name="license_back".date("Ymdhms");
                    $this->upload_config = array(
                                      'upload_path'   => $image_upload_folder,
                                      'file_name' => $new_file_name,
                                      'allowed_types' =>'jpg|jpeg|png',
                                      'max_size'      => 25000
                                  );
                    $this->upload->initialize($this->upload_config);
                    if (!$this->upload->do_upload($img4)) {
                        $upload_error = $this->upload->display_errors();
                        // echo json_encode($upload_error);
                        echo $upload_error;
                    } else {
                        $file_info = $this->upload->data();
                        $license_back = "assets/uploads/documents/".$new_file_name.$file_info['file_ext'];
                    }
                }
                $amount = $this->booking->selfCheckout($id, $dob, $aadhar_no, $driving_lience, $aadhar_front, $aadhar_back, $license_front, $license_back);
                $this->session->set_userdata('order_id',$id);
                $this->session->set_userdata('amount',$amount);
                redirect("Home/self_payment");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
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
            if ($this->form_validation->run()== true) {
                $id=base64_decode($this->input->post('id'));
                $promocode=strtoupper($this->input->post('promocode'));
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=strtotime(date("Y-m-d"));
                // echo $promocode;die();
                //----check promocode----
                $promocode_data = $this->db->get_where('tbl_promocode', array('is_active'=> 1,'promocode'=> $promocode))->result();
                $booking_data = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
                if (!empty($promocode_data)) {
                    if (strtotime($promocode_data[0]->end_date) >= $cur_date && strtotime($promocode_data[0]->start_date) <= $cur_date) {
                        //---- one time promocode -------
                        if ($promocode_data[0]->ptype==1) {
                            $promocodeAlreadyUsed = $this->db->get_where('tbl_booking', array('user_id = ' => $booking_data[0]->user_id, 'promocode'=>$promocode_data[0]->id, 'payment_status'=>1))->result();
                            if (empty($promocodeAlreadyUsed)) {
                                if ($booking_data[0]->duration > $promocode_data[0]->mindays*24) { //----checking minorder for promocode
                                    $discount_amt = $booking_data[0]->total_amount * $promocode_data[0]->percentage/100;
                                    if ($discount_amt > $promocode_data[0]->max) {
                                        // will get max amount
                                        $discount =  $promocode_data[0]->max;
                                    } else {
                                        $discount =  round($discount_amt, 2);
                                    }
                                    //---- booking entry update -----
                                    $data_update = array('promocode'=>$promocode_data[0]->id,
                                  'promo_discount'=>$discount,
                                              );
                                    $this->db->where('id', $id);
                                    $zapak=$this->db->update('tbl_booking', $data_update);
                                    $this->session->set_flashdata('smessage', 'Promocode Applied Successfully!');
                                    redirect($_SERVER['HTTP_REFERER']);
                                } else {
                                    $this->session->set_flashdata('emessage', 'Minimum '.$promocode_data[0]->mindays.' days booking required for this promocode!');
                                    redirect($_SERVER['HTTP_REFERER']);
                                }
                            } else {
                                $this->session->set_flashdata('emessage', 'Promocode is already used!');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        }
                        //---- every time promocode -------
                        else {
                            $discount_amt = $booking_data[0]->total_amount * $promocode_data[0]->percentage/100;
                            if ($discount_amt > $promocode_data[0]->max) {
                                // will get max amount
                                $discount =  $promocode_data[0]->max;
                            } else {
                                $discount =  round($discount_amt, 2);
                            }
                            $data_update = array('promocode'=>$promocode_data[0]->id,
                            'promo_discount'=>$discount,
                                        );
                            $this->db->where('id', $id);
                            $zapak=$this->db->update('tbl_booking', $data_update);
                            $this->session->set_flashdata('smessage', 'Promocode Applied Successfully!');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    } else {
                        $this->session->set_flashdata('emessage', 'Invalid Promocode Used!');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $this->session->set_flashdata('emessage', 'Invalid Promocode Used!');
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
    }
    // ====================================== SELF DRIVE PROMOCODE REMOVE ==========================
    public function remove_promo($idd)
    {
        if (empty(!$this->session->userdata('user_data'))) {
            $id=base64_decode($idd);
            $data['id']=$idd;
            $user_id=$this->session->userdata('user_id');
            $order1 = $this->db->get_where('tbl_booking', array('user_id'=> $user_id,'id'=> $id))->result();
            if (!empty($order1)) {
                $data_update = array('promocode'=>'',
                'promo_discount'=>'',
                );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_booking', $data_update);
                $this->session->set_flashdata('smessage', 'Promocode Removed Successfully!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("Home", "refresh");
        }
    }
    public function self_payment()
    {
        $id=$this->session->userdata('order_id');
        $amount=$this->session->userdata('amount');
        if(!empty($id) && !empty($amount)){
        $this->session->unset_userdata('order_id');
        $this->session->unset_userdata('amount');
        $this->session->userdata('user_data');
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $customer_name=$this->session->userdata('name');
        $customer_emial=$this->session->userdata('email');
        $customer_mobile=$this->session->userdata('phone');
        $url = PAYU_BASE_URL.'/_payment';
        $MERCHANT_KEY = MERCHANT_KEY; //change  merchant with yours
                    $SALT = SALT;  //change salt with yours
          $product_info = "Cabme";  //change salt with yours
          $customer_address = "Cabme";  //change salt with yours
          $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        //----- insert txnid ----
        $data_update = array('txnid'=>$txnid,
                      );
        $this->db->where('id', $id);
        $zapak=$this->db->update('tbl_booking', $data_update);
        // --- start temp code ------
        // $data_update = array(
        // 'online_paid'=>$amount,
        // 'payment_status'=>1,
        // 'order_status'=>1,
        // 'final_amount'=>$amount,
        //     );
        //     $this->db->where('txnid', $txnid);
        //     $zapak=$this->db->update('tbl_booking', $data_update);
        //     $bookingdata = $this->db->get_where('tbl_booking', array('txnid'=> $txnid))->result();
        //     //---- car status update ----
        //     $data_update2 = array('is_available'=>0,);
        //     $this->db->where('id', $bookingdata[0]->car_id);
        //     $zapak=$this->db->update('tbl_selfdrive', $data_update2);
        //     $data['booking_id']=$bookingdata[0]->id;
        //     $data['amount']=$bookingdata[0]->final_amount;
        //     $this->load->view('frontend/common/header', $data);
        //     $this->load->view('frontend/booking_success');
        //     $this->load->view('frontend/common/footer');
            // --- end temp code ------
        //optional udf values
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';
        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));
        $success = base_url() . 'Home/sbooking_succssful';
        $fail = base_url() . 'Home/booking_fail';
        $cancel = base_url() . 'Home/booking_fail';
        $data = array(
      'mkey' => $MERCHANT_KEY,
      'tid' => $txnid,
      'hash' => $hash,
      'amount' => $amount,
      'name' => $customer_name,
      'productinfo' => $product_info,
      'mailid' => $customer_emial,
      'phoneno' => $customer_mobile,
      'address' => $customer_address,
      'action' => PAYU_BASE_URL, //for live change action  https://secure.payu.in
      'sucess' => $success,
      'failure' => $fail,
      'cancel' => $cancel
      );
        $this->load->view('frontend/confirmation', $data);
    }else{
      redirect("/","refresh");
    }
    }
    //====================================== Intercity calculate ======================
    public function intercity_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('cab_type', 'cab_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $cab_type=$this->input->post('cab_type');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $city_id=$this->input->post('city_id');
                $duration=$this->input->post('duration');
                $user_id=$this->session->userdata('user_id');
                $response = $this->booking->intercityCalculate($cab_type, $start_date, $start_time, $end_date, $end_time, $city_id, $duration,$user_id);
                echo json_encode($response);
            } else {
                $res = array('message'=>validation_errors(),
    'status'=>201
    );
                echo json_encode($res);
            }
        } else {
            $res = array('message'=>"Please insert some data, No data available",
'status'=>201
);
            echo json_encode($res);
        }
    }
    //====================================== Intercity calculate =====================================
    public function intercity_checkout()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('amount', 'amount', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $id=base64_decode($this->input->post('id'));
                $amount=$this->input->post('amount');
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $customer_name=$this->session->userdata('name');
                $customer_emial=$this->session->userdata('email');
                $customer_mobile=$this->session->userdata('phone');
                $booking = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
                //----- start check date is past ----------
                date_default_timezone_set('Asia/Kolkata');
                $newdate = new DateTime($booking[0]->start_date);
                $date=$newdate->format('Y-m-d');
                $newtime= new DateTime($booking[0]->start_time);
                $time=$newtime->format('H:i:s');
                $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
                $curDateTime = date("Y-m-d H:i:s");
                  if ($curDateTime > $myDate) {
                $this->session->set_flashdata('emessage', 'Please select date and time agian!');
                  redirect("Home","refresh");
                }
                //----- end check date is past ----------
                $url = PAYU_BASE_URL.'/_payment';
                $MERCHANT_KEY = MERCHANT_KEY; //change  merchant with yours
                    $SALT = SALT;  //change salt with yours
                    $product_info = "Cabme";  //change salt with yours
                    $customer_address = "Cabme";  //change salt with yours
                    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                //----- insert txnid ----
                $data_update = array('txnid'=>$txnid,
                                );
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_booking', $data_update);
                //-----start temp code ------
            //     $data_update = array(
            // 'online_paid'=>$amount,
            // 'payment_status'=>1,
            // 'order_status'=>1,
            //     );
            //     $this->db->where('txnid', $txnid);
            //     $zapak=$this->db->update('tbl_booking', $data_update);
            //     $bookingdata = $this->db->get_where('tbl_booking', array('txnid'=> $txnid))->result();
            //     $data['booking_id']=$bookingdata[0]->id;
            //     $data['amount']=$bookingdata[0]->final_amount;
            //     $this->load->view('frontend/common/header', $data);
            //     $this->load->view('frontend/booking_success');
            //     $this->load->view('frontend/common/footer');
                // die();
                  //-----end temp code ------
                //optional udf values
                $udf1 = '';
                $udf2 = '';
                $udf3 = '';
                $udf4 = '';
                $udf5 = '';
                $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
                $hash = strtolower(hash('sha512', $hashstring));
                $success = base_url() . 'Home/booking_succss';
                $fail = base_url() . 'Home/booking_fail';
                $cancel = base_url() . 'Home/booking_fail';
                $data = array(
             'mkey' => $MERCHANT_KEY,
             'tid' => $txnid,
             'hash' => $hash,
             'amount' => $amount,
             'name' => $customer_name,
             'productinfo' => $product_info,
             'mailid' => $customer_emial,
             'phoneno' => $customer_mobile,
             'address' => $customer_address,
             'action' => PAYU_BASE_URL, //for live change action  https://secure.payu.in
             'sucess' => $success,
             'failure' => $fail,
             'cancel' => $cancel
         );
                $this->load->view('frontend/confirmation', $data);
            } else {
                $res = array('message'=>validation_errors(),
                    'status'=>201
                    );
                echo json_encode($res);
            }
        } else {
            // $res = array('message'=>"Please insert some data, No data available",
            //     'status'=>201
            //     );
            // echo json_encode($res);
            redirect("/","refresh");
        }
    }
    public function booking_succss()
    {
        // $postdata = file_get_contents("php://input");
        // print_r($postdata);
        $mihpayid = $_POST['mihpayid'];
        $status = $_POST['status'];
        $amount = $_POST['amount'];
        $txnid = $_POST['txnid'];
        if ($status=='success') {
            $data_update = array('mihpayid'=>$mihpayid,
        'online_paid'=>$amount,
        'payment_status'=>1,
        'order_status'=>1,
            );
            $this->db->where('txnid', $txnid);
            $zapak=$this->db->update('tbl_booking', $data_update);
            $bookingdata = $this->db->get_where('tbl_booking', array('txnid'=> $txnid))->result();
            $data['booking_id']=$bookingdata[0]->id;
            $data['amount']=$bookingdata[0]->final_amount;
            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/booking_success');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("Home/booking_fail", "refresh");
        }
    }
    public function sbooking_succssful()
    {
        // $postdata = file_get_contents("php://input");
        // print_r($postdata);
        $mihpayid = $_POST['mihpayid'];
        $status = $_POST['status'];
        $amount = $_POST['amount'];
        $txnid = $_POST['txnid'];
        if ($status=='success') {
            $data_update = array('mihpayid'=>$mihpayid,
        'online_paid'=>$amount,
        'payment_status'=>1,
        'order_status'=>1,
        'final_amount'=>$amount,
            );
            $this->db->where('txnid', $txnid);
            $zapak=$this->db->update('tbl_booking', $data_update);
            $bookingdata = $this->db->get_where('tbl_booking', array('txnid'=> $txnid))->result();
            //---- car status update ----
            $data_update2 = array('is_available'=>0,);
            $this->db->where('id', $bookingdata[0]->car_id);
            $zapak=$this->db->update('tbl_selfdrive', $data_update2);
            $data['booking_id']=$bookingdata[0]->id;
            $data['amount']=$bookingdata[0]->final_amount;
            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/booking_success');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("Home/booking_fail", "refresh");
        }
    }
    public function obooking_succssful()
    {
        // $postdata = file_get_contents("php://input");
        // print_r($postdata);
        $mihpayid = $_POST['mihpayid'];
        $status = $_POST['status'];
        $amount = $_POST['amount'];
        $txnid = $_POST['txnid'];
        if ($status=='success') {
            $data_update = array('mihpayid'=>$mihpayid,
        'online_paid'=>$amount,
        'payment_status'=>1,
        'order_status'=>1,
            );
            $this->db->where('txnid', $txnid);
            $zapak=$this->db->update('tbl_booking', $data_update);
            $bookingdata = $this->db->get_where('tbl_booking', array('txnid'=> $txnid))->result();
            //---- car status update ----
            $data_update2 = array('is_available'=>0,);
            $this->db->where('id', $bookingdata[0]->car_id);
            $zapak=$this->db->update('tbl_outstation', $data_update2);
            $data['booking_id']=$bookingdata[0]->id;
            $data['amount']=$bookingdata[0]->mini_booking;
            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/booking_success');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("Home/booking_fail", "refresh");
        }
    }
    public function booking_fail()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/booking_failed');
        $this->load->view('frontend/common/footer');
    }
    //================================================= OUTSTATION CARS Search ======================================
    public function outstaion_cars()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('round_type', 'round_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $round_type=$this->input->post('round_type');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $duration=$this->input->post('duration');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $data_insert = array(
          'city_id'=>$city_id,
          'round_type'=>$round_type,
          'start_date'=>$start_date,
          'start_time'=>$start_time,
          'end_date'=>$end_date,
          'end_time'=>$end_time,
          'duration'=>$duration,
          'date'=>$cur_date,
                    );
                $last_id=$this->base_model->insert_table("tbl_search", $data_insert, 1) ;
                $id = base64_encode($last_id);
                redirect("Home/show_outstation_cars/$id");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //========================== outstation cars ============================
    public function show_outstation_cars($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        if (isset($_GET['seating'])) {
            $seating = $_GET["seating"];
        } else {
            $seating ='';
        }
        if (isset($_GET['sort'])) {
            $sort = $_GET["sort"];
        } else {
            $sort ='';
        }
        $search = $this->db->get_where('tbl_search', array('id'=> $id))->result();
        //----- start check date is past ----------
        date_default_timezone_set('Asia/Kolkata');
        $newdate = new DateTime($search[0]->start_date);
        $date=$newdate->format('Y-m-d');
        $newtime= new DateTime($search[0]->start_time);
        $time=$newtime->format('H:i:s');
        $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
        $curDateTime = date("Y-m-d H:i:s");
          if ($curDateTime > $myDate) {
        $this->session->set_flashdata('emessage', 'Please select date and time agian!');
          redirect("Home","refresh");
        }
        //----- end check date is past ----------
        $send= array(
    'city_id'=>$search[0]->city_id,
    'start_date'=>$search[0]->start_date,
    'start_time'=>$search[0]->start_time,
    'end_date'=>$search[0]->end_date,
    'end_time'=>$search[0]->end_time,
    'duration'=>$search[0]->duration,
    'round_type'=>$search[0]->round_type,
      'seating'=>$seating,
        'sort'=>$sort,
    // 'index'=>$index,
  );
        $car_data = $this->booking->ViewOutstationCars($send);
        $data['car_data']= $car_data['car_data'];
        $data['search']= $search;
        $data['seating']= $seating;
        $data['sort']= $sort;
        $this->load->view('frontend/common/header3', $data);
        $this->load->view('frontend/outstation_cars');
        $this->load->view('frontend/common/footer');
    }
    //========================== outstation calculate ============================
    public function outstation_calculate()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_date', 'start_date', 'required|xss_clean|trim');
            $this->form_validation->set_rules('start_time', 'start_time', 'required|xss_clean|trim');
            $this->form_validation->set_rules('end_date', 'end_date', 'xss_clean|trim');
            $this->form_validation->set_rules('end_time', 'end_time', 'xss_clean|trim');
            $this->form_validation->set_rules('duration', 'duration', 'xss_clean|trim');
            $this->form_validation->set_rules('city_id', 'city_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('car_id', 'car_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('round_type', 'round_type', 'required|xss_clean|trim');
            $this->form_validation->set_rules('search_id', 'search_id', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $city_id=$this->input->post('city_id');
                $start_date=$this->input->post('start_date');
                $start_time=$this->input->post('start_time');
                $end_date=$this->input->post('end_date');
                $end_time=$this->input->post('end_time');
                $duration=$this->input->post('duration');
                $city_id=$this->input->post('city_id');
                $car_id=$this->input->post('car_id');
                $round_type=$this->input->post('round_type');
                $search_id=$this->input->post('search_id');
                date_default_timezone_set("Asia/Calcutta");
                $cur_date=date("Y-m-d H:i:s");
                $user_id=$this->session->userdata('user_id');
                $send = array(
          'user_id'=>$user_id,
          'city_id'=>$city_id,
          'start_date'=>$start_date,
          'start_time'=>$start_time,
          'end_date'=>$end_date,
          'end_time'=>$end_time,
          'duration'=>$duration,
          'city_id'=>$city_id,
          'car_id'=>$car_id,
          'round_type'=>$round_type,
          'search_id'=>$search_id,
                    );
                $response = $this->booking->outstationCalculate($send);
                $id = base64_encode($response['id']);
                redirect("Home/outstation_summary/$id");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //========================== outstation SUMMARY =============================
    public function outstation_summary($idd)
    {
        $id=base64_decode($idd);
        $data['id']=$idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        if($data['booking_data'][0]->payment_status!=1){
          //----- start check date is past ----------
        date_default_timezone_set('Asia/Kolkata');
        $newdate = new DateTime($data['booking_data'][0]->start_date);
        $date=$newdate->format('Y-m-d');
        $newtime= new DateTime($data['booking_data'][0]->start_time);
        $time=$newtime->format('H:i:s');
        $myDate = date("Y-m-d H:i:s", strtotime("$date $time"));
        $curDateTime = date("Y-m-d H:i:s");
          if ($curDateTime > $myDate) {
        $this->session->set_flashdata('emessage', 'Please select date and time agian!');
          redirect("Home","refresh");
        }
        //----- end check date is past ----------
        $car = $this->db->get_where('tbl_outstation', array('id'=> $data['booking_data'][0]->car_id))->result();
        $data['user_data'] = $this->db->get_where('tbl_users', array('id'=> $data['booking_data'][0]->user_id))->result();
        //-----========= city data =============
        $city = $this->db->get_where('tbl_cities', array('id'=> $data['booking_data'][0]->city_id))->result();
        $data['city_data']=$city;
        //------ seating  ---
        if ($car[0]->seatting==1) {
            $seating = '4 Seates';
        } elseif ($car[0]->seatting==2) {
            $seating = '5 Seates';
        } else {
            $seating = '7 Seates';
        }
        // $days =$data['booking_data'][0]->duration/24;
        $car_data= array(
                  'brand_name'=>$car[0]->brand_name,
                  'car_name'=>$car[0]->car_name,
                  'photo'=>$car[0]->photo,
                  'seating'=>$seating,
                  'per_kilometer'=>$car[0]->per_kilometre,
                  'location'=>$car[0]->location,
                  'min_booking_amt'=>$car[0]->min_booking_amt,
                  );
        $data['car_data']=$car_data;
        $this->load->view('frontend/common/header', $data);
        $this->load->view('frontend/outstation_summary');
        $this->load->view('frontend/common/footer');
      }else{
        redirect("/","refresh");
      }
    }
    //============================ outstation cehckout =================
    public function outstation_checkout($idd)
    {
        $id=base64_decode($idd);
        $booking = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        $amount = $booking[0]->mini_booking;
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $customer_name=$this->session->userdata('name');
        $customer_emial=$this->session->userdata('email');
        $customer_mobile=$this->session->userdata('phone');
        $url = PAYU_BASE_URL.'/_payment';
        $MERCHANT_KEY = MERCHANT_KEY; //change  merchant with yours
                    $SALT = SALT;  //change salt with yours
          $product_info = "Cabme";  //change salt with yours
          $customer_address = "Cabme";  //change salt with yours
          $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        //----- insert txnid ----
        $data_update = array('txnid'=>$txnid,
                      );
        $this->db->where('id', $id);
        $zapak=$this->db->update('tbl_booking', $data_update);
        // --- start temp code -------
        //
        //     $data_update = array(
        // 'online_paid'=>$amount,
        // 'payment_status'=>1,
        // 'order_status'=>1,
        //     );
        //     $this->db->where('txnid', $txnid);
        //     $zapak=$this->db->update('tbl_booking', $data_update);
        //     $bookingdata = $this->db->get_where('tbl_booking', array('txnid'=> $txnid))->result();
        //     //---- car status update ----
        //     $data_update2 = array('is_available'=>0,);
        //     $this->db->where('id', $bookingdata[0]->car_id);
        //     $zapak=$this->db->update('tbl_outstation', $data_update2);
        //     $data['booking_id']=$bookingdata[0]->id;
        //     $data['amount']=$bookingdata[0]->mini_booking;
        //     $this->load->view('frontend/common/header', $data);
        //     $this->load->view('frontend/booking_success');
        //     $this->load->view('frontend/common/footer');
        // --- end temp code -------
        //optional udf values
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';
        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));
        $success = base_url() . 'Home/obooking_succssful';
        $fail = base_url() . 'Home/booking_fail';
        $cancel = base_url() . 'Home/booking_fail';
        $data = array(
      'mkey' => $MERCHANT_KEY,
      'tid' => $txnid,
      'hash' => $hash,
      'amount' => $amount,
      'name' => $customer_name,
      'productinfo' => $product_info,
      'mailid' => $customer_emial,
      'phoneno' => $customer_mobile,
      'address' => $customer_address,
      'action' => PAYU_BASE_URL, //for live change action  https://secure.payu.in
      'sucess' => $success,
      'failure' => $fail,
      'cancel' => $cancel
      );
        $this->load->view('frontend/confirmation', $data);
    }
    // =========================================== MY PROFILE ===============================================
    public function my_profile()
    {
        if (!empty($this->session->userdata('user_data'))) {
            $data['user_data']= $this->db->get_where('tbl_users', array('id = ' => $this->session->userdata('user_id')))->result();
            if (!empty($data['user_data'])) {
                if ($data['user_data'][0]->is_active==1) {
                    $data['booking_data'] = $this->db->order_by('id', 'desc')->get_where('tbl_booking', array('user_id = ' => $this->session->userdata('user_id'), 'order_status != '=>0))->result();
                    $this->load->view('frontend/common/header', $data);
                    $this->load->view('frontend/my_profile');
                    $this->load->view('frontend/common/footer');
                } else {
                    $Logout = $this->login->UserOtpLogout();
                    $this->session->set_flashdata('emessage', 'Your account is inactive! Please contact admin');
                    redirect("/", "refresh");
                }
            } else {
                $Logout = $this->login->UserOtpLogout();
                $this->session->set_flashdata('emessage', 'User not found');
                redirect("/", "refresh");
            }
        } else {
            redirect("/", "refresh");
        }
    }
    public function contact_form_submit()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'name', 'xss_clean|trim');
            $this->form_validation->set_rules('message', 'message', 'xss_clean|trim');
            $this->form_validation->set_rules('email', 'email', 'xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $name=$this->input->post('name');
                $message=$this->input->post('message');
                $email=$this->input->post('email');
                $response_entry = $this->forms->contactFormSubmit($name, $message, $email);
                redirect("/", "refresh");
            } else {
                $this->session->set_flashdata('emessage', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function self_booking_details($idd)
    {
    if (!empty($this->session->userdata('user_data'))) {
       $id=base64_decode($idd);
      $data['id']=$idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
      $car = $this->db->get_where('tbl_selfdrive', array('id'=> $data['booking_data'][0]->car_id))->result();
      $data['user_data'] = $this->db->get_where('tbl_users', array('id'=> $data['booking_data'][0]->user_id))->result();
      $city = $this->db->get_where('tbl_cities', array('id'=> $data['booking_data'][0]->city_id))->result();
            $data['city_data']=$city;
            //------ fuel type ---
              if ($car[0]->fule_type==1) {
                  $fuel_type = 'Petrol';
              } elseif ($car[0]->fule_type==2) {
                  $fuel_type = 'Diesel';
              } else {
                  $fuel_type = 'CNG';
              }
              //------ Transmission  ---
              if ($car[0]->transmission==1) {
                  $transmission = 'Manual';
              } elseif ($car[0]->transmission==2) {
                  $transmission = 'Automatic';
              }
              $extra_kilo=$car[0]->extra_kilo;
              //------ seating  ---
              if ($car[0]->seatting==1) {
                  $seating = '4 Seates';
              } elseif ($car[0]->seatting==2) {
                  $seating = '5 Seates';
              } else {
                  $seating = '7 Seates';
              }
              $car_data= array(
                          'brand_name'=>$car[0]->brand_name,
                          'car_name'=>$car[0]->car_name,
                          'photo'=>$car[0]->photo,
                          'fuel_type'=>$fuel_type,
                          'transmission'=>$transmission,
                          'seating'=>$seating,
                          'extra_kilo'=>$extra_kilo,
                          );
        $data['car_data']=$car_data;
        $this->load->view('frontend/common/header',$data);
        $this->load->view('frontend/self_booking_details');
        $this->load->view('frontend/common/footer');
      } else {
          redirect("/", "refresh");
      }
    }
    public function outstation_booking_details($idd)
    {
    if (!empty($this->session->userdata('user_data'))) {
       $id=base64_decode($idd);
      $data['id']=$idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        $car = $this->db->get_where('tbl_outstation', array('id'=> $data['booking_data'][0]->car_id))->result();
        $data['user_data'] = $this->db->get_where('tbl_users', array('id'=> $data['booking_data'][0]->user_id))->result();
        $city = $this->db->get_where('tbl_cities', array('id'=> $data['booking_data'][0]->city_id))->result();
        $data['city_data']=$city;
          //------ seating  ---
          if ($car[0]->seatting==1) {
              $seating = '4 Seates';
          } elseif ($car[0]->seatting==2) {
              $seating = '5 Seates';
          } else {
              $seating = '7 Seates';
          }
          $car_data= array(
                      'brand_name'=>$car[0]->brand_name,
                      'car_name'=>$car[0]->car_name,
                      'photo'=>$car[0]->photo,
                      'seating'=>$seating,
                      );
        $data['car_data']=$car_data;
        $this->load->view('frontend/common/header',$data);
        $this->load->view('frontend/outstation_booking_details');
        $this->load->view('frontend/common/footer');
      } else {
          redirect("/", "refresh");
      }
    }
    public function intercity_booking_details($idd)
    {
    if (!empty($this->session->userdata('user_data'))) {
       $id=base64_decode($idd);
      $data['id']=$idd;
        $data['booking_data'] = $this->db->get_where('tbl_booking', array('id'=> $id))->result();
        $car = $this->db->get_where('tbl_intercity', array('id'=> $data['booking_data'][0]->car_id))->result();
        $data['user_data'] = $this->db->get_where('tbl_users', array('id'=> $data['booking_data'][0]->user_id))->result();
        $city = $this->db->get_where('tbl_cities', array('id'=> $data['booking_data'][0]->city_id))->result();
        $data['city_data']=$city;
        $this->load->view('frontend/common/header',$data);
        $this->load->view('frontend/intercity_booking_details');
        $this->load->view('frontend/common/footer');
      } else {
          redirect("/", "refresh");
      }
    }
    public function error404()
    {
        $this->load->view('errors/error404');
    }
    public function contact()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/contact');
        $this->load->view('frontend/common/footer');
    }
    // ============================================ ABOUT =================================================
    public function about()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/about');
        $this->load->view('frontend/common/footer');
    }
    public function privacy_policy()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/privacy_policy');
        $this->load->view('frontend/common/footer');
    }
    public function term_and_condition()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/terms_conditions');
        $this->load->view('frontend/common/footer');
    }
}

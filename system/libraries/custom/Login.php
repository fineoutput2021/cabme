<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_Login
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->model("admin/login_model");
        $this->CI->load->model("admin/base_model");
        $this->CI->load->library('custom/Messages');
    }
    // ================================================= START OTP SYSTEM =============================================================

    //============================================= REGISTER  WITH OTP ==============================================

    public function RegisterWithOtp($fname, $lname, $phone)
    {
        if (empty($this->CI->session->userdata('user_data'))) {
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            $userCheck = $this->CI->db->get_where('tbl_users', array('phone'=> $phone))->result();
            if (empty($userCheck)) {//---- check user is exist or not ---------
                //------- insert into temp table ------------
                $data_insert = array(
            'fname'=>$fname,
            'lname'=>$lname,
            'phone'=>$phone,
            'ip' =>$ip,
            'date'=>$cur_date
            );
                $last_id=$this->CI->base_model->insert_table("tbl_user_temp", $data_insert, 1) ;
                // $OTP = random_int(100000, 999999);
                $OTP = 123456;
                //--------------- Insert data into OTP table -----
                $data_insert2 = array(
                  'phone'=>$phone,
                  'otp'=>$OTP,
                  'status'=>0,
                  'temp_id'=>$last_id,
                  'ip' =>$ip,
                  'date'=>$cur_date
                  );
                $last_id2=$this->CI->base_model->insert_table("tbl_otp", $data_insert2, 1) ;
                if (!empty($last_id2)) {
                  //--------------- Send Register OTP -----------
                  // $msg ='Dear User,Your OTP for signup to TIARASTORE is '.$OTP.'. Valid for 30 minutes. Please do not share this OTP.Welcome !!Regards,TIARASTORE';
                  // $DLT = SIGNUP_DLT;
                  // $sendmsg = $this->CI->messages->sendOtpMsg91($phone,$msg,$OTP,$DLT);

                    $respone['status'] = true;
                    $respone['message'] ='Please enter otp sent to your register mobile number';
                    $this->CI->session->set_flashdata('smessage', 'Please enter otp sent to your register mobile number');
                    return json_encode($respone);
                  log_message('error', json_encode($respone));
                } else {
                    $respone['status'] = false;
                    $respone['message'] ='Some error occurred!';
                    $this->CI->session->set_flashdata('emessage', 'Some error occurred!');
                    return json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ='User Already Exist!';
                $this->CI->session->set_flashdata('emessage', 'User Already Exist!');
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }
    public function ResellerRegisterWithOtp($name, $email, $shop_name, $address, $city, $state, $gst_no, $phone)
    {
        if (empty($this->CI->session->userdata('user_data'))) {
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            $userCheck = $this->CI->db->get_where('tbl_users', array('phone'=> $phone))->result();
            $resellerCheck = $this->CI->db->get_where('tbl_reseller', array('phone'=> $phone))->result();
            if (empty($userCheck) && empty($resellerCheck)) {//---- check user is exist or not ---------
                //------- insert into temp table ------------
                $data_insert = array(
            'fname'=>$name,
            'email'=>$email,
            'shop_name'=>$shop_name,
            'address'=>$address,
            'city'=>$city,
            'state'=>$state,
            'gst_no'=>$gst_no,
            'phone'=>$phone,
            'ip' =>$ip,
            'date'=>$cur_date
            );
                $last_id=$this->CI->base_model->insert_table("tbl_user_temp", $data_insert, 1) ;
                $OTP = random_int(100000, 999999);
                // $OTP = 123456;
                //--------------- Insert data into OTP table -----
                $data_insert2 = array(
                  'phone'=>$phone,
                  'otp'=>$OTP,
                  'status'=>0,
                  'temp_id'=>$last_id,
                  'type'=>2,
                  'ip' =>$ip,
                  'date'=>$cur_date
                  );
                $last_id2=$this->CI->base_model->insert_table("tbl_otp", $data_insert2, 1) ;
                if (!empty($last_id2)) {
                    //--------------- Send Register OTP----- -----
                    $msg ='Dear User,Your OTP for signup to TIARASTORE is '.$OTP.'. Valid for 30 minutes. Please do not share this OTP.Welcome !!Regards,TIARASTORE';
                    $DLT = SIGNUP_DLT;
                    $sendmsg = $this->CI->messages->sendOtpMsg91($phone,$msg,$OTP,$DLT);

                    $respone['status'] = true;
                    $respone['message'] ='Please enter otp sent to your register mobile number';
                    $this->CI->session->set_flashdata('smessage', 'Please enter otp sent to your register mobile number');
                    return json_encode($respone);
                } else {
                    $respone['status'] = false;
                    $respone['message'] ='Some error occurred!';
                    $this->CI->session->set_flashdata('emessage', 'Some error occurred!');
                    return json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ='User Already Exist!';
                $this->CI->session->set_flashdata('emessage', 'User Already Exist!');
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }

    //=================================================== REGISTER OTP VERIFY ======================================
    public function RegisterOtpVerify($phone, $input_otp)
    {
        if (empty($this->CI->session->userdata('user_data'))) {
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            $otpData = $this->CI->db->order_by('id', 'desc')->get_where('tbl_otp', array('phone'=> $phone))->result();
            if (!empty($otpData[0])) {//---- OTP not found
      if ($otpData[0]->otp == $input_otp) {//----- Match OTP ----
          if ($otpData[0]->status==0) {//----- check OTP used or not ----
            //--------- Update OTP status -------
            $data_insert = array('status'=>1);
              $this->CI->db->where('id', $otpData[0]->id);
              $last_id=$this->CI->db->update('tbl_otp', $data_insert);
              if (!empty($last_id)) {// check status is updated or not
                  $temp_data = $this->CI->db->get_where('tbl_user_temp', array('phone'=> $otpData[0]->phone))->result();
                  if ($otpData[0]->type==1) {//----- for retailer -----
                      //------ insert user data from temp to user table -----------
                      $data_insert = array('f_name'=>$temp_data[0]->fname,
                       'l_name'=>$temp_data[0]->lname,
                       'phone'=>$temp_data[0]->phone,
                       'ip' =>$ip,
                       'is_active' =>1,
                       'is_model' =>0,
                       'date'=>$cur_date
                );
                      $last_id2=$this->CI->base_model->insert_table("tbl_users", $data_insert, 1) ;

                      //---------- entries in cart table --------------
                      $session_cart = $this->CI->session->userdata('cart_data');
                      if (!empty($session_cart)) {
                          foreach ($session_cart as $cart) {
                              $cart_insert = array('user_id'=>$last_id2,
                                    'product_id'=>$cart['product_id'],
                                    'type_id'=>$cart['type_id'],
                                    'quantity'=>$cart['quantity'],
                                    'user_type'=>1,
                                    'ip'=>$ip,
                                    'date'=>$cur_date
                                );
                              $last_id=$this->CI->base_model->insert_table("tbl_cart", $cart_insert, 1) ;
                          }
                      }

                      //---------- set login session -------------------
                      $this->CI->session->set_userdata('user_data', 1);
                      $this->CI->session->set_userdata('name', $temp_data[0]->fname);
                      $this->CI->session->set_userdata('phone', $phone);
                      $this->CI->session->set_userdata('user_type', 1);
                      $this->CI->session->set_userdata('user_id', $last_id2);
                      $respone['status'] = true;
                      $respone['message'] ='Successfully Registered!';
                      $this->CI->session->set_flashdata('smessage', 'Successfully Registered!');
                  } else {//---- for reseller ------
                      //------ insert user data from temp to reseller table -----------
                      $data_insert = array('name'=>$temp_data[0]->fname,
                       'email'=>$temp_data[0]->email,
                       'phone'=>$temp_data[0]->phone,
                       'shop'=>$temp_data[0]->shop_name,
                       'gst_number'=>$temp_data[0]->gst_no,
                       'address'=>$temp_data[0]->address,
                       'city'=>$temp_data[0]->city,
                       'state'=>$temp_data[0]->state,
                       'reseller_status'=>0,
                       'ip' =>$ip,
                       'is_active' =>1,
                       'date'=>$cur_date
                );

                      $last_id2=$this->CI->base_model->insert_table("tbl_reseller", $data_insert, 1) ;
                      $respone['status'] = true;
                      $respone['message'] ='Request submitted successfully! Please wait for admin approval';
                      $this->CI->session->set_flashdata('smessage', 'Request submitted successfully! Please wait for admin approval');
                  }
                  return json_encode($respone);
              } else {
                  $respone['status'] = false;
                  $respone['message'] ='Some error occurred! Please try again';
                  $this->CI->session->set_flashdata('emessage', 'Some error occurred! Please try again');
                  return json_encode($respone);
              }
          } else {
              $respone['status'] = false;
              $respone['message'] ='OTP is already used!';
              $this->CI->session->set_flashdata('emessage', 'OTP is already used!');
              return json_encode($respone);
          }
      } else {
          $respone['status'] = false;
          $respone['message'] ='Wrong OTP Entered!';
          $this->CI->session->set_flashdata('emessage', 'Wrong OTP Entered!');
          return json_encode($respone);
      }
            } else {
                $respone['status'] = false;
                $respone['message'] ='Invalid OTP!';
                $this->CI->session->set_flashdata('emessage', 'Invalid OTP!');
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }

    //============================================= LOGIN WITH OTP ==============================================
    public function LoginWithOtp($phone)
    {
        if (empty($this->CI->session->userdata('user_data'))) {
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            //------ Check for user and reseller exist or not ----------
            $userCheck = $this->CI->db->get_where('tbl_users', array('phone'=> $phone))->result();
            $resellerCheck = $this->CI->db->get_where('tbl_reseller', array('phone'=> $phone))->result();
            $type=0;
            if (!empty($userCheck)) {// status 1 for user login
                $type = 1;
            } elseif (!empty($resellerCheck)) {// status 1 for reseller login
                $type = 2;
            }else{//--------------- user not found -----------------
              $respone['status'] = false;
              $respone['message'] ='User Not Found! Please Register First';
              $this->CI->session->set_flashdata('emessage', 'Some error occurred!');
              return json_encode($respone);
            }
            //----------------------- user login handle --------------------------------
            if ($type==1) {
                if ($userCheck[0]->is_active==1) {
                    //--------------- Insert data into otp table -----
                    $OTP = random_int(100000, 999999);
                    // $OTP = 123456;
                    $data_insert2 = array(
                            'phone'=>$phone,
                            'otp'=>$OTP,
                            'status'=>0,
                            'type'=>$type,
                            'ip' =>$ip,
                            'date'=>$cur_date
                            );
                    $last_id2=$this->CI->base_model->insert_table("tbl_otp", $data_insert2, 1) ;
                    if (!empty($last_id2)) {

                        //--------------- Send login OTP----- -----
                        $msg ='Dear User,Your OTP for login to TIARASTORE is '.$OTP.'. Valid for 30 minutes. Please do not share this OTP.Thank You,TIARASTORE';
                        $DLT = LOGIN_DLT;
                        $sendmsg = $this->CI->messages->sendOtpMsg91($phone,$msg,$OTP,$DLT);

                        $respone['status'] = true;
                        $respone['message'] ='Please enter otp sent to your register mobile number';
                        $this->CI->session->set_flashdata('smessage', 'Please enter otp sent to your register mobile number');
                        return json_encode($respone);
                    } else {
                        $respone['status'] = false;
                        $respone['message'] ='Some error occurred!';
                        $this->CI->session->set_flashdata('emessage', 'Some error occurred!');
                        return json_encode($respone);
                    }
                }
                //------ user is inactive --------
                else {
                    $respone['status'] = false;
                    $respone['message'] ='Your Account is blocked! Please contact to admin';
                    $this->CI->session->set_flashdata('emessage', 'Your Account is blocked! Please contact to admin');
                    return json_encode($respone);
                }
            }
            //----------------------- Reseller login handle --------------------------------
            elseif ($type==2) {
                if ($resellerCheck[0]->reseller_status==1 && $resellerCheck[0]->is_active==1) {// for approved retailer

                    //--------------- Insert data into OTP table -----
                    // $OTP = random_int(100000, 999999);
                    $OTP = 123456;
                    $data_insert2 = array(
                          'phone'=>$phone,
                          'otp'=>$OTP,
                          'status'=>0,
                          'type'=>$type,
                          'ip' =>$ip,
                          'date'=>$cur_date

                          );
                    $last_id2=$this->CI->base_model->insert_table("tbl_otp", $data_insert2, 1) ;
                    if (!empty($last_id2)) {
                        //         //--------------- Send Login OTP----- -----
                        $msg ='Dear User,Your OTP for login to TIARASTORE is '.$OTP.'. Valid for 30 minutes. Please do not share this OTP.Thank You,TIARASTORE';
                        $DLT = LOGIN_DLT;
                        $sendmsg = $this->CI->messages->sendOtpMsg91($phone,$msg,$OTP,$DLT);
                        $respone['status'] = true;
                        $respone['message'] ='Please enter otp sent to your register mobile number';
                        $this->CI->session->set_flashdata('smessage', 'Please enter otp sent to your register mobile number');
                        return json_encode($respone);
                    } else {
                        $respone['status'] = false;
                        $respone['message'] ='Some error occurred!';
                        $this->CI->session->set_flashdata('emessage', 'Some error occurred!');
                        return json_encode($respone);
                    }
                }
                //------ Reseller request pending --------
                elseif ($resellerCheck[0]->reseller_status==0) {
                    $respone['status'] = false;
                    $respone['message'] ='Your request was submitted! Please wait for admin approved';
                    $this->CI->session->set_flashdata('emessage', 'Your request was submitted! Please wait for admin approved');
                    return json_encode($respone);
                }
                //------ Reseller request rejected or blocked --------
                else {
                    $respone['status'] = false;
                    $respone['message'] ='Your Account is blocked! Please contact to admin';
                    $this->CI->session->set_flashdata('emessage', 'Your Account is blocked! Please contact to admin');
                    return json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ='Phone number not registered. Sign up to continue';
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }

    //============================================== LOGIN OTP VERIFY =============================================
    public function LoginOtpVerify($phone, $input_otp)
    {
        if (empty($this->CI->session->userdata('user_data'))) {
            $otpData = $this->CI->db->order_by('id', 'desc')->get_where('tbl_otp', array('phone'=> $phone))->result();
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            if (!empty($otpData[0])) {//---- OTP not found
            if ($otpData[0]->otp == $input_otp) {//----- Match OTP ----
                if ($otpData[0]->status==0) {//----- check OTP used or not ----
                  //--------- Update OTP status -------
                  $data_insert = array('status'=>1);
                    $this->CI->db->where('id', $otpData[0]->id);
                    $last_id=$this->CI->db->update('tbl_otp', $data_insert);
                    if (!empty($last_id)) {// check status is updated or not
                        if ($otpData[0]->type==1) {
                            $user_data = $this->CI->db->get_where('tbl_users', array('phone'=> $phone))->result();
                        } else {
                            $user_data = $this->CI->db->get_where('tbl_reseller', array('phone'=> $phone))->result();
                        }
                        if ($user_data[0]->is_active==1) {
                            //---------- entries in cart table --------------
                            $session_cart = $this->CI->session->userdata('cart_data');
                            if (!empty($session_cart)) {
                                foreach ($session_cart as $cart) {
                                    $check_cart_existence = $this->CI->db->get_where('tbl_cart', array('user_id = ' => $user_data[0]->id, 'product_id'=>$cart['product_id'], 'type_id'=>$cart['type_id']))->result();
                                    if (empty($check_cart_existence)) {
                                        $cart_insert = array('user_id'=>$user_data[0]->id,
                                      'product_id'=>$cart['product_id'],
                                      'type_id'=>$cart['type_id'],
                                      'quantity'=>$cart['quantity'],
                                      'user_type'=>$otpData[0]->type,
                                      'ip'=>$ip,
                                      'date'=>$cur_date
                                  );
                                        $last_id=$this->CI->base_model->insert_table("tbl_cart", $cart_insert, 1) ;
                                    }
                                }
                            }
                            //---------- set login session -------------------
                            $this->CI->session->set_userdata('user_data', 1);
                            $this->CI->session->set_userdata('name', $user_data[0]->f_name);
                            $this->CI->session->set_userdata('phone', $phone);
                            $this->CI->session->set_userdata('user_type', $otpData[0]->type);
                            $this->CI->session->set_userdata('user_id', $user_data[0]->id);
                            $respone['status'] = true;
                            $respone['message'] ='Login Successfully';
                            $this->CI->session->set_flashdata('smessage', 'Login Successfully');
                            return json_encode($respone);
                        } else {
                            $respone['status'] = true;
                            $respone['message'] ='Your account is inactive!';
                            return json_encode($respone);
                        }
                    } else {
                        $respone['status'] = false;
                        $respone['message'] ='Some error occurred! Please try again';
                        $this->CI->session->set_flashdata('emessage', 'Some error occurred! Please try again');
                        return json_encode($respone);
                    }
                } else {
                    $respone['status'] = false;
                    $respone['message'] ='OTP is already used!';
                    $this->CI->session->set_flashdata('emessage', 'OTP is already used!');
                    return json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ='Wrong OTP Entered!';
                $this->CI->session->set_flashdata('emessage', 'Wrong OTP Entered!');
                return json_encode($respone);
            }
            } else {
                $respone['status'] = false;
                $respone['message'] ='Invalid OTP!';
                $this->CI->session->set_flashdata('emessage', 'Invalid OTP!');
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }

    //============================= USER OTP LOGOUT ==========================================
    public function UserOtpLogout()
    {
        if (!empty($this->CI->session->userdata('user_data'))) {
            $this->CI->session->unset_userdata('user_data');
            $this->CI->session->unset_userdata('user_id');
            $this->CI->session->unset_userdata('name');
            $this->CI->session->unset_userdata('phone');
            $this->CI->session->unset_userdata('user_type');
            $respone['status'] = true;
            $respone['data_message'] ='Logout Successfully!';
            $this->CI->session->set_flashdata('smessage', 'Logout Successfully!');
            return json_encode($respone);
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }

    // ================================================= STOP OTP SYSTEM =============================================================
}

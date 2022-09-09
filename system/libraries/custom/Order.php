<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require('razorpay/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class CI_Order
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->model("admin/login_model");
        $this->CI->load->model("admin/base_model");
    }

    //===================================== CALCULATE ========================================================
    public function calculate()
    {
        $user_type = $this->CI->session->userdata('user_type');
        // echo $user_type;  die();
        if($user_type==2){
        $reseller_id = $this->CI->session->userdata('user_id');
        $cartInfo = $this->CI->db->get_where('tbl_cart', array('user_id'=> $reseller_id, 'user_type'=>$user_type));
        $user_id = '';
      }else{
        $user_id = $this->CI->session->userdata('user_id');
        $cartInfo = $this->CI->db->get_where('tbl_cart', array('user_id'=> $user_id, 'user_type'=>$user_type));
        $reseller_id = '';
      }
        //---------get cart data----------------

        if (!empty($cartInfo)) {
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            $total = 0;
            $price = 0;
            foreach ($cartInfo->result() as $cart) {
                $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $cart->type_id,'is_active' => 1))->result();
                // -------check inventory ------
                if (!empty($type_data)) {
                    if ($type_data[0]->inventory <= $cart->quantity) {
                        $this->CI->session->set_flashdata('emessage','Product is out of stock!');
                        return 0; exit;
                    }
                } else {
                  $this->CI->session->set_flashdata('emessage','Product is out of stock!');
                  return 0; exit;
                }
                if ($user_type==2) {
                  if ($type_data[0]->reseller_min_qty >= $cart->quantity) {
                    $this->CI->session->set_flashdata('emessage','Minimum quantity should be '.$type_data[0]->reseller_min_qty.'!');
                    return 0; exit;
                  }
                    $spgst = $type_data[0]->reseller_spgst;
                } else {
                    $spgst = $type_data[0]->retailer_spgst;
                }
                $price = $spgst * $cart->quantity;
                $total= $total + $price;
                $final_amount = $total ;
            }

            //------order1 entry-------------
            $order1_insert = array('user_id'=>$user_id,
                      'reseller_id'=>$reseller_id,
                      'total_amount'=>$total,
                      'final_amount'=>$total,
                      'payment_status'=>0,
                      'order_status'=>0,
                      // 'shipping'=>SHIPPING,
                      'ip' =>$ip,
                      'date'=>$cur_date
                      );

            $last_id=$this->CI->base_model->insert_table("tbl_order1", $order1_insert, 1) ;

            if (!empty($last_id)) {
                //---------------order2 entires-------------------
                foreach ($cartInfo->result() as $cart2) {
                    $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $cart2->type_id,'is_active' => 1))->result();

                    $user_type = $this->CI->session->userdata('user_type');
                    $spgst = 0;
                    if ($user_type==2) {
                      $mrp = $type_data[0]->reseller_mrp;
                      $gst = $type_data[0]->reseller_gst;
                      $sp = $type_data[0]->reseller_sp;
                      $spgst = $type_data[0]->reseller_spgst;
                    } else {
                      $mrp = $type_data[0]->retailer_mrp;
                      $gst = $type_data[0]->retailer_gst;
                      $sp = $type_data[0]->retailer_sp;
                      $spgst = $type_data[0]->retailer_spgst;
                    }

                    $total = $spgst * $cart2->quantity;
                    $order2_insert = array('main_id'=>$last_id,
                      'product_id'=>$cart2->product_id,
                      'type_id'=>$cart2->type_id,
                      'quantity'=>$cart2->quantity,
                      'mrp'=>$mrp,
                      'gst'=>$gst,
                      'selling_price'=>$sp,
                      'spgst'=>$spgst,
                      'total_amount'=>$total,
                      'date'=>$cur_date
                      );

                    $last_id2=$this->CI->base_model->insert_table("tbl_order2", $order2_insert, 1);
                }
                if (!empty($last_id)) {
                    $this->CI->session->set_userdata('order_id', base64_encode($last_id));
                    $respone['status'] = true;
                    $respone['message'] ='Success';
                    return 1;
                } else {
                  $this->CI->session->set_flashdata('emessage','Some error occurred!');
                      return 0; exit;
                }
            } else {
              $this->CI->session->set_flashdata('emessage','Some error occurred');
                      return 0; exit;
            }
        } else {
          $this->CI->session->set_flashdata('emessage','Your cart is empty!');
          return 0; exit;
        }
    }

    // =========================================== PLACE COD ORDER ===========================================================
    public function PlaceOrder($placeOrder)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $order_id = base64_decode($this->CI->session->userdata('order_id'));
        $user_id = $this->CI->session->userdata('user_id');
        $user_type = $this->CI->session->userdata('user_type');
        if($this->CI->session->userdata('user_type')==2){
        $user_id = $this->CI->session->userdata('user_id');
        $user_data = $this->CI->db->get_where('tbl_reseller', array('id = ' => $user_id))->result();
      }else{
        $user_id = $this->CI->session->userdata('user_id');
        $user_data = $this->CI->db->get_where('tbl_users', array('id = ' => $user_id))->result();
      }
        if (!empty($user_data)) {
            if ($user_data[0]->is_active==1) {
                $order_data = $this->CI->db->get_where('tbl_order1', array('id = ' => $order_id))->result();
                // $final_amount = $order_data[0]->total_amount - $order_data[0]->promo_discount +  $order_data[0]->shipping;
                $final_amount = $order_data[0]->total_amount - $order_data[0]->promo_discount;
                $referpoints['model_id'] = '';
                $referpoints['refer_points'] = 0;
                if (!empty($placeOrder['referalcode'])) {
                    $referpoints = $this->checkModelReferal($placeOrder['referalcode'], $order_id);
                }
                //----------order1 entry-------------
                $order1_update = array(
                              'name'=>$placeOrder['name'],
                              'email'=>$placeOrder['email'],
                              'phone'=>$placeOrder['phone'],
                              'address'=>$placeOrder['address'],
                              'state'=>$placeOrder['state'],
                              'city'=>$placeOrder['city'],
                              'final_amount'=>$final_amount,
                              'refererral_code'=>$placeOrder['referalcode'],
                              'ref_points'=>$referpoints['refer_points'],
                              'model_id'=>$referpoints['model_id'],
                              'payment_status'=>1,
                              'payment_type'=>1,
                              'order_status'=>1,
                              'order_type'=>1,
                              'date'=>$cur_date,
                              'ip'=>$ip,
                                );
                $this->CI->db->where('id', $order_id);
                $zapak2 = $this->CI->db->update('tbl_order1', $order1_update);

                if ($zapak2==1) {
                    $order2_data = $this->CI->db->get_where('tbl_order2', array('main_id = ' => $order_id));
                    //--------------inventory update and cart delete--------
                    foreach ($order2_data->result() as $odr2) {
                      //---------- inventory update ------------------------
                      $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $odr2->type_id))->result();
                      $new_inventory = (int)$type_data[0]->inventory - (int)$odr2->quantity;
                      $this->CI->db->where('id', $odr2->type_id);
                      $zapak2 = $this->CI->db->update('tbl_type', array('inventory'=>$new_inventory));
                        //-------cart delete---------
                        $delete=$this->CI->db->delete('tbl_cart', array('user_id' => $user_id,'product_id'=>$odr2->product_id, 'type_id'=>$odr2->type_id, 'user_type'=>$user_type));
                        $this->CI->session->unset_userdata('cart_data');
                    }
                    // $config = Array(
                    // 'protocol' => 'smtp',
                    // 'smtp_host' => SMTP_HOST,
                    // 'smtp_port' => SMTP_PORT,
                    // 'smtp_user' => USER_NAME, // change it to yours
                    // 'smtp_pass' => PASSWORD, // change it to yours
                    // 'mailtype' => 'html',
                    // 'charset' => 'iso-8859-1',
                    // 'wordwrap' => true
                    // );
                    // $to=$email;
                    // $data['name']= $name;
                    // $data['email']= $email;
                    // $data['phone']= $phone;
                    // $data['order1_id']= $order_id;
                    // $data['date']= $cur_date;
                    // $message =$this->load->view('email/ordersuccess',$data,TRUE);
                    // // echo $to;
                    // // print_r($message);
                    // // exit;
                    // $this->load->library('email', $config);
                    // $this->email->set_newline("");
                    // $this->email->from(EMAIL); // change it to yours
                    // $this->email->to($to);// change it to yours
                    // $this->email->subject('Order Placed');
                    // $this->email->message($message);
                    // if($this->email->send()){
                    // // echo 'Email sent.';
                    // }else{
                    // show_error($this->email->print_debugger());
                    // }
                    // die();
                    $respone['status'] = true;
                    return json_encode($respone);
                } else {
                    $respone['status'] = false;
                    $respone['data_message'] ="Some error occurred";
                    return json_encode($respone);
                }
            } else {
                $this->CI->session->unset_userdata('user_data');
                $this->CI->session->unset_userdata('user_id');
                $this->CI->session->unset_userdata('user_name');
                $this->CI->session->unset_userdata('user_email');
                $respone['status'] = false;
                $this->CI->session->set_flashdata('emessage', "Your account is inactive! Please contact admin");
                return json_encode($respone);
            }
        } else {
            $this->CI->session->unset_userdata('user_data');
            $this->CI->session->unset_userdata('user_id');
            $this->CI->session->unset_userdata('user_name');
            $this->CI->session->unset_userdata('user_email');
            $respone['status'] = false;
            $this->CI->session->set_flashdata('emessage', "User not found!");
            echo json_encode($respone);
        }
    }

    // =============================================== CREATE RAZORPAY ORDER ID =====================================================
    public function CreateRazorPayOrderID()
    {
        if ((!empty($this->CI->session->userdata('order_id')))) {
            $order_id = base64_decode($this->CI->session->userdata('order_id'));
            $order_data = $this->CI->db->get_where('tbl_order1', array('id = ' => $order_id))->result();

            $orderData = [
            'receipt'         => $order_data[0]->id,
            'amount'          => $order_data[0]->final_amount*100, // 39900 rupees in paise
            'currency'        => 'INR'
        ];

            $api_key = API_KEY;
            $api_secret = API_SECRET;
            $api = new Api($api_key, $api_secret);

            $razorpayOrder = $api->order->create($orderData);

            $respone['status'] = true;
            $respone['message'] = 'success';
            $respone['razorpayOrder'] = $razorpayOrder->id;
            return json_encode($respone);
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }


    // =============================== PLACE ONLINE ARDER AFTER CONFIRMATION FROM RAZORPAY ====================================
    public function PlacePrePaidOrder($placeOrder)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $order_id = base64_decode($this->CI->session->userdata('order_id'));
        $user_type = $this->CI->session->userdata('user_type');
        if($this->CI->session->userdata('user_type')==2){
        $user_id = $this->CI->session->userdata('user_id');
        $user_data = $this->CI->db->get_where('tbl_reseller', array('id = ' => $user_id))->result();
      }else{
        $user_id = $this->CI->session->userdata('user_id');
        $user_data = $this->CI->db->get_where('tbl_users', array('id = ' => $user_id))->result();
      }
        if (!empty($user_data)) {
            if ($user_data[0]->is_active==1) {
                $success = true;
                $error = "Payment Failed";
                $keyId = API_KEY;
                $keySecret = API_SECRET;
                if (empty($placeOrder['razorpay_payment_id']) === false) {
                    $api = new Api($keyId, $keySecret);
                    try {
                        // Please note that the razorpay order ID must
                        // come from a trusted source (session here, but
                        // could be database or something else)
                        $attributes = array(
                                                      'razorpay_order_id' => $placeOrder['razorpay_order_id'],
                                                      'razorpay_payment_id' => $placeOrder['razorpay_payment_id'],
                                                      'razorpay_signature' => $placeOrder['razorpay_signature']
                                                  );

                        $api->utility->verifyPaymentSignature($attributes);
                    } catch (SignatureVerificationError $e) {
                        $success = false;
                        $error = 'Razorpay Error : ' . $e->getMessage();
                    }
                }
                if ($success == true) {
                    $order_data = $this->CI->db->get_where('tbl_order1', array('id = ' => $order_id))->result();
                    // $final_amount = $order_data[0]->total_amount - $order_data[0]->promo_discount +  $order_data[0]->shipping;
                    $final_amount = $order_data[0]->total_amount - $order_data[0]->promo_discount;
                    $referpoints['model_id'] = '';
                    $referpoints['refer_points'] = 0;
                    if (!empty($placeOrder['referalcode'])) {
                        $referpoints = $this->checkModelReferal($placeOrder['referalcode'], $order_id);
                    }
                    //----------order1 entry-------------
                    $order1_update = array(
                              'name'=>$placeOrder['name'],
                              'email'=>$placeOrder['email'],
                              'phone'=>$placeOrder['phone'],
                              'address'=>$placeOrder['address'],
                              'state'=>$placeOrder['state'],
                              'city'=>$placeOrder['city'],
                              'final_amount'=>$final_amount,
                              'refererral_code'=>$placeOrder['referalcode'],
                              'ref_points'=>$referpoints['refer_points'],
                              'model_id'=>$referpoints['model_id'],
                              'payment_status'=>1,
                              'payment_type'=>2,
                              'order_status'=>1,
                              'order_type'=>1,
                              'date'=>$cur_date,
                              'ip'=>$ip,
                                );
                    $this->CI->db->where('id', $order_id);
                    $zapak2 = $this->CI->db->update('tbl_order1', $order1_update);

                    if ($zapak2==1) {
                        $order2_data = $this->CI->db->get_where('tbl_order2', array('main_id = ' => $order_id));
                        //--------------inventory update and cart delete--------
                        foreach ($order2_data->result() as $odr2) {
                          //---------- inventory update ------------------------
                          $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $odr2->type_id))->result();
                          $new_inventory = (int)$type_data[0]->inventory - (int)$odr2->quantity;
                          $this->CI->db->where('id', $odr2->type_id);
                          $zapak2 = $this->CI->db->update('tbl_type', array('inventory'=>$new_inventory));
                            //-------cart delete---------
                            $delete=$this->CI->db->delete('tbl_cart', array('user_id' => $user_id,'product_id'=>$odr2->product_id, 'type_id'=>$odr2->type_id, 'user_type'=>$user_type));
                            $this->CI->session->unset_userdata('cart_data');
                        }
                        // $config = Array(
                        // 'protocol' => 'smtp',
                        // 'smtp_host' => SMTP_HOST,
                        // 'smtp_port' => SMTP_PORT,
                        // 'smtp_user' => USER_NAME, // change it to yours
                        // 'smtp_pass' => PASSWORD, // change it to yours
                        // 'mailtype' => 'html',
                        // 'charset' => 'iso-8859-1',
                        // 'wordwrap' => true
                        // );
                        // $to=$email;
                        // $data['name']= $name;
                        // $data['email']= $email;
                        // $data['phone']= $phone;
                        // $data['order1_id']= $order_id;
                        // $data['date']= $cur_date;
                        // $message =$this->load->view('email/ordersuccess',$data,TRUE);
                        // // echo $to;
                        // // print_r($message);
                        // // exit;
                        // $this->load->library('email', $config);
                        // $this->email->set_newline("");
                        // $this->email->from(EMAIL); // change it to yours
                        // $this->email->to($to);// change it to yours
                        // $this->email->subject('Order Placed');
                        // $this->email->message($message);
                        // if($this->email->send()){
                        // // echo 'Email sent.';
                        // }else{
                        // show_error($this->email->print_debugger());
                        // }
                        // die();
                        $respone['status'] = true;
                        return json_encode($respone);
                    } else {
                        $respone['status'] = false;
                        $respone['message'] ="Some error occurred";
                        return json_encode($respone);
                    }
                } else {
                    $respone['status'] = false;
                    $respone['message'] ="Some error occurred";
                    return json_encode($respone);
                }
            } else {
                $this->CI->session->unset_userdata('user_data');
                $this->CI->session->unset_userdata('user_id');
                $this->CI->session->unset_userdata('user_name');
                $this->CI->session->unset_userdata('user_email');
                $respone['status'] = false;
                $respone['message'] ="Your account is inactive! Contact Admin";
                return json_encode($respone);
            }
        } else {
            $this->CI->session->unset_userdata('user_data');
            $this->CI->session->unset_userdata('user_id');
            $this->CI->session->unset_userdata('user_name');
            $this->CI->session->unset_userdata('user_email');
            $respone['status'] = false;
            $respone['message'] ="User Not Found!";
            return json_encode($respone);
        }
    }

    // ===================================== CHECK FOR MODEL REFERAL CODE ============================================
    public function checkModelReferal($referal, $order_id)
    {
        $validitycheck = $this->CI->db->get_where('tbl_users', array('reference_code = ' => $referal, 'is_active = '=>1))->result();
        $modelID = '';
        $this_order_points = 0;
        if (!empty($validitycheck)) {
            $modelID = $validitycheck[0]->id;
            $model_products = $this->CI->db->get_where('tbl_model_products', array('user_id = ' => $modelID, 'is_active = '=>1));
            $productsExists = $model_products->result();
            if (!empty($productsExists)) {
                $this_order_points = 0;
                $order_data = $this->CI->db->get_where('tbl_order2', array('main_id = ' => $order_id));
                foreach ($order_data->result() as $order2) {
                    foreach ($model_products->result() as $model) {
                        if ($order2->product_id == $model->product_id) {
                            $total_points = $validitycheck[0]->total_points + REFERAL_POINTS;
                            $this_order_points = $this_order_points + REFERAL_POINTS;
                            $insert = array('total_points'=>$total_points);
                            $this->CI->db->where('id', $validitycheck[0]->id);
                            $zapak2 = $this->CI->db->update('tbl_users', $insert);
                        }
                    }
                }
                $returnArray = array('refer_points'=>$this_order_points, 'model_id'=>$modelID);
                return $returnArray;
            } else {
              $returnArray = array('refer_points'=>$this_order_points, 'model_id'=>$modelID);
              return $returnArray;
            }
        } else {
          $returnArray = array('refer_points'=>$this_order_points, 'model_id'=>$modelID);
          return $returnArray;
        }
    }

    // =================================== CANCEL ORDER ===========================================================
    public function cancelOrder($order_id)
    {
        $data_update = array('order_status'=>6);    //--- order status 6: Cancelled by user
        $this->CI->db->where('id', $order_id);
        $zapak=$this->CI->db->update('tbl_order1', $data_update);
        //-------update inventory-------
        $data_order2 = $this->CI->db->get_where('tbl_order2', array('main_id = ' => $order_id));
        foreach ($data_order2->result() as $data) {
            $type = $this->CI->db->get_where('tbl_type', array('id = ' => $data->type_id))->result();
            if (!empty($type)) {
                $update_inv = $type->inventory + $data->quantity;
                $data_update = array('inventory'=>$update_inv);
                $this->CI->db->where('id', $type->id);
                $zapak2=$this->CI->db->update('tbl_type', $data_update);
            }
        }
        if (!empty($zapak)) {
            return true;
        } else {
            return false;
        }
    }
}

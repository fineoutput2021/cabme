<?php

ob_start(); if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library("custom/Cart");
        $this->load->library("custom/Order");
        $this->load->library("custom/Promocode");
    }

    //-------------calculate--------------

    public function calculate()
    {
      if(!empty($this->session->userdata('user_data'))){
        $calculate = $this->order->calculate();
        if($calculate==1){
        redirect("Order/view_checkout");
      }else{
        redirect("Home/my_bag");
      }
      }else{
        redirect("/", "refresh");
      }
    }

    //--------view checkout---------

    public function view_checkout()
    {
        if ((!empty($this->session->userdata('user_data')) && !empty($this->session->userdata('order_id')))) {

            $data['order_data']= $this->db->get_where('tbl_order1', array('id' => base64_decode($this->session->userdata('order_id'))))->result();


            $data['state_data'] = $this->db->get('all_states');

            $cart_fetch = $this->cart->ViewCartOnline();
            $data['cart_fetch'] = $cart_fetch;

            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/checkout');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("/", "refresh");
        }
    }

    //-----------apply promocode---------
    public function apply_promocode()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('promocode', 'promocode', 'required|xss_clean|trim');
            if ($this->form_validation->run()== true) {
                $promocode=strtoupper($this->input->post('promocode'));
                $apply = $this->promocode->applyPromocode($promocode);
                echo $apply;
        } else {
            $respone['status'] = false;
            $respone['message'] ="Please insert some data, No data available";
            echo json_encode($respone);
        }
    }else{
      $respone['status'] = false;
      $respone['message'] =validation_errors();
      echo json_encode($respone);
    }
  }

    //------remove promocode--------
    public function remove_promocode()
    {
      $apply = $this->promocode->removePromocode();
      echo $apply;
    }

    //--------checkout----------------
    public function checkout()
    {
        if (!empty($this->session->userdata('user_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('fname', 'fname', 'required|xss_clean|trim');
                $this->form_validation->set_rules('lname', 'lname', 'required|xss_clean|trim');
                $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
                $this->form_validation->set_rules('phonenumber', 'phonenumber', 'required|xss_clean|trim');
                $this->form_validation->set_rules('state', 'state', 'required|xss_clean|trim');
                $this->form_validation->set_rules('city', 'city', 'required|xss_clean|trim');
                $this->form_validation->set_rules('address', 'address', 'required|xss_clean|trim');
                $this->form_validation->set_rules('payment_method', 'payment_method', 'required|xss_clean|trim');
                $this->form_validation->set_rules('referalcode', 'referalcode', 'xss_clean|trim');

                if ($this->form_validation->run()== true) {
                    $name=$this->input->post('fname')." ".$this->input->post('lname');;
                    $email=$this->input->post('email');
                    $phone=$this->input->post('phonenumber');
                    $state=$this->input->post('state');
                    $city=$this->input->post('city');
                    $address=$this->input->post('address');
                    $payment_method=$this->input->post('payment_method');
                    $referalcode=$this->input->post('referalcode');
                    if($payment_method==1){
                    $order_array = array(
                        'name'=>$name,
                        'email'=>$email,
                        'phone'=>$phone,
                        'state'=>$state,
                        'city'=>$city,
                        'address'=>$address,
                        'referalcode'=>$referalcode,
                        'payment_type'=>$payment_method,
                          );
                    $placeOrder = $this->order->PlaceOrder($order_array);
                    echo $placeOrder;
                  }elseif($payment_method==2){
                    //--- Create Razorpay order ID ---------
                    $placeOrder = $this->order->CreateRazorPayOrderID();
                    echo $placeOrder;
                  }else{
                    $respone['status'] = false;
                    $respone['message'] = 'Some unknown error occurred';
                    echo json_encode($respone);
                  }
                } else {
                    $respone['status'] = false;
                    $respone['message'] = validation_errors();
                    echo json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ="Please insert some data, No data available";
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] ="Some unknown error occurred";
            echo json_encode($respone);
        }
    }


    // ======================================== Order place after payment ===============================
    public function place_prepaid_order()
    {
        if (!empty($this->session->userdata('user_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('fname', 'fname', 'required|xss_clean|trim');
                $this->form_validation->set_rules('lname', 'lname', 'required|xss_clean|trim');
                $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
                $this->form_validation->set_rules('phonenumber', 'phonenumber', 'required|xss_clean|trim');
                $this->form_validation->set_rules('state', 'state', 'required|xss_clean|trim');
                $this->form_validation->set_rules('city', 'city', 'required|xss_clean|trim');
                $this->form_validation->set_rules('address', 'address', 'required|xss_clean|trim');
                $this->form_validation->set_rules('payment_method', 'payment_method', 'required|xss_clean|trim');
                $this->form_validation->set_rules('referalcode', 'referalcode', 'xss_clean|trim');
                $this->form_validation->set_rules('razorpay_payment_id', 'razorpay_payment_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('razorpay_order_id', 'razorpay_order_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('razorpay_signature', 'razorpay_signature', 'required|xss_clean|trim');

                if ($this->form_validation->run()== true) {
                    $name=$this->input->post('fname')." ".$this->input->post('lname');;
                    $email=$this->input->post('email');
                    $phone=$this->input->post('phonenumber');
                    $state=$this->input->post('state');
                    $city=$this->input->post('city');
                    $address=$this->input->post('address');
                    $payment_method=$this->input->post('payment_method');
                    $referalcode=$this->input->post('referalcode');
                    $razorpay_payment_id=$this->input->post('razorpay_payment_id');
                    $razorpay_order_id=$this->input->post('razorpay_order_id');
                    $razorpay_signature=$this->input->post('razorpay_signature');
                    $order_array = array(
                        'name'=>$name,
                        'email'=>$email,
                        'phone'=>$phone,
                        'state'=>$state,
                        'city'=>$city,
                        'address'=>$address,
                        'referalcode'=>$referalcode,
                        'payment_type'=>$payment_method,
                        'razorpay_payment_id'=>$razorpay_payment_id,
                        'razorpay_order_id'=>$razorpay_order_id,
                        'razorpay_signature'=>$razorpay_signature,
                          );
                    $placeOrder = $this->order->PlacePrePaidOrder($order_array);
                    echo $placeOrder;
                } else {
                    $respone['status'] = false;
                    $respone['message'] = validation_errors();
                    echo json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ="Please insert some data, No data available";
                echo json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] ="Some unknown error occurred";
            echo json_encode($respone);
        }
    }

    //-----------order success---------
    public function order_success()
    {
        if ((!empty($this->session->userdata('user_data')) && !empty($this->session->userdata('order_id'))) || (!empty($this->session->userdata('guest_data')) && !empty($this->session->userdata('order_id')))) {
            $user_id = $this->session->userdata('user_id');

            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('id', base64_decode($this->session->userdata('order_id')));
            $orderdata= $this->db->get()->row();

            $data['order_id'] =$orderdata->id;
            $data['amount'] =$orderdata->final_amount;
            $data['user_id'] =$user_id;

            $this->session->unset_userdata('order_id');

            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/order_success');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("/", "refresh");
        }
    }

    public function order_failed()
    {
        $this->load->view('frontend/common/header');
        $this->load->view('frontend/order_failed');
        $this->load->view('frontend/common/footer');
    }

    //===========View my orders=========================
    public function view_order()
    {
        if (!empty($this->session->userdata('user_data'))) {
            $user_id=$this->session->userdata('user_id');
            $this->db->select('*');
            $this->db->from('tbl_order1');
            $this->db->where('user_id', $user_id);
            $this->db->order_by('id', 'desc');
            $this->db->where('order_status!= ', 0);
            $data['order1_data']= $this->db->get();
            $this->load->view('frontend/common/header', $data);
            $this->load->view('frontend/my_orders');
            $this->load->view('frontend/common/footer');
        } else {
            redirect("/", "refresh");
        }
    }

    //--------cancel order---------
    public function cancel_order($idd)
    {
        $id=base64_decode($idd);
        $cancel_order = $this->order->cancelOrder($id);
        if ($cancel_order==true) {
            $this->session->set_flashdata('smessage', 'Order cancelled successfully');
            redirect("Home/my_profile");
        } else {
            $this->session->set_flashdata('emessage', 'Some error occurred');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}

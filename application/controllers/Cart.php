<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Cart extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
        $this->load->library('custom/Cart');
        $this->load->library('custom/Wishlist');
    }

    //======================================= ADD TO CART ========================================================

    public function addToCart()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $product_id=base64_decode($this->input->post('product_id'));
                $type_id=base64_decode($this->input->post('type_id'));
                $quantity=$this->input->post('quantity');
                if (empty($this->session->userdata('user_data'))) {
                    $cartCall = $this->cart->AddToCartOffline($product_id, $type_id, $quantity);
                } else {
                    $cartCall = $this->cart->AddToCartOnline($product_id, $type_id, $quantity);
                }
                echo $cartCall;
            } else {
                $respone['data'] = false;
                $respone['data_message'] =validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] ="Please insert some data, No data available";
            echo json_encode($respone);
        }
    }

    //======================================= ADD TO CART ========================================================

    public function deleteFromCart()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $product_id=base64_decode($this->input->post('product_id'));
                $type_id=base64_decode($this->input->post('type_id'));
                if (empty($this->session->userdata('user_data'))) {
                    $cartCall = $this->cart->RemoveCartOffline($product_id, $type_id);
                } else {
                    $cartCall = $this->cart->RemoveCartOnline($product_id, $type_id);
                }
                echo $cartCall;
            } else {
                $respone['data'] = false;
                $respone['data_message'] =validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] ="Please insert some data, No data available";
            echo json_encode($respone);
        }
    }

    //----update cart quatity from session cart--------
    public function updateCart()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $product_id=base64_decode($this->input->post('product_id'));
                $type_id=base64_decode($this->input->post('type_id'));
                $quantity=$this->input->post('quantity');
                if (empty($this->session->userdata('user_data'))) {
                    $cartCall = $this->cart->UpdateCartOffline($product_id, $type_id, $quantity);
                } else {
                    $cartCall = $this->cart->UpdateCartOnline($product_id, $type_id, $quantity);
                }
                echo $cartCall;
            } else {
                $respone['data'] = false;
                $respone['data_message'] = validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] ="Please insert some data, No data available";
            echo json_encode($respone);
        }
    }

    //================================ wishlist ============================================
    public function wishlist()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('status', 'status', 'required|xss_clean|trim');


            if ($this->form_validation->run()== true) {
                $product_id=base64_decode($this->input->post('product_id'));
                $type_id=base64_decode($this->input->post('type_id'));
                $status=$this->input->post('status');
                //----------add to wishlist----
                if ($status=="add") {
                    $add_wishlist = $this->wishlist->AddToWishlist($product_id, $type_id);
                    echo $add_wishlist;
                }
                //---------remove wishlist---------
                elseif ($status=="remove") {
                    $remove_wishlist = $this->wishlist->RemoveToWishlist($product_id, $type_id);
                    echo $remove_wishlist;
                }
                //---------move to cart--------
                elseif ($status=="move") {
                    $move_wishlist = $this->wishlist->MoveToCart($product_id, $type_id);
                    echo $move_wishlist;
                }
            } else {
                $respone['data'] = false;
                $respone['data_message'] =validation_errors();
                echo json_encode($respone);
            }
        } else {
            $respone['data'] = false;
            $respone['data_message'] ="Please insert some data, No data available";
            echo json_encode($respone);
        }
    }
}

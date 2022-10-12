<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_Cart
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->model("admin/login_model");
        $this->CI->load->model("admin/base_model");

    }

    //================================================= START BEFORE LOGIN CART ========================================================

    //================- ADD TO CART SESSION =====================================
    public function AddToCartOffline($product_id, $type_id, $quantity)
    {
        $ip = $this->CI->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $cart_item = array('product_id'=>$product_id,
        'type_id'=>$type_id,
        'quantity'=>$quantity,
        'ip' =>$ip,
        'date'=>$cur_date
        );
        //---------- check inventory --------
        $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $type_id,'is_active' => 1))->result();
        if (!empty($type_data)) {
            if ($type_data[0]->inventory < $quantity) {
                $respone['status'] = false;
                $respone['message'] ="Product is out of stock";
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] ="Product is out of stock";
            return json_encode($respone);
        }
        //----check product in already in cart------
        $cart_data = $this->CI->session->userdata('cart_data');
        if (!empty($cart_data)) {
            $i=0;
            foreach ($cart_data as $items) {
                if ($items['product_id'] == $product_id && $items['type_id'] == $type_id) {
                    $i=1;
                }
            }
            if ($i==1) {
                $respone['status'] = false;
                $respone['message'] ="Item is already in your cart";
                return json_encode($respone);
            } else {
                array_push($cart_data, $cart_item);
                $this->CI->session->set_userdata('cart_data', $cart_data);
                $respone['status'] = true;
                $respone['message'] = "Item successfully added in your cart";
                return json_encode($respone);
            }
        }
        //------create session cart------
        else {
            $cart = array($cart_item);
            $this->CI->session->set_userdata('cart_data', $cart);
            $respone['status'] = true;
            $respone['message'] = "Item successfully added in your cart";
            return json_encode($respone);
        }
    }

    //================- REMOVE TO CART SESSION =====================================
    public function RemoveCartOffline($product_id, $type_id)
    {
        $index="-1";
        $cart = $this->CI->session->userdata('cart_data');
        //----- Find index of the cart array ---
        if (!empty($cart)) {
            for ($i = 0; $i < count($cart); $i ++) {
                if ($cart[$i]['product_id'] == $product_id && $cart[$i]['type_id'] == $type_id) {
                    $index= $i;
                }
            }
        }
        if ($index > -1) {
            $cart = $this->CI->session->userdata('cart_data');
            unset($cart[$index]);
            $cart = array_values($cart);
            $this->CI->session->set_userdata('cart_data', $cart);
            $respone['status'] = true;
            $respone['message'] ="Item successfully removed from your cart";
            return json_encode($respone);
        } else {
            $respone['status'] = false;
            $respone['message'] ="Some error occurred";
            return json_encode($respone);
        }
    }

    //========================= UPDATE SESSION CART ================================
    public function UpdateCartOffline($product_id, $type_id, $quantity)
    {
        $index="-1";
        //---------- check inventory --------
        $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $type_id,'is_active' => 1))->result();
        if (!empty($type_data)) {
            if ($type_data[0]->inventory < $quantity) {
                $respone['status'] = false;
                $respone['message'] ="Product is out of stock";
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] ="Product is out of stock";
            return json_encode($respone);
        }
        //----check product in already in cart------
        $cart = $this->CI->session->userdata('cart_data');
        if (!empty($cart)) {
            for ($i = 0; $i < count($cart); $i ++) {
                if ($cart[$i]['product_id'] == $product_id && $cart[$i]['type_id']) {
                    $index= $i;
                }
            }
        }
        if ($index > -1) {
            $cart = $this->CI->session->userdata('cart_data');
            $cart[$index]['quantity']=$quantity;
            $this->CI->session->set_userdata('cart_data', $cart);
            $this->CI->session->set_flashdata('smessage', 'Item successfully updated in your cart');
            $respone['status'] = true;
            $respone['message'] ="Item successfully updated in your cart";
            return json_encode($respone);
        } else {
            $respone['status'] = false;
            $respone['message'] ="Some error occurred";
            return json_encode($respone);
        }
    }
    //========================= VIEW SESSION CART ================================
    public function ViewCartOffline()
    {
        $sub_total=0;
        $total_weight=0;
        $cart_info = [];
        $cart_data= $this->CI->session->userdata('cart_data');
        if (!empty($cart_data)) {
            foreach ($cart_data as $cart) {
                $weight=0;
                $total=0;
                $pro_data = $this->CI->db->get_where('tbl_product', array('id = ' => $cart['product_id'],'is_active' => 1))->result();
                $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $cart['type_id'],'is_active' => 1))->result();
                $size_data = $this->CI->db->get_where('tbl_size', array('id = ' => $type_data[0]->size_id,'is_active' => 1))->result();
                $color_data = $this->CI->db->get_where('tbl_colour', array('id = ' => $type_data[0]->colour_id,'is_active' => 1))->result();
                if (!empty($type_data[0]->image)) {
                    $image=base_url().$type_data[0]->image;
                } else {
                    $image="";
                }
                $user_type = $this->CI->session->userdata('user_type');
                //---- stock status-----
                if ($type_data[0]->inventory>0) {
                    $stock=1;
                } else {
                    $stock=0;
                }
                //---- check price of reseller and retailer -----
                $spgst = 0;
                if ($user_type==2) {
                    $spgst = $type_data[0]->reseller_spgst;
                } else {
                    $spgst = $type_data[0]->retailer_spgst;
                }
                $cart_info[] = array('type_id'=> $cart['type_id'],
        'product_id'=>$pro_data[0]->id,
        'product_name'=>$pro_data[0]->name,
        'product_image'=>base_url().$pro_data[0]->image1,
        'size'=>$size_data[0]->name,
        'color'=>$color_data[0]->colour_name,
        'colorcode'=>$color_data[0]->name,
        'image'=>$image,
        'price'=>$spgst,
        'quantity'=>$cart['quantity'],
        'total'=>$spgst * (int)$cart['quantity'],
        'stock' => $stock
        );
                $total = $spgst * (int)$cart['quantity'];
                $sub_total= $sub_total + $total;//--calculate sub total
                $weight = $pro_data[0]->weight * (int)$cart['quantity'];
                $total_weight= $total_weight + $weight;//--calculate total weight
            }
        }
        $respone['status'] = true;
        $respone['message'] ="Success";
        $respone['cart_data'] =$cart_info;
        $respone['sub_total'] =$sub_total;
        $respone['total_weight'] =$total_weight;
        return $respone;
        // return json_encode($respone);
    }
    //================================================= END BEFORE LOGIN CART ========================================================


    //================================================ START AFTER LOGIN CART ========================================================

    //================== LOGIN ADD TO CART ==================================

    public function AddToCartOnline($product_id, $type_id, $quantity)
    {
        if (!empty($this->CI->session->userdata('user_data'))) {
            $user_id = $this->CI->session->userdata('user_id');
            $user_type = $this->CI->session->userdata('user_type');
            $ip = $this->CI->input->ip_address();
            date_default_timezone_set("Asia/Calcutta");
            $cur_date=date("Y-m-d H:i:s");
            //---------- check inventory --------
            $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $type_id,'is_active' => 1))->result();
            if (!empty($type_data)) {
                if ($type_data[0]->inventory < $quantity) {
                    $respone['status'] = false;
                    $respone['message'] ="Product is out of stock";
                    return json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ="Product is out of stock";
                return json_encode($respone);
            }
            // ------ CHECK ALREADY EXIST ------
            $cartInfo = $this->CI->db->get_where('tbl_cart', array('user_id= ' => $user_id,'type_id' => $type_id, 'user_type'=>$user_type))->result();
            if (empty($cartInfo)) {
                $cart_insert = array('user_id'=>$user_id,
                        'product_id'=>$product_id,
                        'type_id'=>$type_id,
                        'quantity'=>$quantity,
                        'user_type'=>$user_type,
                        'ip'=>$ip,
                        'date'=>$cur_date
                    );
                $last_id=$this->CI->base_model->insert_table("tbl_cart", $cart_insert, 1) ;
                if (!empty($last_id)) {
                    $respone['status'] = true;
                    $respone['message'] ="Item successfully added to your cart";
                    return json_encode($respone);
                } else {
                    $respone['status'] = false;
                    $respone['message'] ="Some error occurred";
                    return json_encode($respone);
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ="Item is already in your cart";
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            $respone['message'] ="Cart data not found";
            return json_encode($respone);
        }
    }

    //============ REMOVE PRODUCT FROM CART LOGIN ============
    public function RemoveCartOnline($product_id, $type_id)
    {
        if (!empty($this->CI->session->userdata('user_data'))) {
            $user_id = $this->CI->session->userdata('user_id');
            $user_type = $this->CI->session->userdata('user_type');     //-- user and reseller manage
            $zapak=$this->CI->db->delete('tbl_cart', array('user_id' => $user_id,'product_id'=>$product_id, 'type_id'=>$type_id, 'user_type'=>$user_type));
            $respone['status'] = true;
            $respone['message'] ='Item successfully removed from your cart';
            return json_encode($respone);
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }

    //======================== UPDATE CART LOGIN ====================
    public function UpdateCartOnline($product_id, $type_id, $quantity)
    {
        if (!empty($this->CI->session->userdata('user_data'))) {
            $user_id = $this->CI->session->userdata('user_id');
            $user_type = $this->CI->session->userdata('user_type');
            //---------- check inventory --------
            $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $type_id,'is_active' => 1))->result();
            if (!empty($type_data)) {
                if ($type_data[0]->inventory < $quantity) {
                    $respone['status'] = false;
                    $respone['message'] ="Product is out of stock";
                    $this->CI->session->set_flashdata('emessage', 'Product is out of stock');
                    return json_encode($respone);
                    die();
                }
            } else {
                $respone['status'] = false;
                $respone['message'] ="Product is out of stock";
                $this->CI->session->set_flashdata('emessage', 'Product is out of stock');
                return json_encode($respone);
                die();
            }
            //----------cart quantity update--------
            $data_update = array('quantity'=>$quantity);

            $this->CI->db->where('user_id', $user_id);
            $this->CI->db->where('product_id', $product_id);
            $this->CI->db->where('type_id', $type_id);
            $this->CI->db->where('user_type', $user_type);
            $zapak=$this->CI->db->update('tbl_cart', $data_update);

            if (!empty($zapak)) {
                $this->CI->session->set_flashdata('smessage', 'Item successfully updated in your cart');
                $respone['status'] = true;
                $respone['message'] ="Item successfully updated in your cart";
                return json_encode($respone);
            } else {
                $respone['status'] = false;
                $respone['message'] ="Some error occucred";
                return json_encode($respone);
            }
        } else {
            $respone['status'] = false;
            return json_encode($respone);
        }
    }
    //======================== VIEW CART LOGIN ====================

    public function ViewCartOnline()
    {
        if (!empty($this->CI->session->userdata('user_data'))) {
            $sub_total=0;
            $total_weight=0;
            $price = 0;
            $cart_info = [];
            $user_id= $this->CI->session->userdata('user_id');
            $user_type= $this->CI->session->userdata('user_type');
            $cart_data = $this->CI->db->get_where('tbl_cart', array('user_id= ' => $user_id, 'user_type'=>$user_type));
            foreach ($cart_data->result() as $cart) {
                $total=0;
                $weight=0;
                $pro_data = $this->CI->db->get_where('tbl_product', array('id = ' => $cart->product_id,'is_active' => 1))->result();
                $type_data = $this->CI->db->get_where('tbl_type', array('id = ' => $cart->type_id,'is_active' => 1))->result();
                $size_data = $this->CI->db->get_where('tbl_size', array('id = ' => $type_data[0]->size_id,'is_active' => 1))->result();
                $color_data = $this->CI->db->get_where('tbl_colour', array('id = ' => $type_data[0]->colour_id,'is_active' => 1))->result();
                //---- manage type image-------
                if (!empty($type_data[0]->image)) {
                    $image=base_url().$type_data[0]->image;
                } else {
                    $image="";
                }
                //---- stock status-----
                if ($type_data[0]->inventory>0) {
                    $stock=1;
                } else {
                    $stock=0;
                }
                //------ manage price ------
                if ($user_type==1) {//------ for retailer ----
                  $price = $type_data[0]->retailer_spgst;
                } elseif ($user_type==2) {//---- for reselller -----
                    $price = $type_data[0]->reseller_spgst;
                }
                $cart_info[] = array('type_id'=>$cart->type_id,
                    'product_id'=>$pro_data[0]->id,
                    'product_name'=>$pro_data[0]->name,
                    'product_image'=>base_url().$pro_data[0]->image1,
                    'size'=>$size_data[0]->name,
                    'color'=>$color_data[0]->colour_name,
                    'colorcode'=>$color_data[0]->name,
                    'image'=>$image,
                    'price'=>$price,
                    'quantity'=>$cart->quantity,
                    'total'=>$price * (int)$cart->quantity,
                    'stock' => $stock
                    );
                $total = $price * (int)$cart->quantity;
                $sub_total= $sub_total + $total;//--calculate sub total
                $weight = $pro_data[0]->weight * (int)$cart->quantity;
                $total_weight= $total_weight + $weight;//--calculate total weight
            }
            $respone['status'] = true;
            $respone['message'] ="Success";
            $respone['cart_data'] =$cart_info;
            $respone['sub_total'] =$sub_total;
            $respone['total_weight'] =$total_weight;
            return $respone;
        // return json_encode($respone);
        } else {
            $respone['status'] = false;
            return $respone;
            // return json_encode($respone);
        }
    }
    //=========================== END AFTER LOGIN CART ========================================
}

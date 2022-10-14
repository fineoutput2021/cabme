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

    }

    //======================== VIEW SELF DRIVE CARS ====================

    public function ViewSelfDriveCars($city_id, $start_date, $start_time, $end_date, $end_time, $duration)
    {
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

    }
    //=========================== END AFTER LOGIN CART ========================================
}

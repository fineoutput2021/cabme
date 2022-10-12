<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_Promocode
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->model("admin/login_model");
        $this->CI->load->model("admin/base_model");
    }
    //======================================================= START PROMOCODE ==========================================================

    // ======================================================== APPLY PROMOCODE =====================================================

    public function applyPromocode($promocodeString)
    {
        $discount = 0;
        $promocode_id=0;
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=strtotime(date("Y-m-d"));
        $order_id = base64_decode($this->CI->session->userdata('order_id'));
        $user_id = $this->CI->session->userdata('user_id');
        $promocode_data = $this->CI->db->get_where('tbl_promocode', array('promocode' => $promocodeString))->result();

        if (!empty($promocode_data)) {
            $order_data = $this->CI->db->get_where('tbl_order1', array('id = ' => $order_id))->result();
            $final_amount = 0;
            $promocode_id = $promocode_data[0]->id;
            if ($promocode_data[0]->ptype==1) {

                $promocodeAlreadyUsed = $this->CI->db->get_where('tbl_order1', array('user_id = ' => $user_id, 'promocode'=>$promocode_data[0]->id, 'payment_status'=>1))->result();
                if (empty($promocodeAlreadyUsed)) {
                    if (strtotime($promocode_data[0]->end_date) >= $cur_date && strtotime($promocode_data[0]->start_date) <= $cur_date) {
                        if ($order_data[0]->total_amount > $promocode_data[0]->minorder) { //----checking minorder for promocode
                        if ($promocode_data[0]->type==1) { //-- Discount in percentage
                          $discount_amt = $order_data[0]->total_amount * $promocode_data[0]->percentage_amount/100;
                            if ($discount_amt > $promocode_data[0]->max) {
                                // will get max amount
                                $discount =  $promocode_data[0]->max;
                            } else {
                                $discount =  number_format($discount_amt,2);
                            }
                        } else {    //-- Discount in ₹
                            $discount = $promocode_data[0]->percentage_amount;
                        }
                        }   //endif of minorder
                        else {
                            $respone['status'] = false;
                            $respone['message'] = 'The applicable promocode amount is greater than ₹'.$promocode_data[0]->minorder;
                            return json_encode($respone);
                            exit;
                        }
                    } else {
                        $respone['status'] = false;
                        $respone['message'] = 'Invalid Promocode';
                        return json_encode($respone);
                        exit;
                    }
                } else {
                    $respone['status'] = false;
                    $respone['message'] = 'Promocode already used';
                    return json_encode($respone);
                    exit;
                }
            }
            //-----every time promocode---
            else {
                if (strtotime($promocode_data[0]->end_date) >= $cur_date && strtotime($promocode_data[0]->start_date) <= $cur_date) {
                    if ($order_data[0]->total_amount > $promocode_data[0]->minorder) { //----checking minorder for promocode
                if ($promocode_data[0]->type==1) { //-- Discount in percentage
                  $discount_amt = $order_data[0]->total_amount * $promocode_data[0]->percentage_amount/100;
                    if ($discount_amt > $promocode_data[0]->max) {
                        // will get max amount
                        $discount =  $promocode_data[0]->max;
                    } else {
                        $discount =   number_format($discount_amt,2);
                    }
                } else {    //-- Discount in ₹
                    $discount = $promocode_data[0]->percentage_amount;
                }
                    }//endif of minorder
                    else {
                        $respone['status'] = false;
                        $respone['message'] = 'The applicable promocode amount is greater than ₹'.$promocode_data[0]->minorder;
                        return json_encode($respone);
                        exit;
                    }
                } else {
                    $respone['status'] = false;
                    $respone['message'] = 'Invalid Promocode';
                    return json_encode($respone);
                    exit;
                }
            }
            $final_amount = $order_data[0]->total_amount - $discount;

            //-------table_order1 entry-------

            $update_order1_data = array(
                          'promocode'=>$promocode_id,
                          'promo_discount'=>$discount,
                          'final_amount'=>$final_amount
                          );
            $this->CI->db->where('id', $order_id);
            $last_id=$this->CI->db->update('tbl_order1', $update_order1_data);

            if (!empty($last_id)) {
                $respone['status'] = true;
                $respone['message'] = 'Promocode applied successfully';
                return json_encode($respone);
            } else {
                $respone['status'] = false;
                $respone['message'] = 'Some error occurred! please try again';
                return json_encode($respone);
                exit;
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Invalid Promocode';
            return json_encode($respone);
        }
    }

    //======================================================   REMOVE PROMOCODE ====================================================
    public function removePromocode()
    {
        $order_id = base64_decode($this->CI->session->userdata('order_id'));
        $order_data = $this->CI->db->get_where('tbl_order1', array('id = ' => $order_id))->result();
        $final_amount = $order_data[0]->final_amount + $order_data[0]->promo_discount;

        $data_update = array('promocode'=>'',
                      'promo_discount'=>'',
                      'final_amount'=>$final_amount
                    );
        $this->CI->db->where('id', $order_id);
        $zapak=$this->CI->db->update('tbl_order1', $data_update);
        if (!empty($zapak)) {
            $respone['status'] = true;
            $respone['message'] ="Promocode removed successfully";
            return json_encode($respone);
        } else {
            $respone['status'] = false;
            $respone['message'] ="Some error occurred";
            return json_encode($respone);
        }
    }
    //======================================================= END PROMOCODE ==========================================================
}

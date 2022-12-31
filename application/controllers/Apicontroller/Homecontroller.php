<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Homecontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library('pagination');
    }
    //===============================================GET PROMOCODE =======================================//
    public function get_promocode()
    {
        $promocode_data = $this->db->order_by('id', 'desc')->get_where('tbl_promocode', array('is_active' => 1))->result();
        $data = [];
        foreach ($promocode_data as $promo) {
            if ($promo->ptype == 1) {
                $type = "one time";
            } else {
                $type = "every time";
            }
            if (!empty($promo->photo)) {
                $image = base_url() . $promo->photo;
            } else {
                $image = '';
            }
            $data[] = array(
                'id' => $promo->id,
                'promocode' => $promo->promocode,
                'percentage' => $promo->percentage,
                'type' => $type,
                'mindays' => $promo->mindays,
                'max' => $promo->max,
                'image' => $image,
            );
        }
        $res = array(
            'message' => "Success",
            'status' => 200,
            'data' => $data
        );
        echo json_encode($res);
    }
    //=================================== GET TESTIMONIALS ============================//
    public function get_testimonials()
    {
        $testimonials_data = $this->db->order_by('id', 'desc')->get_where('tbl_testimonials', array('is_active' => 1))->result();
        foreach ($testimonials_data as $test) {
            if (!empty($test->photo)) {
                $image = base_url() . $test->photo;
            } else {
                $image = '';
            }
            $data[] = array(
                'id' => $test->id,
                'name' => $test->name,
                'content' => $test->content,
                'image' => $image,
            );
        }
        $res = array(
            'message' => "success",
            'status' => 200,
            'data' => $data
        );
        echo json_encode($res);
    }
    public function my_booking($type)
    {
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
        if (!empty($user_data)) {
            $booking_data = $this->db->get_where('tbl_booking', array('order_status' => $type, 'user_id' => $user_data[0]->id, 'order_status!=' => 0))->result();
            $data = [];
            foreach ($booking_data as $booking) {
                if ($booking->booking_type == 1) {
                    $booking_type = 'Self Drive';
                } else if ($booking->booking_type == 2) {
                    $booking_type = 'Intercity';
                } else {
                    $booking_type = 'Out Station';
                }
                $newdate = new DateTime($booking->date);
                $date = $newdate->format('d/m/Y');   #d-m-Y  // March 10, 2001, 5:16 pm
                $data[] = array(
                    'id' => $booking->id,
                    'booking_type' => $booking_type,
                    'date' => $date,
                );
            }
            $res = array(
                'message' => "success",
                'status' => 200,
                'data' => $data
            );
            echo json_encode($res);
        } else {
            $res = array(
                'message' => 'Permission Denied!',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
    public function my_booking_details($id)
    {
        $header = $this->input->request_headers();
        $auth = $header['Authorization'];
        $user_data = $this->db->get_where('tbl_users', array('is_active' => 1, 'auth' => $auth))->result();
        if (!empty($user_data)) {
            $booking_data = $this->db->get_where('tbl_booking', array('id' => $id, 'user_id' => $user_data[0]->id,))->result();
            $data = [];
            foreach ($booking_data as $booking) {
                if ($booking->booking_type == 1) {
                    $booking_type = 'Self Drive';
                } else if ($booking->booking_type == 2) {
                    $booking_type = 'Intercity';
                } else {
                    $booking_type = 'Out Station';
                }
                $newdate = new DateTime($booking->date);
                $date = $newdate->format('d/m/Y');   #d-m-Y  // March 10, 2001, 5:16 pm
                $data[] = array(
                    'id' => $booking->id,
                    'booking_type' => $booking_type,
                    'total_amount' => $booking->total_amount,
                    'date' => $date,
                );
            }
            $res = array(
                'message' => "success",
                'status' => 200,
                'data' => $data
            );
            echo json_encode($res);
        } else {
            $res = array(
                'message' => 'Permission Denied!',
                'status' => 201
            );
            echo json_encode($res);
        }
    }
}

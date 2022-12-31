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
}

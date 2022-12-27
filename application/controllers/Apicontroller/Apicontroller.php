<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Apicontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/login_model");
        $this->load->model("admin/base_model");
        $this->load->library('pagination');
    }

    //================================= GET SELF CITY =================================//
    public function get_self_city()
    {
        $top_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 1, 'city_type' => 1))->result();
        $other_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active' => 1, 'top' => 0, 'city_type' => 1))->result();
        $top = [];
        $other = [];
        foreach ($top_data as $cities) {
            if (!empty($cities->image)) {
                $image = base_url() . $cities->image;
            } else {
                $image = '';
            }
            $top[] = array(
                'id' => $cities->id,
                'name' => $cities->name,
                'image' => $image,
            );
        }
        foreach ($other_data as $cities2) {
            if (!empty($cities2->image)) {
                $image = base_url() . $cities2->image;
            } else {
                $image = '';
            }
            $other[] = array(
                'id' => $cities2->id,
                'name' => $cities2->name,
                'image' => $image,
            );
        }
    $data =array('top'=>$top,'other'=>$other,);
        $res = array(
            'message' => "success",
            'status' => 200,
            'data' => $data
        );
        echo json_encode($res);
    }
}

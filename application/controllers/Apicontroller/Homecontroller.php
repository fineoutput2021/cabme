<?php
if (! defined('BASEPATH')) {
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
        $prmocode_data = $this->db->get_where('tbl_promocode', array('is_active'=> 1))->result();
        $data=[];
        foreach ($prmocode_data as $promcode) {
            if (!empty($promcode->photo)) {
                $photo=base_url().$promcode->photo;
            } else {
                $photo='';
            }
            $data[]=array('promocode'=>$promcode->promocode,
                       'percentage'=>$promcode->percentage,
                       'ptype'=>$promcode->ptype,
                       'start_date'=>$promcode->start_date,
                       'end_date'=>$promcode->end_date,
                       'mindays'=>$promcode->mindays,
                      
                       'max'=>$promcode->max,
                       'photo'=>$photo,
                      
                     );
        }
        $res=array(
                    'message'=>"success",
                    'status'=>200,
                    'data'=>$data
                    );
        echo json_encode($res);
    }
    //=================================== GET TESTIMONIALS ============================//
    public function get_testimonials()
    {
        $testimonial_data = $this->db->get_where('tbl_testimonials', array('is_active'=> 1))->result();
        $data=[];
        foreach ($testimonial_data as $testimonials) {
            $data[]=array('name'=>$testimonials->name,
                       'content'=>$testimonials->content,
                     );
        }
        $res=array(
                    'message'=>"success",
                    'status'=>200,
                    'data'=>$data
                    );
        echo json_encode($res);
    }
}

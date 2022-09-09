<?php

if (! defined('BASEPATH')) {
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
    public function scan_product()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('barcode', 'barcode', 'required|xss_clean|trim');
            $this->form_validation->set_rules('auth', 'auth', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $barcode=$this->input->post('barcode');
                $auth=$this->input->post('auth');
                $emp_check = $this->db->get_where('tbl_employee', array('is_active'=> 1,'authentication'=> $auth))->result();
                if (!empty($emp_check)) {
                    $this->db->select('*');
                    $this->db->from('tbl_type');
                    $this->db->where('barcode', $barcode);
                    $type_data= $this->db->get()->row();

                    $this->db->select('*');
                    $this->db->from('tbl_product');
                    $this->db->where('id', $type_data->product_id);
                    $pro_data= $this->db->get()->row();


                    $this->db->select('*');
                    $this->db->from('tbl_colour');
                    $this->db->where('id', $type_data->colour_id);
                    $colour_data= $this->db->get()->row();


                    $this->db->select('*');
                    $this->db->from('tbl_size');
                    $this->db->where('id', $type_data->size_id);
                    $size_data= $this->db->get()->row();


                    $data_product=array('type_id'=>$type_data->id,
                               'product_id'=>$pro_data->id,
                               'product_name'=>$pro_data->name,
                                                            'size_name'=>$size_data->name,
                                                            'colour_name'=>$colour_data->colour_name,
                              'image'=>base_url().$type_data->image,
                               'mrp'=>$type_data->retailer_mrp,
                                                             'sp'=>$type_data->retailer_spgst,

                               // 'image2'=>base_url().$pro_data->imagetwo,
                               // 'image3'=>base_url().$pro_data->imagethree,
                               // 'image4'=>base_url().$pro_data->imagefour,

                             );
                    $res=array(
                                                            'message'=>"success",
                                                            'status'=>200,
                                                            'data'=>$data_product
                                                        );
                    echo json_encode($res);
                } else {
                    $res=array(
                                                         'message'=>'Permission Denied!',
                                                         'status'=>201

                                                        );
                    echo json_encode($res);
                }
            } else {
                $res=array(
                 'message'=>validation_errors(),
                 'status'=>201

               );
                echo json_encode($res);
            }
        } else {
            $res=array(
               'message'=>'please insert data',
               'status'=>201

             );
            echo json_encode($res);
        }
    }



    public function add_to_cart()
    {

			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->helper('security');
			if ($this->input->post()) {
					$this->form_validation->set_rules('auth', 'auth', 'required|xss_clean|trim');
					$this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
					$this->form_validation->set_rules('type_id', 'type_id', 'required|xss_clean|trim');
					$this->form_validation->set_rules('quantity', 'quantity', 'required|xss_clean|trim');

					if ($this->form_validation->run()== true) {
							$auth=$this->input->post('auth');
							$product_id=$this->input->post('product_id');
							$type_id=$this->input->post('type_id');
							$quantity=$this->input->post('quantity');
							$emp_data = $this->db->get_where('tbl_employee', array('is_active'=> 1,'authentication'=> $auth))->result();

							if (!empty($emp_data)) {
								$cart_data = $this->db->get_where('tbl_cart2', array('employee_id'=> $emp_data[0]->id,'product_id'=>$product_id,'type_id'=>$type_id))->result();
								if(empty($cart_data)){
									$type_data = $this->db->get_where('tbl_type', array('id'=> $type_id))->result();
									if($type_data[0]->inventory >= $quantity){
										date_default_timezone_set("Asia/Calcutta");
										$cur_date=date("Y-m-d H:i:s");
										$data_insert = array('employee_id'=>$emp_data[0]->id,
															'product_id'=>$product_id,
															'type_id'=>$type_id,
															'quantity'=>$quantity,
															'date'=>$cur_date

															);
										$last_id=$this->base_model->insert_table("tbl_cart2",$data_insert,1) ;
										if(!empty($last_id)){
											$res = array('message'=>"Success!",
											'status'=>200
											);

											echo json_encode($res);
										}else{
											$res = array('message'=>"Some error occurred!",
							'status'=>201
							);

											echo json_encode($res);
										}


									}else{
										$res = array('message'=>"Product is out of stock!",
						'status'=>201
						);

										echo json_encode($res);
									}


								}else{
									$res = array('message'=>"Product is already in your cart!",
					'status'=>201
					);

									echo json_encode($res);
								}


							}else{
								$res = array('message'=>"Permission Denied!",
				'status'=>201
				);

								echo json_encode($res);
							}
							} else {

									$res = array('message'=>validation_errors(),
			'status'=>201
			);

									echo json_encode($res);
							}
					} else {
							$res = array('message'=>"Please insert some data, No data available",
			'status'=>201
			);

							echo json_encode($res);
					}


}


    public function employee_login()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('password', 'password', 'required|xss_clean|trim');

            if ($this->form_validation->run()== true) {
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $emp_data = $this->db->get_where('tbl_employee', array('is_active'=> 1,'email'=> $email))->result();

                if (!empty($emp_data)) {
                    // echo $emp_data->pass; die();
                    if ($emp_data[0]->pass==md5($password)) {
                        $auth =bin2hex(random_bytes(15));// create auth
                        $data_update = array('authentication'=>$auth,
                );
                        $this->db->where('id', $emp_data[0]->id);
                        $zapak=$this->db->update('tbl_employee', $data_update);



                        $res = array('message'=>"success",
    'status'=>200,
    'data'=>$auth
    );

                        echo json_encode($res);
                    } else {
                        $res = array('message'=>"Wrong Password",
    'status'=>201
    );

                        echo json_encode($res);
                    }
                } else {
                    $res = array('message'=>"Employee is not registered",
    'status'=>201
    );

                    echo json_encode($res);
                }
            } else {

    //header('Access-Control-Allow-Origin: *');
                $res = array('message'=>validation_errors(),
    'status'=>201
    );

                echo json_encode($res);
            }
        } else {
            $res = array('message'=>"Please insert some data, No data available",
    'status'=>201
    );

            echo json_encode($res);
        }
    }


		public function view_cart()
		{

			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->helper('security');




				if ($this->input->post()) {
						$this->form_validation->set_rules('auth', 'auth', 'required|xss_clean|trim');
if ($this->form_validation->run()== true) {

						$auth=$this->input->post('auth');



						$emp_data = $this->db->get_where('tbl_employee', array('is_active'=> 1,'authentication'=> $auth))->result();


  if (!empty($emp_data)) {
			$cart_data = $this->db->get_where('tbl_cart2', array('employee_id'=> $emp_data[0]->id));
			$data_product=[];
			$subtotal = 0;
 $i=1; foreach($cart_data->result() as $cart) {
	 $total = 0;
	 $this->db->select('*');
	 $this->db->from('tbl_product');
	 $this->db->where('id', $cart->product_id);
	 $pro_data= $this->db->get()->row();
	 // echo $cart->product_id;
	 // print_r($pro_data);die();

	 $this->db->select('*');
	 $this->db->from('tbl_type');
	 $this->db->where('id', $cart->type_id);
	 $type_data= $this->db->get()->row();


	 $this->db->select('*');
	 $this->db->from('tbl_colour');
	 $this->db->where('id', $type_data->colour_id);
	 $colour_data= $this->db->get()->row();


	 $this->db->select('*');
	 $this->db->from('tbl_size');
	 $this->db->where('id', $type_data->size_id);
	 $size_data= $this->db->get()->row();

$total=$type_data->retailer_spgst * $cart->quantity;
	 $data_product[]=array('type_id'=>$cart->type_id,
							'product_id'=>$cart->product_id,
							'product_name'=>$pro_data->name,
																					 'size_name'=>$size_data->name,
																					 'colour_name'=>$colour_data->colour_name,
						 'image'=>base_url().$type_data->image,
							'mrp'=>$type_data->retailer_mrp,
							'sp'=>$type_data->retailer_spgst,
							'qty'=>$cart->quantity,
							'total'=>$total,
						);

						$subtotal = $subtotal + $total;

}
$res=array(
																				'message'=>"success",
																				'status'=>200,
																				'data'=>$data_product,
																				'subtotal'=>$subtotal,
																		);
echo json_encode($res);


}else{
	$res = array('message'=>"Permission Denied!",
'status'=>201
);

	echo json_encode($res);
}
}
 else {

//header('Access-Control-Allow-Origin: *');
$res = array('message'=>validation_errors(),
'status'=>201
);

echo json_encode($res);
}
	}
	else {
			$res = array('message'=>"Please insert some data, No data available",
'status'=>201
);

			echo json_encode($res);
	}
}


public function percentage()
{

  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->helper('security');




    if ($this->input->post()) {
        $this->form_validation->set_rules('auth', 'auth', 'required|xss_clean|trim');
if ($this->form_validation->run()== true) {

        $auth=$this->input->post('auth');
$percentage=$this->input->post('percentage');


        $emp_data = $this->db->get_where('tbl_employee', array('is_active'=> 1,'authentication'=> $auth))->result();
if (!empty($emp_data)) {
			$percentage_data = $this->db->get_where('tbl_percentage')->result();
	$data_insert=[];
  $i=1; foreach($percentage_data as $percentage) {
          $data_insert[]=array('id'=>$percentage->id,
                'percentage'=>$percentage->percentage,
           );

}
$res=array(
  'message'=>"success",
  'status'=>200,
  'data'=>$data_insert,

);
echo json_encode($res);
           }else{
           	$res = array('message'=>"Permission Denied!",
           'status'=>201
           );

           	echo json_encode($res);
           }
           }
            else {

           //header('Access-Control-Allow-Origin: *');
           $res = array('message'=>validation_errors(),
           'status'=>201
           );

           echo json_encode($res);
           }

           	}
           	else {
           			$res = array('message'=>"Please insert some data, No data available",
           'status'=>201
           );

           			echo json_encode($res);
           	}
           }



   }

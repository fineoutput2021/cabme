<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Type extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //================================view_type=============================\\
    public function view_type($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_type');
            $this->db->where('product_id', $id);
            $this->db->order_by('id', 'desc');
            $data['type_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $id);
            $prodata= $this->db->get()->row();

            $data['subcategory_id'] = $prodata->subcategory_id;
            $data['productView'] = $prodata->product_view;


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/type/view_type');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //=============================add_type=============================\\
    public function add_type($product_id)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($product_id);
            $data['id']=$product_id;

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $id);
            $product_data = $this->db->get()->row();
            // $data['product_data'] = $product_data->id;
            $data['productName'] = $product_data->name;
            $data['productView'] = $product_data->product_view;

            $this->db->select('*');
            $this->db->from('tbl_product');
            $data['product_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_size');
            $this->db->where('is_active', 1);
            // $this->db->where('id', $usr);
            $data['size_data']= $this->db->get();


            $this->db->select('*');
            $this->db->from('tbl_colour');
            $this->db->where('is_active', 1);
            // $this->db->where('id', $usr);
            $data['colour_data']= $this->db->get();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/type/add_type');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==============================add_type_data=============================\\
    public function add_type_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('size_id', 'size_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('colour_id', 'colour_id', 'xss_clean|trim');
                // $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
                $this->form_validation->set_rules('mrp', 'mrp', 'xss_clean|trim');
                $this->form_validation->set_rules('sp', 'sp', 'xss_clean|trim');
                $this->form_validation->set_rules('gst', 'gst', 'xss_clean|trim');
                $this->form_validation->set_rules('spgst', 'spgst', 'xss_clean|trim');
                $this->form_validation->set_rules('re_mrp', 'mrp', 'xss_clean|trim');
                $this->form_validation->set_rules('re_sp', 'sp', 'xss_clean|trim');
                $this->form_validation->set_rules('re_gst', 'gst', 'xss_clean|trim');
                $this->form_validation->set_rules('re_spgst', 'spgst', 'xss_clean|trim');
                $this->form_validation->set_rules('reseller_min_qty', 'reseller_min_qty', 'xss_clean|trim');
                $this->form_validation->set_rules('inventory', 'inventory', 'required|xss_clean|trim');
                if (base64_decode($t)==1) {
                    $this->form_validation->set_rules('t_code', 't_code', 'required|xss_clean|trim');
                } else {
                    $this->form_validation->set_rules('t_code', 't_code', 'xss_clean|trim');
                }

                if ($this->form_validation->run()== true) {
                    $product_id=base64_decode($this->input->post('product_id'));
                    $size_id=$this->input->post('size_id');
                    $colour_id=$this->input->post('colour_id');
                    // $name=$this->input->post('name');
                    $mrp=$this->input->post('mrp');
                    $sp=$this->input->post('sp');
                    $gst=$this->input->post('gst');
                    $spgst=$this->input->post('spgst');
                    $re_mrp=$this->input->post('re_mrp');
                    $re_sp=$this->input->post('re_sp');
                    $re_gst=$this->input->post('re_gst');
                    $re_spgst=$this->input->post('re_spgst');
                    $reseller_price=$this->input->post('reseller_price');
                    $reseller_min_qty=$this->input->post('reseller_min_qty');
                    $inventory=$this->input->post('inventory');
                    $t_code=$this->input->post('t_code');

                    // echo $size_id;exit;


                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    //========================image_1 upload========================\\
                    $this->load->library('upload');
                    $img1='image';
                    $nnnn = '';

                    $file_check=($_FILES['image']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/type/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="type".date("Ymdhms");
                        $this->upload_config = array(
                                            'upload_path'   => $image_upload_folder,
                                            'file_name' => $new_file_name,
                                            'allowed_types' =>'jpg|jpeg|png',
                                            'max_size'      => 25000
                                    );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img1)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            // echo $upload_error;
                            $this->session->set_flashdata('emessage', $upload_error);
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/type/".$new_file_name.$file_info['file_ext'];
                            $nnnn=$videoNAmePath;
                        }
                    }

                    //========================image_2 upload========================\\
                    $this->load->library('upload');

                    $img2='image2';
                    $nnnn2 = '';

                    $file_check=($_FILES['image2']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/type/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="type2".date("Ymdhms");
                        $this->upload_config = array(
                              'upload_path'   => $image_upload_folder,
                              'file_name' => $new_file_name,
                              'allowed_types' =>'jpg|jpeg|png',
                              'max_size'      => 25000
                              );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img2)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            $this->session->set_flashdata('emessage', $upload_error);
                            //echo $upload_error;
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/type/".$new_file_name.$file_info['file_ext'];
                            $nnnn2=$videoNAmePath;

                            // echo json_encode($file_info);
                        }
                    }
                    //============================image_3 upload=======================\\
                    $this->load->library('upload');
                    $img3='image3';
                    $nnnn3="";

                    $file_check=($_FILES['image3']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/type/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="type3".date("Ymdhms");
                        $this->upload_config = array(
                              'upload_path'   => $image_upload_folder,
                              'file_name' => $new_file_name,
                              'allowed_types' =>'jpg|jpeg|png',
                              'max_size'      => 25000
                              );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img3)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            $this->session->set_flashdata('emessage', $upload_error);
                            //echo $upload_error;
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/type/".$new_file_name.$file_info['file_ext'];
                            $nnnn3=$videoNAmePath;

                            // echo json_encode($file_info);
                        }
                    }
                    //=============================image_4 upload===============================\\
                    $this->load->library('upload');
                    $img4='image4';
                    $nnnn4="";

                    $file_check=($_FILES['image4']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/type/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="type4".date("Ymdhms");
                        $this->upload_config = array(
                              'upload_path'   => $image_upload_folder,
                              'file_name' => $new_file_name,
                              'allowed_types' =>'jpg|jpeg|png',
                              'max_size'      => 25000
                              );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img4)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            $this->session->set_flashdata('emessage', $upload_error);
                            //echo $upload_error;
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/type/".$new_file_name.$file_info['file_ext'];
                            $nnnn4=$videoNAmePath;

                            // echo json_encode($file_info);
                        }
                    }
                    //==========================image_5 upload=======================\\
                    $this->load->library('upload');
                    $img5='image5';
                    $nnnn5="";

                    $file_check=($_FILES['image5']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/type/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="type5".date("Ymdhms");
                        $this->upload_config = array(
                              'upload_path'   => $image_upload_folder,
                              'file_name' => $new_file_name,
                              'allowed_types' =>'jpg|jpeg|png',
                              'max_size'      => 25000
                              );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img5)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            $this->session->set_flashdata('emessage', $upload_error);
                            //echo $upload_error;
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/type/".$new_file_name.$file_info['file_ext'];
                            $nnnn5=$videoNAmePath;
                        }
                    }
                    //==========================image_6 upload=======================\\
                    $this->load->library('upload');
                    $img6='image6';
                    $nnnn6="";

                    $file_check=($_FILES['image6']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/type/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="type6".date("Ymdhms");
                        $this->upload_config = array(
                              'upload_path'   => $image_upload_folder,
                              'file_name' => $new_file_name,
                              'allowed_types' =>'jpg|jpeg|png',
                              'max_size'      => 25000
                              );
                        $this->upload->initialize($this->upload_config);
                        if (!$this->upload->do_upload($img6)) {
                            $upload_error = $this->upload->display_errors();
                            // echo json_encode($upload_error);
                            $this->session->set_flashdata('emessage', $upload_error);
                            //echo $upload_error;
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/type/".$new_file_name.$file_info['file_ext'];
                            $nnnn6=$videoNAmePath;
                        }
                    }



                    $typ=base64_decode($t);
                    if ($typ==1) {
                        //----------generate barcode-------
                        $this->db->select('*');
                        $this->db->from('tbl_type');
                        $this->db->where('t_code', $t_code);
                        $t_data= $this->db->get()->row();
                        if (empty($t_data)) {
                            $code = $t_code;

                            //load library
                            $this->load->library('zend');
                            //load in folder Zend
                            $this->zend->load('Zend/Barcode');
                            //generate barcode
                            $this->load->library('upload');
                            // $imageResource = Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
                            $imageResource = Zend_Barcode::factory('Code128', 'image', array('text'=>$code.'|Rs'.$mrp), array())->draw();
                            $path = $code.date("Ymdhms");
                            imagepng($imageResource, 'assets/uploads/barcodes/'.$path.'.png');
                            $image = 'assets/uploads/barcodes/'.$path.'.png';

                            $imageResource2 = Zend_Barcode::factory('Code128', 'image', array('text'=>$code), array())->draw();
                            $path2 = $code.date("Ymdhms");
                            imagepng($imageResource2, 'assets/uploads/barcodes/'.$path2.'.png');
                            $image2 = 'assets/uploads/barcodes/'.$path2.'.png';

                            $this->db->select('*');
                            $this->db->from('tbl_type');
                            $this->db->where('is_active', 1);
                            $this->db->where('product_id', $product_id);
                            $type_data = $this->db->count_all_results();
                            if ($type_data < 1) {
                                $data_update = array('is_active'=>1);
                                $this->db->where('id', $product_id);
                                $zapak=$this->db->update('tbl_product', $data_update);
                            }


                            $data_insert = array('product_id'=>$product_id,
                            'size_id'=>$size_id,
                            'colour_id'=>$colour_id,
                            // 'name'=>$name,
                            'image'=>$nnnn,
                            'image2'=>$nnnn2,
                            'image3'=>$nnnn3,
                            'image4'=>$nnnn4,
                            'image5'=>$nnnn5,
                            'image6'=>$nnnn6,
                            'retailer_mrp'=>$mrp,
                            'retailer_sp'=>$sp,
                            'retailer_gst'=>$gst,
                            'retailer_spgst' =>$spgst,
                            'reseller_mrp'=>$re_mrp,
                            'reseller_sp'=>$re_sp,
                            'reseller_gst'=>$re_gst,
                            'reseller_spgst' =>$re_spgst,
                            // 'reseller_price' =>$reseller_price,
                            'reseller_min_qty' =>$reseller_min_qty,
                            'inventory' =>$inventory,
                            'ip'=>$ip,
                            'added_by' =>$addedby,
                            'is_active' =>1,
                            'date'=>$cur_date,
                            't_code'=>$t_code,
                            'barcode'=>$code,
                            'barcode_image'=>$image,
                            'barcode_tag_image'=>$image2,

                            );





                            $last_id=$this->base_model->insert_table("tbl_type", $data_insert, 1) ;

                            if ($last_id!=0) {
                                $this->session->set_flashdata('smessage', 'Type inserted successfully');

                                redirect("dcadmin/Type/view_type/".base64_encode($product_id), "refresh");
                            } else {
                                $this->session->set_flashdata('emessage', 'Sorry error occurred');
                                redirect($_SERVER['HTTP_REFERER']);
                            }
                        } else {
                            $this->session->set_flashdata('emessage', 'This type code is already used');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        $this->db->select('*');
                        $this->db->from('tbl_type');
                        $this->db->where('id', $idw);
                        $pro_data= $this->db->get()->row();

                        //----------generate barcode-------
                        $this->load->library('zend');
                        $code = rand(10000, 9999999999);
                        //load in folder Zend
                        $this->zend->load('Zend/Barcode');
                        //generate barcode
                        $this->load->library('upload');
                        // $imageResource = Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
                        $imageResource = Zend_Barcode::factory('Code128', 'image', array('text'=>$pro_data->barcode.'|Rs'.$mrp), array())->draw();
                        $path = $code.date("Ymdhms");
                        imagepng($imageResource, 'assets/uploads/barcodes/'.$path.'.png');
                        $image = 'assets/uploads/barcodes/'.$path.'.png';

                        $imageResource2 = Zend_Barcode::factory('Code128', 'image', array('text'=>$pro_data->barcode), array())->draw();
                        $path2 = $code.date("Ymdhms");
                        imagepng($imageResource2, 'assets/uploads/barcodes/'.$path2.'.png');
                        $image2 = 'assets/uploads/barcodes/'.$path2.'.png';

                        if (empty($nnnn)) {
                            $nnnn=$pro_data->image;
                        }
                        if (empty($nnnn2)) {
                            $nnnn2=$pro_data->image2;
                        }
                        if (empty($nnnn3)) {
                            $nnnn3=$pro_data->image3;
                        }
                        if (empty($nnnn4)) {
                            $nnnn4=$pro_data->image4;
                        }
                        if (empty($nnnn5)) {
                            $nnnn5=$pro_data->image5;
                        }
                        if (empty($nnnn6)) {
                            $nnnn6=$pro_data->image6;
                        }
                        $data_insert = array(

                          'size_id'=>$size_id,
                          'colour_id'=>$colour_id,
                          'image'=>$nnnn,
                'image2'=>$nnnn2,
                'image3'=>$nnnn3,
                'image4'=>$nnnn4,
                'image5'=>$nnnn5,
                'image6'=>$nnnn6,
                'retailer_mrp'=>$mrp,
                'retailer_sp'=>$sp,
                'retailer_gst'=>$gst,
                'retailer_spgst' =>$spgst,
                'reseller_mrp'=>$re_mrp,
                'reseller_sp'=>$re_sp,
                'reseller_gst'=>$re_gst,
                'reseller_spgst' =>$re_spgst,
                  // 'reseller_price' =>$reseller_price,
                  'reseller_min_qty' =>$reseller_min_qty,
                  'inventory' =>$inventory,
                  'barcode_image'=>$image,
                  'barcode_tag_image'=>$image2,
                            );
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_type', $data_insert);

                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Type updated successfully');

                            redirect("dcadmin/Type/view_type/".base64_encode($product_id), "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                } else {
                    $this->session->set_flashdata('emessage', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('emessage', 'Please insert some data, No data available');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==========================update_type==========================\\
    public function update_type($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_size');
            $this->db->where('is_active', 1);
            $data['size_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_colour');
            $this->db->where('is_active', 1);
            $data['colour_data']= $this->db->get();

            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_type');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['type']=$dsa->row();

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $data['type']->product_id);
            $product_data = $this->db->get()->row();
            $data['productName'] = $product_data->name;
            $data['productView'] = $product_data->product_view;

            $this->db->select('*');
            $this->db->from('tbl_product');
            $data['product_data']= $this->db->get();
            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/type/update_type');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function delete_type($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);
            $id=base64_decode($idd);
            $this->db->select('*');
            $this->db->from('tbl_type');
            $this->db->where('id', $id);
            $type_data = $this->db->get()->row();

            if ($this->load->get_var('position')=="Super Admin") {
                $zapak=$this->db->delete('tbl_type', array('id' => $id));
                $zapak1=$this->db->delete('tbl_cart', array('type_id' => $id));
                $zapak2=$this->db->delete('tbl_wishlist', array('type_id' => $id));
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect("dcadmin/type/view_type/".base64_encode($type_data->product_id), "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            } else {
                $data['e']="Sorry You Don't Have Permission To Delete Anything.";
                // exit;
                $this->load->view('errors/error500admin', $data);
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }
    public function updatetypeStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);
            $this->db->select('*');
            $this->db->from('tbl_type');
            $this->db->where('id', $id);
            $type_data = $this->db->get()->row();

            if ($t=="active") {
                $data_update = array(
     'is_active'=>1

     );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_type', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                $zapak1=$this->db->delete('tbl_cart', array('type_id' => $id));
                $zapak1=$this->db->delete('tbl_wishlist', array('type_id' => $id));

                if ($zapak!=0) {
                    redirect("dcadmin/type/view_type/".base64_encode($type_data->product_id), "refresh");
                } else {
                    echo "Error";
                    exit;
                }
            }
            if ($t=="inactive") {
                $data_update = array(
      'is_active'=>0

      );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_type', $data_update);
                $this->session->set_flashdata('smessage', 'Data updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/type/view_type/".base64_encode($type_data->product_id), "refresh");
                } else {
                    $data['e']="Error occurred";
                    // exit;
                    $this->load->view('errors/error500admin', $data);
                }
            }
        } else {
            $this->load->view('admin/login/index');
        }
    }

    public function print_tag($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_type');
            $this->db->where('id', $id);
            $type_data= $this->db->get()->row();
            $data['type_data']=$type_data;

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $type_data->product_id);
            $p_data= $this->db->get()->row();
            $data['p_name'] = $p_data->name;

            $this->load->view('admin/type/print_tag', $data);
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=================================  IMPORT TYPE DATA FROM EXCEL =========================
    public function import_type_data()
    {
        $ip = $this->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $addedby=$this->session->userdata('admin_id');
        require_once APPPATH . "/third_party/PHPExcel.php"; //------ INCLUDE EXCEL
        //-----------UPLOAD FILE INTO SERVER --------
        $this->load->library('upload');
        $img1='uploadFile';
        $file_check=($_FILES['uploadFile']['error']);
        if ($file_check!=4) {
            $image_upload_folder = FCPATH . "assets/uploads/type/excel";
            if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
            }
            $new_file_name="type_excel".date("Ymdhms");
            $this->upload_config = array(
              'upload_path'   => $image_upload_folder,
              'file_name' => $new_file_name,
              'allowed_types' =>'xlsx|xls|csv',
              'max_size'      => 25000
              );
            $this->upload->initialize($this->upload_config);
            if (!$this->upload->do_upload($img1)) {
                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('emessage', $upload_error);
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $file_info = $this->upload->data();

                $videoNAmePath = "assets/uploads/type/excel/".$new_file_name.$file_info['file_ext'];
                $inputFileName=$videoNAmePath;
            }
        }
        // print_r($inputFileName);die();

        //-------- start excel read and insert into db
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $flag = true;
            $i=0;
            // print_r($allDataInSheet);die();
            foreach ($allDataInSheet as $value) {
                if ($flag) {
                    $flag =false;
                    continue;
                }
                //----- creating barcode ---------
                $code = $value['T'];
                $mrp = $value['N'];
                //load library
                $this->load->library('zend');
                //load in folder Zend
                $this->zend->load('Zend/Barcode');
                //generate barcode
                $this->load->library('upload');
                // $imageResource = Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
                $imageResource = Zend_Barcode::factory('Code128', 'image', array('text'=>$code.'|Rs'.$mrp), array())->draw();
                $path = $code.date("Ymdhms");
                imagepng($imageResource, 'assets/uploads/barcodes/'.$path.'.png');
                $image = 'assets/uploads/barcodes/'.$path.'.png';

                $imageResource2 = Zend_Barcode::factory('Code128', 'image', array('text'=>$code), array())->draw();
                $path2 = $code.date("Ymdhms");
                imagepng($imageResource2, 'assets/uploads/barcodes/'.$path2.'.png');
                $image2 = 'assets/uploads/barcodes/'.$path2.'.png';

                if (!empty($value['E'])) {
                    $image2 = $value['E'];
                } else {
                    $image2="";
                }
                if (!empty($value['F'])) {
                    $image3 = $value['F'];
                } else {
                    $image3="";
                }
                if (!empty($value['G'])) {
                    $image4 = $value['G'];
                } else {
                    $image4="";
                }
                if (!empty($value['H'])) {
                    $image5 = $value['H'];
                } else {
                    $image5="";
                }
                if (!empty($value['I'])) {
                    $image6 = $value['I'];
                } else {
                    $image6="";
                }

                //---- insert into db ------
                $data_insert = array('product_id'=>$value['A'],
                              'size_id'=>$value['B'],
                              'colour_id'=>$value['C'],
                              'image'=>$value['D'],
                              'image2' =>$image2,
                              'image3' =>$image3,
                              'image4' =>$image4,
                              'image5'=>$image5,
                              'image6'=>$image6,
                              'retailer_mrp'=>$value['J'],
                              'retailer_sp'=>$value['K'],
                              'retailer_gst'=>$value['L'],
                              'retailer_spgst'=>$value['M'],
                              'reseller_mrp'=>$value['N'],
                              'reseller_sp'=>$value['O'],
                              'reseller_gst'=>$value['P'],
                              'reseller_spgst'=>$value['Q'],
                              'reseller_min_qty'=>$value['R'],
                              'inventory'=>$value['S'],
                              't_code'=>$value['T'],
                              'barcode'=>$code,
                              'barcode_image'=>$image,
                              'barcode_tag_image'=>$image2,
                              'is_active'=>1,
                              'ip'=>$ip,
                              'added_by'=>$addedby,
                              'date'=>$cur_date
                              );
                $last_id=$this->base_model->insert_table("tbl_type", $data_insert, 1) ;
                $i++;
            }
            if ($last_id) {
                $this->session->set_flashdata('smessage', 'Data Uploaded Successfully!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('emessage', 'Some error occurred!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } catch (Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName, PATHINFO_BASENAME)
. '": ' .$e->getMessage());
        }
    }
}

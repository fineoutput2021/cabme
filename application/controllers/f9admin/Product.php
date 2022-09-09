<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Product extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }

    public function view_category()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $this->db->select('*');
            $this->db->from('tbl_category');
            $data['category_data']= $this->db->get();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/view_category');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }



    public function view_subcategory($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_subcategory');
            $this->db->where('category_id', $id);
            $data['subcategory_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $id);
            $category_data = $this->db->get()->row();
            $data['category_name'] = $category_data->name;


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/view_subcategory');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }




    //===========================view_product==========================\\
    public function view_product($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);
            $data['id']=$idd;

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('subcategory_id', $id);
            $data['product_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_subcategory');
            $this->db->where('id', $id);
            $subcategory_data = $this->db->get()->row();
            $data['subcategory_id'] = $subcategory_data->id;
            $data['subcategory_name'] = $subcategory_data->name;

            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $subcategory_data->category_id);
            $category = $this->db->get()->row();
            $data['category_id'] = $category->id;
            $data['category_name'] = $category->name;


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/view_product');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //==========================add_product==========================\\
    public function add_product($id, $id2)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $data['category_id']= $id;
            $data['subcategory_id']= $id2;
            $this->db->select('*');
            $this->db->from('tbl_category');
            $data['category_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_subcategory');
            $data['subcategory_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_filters');
            $this->db->where('is_active', 1);
            $data['filters_data']= $this->db->get();


            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/add_product');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //========================add_user_data=========================\\
    public function add_product_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                $this->form_validation->set_rules('category_id', 'category_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('subcategory_id', 'subcategory_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
                // $this->form_validation->set_rules('image1', 'image1', 'required|xss_clean|trim');
                $this->form_validation->set_rules('sku', 'sku', 'required|xss_clean|trim');
                $this->form_validation->set_rules('vendor_code', 'vendor_code', 'required|xss_clean|trim');
                $this->form_validation->set_rules('description', 'description', 'required|xss_clean|trim');
                $this->form_validation->set_rules('exclusive', 'exclusive', 'xss_clean|trim');
                $this->form_validation->set_rules('tags', 'tags', 'required|xss_clean|trim');
                $this->form_validation->set_rules('product_type', 'product_type', 'required|xss_clean|trim');
                $this->form_validation->set_rules('product_view', 'product_view', 'required|xss_clean|trim');
                $this->form_validation->set_rules('trending', 'trending', 'required|xss_clean|trim');
                $this->form_validation->set_rules('hsn_code', 'hsn_code', 'required|xss_clean|trim');
                $this->form_validation->set_rules('filter_arr[]', 'filter_arr', 'xss_clean|trim');



                if ($this->form_validation->run()== true) {
                    $name=$this->input->post('name');
                    $category_id=$this->input->post('category_id');
                    $subcategory_id=$this->input->post('subcategory_id');
                    $image1=$this->input->post('image1');
                    $description=$this->input->post('description');
                    $sku=$this->input->post('sku');
                    $exclusive=$this->input->post('exclusive');
                    $tags=$this->input->post('tags');
                    $vendor_code=$this->input->post('vendor_code');
                    $product_type=$this->input->post('product_type');
                    $product_view=$this->input->post('product_view');
                    $trending=$this->input->post('trending');
                    $hsn_code=$this->input->post('hsn_code');
                    $filter_arr=json_decode($this->input->post('filter_arr'));
                    // print_r($filter_arr[0]);die();
                    $length = count($filter_arr);
                    $attribute_arr=[];
                    $all_attribute_arr=[];
                    if (!empty($filter_arr)) {
                        for ($k=0; $k<$length;$k++) {
                            // echo $value;die();
                            $attributes=$this->input->post('attribute_'.$filter_arr[$k]);
                            array_push($attribute_arr, $attributes);
                            if (!empty($all_attribute_arr)) {
                                // print_r($attributes);exit;
                                if (!empty($attributes)) {
                                    $all_attribute_arr=array_merge($all_attribute_arr, $attributes);
                                }
                            } else {
                                $all_attribute_arr = $attributes;
                            }
                        }
                    }
                    // print_r(json_encode($all_attribute_arr));
                    // print_r(json_encode($attribute_arr));
                    // die();


                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    $pro = explode(" ", $name);
                    $url = implode("-", $pro);
                    //========================image_1 upload========================\\
                    $this->load->library('upload');
                    $image1="";
                    $img1='image1';

                    $file_check=($_FILES['image1']['error']);
                    if ($file_check!=4) {
                        $image_upload_folder = FCPATH . "assets/uploads/product/";
                        if (!file_exists($image_upload_folder)) {
                            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                        }
                        $new_file_name="product".date("Ymdhms");
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
                            $this->session->set_flashdata('emessage', $upload_error);
                            //echo $upload_error;
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            $file_info = $this->upload->data();

                            $videoNAmePath = "assets/uploads/product/".$new_file_name.$file_info['file_ext'];
                            $image1=$videoNAmePath;

                            // echo json_encode($file_info);
                        }
                    }
                    $cat_active = $this->db->get_where('tbl_category', array('id = ' => $category_id))->result();
                    $subcat_active = $this->db->get_where('tbl_subcategory', array('id = ' => $subcategory_id))->result();

                    $typ=base64_decode($t);
                    if ($typ==1) {
                        $data_insert = array('category_id'=>$category_id,
                    'subcategory_id'=>$subcategory_id,
                    'name'=>$name,
                    'image1'=>$image1,
                    'exclusive' =>$exclusive,
                    'description' =>$description,
                    'sku' =>$sku,
                    'vendor_code' =>$vendor_code,
                    'tags' =>$tags,
                    'product_type' =>$product_type,
                    'product_view' =>$product_view,
                    'hsn_code' =>$hsn_code,
                    'filter_ids' =>json_encode($filter_arr),
                    'filter_attributes' =>json_encode($attribute_arr),
                    'all_attributes' =>json_encode($all_attribute_arr),
                    'url' =>$url,
                    'added_by' =>$addedby,
                    'cat_active' =>$cat_active[0]->is_active,
                    'subcat_active' =>$subcat_active[0]->is_active,
                    'is_active' =>0,
                    'date'=>$cur_date

                    );

                        $last_id=$this->base_model->insert_table("tbl_product", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/Type/view_type/".base64_encode($last_id), "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        $this->db->select('*');
                        $this->db->from('tbl_product');
                        $this->db->where('id', $idw);
                        $pro_data= $this->db->get()->row();
                        if (empty($image1)) {
                            $image1=$pro_data->image1;
                        } 
                        $data_insert = array('category_id'=>$category_id,
                       'subcategory_id'=>$subcategory_id,
                       'name'=>$name,
                       'image1'=>$image1,
                       'exclusive' =>$exclusive,
                       'description' =>$description,
                       'sku' =>$sku,
                       'vendor_code' =>$vendor_code,
                       'tags' =>$tags,
                       'product_type' =>$product_type,
                       'product_view' =>$product_view,
                       'trending' =>$trending,
                       'hsn_code' =>$hsn_code,
                       'url' =>$url,
                       'filter_ids' =>json_encode($filter_arr),
                       'filter_attributes' =>json_encode($attribute_arr),
                       'all_attributes' =>json_encode($all_attribute_arr),

          );

                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_product', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');
                            redirect("dcadmin/product/view_product/".base64_encode($subcategory_id), "refresh");
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
    //======================update_product===================\\

    public function update_product($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $this->db->select('*');
            $this->db->from('tbl_category');
            //$this->db->where('id',$usr);
            $data['category_data']= $this->db->get();

            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['product']=$dsa->row();

            $this->db->select('*');
            $this->db->from('tbl_subcategory');
            $this->db->where('category_id', $data['product']->category_id);
            $data['subcategory_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('is_active', 1);
            $this->db->where('id', $id);
            $prodata= $this->db->get()->row();

            $data['subcategory_id'] = $prodata->subcategory_id;

            $this->db->select('*');
            $this->db->from('tbl_filters');
            $this->db->where('is_active', 1);
            $data['filters_data']= $this->db->get();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/update_product');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //===========================delete_product========================\\
    public function delete_product($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');
            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $zapak1=$this->db->delete('tbl_cart', array('product_id' => $id));
                $zapak1=$this->db->delete('tbl_wishlist', array('product_id' => $id));
                $zapak=$this->db->delete('tbl_product', array('id' => $id));
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                    redirect($_SERVER['HTTP_REFERER']);
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
    //==================update_product_status=====================\\
    public function updateproductStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $id=base64_decode($idd);



            if ($t=="active") {
                $this->db->select('*');
                $this->db->from('tbl_type');
                $this->db->where('is_active', 1);
                $this->db->where('product_id', $id);
                $type_data = $this->db->get()->row();
                if (!empty($type_data)) {
                    $data_update = array('is_active'=>1);
                    $this->session->set_flashdata('smessage', 'Status updated successfully');
                } else {
                    $data_update = array('is_active'=>0);
                    $this->session->set_flashdata('emessage', 'Active type does not exist!');
                }
                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_product', $data_update);
                $zapak1=$this->db->delete('tbl_cart', array('product_id' => $id));
                $zapak2=$this->db->delete('tbl_wishlist', array('product_id' => $id));
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                if ($zapak!=0) {
                    redirect($_SERVER['HTTP_REFERER']);
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
                $zapak=$this->db->update('tbl_product', $data_update);
                $zapak1=$this->db->delete('tbl_cart', array('product_id' => $id));
                $zapak2=$this->db->delete('tbl_wishlist', array('product_id' => $id));
                $this->session->set_flashdata('smessage', 'Data updated successfully');
                if ($zapak!=0) {
                    redirect($_SERVER['HTTP_REFERER']);
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

    //============== category subcategory =============
    public function get_subcategory()
    {
        $cat_id=$_GET['cat_id'];
        $this->db->select('*');
        $this->db->from('tbl_subcategory');
        $this->db->where('category_id', $cat_id);
        $subcat_data= $this->db->get();
        $res=[];
        foreach ($subcat_data->result() as $data) {
            $res[]= array(
          'id'=>$data->id,
          'name'=>$data->name,
        );
        }
        echo json_encode($res);
    }
    //============== Buy With It =============

    public function view_buy_with_it($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $id=base64_decode($idd);
            $data['id']=$idd;

            $this->db->select('*');
            $this->db->from('tbl_product');
            // $this->db->where('is_active', 1);
            // $this->db->where('id', $id);
            $data['product_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_product');
            // $this->db->where('is_active', 1);
            $this->db->where('id', $id);
            $product_data= $this->db->get()->row();

            $this->db->select('*');
            $this->db->from('tbl_subcategory');
            $this->db->where('id', $product_data->subcategory_id);
            $subcategory_data = $this->db->get()->row();
            $data['subcategory_id'] = $subcategory_data->id;
            $data['subcategory_name'] = $subcategory_data->name;

            $this->db->select('*');
            $this->db->from('tbl_category');
            $this->db->where('id', $subcategory_data->category_id);
            $category = $this->db->get()->row();
            $data['category_name'] = $category->name;
            $data['product'] = $product_data;



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/view_buy_with_it');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //============== add Buy With It =============

    public function add_buy_with_it($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id !=', $id);
            $data['product_data']= $this->db->get();

            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $id);
            $data['pro_data']= $this->db->get()->row();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/product/add_buy_with_it');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //============== add Buy With It Data =============

    public function add_buy_with_it_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // $this->form_validation->set_rules('user_id', 'user_id', 'xss_clean|trim');
                $this->form_validation->set_rules('product_id', 'product_id', 'required|xss_clean|trim');
                $this->form_validation->set_rules('pro_id', 'pro_id', 'required|xss_clean|trim');

                if ($this->form_validation->run()== true) {
                    // $user_id=$this->input->post('user_id');
                    $pro_id=$this->input->post('pro_id');
                    $product_id=$this->input->post('product_id');
                    $id=base64_decode($pro_id);
                    // print_r([$product_id,2]);die();
                    // print_r($product_id);die();

                    $this->db->select('*');
                    $this->db->from('tbl_product');
                    $this->db->where('id', $id);
                    $pro_data= $this->db->get()->row();
                    if (!empty($pro_data->buy_with)) {
                        $buy_arr=json_decode($pro_data->buy_with);
                        array_push($buy_arr, $product_id);
                        $buy_arr = json_encode($buy_arr);
                    } else {
                        $buy_arr = json_encode([$product_id]);
                    }

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');

                    $data_insert = array('buy_with'=>$buy_arr,
            // 'user_id'=>$user_id,
            'added_by' =>$addedby,
            'is_active' =>1,
            'date'=>$cur_date
  );
                    // die();
                    $this->db->where('id', $id);
                    $last_id=$this->db->update('tbl_product', $data_insert);
                    if ($last_id!=0) {
                        $this->session->set_flashdata('smessage', 'Data inserted successfully');
                        redirect("dcadmin/Product/view_buy_with_it/".$pro_id, "refresh");
                    } else {
                        $this->session->set_flashdata('emessage', 'Sorry error occurred');
                        redirect($_SERVER['HTTP_REFERER']);
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

    ///================================= Remove buy with ===========================
    public function remove_buy_with($pro_id, $buy_id)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $pro_id=base64_decode($pro_id);
            $buy_id=base64_decode($buy_id);
            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id', $pro_id);
            $pro_data= $this->db->get()->row();
            $buy_arr = json_decode($pro_data->buy_with);
            $length = count($buy_arr);
            $buy_arr2 = [];
            // echo$length;die();
            for ($j=0; $j<$length;$j++) {
                if ($buy_id != $buy_arr[$j]) {
                    array_push($buy_arr2, $buy_arr[$j]);
                }
            }

            // print_r($buy_arr2);die();
            $data_update = array('buy_with'=>json_encode($buy_arr2),
                      );
            $this->db->where('id', $pro_id);
            $zapak=$this->db->update('tbl_product', $data_update);
            if (!empty($zapak)) {
                $this->session->set_flashdata('smessage', 'Item removed successfully!');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('emessage', 'Some error occurred!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //=================================  IMPORT PRODUCT DATA FROM EXCEL =========================
    public function import_pro_data()
    {
        require_once APPPATH . "/third_party/PHPExcel.php"; //------ INCLUDE EXCEL
        //-----------UPLOAD FILE INTO SERVER --------
        $ip = $this->input->ip_address();
        date_default_timezone_set("Asia/Calcutta");
        $cur_date=date("Y-m-d H:i:s");
        $addedby=$this->session->userdata('admin_id');
        $this->load->library('upload');
        $img1='uploadFile';
        $file_check=($_FILES['uploadFile']['error']);
        if ($file_check!=4) {
            $image_upload_folder = FCPATH . "assets/uploads/product/excel";
            if (!file_exists($image_upload_folder)) {
                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
            }
            $new_file_name="product_excel".date("Ymdhms");
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

                $videoNAmePath = "assets/uploads/product/excel/".$new_file_name.$file_info['file_ext'];
                $inputFileName=$videoNAmePath;
            }
        }
        //-------- start excel read and insert into db
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $flag = true;
            $i=0;
            foreach ($allDataInSheet as $value) {
                if ($flag) {
                    $flag =false;
                    continue;
                }
                $pro = explode(" ", $value['C']);
                $url = implode("-", $pro);
                $data_insert = array('category_id'=>$value['A'],
                              'subcategory_id'=>$value['B'],
                              'name'=>$value['C'],
                              'image1'=>$value['D'],
                              'sku' =>$value['E'],
                              'hsn_code' =>$value['F'],
                              'vendor_code' =>$value['G'],
                              'product_type'=>$value['H'],
                              'product_view'=>$value['I'],
                              'description'=>$value['J'],
                              'exclusive'=>$value['K'],
                              'tags'=>$value['L'],
                              'trending'=>$value['M'],
                              'url'=>$url,
                              'is_active'=>1,
                              'ip'=>$ip,
                              'added_by'=>$addedby,
                              'date'=>$cur_date
                              );
                $last_id=$this->base_model->insert_table("tbl_product", $data_insert, 1) ;
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

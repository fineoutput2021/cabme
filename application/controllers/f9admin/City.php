  <?php
  if (! defined('BASEPATH')) {
      exit('No direct script access allowed');
  }
  ob_start();
  require_once(APPPATH . 'core/CI_finecontrol.php');
  class City extends CI_finecontrol
  {
      public function __construct()
      {
          parent::__construct();
          $this->load->model("login_model");
          $this->load->model("admin/base_model");
          $this->load->library('user_agent');
          $this->load->library('upload');
      }
      //==================================VIEW CITIES======================================
      public function view_cities()
      {
          if (!empty($this->session->userdata('admin_data'))) {
              $this->db->select('*');
              $this->db->from('tbl_cities');
              //$this->db->where('id',$usr);
              $data['City_data']= $this->db->get();
              $this->load->view('admin/common/header_view', $data);
              $this->load->view('admin/cities/view_cities');
              $this->load->view('admin/common/footer_view');
          } else {
              redirect("login/admin_login", "refresh");
          }
      }
      //==================================ADD CITIES======================================
      public function add_cities()
      {
          if (!empty($this->session->userdata('admin_data'))) {
              $data['user_name']=$this->load->get_var('user_name');
              $this->db->select('*');
              $this->db->from('tbl_cities');
              $this->db->where('is_active', 1);
              $data['City']= $this->db->get();
              $this->load->view('admin/common/header_view', $data);
              $this->load->view('admin/cities/add_cities');
              $this->load->view('admin/common/footer_view');
          } else {
              redirect("login/admin_login", "refresh");
          }
      }
      //==================================ADD CITIES DATA======================================
      public function add_cities_data($t, $iw="")
      {
          if (!empty($this->session->userdata('admin_data'))) {
              $this->load->helper(array('form', 'url'));
              $this->load->library('form_validation');
              $this->load->helper('security');
              if ($this->input->post()) {
                  // print_r($this->input->post());
                  // exit;
                  $this->form_validation->set_rules('name', 'name', 'required|xss_clean|trim');
                  $this->form_validation->set_rules('city_type', 'city_type', 'required|xss_clean|trim');
                  // $this->form_validation->set_rules('address', 'address ','|xss_clean|trim');
                  if ($this->form_validation->run()== true) {
                      $name=$this->input->post('name');
                      $city_type=$this->input->post('city_type');
                      $ip = $this->input->ip_address();
                      date_default_timezone_set("Asia/Calcutta");
                      $cur_date=date("Y-m-d H:i:s");
                      $addedby=$this->session->userdata('admin_id');
                      $image="";
                      $img1='photo';
                      $file_check=($_FILES['photo']['error']);
                      if ($file_check!=4) {
                          $image_upload_folder = FCPATH . "assets/uploads/cities/";
                          if (!file_exists($image_upload_folder)) {
                              mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                          }
                          $new_file_name="category".date("Ymdhms");
                          $this->upload_config = array(
                                    'upload_path'   => $image_upload_folder,
                                    'file_name' => $new_file_name,
                                    'allowed_types' =>'jpg|jpeg|png',
                                    'max_size'      => 25000
                            );
                          $this->upload->initialize($this->upload_config);
                          if (!$this->upload->do_upload($img1)) {
                              $upload_error = $this->upload->display_errors();
                              $this->session->set_flashdata('emessage', $upload_error);
                              redirect($_SERVER['HTTP_REFERER']);
                          } else {
                              $file_info = $this->upload->data();
                              $image = "assets/uploads/cities/".$new_file_name.$file_info['file_ext'];
                          }
                      }
                      $typ=base64_decode($t);
                      if ($typ==1) {
                          $data_insert = array(
  'name'=>$name,
  'photo'=>$image,
  'city_type'=>$city_type,
  'is_active' =>1,
  // 'date'=>$cur_date
  );
                          $last_id=$this->base_model->insert_table("tbl_cities", $data_insert, 1) ;
                      }
                      if ($typ==2) {
                          $idw=base64_decode($iw);
                          $this->db->select('*');
                          $this->db->from('tbl_cities');
                          $this->db->where('id', $idw);
                          $damm= $this->db->get()->row();
                          if (empty($image)) {
                              $image=$damm->photo;
                          }
                          //    foreach($damm->result() as $da) {
                          //      $uid=$da->id;
                          // if($uid==$idw)
                          // {
                          //
                          //  }
                          // else{
                          //    echo "Multiple Entry of Same Name";
                          //       exit;
                          //  }
                          //     }
                          $data_insert = array(
  'name'=>$name,
  'photo'=>$image,
  'city_type'=>$city_type,
  );
                          $this->db->where('id', $idw);
                          $last_id=$this->db->update('tbl_cities', $data_insert);
                      }
                      if ($last_id!=0) {
                          $this->session->set_flashdata('smessage', 'Data inserted successfully');
                          redirect("dcadmin/City/view_cities", "refresh");
                      } else {
                          $this->session->set_flashdata('emessage', 'Sorry error occured');
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
      //==================================UPDATE CITIES======================================
      public function update_cities($idd)
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
              $this->db->from('tbl_cities');
              $this->db->where('id', $id);
              $dsa= $this->db->get();
              $data['City']=$dsa->row();
              $this->load->view('admin/common/header_view', $data);
              $this->load->view('admin/cities/update_cities');
              $this->load->view('admin/common/footer_view');
          } else {
              redirect("login/admin_login", "refresh");
          }
      }
      //==================================DELETE CITIES======================================
      public function delete_cities($idd)
      {
          if (!empty($this->session->userdata('admin_data'))) {
              $data['user_name']=$this->load->get_var('user_name');
              $id=base64_decode($idd);
              if ($this->load->get_var('position')=="Super Admin") {
                  $zapak=$this->db->delete('tbl_cities', array('id' => $id));
                  if ($zapak!=0) {
                      redirect("dcadmin/City/view_cities", "refresh");
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
      //==================================STATUS CITIES======================================
      public function updatecitiesStatus($idd, $t)
      {
          if (!empty($this->session->userdata('admin_data'))) {
              $data['user_name']=$this->load->get_var('user_name');
              // echo SITE_NAME;
              // echo $this->session->userdata('image');
              // echo $this->session->userdata('position');
              // exit;
              $id=base64_decode($idd);
              if ($t=="active") {
                  $data_update = array(
  'is_active'=>1
  );
                  $this->db->where('id', $id);
                  $zapak=$this->db->update('tbl_cities', $data_update);
                  if ($zapak!=0) {
                      redirect("dcadmin/City/view_cities", "refresh");
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
                  $zapak=$this->db->update('tbl_cities', $data_update);
                  if ($zapak!=0) {
                      redirect("dcadmin/City/view_cities", "refresh");
                  } else {
                      $data['e']="Error Occured";
                      // exit;
                      $this->load->view('errors/error500admin', $data);
                  }
              }
          } else {
              $this->load->view('admin/login/index');
          }
      }
  }
  //==================================END CITIES======================================

<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once(APPPATH . 'core/CI_finecontrol.php');
class Banner extends CI_finecontrol
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->model("admin/base_model");
        $this->load->library('user_agent');
    }
    //========================view_banner======================\\
    public function view_banner()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            $this->db->select('*');
            $this->db->from('tbl_banner');
            //$this->db->where('id',$usr);
            $data['banner_data']= $this->db->get();



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/banner/view_banner');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    //===================add_banner===================\\
    public function add_banner()
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');



            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/banner/add_banner');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }
    public function add_banner_data($t, $iw="")
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->helper('security');
            if ($this->input->post()) {
                // print_r($this->input->post());
                // exit;
                $this->form_validation->set_rules('link', 'link', 'xss_clean|trim');
                // $this->form_validation->set_rules('link2', 'link2', 'required|xss_clean|trim');

                if ($this->form_validation->run()== true) {
                    $link=$this->input->post('link');
                    // $link2=$this->input->post('link2');

                    $ip = $this->input->ip_address();
                    date_default_timezone_set("Asia/Calcutta");
                    $cur_date=date("Y-m-d H:i:s");

                    $addedby=$this->session->userdata('admin_id');
                    $this->load->library('upload');
        //============================image_upload==========================\\
                    $image="";
                    $img1='image';


                    $typ=base64_decode($t);
                    if ($typ==1) {
                      $file_check=($_FILES['image']['error']);
                      if ($file_check!=4) {
                          $image_upload_folder = FCPATH . "assets/uploads/banner/";
                          if (!file_exists($image_upload_folder)) {
                              mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                          }
                          $new_file_name="banner".date("Ymdhms");
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
                              redirect($_SERVER['HTTP_REFERER']);
                          } else {
                              $file_info = $this->upload->data();

                              $videoNAmePath = "assets/uploads/banner/".$new_file_name.$file_info['file_ext'];
                              $image=$videoNAmePath;
                              // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                              // echo json_encode($file_info);
                          }
                      }



                        $data_insert = array(
                                                        'image'=>$image,
                                                        // 'image2'=>$image2,
                                                    'link'=>$link,
                                                    // 'link2'=>$link2,
                                                    'ip' =>$ip,
                                                    'added_by' =>$addedby,
                                                    'is_active' =>1,
                                                    'date'=>$cur_date

                                                    );





                        $last_id=$this->base_model->insert_table("tbl_banner", $data_insert, 1) ;
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data inserted successfully');

                            redirect("dcadmin/banner/view_banner", "refresh");
                        } else {
                            $this->session->set_flashdata('emessage', 'Sorry error occurred');
                            redirect($_SERVER['HTTP_REFERER']);
                        }

                    }
                    if ($typ==2) {
                        $idw=base64_decode($iw);
                        $file_check=($_FILES['image']['error']);
                        if(!empty($_FILES['image']['name'])){
                        if ($file_check!=4) {
                            $image_upload_folder = FCPATH . "assets/uploads/banner/";
                            if (!file_exists($image_upload_folder)) {
                                mkdir($image_upload_folder, DIR_WRITE_MODE, true);
                            }
                            $new_file_name="banner".date("Ymdhms");
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

                                $videoNAmePath = "assets/uploads/banner/".$new_file_name.$file_info['file_ext'];
                                $image=$videoNAmePath;
                                // $this->step6_model->updateappIconImage($imageNAmePath,$appInfoId);
                                // echo json_encode($file_info);
                            }
                        }
                      }




                                  $this->db->select('*');
                      $this->db->from('tbl_banner');
                      $this->db->where('id',$idw);
                      $slider_data= $this->db->get()->row();
                      if (empty($image)) {
                        $image= $slider_data->image;
                      }

                        if (!empty($image)) {
                            $data_insert = array('link'=>$link,
                            // 'link2'=>$link2,
                            'image'=>$image,
                            // 'image2'=>$image2,

                                                                     );
                        } else {
                            $data_insert = array(
                              'link'=>$link,
                              // 'link2'=>$link2,
                                     );
                        }

// die();
                        $this->db->where('id', $idw);
                        $last_id=$this->db->update('tbl_banner', $data_insert);
                        if ($last_id!=0) {
                            $this->session->set_flashdata('smessage', 'Data updated successfully');
                            redirect("dcadmin/Banner/view_banner", "refresh");
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


    //======================update_banner===================\\

    public function update_banner($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);
            $data['id']=$idd;
            $this->db->select('*');
            $this->db->from('tbl_banner');
            $this->db->where('id', $id);
            $dsa= $this->db->get();
            $data['banner']=$dsa->row();

            $this->load->view('admin/common/header_view', $data);
            $this->load->view('admin/banner/update_banner');
            $this->load->view('admin/common/footer_view');
        } else {
            redirect("login/admin_login", "refresh");
        }
    }

    //======================delete_banner===================\\

    public function delete_banner($idd)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');

            // echo SITE_NAME;
            // echo $this->session->userdata('image');
            // echo $this->session->userdata('position');
            // exit;
            $id=base64_decode($idd);

            if ($this->load->get_var('position')=="Super Admin") {
                $this->db->select('image');
                $this->db->from('tbl_banner');
                $this->db->where('id', $id);
                $dsa= $this->db->get();
                $da=$dsa->row();
                // $img=$da->image;

                $zapak=$this->db->delete('tbl_banner', array('id' => $id));
                if ($zapak!=0) {
                    $this->session->set_flashdata('smessage', 'Data deleted successfully');
                                      redirect("dcadmin/banner/view_banner", "refresh");
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

    //==================update_banner status=====================\\
    public function updatebannerStatus($idd, $t)
    {
        if (!empty($this->session->userdata('admin_data'))) {
            $data['user_name']=$this->load->get_var('user_name');


            $id=base64_decode($idd);

            if ($t=="active") {
                $data_update = array(
                              'is_active'=>1

                              );

                $this->db->where('id', $id);
                $zapak=$this->db->update('tbl_banner', $data_update);
                $this->session->set_flashdata('smessage', 'Status updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/banner/view_banner", "refresh");
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
                $zapak=$this->db->update('tbl_banner', $data_update);
                $this->session->set_flashdata('smessage', 'Status updated successfully');

                if ($zapak!=0) {
                    redirect("dcadmin/banner/view_banner", "refresh");
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
}

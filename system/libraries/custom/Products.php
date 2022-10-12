<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_Products
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->model("admin/login_model");
        $this->CI->load->model("admin/base_model");
        $this->CI->load->library('pagination');
    }


    //============================================= GET ALL PRODUCTS ====================================================
    public function all_products($url="", $sort="", $page_index="")
    {
        // echo $sort;die();
        $tbl_pro = "tbl_product";
        //------ checks for category wise data -------------
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_category');
        $this->CI->db->where('url', $url);
        $cat_data= $this->CI->db->get()->row();

        //------ checks for subcategory wise data -------------
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_subcategory');
        $this->CI->db->where('url', $url);
        $sub_data= $this->CI->db->get()->row();

        $category_name = '';
        $subcategory_name = '';
        if (!empty($cat_data)) {//-------fetch data by category
            $id= $cat_data->id;
            $category_name = $cat_data->name;
            $subcategory_name = 'All Products';
            $t=1;
        } else {//-------fetch data by subcategory
            $id= $sub_data->id;
            $t=2;
            $cat_data = $this->CI->db->get_where('tbl_category', array('id = ' => $sub_data->category_id))->result();
            if (!empty($cat_data)) {
                $category_name = $cat_data[0]->name;
            }
            $subcategory_name = $sub_data->name;
        }
        //--------- Count to total number of rows ---------------
        $this->CI->db->select('*');
        $this->CI->db->from($tbl_pro);
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $this->CI->db->where('product_view != ', 1);
            } else {
                $this->CI->db->where('product_view != ', 2);
            }
        }
        //-------fetch data by category
        if ($t==1) {
            $this->CI->db->where('category_id', $id);
        }
        //-------fetch data by subcategory
        else {
            $this->CI->db->where('subcategory_id', $id);
        }
        $this->CI->db->where('product_type !=', 2);
        $this->CI->db->where('is_active', 1);
        $this->CI->db->where('cat_active', 1);
        $this->CI->db->where('subcat_active', 1);
        $count = $this->CI->db->count_all_results();

        //--------- pagination config ----------------------
        $config['base_url'] = base_url().'Home/all_products/'.$url.'/'.$sort;

        $per_page = 15;
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul class="pagination mt-3 justify-content-center pagination_style1">';
        $config['full_tag_close'] = '</ul>';

        $config['use_page_numbers'] = true;

        $config['next_link'] = 'First';
        $config['first_tag_open'] = '<li class="first page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="last page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item nextpage">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '<li class="page-item prevpage">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active page-link"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item page-link">';
        $config['num_tag_close'] = '</li>';

        $this->CI->pagination->initialize($config);
        if (!empty($page_index)) {
            // $i = $per_page * ($page - 1) + 1;
            $start = ($page_index - 1) * $config['per_page'];
        } else {
            $page_index = 0;
            $start = 0;
            // $i=1;
        }

        $this->CI->db->select('*');
        $this->CI->db->from($tbl_pro);
        $this->CI->db->where('is_active', 1);
        $this->CI->db->where('cat_active', 1);
        $this->CI->db->where('subcat_active', 1);
        $this->CI->db->where('product_type !=', 2);
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $this->CI->db->where('product_view != ', 1);
            } else {
                $this->CI->db->where('product_view != ', 2);
            }
        }
        //-------fetch data by category
        if ($t==1) {
            $this->CI->db->where('category_id', $id);
        }
        //-------fetch data by subcategory
        else {
            $this->CI->db->where('subcategory_id', $id);
        }
        // $this->CI->db->where('is_active', 1);
        // -------- sort -----------------
        if (!empty($sort)) {
            if ($sort=="LH") {//----- sort by low to high
                $this->CI->db->order_by('selling_price', 'asc');
            } elseif ($sort=="HL") {//----- sort by high to low
                $this->CI->db->order_by('selling_price', 'desc');
            }else {
                $this->CI->db->order_by('(top_ten * -1)', 'desc');
            }
        }
        $this->CI->db->limit($config["per_page"], $start);
        $product_data= $this->CI->db->get()->result();
        // print_r($product_data);die();

        $links = $this->CI->pagination->create_links();

        $sendArray = array("links"=>$links, "product_data"=>$product_data, "category_name"=>$category_name, "subcategory_name"=>$subcategory_name,"url"=>$url,"id"=>$id,"t"=>$t);

        return $sendArray;
    }


    //====================================== PRODUCT DETAIL ===============================================
    public function product_detail($url)
    {
        $product_data = $this->CI->db->get_where('tbl_product', array('url = ' => $url))->result();
        $type_exists = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product_data[0]->id, 'is_active' => 1))->result();

        $returnarray = array("product_data"=>$product_data, "type_exists"=>$type_exists);
        return $returnarray;
    }

    //====================================== RELATED PRODUCTS ===============================================
    public function related_products($url)
    {
        $productviewnotequal = 0;
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $productviewnotequal = 1;
            } else {
                $productviewnotequal = 2;
            }
        }
        $related_products = $this->CI->db->get_where('tbl_product', array('url != ' => $url,'is_active' => 1, 'cat_active'=>1, 'subcat_active'=>1, 'product_view != '=>$productviewnotequal, 'product_type != '=>2));
        return $related_products;
    }

    //====================================== PRODUCT REVIEWS  ===============================================
    public function productReviews($url)
    {
        $product_data = $this->CI->db->get_where('tbl_product', array('url = ' => $url))->result();
        $product_reviews = $this->CI->db->get_where('tbl_product_review', array('product_id = ' => $product_data[0]->id));
        return $product_reviews;
    }

    //====================================== BUY WITH IT ===============================================
    public function buy_with_it($url)
    {
        $product_data = $this->CI->db->get_where('tbl_product', array('url = ' => $url, 'is_active' => 1))->result();
        $buy_with_it_array = [];
        $product_result = "";
        $productviewnotequal = 0;
        $product_json = json_decode($product_data[0]->buy_with);
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $productviewnotequal = 1;
            } else {
                $productviewnotequal = 2;
            }
        }
        if (!empty($product_json)) {
            foreach ($product_json as $buy_id) {
                $product_result = $this->CI->db->get_where('tbl_product', array('id = ' => $buy_id, 'is_active' => 1, 'cat_active'=>1, 'subcat_active'=>1, 'product_view != '=>$productviewnotequal, 'product_type != '=>2))->result();
                if (!empty($product_result)) {
                    $buy_with_it_array[] = $product_result;
                }
                $product_result = "";
            }
        }
        return $buy_with_it_array;
    }

    // ==================================== SEARCH FOR PRODUCTS ================================================
    public function searchForProducts($string)
    {
        $string1 = explode(" ", $string);
        $st_count= count($string1);
        $a = '';
        $b = '';
        $c = '';
        $d = '';
        $e = '';
        $f = '';
        if ($st_count >= 1) {
            $a= $string1[0];
        }
        if ($st_count >= 2) {
            $b= $string1[1];
        }
        if ($st_count >= 3) {
            $c= $string1[2];
        }
        if ($st_count >= 4) {
            $d= $string1[3];
        }

        if ($st_count >= 5) {
            $e= $string1[4];
        }

        if ($st_count >= 6) {
            $f= $string1[5];
        }

        $tbl_pro = "tbl_product";
        $category_name = 'All Products';
        $subcategory_name = 'Search Products';

        //--------- Count to total number of rows ---------------
        $this->CI->db->select('*');
        $this->CI->db->from($tbl_pro);
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $this->CI->db->where('product_view != ', 1);
            } else {
                $this->CI->db->where('product_view != ', 2);
            }
        }
        if (!empty($a)) {
            $this->CI->db->like('name', $a);
            $this->CI->db->like('tags', $a);
        }
        if (!empty($b)) {
            $this->CI->db->or_like('name', $b);
            $this->CI->db->or_like('tags', $b);
        }
        if (!empty($c)) {
            $this->CI->db->or_like('name', $c);
            $this->CI->db->or_like('tags', $c);
        }
        if (!empty($d)) {
            $this->CI->db->or_like('name', $d);
            $this->CI->db->or_like('tags', $d);
        }
        if (!empty($e)) {
            $this->CI->db->or_like('name', $e);
            $this->CI->db->or_like('tags', $e);
        }
        if (!empty($f)) {
            $this->CI->db->or_like('name', $f);
            $this->CI->db->or_like('tags', $f);
        }
        $this->CI->db->where('product_type !=', 2);
        $this->CI->db->where('is_active', 1);
        $this->CI->db->where('cat_active', 1);
        $this->CI->db->where('subcat_active', 1);
        $count = $this->CI->db->count_all_results();

        //--------- pagination config ----------------------
        $config['base_url'] = base_url().'Home/searchForProducts/'.$string;

        $per_page = 15;
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul class="pagination mt-3 justify-content-center pagination_style1">';
        $config['full_tag_close'] = '</ul>';

        $config['use_page_numbers'] = true;

        $config['next_link'] = 'First';
        $config['first_tag_open'] = '<li class="first page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="last page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item nextpage">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = ' Previous';
        $config['prev_tag_open'] = '<li class="page-item prevpage">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active page-link"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item page-link">';
        $config['num_tag_close'] = '</li>';

        $this->CI->pagination->initialize($config);
        if (!empty($page_index)) {
            // $i = $per_page * ($page - 1) + 1;
            $start = ($page_index - 1) * $config['per_page'];
        } else {
            $page_index = 0;
            $start = 0;
        }
        $this->CI->db->select('*');
        $this->CI->db->from($tbl_pro);
        $this->CI->db->where('is_active', 1);
        $this->CI->db->where('cat_active', 1);
        $this->CI->db->where('subcat_active', 1);
        $this->CI->db->where('product_type !=', 2);
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $this->CI->db->where('product_view != ', 1);
            } else {
                $this->CI->db->where('product_view != ', 2);
            }
        }
        if (!empty($a)) {
            $this->CI->db->like('name', $a);
            $this->CI->db->or_like('tags', $a);
        }
        if (!empty($b)) {
            $this->CI->db->or_like('name', $b);
            $this->CI->db->or_like('tags', $b);
        }
        if (!empty($c)) {
            $this->CI->db->or_like('name', $c);
            $this->CI->db->or_like('tags', $c);
        }
        if (!empty($d)) {
            $this->CI->db->or_like('name', $d);
            $this->CI->db->or_like('tags', $d);
        }
        if (!empty($e)) {
            $this->CI->db->or_like('name', $e);
            $this->CI->db->or_like('tags', $e);
        }
        if (!empty($f)) {
            $this->CI->db->or_like('name', $f);
            $this->CI->db->or_like('tags', $f);
        }
        // -------- sort -----------------
        if (!empty($sort)) {
            if ($sort=="LH") {//----- sort by low to high
                $this->CI->db->order_by('selling_price', 'asc');
            } elseif ($sort=="HL") {//----- sort by high to low
                $this->CI->db->order_by('selling_price', 'desc');
            }
        } else {
            $this->CI->db->order_by('id', 'desc');
        }
        $this->CI->db->limit($config["per_page"], $start);
        $product_data= $this->CI->db->get()->result();
        // print_r($product_data);die();


        $links = $this->CI->pagination->create_links();

        $sendArray = array("links"=>$links, "product_data"=>$product_data, "category_name"=>$category_name, "subcategory_name"=>$subcategory_name);

        return $sendArray;
    }
    //=============================================== GET UNNIQUE RESULT ARRAY BY KEY ================================================
    public function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();
        foreach ($array as $val) {
            if (!in_array($val->$key, $key_array)) {
                $key_array[$i] = $val->$key;
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
    //========================================== GET UNIQUE ASSOCICATIVE ARRAY BY KEY ================================================
    public function unique_multidim_assos_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();
        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    //================================================ GET ASCE ASSOCICATIVE ARRAY BY KEY ================================
    public function asc_multidim_assos_array($arr, $key)
    {
        $names = array();
        foreach ($arr as $index => $val) {
            $names[$index] = $val[$key];
        }
        array_multisort($names, SORT_ASC, $arr);
        return $arr;
    }
    //================================================ GET DESC ASSOCICATIVE ARRAY BY KEY ================================
    public function desc_multidim_assos_array($arr, $key)
    {
        $names = array();
        foreach ($arr as $index => $val) {
            $names[$index] = $val[$key];
        }
        array_multisort($names, SORT_DESC, $arr);
        return $arr;
    }

    //=========================================================== GET COLOUR SIZE ================================================
    public function getColorSize($product_id, $colour_id)
    {
        //---- get size id by product and color id -----
        $size_arr=[];
        $product_data = $this->CI->db->get_where('tbl_product', array('id = ' => $product_id))->result();
        $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product_id, 'colour_id' => $colour_id, 'is_active'=>1, 'color_active'=>1, 'size_active'=>1))->result();
        $i=1;
        foreach ($type_data as $type) {
            $size_data = $this->CI->db->get_where('tbl_size', array('id = ' => $type->size_id, 'is_active' => 1))->result();
            if ($type->inventory > 0) {
                $stock=1;
            } else {
                $stock=0;
            }
            $size_arr[]=array('id'=>$size_data[0]->id,
            'product_url'=>$product_data[0]->url,
            'type_id'=>$type->id,
           "size_id"=>$size_data[0]->id,
           "size_name"=>$size_data[0]->name,
           "stock"=>$stock,
         );
        }
        return $size_arr;
    }

    //============================================== FILTER PRODUCTS ===============================================
    public function filterProducts($sized, $color, $attribute, $products, $minprice, $maxprice, $sort_by)
    {
        $filtered = [];
        $final_filter = [];
        $final_filter2 = [];
        $final_filter3 = [];
        $final_filter4 = [];
        $final_filter5 = [];
        $final_filter6 = [];
        //------- filtering according to size(PRIORITY)
        // print_r($sized);die();

                if (!empty($sized)) {
                    foreach ($products as $product) {
                        // foreach ($type_data->result() as $type) {
                            foreach ($sized as $size) {
                              $type = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product->id,'size_id = ' => $size))->result();
                                // if ($type->size_id == $size) {
                                if(!empty($type)){
                                    if ($this->CI->session->userdata('user_type')==2) {
                                        $spgst = $type[0]->reseller_spgst;
                                    } else {
                                        $spgst = $type[0]->retailer_spgst;
                                    }
                                    $final_filter[] = array('id'=>$product->id, 'product_view'=>$product->product_view, 'type_id'=>$type[0]->id,'size_id'=> $type[0]->size_id,'colour_id'=> $type[0]->colour_id, 'exclusive'=>$product->exclusive,'spgst'=>$spgst, 'url'=>$product->url, 'name'=>$product->name,'all_attributes'=>$product->all_attributes);
                                }
                            }
                        // }
                    }
                }else{
                      foreach ($products as $product) {
                          $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product->id))->result();
                          foreach ($type_data as $type) {
                            if ($this->CI->session->userdata('user_type')==2) {
                                $spgst = $type->reseller_spgst;
                            } else {
                                $spgst = $type->retailer_spgst;
                            }
                              $final_filter[] = array('id'=>$product->id, 'product_view'=>$product->product_view, 'type_id'=>$type->id,'size_id'=> $type->size_id,'colour_id'=> $type->colour_id,  'exclusive'=>$product->exclusive,'spgst'=>$spgst, 'url'=>$product->url, 'name'=>$product->name,'all_attributes'=>$product->all_attributes);
                          }
                  }
                }
                // print_r($final_filter);die();

        if (!empty($color)) {
            foreach ($final_filter as $product) {
                // foreach ($type_data->result() as $type) {
                    foreach ($color as $colorfilter) {
                      // $type = $this->CI->db->get_where('tbl_type', array('id = ' => $product['id']));
                        if ($product['colour_id'] == $colorfilter) {
                          // print_r($product);die();
                            $final_filter2[]=array('id'=>$product['id'], 'product_view'=>$product['product_view'], 'type_id'=>$product['type_id'], 'spgst'=>$product['spgst'], 'exclusive'=>$product['exclusive'], 'url'=>$product['url'], 'name'=>$product['name'],
                            'all_attributes'=>$product['all_attributes']
                          );
                        }
                    }
                // }
            }
        }else{
            $final_filter2 = $final_filter;
        }


        // print_r($final_filter);die();

        if(!empty($attribute)){
            foreach ($final_filter2 as $product) {
                // $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product['id']));
              foreach ($attribute as  $attr) {
                 if (in_array($attr, json_decode($product['all_attributes']))) {
                   // if ($this->CI->session->userdata('user_type')==2) {
                   //     $spgst = $type->reseller_spgst;
                   // } else {
                   //     $spgst = $type->retailer_spgst;
                   // }
                    $final_filter3[]= array('id'=>$product['id'], 'product_view'=>$product['product_view'], 'type_id'=>$product['type_id'], 'spgst'=>$product['spgst'], 'exclusive'=>$product['exclusive'], 'url'=>$product['url'], 'name'=>$product['name'],'all_attributes'=>$product['all_attributes']);
                }
              }

            }
        }else{
  $final_filter3 = $final_filter2;
          }
        // print_r($final_filter3);die();


        //--------- sorting by maximum price -----------------
        if (!empty($minprice) || !empty($maxprice)) {


            if (empty($minprice)) {
                $minprice = 0;
            }
            if (empty($maxprice)) {
                $maxprice = 9999999999;
            }
            foreach ($final_filter3 as $product) {
              // print_r($product);die();
                // $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product['id']));
                // foreach ($type_data->result() as $type) {
                    // if ($this->CI->session->userdata('user_type')==2) {
                    //     $spgst = $type->reseller_spgst;
                    // } else {
                    //     $spgst = $type->retailer_spgst;
                    // }
                    // if ($maxprice >= $product['spgst'] && $minprice <= $product['spgst']) {
                    // echo is_numeric($minprice).'<br />';
                    // echo is_numeric($product['spgst']).'<br />';
                    // echo is_numeric($maxprice);die();
                    if (($minprice<=$product['spgst']) && ($maxprice>=$product['spgst'])) {
                        $final_filter4[]= array('id'=>$product['id'], 'product_view'=>$product['product_view'], 'type_id'=>$product['type_id'],'spgst'=>$product['spgst'], 'exclusive'=>$product['exclusive'], 'url'=>$product['url'], 'name'=>$product['name']);
                    }

            }
        }else{
          // echo "hi";
            $final_filter4 = $final_filter3;
          }
        // print_r($final_filter4);
        // die();
        // if(empty($minprice) && empty($maxprice)){
        //   $final_filter4 = $final_filter3;
        //   }
          // print_r($final_filter4);
          // die();

        // if (empty($size) && empty($attribute) && empty($minprice) && empty($maxprice) && empty($color)) {
        //     foreach ($products as $product) {
        //         $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product->id));
        //         foreach ($type_data->result() as $type) {
        //             if ($this->CI->session->userdata('user_type')==2) {
        //                 $spgst = $type->reseller_spgst;
        //             } else {
        //                 $spgst = $type->retailer_spgst;
        //             }
        //             $final_filter[] = array('id'=>$product->id, 'product_view'=>$product->product_view, 'type_id'=>$type->id, 'spgst'=>$spgst, 'exclusive'=>$product->exclusive, 'url'=>$product->url, 'name'=>$product->name);
        //         }
        //     }
        // }
        // print_r($final_filter4);die();

            if (!empty($final_filter4)) {
        $final_filter5 = $this->unique_multidim_assos_array($final_filter4, 'id');
        // print_r($final_filter5);die();
        if ($sort_by=="ASC") {
            $final_filter5 = $this->asc_multidim_assos_array($final_filter5, 'spgst');
        }
        if ($sort_by=="DESC") {
            $final_filter5 = $this->desc_multidim_assos_array($final_filter5, 'spgst');
        }
        }else{
          $final_filter5 = $final_filter4;
          }

        return $final_filter5;
    }
    //============================================== FILTER PRODUCTS ===============================================
    public function all_products2($url, $page_index='', $sort='', $size_arr='', $color_arr='', $attribute_arr='',$minprice='', $maxprice='')
    {
      // print_r($attribute_arr);die();
        $final_attr=[];
        // if (!empty($size_arr)) {
        //     foreach ($size_arr as $size) {
        //         if (!empty($color_arr)) {
        //             foreach ($color_arr as $clr) {
        //                         $check = $this->db->get_where('tbl_product', array("(JSON_CONTAINS(all_filters,'[\"$att\"]')) > "=> 0,'size_id'=> $size,'color_id'=> $clr))->result();
        //                         array_push($final_attr, $att);
        //             }
        //         } else {
        //             if (!empty($attribute_arr)) {
        //                 foreach ($attribute_arr as $att) {
        //                     $check = $this->db->get_where('tbl_product', array("(JSON_CONTAINS(all_filters,'[\"$att\"]')) > "=> 0,'size_id'=> $size))->result();
        //                     array_push($final_attr, $att);
        //                 }
        //             }
        //         }
        //     }
        //     // create json contain for size --------
        //     foreach ($size_arr as  $s) {
        //         $Sizes[] = '\"'.$s.'\",';
        //     }
        //     $Sizes='['.implode('', $Sizes).']';
        //     $sl= strlen($Sizes);
        //     $Sizes = substr($Sizes, 0, $sl-3).'"]';
        // } elseif (!empty($color_arr)) {
        //     foreach ($color_arr as  $c) {
        //         $Colors[] = '\"'.$c.'\",';
        //     }
        //     $Colors='['.implode('', $Colors).']';
        //     $cl= strlen($Colors);
        //     $Colors = substr($Colors, 0, $cl-3).'"]';
        // }
        if ($attribute_arr) {
            foreach ($attribute_arr as  $at) {
                $Attributes[] = '\"'.$at.'\",';
            }
            $Attributes='['.implode('', $Attributes).']';
            $al= strlen($Attributes);
            $Attributes = substr($Attributes, 0, $al-3).'"]';
        }
        $tbl_pro = "tbl_product";
        //------ checks for category wise data -------------
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_category');
        $this->CI->db->where('url', $url);
        $cat_data= $this->CI->db->get()->row();

        //------ checks for subcategory wise data -------------
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_subcategory');
        $this->CI->db->where('url', $url);
        $sub_data= $this->CI->db->get()->row();

        $category_name = '';
        $category_name = '';
        $subcategory_name = '';

        if (!empty($cat_data)) {//-------fetch data by category
            $id= $cat_data->id;
            $category_name = $cat_data->name;
            $subcategory_name = 'All Products';
            $t=1;
        } else {//-------fetch data by subcategory
            $id= $sub_data->id;
            $t=2;
            $cat_data = $this->CI->db->get_where('tbl_category', array('id = ' => $sub_data->category_id))->result();
            if (!empty($cat_data)) {
                $category_name = $cat_data[0]->name;
            }
            $subcategory_name = $sub_data->name;
        }
        $this->CI->db->select('*');
        $this->CI->db->from($tbl_pro);
        $this->CI->db->where('is_active', 1);
        $this->CI->db->where('cat_active', 1);
        $this->CI->db->where('subcat_active', 1);
        $this->CI->db->where('product_type !=', 2);
        if (!empty($this->CI->session->userdata('user_type'))) {
            if ($this->CI->session->userdata('user_type')==2) { //reseller
                $this->CI->db->where('product_view != ', 1);
            } else {
                $this->CI->db->where('product_view != ', 2);
            }
        }
        //-------fetch data by category
        if ($t==1) {
            $this->CI->db->where('category_id', $id);
        }
        //-------fetch data by subcategory
        else {
            $this->CI->db->where('subcategory_id', $id);
        }
        $this->CI->db->order_by('id', 'desc');

        // ------------------- FITERS -------------------
        // $this->db->where("(JSON_CONTAINS(all_attributes,'[\"27\",\"38\"]')) > ",0);
        // if (!empty($Attributes)) {
          // $this->CI->db->where("(JSON_CONTAINS(all_attributes,'$Attributes')) > ", 0);
        // $this->CI->db->like('all_attributes', '40');
            // $this->CI->db->where("json_extract(all_attributes,'$') LIKE '$Attributes'");
        // }
        // $this->CI->db->limit($config["per_page"], $start);
        $product_data= $this->CI->db->get()->result();
        // print_r($product_data);die();
  $final_filter = $this->filterProducts($size_arr, $color_arr, $attribute_arr, $product_data, $minprice, $maxprice, $sort);
        // $links = $this->CI->pagination->create_links();
        // print_r($final_filter);die();

        $sendArray = array("product_data"=>$final_filter, "category_name"=>$category_name, "subcategory_name"=>$subcategory_name,"id"=>$id,'t'=>$t);

        // print_r($sendArray);
        // die();
        return $sendArray;
        // $data['i'] = $i;
    }
}

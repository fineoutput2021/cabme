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
            $this->CI->db->like('category_id', $id);
        }
        //-------fetch data by subcategory
        else {
            $this->CI->db->like('subcategory_id', $id);
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
            }
        } else {
            $this->CI->db->order_by('id', 'desc');
        }
        $this->CI->db->limit($config["per_page"], $start);
        $product_data= $this->CI->db->get()->result();

        $links = $this->CI->pagination->create_links();

        $sendArray = array("links"=>$links, "product_data"=>$product_data, "category_name"=>$category_name, "subcategory_name"=>$subcategory_name);

        return $sendArray;
        // $data['i'] = $i;
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
        }
        if (!empty($b)) {
            $this->CI->db->or_like('name', $b);
        }
        if (!empty($c)) {
            $this->CI->db->or_like('name', $c);
        }
        if (!empty($d)) {
            $this->CI->db->or_like('name', $d);
        }
        if (!empty($e)) {
            $this->CI->db->or_like('name', $e);
        }
        if (!empty($f)) {
            $this->CI->db->or_like('name', $f);
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
        }
        if (!empty($b)) {
            $this->CI->db->or_like('name', $b);
        }
        if (!empty($c)) {
            $this->CI->db->or_like('name', $c);
        }
        if (!empty($d)) {
            $this->CI->db->or_like('name', $d);
        }
        if (!empty($e)) {
            $this->CI->db->or_like('name', $e);
        }
        if (!empty($f)) {
            $this->CI->db->or_like('name', $f);
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
      foreach ($arr as $index => $val)
      {
          $names[$index] = $val[$key];
      }
      array_multisort($names, SORT_ASC, $arr);
      return $arr;
    }
    //================================================ GET DESC ASSOCICATIVE ARRAY BY KEY ================================
    public function desc_multidim_assos_array($arr, $key)
    {
      $names = array();
      foreach ($arr as $index => $val)
      {
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
        $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product_id, 'colour_id' => $colour_id))->result();
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
    public function filterProducts($sized, $color, $attribute, $products, $minprice, $maxprice)
    {
        $filtered = [];
        $final_filter = [];
        if (empty($minprice)) {
            $minprice = 0;
        }
        if (empty($maxprice)) {
            $maxprice = 9999999999;
        }
        //------- filtering according to color(PRIORITY)
        if (!empty($color)) {
            foreach ($products as $product) {
                $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product->id));
                foreach ($type_data->result() as $type) {
                    foreach ($color as $colorfilter) {
                        if ($type->colour_id == $colorfilter) {
                            $filtered[] = array('id'=>$product->id, 'product_view'=>$product->product_view, 'type_id'=>$type->id, 'exclusive'=>$product->exclusive, 'url'=>$product->url, 'name'=>$product->name);
                        }
                    }
                }
            }
        } else {
            foreach ($products as $product) {
                $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product->id));
                foreach ($type_data->result() as $type) {
                    $filtered[] = array('id'=>$product->id, 'product_view'=>$product->product_view, 'type_id'=>$type->id, 'exclusive'=>$product->exclusive, 'url'=>$product->url, 'name'=>$product->name);
                }
            }
        }
        //--------- sorting by maximum price -----------------
        foreach ($filtered as $product) {
            $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product['id']));
            foreach ($type_data->result() as $type) {
                if ($this->CI->session->userdata('user_type')==2) {
                    $spgst = $type->reseller_spgst;
                } else {
                    $spgst = $type->retailer_spgst;
                }
                if ($maxprice >= $spgst && $minprice <= $spgst) {
                    array_push($final_filter, array('id'=>$product['id'], 'product_view'=>$product['product_view'], 'type_id'=>$type->id, 'exclusive'=>$product['exclusive'], 'url'=>$product['url'], 'name'=>$product['name']));
                }
            }
        }
        if (!empty($sized)) {
            foreach ($filtered as $product) {
                $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product['id']));
                foreach ($type_data->result() as $type) {
                    foreach ($sized as $size) {
                        if ($type->size_id == $size) {
                            array_push($final_filter, array('id'=>$product['id'], 'product_view'=>$product['product_view'], 'type_id'=>$type->id, 'exclusive'=>$product['exclusive'], 'url'=>$product['url'], 'name'=>$product['name']));
                        }
                    }
                }
            }
        }
        if (!empty($attribute)) {
            foreach ($filtered as $product) {
                $type_data = $this->CI->db->get_where('tbl_type', array('product_id = ' => $product['id']));
                $pro_daat = $this->CI->db->get_where('tbl_product', array('id = ' => $product['id']))->result();
                foreach ($type_data->result() as $type) {
                    foreach ($attribute as $attr) {
                        $type_attr = json_decode($pro_daat[0]->all_attributes);
                        if (!empty($type_attr)) {
                            foreach ($type_attr as $typeIn) {
                                if ($typeIn == $attr) {
                                    array_push($final_filter, array('id'=>$product['id'], 'product_view'=>$product['product_view'], 'type_id'=>$type->id, 'exclusive'=>$product['exclusive'], 'url'=>$product['url'], 'name'=>$product['name']));
                                }
                            }
                        }
                    }
                }
            }
        }
        $final_filter = $this->unique_multidim_assos_array($final_filter, 'id');
        return $final_filter;
    }
}

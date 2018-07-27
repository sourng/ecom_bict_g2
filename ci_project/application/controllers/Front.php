<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front extends CI_Controller {
    
  function __construct() {
      parent::__construct();      
      $this->load->helper('text');
      $this->load->database();      
      $this->load->model('m_crud', '', true); 
      $this->load->model('cart_model');
      date_default_timezone_set('Asia/Phnom_Penh');
       $this->load->library("cart");
       // load Pagination library
        $this->load->library('pagination');
         
        // load URL helper
        $this->load->helper('url');
         
  }

  public function index(){ 

    $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');   
    $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product');
    $data['imageslide']=$this->m_crud->get_by_sql('Select * from slide');
    $this->load->view('front/home',$data);    
  } 

   public function login(){
    $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
    $this->load->view('front/login',$data);
  }
   public function register(){
    $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
    $this->load->view('front/register',$data);
  }
   public function contact(){
    $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
    $this->load->view('front/contact',$data);
  }

  // customer-wishlist
    public function customer_wishlist(){
    $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
    $this->load->view('front/customer_wishlist',$data);
  }

    public function detail(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
      $data['detail']=$this->m_crud->get_by_sql('Select * from tbl_product where pro_id='.$_GET['pro_id']);
      $data['product_detail']=$this->m_crud->get_by_sql('Select * from tbl_product where pro_id='.$_GET['pro_id']);
      $data['product_lastes']=$this->m_crud->get_by_sql('Select * from tbl_product where pro_id<>'.$_GET['pro_id']);
      $data['brand']=$this->m_crud->get_by_sql('Select * from tbl_brand');
        $data['lastcartid']=$this->m_crud->get_by_sql("SELECT `auto_increment` as lastcartid FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'tbl_cart'");
    $this->load->view('front/detail',$data);
  }
 public function customer_orders(){
   $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
    $this->load->view('front/customer_orders',$data);
  }

    public function customer_account(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
    $this->load->view('front/customer_account',$data);
  }

    public function basket(){

      $data=array();
      

      $data['cart']=$this->cart->contents();
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
      /*$ip = $_SERVER['SERVER_ADDR'];
            $data['cart']=$this->m_crud->get_by_sql("Select count(cart.pro_id) as countpro,max(cart.cart_id) as lastcartid, sum(pro.price) as sumprice , pro.*,cart.* 
                                              From 
                                              tbl_cart as cart inner join 
                                              tbl_product as pro on 
                                              cart.pro_id=pro.pro_id 
                                              where cart.ip='$ip'
                                              Group by cart.pro_id
                                                 " );*/
           /*$data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');*/
       $data['cart']=$this->cart->contents();

    $this->load->view('front/basket',$data);
  }
    public function category($cat,$page=1){

      $this->load->model('Paginations_model');
       $data = array();
      $data['cart']=$this->cart->contents();
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');

      $data['brand']=$this->m_crud->get_by_sql('Select * from tbl_brand');
     if (@$cat<>'') {
         $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product where cat_id='.$cat);
         $data['category_name']=$this->m_crud->get_by_sql('Select * from tbl_category where cat_id ='.$cat);
      }else{
          $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product');
          $data['category_name']=array();
      }
      $data['lastcartid']=$this->m_crud->get_by_sql("SELECT `auto_increment` as lastcartid FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'tbl_cart'");
      
        $limit_per_page = 3;
        $page = ($page) ? ($page - 1) : 0;
        $total_records = $this->Paginations_model->get_total($cat);
     
        if ($total_records > 0)
        {
            // get current page records
            $data["results"] = $this->Paginations_model->get_current_page_records($limit_per_page, $page*$limit_per_page,$cat);
                 
            $config['base_url'] = base_url('category.html/'.$cat);
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
             
            $config['first_link'] = 'Frist';
            $config['first_tag_open'] = '<li id="num">';
            $config['first_tag_close'] = '</li>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
             
            $config['next_link'] = '&raquo;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
 
            $config['prev_link'] = '&laquo;';
            $config['prev_tag_open'] = '<li id="num">';
            $config['prev_tag_close'] = '</li>';
 
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
 
            $config['num_tag_open'] = '<li id="num">';
            $config['num_tag_close'] = '</li>';
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }
      
      
       
     




      $this->load->view('front/category',$data);
  }

    public function checkout1(){
      $data=array();
      


      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
      /*$ip = $_SERVER['SERVER_ADDR'];
            $data['cart']=$this->m_crud->get_by_sql("Select count(cart.pro_id) as countpro,max(cart.cart_id) as lastcartid, sum(pro.price) as sumprice , pro.*,cart.* 
                                              From 
                                              tbl_cart as cart inner join 
                                              tbl_product as pro on 
                                              cart.pro_id=pro.pro_id 
                                              where cart.ip='$ip'
                                              Group by cart.pro_id
                                                 " );*/
           /*$data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');*/
       $data['cart']=$this->cart->contents();
    $this->load->view('front/checkout1',$data);
  }

     public function checkout2(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
/*
    $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');*/
    $this->load->view('front/checkout2',$data);
  }

     /*public function checkout3(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
   $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
    $this->load->view('front/checkout3',$data);
  }
     public function checkout4(){

      $data=array();
      


      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
      $ip = $_SERVER['SERVER_ADDR'];
            $data['cart']=$this->m_crud->get_by_sql("Select count(cart.pro_id) as countpro,max(cart.cart_id) as lastcartid, sum(pro.price) as sumprice , pro.*,cart.* 
                                              From 
                                              tbl_cart as cart inner join 
                                              tbl_product as pro on 
                                              cart.pro_id=pro.pro_id 
                                              where cart.ip='$ip'
                                              Group by cart.pro_id
                                                 " );
           $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
       $data['cart']=$this->cart->contents();

    $this->load->view('front/checkout4',$data);
  }*/


  /*public function save_check_out(){
    $data=array();
    // tab 1
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $company=$_POST['company'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $street=$_POST['street'];
    $zip=$_POST['zip'];
    $state=$_POST['state'];
    $country=$_POST['country'];
    $password=$_POST['password'];
    
    //tab2
    $bus=$_POST['bus'];
    $flight=$_POST['flight'];
    $cruise=$_POST['cruise'];

    //tab3
    $paypal=$_POST['paypal'];
    $mastercard=$_POST['mastercard'];
    $cash=$_POST['cash'];
    
    //tab4+5
    $namecard=$_POST['namecard'];
    $card_number=$_POST['card_number'];
    $cvv=$_POST['cvv'];
    $holdername=$_POST['holdername'];
    $valid_date=$_POST['valid_date'];
    /*$cart_number=$_POST['cart_number'];
    $con_number=$_POST['con_number'];
    $cvv=$_POST['cvv'];*/

    public function save_check_out()
  {
  // This will store all values which inserted from user.
  $customer = array(
  'fname' => $this->input->post('fname'),
  'lname' => $this->input->post('lname'),
  'company' => $this->input->post('company'),
  'phone' => $this->input->post('phone'),
  'email' => $this->input->post('email'),
  'street' => $this->input->post('street'),
  'zip' => $this->input->post('zip'),
  'state' => $this->input->post('city'),
  'country' => $this->input->post('country'),
  'password' => $this->input->post('password')
  );
  // And store user information in database.
  $cust_id = $this->cart_model->insert_customer($customer);
 $cus_id =$this->db->insert_id();
  $deliverys = array(
  'cus_id' => $cus_id ,
  'delivery' => $this->input->post('delivery-type')
  );
  
  $de_id = $this->cart_model->insert_delivery($deliverys);

  //add to card 
$card = array(
'cus_id'=> $cus_id,
'namecard' => $this->input->post('namecard'),
'card_number' => $this->input->post('card_number'),
'cvv' => $this->input->post('cvv'),
'holdername' => $this->input->post('holdername'),
'valid_date' => $this->input->post('valid_date')
);
$card_id = $this->cart_model->insert_card($card);





  if ($cart = $this->cart->contents()){
    foreach ($cart as $item){
    $order_detail = array(
    'cus_id' => $cus_id,
    'pro_id' => $item['id'],
    'name' => $item['name'],
    'qty' => $item['qty'],
    'price' => $item['price'],
    'image' => $item['img'],
    'subtotal' => $item['subtotal']
    );
  // Insert product imformation with order detail, store in cart also store in database.
  $cust_id = $this->cart_model->insert_order_detail($order_detail);
  }
  
}
  $this->cart->destroy();
  // After storing all imformation in database load "billing_success".
  $this->index(); 
  }

}
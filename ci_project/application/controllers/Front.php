<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front extends CI_Controller {
    
  function __construct() {
      parent::__construct();      
      $this->load->helper('text');
      $this->load->database();      
      $this->load->model('m_crud', '', true); 
      date_default_timezone_set('Asia/Phnom_Penh');
  }

  public function index(){    
    $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product');
    $data['imageslide']=$this->m_crud->get_by_sql('Select * from slide');
    $this->load->view('front/home',$data);    
  } 

   public function login(){
    $this->load->view('front/login');
  }
   public function register(){
    $this->load->view('front/register');
  }
   public function contact(){
    $this->load->view('front/contact');
  }

  // customer-wishlist
    public function customer_wishlist(){
    $this->load->view('front/customer_wishlist');
  }

    public function detail(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
      $data['detail']=$this->m_crud->get_by_sql('Select * from tbl_product where pro_id='.$_GET['pro_id']);
      $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product where pro_id<>'.$_GET['pro_id']);
      $data['brand']=$this->m_crud->get_by_sql('Select * from tbl_brand');
        $data['lastcartid']=$this->m_crud->get_by_sql("SELECT `auto_increment` as lastcartid FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'tbl_cart'");
    $this->load->view('front/detail',$data);
  }


  //  public function customer_wishlist(){
  //  $this->load->view('front/customer_wishlist');
  //}

    public function customer_orders(){
    $this->load->view('front/customer_orders');
  }

    public function customer_account(){
    $this->load->view('front/customer_account');
  }

    public function basket(){
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
       

    $this->load->view('front/basket',$data);
  }
    public function category(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');

      $data['brand']=$this->m_crud->get_by_sql('Select * from tbl_brand');
      if (@$_GET['cat']<>'') {
         $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product where pro_cat_id='.$_GET['cat']);
         $data['category_name']=$this->m_crud->get_by_sql('Select * from tbl_category where cat_id ='.$_GET['cat']);
      }else{
          $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product');
          $data['category_name']=array();
      }
      $data['lastcartid']=$this->m_crud->get_by_sql("SELECT `auto_increment` as lastcartid FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'tbl_cart'");
      $this->load->view('front/category',$data);
  }

    public function checkout1(){
       $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
    $this->load->view('front/checkout1',$data);
  }

     public function checkout2(){

    $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
    $this->load->view('front/checkout2',$data);
  }

     public function checkout3(){
   $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
    $this->load->view('front/checkout3',$data);
  }
       public function checkout4(){
    $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
    $this->load->view('front/checkout4',$data);
  }



}
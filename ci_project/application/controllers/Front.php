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
    $this->load->view('front/basket');
  }
    public function category(){
      $data['category']=$this->m_crud->get_by_sql('Select * from tbl_category');
      $data['brand']=$this->m_crud->get_by_sql('Select * from tbl_brand');
       $data['product']=$this->m_crud->get_by_sql('Select * from tbl_product');
      $this->load->view('front/category',$data);
  }

    public function checkout1(){
    $this->load->view('front/checkout1');
  }

     public function checkout2(){
    $this->load->view('front/checkout2');
  }

     public function checkout3(){
    $this->load->view('front/checkout3');
  }
       public function checkout4(){
    $this->load->view('front/checkout4');
  }


}
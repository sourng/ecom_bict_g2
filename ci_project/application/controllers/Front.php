<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front extends CI_Controller {
    
  function __construct() {
      parent::__construct();      
      $this->load->helper('text');
      $this->load->database();      

      date_default_timezone_set('Asia/Phnom_Penh');
  }
  
  public function index(){    
    //$param1 : is for list/add/edit/delete
    //$param2 : is for condition
    $data=array();
    $this->load->view('front/home');
    
  } 

  public function home(){
    $this->load->view('front/home');
  }
   public function login(){
    $this->load->view('front/login');
  }
   public function register(){
    $this->load->view('front/register');
  }
   public function contact(){
    $this->load->view('front/home');
  }

  // customer-wishlist
    public function customer_wishlist(){
    $this->load->view('front/customer-wishlist');
  }

    public function detail(){
    $this->load->view('front/detail');
  }


    public function customer_orders(){
    $this->load->view('front/customer-orders');
  }

    public function customer_order(){
    $this->load->view('front/customer-order');
  }

    public function customer_account(){
    $this->load->view('front/customer-account');
  }

    public function basket(){
    $this->load->view('front/basket');
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
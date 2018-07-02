<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front extends CI_Controller {
    
  function __construct() {
      parent::__construct();      
      $this->load->helper('text');
      $this->load->database();      
      $this->load->model('m_crud', '', true); 
      date_default_timezone_set('Asia/Phnom_Penh');
       $this->load->library("cart");
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


  //  public function customer_wishlist(){
  //  $this->load->view('front/customer_wishlist');
  //}

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
           /*$data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');*/
       $data['cart']=$this->cart->contents();

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

    $data['total']=$this->m_crud->get_by_sql('select sum(pro.price) as total from 
                                                    tbl_cart as cart inner join
                                                     tbl_product as pro on 
                                                     cart.pro_id=pro.pro_id
                                                    ');
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


  public function save_check_out(){
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
    


    /*$cart_number=$_POST['cart_number'];
    $con_number=$_POST['con_number'];
    $cvv=$_POST['cvv'];*/

    //tab final
    $rowid=$_POST['rowid'];
    $qty=$_POST['qty'];
    $subtotal=$_POST['subtotal'];
    $grand_total=$_POST['$grand_total'];
         
    //echo test
    echo " First Name : " .$fname ."<br>"." Last Name : ".$lname ."<br>"." Company : ".$company ."<br>"." Phone : ".$phone."<br>"." Email : ".$email."<br>"." Street : ".$street."<br>"." Zip : ".$zip."<br>"." State : ".$state."<br>"." Country : ".$country."<br>"." Password : ".$password."<br>"." Bus : ".$bus."<br>"." Flight : ".$flight."<br>"." Cruise : ".$cruise."<br>"." Paypal : ".$paypal."<br>"." Mastercard : ".$mastercard."<br>"." Cash : ".$cash;

    
    /*."<br>"." Card Number : ".$cart_number."<br>"." Confirm Card Number : ".$con_number."<br>"." CVV : ".$cvv."<br>"."rowid : ".$rowid."<br>"."QTY : ".$qty."<br>"."Subtotal : ".$subtotal."<br>"."Grand Total : ".$grand_total*/


    
  }



}
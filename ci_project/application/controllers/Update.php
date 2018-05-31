<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Update extends CI_Controller {
    
  function __construct() {
      parent::__construct();      
      $this->load->helper('text');
      $this->load->database();      
      $this->load->model('m_crud', '', true); 
      date_default_timezone_set('Asia/Phnom_Penh');
  }
   public function add_cart(){
      $pro_id = $_GET['pro_id'];
      $ip = $_SERVER['SERVER_ADDR'];  
      
      $data = array(  
          'pro_id' => $pro_id,        
          'ip' =>$ip
      ); 
      
      if(isset($pro_id)){
        $this->db->insert('tbl_cart', $data);
      }
  }
   public function update_cart(){
      $cart_id = $_GET['cart_id'];
      $ip =$_SERVER['SERVER_ADDR'];    
      $data = array( 
          'cart_id' =>$cart_id
      ); 
      $this->db->delete('tbl_cart', $data);
  }
   public function delete_cart()
   {
            
             $pro_id=$_GET['pro_id'];
             $ip=$_SERVER['SERVER_ADDR'];

            $data = array( 
          'pro_id' =>$pro_id,
          'ip' =>$ip,
      ); 
   $this->db->delete('tbl_cart', $data);
   }


}
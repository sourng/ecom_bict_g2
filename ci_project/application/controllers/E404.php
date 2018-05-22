<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class E404 extends CI_Controller {
    
  function __construct() {
      parent::__construct();      
      $this->load->helper('text');
      $this->load->database();      
      $this->load->model('m_crud', '', true); 
      date_default_timezone_set('Asia/Phnom_Penh');
  }
  
  public function index(){    
   
    $this->load->view('front/404');
    
  } 


}
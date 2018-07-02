<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller {
 
 function index()
 {
  $this->load->model("shopping_cart_model");
  $data["product"] = $this->shopping_cart_model->fetch_all();
  $this->load->view("shopping_cart", $data);
 }
 //This function is use from detail when you add product
 function add()
 {
  $this->load->library("cart");
  $data = array(
   "id"  => $_POST["pro_id"],
   "name"  => $_POST["pro_name"],
   "qty"  => 1,
   "img"  =>  $_POST["pro_feature"],
   "price"  => $_POST["price"],
   "discount"  => $_POST["discount"]


  );
  $this->cart->insert($data); //return rowid 

  echo $fefe=count($this->cart->contents());
  // echo $this->view();
 }

 function load()
 {
  echo $this->view();
 }

/*function info()
 {
  $this->load->library("customer");
  $data = array(
   "firstname"  => $_POST["firstname"],
   "lastname"  => $_POST["lastname"], 
   "company"  =>  $_POST["company"],
   "street"  => $_POST["street"],
   "gender"  => $_POST["gender"],
   "zip"  => $_POST["zip"],
   "state"  => $_POST["state"],
   "country"  => $_POST["country"],
   "phone"  => $_POST["phone"],
   "email"  => $_POST["email"]


  );
  $this->customer->insert($data); //return rowid 

  //echo $fefe=count($this->customer->contents());
  // echo $this->view();
 }*/
}
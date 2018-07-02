<?php

include_once('./db/dbconf.php');
  include_once('./class/class.crud.php');
  $objCrud = new crud($DB_con);


$ip=$_POST['ip'];
$pro_id=$_POST['pro_id'];
$product=$_POST['product'];
$unit_price=$_POST['unit_price'];
$discount=$_POST['discount'];
$qty=$_POST['qty'];
$amount=$_POST['amount'];
$image=$_POST['image'];


//$name=$_POST['name'];
// $email=$_POST['email'];
// $sqlCart="SELECT * FROM cart WHERE pro_id=".$pro_id;

// if($objCrud->checkExistCart($sqlCart)=='taken'){
// 		$objCrud->updateCart($ip, $pro_id,$qty+1,$amount*($qty+1));
		
// }else{
// 	$objCrud->SaveToCart($ip, $pro_id, $product,$qty,$unit_price,$discount,$amount,$image);
// }

$objCrud->SaveToCart($ip, $pro_id, $product,$qty,$unit_price,$discount,$amount,$image);

?>
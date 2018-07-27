<?php  
 class Main_model extends CI_Model  
 {  
      function can_login($email, $password)  
      {  
           $this->db->where('email', $email);  
           $this->db->where('password', $password);  
           $query = $this->db->get('tbl_customer');  
           //SELECT * FROM users WHERE email = '$email' AND password = '$password'  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  
      }  
 }  
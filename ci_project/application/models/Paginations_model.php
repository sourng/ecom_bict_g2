<?php
// models/Paginations_model.php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Paginations_model extends CI_Model 
{
    function __construct() 
    {
      parent::__construct();
    }
 
    public function get_current_page_records($limit, $start,$cat) 
    {
        $this->db->select('p.*,c.*');
        $this->db->from("tbl_product as p");
        $this->db->join("tbl_category as c",'p.cat_id=c.cat_id');
        $this->db->where('p.cat_id',$cat);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result_array() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
     
    public function get_total($cat) 
    {
        $this->db->select('p.*,c.*');
        $this->db->from("tbl_product as p");
        $this->db->join("tbl_category as c",'p.cat_id=c.cat_id');
        $this->db->where('p.cat_id',$cat);
        $query = $this->db->get();
       
 
        return $query->num_rows();
    }

}
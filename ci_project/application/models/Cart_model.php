<?php
class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all(){
        $query=$this->db->query("SELECT p.*  FROM tbl_product as p ORDER BY p.id ASC");
        return $query->result_array();
    }
    // Insert customer details in "customer" table in database.
    public function insert_customer($data)
    {
        $this->db->insert('tbl_customer', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    // Insert order date with customer id in "orders" table in database.
    public function insert_delivery($data)
    {
        $this->db->insert('tbl_delivery', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function insert_card($data)
    {
        $this->db->insert('tbl_cart', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

     public function insert_order_detail($data)
    {
        $this->db->insert('tbl_order_detail', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    // Insert ordered product detail in "order_detail" table in database.
    // public function insert_order_detail($data)
    // {
    //     $this->db->insert('order_detail', $data);
    // }
}
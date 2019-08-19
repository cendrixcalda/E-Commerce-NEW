<?php
class Brands_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_brands(){
        $this->db->order_by("brand", "asc");
        $query = $this->db->get('brands');
        return $query->result();
    }
    
    public function insert_brand(){
        $data = array(
            'brand' => $this->input->post('brand')
        );
        
        $this->db->insert('brands', $data);
    }
    
    function delete_brand(){
        $id = $_POST['id'];
        $this->db->where("brandID", $id);  
        $this->db->delete("brands");
    }
    
    function delete_all_brand(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("brandID", $id);  
            $this->db->delete("brands");
        }
    }
    
    function update_brand(){
        $id = $_POST["id"];
        $data = array(
            $_POST["column"]  =>  $_POST["value"]
        );
        
        $this->db->where("brandID", $id);  
        $this->db->update("brands", $data);
    }
}
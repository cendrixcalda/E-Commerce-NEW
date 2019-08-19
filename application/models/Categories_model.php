<?php
class Categories_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_categories(){
        $this->db->order_by("category", "asc");
        $query = $this->db->get('categories');
        return $query->result();
    }
    
    public function insert_category(){
        $data = array(
            'category' => $this->input->post('category')
        );
        
        $this->db->insert('categories', $data);
    }
    
    function delete_category(){
        $id = $_POST['id'];
        $this->db->where("categoryID", $id);  
        $this->db->delete("categories");
    }
    
    function delete_all_category(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("categoryID", $id);  
            $this->db->delete("categories");
        }
    }
    
    function update_category(){
        $id = $_POST["id"];
        $data = array(
            $_POST["column"]  =>  $_POST["value"]
        );
        
        $this->db->where("categoryID", $id);  
        $this->db->update("categories", $data);
    }
}
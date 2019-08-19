<?php
class sizes_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_sizes(){
        $this->db->order_by("size", "asc");
        $query = $this->db->get('sizes');
        return $query->result();
    }
    
    public function insert_size(){
        $data = array(
            'size' => $this->input->post('size')
        );
        
        $this->db->insert('sizes', $data);
    }
    
    function delete_size(){
        $id = $_POST['id'];
        $this->db->where("sizeID", $id);  
        $this->db->delete("sizes");
    }
    
    function delete_all_size(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("sizeID", $id);  
            $this->db->delete("sizes");
        }
    }
    
    function update_size(){
        $id = $_POST["id"];
        $data = array(
            $_POST["column"]  =>  $_POST["value"]
        );
        
        $this->db->where("sizeID", $id);  
        $this->db->update("sizes", $data);
    }
}
<?php
class Materials_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_materials(){
        $this->db->order_by("material", "asc");
        $query = $this->db->get('materials');
        return $query->result();
    }
    
    public function insert_material(){
        $data = array(
            'material' => $this->input->post('material')
        );
        
        $this->db->insert('materials', $data);
    }
    
    function delete_material(){
        $id = $_POST['id'];
        $this->db->where("materialID", $id);  
        $this->db->delete("materials");
    }
    
    function delete_all_material(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("materialID", $id);  
            $this->db->delete("materials");
        }
    }
    
    function update_material(){
        $id = $_POST["id"];
        $data = array(
            $_POST["column"]  =>  $_POST["value"]
        );
        
        $this->db->where("materialID", $id);  
        $this->db->update("materials", $data);
    }
}
<?php
class Colors_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_colors(){
        $this->db->order_by("color", "asc");
        $query = $this->db->get('colors');
        return $query->result();
    }
    
    public function insert_color(){
        $data = array(
            'color' => $this->input->post('color')
        );
        
        $this->db->insert('colors', $data);
    }
    
    function delete_color(){
        $id = $_POST['id'];
        $this->db->where("colorID", $id);  
        $this->db->delete("colors");
    }
    
    function delete_all_color(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("colorID", $id);  
            $this->db->delete("colors");
        }
    }
    
    function update_color(){
        $id = $_POST["id"];
        $data = array(
            $_POST["column"]  =>  $_POST["value"]
        );
        
        $this->db->where("colorID", $id);  
        $this->db->update("colors", $data);
    }
}
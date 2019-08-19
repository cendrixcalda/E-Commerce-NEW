<?php
class Countries_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_countries(){
        $this->db->order_by("country", "asc");
        $query = $this->db->get('countries');
        return $query->result();
    }
    
    public function insert_country(){
        $data = array(
            'country' => $this->input->post('country')
        );
        
        $this->db->insert('countries', $data);
    }
    
    function delete_country(){
        $id = $_POST['id'];
        $this->db->where("countryID", $id);  
        $this->db->delete("countries");
    }
    
    function delete_all_country(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("countryID", $id);  
            $this->db->delete("countries");
        }
    }
    
    function update_country(){
        $id = $_POST["id"];
        $data = array(
            $_POST["column"]  =>  $_POST["value"]
        );
        
        $this->db->where("countryID", $id);  
        $this->db->update("countries", $data);
    }
}
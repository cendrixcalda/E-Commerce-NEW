<?php
class Countries_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_countries_inventory(){
        $this->db->order_by("(CASE country WHEN 'None' THEN 0 ELSE 1 END),  country asc");
        $query = $this->db->get_where('countries', array('status' => 'Active'));
        return $query->result();
    }

    public function get_countries(){
        $this->db->order_by("(CASE country WHEN 'None' THEN 0 ELSE 1 END),  country asc");
        $query = $this->db->get('countries');
        return $query->result();
    }
    
    public function insert_country(){
        $data = array(
            'country' => $this->input->post('country'),
            'status' => $this->input->post('status')
        );
        
        $this->db->insert('countries', $data);
    }
    
    function delete_country(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Disabled'
            );

            $this->db->where("countryID", $id);  
            $this->db->update("countries", $data);
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

    function restore_country(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Active'
            );

            $this->db->where("countryID", $id);  
            $this->db->update("countries", $data);
        }
    }
}
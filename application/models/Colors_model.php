<?php
class Colors_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_colors_inventory(){
        $this->db->order_by("(CASE color WHEN 'None' THEN 0 ELSE 1 END),  color asc");
        $query = $this->db->get_where('colors', array('status' => 'Active'));
        return $query->result();
    }

    public function get_colors(){
        $this->db->order_by("(CASE color WHEN 'None' THEN 0 ELSE 1 END),  color asc");
        $query = $this->db->get('colors');
        return $query->result();
    }
    
    public function insert_color(){
        $data = array(
            'color' => $this->input->post('color'),
            'colorCode' => $this->input->post('colorCode'),
            'status' => $this->input->post('status')
        );
        
        $this->db->insert('colors', $data);
    }
    
    function delete_color(){
        $accountTypeSession = $this->session->userdata('account_type');
        $data['ids'] = $_POST["id"];

        if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
            foreach($data['ids'] as $id){
                $this->db->where("colorID", $id);  
                $this->db->delete("colors");
            }
        } else{
            foreach($data['ids'] as $id){
                $data = array(
                    'status'  =>  'Disabled'
                );
    
                $this->db->where("colorID", $id);  
                $this->db->update("colors", $data);
            }
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

    function restore_color(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Active'
            );

            $this->db->where("colorID", $id);  
            $this->db->update("colors", $data);
        }
    }
}
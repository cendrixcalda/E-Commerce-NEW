<?php
class Materials_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_materials_inventory(){
        $this->db->order_by("(CASE material WHEN 'None' THEN 0 ELSE 1 END),  material asc");
        $query = $this->db->get_where('materials', array('status' => 'Active'));
        return $query->result();
    }

    public function get_materials(){
        $this->db->order_by("(CASE material WHEN 'None' THEN 0 ELSE 1 END),  material asc");
        $query = $this->db->get('materials');
        return $query->result();
    }
    
    public function insert_material(){
        $data = array(
            'material' => $this->input->post('material'),
            'status' => $this->input->post('status')
        );
        
        $this->db->insert('materials', $data);
    }
    
    function delete_material(){
        $accountTypeSession = $this->session->userdata('account_type');
        $data['ids'] = $_POST["id"];

        if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
            foreach($data['ids'] as $id){
                $this->db->where("materialID", $id);  
                $this->db->delete("materials");
            }
        } else{
            foreach($data['ids'] as $id){
                $data = array(
                    'status'  =>  'Disabled'
                );
    
                $this->db->where("materialID", $id);  
                $this->db->update("materials", $data);
            }
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

    function restore_material(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Active'
            );

            $this->db->where("materialID", $id);  
            $this->db->update("materials", $data);
        }
    }
}
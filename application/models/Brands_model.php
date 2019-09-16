<?php
class Brands_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_brands_inventory(){
        $this->db->order_by("(CASE brand WHEN 'None' THEN 0 ELSE 1 END),  brand asc");
        $query = $this->db->get_where('brands', array('status' => 'Active'));
        return $query->result();
    }

    public function get_brands(){
        $this->db->order_by("(CASE brand WHEN 'None' THEN 0 ELSE 1 END),  brand asc");
        $query = $this->db->get('brands');
        return $query->result();
    }
    
    public function insert_brand(){
        $data = array(
            'brand' => $this->input->post('brand'),
            'status' => $this->input->post('status')
        );
        
        $this->db->insert('brands', $data);
    }
    
    function delete_brand(){
        $accountTypeSession = $this->session->userdata('account_type');
        $data['ids'] = $_POST["id"];

        if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
            foreach($data['ids'] as $id){
                $this->db->where("brandID", $id);  
                $this->db->delete("brands");
            }
        } else{
            foreach($data['ids'] as $id){
                $data = array(
                    'status'  =>  'Disabled'
                );
    
                $this->db->where("brandID", $id);  
                $this->db->update("brands", $data);
            }
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

    function restore_brand(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Active'
            );

            $this->db->where("brandID", $id);  
            $this->db->update("brands", $data);
        }
    }
}
<?php
class Categories_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_categories_inventory(){
        $this->db->order_by("(CASE category WHEN 'None' THEN 0 ELSE 1 END),  category asc");
        $query = $this->db->get_where('categories', array('status' => 'Active'));
        return $query->result();
    }

    public function get_categories(){
        $this->db->order_by("(CASE category WHEN 'None' THEN 0 ELSE 1 END),  category asc");
        $query = $this->db->get('categories');
        return $query->result();
    }
    
    public function insert_category(){
        $data = array(
            'category' => $this->input->post('category'),
            'categoryCode' => $this->input->post('categoryCode'),
            'status' => $this->input->post('status')
        );
        
        $this->db->insert('categories', $data);
    }
    
    function delete_category(){
        $accountTypeSession = $this->session->userdata('account_type');
        $data['ids'] = $_POST["id"];

        if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
            foreach($data['ids'] as $id){
                $this->db->where("categoryID", $id);  
                $this->db->delete("categories");
            }
        } else{
            foreach($data['ids'] as $id){
                $data = array(
                    'status'  =>  'Disabled'
                );
    
                $this->db->where("categoryID", $id);  
                $this->db->update("categories", $data);
            }
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

    function restore_category(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Active'
            );

            $this->db->where("categoryID", $id);  
        $this->db->update("categories", $data);
        }
    }
}
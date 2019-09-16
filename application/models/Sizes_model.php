<?php
class sizes_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_sizes_inventory(){
        $query = $this->db->get_where('sizes', array('status' => 'Active'));
        return $query->result();
    }

    public function get_sizes(){
        $query = $this->db->get('sizes');
        return $query->result();
    }
    
    public function insert_size(){
        $data = array(
            'size' => $this->input->post('size'),
            'sizeCode' => $this->input->post('sizeCode'),
            'status' => $this->input->post('status')
        );
        
        $this->db->insert('sizes', $data);
    }
    
    function delete_size(){
        $accountTypeSession = $this->session->userdata('account_type');
        $data['ids'] = $_POST["id"];

        if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
            foreach($data['ids'] as $id){
                $this->db->where("sizeID", $id);  
                $this->db->delete("sizes");
            }
        } else{
            foreach($data['ids'] as $id){
                $data = array(
                    'status'  =>  'Disabled'
                );
    
                $this->db->where("sizeID", $id);  
                $this->db->update("sizes", $data);
            }
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

    function restore_size(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $data = array(
                'status'  =>  'Active'
            );

            $this->db->where("sizeID", $id);  
            $this->db->update("sizes", $data);
        }
    }
}
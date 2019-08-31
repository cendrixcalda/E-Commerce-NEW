<?php
class Archives_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_archives(){
        $query = $this->db->get('itemsArchive');
        return $query->result();
    }
    
    function delete_archive(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where("itemID", $id);  
            $this->db->delete("itemsArchive");
        }
    }

    function restore_archive(){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $query = $this->db->get_where('itemsArchive', array('itemID' => $id));
            foreach ($query->result() as $row) {
                $this->db->insert('items', $row);
            }

            $this->db->where("itemID", $id);  
            $this->db->delete("itemsArchive");
        }
    }
}
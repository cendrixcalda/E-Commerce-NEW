<?php
class Archives_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_archives($archiveTableName){
        $query = $this->db->get($archiveTableName);
        return $query->result();
    }
    
    function delete_archive($archiveTableName, $idName){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $this->db->where($idName, $id);  
            $this->db->delete($archiveTableName);
        }
    }

    function restore_archive($archiveTableName, $idName, $mainTableName){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $query = $this->db->get_where($archiveTableName, array($idName => $id));
            foreach ($query->result() as $row) {
                $this->db->insert($mainTableName, $row);
            }

            $this->db->where($idName, $id);  
            $this->db->delete($archiveTableName);
        }
    }

    function delete_order_details_archive($archiveTableName, $idName){
        $data['ids'] = $_POST["id"];
        foreach($data['ids'] as $id){
            $query = $this->db->get_where('ordersArchive', array('orderID' => $id));
            foreach ($query->result() as $row) {
                $orderNumber = $row->orderNumber;
            }

            $this->db->where($idName, $orderNumber);  
            $this->db->delete($archiveTableName);
        }
    }

    function restore_order_details_archive($archiveTableName, $idName, $mainTableName){
        $data['ids'] = $_POST["id"];
        
        foreach($data['ids'] as $id){
            $query = $this->db->get_where('ordersArchive', array('orderID' => $id));
            foreach ($query->result() as $row) {
                $orderNumber = $row->orderNumber;
            }

            $query = $this->db->get_where($archiveTableName, array($idName => $orderNumber));
            foreach ($query->result() as $row) {
                $this->db->insert($mainTableName, $row);
            }

            $this->db->where($idName, $orderNumber);  
            $this->db->delete($archiveTableName);
        }
    }
}
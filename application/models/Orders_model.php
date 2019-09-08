<?php
    class Orders_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_orders(){
            $query = $this->db->get('orders');
            return $query->result();
        }
        
        function delete_order(){
            $data['ids'] = $_POST["id"];

            foreach($data['ids'] as $id){
                $query = $this->db->get_where('orders', array('orderID' => $id));
                foreach ($query->result() as $row) {
                    $this->db->insert('ordersArchive',$row);
                }
    
                $this->db->where("orderID", $id);  
                $this->db->delete("orders");

                //delete associated order details
                $orderNumber = $row->orderNumber;

                $query = $this->db->get_where('orderDetails', array('orderNumber' => $orderNumber));
                foreach ($query->result() as $row) {
                    $this->db->insert('orderDetailsArchive',$row);
                }
    
                $this->db->where("orderNumber", $orderNumber);  
                $this->db->delete("orderDetails");
            }
        }

        public function update_order_status($data){
            $newData = array(
                'status' => $data['status']
            );
            $this->db->where("orderNumber", $data['orderNumber']);  
            $this->db->update("orders", $newData);
        }
    }
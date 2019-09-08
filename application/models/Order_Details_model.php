<?php
    class Order_Details_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_order_details(){
            $query = $this->db->get('orderDetails');
            return $query->result();
        }
        
        function update_order_details($dateColumn, $dateValue){
            $id = $_POST["id"];
            if($dateValue != '0000-00-00 00:00:00'){
                $data = array(
                    $_POST["column"]  =>  $_POST["value"],
                    $dateColumn => $dateValue
    
                );
            } else{
                $data = array(
                    $_POST["column"]  =>  $_POST["value"],
                    'dateInTransit' => '0000-00-00 00:00:00',
                    'dateDelivered' => '0000-00-00 00:00:00'
    
                );
            }
            
            $this->db->where("orderDetailID", $id);  
            $this->db->update("orderDetails", $data);
        }

        public function check_order_number_completed(){
            $id = $_POST["id"];
            //get order number of order details to be updated
            $query = $this->db->get_where('orderDetails', array('orderDetailID' => $id));
            foreach ($query->result() as $row) {
                $orderNumber = $row->orderNumber;
            }

            //get all order details with similar order numbers
            $query = $this->db->get_where('orderDetails', array('orderNumber' => $orderNumber));
            $orderStatus = '';
            foreach ($query->result() as $row) {
                $status = $row->status;
                if($status == 'Pending' || $status == 'In Transit'){
                    $orderStatus = 'Incomplete';
                    $data = array(
                        'status' => $orderStatus,
                        'orderNumber' => $orderNumber
                    );
                    return $data;
                } elseif($status == 'Delivered'){
                    $orderStatus = 'Completed';
                }

            }
            $data = array(
                'status' => $orderStatus,
                'orderNumber' => $orderNumber
            );
            return $data;
        }
    }
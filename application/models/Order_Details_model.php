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

        public function get_affected_order_details(){
            $data['ids'] = $this->input->post('id');
            $column =  $this->input->post('column');
            $row = 0;
    
            foreach($data['ids'] as $id){
                $row += $this->db->where($column, $id)->count_all_results('orderDetails');
            }
            return $row;
        }

        public function get_all_time_items_sold(){
            $itemsSold = $this->db->where('status', 'Delivered')->count_all_results('orderDetails');
            $itemsSoldArchived = $this->db->where('status', 'Delivered')->count_all_results('orderDetailsArchive');
            $result = $itemsSold + $itemsSoldArchived;
            return $result;
        }

        public function get_all_time_revenue(){
            $this->db->select_sum('totalPrice');
            $query = $this->db->get_where('orderDetails', array('status' => 'Delivered'));
            $revenue =  $query->row()->totalPrice;

            $this->db->select_sum('totalPrice');
            $query1 = $this->db->get_where('orderDetailsArchive', array('status' => 'Delivered'));
            $revenueArchive =  $query1->row()->totalPrice;

            $totalRevenue = $revenue + $revenueArchive;
            return $totalRevenue;
        }

        public function get_monthly_revenue(){
            $result = array();
            for($i = 1; $i < 13; $i++){
                $year = "YEAR(dateDelivered) = ".date('Y');
                $month = "MONTH(dateDelivered) = '".$i."'";

                $this->db->select_sum('totalPrice');
                $query = $this->db->where($year)->where($month)->where('status', 'Delivered')->get('orderDetails');
                $monthlyRevenue =  $query->row()->totalPrice;

                $this->db->select_sum('totalPrice');
                $query1 = $this->db->where($year)->where($month)->where('status', 'Delivered')->get('orderDetailsArchive');
                $MonthlyRevenueArchive =  $query1->row()->totalPrice;

                $totalMonthlyrevenue = $monthlyRevenue + $MonthlyRevenueArchive;
                $result[] = $totalMonthlyrevenue;
            }

            $output = array(
                "data"  => $result
            );

            return $output;
        }
    }
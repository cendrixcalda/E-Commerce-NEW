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

        public function get_affected_orders(){
            $data['ids'] = $this->input->post('id');
            $column =  $this->input->post('column');
            $row = 0;
    
            foreach($data['ids'] as $id){
                $row += $this->db->where($column, $id)->count_all_results('orders');
            }
            return $row;
        }

        public function get_all_time_orders(){
            $orders = $this->db->count_all_results('orders');
            $ordersArchived = $this->db->count_all_results('ordersArchive');
            $result = $orders + $ordersArchived;
            return $result;
        }

        public function get_monthly_orders(){
            $total = array();
            $incomplete = array();
            $completed = array();
            $cancelled = array();
            $refunded = array();
            for($i = 1; $i < 13; $i++){
                $year = "YEAR(orderDate) = ".date('Y');
                $month = "MONTH(orderDate) = '".$i."'";

                $this->db->select_sum('grandUnit');

                $monthlyOrders = $this->db->where($year)->where($month)->count_all_results('orders');
                $MonthlyOrdersArchive = $this->db->where($year)->where($month)->count_all_results('ordersArchive');
                $totalMonthlyOrders = $monthlyOrders + $MonthlyOrdersArchive;
                $total[] = $totalMonthlyOrders;

                $monthlyOrdersIncomplete = $this->db->where($year)->where($month)->where('status', 'Incomplete')->count_all_results('orders');
                $MonthlyOrdersIncompleteArchive = $this->db->where($year)->where($month)->where('status', 'Incomplete')->count_all_results('ordersArchive');
                $totalMonthlyOrdersIncomplete = $monthlyOrdersIncomplete + $MonthlyOrdersIncompleteArchive;
                $incomplete[] = $totalMonthlyOrdersIncomplete;

                $monthlyOrdersCompleted = $this->db->where($year)->where($month)->where('status', 'Completed')->count_all_results('orders');
                $MonthlyOrdersCompletedArchive = $this->db->where($year)->where($month)->where('status', 'Completed')->count_all_results('ordersArchive');
                $totalMonthlyOrdersCompleted = $monthlyOrdersCompleted + $MonthlyOrdersCompletedArchive;
                $completed[] = $totalMonthlyOrdersCompleted;

                $monthlyOrdersCancelled = $this->db->where($year)->where($month)->where('status', 'Cancelled')->count_all_results('orders');
                $MonthlyOrdersCancelledArchive = $this->db->where($year)->where($month)->where('status', 'Cancelled')->count_all_results('ordersArchive');
                $totalMonthlyOrdersCancelled = $monthlyOrdersCancelled + $MonthlyOrdersCancelledArchive;
                $cancelled[] = $totalMonthlyOrdersCancelled;

                $monthlyOrdersRefunded = $this->db->where($year)->where($month)->where('status', 'Refunded')->count_all_results('orders');
                $MonthlyOrdersRefundedArchive = $this->db->where($year)->where($month)->where('status', 'Refunded')->count_all_results('ordersArchive');
                $totalMonthlyOrdersRefunded = $monthlyOrdersRefunded + $MonthlyOrdersRefundedArchive;
                $refunded[] = $totalMonthlyOrdersRefunded;
            }

            $output = array(
                "total"  => $total,
                "incomplete"  => $incomplete,
                "completed"  => $completed,
                "cancelled"  => $cancelled,
                "refunded"  => $refunded,
            );

            return $output;
        }
    }
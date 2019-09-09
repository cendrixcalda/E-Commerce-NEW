<?php
    class OrdersArchive extends CI_Controller{
        public $archiveTableName = 'ordersArchive';
        public $mainTableName = 'orders';
        public $idName = 'orderID';
    
        public function showAllOrdersArchive(){
            if(isset($_POST["checker"])){
                
                $result = $this->archives_model->get_all_archives($this->archiveTableName);
                
                $data = array();
                
                $rowCount = 2;
                foreach($result as $row){

                    $dateTime = $row->orderDate;
                    $newDateTime = new DateTime($dateTime);
                    $date = $newDateTime->format('Y-m-d');
                    $time = $newDateTime->format('h:i a');
                    
                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->orderID.'" id="tableDefaultCheck'.$rowCount.'">
                    <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                    </div></td>';
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/orderdetailsarchive/'.$row->orderNumber.'"><u>'.$row->orderNumber.'</u></a></div>';
                    $sub_array[] = '<div class="editable">'.$row->grandUnit.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->grandPrice.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->paymentMethod.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->shippingAddress.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->contactNumber.'</div>';
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/customers/'.$row->customerID.'"><u>'.$row->customerID.'</u></a></div>';
                    $sub_array[] = '<div class="editable">'.$date.'</div>';
                    $sub_array[] = '<div class="editable">'.$time.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->status.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->orderID.'"><i class="fas fa-trash"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="restore" id="'.$row->orderID.'"><i class="fas fa-trash-restore"></i></button></div>';
                    $data[] = $sub_array;
                    $rowCount++;
                }
                
                $output = array(
                    "data"  => $data
                );
                
                echo json_encode($output);
            } else{
                redirect('/admin');
            }
        }

        function deleteOrderArchive(){
            if(isset($_POST["id"])){
                //delete associated order details archive
                $archiveTableName = 'orderDetailsArchive';
                $idName = 'orderNumber';
                $this->archives_model->delete_order_details_archive($archiveTableName, $idName);

                //delete order archive
                $this->archives_model->delete_archive($this->archiveTableName, $this->idName);
            } else{
                redirect('/admin');
            }
        }
    
        function restoreOrderArchive(){
            if(isset($_POST["id"])){
                //restore associated order details archive
                $archiveTableName = 'orderDetailsArchive';
                $mainTableName = 'orderDetails';
                $idName = 'orderNumber';
                $this->archives_model->restore_order_details_archive($archiveTableName, $idName, $mainTableName);
                
                //restore order archive
                $this->archives_model->restore_archive($this->archiveTableName, $this->idName, $this->mainTableName);
                
                
            } else{
                redirect('/admin');
            }
        }
    }
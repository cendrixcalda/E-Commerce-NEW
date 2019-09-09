<?php
    class Orders extends CI_Controller{
    
        public function showAllOrders(){
            if(isset($_POST["checker"])){
                
                $result = $this->orders_model->get_all_orders();
                
                $data = array();
                
                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $noneSelected = ($status == 'Incomplete') ? 'disabled' : '' ;
                    $noneCheckbox = ($status == 'Incomplete')  ? 'not-checkbox' : 'checkbox' ;

                    $disableDelete = ($status == 'Incomplete')  ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($status == 'Incomplete')  ? 'disabled-delete' : 'delete' ;

                    $dateTime = $row->orderDate;
                    $newDateTime = new DateTime($dateTime);
                    $date = $newDateTime->format('Y-m-d');
                    $time = $newDateTime->format('h:i a');
                    
                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                    <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->orderID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                    <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                    </div></td>';
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/orderdetails/'.$row->orderNumber.'"><u>'.$row->orderNumber.'</u></a></div>';
                    $sub_array[] = '<div class="editable">'.$row->grandUnit.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->grandPrice.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->paymentMethod.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->shippingAddress.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->contactNumber.'</div>';
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/customers/'.$row->customerID.'"><u>'.$row->customerID.'</u></a></div>';
                    $sub_array[] = '<div class="editable">'.$date.'</div>';
                    $sub_array[] = '<div class="editable">'.$time.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->status.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->orderID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="disabled-restore" id="'.$row->orderID.'"><i class="fas fa-trash-restore fa-disabled"></i></button></div>';
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

        function deleteOrder(){
            if(isset($_POST["id"])){
                $this->orders_model->delete_order();
            } else{
                redirect('/admin');
            }
        }

        public function getAffectedOrders(){
            if(isset($_POST["id"])){
                $affectedOrders = $this->orders_model->get_affected_orders();
                echo $affectedOrders;
            } else{
                redirect('/admin');
            }
        }
    }
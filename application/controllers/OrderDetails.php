<?php
    class OrderDetails extends CI_Controller{
    
        public function showAllOrderDetails(){
            if(isset($_POST["checker"])){
                
                $result = $this->order_details_model->get_all_order_details();
                
                $data = array();
                
                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $noneSelected = ($status == 'Cancelled') ? 'selected' : '' ;
                    $pendingSelected = ($status == 'Pending') ? 'selected' : '' ;
                    $intransitSelected = ($status == 'In Transit') ? 'selected' : '' ;
                    $deliveredSelected = ($status == 'Delivered') ? 'selected' : '' ;
                    $disableInTransit = ($status == 'Delivered') ? 'disabled' : '' ;
                    $disableDelivered = ($status == 'In Transit' || $status == 'Delivered') ? '' : 'disabled' ;
                    $cancelled = ($status == 'Cancelled') ? 'disabled' : '' ;
                    $cancelled1 = ($status != 'Cancelled') ? 'disabled' : '' ;

                    $dateTimeInTransit = $row->dateInTransit;
                    $dateTimeDelivered = $row->dateDelivered;
                    $dateTimeCancelled = $row->dateCancelled;
                    $newDateTimeInTransit = new DateTime($dateTimeInTransit);
                    $newDateTimeDelivered = new DateTime($dateTimeDelivered);
                    $newDateTimeCancelled = new DateTime($dateTimeCancelled);

                    $dateInTransit = ($dateTimeInTransit == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeInTransit->format('Y-m-d') ;
                    $timeInTransit = ($dateTimeInTransit == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeInTransit->format('h:i a') ;

                    $dateDelivered = ($dateTimeDelivered == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeDelivered->format('Y-m-d') ;
                    $timeDelivered = ($dateTimeDelivered == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeDelivered->format('h:i a') ;
                    
                    $dateCancelled = ($dateTimeCancelled == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeCancelled->format('Y-m-d') ;
                    $timeCancelled = ($dateTimeCancelled == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeCancelled->format('h:i a') ;
                    
                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                    <input type="checkbox" class="custom-control-input not-checkbox" data-id="'.$row->orderDetailID.'" id="tableDefaultCheck'.$rowCount.'" disabled>
                    <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                    </div></td>';
                    $sub_array[] = '<div class="editable">'.$row->orderDetailID.'</div>';
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/orders/'.$row->orderNumber.'"><u>'.$row->orderNumber.'</u></a></div>';
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/inventory/'.$row->itemID.'"><u>'.$row->itemID.'</u></a></div>';
                    $sub_array[] = '<div class="editable">'.$row->unit.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->priceBought.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->voucherDiscount.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->totalPrice.'</div>';
                    $sub_array[] = '<div class="editable">'.$dateInTransit.'</div>';
                    $sub_array[] = '<div class="editable">'.$timeInTransit.'</div>';
                    $sub_array[] = '<div class="editable">'.$dateDelivered.'</div>';
                    $sub_array[] = '<div class="editable">'.$timeDelivered.'</div>';
                    $sub_array[] = '<div class="editable">'.$dateCancelled.'</div>';
                    $sub_array[] = '<div class="editable">'.$timeCancelled.'</div>';
                    $sub_array[] = '<select data-id="'.$row->orderDetailID.'" data-column="status" class="dropdown updateDropdown">
                                        <option '.$noneSelected.' value="Cancelled" '.$cancelled1.'>Cancelled</option>
                                        <option '.$pendingSelected.' value="Pending" '.$cancelled.'>Pending</option>
                                        <option '.$intransitSelected.' value="In Transit" '.$disableInTransit.' '.$cancelled.'>In Transit</option>
                                        <option '.$deliveredSelected.' value="Delivered" '.$disableDelivered.' '.$cancelled.'>Delivered</option>
                                    </select>';
                    $sub_array[] = '<div><button type="button" name="delete" class="disabled-delete" id="'.$row->orderDetailID.'"><i class="fas fa-trash fa-disabled"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="disabled-restore" id="'.$row->orderDetailID.'"><i class="fas fa-trash-restore fa-disabled"></i></button></div>';
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

        function updateOrderDetails(){
            if(isset($_POST["id"])){
                if($_POST["value"] == 'In Transit'){
                    $dateColumn = 'dateInTransit';
                    $dateValue = date('Y-m-d H:i:s');
                } elseif($_POST["value"] == 'Delivered'){
                    $dateColumn = 'dateDelivered';
                    $dateValue = date('Y-m-d H:i:s');
                } else{
                    $dateColumn = '';
                    $dateValue= '0000-00-00 00:00:00';
                }
                $this->order_details_model->update_order_details($dateColumn, $dateValue);
                $data = $this->order_details_model->check_order_number_completed();
                $this->orders_model->update_order_status($data);
            } else{
                redirect('/admin');
            }
        }

        public function getAffectedOrderDetails(){
            if(isset($_POST["id"])){
                $affectedOrderDetails = $this->order_details_model->get_affected_order_details();
                echo $affectedOrderDetails;
            } else{
                redirect('/admin');
            }
        }
    }
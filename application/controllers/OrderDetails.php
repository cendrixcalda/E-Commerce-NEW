<?php
    class OrderDetails extends CI_Controller{
    
        public function showAllOrderDetails(){
            if(isset($_POST["checker"])){
                
                $result = $this->order_details_model->get_all_order_details();
                
                $data = array();
                
                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $pendingSelected = ($status == 'Pending') ? 'selected' : '' ;
                    $intransitSelected = ($status == 'In Transit') ? 'selected' : '' ;
                    $deliveredSelected = ($status == 'Delivered') ? 'selected' : '' ;
                    $cancelledSelected = ($status == 'Cancelled') ? 'selected' : '' ;
                    $exchangedSelected = ($status == 'Exchanged') ? 'selected' : '' ;
                    $refundedSelected = ($status == 'Refunded') ? 'selected' : '' ;

                    $disableInTransit = ($status == 'Delivered') ? 'disabled' : '' ;
                    $disableDelivered = ($status == 'In Transit' || $status == 'Delivered') ? '' : 'disabled' ;
                    $disableCancelled = ($status != 'Cancelled') ? 'disabled' : '' ;
                    $disableExchanged = ($status != 'Exchanged') ? 'disabled' : '' ;
                    $disableRefunded = ($status != 'Refunded') ? 'disabled' : '' ;
                    $disableOptions = ($status == 'Cancelled' || $status == 'Exchanged' || $status == 'Refunded') ? 'disabled' : '' ;

                    $dateTimeInTransit = $row->dateInTransit;
                    $dateTimeDelivered = $row->dateDelivered;
                    $dateTimeCancelled = $row->dateCancelled;
                    $dateTimeExchanged = $row->dateExchanged;
                    $dateTimeRefunded = $row->dateRefunded;
                    $newDateTimeInTransit = new DateTime($dateTimeInTransit);
                    $newDateTimeDelivered = new DateTime($dateTimeDelivered);
                    $newDateTimeCancelled = new DateTime($dateTimeCancelled);
                    $newDateTimeExchanged = new DateTime($dateTimeExchanged);
                    $newDateTimeRefunded = new DateTime($dateTimeRefunded);

                    $dateInTransit = ($dateTimeInTransit == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeInTransit->format('Y-m-d') ;
                    $timeInTransit = ($dateTimeInTransit == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeInTransit->format('h:i a') ;

                    $dateDelivered = ($dateTimeDelivered == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeDelivered->format('Y-m-d') ;
                    $timeDelivered = ($dateTimeDelivered == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeDelivered->format('h:i a') ;
                    
                    $dateCancelled = ($dateTimeCancelled == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeCancelled->format('Y-m-d') ;
                    $timeCancelled = ($dateTimeCancelled == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeCancelled->format('h:i a') ;
                    
                    $dateExchanged = ($dateTimeExchanged == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeExchanged->format('Y-m-d') ;
                    $timeExchanged = ($dateTimeExchanged == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeExchanged->format('h:i a') ;
                    
                    $dateRefunded = ($dateTimeRefunded == '0000-00-00 00:00:00') ? '0000-00-00' : $newDateTimeRefunded->format('Y-m-d') ;
                    $timeRefunded = ($dateTimeRefunded == '0000-00-00 00:00:00') ? '00:00 am' : $newDateTimeRefunded->format('h:i a') ;
                    
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
                    $sub_array[] = '<div class="editable">'.$dateExchanged.'</div>';
                    $sub_array[] = '<div class="editable">'.$timeExchanged.'</div>';
                    $sub_array[] = '<div class="editable">'.$dateRefunded.'</div>';
                    $sub_array[] = '<div class="editable">'.$timeRefunded.'</div>';
                    $sub_array[] = '<select data-id="'.$row->orderDetailID.'" data-column="status" class="dropdown updateDropdown">
                                        <option '.$pendingSelected.' value="Pending" '.$disableOptions.'>Pending</option>
                                        <option '.$intransitSelected.' value="In Transit" '.$disableInTransit.' '.$disableOptions.'>In Transit</option>
                                        <option '.$deliveredSelected.' value="Delivered" '.$disableDelivered.' '.$disableOptions.'>Delivered</option>
                                        <option '.$cancelledSelected.' value="Cancelled" '.$disableCancelled.'>Cancelled</option>
                                        <option '.$exchangedSelected.' value="Exchanged" '.$disableExchanged.'>Exchanged</option>
                                        <option '.$refundedSelected.' value="Refunded" '.$disableRefunded.'>Refunded</option>
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

        public function getItemsSoldAllTime(){
            $alltimeItemsSold = $this->order_details_model->get_all_time_items_sold();
            echo $alltimeItemsSold;
        }

        public function getRevenueAllTime(){
            $allTimeRevenue = $this->order_details_model->get_all_time_revenue();
            echo $allTimeRevenue;
        }

        public function getMonthlyRevenue(){
            $monthlyRevenue = $this->order_details_model->get_monthly_revenue();
            echo json_encode($monthlyRevenue);
        }
    }
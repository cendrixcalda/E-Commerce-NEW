<?php
    class OrderDetailsArchive extends CI_Controller{
        public $archiveTableName = 'orderDetailsArchive';
    
        public function showAllOrderDetailsArchive(){
            if(isset($_POST["checker"])){
                
                $result = $this->archives_model->get_all_archives($this->archiveTableName);
                
                $data = array();
                
                $rowCount = 2;
                foreach($result as $row){
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
                    $sub_array[] = '<div class="editable"><a href="'.base_url().'admin/ordersarchive/'.$row->orderNumber.'"><u>'.$row->orderNumber.'</u></a></div>';
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
                    $sub_array[] = '<div class="editable">'.$row->status.'</div>';
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
    }
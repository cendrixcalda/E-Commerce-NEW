<?php
    class CustomersArchive extends CI_Controller{
        public $archiveTableName = 'customersArchive';
        public $mainTableName = 'customers';
        public $idName = 'customerID';
    
        public function showAllCustomersArchive(){
            if(isset($_POST["checker"])){
                
                $result = $this->archives_model->get_all_archives($this->archiveTableName);
                
                $data = array();
                
                $rowCount = 2;
                foreach($result as $row){

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->customerID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable">'.$row->customerID.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->firstname.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->lastname.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->password.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->email.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->status.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->customerID.'"><i class="fas fa-trash"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="restore" id="'.$row->customerID.'"><i class="fas fa-trash-restore"></i></button></div>';
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

        function deleteCustomerArchive(){
            if(isset($_POST["id"])){
                $this->archives_model->delete_archive($this->archiveTableName, $this->idName);
            } else{
                redirect('/admin');
            }
        }
    
        function restoreCustomerArchive(){
            if(isset($_POST["id"])){
                $this->archives_model->restore_archive($this->archiveTableName, $this->idName, $this->mainTableName);
                
                
            } else{
                redirect('/admin');
            }
        }
    }
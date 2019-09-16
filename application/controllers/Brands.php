<?php
    class Brands extends CI_Controller{
        public function showAllBrands(){
            if(isset($_POST["checker"])){
                $accountTypeSession = $this->session->userdata('account_type');
                
                if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                    $result = $this->brands_model->get_brands();
                } else{
                    $result = $this->brands_model->get_brands_inventory();
                }
                
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $brand = $row->brand;
                    $noneSelected = ($brand == 'None' || ($status == 'Active' && $accountTypeSession == 'Administrator')) ? 'disabled' : '' ;
                    $noneNotSelected = ($brand == 'None') ? '' : 'contenteditable' ;
                    $noneCheckbox = ($brand == 'None' || ($status == 'Active' && $accountTypeSession == 'Administrator')) ? 'not-checkbox' : 'checkbox' ;
                    
                    $disableRestore = ($accountTypeSession == 'User' || $brand == 'None' || $status == 'Active') ? 'fa-disabled' : '' ;
                    $disableRestore1 = ($accountTypeSession == 'User' || $brand == 'None' || $status == 'Active') ? 'disabled-restore' : 'restore' ;
                    $disableDelete = ($brand == 'None' || (($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator') && $status == 'Active')) ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($brand == 'None' || (($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator') && $status == 'Active')) ? 'disabled-delete' : 'delete' ;

                    $sub_array = array();
                    $sub_array[] = '<tr><td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->brandID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<td><div class="editable" data-column="brandID">'.$row->brandID.'</div>';
                    $sub_array[] = '<td><div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->brandID.'" data-column="brand">'.$row->brand.'</div>';
                    if($accountTypeSession != 'User'){
                        $sub_array[] = '<td><div class="editable status" data-column="status">'.$row->status.'</div>';
                    }
                    $sub_array[] = '<td><div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->brandID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<td><div><button type="button" name="restore" class="'.$disableRestore1.'" id="'.$row->brandID.'"><i class="fas fa-trash-restore '.$disableRestore.'"></i></button></div></td></tr>';
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

        public function addBrand(){
            if(isset($_POST['brand'])){
                $this->brands_model->insert_brand();
            } else{
                redirect('/admin');
            }
        }

        function deleteBrand(){
            if(isset($_POST["id"])){
                $this->brands_model->delete_brand();
            } else{
                redirect('/admin');
            }
        }

        function updateBrand(){
            if(isset($_POST["id"])){
                $this->brands_model->update_brand();
            } else{
                redirect('/admin');
            }
        }

        function restoreBrand(){
            if(isset($_POST["id"])){
                $this->brands_model->restore_brand();
            } else{
                redirect('/admin');
            }
        }
    }
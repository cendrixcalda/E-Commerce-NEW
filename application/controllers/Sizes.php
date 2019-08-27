<?php
    class Sizes extends CI_Controller{
        public function showAllSizes(){
            if(isset($_POST["checker"])){
                $accountTypeSession = $this->session->userdata('account_type');
                
                if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                    $result = $this->sizes_model->get_sizes();
                } else{
                    $result = $this->sizes_model->get_sizes_inventory();
                }

                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $size = $row->size;
                    $noneSelected = ($size == 'None') ? 'disabled' : '' ;
                    $noneNotSelected = ($size == 'None') ? '' : 'contenteditable' ;
                    $noneCheckbox = ($size == 'None') ? 'not-checkbox' : 'checkbox' ;

                    $disableRestore = ($accountTypeSession == 'User' || $size == 'None') ? 'fa-disabled' : '' ;
                    $disableRestore1 = ($accountTypeSession == 'User' || $size == 'None') ? 'disabled-restore' : 'restore' ;
                    $disableDelete = ($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator' || $size == 'None') ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator' || $size == 'None') ? 'disabled-delete' : 'delete' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->sizeID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="sizeID">'.$row->sizeID.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->sizeID.'" data-column="size">'.$row->size.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->sizeID.'" data-column="sizeCode">'.$row->sizeCode.'</div>';
                    if($accountTypeSession != 'User'){
                        $sub_array[] = '<div class="editable" data-column="status">'.$row->status.'</div>';
                    }
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->sizeID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="'.$disableRestore1.'" id="'.$row->sizeID.'"><i class="fas fa-trash-restore '.$disableRestore.'"></i></button></div>';
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

        public function addSize(){
            if(isset($_POST['size'])){
                $this->sizes_model->insert_size();
            } else{
                redirect('/admin');
            }
        }

        function deleteSize(){
            if(isset($_POST["id"])){
                $this->sizes_model->delete_size();
            } else{
                redirect('/admin');
            }
        }

        function updateSize(){
            if(isset($_POST["id"])){
                $this->sizes_model->update_size();
            } else{
                redirect('/admin');
            }
        }

        function restoreSize(){
            if(isset($_POST["id"])){
                $this->sizes_model->restore_size();
            } else{
                redirect('/admin');
            }
        }
    }
<?php
    class Colors extends CI_Controller{
        public function showAllColors(){
            if(isset($_POST["checker"])){
                $accountTypeSession = $this->session->userdata('account_type');
                
                if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                    $result = $this->colors_model->get_colors();
                } else{
                    $result = $this->colors_model->get_colors_inventory();
                }

                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $color = $row->color;
                    $noneSelected = ($color == 'None') ? 'disabled' : '' ;
                    $noneNotSelected = ($color == 'None') ? '' : 'contenteditable' ;
                    $noneCheckbox = ($color == 'None') ? 'not-checkbox' : 'checkbox' ;

                    $disableRestore = ($accountTypeSession == 'User' || $color == 'None') ? 'fa-disabled' : '' ;
                    $disableRestore1 = ($accountTypeSession == 'User' || $color == 'None') ? 'disabled-restore' : 'restore' ;
                    $disableDelete = ($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator' || $color == 'None') ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator' || $color == 'None') ? 'disabled-delete' : 'delete' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'"" data-id="'.$row->colorID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="colorID">'.$row->colorID.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->colorID.'" data-column="color">'.$row->color.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->colorID.'" data-column="colorCode">'.$row->colorCode.'</div>';
                    if($accountTypeSession != 'User'){
                        $sub_array[] = '<div class="editable" data-column="status">'.$row->status.'</div>';
                    }
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->colorID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="'.$disableRestore1.'" id="'.$row->colorID.'"><i class="fas fa-trash-restore '.$disableRestore.'"></i></button></div>';
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

        public function addColor(){
            if(isset($_POST['color'])){
                $this->colors_model->insert_color();
            } else{
                redirect('/admin');
            }
        }

        function deleteColor(){
            if(isset($_POST["id"])){
                $this->colors_model->delete_color();
            } else{
                redirect('/admin');
            }
        }

        function updateColor(){
            if(isset($_POST["id"])){
                $this->colors_model->update_color();
            } else{
                redirect('/admin');
            }
        }

        function restoreColor(){
            if(isset($_POST["id"])){
                $this->colors_model->restore_color();
            } else{
                redirect('/admin');
            }
        }
    }
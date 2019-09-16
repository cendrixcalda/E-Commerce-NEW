<?php
    class Materials extends CI_Controller{
        public function showAllMaterials(){
            if(isset($_POST["checker"])){
                $accountTypeSession = $this->session->userdata('account_type');
                
                if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                    $result = $this->materials_model->get_materials();
                } else{
                    $result = $this->materials_model->get_materials_inventory();
                }
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $material = $row->material;
                    $noneSelected = ($material == 'None' || ($status == 'Active' && $accountTypeSession == 'Administrator')) ? 'disabled' : '' ;
                    $noneNotSelected = ($material == 'None') ? '' : 'contenteditable' ;
                    $noneCheckbox = ($material == 'None' || ($status == 'Active' && $accountTypeSession == 'Administrator')) ? 'not-checkbox' : 'checkbox' ;

                    $disableRestore = ($accountTypeSession == 'User' || $material == 'None' || $status == 'Active') ? 'fa-disabled' : '' ;
                    $disableRestore1 = ($accountTypeSession == 'User' || $material == 'None' || $status == 'Active') ? 'disabled-restore' : 'restore' ;
                    $disableDelete = ($material == 'None' || (($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator') && $status == 'Active')) ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($material == 'None' || (($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator') && $status == 'Active')) ? 'disabled-delete' : 'delete' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->materialID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="materialID">'.$row->materialID.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->materialID.'" data-column="material">'.$row->material.'</div>';
                    if($accountTypeSession != 'User'){
                        $sub_array[] = '<div class="editable" data-column="status">'.$row->status.'</div>';
                    }
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->materialID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="'.$disableRestore1.'" id="'.$row->materialID.'"><i class="fas fa-trash-restore '.$disableRestore.'"></i></button></div>';
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

        public function addMaterial(){
            if(isset($_POST['material'])){
                $this->materials_model->insert_material();
            } else{
                redirect('/admin');
            }
        }

        function deleteMaterial(){
            if(isset($_POST["id"])){
                $this->materials_model->delete_material();
            } else{
                redirect('/admin');
            }
        }

        function updateMaterial(){
            if(isset($_POST["id"])){
                $this->materials_model->update_material();
            } else{
                redirect('/admin');
            }
        }

        function restoreMaterial(){
            if(isset($_POST["id"])){
                $this->materials_model->restore_material();
            } else{
                redirect('/admin');
            }
        }
    }
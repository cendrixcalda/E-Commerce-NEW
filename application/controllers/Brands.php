<?php
    class Brands extends CI_Controller{
        public function showAllBrands(){
            if(isset($_POST["checker"])){
                $result = $this->brands_model->get_brands();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $brand = $row->brand;
                    $noneSelected = ($brand == 'None') ? 'disabled' : '' ;
                    $noneNotSelected = ($brand == 'None') ? '' : 'contenteditable' ;

                    $status = $row->status;
                    $activeSelected = ($status == 'Active') ? 'selected' : '' ;
                    $disabledSelected = ($status == 'Disabled') ? 'selected' : '' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->brandID.'" id="tableDefaultCheck'.$rowCount.'" disabled>
                                        <label class="custom-control-label fa-disabled" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="brandID">'.$row->brandID.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->brandID.'" data-column="brand">'.$row->brand.'</div>';
                    $sub_array[] = '<select data-id="'.$row->brandID.'" data-column="status" class="dropdown updateDropdown" '.$noneSelected.'>
                                    <option '.$activeSelected.' value="Active">Active</option>
                                    <option '.$disabledSelected.' value="Disabled">Disabled</option>
                                    </select>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->brandID.'"><i class="fas fa-trash fa-disabled"></i></button>';
                    $sub_array[] = '<div><button type="button" name="duplicate" class="duplicate" id="'.$row->brandID.'"><i class="fa fa-clone fa-disabled"></i></button></div>';
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

        function deleteAllBrand(){
            if(isset($_POST["id"])){
                $this->brands_model->delete_all_brand();
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
    }
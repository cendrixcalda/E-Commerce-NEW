<?php
    class Materials extends CI_Controller{
        public function showAllMaterials(){
            if(isset($_POST["checker"])){
                $result = $this->materials_model->get_materials();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->materialID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="materialID">'.$row->materialID.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->materialID.'" data-column="material">'.$row->material.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->materialID.'"><i class="fas fa-trash"></i></button></div>';
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

        function deleteAllMaterial(){
            if(isset($_POST["id"])){
                $this->materials_model->delete_all_material();
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
    }
<?php
    class Colors extends CI_Controller{
        public function showAllColors(){
            if(isset($_POST["checker"])){
                $result = $this->colors_model->get_colors();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->colorID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="colorID">'.$row->colorID.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->colorID.'" data-column="color">'.$row->color.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->colorID.'"><i class="fas fa-trash"></i></button></div>';
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

        function deleteAllColor(){
            if(isset($_POST["id"])){
                $this->colors_model->delete_all_color();
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
    }
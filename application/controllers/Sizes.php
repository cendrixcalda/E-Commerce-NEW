<?php
    class Sizes extends CI_Controller{
        public function showAllSizes(){
            if(isset($_POST["checker"])){
                $result = $this->sizes_model->get_sizes();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->sizeID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="sizeID">'.$row->sizeID.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->sizeID.'" data-column="size">'.$row->size.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->sizeID.'"><i class="fas fa-trash"></i></button></div>';
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

        function deleteAllSize(){
            if(isset($_POST["id"])){
                $this->sizes_model->delete_all_size();
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
    }
<?php
    class Categories extends CI_Controller{
        public function showAllCategories(){
            if(isset($_POST["checker"])){
                $result = $this->categories_model->get_categories();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->categoryID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="categoryID">'.$row->categoryID.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->categoryID.'" data-column="category">'.$row->category.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->categoryID.'"><i class="fas fa-trash"></i></button></div>';
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

        public function addCategory(){
            if(isset($_POST['category'])){
                $this->categories_model->insert_category();
            } else{
                redirect('/admin');
            }
        }

        function deleteCategory(){
            if(isset($_POST["id"])){
                $this->categories_model->delete_category();
            } else{
                redirect('/admin');
            }
        }

        function deleteAllCategory(){
            if(isset($_POST["id"])){
                $this->categories_model->delete_all_category();
            } else{
                redirect('/admin');
            }
        }

        function updateCategory(){
            if(isset($_POST["id"])){
                $this->categories_model->update_category();
            } else{
                redirect('/admin');
            }
        }
    }
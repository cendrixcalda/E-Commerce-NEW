<?php
    class Categories extends CI_Controller{
        public function showAllCategories(){
            if(isset($_POST["checker"])){
                $accountTypeSession = $this->session->userdata('account_type');
                
                if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                    $result = $this->categories_model->get_categories();
                } else{
                    $result = $this->categories_model->get_categories_inventory();
                }
                
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $category = $row->category;
                    $noneSelected = ($category == 'None' || ($status == 'Active' && $accountTypeSession == 'Administrator')) ? 'disabled' : '' ;
                    $noneNotSelected = ($category == 'None') ? '' : 'contenteditable' ;
                    $noneCheckbox = ($category == 'None' || ($status == 'Active' && $accountTypeSession == 'Administrator')) ? 'not-checkbox' : 'checkbox' ;

                    $disableRestore = ($accountTypeSession == 'User' || $category == 'None' || $status == 'Active') ? 'fa-disabled' : '' ;
                    $disableRestore1 = ($accountTypeSession == 'User' || $category == 'None' || $status == 'Active') ? 'disabled-restore' : 'restore' ;
                    $disableDelete = ($category == 'None' || (($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator') && $status == 'Active')) ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($category == 'None' || (($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator') && $status == 'Active')) ? 'disabled-delete' : 'delete' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->categoryID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="categoryID">'.$row->categoryID.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->categoryID.'" data-column="category">'.$row->category.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->categoryID.'" data-column="categoryCode">'.$row->categoryCode.'</div>';
                    if($accountTypeSession != 'User'){
                        $sub_array[] = '<div class="editable" data-column="status">'.$row->status.'</div>';
                    }
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->categoryID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="'.$disableRestore1.'" id="'.$row->categoryID.'"><i class="fas fa-trash-restore '.$disableRestore.'"></i></button></div>';
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

        function updateCategory(){
            if(isset($_POST["id"])){
                $this->categories_model->update_category();
            } else{
                redirect('/admin');
            }
        }

        function restoreCategory(){
            if(isset($_POST["id"])){
                $this->categories_model->restore_category();
            } else{
                redirect('/admin');
            }
        }
    }
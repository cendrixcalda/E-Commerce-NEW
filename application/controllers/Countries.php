<?php
    class Countries extends CI_Controller{
        public function showAllCountries(){
            if(isset($_POST["checker"])){
                $accountTypeSession = $this->session->userdata('account_type');
                
                if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                    $result = $this->countries_model->get_countries();
                } else{
                    $result = $this->countries_model->get_countries_inventory();
                }
                
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $country = $row->country;
                    $noneSelected = ($country == 'None') ? 'disabled' : '' ;
                    $noneNotSelected = ($country == 'None') ? '' : 'contenteditable' ;
                    $noneCheckbox = ($country == 'None') ? 'not-checkbox' : 'checkbox' ;

                    $disableRestore = ($accountTypeSession == 'User' || $country == 'None') ? 'fa-disabled' : '' ;
                    $disableRestore1 = ($accountTypeSession == 'User' || $country == 'None') ? 'disabled-restore' : 'restore' ;
                    $disableDelete = ($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator' || $country == 'None') ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator' || $country == 'None') ? 'disabled-delete' : 'delete' ;


                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->countryID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="countryID">'.$row->countryID.'</div>';
                    $sub_array[] = '<div '.$noneNotSelected.' spellcheck="false" class="editable update" data-id="'.$row->countryID.'" data-column="country">'.$row->country.'</div>';
                    if($accountTypeSession != 'User'){
                        $sub_array[] = '<div class="editable" data-column="status">'.$row->status.'</div>';
                    }
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->countryID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button></div>';
                    $sub_array[] = '<div><button type="button" name="restore" class="'.$disableRestore1.'" id="'.$row->countryID.'"><i class="fas fa-trash-restore '.$disableRestore.'"></i></button></div>';
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

        public function addCountry(){
            if(isset($_POST['country'])){
                $this->countries_model->insert_country();
            } else{
                redirect('/admin');
            }
        }

        function deleteCountry(){
            if(isset($_POST["id"])){
                $this->countries_model->delete_country();
            } else{
                redirect('/admin');
            }
        }

        function updateCountry(){
            if(isset($_POST["id"])){
                $this->countries_model->update_country();
            } else{
                redirect('/admin');
            }
        }

        function restoreCountry(){
            if(isset($_POST["id"])){
                $this->countries_model->restore_country();
            } else{
                redirect('/admin');
            }
        }
    }
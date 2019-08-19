<?php
    class Countries extends CI_Controller{
        public function showAllCountries(){
            if(isset($_POST["checker"])){
                $result = $this->countries_model->get_countries();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->countryID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="countryID">'.$row->countryID.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->countryID.'" data-column="country">'.$row->country.'</div>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->countryID.'"><i class="fas fa-trash"></i></button></div>';
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

        function deleteAllCountry(){
            if(isset($_POST["id"])){
                $this->countries_model->delete_all_country();
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
    }
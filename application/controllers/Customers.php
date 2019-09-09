<?php
    class Customers extends CI_Controller{

        public function showAllCustomers(){
            if(isset($_POST["checker"])){
                $result = $this->customers_model->get_all_customers();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $status = $row->status;
                    $forgottenSelected = ($status == 'Forgotten') ? 'selected' : '' ;
                    $activeSelected = ($status == 'Active') ? 'selected' : '' ;
                    $disabledSelected = ($status == 'Disabled') ? 'selected' : '' ;
                    $forgotten = ($status == 'Forgotten') ? 'disabled' : '' ;
                    $forgotten1 = ($status != 'Forgotten') ? 'disabled' : '' ;

                    $noneSelected = ($status != 'Disabled') ? 'disabled' : '' ;
                    $noneCheckbox = ($status != 'Disabled')  ? 'not-checkbox' : 'checkbox' ;

                    $disableDelete = ($status != 'Disabled') ? 'fa-disabled' : '' ;
                    $disableDelete1 = ($status != 'Disabled') ? 'disabled-delete' : 'delete' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input '.$noneCheckbox.'" data-id="'.$row->customerID.'" id="tableDefaultCheck'.$rowCount.'" '.$noneSelected.'>
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable">'.$row->customerID.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->firstname.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->lastname.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->password.'</div>';
                    $sub_array[] = '<div class="editable">'.$row->email.'</div>';
                    $sub_array[] = '<select data-id="'.$row->customerID.'" data-column="status" class="dropdown updateDropdown">
                                            <option '.$forgottenSelected.' value="Forgotten" '.$forgotten1.'>Forgotten</option>
                                            <option '.$activeSelected.' value="Active" '.$forgotten.'>Active</option>
                                            <option '.$disabledSelected.' value="Disabled" '.$forgotten.'>Disabled</option>
                                        </select>';
                    $sub_array[] = '<div><button type="button" name="delete" class="'.$disableDelete1.'" id="'.$row->customerID.'"><i class="fas fa-trash '.$disableDelete.'"></i></button>';
                    $sub_array[] = '<div><button type="button" name="duplicate" class="duplicate" id="'.$row->customerID.'"><i class="fa fa-clone fa-disabled"></i></button></div>';
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

        public function addCustomer(){
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['accountType']) && isset($_POST['status'])){
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if(strlen($username) < 4 || !preg_match("/^[a-zA-Z0-9]*$/", $username)){
                    echo 'Invalid username. Username must be a minimum of 4 characters long and must composed of letters and numbers only.';
                } else{
                    if($this->users_model->check_username_exists($username)){
                        if(strlen($password) < 8 || (!preg_match("/^\S*(?=\S*[\d])\S*$/", $password))){
                            echo 'Invalid Password. Password must be a minimum of 8 characters long and must contain atleast 1 number.';
                        } else{
                            $this->users_model->insert_user();
                        }
                    } else {
                        echo "Username already taken! Please use another one.";
                    }
                }
            } else{
                redirect('/admin');
            }
        }

        function deleteCustomer(){
            if(isset($_POST["id"])){
                $this->customers_model->delete_customer();
            } else{
                redirect('/admin');
            }
        }

        function updateCustomer(){
            if(isset($_POST["id"])){
                $this->customers_model->update_customer();  
            } else{
                redirect('/admin');
            }
        }
    }
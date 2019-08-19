<?php
    class Users extends CI_Controller{

        public function showAllUsers(){
            if(isset($_POST["checker"])){
                $result = $this->users_model->get_all_users();
                $data = array();

                $rowCount = 2;
                foreach($result as $row){
                    $accountType = $row->accountType;
                    $userSelected = ($accountType == 'User') ? 'selected' : '' ;
                    $adminSelected = ($accountType == 'Administrator') ? 'selected' : '' ;

                    $sub_array = array();
                    $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->accountID.'" id="tableDefaultCheck'.$rowCount.'">
                                        <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                    </div></td>';
                    $sub_array[] = '<div class="editable" data-column="accountID">'.$row->accountID.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->accountID.'" data-column="username">'.$row->username.'</div>';
                    $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->accountID.'" data-column="password">'.$row->password.'</div>';
                    $sub_array[] = '<select data-id="'.$row->accountID.'" data-column="accountType" class="dropdown updateDropdown">
                                        <option '.$userSelected.' value="User">User</option>
                                        <option '.$adminSelected.' value="Administrator">Administrator</option>
                                    </select>';
                    $sub_array[] = '<div><button type="button" name="delete" class="delete" id="'.$row->accountID.'"><i class="fas fa-trash"></i></button>';
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

        public function addUser(){
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['accountType'])){
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

        public function check_username_exists($username){
			if($this->users_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

        function deleteUser(){
            if(isset($_POST["id"])){
                $this->users_model->delete_user();
            } else{
                redirect('/admin');
            }
        }

        function deleteAllUser(){
            if(isset($_POST["id"])){
                $this->users_model->delete_all_user();
            } else{
                redirect('/admin');
            }
        }

        function updateUser(){
            if(isset($_POST["id"])){
                $column = $this->input->post('column');
                $value = $this->input->post('value');

                if($column == 'username'){
                    if(strlen($value) < 4 || !preg_match("/^[a-zA-Z0-9]*$/", $value)){
                        echo 'Invalid username. Username must be a minimum of 4 characters long and must composed of letters and numbers only.';
                    } else{
                        if($this->users_model->check_username_exists($value)){
                            $this->users_model->update_user();
                        } else {
                            echo "Username already taken! Please use another one.";
                        }
                    }
                } elseif($column == 'password'){
                    if(strlen($value) < 8 || (!preg_match("/^\S*(?=\S*[\d])\S*$/", $value))){
                        echo 'Invalid Password. Password must be a minimum of 8 characters long and must contain atleast 1 number.';
                    } else{
                        $this->users_model->update_user();
                    }
                } else{
                    $this->users_model->update_user();
                }
            } else{
                redirect('/admin');
            }
        }
    }
<?php
    class Users extends CI_Controller{

        public function register(){

			// $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username_exists|xss_clean');
			// $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|xss_clean');
			// if($this->form_validation->run() == FALSE){
            //     // redirect('/admin/usermanagement');
            //     $data = 'sss';
            //     return $data;
			// } else{
                if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['accountType'])){
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    if($this->users_model->check_username_exists($username)){
                        $enc_password = sha1($password);
                        $this->users_model->register($enc_password);
                        // return true;
                    } else {
                        echo "Username already taken! Please use another one.";
                    }
                } else{
                    redirect('/admin');
                }
                
				// $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
				// redirect('admin');
            // }
        }
        
        public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->users_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

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
                $this->users_model->insert_user();
            } else{
                redirect('/admin');
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
                $this->users_model->update_user();
            } else{
                redirect('/admin');
            }
        }
    }
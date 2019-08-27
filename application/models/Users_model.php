<?php
    class Users_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_users(){
            $accountType = array('User', 'Administrator');
            $this->db->where_in('accountType', $accountType);
            $query = $this->db->get('users');
            return $query->result();
        }

        public function insert_user(){
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'accountType' => $this->input->post('accountType'),
                'status' => $this->input->post('status')
            );

            $this->db->insert('users', $data);
        }
        
        public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

        function delete_user(){
            $id = $_POST['id'];
            $this->db->where("accountID", $id);  
            $this->db->delete("users");
         }
 
         function delete_all_user(){
            $data['ids'] = $_POST["id"];

             foreach($data['ids'] as $id){
                $this->db->where("accountID", $id);  
                $this->db->delete("users");
             }
          }
 
         function update_user(){
            $id = $_POST["id"];
            $data = array(
                $_POST["column"]  =>  $_POST["value"]
            );

             $this->db->where("accountID", $id);  
             $this->db->update("users", $data);
         }

         public function login($username, $password){
			$this->db->where('username', $username);
			$result = $this->db->get_where('users', array('status' => 'Active'));
			if($result->num_rows() == 1){
                $this->db->where('username', $username);
                $this->db->where('password', $password);
                $result = $this->db->get('users');
                if($result->num_rows() == 1){
                    return $result->row_array();
                } else {
                    $data = array(
                        'invalid' => 'password'
                    );
                    return $data;
                }
			} else {
                $data = array(
                    'invalid' => 'username'
                );
				return $data;
			}
		}

    }
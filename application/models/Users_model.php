<?php
    class Users_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_users(){
            $this->db->from('users');

            $query = $this->db->get();
            return $query->result();
        }

        public function insert_user(){
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'accountType' => $this->input->post('accountType')
            );

            $this->db->insert('users', $data);
        }

        public function register($enc_password){
			$data = array(
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'accountType' => $this->input->post('accountType')
			);
			return $this->db->insert('users', $data);
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
    }
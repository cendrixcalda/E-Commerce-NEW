<?php
    class Customers_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_customers(){
            $query = $this->db->get('customers');
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
        
        public function check_email_exists($email){
			$query = $this->db->get_where('customers', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

          function delete_customer(){
            $data['ids'] = $_POST["id"];

            foreach($data['ids'] as $id){
                $query = $this->db->get_where('customers', array('customerID' => $id));
                foreach ($query->result() as $row) {
                    $this->db->insert('customersArchive',$row);
                }
    
                $this->db->where("customerID", $id);  
                $this->db->delete("customers");
            }
        }
 
         function update_customer(){
            $id = $_POST["id"];
            $data = array(
                $_POST["column"]  =>  $_POST["value"]
            );

             $this->db->where("customerID", $id);  
             $this->db->update("customers", $data);
         }
    }
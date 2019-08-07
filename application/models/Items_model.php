<?php
    class Items_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_items($slug = FALSE){
            if($slug === FALSE){
                $query = $this->db->get('items');
                return $query->result_array();
            }

            $query = $this->db->get_where('items', array('slug' => $slug));
            return $query->row_array();
        }

        public function get_men_items($slug = FALSE){
            if($slug === FALSE){
                $query = $this->db->get('items');
                return $query->result_array();
            }

            $query = $this->db->get_where('items', array('slug' => $slug));
            return $query->row_array();
        }

        public function get_women_items($slug = FALSE){
            if($slug === FALSE){
                $query = $this->db->get('items');
                return $query->result_array();
            }

            $query = $this->db->get_where('items', array('slug' => $slug));
            return $query->row_array();
        }

        public function get_featured_items(){
            $query = $this->db->get('items');
            return $query->result_array();
        }

        public function get_latest_items($slug = FALSE){
            if($slug === FALSE){
                $query = $this->db->query('SELECT * FROM items ORDER BY date DESC LIMIT 3');
                return $query->result_array();
            }

            $query = $this->db->get_where('items', array('slug' => $slug));
            return $query->row_array();
        }

        public function get_sale_items($slug = FALSE){
            if($slug === FALSE){
                $query = $this->db->query('SELECT * FROM items ORDER BY salePercentage DESC LIMIT 3');
                return $query->result_array();
            }

            $query = $this->db->get_where('items', array('slug' => $slug));
            return $query->row_array();
        }

        public function get_all_items(){
            $this->db->from('items');
            $this->db->join('categories', 'items.categoryID = categories.categoryID');

            $query = $this->db->get();
            return $query->result();
            // if($query->num_rows() > 0){
            // }else{
            //     return false;
            // }
        }

        public function get_categories(){
            $query = $this->db->get('categories');
            return $query->result();
        }

        public function get_field()
        {
            $query = $this->db->list_fields('items');
            foreach($query as $field)
            {
                $data[] = $field;
            }
            return $data;
        }

        public function insert_item($data){
            $this->db->insert('items', $data);
        }

        function delete_item($id){  
           $this->db->where("itemID", $id);  
           $this->db->delete("items");
        }

        function delete_all_item($data){
            foreach($data['ids'] as $id){
                $this->db->where("itemID", $id);  
                $this->db->delete("items");
            }
         }

        function update_item($id, $data){
            $this->db->where("itemID", $id);  
            $this->db->update("items", $data);
        }
    }
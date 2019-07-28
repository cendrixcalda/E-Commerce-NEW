<?php
    class Items_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_items($slug = FALSE){
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
    }
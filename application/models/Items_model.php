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
        $query = $this->db->get('items');
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
    
    public function insert_item($post_image, $sku){
        $slug = url_title($this->input->post('name'));
        
        $data = array(
            'SKU' => $sku,
            'name' => $this->input->post('name'),
            'brandID' => $this->input->post('brand'),
            'forGenders' => $this->input->post('forGenders'),
            'categoryID' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'salePercentage' => $this->input->post('salePercentage'),
            'netPrice' => $this->input->post('netPrice'),
            'stock' => $this->input->post('stock'),
            'colorID' => $this->input->post('color'),
            'sizeID' => $this->input->post('size'),
            'materialID' => $this->input->post('material'),
            'countryID' => $this->input->post('madeIn'),
            'description' => $this->input->post('description'),
            'date' => $this->input->post('date'),
            'image' => $post_image,
            'createdBy' => $this->session->userdata('username'),
            'updatedBy' => 'None',
            'slug' => $slug
        );
        
        $this->db->insert('items', $data);
    }
    
    function delete_item($data){
        foreach($data['ids'] as $id){
            $query = $this->db->get_where('items', array('itemID' => $id));
            foreach ($query->result() as $row) {
                $this->db->insert('itemsArchive',$row);
            }

            $this->db->where("itemID", $id);  
            $this->db->delete("items");
        }
    }
    
    function update_item($sku){
        $id = $_POST["id"];
        $data = array(
            'SKU' => $sku,
            $_POST["column"]  =>  $_POST["value"],
            'updatedBy' => $this->session->userdata('username')
        );
        $this->db->where("itemID", $id);  
        $this->db->update("items", $data);
    }
    
    function update_image($post_image){
        $id = $_POST["id"];
        
        $data = array(
            $_POST["column"]  =>  $post_image,
            'updatedBy' => $this->session->userdata('username')
        );
        
        $this->db->where("itemID", $id);  
        $this->db->update("items", $data);
    }

    function duplicate_item($data){
        foreach($data['ids'] as $id){
            $query = $this->db->get_where('items', array('itemID' => $id));
            foreach ($query->result() as $row) {
                foreach($row as $key=>$val){        
                    if($key != 'itemID'){ 
                        $this->db->set($key, $val);               
                    } 
                }          
            }
            $this->db->insert('items');
        }
    }
    
    public function get_category_code($categoryID){
        $this->db->select('categoryCode');
        $query = $this->db->get_where('categories', array('categoryID' => $categoryID));
        
        return $query->row_array();
    }

    public function get_color_code($colorID){
        $this->db->select('colorCode');
        $query = $this->db->get_where('colors', array('colorID' => $colorID));
        
        return $query->row_array();
    }

    public function get_size_code($sizeID){
        $this->db->select('sizeCode');
        $query = $this->db->get_where('sizes', array('sizeID' => $sizeID));
        
        return $query->row_array();
    }
}
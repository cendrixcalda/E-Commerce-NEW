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
    }
    
    public function get_categories(){
        $query = $this->db->get('categories');
        return $query->result();
    }
    
    
    
    public function get_colors(){
        $this->db->order_by("color", "asc");
        $query = $this->db->get('colors');
        return $query->result();
    }
    
    public function get_countries(){
        $this->db->order_by("country", "asc");
        $query = $this->db->get('countries');
        return $query->result();
    }
    
    public function get_materials(){
        $this->db->order_by("material", "asc");
        $query = $this->db->get('materials');
        return $query->result();
    }
    
    public function get_sizes(){
        // $this->db->order_by("size", "asc");
        $query = $this->db->get('sizes');
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
    
    public function insert_item($post_image){
        $slug = url_title($this->input->post('name'));
        
        $data = array(
            'name' => $this->input->post('name'),
            'brandID' => $this->input->post('brand'),
            'forGenders' => $this->input->post('forGenders'),
            'categoryID' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'salePercentage' => $this->input->post('salePercentage'),
            'netPrice' => $this->input->post('netPrice'),
            'stock' => $this->input->post('stock'),
            'colorID' => $this->input->post('color'),
            'countryID' => $this->input->post('madeIn'),
            'materialID' => $this->input->post('materials'),
            'sizeID' => $this->input->post('sizes'),
            'date' => $this->input->post('date'),
            'image' => $post_image,
            'slug' => $slug
        );
        
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
    
    function update_image($post_image){
        $id = $_POST["id"];
        
        $data = array(
            $_POST["column"]  =>  $post_image
        );
        
        $this->db->where("itemID", $id);  
        $this->db->update("items", $data);
    }
}
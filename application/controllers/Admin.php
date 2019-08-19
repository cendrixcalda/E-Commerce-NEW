<?php
    class Admin extends CI_Controller{

        public function login(){
            $this->load->view('templates/header_login');
            $this->load->view('pages/login');
            $this->load->view('templates/footer_admin');
        }

        public function dashboard(){
            $data['items'] = $this->items_model->get_all_items();
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/dashboard', $data);
            $this->load->view('templates/footer_admin');
        }
        
        public function inventory(){
            $option['brands'] = $this->brands_model->get_brands();
            $option['categories'] = $this->items_model->get_categories();
            $option['colors'] = $this->items_model->get_colors();
            $option['countries'] = $this->items_model->get_countries();
            $option['materials'] = $this->items_model->get_materials();
            $option['sizes'] = $this->items_model->get_sizes();
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/inventory', $option);
            $this->load->view('templates/footer_admin');
        }
        
        public function usermanagement(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/usermanagement');
            $this->load->view('templates/footer_admin');
        }

        public function orders(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/orders');
            $this->load->view('templates/footer_admin');
        }
        
        public function brands(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/brands');
            $this->load->view('templates/footer_admin');
        }
        
        public function categories(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/categories');
            $this->load->view('templates/footer_admin');
        }
        
        public function colors(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/colors');
            $this->load->view('templates/footer_admin');
        }
        
        public function countries(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/countries');
            $this->load->view('templates/footer_admin');
        }
        
        public function materials(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/materials');
            $this->load->view('templates/footer_admin');
        }
        
        public function sizes(){
            $this->load->view('templates/header_admin');
            $this->load->view('pages/sizes');
            $this->load->view('templates/footer_admin');
        }
    }
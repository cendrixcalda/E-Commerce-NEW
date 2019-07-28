<?php
    class Admin extends CI_Controller{
        public function dashboard(){
            $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header_admin');
            $this->load->view('pages/dashboard', $data);
            $this->load->view('templates/footer_admin');
        }
        public function inventory(){
            $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header_admin');
            $this->load->view('pages/inventory', $data);
            $this->load->view('templates/footer_admin');
        }
        public function usermanagement(){
            $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header_admin');
            $this->load->view('pages/usermanagement', $data);
            $this->load->view('templates/footer_admin');
        }
        public function editfeatured(){
            $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header_admin');
            $this->load->view('pages/editfeatured', $data);
            $this->load->view('templates/footer_admin');
        }
    }
<?php
    class Shop extends CI_Controller{
        public function all(){
            $data['paths'] = ['Shop', 'All', 'latest'];
            $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header');
            $this->load->view('pages/shop', $data);
            $this->load->view('templates/footer');
        }

        public function men(){
            $data['paths'] = ['Shop', 'Men'];
            $data['items'] = $this->items_model->get_men_items();

            $this->load->view('templates/header');
            $this->load->view('pages/shop', $data);
            $this->load->view('templates/footer');
        }

        public function women(){
            $data['paths'] = ['Shop', 'Women'];
            $data['items'] = $this->items_model->get_women_items();

            $this->load->view('templates/header');
            $this->load->view('pages/shop', $data);
            $this->load->view('templates/footer');
        }
    }
<?php
    class Home extends CI_Controller{
        public function index(){
            // $data['items'] = $this->items_model->get_items();
            $data['latestItems'] = $this->items_model->get_latest_items();
            $data['saleItems'] = $this->items_model->get_sale_items();

            $this->load->view('templates/header');
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
        }
    }
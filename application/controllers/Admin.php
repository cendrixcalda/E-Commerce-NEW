<?php
    class Admin extends CI_Controller{

        public function login(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() === FALSE){
                if(isset($this->session->userdata['logged_in'])){
                    redirect('admin');
                } else{
                    $this->load->view('templates/header_login');
                    $this->load->view('pages/login');
                    $this->load->view('templates/footer_admin');
                }
            } else {
                
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $user = $this->users_model->login($username, $password);

                if($user['accountID']){
                    $user_data = array(
                        'user_id' => $user['accountID'],
                        'username' => $username,
                        'account_type' => $user['accountType'],
                        'logged_in' => true
                    );
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                    redirect('admin');
                } elseif($user["invalid"] == "username") {
                    $this->session->set_flashdata('login_failed', 'Invalid username');
                    redirect('admin/login');
                } elseif($user["invalid"] == "password") {
                    $this->session->set_flashdata('login_failed', 'Invalid password');
                    redirect('admin/login');
                }		
            }
        }

        public function logout(){
            $array_items = array('user_id', 'username', 'accountType', 'logged_in');
            $this->session->unset_userdata($array_items);

            redirect('admin/login');
        }

        public function dashboard(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $data['items'] = $this->items_model->get_all_items();
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/dashboard', $data);
            $this->load->view('templates/footer_admin');
        }
        
        public function inventory(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $option['brands'] = $this->brands_model->get_brands();
            $option['categories'] = $this->categories_model->get_categories();
            $option['colors'] = $this->colors_model->get_colors();
            $option['countries'] = $this->countries_model->get_countries();
            $option['materials'] = $this->materials_model->get_materials();
            $option['sizes'] = $this->sizes_model->get_sizes();
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/inventory', $option);
            $this->load->view('templates/footer_admin');
        }

        public function customers(){
            $accountTypeSession = $this->session->userdata('account_type');

            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }

            if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
				$this->load->view('templates/header_admin');
                $this->load->view('pages/customers');
                $this->load->view('templates/footer_admin');
            } else{
                show_404();
            }
        }

        public function customers_archive(){
            $accountTypeSession = $this->session->userdata('account_type');

            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }

            if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
				$this->load->view('templates/header_admin');
                $this->load->view('pages/customers-archive');
                $this->load->view('templates/footer_admin');
            } else{
                show_404();
            }
        }
        
        public function user_management(){
            $accountTypeSession = $this->session->userdata('account_type');

            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }

            if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
				$this->load->view('templates/header_admin');
                $this->load->view('pages/user-management');
                $this->load->view('templates/footer_admin');
            } else{
                show_404();
            }
        }

        public function orders(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/orders');
            $this->load->view('templates/footer_admin');
        }

        public function orders_archive(){
            $accountTypeSession = $this->session->userdata('account_type');

            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }

            if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
				$this->load->view('templates/header_admin');
                $this->load->view('pages/orders-archive');
                $this->load->view('templates/footer_admin');
            } else{
                show_404();
            }
        }

        public function order_details(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/order-details');
            $this->load->view('templates/footer_admin');
        }

        public function order_details_archive(){
            $accountTypeSession = $this->session->userdata('account_type');

            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }

            if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                $this->load->view('templates/header_admin');
                $this->load->view('pages/order-details-archive');
                $this->load->view('templates/footer_admin');
            } else{
                show_404();
            }
        }

        public function items_archive(){
            $accountTypeSession = $this->session->userdata('account_type');

            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }

            if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                $this->load->view('templates/header_admin');
                $this->load->view('pages/items-archive');
                $this->load->view('templates/footer_admin');
            } else{
                show_404();
            }
        }
        
        public function brands(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/brands');
            $this->load->view('templates/footer_admin');
        }
        
        public function categories(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/categories');
            $this->load->view('templates/footer_admin');
        }
        
        public function colors(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/colors');
            $this->load->view('templates/footer_admin');
        }
        
        public function countries(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/countries');
            $this->load->view('templates/footer_admin');
        }
        
        public function materials(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/materials');
            $this->load->view('templates/footer_admin');
        }
        
        public function sizes(){
            if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
            }
            
            $this->load->view('templates/header_admin');
            $this->load->view('pages/sizes');
            $this->load->view('templates/footer_admin');
        }
    }
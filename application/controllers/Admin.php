<?php
    class Admin extends CI_Controller{
        public function dashboard(){
            $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header_admin');
            $this->load->view('pages/dashboard', $data);
            $this->load->view('templates/footer_admin');
        }

        public function inventory(){
            // $data['items'] = $this->items_model->get_all_items();

            $this->load->view('templates/header_admin');
            $this->load->view('pages/inventory');
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

        public function showAllItems(){
            $result = $this->items_model->get_all_items();
            $categories = $this->items_model->get_categories();
            $data = array();

            // $insert_data = array();
            // $insert_data[] = '<tr class="insert no-sort"><td></td>';
            // $insert_data[] = '<td></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data1" name="name"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data2" name="brand"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data3" name="forGenders"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data4" name="category"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data5" name="price"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data6" name="salePercentage"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data7" name="netPrice"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data8" name="stock"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data9" name="color"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data10" name="madeIn"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data11" name="materials"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data12" name="sizes"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data13" name="date"></div></td>';
            // $insert_data[] = '<td><div contenteditable spellcheck="false" class="editable" id="data14" name="image"></div></td>';
            // $insert_data[] = '<td><button type="submit" name="action" value="add" class="add"><i class="fas fa-plus"></i></button></td></tr>';
            // $data[] = $insert_data;

            $rowCount = 2;
            foreach($result as $row){
                $forGenders = $row->forGenders;
                $menSelected = ($forGenders == 'Men') ? 'selected' : '' ;
                $womenSelected = ($forGenders == 'Women') ? 'selected' : '' ;
                $unisexSelected = ($forGenders == 'Unisex') ? 'selected' : '' ;

                $categoryIDSelected = $row->categoryID;

                $optionCategory = '';
                foreach($categories as $category){
                    $categorySelected = ($category->categoryID == $categoryIDSelected) ? 'selected' : '' ;

                    $optionCategory .= '<option '.$categorySelected.' value="'.$category->categoryID.'">'.$category->category.'</option> \n ';
                }

                $sub_array = array();
                $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                                    <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->itemID.'" id="tableDefaultCheck'.$rowCount.'">
                                    <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                                </div></td>';
                $sub_array[] = '<div class="editable" data-column="itemID">'.$row->itemID.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="name">'.$row->name.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="brand">'.$row->brand.'</div>';
                
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="forGenders" class="dropdown updateDropdown">
                                    <option '.$menSelected.' value="Men">Men</option>
                                    <option '.$womenSelected.' value="Women">Women</option>
                                    <option '.$unisexSelected.' value="Unisex">Unisex</option>
                                </select>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="categoryID" class="dropdown updateDropdown">'.$optionCategory.'</select>';

                // $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="forGenders">'.$row->forGenders.'</div>';
                // $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="category">'.$row->category.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable updatePrice price" data-id="'.$row->itemID.'" data-column="price">'.$row->price.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable updateSalePercentage salePercentage" data-id="'.$row->itemID.'" data-column="salePercentage">'.$row->salePercentage.'</div>';
                $sub_array[] = '<div spellcheck="false" class="editable update netPrice" data-id="'.$row->itemID.'" data-column="netPrice">'.$row->netPrice.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="stock">'.$row->stock.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="color">'.$row->color.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="madeIn">'.$row->madeIn.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="materials">'.$row->materials.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="sizes">'.$row->sizes.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="date">'.$row->date.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="image">'.$row->image.'</div>';
                $sub_array[] = '<div><button type="button" class="delete" id="'.$row->itemID.'"><i class="fas fa-trash"></i></button>';
                $data[] = $sub_array;
                $rowCount++;
            }

            $output = array(
                "data"  => $data
            );

            echo json_encode($output);
        }

        public function additem(){
            if(isset($_POST["name"])){
                $slug = url_title($this->input->post('data1'));

                $data = array(
                    'name' => $this->input->post('name'),
                    'brand' => $this->input->post('brand'),
                    'forGenders' => $this->input->post('forGenders'),
                    'category' => $this->input->post('category'),
                    'price' => $this->input->post('price'),
                    'salePercentage' => $this->input->post('salePercentage'),
                    'netPrice' => $this->input->post('netPrice'),
                    'stock' => $this->input->post('stock'),
                    'color' => $this->input->post('color'),
                    'madeIn' => $this->input->post('madeIn'),
                    'materials' => $this->input->post('materials'),
                    'sizes' => $this->input->post('sizes'),
                    'date' => $this->input->post('date'),
                    'image' => $this->input->post('image'),
                    'slug' => $slug
                );

                $this->items_model->insert_item($data);
                echo "Data Inserted";
            }
        }

        function deleteItem(){
            $id = $_POST["id"];
            $this->items_model->delete_item($id);
        }

        function deleteAllItem(){
            $data['ids'] = $_POST["id"];
            $this->items_model->delete_all_item($data);
        }

        function updateItem(){
            $id = $_POST["id"];
            $data = array(
                $_POST["column"]  =>  $_POST["value"]
            );
            $this->items_model->update_item($id, $data);
        }
    }
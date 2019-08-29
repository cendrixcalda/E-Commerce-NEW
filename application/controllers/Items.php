<?php
    class Items extends CI_Controller{
    
    public function showAllItems(){
        if(isset($_POST["checker"])){
            $result = $this->items_model->get_all_items();
            $categories = $this->categories_model->get_categories_inventory();
            $brands = $this->brands_model->get_brands_inventory();
            $colors = $this->colors_model->get_colors_inventory();
            $countries = $this->countries_model->get_countries_inventory();
            $materials = $this->materials_model->get_materials_inventory();
            $sizes = $this->sizes_model->get_sizes_inventory();
            $data = array();
            
            $rowCount = 2;
            foreach($result as $row){
                $forGenders = $row->forGenders;
                $noneSelected = ($forGenders == 'None') ? 'selected' : '' ;
                $menSelected = ($forGenders == 'Men') ? 'selected' : '' ;
                $womenSelected = ($forGenders == 'Women') ? 'selected' : '' ;
                $unisexSelected = ($forGenders == 'Unisex') ? 'selected' : '' ;
                
                $brandIDSelected = $row->brandID;
                $categoryIDSelected = $row->categoryID;
                $colorIDSelected = $row->colorID;
                $countryIDSelected = $row->countryID;
                $materialIDSelected = $row->materialID;
                $sizeIDSelected = $row->sizeID;
                
                $optionBrand = '';
                foreach($brands as $brand){
                    $brandSelected = ($brand->brandID == $brandIDSelected) ? 'selected' : '';
                    $optionBrand .= '<option '.$brandSelected.' value="'.$brand->brandID.'">'.$brand->brand.'</option>';
                }
                
                $optionCategory = '';
                foreach($categories as $category){
                    $categorySelected = ($category->categoryID == $categoryIDSelected) ? 'selected' : '' ;
                    $optionCategory .= '<option '.$categorySelected.' value="'.$category->categoryID.'">'.$category->category.'</option>';
                }
                
                $optionColor = '';
                foreach($colors as $color){
                    $colorSelected = ($color->colorID == $colorIDSelected) ? 'selected' : '' ;
                    $optionColor .= '<option '.$colorSelected.' value="'.$color->colorID.'">'.$color->color.'</option>';
                }
                
                $optionCountry = '';
                foreach($countries as $country){
                    $countrySelected = ($country->countryID == $countryIDSelected) ? 'selected' : '' ;
                    $optionCountry .= '<option '.$countrySelected.' value="'.$country->countryID.'">'.$country->country.'</option>';
                }
                
                $optionMaterial = '';
                foreach($materials as $material){
                    $materialSelected = ($material->materialID == $materialIDSelected) ? 'selected' : '' ;
                    $optionMaterial .= '<option '.$materialSelected.' value="'.$material->materialID.'">'.$material->material.'</option>';
                }
                
                $optionSize = '';
                foreach($sizes as $size){
                    $sizeSelected = ($size->sizeID == $sizeIDSelected) ? 'selected' : '' ;
                    $optionSize .= '<option '.$sizeSelected.' value="'.$size->sizeID.'">'.$size->size.'</option>';
                }
                
                $sub_array = array();
                $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->itemID.'" id="tableDefaultCheck'.$rowCount.'">
                <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                </div></td>';
                $sub_array[] = '<div class="editable" data-column="itemID">'.$row->itemID.'</div>';
                $sub_array[] = '<div class="editable" data-column="SKU">'.$row->SKU.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update name" data-id="'.$row->itemID.'" data-column="name">'.$row->name.'</div>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="brandID" class="dropdown updateDropdown">'.$optionBrand.'</select>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="forGenders" class="dropdown updateDropdown gender">
                <option '.$noneSelected.' value="None">None</option>
                <option '.$menSelected.' value="Men">Men</option>
                <option '.$womenSelected.' value="Women">Women</option>
                <option '.$unisexSelected.' value="Unisex">Unisex</option>
                </select>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="categoryID" class="dropdown updateDropdown category">'.$optionCategory.'</select>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable updatePrice price" data-id="'.$row->itemID.'" data-column="price">'.$row->price.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable updateSalePercentage salePercentage" data-id="'.$row->itemID.'" data-column="salePercentage">'.$row->salePercentage.'</div>';
                $sub_array[] = '<div class="editable update netPrice" data-id="'.$row->itemID.'" data-column="netPrice">'.$row->netPrice.'</div>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update stock" data-id="'.$row->itemID.'" data-column="stock">'.$row->stock.'</div>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="colorID" class="dropdown updateDropdown color">'.$optionColor.'</select>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="sizeID" class="dropdown updateDropdown size">'.$optionSize.'</select>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="materialID" class="dropdown updateDropdown">'.$optionMaterial.'</select>';
                $sub_array[] = '<select data-id="'.$row->itemID.'" data-column="countryID" class="dropdown updateDropdown">'.$optionCountry.'</select>';
                $sub_array[] = '<div contenteditable spellcheck="false" class="editable update" data-id="'.$row->itemID.'" data-column="description">'.$row->description.'</div>';
                $sub_array[] = '<input type="date" data-id="'.$row->itemID.'" data-column="date" class="dropdown updateDate date" value="'.$row->date.'" required="required" />';
                $sub_array[] = '<input type="file" name="userfile" data-id="'.$row->itemID.'" data-column="image"  class="imageUpdate" id="'.$row->itemID.'" /><label for="'.$row->itemID.'" class="imageLabel">'.$row->image.'</label>';
                $sub_array[] = '<div class="options"><button type="button" name="delete" class="delete" id="'.$row->itemID.'"><i class="fas fa-trash"></i></button></div>';
                $sub_array[] = '<div><button type="button" name="duplicate" class="duplicate" id="'.$row->itemID.'"><i class="fa fa-clone"></i></button></div>';
                $data[] = $sub_array;
                $rowCount++;
            }
            
            $output = array(
                "data"  => $data
            );
            
            echo json_encode($output);
        } else{
            redirect('/admin');
        }
    }
    
    public function addItem(){
        if(isset($_FILES['userfile'])){
            
            // Upload Image
            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            
            $this->load->library('upload', $config);
            
            if(!$this->upload->do_upload('userfile')){
                $post_image = 'noimage.jpg';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name'];
            }

            $name = $this->input->post('name');
            $categoryID = $this->input->post('category');
            $gender = $this->input->post('forGenders');
            $colorID = $this->input->post('color');
            $sizeID = $this->input->post('size');

            $sku = $this->skuGenerator($name, $categoryID, $gender, $colorID, $sizeID);
            
            $this->items_model->insert_item($post_image, $sku);
        } else{
            redirect('/admin');
        }
    }
    
    function deleteItem(){
        if(isset($_POST["id"])){
            $data['ids'] = $_POST["id"];
            $this->items_model->delete_item($data);
        } else{
            redirect('/admin');
        }
    }
    
    function updateItem(){
        if(isset($_POST["id"])){
            $name = $this->input->post('name');
            $categoryID = $this->input->post('category');
            $gender = $this->input->post('gender');
            $colorID = $this->input->post('color');
            $sizeID = $this->input->post('size');

            $sku = $this->skuGenerator($name, $categoryID, $gender, $colorID, $sizeID);
            $this->items_model->update_item($sku);
        } else{
            redirect('/admin');
        }
    }
    
    function updateImage(){
        if(isset($_FILES['userfile'])){
            
            // Update Image
            $config['upload_path'] = './assets/images';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            
            $this->load->library('upload', $config);
            
            $filename = $_FILES['userfile']['name'];
            $filepath = FCPATH.'assets/images/'.$filename;
            
            
            if(file_exists($filepath)){
                $post_image = $filename;
            } else{
                if(!$this->upload->do_upload('userfile')){
                    $post_image = 'noimage.jpg';
                } else {
                    $post_image = $filename;
                }
            }
            
            $this->items_model->update_image($post_image);
        } else{
            redirect('/admin');
        }
    }

    function duplicateItem(){
        if(isset($_POST["id"])){
            $data['ids'] = $_POST["id"];
            $this->items_model->duplicate_item($data);
        } else{
            redirect('/admin');
        }
    }

    public function skuGenerator($name, $categoryID, $gender, $colorID, $sizeID){
        $nameWords = explode(" ", $name);
        $nameCode = "";

        foreach ($nameWords as $acronym) {
        $nameCode .= $acronym[0];
        }

        $nameCode = strtoupper($nameCode);
        $categoryCode = $this->items_model->get_category_code($categoryID);
        $colorCode = $this->items_model->get_color_code($colorID);
        $sizeCode = $this->items_model->get_size_code($sizeID);

        if($gender == "Men"){
            $genderCode = "M";
        } elseif($gender == "Women"){
            $genderCode = "WM";
        } elseif($gender == "Unisex"){
            $genderCode = "UNI";
        } else{
            $genderCode = "NON";
        }
        
        $sku = $nameCode."-".$categoryCode['categoryCode'].$genderCode."-".$colorCode['colorCode'].$sizeCode['sizeCode'];
        return $sku;
    }

    public function getAffectedItems(){
        if(isset($_POST["id"])){
            $affectedItems = $this->items_model->get_affected_items();
            echo $affectedItems;
        } else{
            redirect('/admin');
        }
    }
}
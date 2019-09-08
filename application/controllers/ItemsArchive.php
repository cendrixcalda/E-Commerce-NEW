<?php
    class ItemsArchive extends CI_Controller{
    public $archiveTableName = 'itemsArchive';
    public $mainTableName = 'items';
    public $idName = 'itemID';
    
    public function showAllItemsArchive(){
        if(isset($_POST["checker"])){
            $result = $this->archives_model->get_all_archives($this->archiveTableName);
            $categories = $this->categories_model->get_categories();
            $brands = $this->brands_model->get_brands();
            $colors = $this->colors_model->get_colors();
            $countries = $this->countries_model->get_countries();
            $materials = $this->materials_model->get_materials();
            $sizes = $this->sizes_model->get_sizes();
            $data = array();
            
            $rowCount = 2;
            foreach($result as $row){
                
                $brandIDSelected = $row->brandID;
                $categoryIDSelected = $row->categoryID;
                $colorIDSelected = $row->colorID;
                $countryIDSelected = $row->countryID;
                $materialIDSelected = $row->materialID;
                $sizeIDSelected = $row->sizeID;
                
                foreach($brands as $brand){
                    if($brand->brandID == $brandIDSelected){
                        $brandSelected = $brand->brand;
                        break;
                    } else{
                        $brandSelected = 'None';
                    }
                }

                foreach($categories as $category){
                    if($category->categoryID == $categoryIDSelected){
                        $categorySelected = $category->category;
                        break;
                    } else{
                        $categorySelected = 'None';
                    }
                }
                
                foreach($colors as $color){
                    if($color->colorID == $colorIDSelected){
                        $colorSelected = $color->color;
                        break;
                    } else{
                        $colorSelected = 'None';
                    }
                }
                
                foreach($countries as $country){
                    if($country->countryID == $countryIDSelected){
                        $countrySelected = $country->country;
                        break;
                    } else{
                        $countrySelected = 'None';
                    }
                }
                
                foreach($materials as $material){
                    if($material->materialID == $materialIDSelected){
                        $materialSelected = $material->material;
                        break;
                    } else{
                        $materialSelected = 'None';
                    }
                }
                
                foreach($sizes as $size){
                    if($size->sizeID == $sizeIDSelected){
                        $sizeSelected = $size->size;
                        break;
                    } else{
                        $sizeSelected = 'None';
                    }
                }
                
                $sub_array = array();
                $sub_array[] = '<td class="cb"><div class="custom-control custom-checkbox my-checkbox">
                <input type="checkbox" class="custom-control-input checkbox" data-id="'.$row->itemID.'" id="tableDefaultCheck'.$rowCount.'">
                <label class="custom-control-label" for="tableDefaultCheck'.$rowCount.'"></label>
                </div></td>';
                $sub_array[] = '<div class="editable">'.$row->itemID.'</div>';
                $sub_array[] = '<div class="editable">'.$row->SKU.'</div>';
                $sub_array[] = '<div class="editable">'.$row->name.'</div>';
                $sub_array[] = '<div class="editable">'.$brandSelected.'</div>';
                $sub_array[] = '<div class="editable">'.$row->forGenders.'</div>';
                $sub_array[] = '<div class="editable">'.$categorySelected.'</div>';
                $sub_array[] = '<div class="editable">'.$row->price.'</div>';
                $sub_array[] = '<div class="editable">'.$row->salePercentage.'</div>';
                $sub_array[] = '<div class="editable">'.$row->netPrice.'</div>';
                $sub_array[] = '<div class="editable">'.$row->stock.'</div>';
                $sub_array[] = '<div class="editable">'.$colorSelected.'</div>';
                $sub_array[] = '<div class="editable">'.$sizeSelected.'</div>';
                $sub_array[] = '<div class="editable">'.$materialSelected.'</div>';
                $sub_array[] = '<div class="editable">'.$countrySelected.'</div>';
                $sub_array[] = '<div class="editable">'.$row->description.'</div>';
                $sub_array[] = '<div class="editable">'.$row->date.'</div>';
                $sub_array[] = '<div class="editable">'.$row->image.'</div>';
                $sub_array[] = '<div class="options"><button type="button" name="delete" class="delete" id="'.$row->itemID.'"><i class="fas fa-trash"></i></button></div>';
                $sub_array[] = '<div><button type="button" name="restore" class="restore" id="'.$row->itemID.'"><i class="fas fa-trash-restore"></i></button></div>';
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
    
    function deleteItemArchive(){
        if(isset($_POST["id"])){
            $this->archives_model->delete_archive($this->archiveTableName, $this->idName);
        } else{
            redirect('/admin');
        }
    }

    function restoreItemArchive(){
        if(isset($_POST["id"])){
            $this->archives_model->restore_archive($this->archiveTableName, $this->idName, $this->mainTableName);
        } else{
            redirect('/admin');
        }
    }
}
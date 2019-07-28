<section class="promotion">
    <p>SALE</p>
    <p>UP TO 40% OFF</p>
</section>
<section class="showcase featured-items">
    <p class="title">Featured Items</p>
    <div class="items">
    <?php
        $i = 0;
        $itemClass = "item1";
        $featuredItemCount = 5;

        for($featuredItem = 1; $featuredItem < $featuredItemCount; $featuredItem++){
            echo '<div class='.$itemClass.'>'
            .'<img src="'.base_url().'assets/images/featured/item'.$featuredItem.'.jpg">
            </div>';

            $i++;
            if($itemClass == "item1"){
                $itemClass = "item2";
            } else{
                $itemClass = "item1";
            }
            if ($i % 2 == 0 && $i != ($featuredItemCount - 1)) { 
                echo "</div><div class='items'>";
                if($itemClass == "item1"){
                    $itemClass = "item2";
                } else{
                    $itemClass = "item1";
                }
            }
        }     
    ?>
    </div>
</section>
<section class="showcase latest-products">
    <p class="title">Latest Products</p>
    <div class="items">
    <?php foreach($latestItems as $item) : ?>
        <?php $name = $item["name"];  
        $name = strlen($name) > 25 ? substr($name, 0, 25)."..." : $name;
        ?>
        <div class="item">
            <img src="<?php echo base_url(); ?>assets/<?php echo $item["image"]; ?>.jpg">
            <div class="details">
                <p><?php echo $name ?></p>
                <p><?php echo $item['brand']; ?></p>
                <p>Php <?php echo $item['price']; ?></p>
                <div class="cart-fav">
                    <i class="far fa-heart"></i>
                    <i class="fas fa-cart-plus"></i>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <a href="<?php echo base_url(); ?>shop/men">
        <div class="view-more">VIEW LATEST ITEMS &gt;</div>
    </a>
    
</section>
<section class="showcase sale-items">
    <p class="title">Sale Items</p>
    <div class="items">
    <?php foreach($saleItems as $item) : ?>
        <?php $name = $item["name"];  
        $name = strlen($name) > 25 ? substr($name, 0, 25)."..." : $name;
        ?>
        <div class="item">
            <img src="<?php echo base_url(); ?>assets/<?php echo $item["image"]; ?>.jpg">
            <div class="details">
                <p><?php echo $name ?></p>
                <p><?php echo $item['brand']; ?></p>
                <p>Php <?php echo $item['price']; ?></p>
                <div class="cart-fav">
                    <i class="far fa-heart"></i>
                    <i class="fas fa-cart-plus"></i>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="view-more">
            VIEW SALE ITEMS &gt;
    </div>
</section>
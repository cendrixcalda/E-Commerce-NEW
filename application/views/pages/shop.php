<section class="showcase latest-products">
    <p class="path">
        <?php
            $pathCount = count($paths);
            $finalpath = '';
            $i = 0;
            $dash = '';

            foreach($paths as $path){
                if ($i == $pathCount - 1) {
                    $dash = '';
                } else{
                    $dash = '/';
                }
                $finalpath .= $path.$dash;
                echo '<a href="'.base_url().strtolower($finalpath).'">'.ucwords($path).'</a> '.$dash.' ';
                $i++;
            }
        ?>
    </p>
    <div class="items">
    <?php foreach($items as $item) : ?>
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
    <!-- <div class="view-more">
            VIEW LATEST ITEMS &gt;
    </div> -->
</section>
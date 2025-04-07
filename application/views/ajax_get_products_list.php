<?php if($product_data){  foreach($product_data as $product) {?> 
<div class="card-deck row">
    <div class="col-xs-12 col-sm-6 col-md-4" style="width: 90%;">
        <div class="card">
                <div class="view overlay">
                <img class="card-img-top" src="<?php echo base_url('uploads/products/' . $product['image']); ?>" alt="Card image cap">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $product['title']; ?></h4>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <p class="card-text">Price : <?php echo $product['price']; ?></p>
                    <a href="<?php echo base_url('Frontend/product_buy/' . $product['id']); ?>" target="_blank" class="btn btn-warning btn-md">Order Now</a>
                    <?php if($product['is_wishlist'] == 1) { ?> 
                    <a href="<?php echo base_url('Frontend/add_to_cart/' . $product['id']); ?>" class="btn btn-info btn-md">Add to cart</a>
                    <?php } ?>
                </div>
        </div>
    </div>  
</div>
<?php } } ?>
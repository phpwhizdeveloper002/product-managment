<?php include('main_header.php'); ?>
<body>
<div class="container">
    <h2><?php echo $products; ?></h2>
    <a href="<?php echo base_url('Frontend/showWhishListData'); ?>" target="_blank" class="btn btn-success btn-md">whishlist products</a>
    <p class="btn btn-danger"><?php echo $add_to_cart_products_count; ?></p>
    <h3><i class='fas fa-baby-carriage' style='font-size:24px'></i></h3>
    <div class="form-group">
        <label for="category">Select Category:</label>
        <select id="category" class="form-control">
            <option value="">All Categories</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="card-data"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        function fetchProducts(categoryId = '') {

            $.ajax({
                url: "<?= base_url('Frontend/ajax_get_product_list'); ?>",
                type: 'GET',
                data: { category_id: categoryId },
                dataType: 'html',
                success: function(response) {
                    let card = $('#card-data');
                    card.empty();
                    if (response.trim()) {
                        card.append(response);
                    } else {
                        card.append("<p>No products found for this category.</p>");
                    }
                },
                error: function() {
                    alert("An error occurred while fetching product data.");
                }
            });
        }

        // Initial fetch
        fetchProducts();

        // On category change
        $('#category').on('change', function() {
            let selectedCategory = $(this).val();
            fetchProducts(selectedCategory);
        });
    });
</script>

</body>
</html>
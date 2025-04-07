<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Add this in your <head> or before closing </body> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .container {
            display: flex;
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php if($product_data) { foreach($product_data as $product) {?>
        <div class="card" style="width: 25rem;">
        <img src="<?php echo base_url('uploads/products/' . $product['image']); ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $product['title']; ?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $product['title']; ?></li>
            <li class="list-group-item"><?php echo $product['description']; ?></li>
            <li class="list-group-item"><?php echo $product['price']; ?></li>
            <li class="list-group-item">Available quantity : <?php echo $product['qty']; ?></li>
        </ul>
        <div class="card-body">
            <label for="qty">Quantity:</label>
            <select id="qty_<?php echo $product['qty']; ?>" name="qty" class="form-select mb-2" style="width: auto; display: inline-block;">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="card-body">
            <button class="card-link btn btn-primary m-3" onclick="butProduct(<?php echo $product['id']; ?>, <?php echo $product['qty']; ?>)">Buy Now</button>
            <?php if($product['is_wishlist'] == 0) { ?> 
                <a href="<?php echo base_url('Frontend/remove_add_to_cart/' . $product['id']); ?>" target="_blank" class="btn btn-warning btn-md">Remove From Whishlist</a>
            <?php } ?>
        </div>
        </div>
        <?php } }else{ ?>
            <h1>Empty Whish List.....</h1>
        <?php } ?>
    </div>

    <script>
        function butProduct(id, qty) {
            var qtyElement = document.getElementById('qty_' + id);
            var qty = parseInt(qtyElement.value);
            var availableQty = qty;
            alert(qty);
            if (qty > availableQty) {
                Swal.fire({
                    icon: 'error',
                    title: 'Quantity Exceeded',
                    text: 'Please select a quantity less than or equal to the available stock.',
                    confirmButtonText: 'OK'
                });
                return;
            }else{
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Product bought successfully!',
                    confirmButtonText: 'OK'
                });
            }            

            console.log("Product ID:", id);
        }
    </script>

</body>
</html>
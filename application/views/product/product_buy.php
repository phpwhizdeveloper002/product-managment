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
            width: 50%;
        }
    </style>
</head>
<body>
    <?php if($productData) { ?>
    <div class="container">
        <div class="card" style="width: 25rem;">
        <img src="<?php echo base_url('uploads/products/' . $productData['image']); ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $productData['title']; ?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $productData['title']; ?></li>
            <li class="list-group-item"><?php echo $productData['description']; ?></li>
            <li class="list-group-item"><?php echo $productData['price']; ?></li>
            <li class="list-group-item">Available quantity : <?php echo $productData['qty']; ?></li>
        </ul>

        <div class="card-body">
            <label for="qty">Quantity:</label>
            <select id="qty" name="qty" class="form-select mb-2" style="width: auto; display: inline-block;">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="card-body">
            <button class="card-link btn btn-primary" onclick="butProduct(<?php echo $productData['id']; ?>)">Buy Now</button>
        </div>
        </div>
    </div>
    <?php } ?>

    <script>
        function butProduct(id) {
            var qty = document.getElementById('qty').value;
            var availableQty = <?php echo (int) $productData['qty']; ?>;

            if (qty > availableQty) {
                Swal.fire({
                    icon: 'error',
                    title: 'Quantity Exceeded',
                    text: 'Please select a quantity less than or equal to the available stock.',
                    confirmButtonText: 'OK'
                });
                return; // Prevent further execution if needed
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
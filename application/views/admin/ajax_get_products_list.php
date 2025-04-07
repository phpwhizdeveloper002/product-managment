<?php if(!empty($product_data)) {
$no = 1;
foreach($product_data as $product) { ?> 
<tr>
    <td>
        <img src="<?php echo base_url('uploads/products/' . $product['image']); ?>" 
             alt="Product Image" 
             style="width: 60px; height: auto; border-radius: 5px;">
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0"><?php echo $product['title']; ?></p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0"><?php echo $product['name']; ?></p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0"><?php echo $product['price']; ?></p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0"><?php echo $product['qty']; ?></p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0"><?php echo $product['description']; ?></p>
    </td>
    <td class="align-middle text-center text-sm">
            <button class="btn btn-warning" onclick="updateProductPopup(<?php echo $product['id']; ?>)">Edit</button>
    </td>
</tr>
<?php } }else{ ?>
   <tr><td colspan="7" class="text-center">No data available</td></tr>
<?php } ?>

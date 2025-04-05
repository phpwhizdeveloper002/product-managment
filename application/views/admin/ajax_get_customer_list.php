<?php if(!empty($category_data)) {
$no = 1;
foreach($category_data as $category) { ?> 
<tr>
    <td>
        <p class="text-xs font-weight-bold mb-0" ><?php echo ++$no; ?></p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0"><?php echo $category['name']; ?></p>
    </td>
    <td class="align-middle text-center text-sm">
        <span class="badge badge-sm bg-gradient-success">
            <?php echo ($category['status'] == 1) ? "Active" : "Deactive"; ?>
        </span>
    </td>
   <td class="align-middle text-center text-sm">
        <button class="btn btn-warning" onclick="editCategory(<?php echo $category['id']; ?>)">Edit</button>
   </td>
</tr>
<?php } }else{ ?>
   <tr><td colspan="4" class="text-center">No data available</td></tr>
<?php } ?>

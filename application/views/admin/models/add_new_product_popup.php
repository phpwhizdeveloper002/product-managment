<!-- Modal HTML structure -->
<div class="" id="addNewClinicPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <form id="addProductForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="card card-plain">
                        <div class="card-header">
                            <h4 class="font-weight-bolder">Add Product</h4>
                        </div>                    
                        <div class="card-body">
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Please enter the title">
                                <div class="invalid-feedback" style="display: none;">Product title is required.</div>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <select id="category_id" name="category_id" class="form-control">
                                    <option value="">Select category</option>
                                    <?php if($category_data){ foreach($category_data as $category) {
                                        ?> 
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php } }?>
                                </select>
                                <div class="invalid-feedback" style="display: none;">Please select category required.</div>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <div class="invalid-feedback" style="display: none;">Product image is required.</div>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="number" step="0.01" id="price" name="price" class="form-control" placeholder="Please enter the price">
                                <div class="invalid-feedback" style="display: none;">Product price is required.</div>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <select id="qty" name="qty" class="form-control">
                                    <option value="">Select quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <div class="invalid-feedback" style="display: none;">Quantity is required.</div>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <textarea id="description" name="description" class="form-control" placeholder="Please enter the description" rows="3"></textarea>
                                <div class="invalid-feedback" style="display: none;">Product description is required.</div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        
        // Validate Title
        $('#title').on('blur input', function () {
            toggleValidation($(this));
        });

        // Validate Category
        $('#category_id').on('change blur', function () {
            toggleValidation($(this));
        });

        // Validate Image
        $('#image').on('change blur', function () {
            if (this.files.length === 0) {
                $(this).addClass('is-invalid');
                $(this).siblings('.invalid-feedback').show();
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').hide();
            }
        });

        // Validate Quantity
        $('#qty').on('change blur', function () {
            toggleValidation($(this));
        });

        // Validate Title
        $('#price').on('blur input', function () {
            toggleValidation($(this));
        });

        // Validate Description
        $('#description').on('blur input', function () {
            toggleValidation($(this));
        });

        // Form submit validation
        $('#addProductForm').on('submit', function (e) {
            let isValid = true;

            if ($('#title').val().trim() === '') {
                $('#title').addClass('is-invalid').siblings('.invalid-feedback').show();
                isValid = false;
            }

            if ($('#category_id').val().trim() === '') {
                $('#category_id').addClass('is-invalid').siblings('.invalid-feedback').show();
                isValid = false;
            }

            if ($('#image')[0].files.length === 0) {
                $('#image').addClass('is-invalid').siblings('.invalid-feedback').show();
                isValid = false;
            }

            if ($('#qty').val().trim() === '') {
                $('#qty').addClass('is-invalid').siblings('.invalid-feedback').show();
                isValid = false;
            }

            if ($('#price').val().trim() === '') {
                $('#price').addClass('is-invalid').siblings('.invalid-feedback').show();
                isValid = false;
            }

            if ($('#description').val().trim() === '') {
                $('#description').addClass('is-invalid').siblings('.invalid-feedback').show();
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // Stop form from submitting
            }
        });

        // Reusable function for toggling validation
        function toggleValidation(element) {
            let val = element.val().trim();
            if (val === '') {
                element.addClass('is-invalid');
                element.siblings('.invalid-feedback').show();
            } else {
                element.removeClass('is-invalid');
                element.siblings('.invalid-feedback').hide();
            }
        }
        
        //Form submit here.
        $("#addProductForm").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            
            $.ajax({
                url: "<?= base_url('Product/saveProductForm') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if(response.message){
                        alert(response.message);
                        window.location.href = '<?= base_url('Product/index') ?>';
                    }else if(response.errors) {
                        window.location.href = "<?= base_url('Product/index'); ?>"; 
                    }
                    
                    $("input[name='<?= $this->security->get_csrf_token_name(); ?>']").val(response.csrf_token);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.close').on('click', function() {
            location.reload();
        });
    });
</script>
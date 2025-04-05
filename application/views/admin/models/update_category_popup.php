<!-- Modal HTML structure -->
<div class="" id="addNewClinicPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <form id="updateCategoryForm" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="card card-plain">
                        <div class="card-header">
                            <h4 class="font-weight-bolder">Update Category</h4>
                        </div>                    
                        <div class="card-body">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="hidden" name="categoryId" value="<?php echo $categoryData['id']; ?>">
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $categoryData['name']; ?>" placeholder="Please enter the category name">
                                    <div class="invalid-feedback" style="display: none;">Category name is required.</div>
                                </div>
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

        // Front end form validation here.
        $('#name').on('blur', function () {
            let inputVal = $(this).val().trim();
            if (inputVal === '') {
                $(this).addClass('is-invalid');
                $(this).siblings('.invalid-feedback').show();
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').hide();
            }
        });

        // Real-time input check to hide error
        $('#name').on('input', function () {
            let inputVal = $(this).val().trim();
            if (inputVal !== '') {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').hide();
            }
        });

        // Optional: prevent form submission if invalid
        $('#updateCategoryForm').on('submit', function (e) {
            let nameInput = $('#name');
            if (nameInput.val().trim() === '') {
                nameInput.addClass('is-invalid');
                nameInput.siblings('.invalid-feedback').show();
                e.preventDefault();
            }
        });
        
        //Form submit here.
        $("#updateCategoryForm").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            
            $.ajax({
                url: "<?= base_url('Category/updateCategoryForm') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if(response.message){
                        alert(response.message);
                        window.location.href = '<?= base_url('Category/index') ?>';
                    }else if(response.errors) {
                        window.location.href = "<?= base_url('Category/index'); ?>"; 
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
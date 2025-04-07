
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $product; ?></li>
          </ol>
        </nav>
      </div>
    </nav>

    <?php if ($this->session->flashdata('error_message')): ?>
        <div class="alert alert-danger" id="error-alert">
            <?= $this->session->flashdata('error_message'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success_message')): ?>
        <div class="alert alert-success" id="success-alert">
            <?= $this->session->flashdata('success_message'); ?>
        </div>
    <?php endif; ?>

    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
          <h3 class="mb-0 h4 font-weight-bolder"><?php echo $product; ?></h3>
          <p class="mb-4">

          </p>
        </div>
        <div class="text-right">
          <button class="btn btn-primary" onclick="addNewproductPopup();">Add product</button>
        </div>
        <div>
        <div class="row">
            <div class="col-12">
              <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3"><?php echo $product; ?></h6>
                  </div>
                </div>
                <div class="card-body px-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="product_table">
                        <thead>
                          <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            <th class="text-secondary opacity-7"></th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer py-4  ">
          <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
              <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                  © <script>
                    document.write(new Date().getFullYear())
                  </script>,
                  made with <i class="fa fa-heart"></i> by
                  <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                  for a better web.
                </div>
              </div>
              <div class="col-lg-6">
                
              </div>
            </div>
          </div>
        </footer>
    </div>
</main>
<div class="modal hide fade px-3" id="addNewClinicPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Error message fade from here. -->
<script>
  setTimeout(function() {
        document.getElementById('error-alert')?.remove();
        document.getElementById('success-alert')?.remove();
    }, 3000);
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('Product/ajax_get_product_list'); ?>",
            type: 'GET',
            dataType: 'html', 
            success: function(response) {
                let tableBody = $('#product_table tbody');
                tableBody.empty();

                if (response.trim()) {
                    tableBody.append(response);
                } 
            },
            error: function() {
                alert("An error occurred while fetching student data.");
            }
        });
    });

    function addNewproductPopup() {
        $.ajax({
            url: "<?= base_url('Product/addNewProductPopup'); ?>",
            type: 'POST',
            dataType: "html",
            data: {
                '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>' 
            },
            cache: false,
            success: function(response) {  
                       
                $("#addNewClinicPopup").html(response);

                $('#addNewClinicPopup').modal({
                    backdrop: 'static',
                    keyboard: false
                }).modal('show');
            }
        });
    }
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a href="<?= base_url('product'); ?>">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Project</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $projectcount; ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
  </a>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $earnings; ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $percentage; ?> %</div>
            </div>
            <div class="col">
              <div class="progress progress-sm mr-2">
                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $percentage; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?= $pendingrequest; ?></div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- masukan untuk plugin baru -->

</div>

</div>
<!-- /.container-fluid -->

<!-- panel -->
<div class="bs-example">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i> Collapse</button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    
<!-- error warning -->
                <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

<!-- Content Profile -->                      
          <div class="row">

          <!-- Content Column -->
          <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
              </div>
              <div class="card-body">

              <form action="admin/addprofile" method="post">
                <input type="hidden" name="id_profile">
                <h4 class="small font-weight-bold">Name <span class="float-right">20%</span></h4>
                  <div class="form-group">
                  <input type="text" class="form-control form-control-sm" name="name_profile" id="name_profile" placeholder="Name" value="<?= $profile['name_profile']; ?>">
                  </div>
                <h4 class="small font-weight-bold">Address <span class="float-right">20%</span></h4>
                  <div class="form-group">
                  <input type="text" class="form-control form-control-sm" name="address_profile" id="address_profile" placeholder="Address" value="<?= $profile['address_profile']; ?>">
                  </div>
                <h4 class="small font-weight-bold">Hp <span class="float-right">20%</span></h4>
                  <div class="form-group">
                  <input type="text" class="form-control form-control-sm" name="hp_profile" id="hp_profile" placeholder="Hp" value="<?= $profile['hp_profile']; ?>">
                  </div>
                <h4 class="small font-weight-bold">Email <span class="float-right">20%</span></h4>
                  <div class="form-group">
                  <input type="text" class="form-control form-control-sm" name="email_profile" id="email_profile" placeholder="Email" value="<?= $profile['email_profile']; ?>">
                  </div>
                  <button type='submit' name='submit' class='btn btn-info'>Update</button>
              </div>
            </div>

            <!-- Color System -->
            <div class="row">
              <div class="col-lg-6 mb-4">
                <div class="card bg-primary text-white shadow">
                
                </a>
                </div>
              </div>
    <!-- <div class="col-lg-6 mb-4">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          Success
          <div class="text-white-50 small">#1cc88a</div>
        </div>
      </div>
    </div> -->
    <!-- <div class="col-lg-6 mb-4">
      <div class="card bg-info text-white shadow">
        <div class="card-body">
          Info
          <div class="text-white-50 small">#36b9cc</div>
        </div>
      </div>
    </div> -->
    <!-- <div class="col-lg-6 mb-4">
      <div class="card bg-warning text-white shadow">
        <div class="card-body">
          Warning
          <div class="text-white-50 small">#f6c23e</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card bg-danger text-white shadow">
        <div class="card-body">
          Danger
          <div class="text-white-50 small">#e74a3b</div>
        </div>
      </div>
    </div> -->
    <!-- <div class="col-lg-6 mb-4">
      <div class="card bg-secondary text-white shadow">
        <div class="card-body">
          Secondary
          <div class="text-white-50 small">#858796</div>
        </div>
      </div>
    </div> -->
  </div>
</form>

</div>

<div class="col-lg-6 mb-4">

  <!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
    </div>
    <div class="card-body">
      <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= base_url('vendor/sbadmin2/img/') ?>undraw_posting_photo.svg" alt="">
      </div>
      <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
      <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
    </div>
  </div>

  <!-- Approach -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
    </div>
    <div class="card-body">
      <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
      <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
    </div>
  </div>

</div>
</div>
<!-- End Content Profile -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end panel -->


</div>
<!-- End of Main Content --> 



<!-- <style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
    }
</style> -->
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
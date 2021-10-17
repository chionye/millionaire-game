<?php include 'userhead.php'; ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Make a transfer</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample">
          <div class="card-body">
            <p>
              Account Name: Quiz <br>
              Account Number: 000000000 <br>
              Bank Name: Zenith Bank.
            </p>
          </div>
        </div>
      </div>
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Pay with card</h6>
        </a>
        <div class="card-title">
          <h3 class="text-center">Pay Invoice</h3>
        </div>
        <div class="form-group text-center">
          <ul class="list-inline">
            <li class="list-inline-item"><i class="text-muted fa fa-cc-visa fa-2x"></i></li>
            <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
            <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
            <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
          </ul>
        </div>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample1">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4 col-12">
                <a href="parsers/initialize2.php?package=silver" class="btn btn-primary btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-money-bill-wave-alt"></i>
                  </span>
                  <span class="text">Silver</span>
                </a>
              </div>
              <div class="my-2"></div>
              <div class="col-sm-4 col-12">
                <a href="parsers/initialize2.php?package=gold" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-coins"></i>
                  </span>
                  <span class="text">Gold</span>
                </a>
              </div>
              <div class="my-2"></div>
              <div class="col-sm-4 col-12">
                <a href="parsers/initialize2.php?package=diamond" class="btn btn-info btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="far fa-gem"></i>
                  </span>
                  <span class="text">Diamond</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <!-- Illustrations -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
        </div>
        <div class="card-body">
          <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
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
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
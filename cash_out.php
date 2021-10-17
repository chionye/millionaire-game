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
        <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Request Cash</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample1">
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Bank Name</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Bank name" id="bank">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Account number</label>
                <input type="text" class="form-control" placeholder="Account Number" id="accnum">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Amount</label>
                <input type="text" class="form-control" placeholder="amount" id="amount">
              </div>
              <input type="submit" value="Send Request" class="btn btn-dark" onclick="cashout();return false">
            </form>
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
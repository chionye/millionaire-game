<?php include 'userhead.php'; ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
<!-- Content Row -->
          <div class="row">
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
              <!-- Color System -->
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Registered Users
                      <div class="text-white-50 small">
                        <?php $nums = json_decode(users());
                        echo count($nums);
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Silver Package Users
                      <div class="text-white-50 small">
                        <?php $nums = json_decode(package('silver'));
                        foreach ($nums as $key) {
                          echo $key;
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Gold Package Users
                      <div class="text-white-50 small"><a href="fund.php" class="text-white">
                        <?php $nums = json_decode(package('gold'));
                        foreach ($nums as $key) {
                          echo $key;
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Diamond Package Users
                      <div class="text-white-50 small">
                        <a class="text-white">
                        <?php $nums = json_decode(package('diamond'));
                        foreach ($nums as $key) {
                          echo $key;
                        }
                        ?>
                      </a>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Fund User Wallet
                      <div class="text-white-50 small"><a href="users.php" class="text-white">Click here</a></div>
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
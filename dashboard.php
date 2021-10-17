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
              Wallet Balance
              <div class="text-white-50 small"><?=money($user->bal)?></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-warning text-white shadow">
            <div class="card-body">
              Play a Game
              <div class="text-white-50 small"><a href="javascript:void(0)" class="text-whit" id="checkForImages">Click here</a></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-secondary text-white shadow">
            <div class="card-body">
              Cash Out
              <div class="text-white-50 small"><a href="cash_out.php" class="text-white">Click here</a></div>
            </div>
          </div>
        </div>
   </div>

 </div>

 <div class="col-lg-6 mb-4">

  <!-- Illustrations -->

</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
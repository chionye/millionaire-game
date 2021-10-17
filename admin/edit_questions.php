<?php include 'userhead.php'; ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Manage Questions</h6>
        </div>
        <div class="card-body">
          <?php  
          $nums = json_decode(questions());
          if (!empty($nums)) {
            ?>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Question</th>
                    <th>edit</th>
                    <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($nums as $user) {
                    ?>
                    <tr>
                      <td><?=$user->question?></td>
                      <td><a href="edit.php?id=<?=$user->id?>" style="color: green"><i class="fa fa-pencil"></i></a></td>
                      <td><a href="#" style="color: red" onclick="deleteQuestion('<?=$user->id?>')"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php }else{ ?>
            <p class="text-center"><span>There are currently no questions added<br><img src="../images/empty.png" class="img-responsive"></span></p>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
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
          <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>email</th>
                  <th>Account Type</th>
                  <th>Edit User</th>
                  <th>Delete User</th>
                </tr>
              </thead>
              <tbody>
                <?php $nums = json_decode(users());
                if (count($nums)) {
                  foreach ($nums as $user) {
                    ?>
                    <tr>
                      <td><?=$user->customername?></td>
                      <td><?=$user->email?></td>
                      <td><?php if($user->type == ''){echo "   not subscibed yet";}else{echo $user->type;}?></td>
                      <td><a href="details.php?id=<?=$user->cId?>" style="color: green"><i class="fa fa-pencil"></i></a></td>
                      <td><a href="#" style="color: red" onclick="deleteUser('<?=$user->cId?>')"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php }} ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
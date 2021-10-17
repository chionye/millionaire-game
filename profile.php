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
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><?=$username?></h6>
        </div>
        <div class="card-body">
          <label for="exampleFormControlSelect1">Company Logo</label>
          <div>
            <div id="resizer-demo"></div>
          </div>
            <form class="text-center" id="formSub">
                <div>
                  <input type="file" value="choose an image" id="d" name="customFile" onchange="showPreview(this)" style="display: none;">
                  <input type="button" class="btn btn-primary" value="Browse..." onclick="document.getElementById('d').click();" />
      <td></td>
                </div>
                <button type="button" class=" btn btn-primary mt-2" id="submitPic">Submit</button>
              </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <!-- Illustrations -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Change password</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Change password</label>
              <input type="password" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter password" id="pass1">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Confirm Password Change</label>
              <input type="password" class="form-control" placeholder="Confirm password" value="" id="pass2">
            </div>
            <input type="submit" value="update" class="btn btn-dark" onclick="changepass();return false">
          </form>
        </div>
      </div>
      <!-- Approach -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Update Details</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" value="<?=$user->cout_email?>" aria-describedby="emailHelp" placeholder="Enter email" id="email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Phone</label>
              <input type="tel" class="form-control" placeholder="phone" value="<?=$user->cout_phone?>" id="phone">
            </div>
            <input type="submit" value="update" class="btn btn-dark" onclick="update_details();return false">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
<?php include 'userhead.php'; ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<?php if (isset($_GET['id'])){
  $id = $_GET['id'];
}?>
<div class="container-fluid">
  <!-- Content Row -->
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
        </div>
        <div class="card-body">
          <form>
            <?php 
            $dec = get_cust1($id);
            $num = json_decode($dec);
            if (count($num)) {
              foreach ($num as $u){
                ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Full Name</label>
                  <input type="text" class="form-control" value="<?=$u->customername?>" aria-describedby="emailHelp" placeholder="Enter email" id="name">
                  <input type="text" class="form-control" hidden value="<?=$u->cId?>" aria-describedby="emailHelp" placeholder="Enter email" id="id">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" value="<?=$u->email?>" aria-describedby="emailHelp" placeholder="Enter email" id="email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Phone</label>
                  <input type="text" class="form-control" placeholder="phone" value="<?=$u->telephone?>" id="phone">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Balance</label>
                  <input type="text" class="form-control" placeholder="balance" value="<?php if($u->current_balance == ''){echo '0';}else{echo $u->current_balance;}?>" id="balance">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Referrer Bonus</label>
                  <input type="text" class="form-control" placeholder="balance" value="<?php if($u->clientid == ''){echo '0';}else{echo $u->clientid;}?>" id="ref">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Package</label>
                  <select class="form-control"  name="type" id="package">
                    <option>not yet registered</option>
                    <option>Silver</option>
                    <option>Gold</option>
                    <option>Diamond</option>
                  </select>
                </div>
                <input type="submit" value="update" class="btn btn-dark" onclick="update_details1();return false">
              </form>
            <?php }} ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
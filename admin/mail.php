<?php include 'userhead.php'; ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-10 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Send a mail</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Sender</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Receiver Email" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Receiver</label>
              <select class="form-control" id="email" name="email">
                <?php $nums = json_decode(users());
                if (count($nums)) {
                foreach ($nums as $user) {
                ?>
                <option value="<?=$user->email?>"><?=$user->customername?></option>
                <?php } }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Subject</label>
              <input type="text" class="form-control" placeholder="Enter Subject" id="subject" name="subject">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Message</label>
              <textarea class="form-control" rows="3" name="message" id="message"></textarea>
            </div>
            <input type="submit" value="send" class="btn btn-primary" name="sendmail" onclick="sendmails();return false;">
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
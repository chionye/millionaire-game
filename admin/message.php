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
          <h6 class="m-0 font-weight-bold text-primary">Send a message</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Receiver</label>
              <select class="form-control"  name="name" id="name">
                <?php
                $get = users();
                $fetch = json_decode($get);
                if (count($fetch)) {
                foreach ($fetch as $p) {
                ?>
                <option><?=$p->customername?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Subject</label>
              <input type="text" class="form-control" placeholder="Enter Subject" id="subject">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Message</label>
              <textarea class="form-control" rows="3" name="message" id="message"></textarea>
            </div>
            <input type="submit" value="Submit" onclick="sendmess();return false">
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
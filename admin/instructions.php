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
          <h6 class="m-0 font-weight-bold text-primary">Update Instructions</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Enter Instructions</label>
              <?php $nums = json_decode(comprehension()); ?>
              <textarea class="form-control" id="instruction"><?=$nums[0]->terms_type?></textarea>
            </div>
            <input type="submit" value="Add" class="btn btn-dark" onclick="add_instruction();return false">
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
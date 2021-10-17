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
          <h6 class="m-0 font-weight-bold text-primary">Edit Genre</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Edit Genre</label>
              <?php
              $genre = json_decode(getGenre($id));
              if (count($genre)) {
                foreach ($genre as $v) {
                  ?>
                  <input type="text" class="form-control" value="<?=$v->genre?>" placeholder="Edit Genre" id="genre">
                <?php }} ?>
              </div>
              <input type="submit" value="Edit" class="btn btn-dark" onclick="updateGenre('<?=$v->id?>');return false">
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
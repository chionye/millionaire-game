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
          <h6 class="m-0 font-weight-bold text-primary">Edit/Delete Questions and Answers</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Edit Question</label>
              <?php
              $question = json_decode(get_question($id));
              if (count($question)) {
                foreach ($question as $v) {
                  ?>
                  <input type="text" class="form-control" value="<?=$v->question?>" aria-describedby="emailHelp" placeholder="Enter question" id="question">
                <?php }} ?>
              </div>
              <?php
              $i = 0;
              $ans = json_decode(get_ans($id));
              if (count($ans)) {
                foreach ($ans as $a) {
                  $i++;
                  ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Option <?=$i?></label>
                    <input type="text" value="<?=$a->ans?>" class="form-control" placeholder="Option <?=$i?>" id="answer<?=$i?>">
                  </div>
                <?php }} ?>
                <input type="submit" value="Edit" class="btn btn-dark" onclick="update_questions();return false">
                <input type="submit" value="Delete" class="btn btn-danger" onclick="delete_questions();return false">
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
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
          <h6 class="m-0 font-weight-bold text-primary">Upload Questions and Answers</h6>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Question Code</label>
              <select class="form-control" id="question_code">
                <option>-select question code-</option>
                 <?php  
                  $nums = json_decode(questionCodes());
                  if (!empty($nums)) {
                    foreach ($nums as $user) {
                      if ($user->available_questions <= 10) {
                  ?>
                  <option><?=$user->question_code?></option>
                <?php }}}?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Enter Question</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter question" id="question">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Option 1</label>
              <input type="text" class="form-control" placeholder="Option 1" id="answer1">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Option 2</label>
              <input type="text" class="form-control" placeholder="Option 2" id="answer2">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Option 3</label>
              <input type="text" class="form-control" placeholder="Option 3" id="answer3">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Correct answer</label>
              <input type="text" class="form-control" placeholder="answer" id="answer5">
            </div>
            <input type="submit" value="Add" class="btn btn-dark" onclick="add_questions();return false">
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
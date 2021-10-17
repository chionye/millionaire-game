<?php include 'quizhead.php'; 
$vals = json_decode(questions());
?>
<div class="container" id="main-cont">
  <!-- Outer Row -->
  <div class="row justify-content-center">
    <div class="col-md-8 offset-md-2">
      <div class="row">
        <div class="col-md-5 text-center">
          <img src="images/profile.png" class="img-thumbnail rounded-circle">
          <p class="title-text">You</p>
        </div>
        <div class="col-md-2 text-center">
          <div class="d-flex justify-content-center align-items-center h-100">
          <h1 class="title-text">vs</h1>
          </div>
        </div>
        <div class="col-md-5 text-center">
          <img src="images/profile.png"  class="img-thumbnail rounded-circle">
          <p class="title-text">Player 2</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'quizfoot.php';?>
<?php include 'quizhead.php'; 
$vals = json_decode(questions());
?>
<div class="container" id="main-cont">
  <!-- Outer Row -->
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="text-center">
        <img src="images/trivia.png" class="img-fluid">
      </div>
    </div>
    <div class="col-xl-10 col-lg-12 col-md-9 text-center">
      <div class="row">
        <div class="col-md-4">
          <a href="javascript:void" data-toggle="modal" data-target="#exampleModalLong" data-backdrop="static" data-keyboard="false"><img src="images/play.png" class="img-fluid game-btn"></a>
        </div>
        <div class="col-md-4">
          <a href="javascript:void" data-toggle="modal" data-target="#exampleModalLongInstructions"><img src="images/ins.png" class="img-fluid game-btn"></a>
        </div>
        <div class="col-md-4 mt-2">
          <a href="javascript:void" data-toggle="modal" data-target="#exampleModalLongComprehension"><img src="images/btn.png" class="img-fluid game-btn"></a>
        </div>
      </div>
    </div>
  </div>
</div>
 <audio controls id="aud" style="display:none" loop>
        <source src="sound/song.mpeg" type="">
    </audio>
    <script type="text/javascript">
    document.getElementById('aud').play();
    </script>
<?php include 'quizfoot.php';?>
<?php include 'quizhead.php'; ?>
<audio src="sound/song.mpeg">
<p>If you are reading this, it is because your browser does not support the audio element.     </p>
</audio>
<?php 
    if (isset($_COOKIE['currentGame'])){
        setcookie("currentGame", "", time() - 3600);
    }
?>
<body class="fog-light-bg">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center game-interface">
      <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <div class="row">
          <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-12">
            <h1>Countdown Clock</h1>
            <div id="clockdiv">
              <div>
                <span class="hours"></span>
                <div class="smalltext">Hours</div>
              </div>
              <div>
                <span class="minutes"></span>
                <div class="smalltext">Minutes</div>
              </div>
              <div>
                <span class="seconds"></span>
                <div class="smalltext">Seconds</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-10 col-lg-12 col-md-12 col-12">
        <div class="title-text">
          <div class="card text-white" style="border:none;background: transparent;">
            <img class="card-img" src="images/board.png" alt="Card image">
            <div class="card-img-overlay p-md-5">
              <p class="h5 card-text text-dark mt-md-5" id="question" style="color: #183650;">Ready???</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-10 col-lg-12 col-md-12 text-center">
        <form id="gameOptions">
          <div class="form-row">
            <div class="col-md-5 ml-md-5">
              <div class="card text-white game-btn" style="border:none;background: transparent;">
                <img class="card-img" src="images/ansleft.png" alt="Card image">
                <div class="card-img-overlay">
                  <p class="card-text text-left title-text" id="ans1" style="color: #183650;">Ready!!!</p>
                </div>
              </div>
            </div>
            <div class="col-md-5 offset-md-1">
              <div class="card text-white game-btn" style="border:none;background: transparent;">
                <img class="card-img" src="images/ansright.png" alt="Card image">
                <div class="card-img-overlay">
                  <p class="card-text text-left title-text" id="ans2" style="color: #183650;">Ready!!!</p>
                </div>
              </div>
            </div>
            <div class="col-md-5 ml-md-5">
              <div class="card text-white game-btn" style="border:none;background: transparent;">
                <img class="card-img" src="images/ansleft.png" alt="Card image">
                <div class="card-img-overlay">
                  <p class="card-text text-left title-text" id="ans3" style="color: #183650;">Ready!!!</p>
                </div>
              </div>
            </div>
            <div class="col-md-5 offset-md-1">
              <div class="card text-white game-btn" style="border:none;background: transparent;">
                <img class="card-img" src="images/ansright.png" alt="Card image">
                <div class="card-img-overlay">
                  <p class="card-text text-left title-text" id="ans4" style="color: #183650;">Ready!!!</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-6 text-center">
              <div class="row">
                <div class="col-md-4 offset-md-4">
                  <a href="javascript:void" onclick="prvQuest()"><img src="images/prv.png" class="img-fluid mt-3"></a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-6">
              <div class="row">
                <div class="col-md-4 offset-md-4">
                  <a href="javascript:void" onclick="nextQuest()"><img src="images/nxt.png" class="img-fluid"></a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <audio controls id="aud" style="display:none" loop>
        <source src="sound/song.mpeg" type="">
    </audio>
    <script type="text/javascript">
    document.getElementById('aud').play();
    </script>
</body>
<?php include 'quizfoot.php'; ?>
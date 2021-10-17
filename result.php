<?php include 'quizhead.php'; ?>

   <body class="bg-gradient-primary" style="background-image: url('images/quiz7.png');background-size: cover;">
    <div class="container">
      <!-- Outer Row -->
      <div class="row">
        <div class="col-md-8  offset-md-2">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
              <p class="title-text">Results</p>
            </div>
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-12">
                <div class="row pb-3">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                        <table class="table table-striped text-center">
                          <thead>
                            <tr>
                              <th scope="col">
                                  <img src="images/profile.png" class="img-thumbnail rounded-circle p1-pic">
                              </th>
                              <th scope="col">
                                  <img src="images/profile.png" class="img-thumbnail rounded-circle p2-pic">
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row"><p class="p1Name">P1</p></th>
                              <th><p class="p2Name">P2</p></th>
                            </tr>
                            <tr>
                             <th scope="row" class="p1Score">Score: 6</th>
                              <th class="p2Score">Score: 7</th>
                            </tr>
                            <tr>
                              <th scope="row" class="p1Time">Time 00:20</th>
                              <th class="p2Time">Time 00:30</th>
                            </tr>
                            <tr>
                              <th scope="row" class="p1Result">Undecided</th>
                              <th class="p2Result">Undecided</th>
                            </tr>
                          </tbody>
                        </table>
                        </div>
                      <div class="col-md-12 text-center">
                          <button class="btn btn-outline-primary replay ml-1 mr-1">Replay</button>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php include 'quizfoot.php'; ?>
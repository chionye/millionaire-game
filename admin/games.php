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
          <h6 class="m-0 font-weight-bold text-primary">Manage Questions</h6>
        </div>
        <div class="card-body">
          <?php  
          $nums = json_decode(game());
          if (!empty($nums)) {
            ?>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>player 1</th>
                    <th>player 2</th>
                    <th>Amount</th>
                    <th>Question Code</th>
                    <th>Game Code</th>
                    <th>player 1 Score</th>
                    <th>player 2 Score</th>
                    <th>player 1 time</th>
                    <th>player 2 time</th>
                    <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($nums as $user) {
                    $sql = $db->query("select * from customer where cId = '$user->player1'")->fetch_assoc();
                    $sql1 = $db->query("select * from customer where cId = '$user->player2'")->fetch_assoc();
                    ?>
                    <tr>
                      <td><?php if(isset($sql['customername']) && $sql['customername'] != ''){echo $sql['customername'];}else{ echo "no player 1 yet";}?></td>
                      <td><?php if(isset($sql1['customername']) && $sql1['customername'] != ''){echo $sql1['customername'];}else{ echo "no player 2 yet";}?></td>
                      <td><?=$user->amount?></td>
                      <td><?=$user->question_type?></td>
                      <td><?=$user->game_code?></td>
                      <td><?=$user->p1_score?></td>
                      <td><?=$user->p2_score?></td>
                      <td><?=$user->p1_time?></td>
                      <td><?=$user->p2_time?></td>
                      <td><a href="javascript:void(0)" style="color: red" onclick="deleteGame('<?=$user->id?>')"><i class="fa fa-trash"></i></a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php }else{ ?>
            <p class="text-center"><span>There are currently no questions added<br><img src="../images/empty.png" class="img-responsive"></span></p>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php include 'userfoot.php'; ?>
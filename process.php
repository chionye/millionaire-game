<?php
include 'database/connect.php';
$output = "";
$id = isset($_COOKIE['uid'])?$_COOKIE['uid']:'';

function multiarray_keys($ar = array()) {
	$keys = [];
	foreach($ar as $k => $v) {
		$keys[] = $k;
		if (is_array($ar[$k]))
			$keys = array_merge($keys, multiarray_keys($ar[$k]));
	}
	return $keys;
}

if (isset($_POST['send'])) {
	$amount = $_POST['amount'];
	$questions = $_POST['questions'];
	$chosen = [];
	$o = $db->query("SELECT * FROM customer WHERE cId = '$id'");
	if ($o->num_rows > 0){
		$fetch = $o->fetch_assoc();
		$balance = $fetch['current_balance'];
		if ($amount == '') {
			$output = 'you must enter an amount';
			echo $output;
		}else{
			if ($balance < $amount) {
				$output = 'you have insufficient funds for this operation';
				echo $output;
			}else{
				if ($amount < 50) {
					$money = money(50);
					$output = 'you cannot subscribe with less than $money';
					echo $output;
				}else{
					$new = $balance - (int)$amount;
					$p = $db->query("UPDATE customer SET current_balance = '$new' WHERE cId='$id'");
					if ($p == true){
						foreach ($questions as $key) {
							$p = $db->query("SELECT * FROM questions WHERE id = '$key'");
							if ($p->num_rows > 0) {
								while ($row = $p->fetch_assoc()) {
									$questio = $row['question'];
								}
								$chosen[] = $questio;
							}
						}
// setcookie('questions', 'on', time()+3600, '/');
						$_SESSION['questions'] = 'on';
						$arr = array("amount"=>$amount,"questions"=>$chosen);
						$n = json_encode($arr);
						$cookiename = 'quiz';
						setcookie($cookiename, $n, time() + 3600, '/');
						$_SESSION['scores'] = '';
						echo "ok";
					}
				}
			}
		}
	}
} 

if (isset($_POST['retry'])) {
	$score = $_SESSION['scores'];
	$quiz = $_COOKIE['quiz'];
	unset($score);
	unset($quiz);
	setcookie('quiz','',time()-(60*60*24*30),"/");
	echo "<script>window.location.replace('quiz.php')</script>";
}

if (isset($_POST['cancel'])) {
	$game = $_POST['game'];
	$sql = $db->query("select * from game where game_code = '$game'")->fetch_assoc();
    $buy = $sql['amount'];
    $stat = $_POST['player'] == 'p1'?'p1_stat':'p2_stat';
    $score = $_POST['player'] == 'p1'?'p1_score':'p2_score';
    $play = $_POST['player'] == 'p1'?'player1':'player2';
    $player =$_POST['player'] == 'p1'?$sql['player1']:$sql['player2'];
    $opp = 	$_POST['player']."_stat";
    if ($_POST['player'] == 'p1' && $sql['player2'] == '') {
    	$del = $db->query("delete from game where game_code = '$game'");
    }
    if ($_POST['player'] == 'p2' && $sql['player1'] == '') {
    	$del = $db->query("delete from game where game_code = '$game'");
    }
    if ($sql['player1'] != '' && $sql['player2'] != '') {
    	 $query = $db->query("update game set $play = '', $stat = '', $score = '',  $opp = 'waiting' where game_code = '$game'");
    }
    $query1 = $db->query("select * from customer where cId = '$player'")->fetch_assoc();
    $amount = (int)$query1['current_balance'];
    $newAmt = (int)$buy + $amount;
   $query = $db->query("update customer set current_balance = '$newAmt' where cId = '$player'");
    if ($query){
        $arr = array("success"=>true, "game"=>$sql);
    }else{
        $arr = array("success"=>false);
    }
    $json = json_encode($arr);
    echo $json;
}

if (isset($_POST['submit'])){
	$check = isset($_POST['check'])?$_POST['check']:'';
	$quest = isset($_POST['quest'])?$_POST['quest']:'';
	$page = isset($_POST['page'])?$_POST['page']:'';
	$total = isset($_POST['total'])?$_POST['total']:'';
	$progress1 = isset($_SESSION['scores']) && !empty($_SESSION['scores'])?json_decode($_SESSION['scores'],true): array();
	$id = $_COOKIE['uid'];
	$p = (int)$page + 1;
	$v = (int)$page;
	$s = $v - 1;
	$sql = $db->query("SELECT * FROM answers WHERE id ='$check'");
	if ($sql->num_rows > 0) {
		while ($row = $sql->fetch_assoc()) {
			$ans = $row['correct'];
		}
		if (!empty($progress1)) {
			if (array_key_exists($page, $progress1)) {
				$progress1[$page] = $ans;
			}else{
				$progress1[$page] = $ans;
			}
		}else{
			$progress1[$page] = $ans;
		}
	}
	$itemdata = json_encode($progress1);
	$_SESSION['scores'] = $itemdata;
	if ($p <= $total) {
		$output="next";
		echo $output;	
	}else{
		$output="finish";
		echo $output;
	}
	
}

function createGameId(){
	global $db;
	$game_code = uniqid();
	$sql = $db->query("select * from game where game_code = '$game_code'");
	if ($sql->num_rows > 0) {
		createGameId();
	}
	return $game_code;
}

if (isset($_POST['paytoplay'])) {
	$ids = '';
	$arr = array();
	$ques = array();
	extract($_POST);
	$sql = $db->query("insert into transactions(email,amount, trans_ref) values ('$email', '$amount','$ref')");
	if ($sql) {
		$sql = $db->query("select * from game where amount = '$amount' and p2_stat = 'waiting'");
		if ($sql->num_rows > 0) {
			$dt = array();
			while ($data = $sql->fetch_assoc()) {
				$dt[] = $data;
			}
			$game_code = $dt[0]['game_code'];
			$p1 = $dt[0]['player1'];
			if ($p1 == $id) {
				$game_code = createGameId();
				$sql = $db->query("insert into game(player1,player2, amount, p1_stat,p2_stat, game_code, p1_time,p2_time,p1_score,p2_score,question_type)values('$id','','$amount', 'available', 'waiting', '$game_code','','',0,0,'')");
				if ($sql) {
					$sql = $db->query("select * from customer where cId = '$id'")->fetch_assoc();
					$output = array("success"=>true, "player"=>"p1", "game_code"=>$game_code, "user"=>$sql);
					$output = json_encode($output);
					echo $output;
				}
			}else{
				$sql = $db->query("update game set player2 = '$id', p2_stat = 'available', p2_score = '0' where game_code = '$game_code'");
			if($sql){
				$p1_id = $dt[0]['player1'];
				$p2_id = $dt[0]['player2'];
				$game_code = $dt[0]['game_code'];
				$sql = $db->query("select * from customer where cId = '$p1_id'")->fetch_assoc();
				$sql1 = $db->query("select * from customer where cId = '$id'")->fetch_assoc();
				$output = array("success"=>true, "player"=>"p2", "p1_data"=>$sql, "user"=>$sql1, "game_code"=>$game_code);
				$output = json_encode($output);
				echo $output;
			}
			}
		}else{
			$game_code = createGameId();
			$sql = $db->query("insert into game(player1,player2, amount, p1_stat,p2_stat, game_code, p1_time,p2_time,p1_score,p2_score,question_type)values('$id','','$amount', 'available', 'waiting', '$game_code','','',0,0,'')");
			if ($sql) {
				$sql = $db->query("select * from customer where cId = '$id'")->fetch_assoc();
				$output = array("success"=>true, "player"=>"p1", "game_code"=>$game_code, "user"=>$sql);
				$output = json_encode($output);
				echo $output;
			}
		}
	}
}

if (isset($_POST['checkIfPlayerAdded']) && $_POST['checkIfPlayerAdded'] == 1) {
	extract($_POST);
	$sql = $db->query("select * from game where player1 = '$id' and game_code = '$code'");
	if ($sql->num_rows > 0) {
		$data = $sql->fetch_assoc();
		if ($data['p2_stat'] == 'available') {
			$p2_id = $data['player2'];
			$p1_id = $data['player1'];
			if($p2_id == $p1_id){
				$sql = $db->query("update game set player2 = '', p2_stat = 'waiting', p2_score = '' where game_code = '$code'");
				$result = array("game"=>$data);
			}else{
				$sql = $db->query("select * from customer where cId = '$p2_id'")->fetch_assoc();
				$sql1 = $db->query("select * from customer where cId = '$p1_id'")->fetch_assoc();
				$result = array("p2_data"=>$sql, "p1_data"=>$sql1, 'game'=>$data);
			}
		}else{
			$result = array("game"=>$data);
		}
		$result = json_encode($result);
		echo $result;
	}
}

if (isset($_POST['imReady']) && $_POST['imReady'] == 1) {
	extract($_POST);
	$field = $player."_stat";
	$sql = $db->query("update game set $field = 'ready' where game_code = '$code'");
	if ($sql) {
		$sql = $db->query("select * from game where game_code = '$code'")->fetch_assoc();
		$output = array('success'=>true, "data"=>$sql);
		$output = json_encode($output);
		echo $output;
	}
}

if (isset($_POST['readyUser']) && $_POST['readyUser'] == 1) {
	   extract($_POST);
    if ($user == 'p1') {
    $sql = $db->query("update game set p1_stat = 'ready' where game_code = '$code'");
    $pp = $db->query("select * from game where game_code = '$code'");
    $p = $pp->fetch_assoc();
    // print_r($p);
    $pp1 = $p['player1'];
    $pp2 = $p['player2'];
    $qcode = $p['question_type'];
    $games = array();
     if ($qcode == '') {
      $search = $db->query("select games_played from games_played where user_id = '$pp1'");
      if ($search->num_rows > 0) {
        while ($gamesPlayed = $search->fetch_assoc()) {
            $games[] = $gamesPlayed['games_played'];
        }
      }
    
      $search1 = $db->query("select games_played from games_played where user_id = '$pp2'");
       if ($search->num_rows > 0) {
        while ($gamesPlayed1 = $search1->fetch_assoc()) {
            $games[] = $gamesPlayed1['games_played'];
         }
        }
        // print_r($games);
        if (count($games) == 0) {
             $qcod = $db->query("select question_code from questions");
        }else{
            $count = count($games);
            $gameP = [];
            for ($i=0; $i < $count; $i++) { 
                if ($games[$i] != '') {
                    $gameP[] = $games[$i];
                }
            }
            // print_r($gameP);
            $games = implode(",", $gameP);
                $qcod = $db->query("select question_code from questions where question_code not in ($games)");
            // $t = $qcod->fetch_assoc();
            // print_r($t);
            // print_r($games);

        }
       $qc = $qcod->fetch_assoc();
       $qcode = $qc['question_code'];
       $sql = $db->query("update game set question_type = '$qcode' where game_code = '$code'");
        }
       $getThem = $db->query("select * from questions where question_code = '$qcode'")->fetch_assoc();
      $qcode = $getThem['question_code'];
      $ques = $db->query("select * from questions where question_code = '$qcode' order by date desc limit 10");
      $array = array();
      $array1 = array();
      $i = 1;
      while($row = $ques->fetch_assoc()){
        $array1[] = $row;
      }
      $count = count($array1);
      for ($i=0; $i < $count; $i++) { 
        $quid = $array1[$i]['id'];
        $ans = $db->query("select * from answers where qu_id = '$quid'");
        while ($ansrow = $ans->fetch_assoc()) {
          $array1[$i]['answers'][] = $ansrow;
        }
      } 
    $sql = $db->query("update game set p1_stat = 'ready' where game_code = '$code'");
    $pp = $db->query("select * from game where game_code = '$code'");
    $p = $pp->fetch_assoc();
    $qcode = $p['question_type'];
    if($qcode != ''){
            $getThem = $db->query("select * from questions where question_code = '$qcode'")->fetch_assoc();
              $qcode = $getThem['question_code'];
              $ques = $db->query("select * from questions where question_code = '$qcode' order by date desc limit 10");
              $array = array();
              $array1 = array();
              $i = 1;
              while($row = $ques->fetch_assoc()){
                $array1[] = $row;
              }
              $count = count($array1);
              for ($i=0; $i < $count; $i++) { 
                $quid = $array1[$i]['id'];
                $ans = $db->query("select * from answers where qu_id = '$quid'");
                while ($ansrow = $ans->fetch_assoc()) {
                  $array1[$i]['answers'][] = $ansrow;
                }
              } 
        }
   }
  if ($user == 'p2') {
     $sql = $db->query("update game set p2_stat = 'ready' where game_code = '$code'");
    $pp = $db->query("select * from game where game_code = '$code'");
    $p = $pp->fetch_assoc();
    // print_r($p);
    $pp1 = $p['player1'];
    $pp2 = $p['player2'];
    $qcode = $p['question_type'];
    $games = array();
     if ($qcode == '') {
            $games = array();
      $search = $db->query("select games_played from games_played where user_id = '$pp1'");
      if ($search->num_rows > 0) {
        while ($gamesPlayed = $search->fetch_assoc()) {
            $games[] = $gamesPlayed['games_played'];
        }
      }
    
      $search1 = $db->query("select games_played from games_played where user_id = '$pp2'");
       if ($search->num_rows > 0) {
        while ($gamesPlayed1 = $search1->fetch_assoc()) {
            $games[] = $gamesPlayed1['games_played'];
         }
        }
        // print_r($games);
        if (count($games) == 0) {
             $qcod = $db->query("select question_code from questions");
        }else{
            $count = count($games);
            $gameP = [];
            for ($i=0; $i < $count; $i++) { 
                if ($games[$i] != '') {
                    $gameP[] = $games[$i];
                }
            }
            // print_r($gameP);
            $games = implode(",", $gameP);
                $qcod = $db->query("select question_code from questions where question_code not in ($games)");
            // $t = $qcod->fetch_assoc();
            // print_r($t);
              // print_r($games);
        }
       $qc = $qcod->fetch_assoc();
       $qcode = $qc['question_code'];
       $sql = $db->query("update game set question_type = '$qcode' where game_code = '$code'");
    }
      $getThem = $db->query("select * from questions where question_code = '$qcode'")->fetch_assoc();
      $qcode = $getThem['question_code'];
      $ques = $db->query("select * from questions where question_code = '$qcode' order by date desc limit 10");
      $array = array();
      $array1 = array();
      $i = 1;
      while($row = $ques->fetch_assoc()){
        $array1[] = $row;
      }
      $count = count($array1);
      for ($i=0; $i < $count; $i++) { 
        $quid = $array1[$i]['id'];
        $ans = $db->query("select * from answers where qu_id = '$quid'");
        while ($ansrow = $ans->fetch_assoc()) {
          $array1[$i]['answers'][] = $ansrow;
        }
      } 
    $sql = $db->query("update game set p2_stat = 'ready' where game_code = '$code'");
    $pp = $db->query("select * from game where game_code = '$code'");
    $p = $pp->fetch_assoc();
    $qcode = $p['question_type'];
    if($qcode != ''){
            $getThem = $db->query("select * from questions where question_code = '$qcode'")->fetch_assoc();
              $qcode = $getThem['question_code'];
              $ques = $db->query("select * from questions where question_code = '$qcode' order by date desc limit 10");
              $array = array();
              $array1 = array();
              $i = 1;
              while($row = $ques->fetch_assoc()){
                $array1[] = $row;
              }
              $count = count($array1);
              for ($i=0; $i < $count; $i++) { 
                $quid = $array1[$i]['id'];
                $ans = $db->query("select * from answers where qu_id = '$quid'");
                while ($ansrow = $ans->fetch_assoc()) {
                  $array1[$i]['answers'][] = $ansrow;
                }
              } 
        }
 }
$sql = $db->query("select * from game where game_code = '$code'")->fetch_assoc();
$output = array('success'=>true, "data"=>$sql, 'questions'=>$array1);
$output = json_encode($output);
echo $output;
}

if (isset($_POST['checkForCorrectAns']) && $_POST['checkForCorrectAns'] == 'check') {
	$timing = $_POST['timing'];
	$player = $_POST['player'];
	$game_code = $_POST['game'];
	array_pop($_POST);
	array_pop($_POST);
	array_pop($_POST);
	array_pop($_POST);
	$count = count($_POST);
	$checker = 0;
	forEach ($_POST as $key => $value) { 
		$sql = $db->query("select correct from answers where id = '$value'");
		while($row = $sql->fetch_assoc()){
			if ($row['correct'] == 1) {
				$checker++;
			}
		}
	}
	if ($player == 'p1') {
		$sql = $db->query("update game set p1_time = '$timing', p1_score = '$checker', p1_stat = 'completed' where game_code = '$game_code'");
	}
	if ($player == 'p2') {
		$sql = $db->query("update game set p2_time = '$timing', p2_score = '$checker', p2_stat = 'completed' where game_code = '$game_code'");
	}
		$sql2 = $db->query("select * from game where game_code = '$game_code'")->fetch_assoc();
		$p1ID = $sql2['player1'];
		$p1Time = $sql2['p1_time'];
		$p2Time = $sql2['p2_time'];
		$p2score = $sql2['p2_score'];
		$p1score = $sql2['p1_score'];
		$p2ID = $sql2['player2'];
		$sql3 = $db->query("select * from customer where cId = '$p1ID'")->fetch_assoc();
		$sql4 = $db->query("select * from customer where cId = '$p2ID'")->fetch_assoc();
		$output = array("p1score"=>$p1score,"p2score"=>$p2score, "total"=>$count, "p1Time"=>$p1Time,"p2Time"=>$p2Time, "game_details"=>$sql2, "p1"=>$sql3, "p2"=>$sql4);
		$output = json_encode($output);
		echo $output;
	}

	if (isset($_POST['getGameDetails']) && $_POST['getGameDetails'] != '') {
		extract($_POST);
		$sql2 = $db->query("select * from game where game_code = '$getGameDetails'")->fetch_assoc();
		$json = json_encode($sql2);
		echo $json;
	}

	if (isset($_POST['updateScoreSheetnRecord']) && $_POST['updateScoreSheetnRecord'] == 1) {
		extract($_POST);
		if ($winner != '') {
			$victor = $winner."_result";
			$sql = $db->query("update game set $victor = '1' where ");
		}
		$sql1 = $db->query("select * from game where game_code = '$code'")->fetch_assoc();
		$player1 = $sql1['player1'];
		$player2 = $sql1['player2'];
		$amount = (int)$sql1['amount'] * 2;
		$percentage = (10/100) * $amount;
		$amount = $amount - $percentage;
		if ($winner == 'p1') {
			$sql = $db->query("update customer set current_balance = '$amount' where cId = '$player1'");
		}
		if ($winner == 'p2') {
			$sql = $db->query("update customer set current_balance = '$amount' where cId = '$player2'");
		}
		if ($winner == '') {
			$amount = ceil($amount/2);
			$sql1 = $db->query("update customer set current_balance = '$amount' where cId = '$player1'");
			$sql2 = $db->query("update customer set current_balance = '$amount' where cId = '$player2'");
		}
		echo "ok";
	}

	if (isset($_POST['writeToFile'])) {
		$d = $_POST['writeToFile'];
		$filename = $_POST['filename'];
		$fp = fopen($filename, 'a');
		if ($_POST['user'] == 'p1') {
			fwrite($fp, '<li style="width:100%"><div class="msj macro"><div class="avatar"><img class="img-circle" style="width:100%;" src="" /></div><div class="text text-l"><p>'.$d.'</p><p><small>'.date("g:i A").'</small></p></div></div></li>');
		}
		if ($_POST['user'] == 'p2') {
			fwrite($fp, '<li style="width:100%;"><div class="msj-rta macro"><div class="text text-r"><p>'.$d.'</p><p><small>'.date("g:i A").'</small></p></div><div class="avatar" style="padding:0px 0px 0px 10px !important"><img class="img-circle" style="width:100%;" src="" /></div></li>');
		}
	    fclose($fp);
	    echo 'ok';
	}

	if (isset($_POST['getFile']) && $_POST['getFile'] == 1) {
		$fileName = $_POST['fileName'];
	     if(file_exists($fileName) && filesize($fileName) > 0){
			    $handle = fopen($fileName, "r");
			    $contents = fread($handle, filesize($fileName));
			    fclose($handle);
			    echo $contents;
			}
	 }

	 if (isset($_POST['deleteFile']) && $_POST['deleteFile'] == 1) {
	 	extract($_POST);
         if(file_exists($fileName) && filesize($fileName) > 0){
		    unlink($fileName);
		    echo "ok";
		}
	}

	if (isset($_POST['updateGamesPlayed']) && $_POST['updateGamesPlayed'] == 1) {
		$game = $_POST['game'];
		$p1 = $_POST['p1'];
		$p2 = $_POST['p2'];
		$sql = $db->query("insert into games_played (user_id, games_played) values ('$p1', '$game')");
		$sql1 = $db->query("insert into games_played (user_id, games_played) values ('$p2', '$game')");
		if ($sql && $sql1) {
			echo 'ok';
		}
	}

	if (isset($_POST['refresh']) && $_POST['refresh'] == 1) {
		$game = $_POST['game'];
		$player = $_POST['player'];
		$sql = $db->query("select * from game where game_code = '$game'");
		if ($sql->num_rows > 0) {
		$sq = $sql->fetch_assoc();
		$p1 = $sq['player1'];
		$p2 = $sq['player2'];
		$amt = (int)$sq['amount'];
		$amt1 = (10/100) * $amt;
		$amt -= $amt1;
		if ($player == 'p1' && $p1 != '') {
			if ($sq['player2'] == '') {
				$sql1 = $db->query("delete from game where game_code = '$game'");
			}else{
				$sql1 = $db->query("update game set player1 = '', p1_stat = 'waiting', p1_score = '' where game_code = '$game'");
			}
			$sql2 = $db->query("select * from customer where cId = '$p1'")->fetch_assoc();
			$bal = (int)$sql2['current_balance'] + $amt;
			$sql3 = $db->query("update customer set current_balance = '$bal' where cId = '$p1'");
			if ($sql3) {
				echo 'ok';
			}
		}

		if ($player == 'p2' && $p1 != '') {
			if ($sq['player1'] == '') {
				$sql1 = $db->query("delete from game where game_code = '$game'");
			}else{
				$sql1 = $db->query("update game set player2 = '', p2_stat = 'waiting', p2_score = '' where game_code = '$game'");
			}
			$sql2 = $db->query("select * from customer where cId = '$p2'")->fetch_assoc();
			$bal = (int)$sql2['current_balance'] + $amt;
			$sql3 = $db->query("update customer set current_balance = '$bal' where cId = '$p2'");
			if ($sql3) {
				echo 'ok';
			}
		}
	}
	}
?>
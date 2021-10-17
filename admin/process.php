<?php
include '../database/connect.php';
$output = "";
if (isset($_POST['genre'])) {
	$genre = $_POST['genre'];
	if($genre ==''){
		$output = "field cannot be empty";
		echo $output;
	}else{
		$sql = $db->query("INSERT INTO genre(genre) VALUES ('$genre')");
		if ($sql == true) {
			$output = "ok";
			echo $output;
		}else{
			$output = $db->error;
			echo $output;
		}
	}
}
if (isset($_POST['ask'])) {
	$question = $_POST['question'];
	$option1 = $_POST['option1'];
	$option2 = $_POST['option2'];
	$option3 = $_POST['option3'];
	$option5 = $_POST['option5'];
	$code = $_POST['code'];
	//$required = ["name"=> $full_name, "First-password"=>$reg_password,"email"=>$reg_email,"second-password"=>$reg_password2];
	if($question =='' || $option1 == '' || $option2 == '' || $option3 == '' ||  $option5 == ''){
		$output = "field cannot be empty";
		echo $output;
	}else{
		$sql = $db->query("INSERT INTO questions(question, question_code) VALUES ('$question', '$code')");
		if ($sql == true) {
			$sql = $db->query("SELECT * FROM questions WHERE question = '$question'  and question_code = '$code'");
			$q = $sql->fetch_assoc();
			$qid = $q['id'];
			$w =  $db->query("INSERT INTO answers (ans, qu_id, correct) VALUES ('$option1', '$qid', '0')");
			$w =  $db->query("INSERT INTO answers (ans, qu_id, correct) VALUES ('$option2', '$qid', '0')");
			$w =  $db->query("INSERT INTO answers (ans, qu_id, correct) VALUES ('$option3', '$qid', '0')");
			$w =  $db->query("INSERT INTO answers (ans, qu_id, correct) VALUES ('$option5', '$qid', '1')");

			if ($w == true) {
				$output = 'ok';
				echo $output;
			}else{
				$output = $db->error;
				echo $output;
			}

		}
	}
}
if (isset($_POST['update'])) {
	$question = $_POST['question'];
	$option1 = $_POST['option1'];
	$option2 = $_POST['option2'];
	$option3 = $_POST['option3'];
	$option4 = $_POST['option4'];
	$option5 = $_POST['option5'];
	$option = "";
	$ans = [$option1, $option2, $option3,  $option4, $option5];
	//$required = ["name"=> $full_name, "First-password"=>$reg_password,"email"=>$reg_email,"second-password"=>$reg_password2];
	if($question =='' || $option1 == '' || $option2 == '' || $option3 == '' ||  $option4 == '' || $option5 == ''){
		$output = "field cannot be empty";
		echo $output;
	}else{

		$sql = $db->query("UPDATE questions SET question = '$question' WHERE question = '$question'");
		if ($sql == true) {
			$sql = $db->query("SELECT * FROM questions WHERE question = '$question' LIMIT 1");
			$q = $sql->fetch_assoc();
			$qid = $q['id'];
			$ql = $db->query("SELECT * FROM answers WHERE qu_id = '$qid'");
			if ($ql->num_rows > 0) {
				$i = 0;
				while ($row = $ql->fetch_assoc()) {
					$id = $row['id'];
					$option = $ans[$i];
					$q = $db->query("UPDATE answers SET ans = '$option' WHERE id = '$id'");
					$i++;
				}
				if ($q == true) {
					$output = 'ok';
					echo $output;
				}
			}else{
				$output = $db->error;
				echo $output;
			}
		}

	}
}
if (isset($_POST['delete'])) {
	$question = $_POST['question'];
	$option1 = isset($_POST['option1'])?$_POST['option1']:'';
	$option2 = isset($_POST['option2'])?$_POST['option2']:'';
	$option3 = isset($_POST['option3'])?$_POST['option3']:'';
	$option4 = isset($_POST['option4'])?$_POST['option4']:'';
	$option5 = isset($_POST['option5'])?$_POST['option5']:'';
	$ans = [$option1, $option2, $option3,  $option4, $option5];
	//$required = ["name"=> $full_name, "First-password"=>$reg_password,"email"=>$reg_email,"second-password"=>$reg_password2];
	$sql = $db->query("SELECT * FROM questions WHERE question = '$question' LIMIT 1");
	$q = $sql->fetch_assoc();
	$qid = $q['id'];
	$ql = $db->query("SELECT * FROM answers WHERE qu_id = '$qid'");
	if ($ql->num_rows > 0) {
		$ql = $db->query("DELETE FROM answers WHERE qu_id = '$qid'");
		if ($ql == true) {
			$ql = $db->query("DELETE FROM questions WHERE id = '$qid'");
			if ($q == true){
				$output = 'ok';
				echo $output;
			}else{
				$output = $db->error;
				echo $output;
			}
		}else{
			$output = $db->error;
			echo $output;
		}
	}else{
		$q = $db->query("DELETE FROM questions WHERE id = '$qid'");
		if ($q == true){
			$output = 'ok';
			echo $output;
		}else{
			$output = $db->error;
			echo $output;
		}

	}

}

if (isset($_POST['deleteQuestion'])) {
	$qid = $_POST['id'];
	$ql1 = $db->query("DELETE FROM answers WHERE qu_id = '$qid'");
	if ($ql1 == true) {
		$ql = $db->query("DELETE FROM questions WHERE id = '$qid'");
		if ($ql == true){
			$output = 'ok';
			echo $output;
		}else{
			$output = $db->error;
			echo $output;
		}
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['deleteGame'])) {
	$qid = $_POST['id'];
	$ql1 = $db->query("DELETE FROM game WHERE id = '$qid'");
	if ($ql1 == true) {
		if ($ql1 == true){
			$output = 'ok';
			echo $output;
		}else{
			$output = $db->error;
			echo $output;
		}
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['deleteUser'])) {
	$id = $_POST['id'];
	$ql = $db->query("DELETE FROM customer WHERE cId = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['comprehension'])) {
	$passage = $_POST['passage'];
	$ql = $db->query("update admin set 	prepaid_terms = '$passage' where cId = '1'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['instruction'])) {
	$passage = $_POST['rules'];
	$ql = $db->query("update admin set 	terms_type = '$passage' where cId = '1'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['deleteCode'])) {
	$id = $_POST['id'];
	$ql = $db->query("DELETE FROM question_codes WHERE id = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['addNewCode'])) {
	$id = $_POST['code'];
	$ql = $db->query("INSERT INTO question_codes(question_code, available_questions) VALUES ('$id', 0)");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}
if (isset($_POST['deleteGenre'])) {
	$id = $_POST['id'];
	$ql = $db->query("DELETE FROM genre WHERE id = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}
if (isset($_POST['deleteBook'])) {
	$id = $_POST['id'];
	$ql = $db->query("DELETE FROM content WHERE id = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}
if (isset($_POST['editGenre1'])) {
	$id = $_POST['id'];
	$genre = $_POST['genr1'];
	$ql = $db->query("UPDATE genre SET genre = '$genre' WHERE id = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['updateCode'])) {
	$id = $_POST['id'];
	$code = $_POST['code'];
	$ql = $db->query("UPDATE question_codes SET question_code = '$code' WHERE id = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}

if (isset($_POST['insertPub'])) {
	$id = $_POST['id'];
	$genre = $_POST['genre1'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$ql = $db->query("UPDATE content SET genre = '$genre', author = '$author', title= '$title' WHERE id = '$id'");
	if ($ql == true) {
		$output = 'ok';
		echo $output;
	}else{
		$output = $db->error;
		echo $output;
	}
}
?>
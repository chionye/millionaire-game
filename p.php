<?php 
if ($_SERVER['HTTP_HOST'] == 'localhost') {
  $db = mysqli_connect("localhost","root","", "quiz") or die ("couldn't connect to database");
}else{
  $db = mysqli_connect("localhost","digitav2_newbiz","Draco1982?","digitav2_newbiz") ;
}
  $qu1 = "select games_played from games_played where user_id = 16";
  $qu2 = "select games_played from games_played where user_id = 19";
  $filter = $db->query("select question_code from questions where question_code not IN ($qu1)");
  while ($filterData = $filter->fetch_assoc()) {
    print_r($filterData);
  }
 ?>
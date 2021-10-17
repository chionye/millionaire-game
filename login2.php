<?php 
  include 'database/connect.php';
  $pass = 'email@admin';
  $hashed = password_hash($pass, PASSWORD_DEFAULT);
  $sql = $db->query('UPDATE customer SET customer_password = "$hashed"');
  if ($sql == true) {
    echo "done";
  }
?>
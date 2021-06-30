<?php
  include 'db/db-config.php';

  $emp_id = $POST['user_emp_id'];
  $emp_id = trim($emp_id);

  $sql = "SELECT user_emp_id FROM tb_user WHERE user_emp_id = '$emp_id'";
  $stmt = $dbh->prepare($sql);

  if($stmt->fetchColumn() > 0){
    header('Content-Type: application/json');
    echo json_encode(array('status'=>'fail', 'message'=>'หมายเลข '.$emp_id.' ลงทะเบียนแล้ว'));
  }else {
    header('Content-Type: application/json');
    echo json_encode(array('status'=>'success', 'message'=>''));
  }
?>

<?php
  include 'db/db-config.php';

  $user_name = $POST['user_name'];
  $user_emp_id = $POST['user_emp_id'];
  $user_email = $POST['user_email'];
  $user_pass = $POST['user_pass'];

  $sql = "INSERT INTO tb_user (user_name, user_emp_id, user_email, user_password, permis_id)
          VALUES ('$user_name', '$user_emp_id', '$user_email', '$user_pass', '3')";
  $stmt = $dbh->prepare($sql);
  $result = $stmt->execute();

  if ($result) {
    header('Content-Type: application/json');
    echo json_encode(array('status'=>'success', 'message'=>''));
  }else {
    header('Content-Type: application/json');
    $error = 'เกิดข้อผิดพลาดในการบันทึก'.$stmt->errorCode();
    echo json_encode(array('status'=>'fail', 'message'=>$error));
  }
 ?>

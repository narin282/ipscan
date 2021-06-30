<?php
  include 'db/db-config.php';

  $ipaddr_id = $_POST['ipaddr_id'];

  $stmt = $dbh->prepare("UPDATE tb_ip_address SET ipaddr_client_name = NULL WHERE ipaddr_id = '$ipaddr_id' ");
  $result = $stmt->execute();
  if($result){
    header('Content-Type: application/json');
    echo json_encode(array('status'=>'success', 'value'=>'-', 'message'=>'ลบข้อมูลสำเร็จ'));
  }else {
    header('Content-Type: application/json');
    $error = 'เกิดข้อผิดพลาดในการบันทึก'.$stmt->errorCode();
    echo json_encode(array('status'=>'SQL Execute Failed', 'value'=>'', 'message'=>$error));
  }
?>

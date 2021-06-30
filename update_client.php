<?php
  include 'db/db-config.php';

  $ipaddr_id = $_POST['ipaddr_id'];

  $ipaddr_client_name = $_POST['ipaddr_client_name'];
  $ipaddr_client_name = trim($ipaddr_client_name);

  $stmt = $dbh->prepare("UPDATE tb_ip_address SET ipaddr_client_name = '$ipaddr_client_name' WHERE ipaddr_id = '$ipaddr_id' ");

  $result = $stmt->execute();
  if($result){
    header('Content-Type: application/json');
    echo json_encode(array('status'=>'success', 'value'=>$ipaddr_client_name, 'message'=>'บันทึกข้อมูลเรียบร้อยแล้ว'));
  }else {
    header('Content-Type: application/json');
    $error = 'เกิดข้อผิดพลาดในการบันทึก'.$stmt->errorCode();
    echo json_encode(array('status'=>'SQL Execute Failed', 'value'=>'', 'message'=>$error));
  }

?>

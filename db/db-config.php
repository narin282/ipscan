<?php
  $dsn = 'mysql:host=localhost;dbname=website';
  $username = 'root';
  $password = '';
  $option = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  );
  try {
    $dbh = new PDO($dsn, $username, $password, $option);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);
    //echo 'Database connected.';
  } catch (PDOException $e) {
    echo 'Connection database failed.<br>';
    echo 'Error Message: '.$e->getMessage().'<br>';
    echo 'On line: '.$e->getLine();
  }
 ?>

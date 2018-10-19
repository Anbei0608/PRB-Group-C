<?php
$id = $_REQUEST['id'];
  $conn = mysqli_connect("localhost", "root", "","maindb");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "DELETE FROM login WHERE id=".$id;
  $conn->query($sql);
  $conn->close();
?>
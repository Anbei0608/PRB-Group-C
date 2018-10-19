<?php
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$type = $_REQUEST['type'];

$conn = mysqli_connect("localhost", "root", "", "maindb");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
  }
  $sql="INSERT INTO login VALUES (NULL,'".$username."','".$password."','".$type."')";
	if(mysqli_query($conn, $sql)) {
		echo "Updated";
	}
	else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  ?>
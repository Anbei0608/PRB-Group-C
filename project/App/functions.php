<?php
function getDebitCard($id, $isPassport){
	$conn = mysqli_connect("localhost", "root", "","debit_card");
	//echo $sql;
	$sql = "";
	($isPassport) ? $sql = "SELECT * from user where passport_number='".$id."'" : $sql = "SELECT * from user where Last_name='".$id."'";
	$result = mysqli_query($conn, $sql)or die(mysqli_error($$conn));
	$arr=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
function getCreditCard($id, $isPassport){
	$conn = mysqli_connect("localhost", "root", "","credit_card");
	//echo $sql;
	$sql = "";
	($isPassport) ? $sql = "SELECT * from user where passport_number='".$id."'" : $sql = "SELECT * from user where Last_name='".$id."'";
	$result = mysqli_query($conn, $sql)or die(mysqli_error($$conn));
	$arr=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
function getHomeLoan($id, $isPassport){
	$conn = mysqli_connect("localhost", "root", "","home_loan");
	//echo $sql;
	$sql = "";
	($isPassport) ? $sql = "SELECT * from user where passport_number='".$id."'" : $sql = "SELECT * from user where Last_name='".$id."'";
	$result = mysqli_query($conn, $sql)or die(mysqli_error($$conn));
	$arr=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
function getCarLoan($id, $isPassport){
	$conn = mysqli_connect("localhost", "root", "","car_loan");
	//echo $sql;
	$sql = "";
	($isPassport) ? $sql = "SELECT * from user where passport_number='".$id."'" : $sql = "SELECT * from user where Last_name='".$id."'";
	$result = mysqli_query($conn, $sql)or die(mysqli_error($$conn));
	$arr=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}

function getJSONFromDB($sql){
	$conn = mysqli_connect("localhost", "root", "","maindb");
	//echo $sql;
	$result = mysqli_query($conn, $sql)or die(mysqli_error($$conn));
	$arr=array();
	//print_r($result);
	while($row = mysqli_fetch_assoc($result)) {
		$arr[]=$row;
	}
	return json_encode($arr);
}
?>
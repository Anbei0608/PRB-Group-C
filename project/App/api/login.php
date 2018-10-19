<?php
$obj=array();
$obj['result'] = false;
$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'maindb';
$conn = mysqli_connect($server, $user, $password, $dbname);
if ($_REQUEST['username'] && $_REQUEST['password'] ) {
    $uname = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    $type = $_REQUEST['type'];
    $dtype = "";
    $sid = "";
    $query = "select * from login where username='$uname'";
    $pass2 = "";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $pass2=$row['password'];
            $dtype = $row['type'];
        }
    }
    else{
        header("Location: http://localhost/App/index.html");
    }
    if($pass2 == $pass && $type == $dtype){
        session_start();
        $_SESSION['username'] = $uname;
        $_SESSION['type'] = $dtype;
        header("Location: http://localhost/App/customerInfo.php");
    }
    else{
        header("Location: http://localhost/App/index.html");
    }
}

?>
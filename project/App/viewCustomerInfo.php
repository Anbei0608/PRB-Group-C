<?php
    session_start();
    if(!isset($_SESSION['username']))
    header('Location:'.'http://localhost/app/');
?>
<?php
require('functions.php');
$passport = '';
$lastName = '';
$isPassport = false;
if(isset($_REQUEST['passport'])){
    $passport = $_REQUEST['passport'];
}
if(isset($_REQUEST['lastName'])){
    $lastName = $_REQUEST['lastName'];
}
if(empty($_REQUEST['passport'])){
    $isPassport = false;
}
else{
    $isPassport = true;
}

//$isPassport = false;
$profile = true;
$debitCard = false;
($isPassport) ? $debitData = getDebitCard($passport, $isPassport) : $debitData = getDebitCard($lastName, $isPassport);
$debitData = json_decode($debitData);
if(isset($debitData[0]->Customer_id)){
    $debitCard = true;
}
else{
    $debitCard = false;
}

$creditCard = false;
($isPassport) ? $creditData = getCreditCard($passport, $isPassport) : $creditData = getCreditCard($lastName, $isPassport);
$creditData = json_decode($creditData);
if(isset($creditData[0]->Customer_id)){
    $creditCard = true;
}
else{
    $creditCard = false;
}

$carLoan = false;
($isPassport) ? $carData = getCarLoan($passport, $isPassport) : $carData = getCarLoan($lastName, $isPassport);
$carData = json_decode($carData);
if(isset($carData[0]->Customer_id)){
    $carLoan = true;
}
else{
    $carLoan = false;
}

$homeLoan = false;


($isPassport) ? $homeData = getHomeLoan($passport, $isPassport) : $homeData = getHomeLoan($lastName, $isPassport);
$homeData = json_decode($homeData);
if(isset($homeData[0]->Customer_id)){
    $homeLoan = true;
}
else{
    $homeLoan = false;
}
if($debitCard)
    $profileData = $debitData;
else if($creditCard)
    $profileData = $creditData;
else if($homeLoan)
    $profileData = $homeData;
else if($carLoan)
    $profileData = $carData;
else
    $profile = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Staff Backend</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="orange" data-image="assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">

                    <a href="#" class="simple-text logo-normal ml-4">
                        Dashboard
                    </a>
                </div>

                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="customerInfo.php">
                            <i class="nc-icon nc-circle-09"></i>
                            <p>Customer Info</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="viewStuff.php">
                            <i class="nc-icon nc-notes"></i>
                            <p>View Staff</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="addStuff.php">
                            <i class="nc-icon nc-simple-add"></i>
                            <p>Add Staff</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="deleteStuff.php">
                            <i class="nc-icon nc-simple-remove"></i>
                            <p>Delete Staff</p>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon d-none d-lg-block">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo"> Customer Info </a>
                    </div>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">

                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a href="api/logout.php" class=" nav-link">
                                    <i class="nc-icon nc-button-power"></i>Log out
                                </a>

                            </li>


                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="section-image" data-image="assets/img/bg5.jpg" ;>
                        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-sm-6">
                                    <div class="card ">
                                        <div class="card-header ">
                                            <div class="card-header">
                                                <h4 class="card-title">User Profile</h4>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="container">
                                            <?php
                                            if ($profile){
                                                foreach($profileData as $data){ ?>
                                                <h3>Customer Number : <?= $data->Customer_id ?> </h3>
                                                <h3>Passport Number : <?= $data->Passport_number ?> </h3>
                                                <h3>Date of Birth : <?= $data->DOB ?> </h3>
                                                <h3>Last Name : <?= $data->Last_name ?> </h3>
                                                <h3>First Name : <?= $data->First_name ?> </h3>
                                                <h3>Address : <?= $data->Address ?>, <?= $data->City ?> </h3>
                                                <h3>Phone : <?= $data->Phone_number ?> </h3>
                                            <?php
                                            } }
                                            else{
                                                echo '<h4>No records Found!</h4>';
                                            }
                                            ?>
                                            
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="card-header ">
                                            <div class="card-header">
                                                <h4 class="card-title">Debit Card</h4>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                        <div class="container">
                                            <?php
                                            if ($debitCard){
                                                foreach($debitData as $data){ ?>
                                                <h3>Debit Card Amount : <?= $data->Debit_card ?> </h3>
                                            <?php
                                            } }
                                            else{
                                                echo '<h4>No records Found!</h4>';
                                            }
                                            ?>
                                            
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="card-header ">
                                            <div class="card-header">
                                                <h4 class="card-title">Credit Card</h4>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                        <div class="container">
                                            <?php
                                            if ($creditCard){
                                                foreach($creditData as $data){ ?>
                                                <h3>Credit Card Amount : <?= $data->Credit_card ?> </h3>
                                            <?php
                                            } }
                                            else{
                                                echo '<h4>No records Found!</h4>';
                                            }
                                            ?>
                                            
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="card-header ">
                                            <div class="card-header">
                                                <h4 class="card-title">Car Loan</h4>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                        <div class="container">
                                            <?php
                                            if ($carLoan){
                                                foreach($carData as $data){ ?>
                                                <h3>Car Loan Amount : <?= $data->Car_loan ?> </h3>
                                            <?php
                                            } }
                                            else{
                                                echo '<h4>No records Found!</h4>';
                                            }
                                            ?>
                                            
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="card ">
                                        <div class="card-header ">
                                            <div class="card-header">
                                                <h4 class="card-title">Home Loan</h4>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                        <div class="container">
                                            <?php
                                            if ($homeLoan){
                                                foreach($homeData as $data){ ?>
                                                <h3>Home Loan Amount : <?= $data->Home_loan ?> </h3>
                                            <?php
                                            } }
                                            else{
                                                echo '<h4>No records Found!</h4>';
                                            }
                                            ?>
                                            
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav>

                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="#">LA TROBE</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
 
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!--  jVector Map  -->
<script src="assets/js/plugins/jquery-jvectormap.js" type="text/javascript"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="assets/js/plugins/moment.min.js"></script>
<!--  DatetimePicker   -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js"></script>
<!--  Sweet Alert  -->
<script src="assets/js/plugins/sweetalert2.min.js" type="text/javascript"></script>
<!--  Tags Input  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js" type="text/javascript"></script>
<!--  Sliders  -->
<script src="assets/js/plugins/nouislider.js" type="text/javascript"></script>
<!--  Bootstrap Select  -->
<script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--  jQueryValidate  -->
<script src="assets/js/plugins/jquery.validate.min.js" type="text/javascript"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--  Bootstrap Table Plugin -->
<script src="assets/js/plugins/bootstrap-table.js"></script>
<!--  DataTable Plugin -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<!--  Full Calendar   -->
<script src="assets/js/plugins/fullcalendar.min.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
<?php 

//start the session
session_start();


// Require/includethe Database Connection Page
require("db_connect.php");

//Pick user details from the form
if(isset($_POST['login'])) {

  //creating variables to hold the form data
  $email=$password=$login_sucess=$login_error= '';

  //picking up the data from form
  $email=$_POST['email'];
  $password=$_POST['password'];

     //prevents Cross Site Scripting Attack
     $email=htmlspecialchars($email);
     $email = mysqli_real_escape_string($dbconnect, $email);
     $password = htmlspecialchars($password);
     $password = mysqli_real_escape_string($dbconnect, $password);

     //Encrypt
     $password = crypt($password, 'vote_2022');

  //echo "<p style='color: white;'> $email $password</p>";

  //Retrieve the data from the database
  //step-1 write  down the sql data
  $sql = "SELECT * FROM user WHERE emailaddress = '$email' ";
  //step-2 Execute the sql statement using the mysqli query function exists
  $result = mysqli_query($dbconnect, $sql);
  //step-3 Fetch the results 
  $user = mysqli_fetch_assoc($result);

  //print_r($user);
  //Save the password from the database to a variable
  $pass_from_db = $user['password'];

  if ($password == $pass_from_db) {
    $login_success = "<p style='color: green;'>Login successful</p>";
//save some user info on a session
$_SESSION['firstname'] = $user['firstname'];
$_SESSION['othernames'] = $user['othernames'];

    //redirecting user to their home page
    header('Location: index.php');

  } else {
    $login_error = "<p style='color: red;'>Login failed. Please  try again.</p>";
  }

  //free memory result
  mysqli_free_result($result);
  
}

// close the database connection
mysqli_close($dbconnect);

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Here</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="color-line"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="back-link back-backend">
                    <a href="#" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div class="text-center m-b-md custom-login">
                    <h1 style="color: gold ;">PLEASE LOGIN TO VOTE</h1>
                    
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" method="post" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you email addreses" required="required" value="" name="email" id="email" class="form-control">
                                <span class="help-block small">The email you used for registration</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password"  required="required" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Your strong password</span>
                            </div>
                            
                            <?php 
                             if(isset($login_success)):
                                echo $login_success;
                            endif;

                            if(isset($login_error)):
                              echo $login_error;
                          endif;
                             ?>

                            <input type="submit" id="login" name="login" value="Login" class="btn btn-success btn-block loginbtn" />
                            <a class="btn btn-default btn-block" href="signup.php">Register</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <p>Copyright © 2018 <a href="https://colorlib.com/wp/templates/">Colorlib</a> All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
</body>

</html>
<?php
  //start session
  session_start();
   //include the database connection page
   require("db_connect.php");
   //require the user defined function page
   require("my_functions.php");
   //pick details from the form
   if(isset($_POST['login'])){
    //create variables to hold form data
    $email= $password=$login_success=$login_error='';
    //picking up data from the form
    $email=$_POST['email'];
    $password=$_POST['password'];
//prevent cross site script attack
    $email=sanitize($email);
    $password=sanitize($password);
   // $email=mysqli_real_escape_string($dbconnect,$email);
   // $password=htmlspecialchars($password);


    // echo "<p style='color:white'>$email $password</p>";

    //retrieve data from database
    //step 1-write the sql statement
    $sql="SELECT * FROM user WHERE emailaddress='$email'";
    //step 2-execute the sql statement using mysqli_function
    $result=mysqli_query($dbconnect,$sql);
    //step 3-fetch the results
    $user=mysqli_fetch_assoc($result);
//save password from database to variable

    $pass_from_db=$user['password'];
    $password = crypt($password, 'vote_2022');

    if($password === $pass_from_db){
      $login_success="<p style='color:green'>Login successful</p>";
      $_SESSION['firstname']=$user['firstname'];
      $_SESSION['othernames']=$user['othernames'];
      $_SESSION['id']=$user['id'];
      $_SESSION['contact']=$user['contact'];
      $_SESSION['emailaddress']=$user['emailaddress'];
      $_SESSION['password']=$user['password'];
      
      

     //redirect user to the home page
     header('Location:index.php');

    }else{
      echo "<p style='color:white'>$pass_from_db</p>";
      $login_error="<p style='color:red'>Login failed.Please try again!</p>";
      }
    //free memory result set
    mysqli_free_result($result);
    
   }
   //close the database connection
   mysqli_close($dbconnect);
   ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Nalika - Material Admin Template</title>
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
                    <a href="index.html" class="btn btn-primary">Back to home</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div class="text-center m-b-md custom-login">
                    <h1 style="color:gold">PLEASE LOGIN TO VOTE</h1>

                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="#" method="post" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="username">email</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you emailaddress" required="" value="" name="email" id="email" required="" class="form-control">

                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" required="" value="" name="password" id="password" class="form-control">

                            </div>
   <?php
      if (isset($login_success)):
        echo $login_success;
      endif;

      if(isset($login_error)):
        echo $login_error;
      endif;
                            
                            
      ?>
                            <div class="checkbox login-checkbox">
                                <label>
										
                            </div>
                            <input type="submit" id="login" name="login" value="login" class="btn btn-success btn-block loginbtn"/>
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
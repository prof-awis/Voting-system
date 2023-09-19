<?php 

    require('db_connect.php');

    if(isset($_POST['save'])) {
      $email = $password  = $login_success = $login_error = '';
      $email = $_POST['email'];
      $password = $_POST['password'];

      $email = htmlspecialchars($email);
      $email = mysqli_real_escape_string($dbconnect, $email);
      $password = htmlspecialchars($password);
      $password = mysqli_real_escape_string($dbconnect, $password);
      $password = crypt($password, 'vote_2022');

      $sql = "SELECT * FROM user WHERE emailaddress = '$email'";

      $result = mysqli_query($dbconnect, $sql);

      $user = mysqli_fecth_assoc($result);

      $pass_from_db = $user['password'];

      if($password == $pass_from_db) {
        $login_success = "<p style='color: green;'>Login Successfull</p>";
      } else {
        $login_error = "<p style='color: red;'>Login Failed</p>";

      }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: auto;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
input[type="submit"]{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

.no:checked ~ input[type='submit'] {
    display: none;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action='login.php' method='post' id='loginForm'>
        <h3>Login</h3>

        <label for="email">Email Address</label>
        <input type="email" placeholder="Email Address" id="email" name="email">

        <label for="password">Password</label>
        <input required type="password" placeholder="Password" name='password' id="password">
        <?php 
            if(isset($login_success)) : 
            echo $login_success;
            endif;
            if(isset($login_error)):
            echo $login_error;
            endif;
        ?>
        <input type='submit' id='save' name='save' value='Login'></input>
    </form>

</body>
</html>